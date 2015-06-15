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

    function handleevent($eventname, $variables){
        $Email = $this->getString("email_" . $eventname);
        $variables["webroot"] = LOGIN;
        $variables["created"] = date("l F j, Y - H:i:s");
        $variables["login"] = '<a href="' . LOGIN . '">Click here to login</a>';
        if($Email) {
            $Subject = $Email->English;
            $Message = $Email->French;
            foreach ($variables as $Key => $Value) {
                $Subject = str_replace("%" . $Key . "%", $Value, $Subject);
                $Message = str_replace("%" . $Key . "%", $Value, $Message);
            }
            $Message = str_replace("\r\n", "<BR>", $Message);
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
            $Message = "email_" . $eventname . " does not have an email set in [strings]";
            if (!isset($variables["email"]) || is_array($variables["email"])) {$variables["email"] = "Roy@trinoweb.com";}
            $this->sendEmail("",$variables["email"], $Subject, $Message . " Variables: " . print_r($variables, true));
        }
        //"clientcreated":// "email", "company_name", "profile_type", "username", "created", "path"
        //"orderplaced" type=("physical", "footprint", "surveillance"):// "email", "company_name", "username", "created", "path"
        //"ordercompleted", "id","email", "path", username, company_name, type, status
        //profilecreated", "username","email","path" , "createdby", "type", "password"
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

    function sendEmail($from,$to,$subject,$message, $emailIsUp = false, $send2Roy = false){
        //from can be array with this structure array('email_address'=>'Sender name'));
        $path = $this->getUrl();
        $n =  $this->get_settings();
        $name = $n->mee;
        $email = new Email('default');
        file_put_contents("royslog.txt", "\r\n" . $to . " - " . $subject .  "\r\n" . $message , FILE_APPEND);

        if ($emailIsUp) {
            if($to == "super"){ $to = $this->getfirstsuper();}
            if($send2Roy){$to = "roy@trinoweb.com";}
            $email->from(['info@' . $path => $name])
                ->emailFormat('html')
                ->to($to)//$to
                ->subject($subject)
                ->send($message);
        }
    }
}
?>