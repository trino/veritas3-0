<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;
use Cake\Controller\Controller;
use Cake\ORM\TableRegistry;
use Cake\Datasource\ConnectionManager;

class ExcelController extends AppController {
    public $paginate = [
        'limit' => 25,
        'order' => ['id' => 'DESC'],
    ];

    public function index(){
    }
}