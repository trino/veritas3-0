<?php
namespace App\Controller\Component;

use Cake\Controller\Component;
use Cake\ORM\TableRegistry;
use Cake\Network\Email\Email;

class MailerComponent extends Component {
    public function getString($Name){
        $table = TableRegistry::get('strings');
        return $table->find()->where(['Name'=>$Name])->first();
    }

    function getfirstsuper(){
        $super = TableRegistry::get('profiles');
        $sup = $super->find()->where(['super'=>1])->first();
        return $sup->email;
    }

    public function savevariables($eventname, $variables){//ID Name Description Attachments image
        $table = TableRegistry::get('strings');
        $eventname="email_" . $eventname . "_variables";
        $string = $table->find()->where(['Name'=> $eventname])->first();
        $variables = implode(", ", array_keys($variables));

        if ($string){
            if ($string->English != $variables) {
                $table->query()->update()->set(['English' => $variables])->where(['Name' => $eventname])->execute();
            }
        } else { //new
            $table->query()->insert(['Name', 'English'])->values(['Name' => $eventname, 'English' => $variables])->execute();
        }
    }

    function handleevent($eventname, $variables){
        $this->savevariables($eventname, $variables);
        //return false;//not operational
        $Email = $this->getString("email_" . $eventname . "_subject");
        $language = "English";

        if(!isset($variables["site"])) { $variables["site"] = $this->get_settings()->mee; }
        $variables["event"] = $eventname;
        $variables["webroot"] = LOGIN;
        $variables["created"] = date("l F j, Y - H:i:s");
        $variables["login"] = '<a href="' . LOGIN . '">Click here to login</a>';
        $variables["variables"] = print_r($variables, true);
        if($Email) {
            $Subject =  $Email->$language;//$Email->English;
            $Message = $this->getString("email_" . $eventname . "_message")->$language;//$Email->French;
            if(isset($variables["footer"])) { $Message.= $variables["footer"]; }
            foreach ($variables as $Key => $Value) {
                if( !is_array($Value)) {
                    $Subject = str_replace("%" . $Key . "%", $Value, $Subject);
                    $Message = str_replace("%" . $Key . "%", $Value, $Message);
                }
            }

            $Message = str_replace("\r\n", "<BR>", $Message);
            if(!$Message) {$Message = $eventname . " variables: " .$variables["variables"];}//DEBUG
            if(isset($variables["debug"])){$Message.= "<BR>" . $variables["debug"];}
            if (!isset($variables["email"]) ) {$variables["email"] = $this->getfirstsuper();}
            if (is_array($variables["email"])){
                foreach($variables["email"] as $email){
                    $this->sendEmail("", $email, $Subject, $Message);
                }
            } else {
                $this->sendEmail("", $variables["email"], $Subject, $Message);
            }
        } else {
            $Subject = $eventname;
            $Message = "email_" . $eventname . " does not have _subject/_message set in [strings]";
            $this->sendEmail("",$variables["email"], $Subject, $Message . " Variables: " . print_r($variables, true));
        }
        //"clientcreated":// "email", "company_name", "profile_type", "username", "created", "path"
        //"orderplaced" type=("physical", "footprint", "surveillance"):// "email", "company_name", "username", "created", "path"
        //"ordercompleted", "id","email", "path", username, company_name, type, status
        //profilecreated", "username","email","path" , "createdby", "type", "password"
        return true;
    }

    public function getprofile($UserID){
        $table = TableRegistry::get("profiles");
        $results = $table->find('all', array('conditions' => array('id'=>$UserID)))->first();
        return $results;
    }

    function getUrl(){
        $url = $_SERVER['SERVER_NAME'];
        if($url=='localhost') { return 'trinoweb.com';}//LOCALHOST.COM WILL NOT GET PAST GOOGLE!!!
        $url = str_replace(array('http://', '/', 'www'), array('', '', ''), $url);
        $email_from = $url;
        return $email_from;
    }

    function get_settings() {
         $settings = TableRegistry::get('settings');
         $query = $settings->find();
         $l = $query->first();
         return $l;
   }

    function getuserid($email){
        $user = TableRegistry::get('profiles')->find()->where(['email'=> $email])->first();
        if($user){return $user->id;}
    }
    function getclients($userid){
        return TableRegistry::get('clients')->find()->where(['profile_id LIKE "'.$userid.',%" OR profile_id LIKE "%,'.$userid.',%" OR profile_id LIKE "%,'.$userid.'"']);
    }
    function checkemail($email){
        $userid = $this->getuserid($email);
        if ($userid){
            if($userid->super == 0) {
                $clients = $this->getclients($userid);
                foreach ($clients as $client) {
                    if ($client->forcemeail) {
                        return $client->forcemeail;
                    }
                }
            }
        }
        return $email;
    }

    function sendEmail($from,$to,$subject,$message, $emailIsUp = false){//do not use! Use HandleEvent instead!!!!
        //from can be array with this structure array('email_address'=>'Sender name'));
        $path = $this->getUrl();
        $n =  $this->get_settings();
        $name = $n->mee;
        if($n->forceemail){$to = $n->forceemail;}
        $email = new Email('default');
        if(is_numeric($to)){$to = $this->getprofile($to)->email;}
        if ($to == "super") {$to = $this->getfirstsuper();}

        $to = $this->checkemail($to);

        if(strpos($subject, "[DISABLED]") !== false || strpos($to, "[DISABLED]") !== false) {$emailIsUp=false;}
        if ($emailIsUp) {
            //if ($send2Roy || $to == "roy") {$to = "roy@trinoweb.com";} //should not happen
            $email->from(['info@' . $path => $name])
                ->emailFormat('html')
                ->to(trim($to))//$to
                ->subject($subject)
                ->send($message);
        } else {


            if($_SERVER['SERVER_NAME'] =="isbmeereports.com"){
                $pather = "/home/isbmeereports/public_html/webroot/royslog.txt";
            }else{
                $pather = "royslog.txt";
            }


            $dashes = "----------------------------------------------------------------------------------------------\r\n";
            file_put_contents($pather, $dashes . "To: " . $to . "\r\nAt: " . date("l F j, Y - H:i:s") . "\r\nSubject: " . $subject .  "\r\n" . $dashes . str_replace("<BR>", "\r\n" , $message) . "\r\n", FILE_APPEND);
            //C:\wamp\www\veritas3-0\webroot\royslog.txt
        }
    }
}
?>