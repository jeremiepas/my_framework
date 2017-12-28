<?php

namespace app\controllers;

use \jfrp\Controller;

class user extends Controller{

    public function indexAction($para =null){
        $mod  = '\app\models\UsersTable';
        $method = $this->method;
        $this->model = new $mod();
        $this->rest($para);
			$this->render('user:index', array('test' => 123, 'blate' => 'bien'));
    }
    public function findall($para = ['']){
        $controller  = '\app\models\UsersTable';
        $model = new $controller();
        $user = $model->findall();
            $this->renderjson($user);
    }
    public function connection($para = null){
      $mod  = '\app\models\UsersTable';
      $model = new $controller();

    }
}

?>
