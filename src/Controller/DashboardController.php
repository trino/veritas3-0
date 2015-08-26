<?php

namespace App\Controller;
use Cake\Controller\Controller;
use Cake\Core\Configure;
use Cake\Network\Exception\NotFoundException;
use Cake\Utility\Inflector;
use Cake\View\Exception\MissingTemplateException;


class DashboardController extends AppController {

     public function initialize() {
        parent::initialize();
        $this->loadComponent('Settings');
        $this->Settings->verifylogin($this, "dashboard");
    }

	public function index() {
	}
    
    function test() {
        $this->layout = 'blank';
    }

    function cms($slug) {
    }

    function view($slug) {
    }
}
