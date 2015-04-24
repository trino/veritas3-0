<?php
namespace App\Controller\Component;

use Cake\Controller\Component;
use Cake\ORM\TableRegistry;
use Cake\Network\Email\Email;

class MailerComponent extends Component
{
    function getUrl(){
        $url = $_SERVER['SERVER_NAME'];
        if($url=='localhost') { return 'trinoweb.com';}//LOCALHOST.COM WILL NOT GET PAST GOOGLE!!!
        $url = str_replace(array('http://', '/', 'www'), array('', '', ''), $url);
        $email_from = $url;
        return $email_from;
    }
    
    function get_settings()
   {
         $settings = TableRegistry::get('settings');
         $query = $settings->find();
                 
         $l = $query->first();
         return $l;
   }

    function sendEmail($from,$to,$subject,$message){
        //from can be array with this structure array('email_address'=>'Sender name'));
        $path = $this->getUrl();
        $n =  $this->get_setting();
        $name = $n->mee;
        $email = new Email('default');
        //file_put_contents("royslog.txt", "\r\n" . $path, FILE_APPEND);

        $email->from(['info@'. $name => $path])
        ->emailFormat('html')
        ->to($to)//$to
        ->subject($subject)
        ->send($message);
        return $path . "<BR>TO: " . $to . "<BR>SUBJECT: " . $subject . "<BR>MSG: " . $message;
    }
}
?>