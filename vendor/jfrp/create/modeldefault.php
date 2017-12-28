<?php

namespace app\models;

use \jfrp\Models;

class {{ name }}Table extends Models{
    public function findOne($cmd, $tab){
        return $this->getdata($cmd, $tab);
    }
    public function insert($tab){
        return $this->setdata($tab);
    }
    public function update($where, $tab){
        return $this->updatedata($where, $tab);
    }
    public function delete($tab){
        return $this->deletedata($tab);
    }
    public function findall(){
        return $this->getdata();
    }
}
?>
