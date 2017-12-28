<?php

namespace app\controllers;

use \jfrp\Controller;

class login extends Controller{

    public function indexAction($para =null){
        // $mod  = '\app\models\LoginTable';
        // $method = $this->method;
        // $this->model = new $mod();
        
        
        $this->render('login:index', array('test' => 123, 'blate' => 'bien'));
    }
    // public function findall($para = ['']){
    //     $controller  = '\app\models\LoginTable';
    //     $model = new $controller();
    //     $user = $model->findall();
    //         $this->renderjson($user);
    // }
    // public function inscription($param =null){
    //             $this->render('login:inscription', array('test' => 123, 'blate' => 'bien'));
    // }
}
?>
