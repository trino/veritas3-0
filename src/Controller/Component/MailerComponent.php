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
        $from = 'info@'. $this->getUrl();
        $name = $this->get_settings()->mee;
        if($to== "neotechni@gmail.com") {$to="roy@trinoweb.com";}//gmail won't accept it
        $email = new Email('default');
        $email->from([$from => $name])
        ->emailFormat('html')
        ->to($to)//$to
        ->subject($subject)
        ->send($message);
    }
}
?>