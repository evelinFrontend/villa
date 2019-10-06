<?php
/*
@user: Cristian Lopera
@dateCreate:20/06/2017
*/
//requerir otros modelos
// require_once "procedure.model.php";
//añadir todas las clases a la variable main
function masterModel(){
  $main = new MasterModel();
//   $main->procedure = new ProcedureModel;
  return $main;
}
class MasterModel{
    protected $pdo;
    protected $sql;
    //acceso a conexion de base de datos
    public  function __CONSTRUCT(){
      try {
          $this->pdo=DataBase::openDB();
          $this->pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
      } catch (PDOException $e) {
          die($e->getMessage());
      }
    }
    function columnsOfTable($table,$skip = null){
         try {
            $dbname= DataBase::getName();
            $sql="SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_NAME = '$table'  AND table_schema = '$dbname'";
            $query=$this->pdo->prepare($sql);
            $query->execute();
            $result = $query->fetchAll(PDO::FETCH_BOTH);
            $columns=" ";
            $i=0;
            foreach ($result as $row) {
                if ($row[0]==$skip[$i]) {
                    if ($i<(count($skip)-1)) {
                       $i++;
                    }
                }else{
                    $columns.=$row[0].",";
                }
            }
            $result=$columns;
            $result = substr($result, 0, -1);
        } catch (PDOException $e) {
            $result = $e->getMessage();
        }
        return $result;
    }
    //saber el numero de  comodines
    public function comodines($comodines){
        $resultComodines="";
        foreach ($comodines as $como) {
            $resultComodines.="?,";
        }
        $resultComodines = substr($resultComodines, 0, -1);
        return $resultComodines;
    }
    //saber los valores
    public function values($valores){
        $i=0;
         // $resultado = count($valores);
         $resultValues="";
        foreach ($valores as $value) {
            $resultValues.= $value.",";
            $i=$i+1;
        }
        $resultValues = substr($resultValues, 0, -1);
        return $resultValues;
    }
    //insertar en una tabla
    public function insert($table,$values,$exeption = null){
        try {
            $cols=$this->columnsOfTable($table,$exeption);
            $comodines=$this->comodines($values);
            //convertir en string
            // $vals=$this->values($values);
            // $vals = explode(",",$vals);
            $this->sql="INSERT INTO $table($cols) VALUES ($comodines)";
            // die($this->sql);
            $query=$this->pdo->prepare($this->sql);
            $query->execute($values);
            $result = true;
        } catch (PDOException $e) {
            error_log("Crear Usuario -".date("Y-m-d H:i:s")."-".$e->getMessage()." REQUEST ".$this->sql." VALORES ".implode($vals,"||")."\r\n",3,"errores.log");
            $result = false;
        }
       return $result;
    }
    //CONSULTA GENERAL
    public function selectAll($table){
        try {
            $this->sql="SELECT * FROM $table";
            $query=$this->pdo->prepare($this->sql);
            $query->execute();
            $result = $query->fetchAll(PDO::FETCH_OBJ);
        } catch (PDOException $e) {
            $result  = false;
            error_log("Buscar -".date("Y-m-d H:i:s")."-".$e->getMessage()." REQUEST ".$this->sql." VALORES ".implode($data,"||")."\r\n",3,"errores.log");
        }
        return $result;
    }
    public function sqlSelect($sql,$data){
        try {
            $this->sql=$sql;
            $query=$this->pdo->prepare($this->sql);
            $query->execute($data);
            $result = $query->fetchAll(PDO::FETCH_OBJ);
        } catch (PDOException $e) {
            $result  = false;
            error_log("Crear SQL SELECT -".date("Y-m-d H:i:s")."-".$e->getMessage()." REQUEST ".$this->sql." VALORES ".implode($data,"||")."\r\n",3,"errores.log");
        }
        return $result;
    }
    public function sql($sql,$data){
        try {
            $this->sql=$sql;
            $query=$this->pdo->prepare($this->sql);
            $query->execute($data);
            $result = true;
        } catch (PDOException $e) {
            $result  = false;
            error_log("Crear Usuario -".date("Y-m-d H:i:s")."-".$e->getMessage()." REQUEST ".$this->sql." VALORES ".implode($data,"||")."\r\n",3,"errores.log");
        }
        return $result;
    }
    
    public function selectAllBy($table,$condition){
        try {
            $this->sql="SELECT * FROM $table WHERE $condition[0] = ?";
            $query=$this->pdo->prepare($this->sql);
            $query->execute(array($condition[1]));
            $result = $query->fetchAll(PDO::FETCH_OBJ);
        } catch (PDOException $e) {
            $result = $e->getMessage();
        }
        return $result;
    }
    public function selectBy($table,$condition){
        try {
            $vals=$this->values($condition);
            $vals = explode(",",$vals);
            $this->sql="SELECT * FROM $table WHERE $vals[0] = ?";
            $query=$this->pdo->prepare($this->sql);
            $query->execute(array($vals[1]));
            $result = $query->fetch(PDO::FETCH_OBJ);
        } catch (PDOException $e) {
            $result = $e->getMessage();
        }
        return $result;
    }
    public function delete($table,$condition){
        try {
            $vals=$this->values($condition);
            $vals = explode(",",$vals);
            $this->sql="DELETE  FROM $table WHERE $vals[0] = ?";
            $query=$this->pdo->prepare($this->sql);
            $query->execute(array($vals[1]));
            $result = true;
        } catch (Exception $e) {
            $result = false;
            error_log("Eliminar-".date("Y-m-d H:i:s")."-".$e->getMessage()." REQUEST ".$this->sql." VALORES ".implode($condition,"||")."\r\n",3,"errores.log");
        }
        return $result;
    }
}
 ?>
