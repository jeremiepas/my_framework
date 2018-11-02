<?php

namespace app\controllers;

use \jfrp\Controller;

class IndexController extends Controller{

    public function indexAction($para=null) {
        $mod  = '\app\models\Index';
        $method = $this->method;
        $model = new $mod();
        if (isset($_POST['database'])) {
          $model->adddatabase($_POST['database']);
        }
        if (isset($_DELET['database'])) {
          $model->deletdatabase($_DELET['database']);
        }
        $dbs = $model->showdatabasesall();
        $list_db = "<ul>";
        foreach ($dbs as $name) {
          $list_db = $list_db . "\n<li>".$name."</li>";
        }
        $list_db = $list_db . "\n</ul>";
        $this->render("index:index", array('list_bds' => $list_db));
    }

    public function deleteDataBase($para = ['']) {
        // $controller  = '\app\models\IndexControllerTable';
        // $model = new $controller();
        // $user = $model->findall();
        //     $this->renderjson($user);
    }

}

?>
