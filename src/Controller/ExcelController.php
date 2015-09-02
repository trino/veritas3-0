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
        if (isset($_GET["table"])){
            $table = $this->Manager->enum_table($_GET["table"]);
            $this->set("Data", $this->paginate($table));
            $this->set("Columns", $this->Manager->getColumnNames($_GET["table"], "", false));
            $this->set("PrimaryKey", $this->Manager->get_primary_key($_GET["table"]));
        }
    }
}