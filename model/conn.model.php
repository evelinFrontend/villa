<?php
class DataBase{
    private static $host = 'localhost';
    private static $user = 'root';
    private static $pass = ''; 
    private static $dbname = 'villa_campestre';
    private static $status = null;
    public function openDB(){
      if (self::$status == null){
        try {
          self::$status = new PDO('mysql:host='.self::$host.';dbname='.self::$dbname.';charset=utf8',self::$user,self::$pass, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));
          self::$status-> exec("SET CHARACTER utf8");
          return self::$status;
        } catch (PDOException $e) {
            die($e->getMessage());
        }
          return self::$status;
      }
    }
    public function close(){
      self::$status = null;
    }
    public function getName(){
      return self::$dbname;
    }
}
?>