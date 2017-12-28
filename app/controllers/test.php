<?php

namespace app\controllers;

use \jfrp\Controller;

class test extends Controller{

    public function indexAction($para =null){
        // $mod  = '\app\models\TestTable';
        // $method = $this->method;
        // $this->model = new $mod();
        $this->render('test:index', array('test' => 123, 'blate' => 'bien'));
    }
    public function findall($para = ['']){
        $controller  = '\app\models\TestTable';
        $model = new $controller();
        $user = $model->findall();
            $this->renderjson($user);
    }
}

?>
