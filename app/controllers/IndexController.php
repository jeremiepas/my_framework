<?php

namespace app\controllers;

use \jfrp\Controller;

class IndexController extends Controller{

    public function indexAction($para =null){
        // $mod  = '\app\models\IndexControllerTable';
        // $method = $this->method;
        // $this->model = new $mod();
        $this->render('indexController:index', array('test' => 123, 'blate' => 'bien'));
    }
    public function findall($para = ['']){
        // $controller  = '\app\models\IndexControllerTable';
        // $model = new $controller();
        // $user = $model->findall();
        //     $this->renderjson($user);
    }
}

?>
