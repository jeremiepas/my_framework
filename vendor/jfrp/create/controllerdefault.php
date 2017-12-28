<?php

namespace app\controllers;

use \jfrp\Controller;

class {{ name }} extends Controller{

    public function indexAction($para =null){
        $mod  = '\app\models\{{ nametab }}Table';
        $method = $this->method;
        $this->model = new $mod();
        {{ render }}
    }
    public function findall($para = ['']){
        $controller  = '\app\models\{{ nametab }}Table';
        $model = new $controller();
        $user = $model->findall();
            $this->renderjson($user);
    }
}

?>
