<?php
namespace App\Controller\Component;

use Cake\Controller\Component;
use Cake\ORM\TableRegistry;
use Cake\Network\Email\Email;

class MailerComponent extends Component
{
       function sendEmail($from,$to,$subject,$message)
    {
        //from can be array with this structure array('email_address'=>'Sender name'));
        $email = new Email('default');
        
        $email->from($from)
        ->emailFormat('html')
    ->to($to)
    ->subject($subject)
    ->send($message);
    }
}
?>