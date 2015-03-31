<?php
    namespace App\Controller;

    use App\Controller\AppController;
    use Cake\Event\Event;
    use Cake\Controller\Controller;
    use Cake\ORM\TableRegistry;
    use Cake\Network\Email\Email;
    use Cake\Controller\Component\CookieComponent;


    class ProfilesController extends AppController
    {

        public $paginate = [
            'limit' => 20,
            'order' => ['id' => 'DESC'],

        ];

        public function initialize()
        {

            parent::initialize();
            $this->loadComponent('Settings');
            $this->loadComponent('Mailer');
            $this->loadComponent('Document');
            if (!$this->request->session()->read('Profile.id')) {
                $url = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
                $this->redirect('/login?url='.urlencode($url));
            }

        }

    
        public function index()    
        {
            
        }
    }
?>
