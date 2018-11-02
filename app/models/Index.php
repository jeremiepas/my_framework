<?php

namespace app\models;

use \jfrp\Models;

class Index extends Models{
  public function showdatabasesall() {
    return $this->showdatabases();
  }
  public function adddatabase($name) {
    return $this->createdatabase($name);
  }
}
?>
