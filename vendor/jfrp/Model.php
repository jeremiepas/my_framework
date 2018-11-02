<?php
namespace jfrp;

abstract class Models {
    protected static $_pdo = null;
    private  $user;
    private  $password;
    private  $database;
    private  $host;
    private $type;
    private $port;

    function __construct() {
        $db = parse_ini_file(ROOT ."/config/data_base.ini");
        $this->setuser($db['user']);
        $this->setpassword($db['password']);
        $this->setdatabase($db['database']);
        $this->sethost($db['host']);
        $this->setport($db['port']);
        $this->settype($db['type']);
        if (self::$_pdo === null) {
          if ($this->database == null) {
            self::$_pdo = new \PDO($this->type.":host=".$this->host.";port=".$this->port, $this->user, $this->password);
          } else {
            self::$_pdo = new \PDO("$this->type:dbname=".$this->database.";port=".$this->port.";host=".$this->host, $this->user, $this->password);
          }
        }
    }
    private function setuser($data){
      $this->user = $data;
    }
    private function setpassword($data){
      $this->password = $data;
    }
     private function setdatabase($data){
      $this->database = $data;
    }
    private function sethost($data){
      $this->host = $data;
    }
    private function setport($data) {
      $this->port = $data;
    }
    private function settype($data) {
      $this->type = $data;
    }
    protected function settable($data) {
      $this->table = $data;
    }
    protected function showdatabases() {
      $dbs =  self::$_pdo->query( 'SHOW DATABASES' );
      $araydbs = [];
      while( ( $db = $dbs->fetchColumn( 0 ) ) !== false )
      {
          array_push($araydbs, $db);
      }
      return $araydbs;
    }
    protected function createdatabase($name) {
      $str = "CREATE DATABASE IF NOT EXISTS ".$name;
      $query = self::$_pdo->prepare($str);
      if($query->execute()){
          return $this->showdatabases();
      }
    }

    protected function deletedatabase($name) {
      $str = "DELETE DATABASE :name";
      $query = self::$_pdo->prepare($str);
      if ($query->execute(array(':name' => $name))){
          return $this->showdatabases();
      }
    }

    protected function renamedatabase($old_name, $new_name) {
      $str = "RENAME DATABASE :oldname TO :newname";
      $query = self::$_pdo->prepare($str);
      if($query->execute(array(':oldname' => $old_name, ':newname' => $new_name))){
          return $this->showdatabases();
      }
    }

    protected function setdata($tab) {
        $str = "VALUE (";
        $sql = "INSERT INTO $this->table (";
        foreach ($tab as $key => $value) {
            $sql = $sql."`$key`, ";
            $tb[':'.$key] = $value;
            $str = $str.':'.$key.', ';
        }

        $sql = rtrim( $sql,', ').')';
        $str =  rtrim( $str,', ').')';
        $sql = $sql.' '.$str;
        $query = self::$_pdo->prepare($sql);
        if($query->execute($tb)){
            $tab = [self::$_pdo->lastInsertId()];
            return $this->getdata('id = ?', $tab);
        }
    }

    protected function getdata($cmd =null, $tab=null) {
        if ($cmd == null && $tab == null) {
            $sql = "SELECT * FROM $this->table";
            $query = self::$_pdo->prepare($sql);
            $query->execute();
        } else {
            $sql = "SELECT * FROM $this->table WHERE $cmd;";
            $query = self::$_pdo->prepare($sql);
            $query->execute($tab);
        }
        return $query->fetchAll(\PDO::FETCH_ASSOC);
    }

    protected function updatedata($where, $tab) {
        $sql = "UPDATE $this->table SET "; //`pwd` = 'set' WHERE" `user`.`id` = 1;
        foreach ($tab as $key => $value) {
            $sql = $sql." `$key`= :$key, ";
            $tb[':'.$key] = $value;
        }
        $sql = rtrim( $sql,', ').' WHERE    ' ;
        foreach ($where as $key => $value) {
            $sql = $sql."`$key`= :$key, ";
            $tb[':'.$key] = $value;
        }
            $sql = rtrim( $sql,', ');
        $query = self::$_pdo->prepare($sql);
        $query->execute($tb);
        return $query->rowCount();
    }

    protected function deletedata($cmd){
        $sql = "DELETE FROM $this->table WHERE ";
        foreach ($cmd as $key => $value) {
            $sql = $sql."`$key` = :$key, ";
            $td[':'.$key] = $value;
        }
        $sql = rtrim( $sql,', ');
        $query = self::$_pdo->prepare($sql);
        $query->execute($td);
        return true;
    }

    public function H($str){
        $mdp = hash('ripemd160', $str . 'do not pass');
        return $mdp;
    }
}
 ?>
