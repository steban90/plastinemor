<?php

abstract class DBAdministrator implements AbstractDBHandler {    

    protected $dbcon;

    function __construct() {
        $this->dbcon = DBConector::getPdoInstance();
    }

    /**
     * INSERTS into plasti db
     * <br />
     * e.g.:
     * 
     * <b>$tableName = "users"; </b><br />
     * <b>$data = array("name" => "Esteban Rincón", "phone" => "1234567");</b><br />
     * <b> create($tableName,$data);</b><br />
     * <i>The resulting code with this array would be:</i><br />
     * 
     * <b>$query = "INSERT INTO `users`(name,phone) VALUES(:name,:phone)";</b><br />
     * <b>$statement = dbcon->prepare($query);</b><br />
     * <b>$statement->execute( array("name" => "Esteban Rincón", "phone" => "1234567") );</b><br />
     * 
     *     
     * @param type $tablename name of the table to insert into
     * @param type $dataASSOC  ASSOCIATIVE array containing the columns and values, <br />
     */
    public function create($tablename, $dataASSOC) {

        $cols = $this->stringFromArray($dataASSOC, FALSE);
        $stmts = $this->stringFromArray($dataASSOC, TRUE);
        $query = "INSERT INTO `$tablename`($cols) VALUES($stmts)";
        $statement = $this->dbcon->prepare($query);
        if ($this->bindMultipleParams($dataASSOC, $statement) === FALSE) {
            throw new Exception("Error binding multiple params ");
        }
//        $statement->debugDumpParams(); FOR DEBUGGING 
        $statement->execute();
    }

    public function delete($table, $id, $idkey) {
        $query = "DELETE FROM `$table` WHERE $idkey = :$idkey";
        $statement = $this->dbcon->prepare($query);
        $statement->bindParam(":$idkey", $id);
        $statement->execute();
    }

    public function readAll($table, $orderByClause) {
        $query = "SELECT * FROM `$table` $orderByClause";
        $statement = $this->dbcon->prepare($query);
        $statement->execute();
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }   

    public function readByData($table, $data, $sortClause) {
        $whereclause = $this->whereClauseFromArray($data);                        
        $query = "SELECT * FROM `$table` WHERE $whereclause $sortClause";
        $statement = $this->dbcon->prepare($query);
        $statement = $this->bindMultipleParams($data, $statement);
        if ($statement === FALSE) {
            throw new Exception("Error binding multiple params DBAdministrator.php:63");
        }
//        $statement->debugDumpParams();  FOR DEBUGGING
        $statement->execute();
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
    
    public function readByData_single_as_object($table, $data, $sortClause) {
        $whereclause = $this->whereClauseFromArray($data);                        
        $query = "SELECT * FROM `$table` WHERE $whereclause $sortClause";
        $statement = $this->dbcon->prepare($query);
        $statement = $this->bindMultipleParams($data, $statement);
        if ($statement === FALSE) {
            throw new Exception("Error binding multiple params DBAdministrator.php:77");
        }
//        $statement->debugDumpParams();  FOR DEBUGGING
        $statement->execute();
        $result = $statement->fetch(PDO::FETCH_OBJ);
        return $result;
    }    

    public function readById($table, $id, $idkey) {
        
    }

    public function update($table, $data, $id, $idkey) {
        
        $sth = $this->updateClauseFromArray($data);
        $query = "UPDATE $table SET $sth WHERE $idkey = :$idkey";
        $statement = $this->dbcon->prepare($query);
        $statement = $this->bindMultipleParams($data, $statement);
        $statement->bindParam(":$idkey", $id);
        if($statement === FALSE){
            throw new Exception("Error binding multiple params in DBAdministrator.php:96");
        }
//        $statement->debugDumpParams(); 
        $statement->execute();                
    }

    /**
     * Creates a WHERE clause from an ASSOC_ARRAY. i.e:
     * 
     * $assoc_array = array("name" => "esteban", "lname" => "rincon");
     * 
     * <b>The result:</b> <i>'name = :name AND lname = :lname';</i>
     * 
     * @param type $assoc
     * @return type String
     */
    public static function whereClauseFromArray($assoc) {
        $clause = "";
        foreach ($assoc as $k => $v) {            
            $clause .= " $k = :$k AND";
        }
        return rtrim($clause, 'AND');
    }

    public static function updateClauseFromArray($assoc) {
        $clause = "";
        foreach ($assoc as $k => $v) {            
            $clause .= " $k = :$k,";
        }
        return rtrim($clause, ',');
    }
    
    

    protected function stringFromArray($array, $getKeys) {
        if ($getKeys) {
            $keys = "";
            foreach ($array as $key => $val) {
                $keys .= ":$key,";
            }
            return rtrim($keys, ',');
        } else {
            $str = "";
            foreach ($array as $k => $v) {
                $str .= "$k,";
            }
            return rtrim($str, ',');
        }
    }

    /**
     * Binds multiple parameters with different PARAM_*  data types.
     * 
     * <b style="color: red">IMPORTANT:</b> the array has to have the following structure:<br /><br />
     * <i>array("colum_name" => array("val" => "[colum_value]","data_type" => [PDO::PARAM_*] ))</i>
     * @param type $multidimarray the multidimensional array containing column names, data and data types.
     * @param PDOStatement $statement The PDOStatement currently working when this method is called.
     * @return boolean|\PDOStatement returns the statement or <b>FALSE</b> if error
     */
    protected function bindMultipleParams($multidimarray, PDOStatement $statement) {
        try {
            foreach ($multidimarray as $key => $innerArray) {
                $statement->bindParam($key, $innerArray['val'], $innerArray['data_type']);
            }
            return $statement;
        } catch (PDOException $e) {
            print "Error!: " . $e->getMessage() . "<br/>";
            die();
            return FALSE;
        }
    }
    
    public function getCon(){
        return $this->dbcon;
    }

}