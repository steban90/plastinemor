<?php
/**
 * MessagesHandler
 *
 * @author Esteban Rincón
 */
class MessagesHandler {
    
    private $mensajesDBAdmin;    
    private $cols_vals;

    public function __construct() {
        $this->mensajesDBAdmin = new MensajesAdministrator();        
        $this->cols_vals = array(
            "fec_msg" => array("val" => NULL, "data_type" => PDO::PARAM_STR),
            "id_empresa" => array("val" => NULL, "data_type" => PDO::PARAM_STR),
            "txt" => array("val" => NULL, "data_type" => PDO::PARAM_STR),
            "de_quien" => array("val" => NULL, "data_type" => PDO::PARAM_STR),
            "para_quien" => array("val" => NULL, "data_type" => PDO::PARAM_STR)
        );
    }
    
    
    /**
     * Creates a NEW mensajes ROW  in plasti.mensajes TABLE.
     * <br /><br />
     * <b>array(NULL,"Learn2Program","hola ...", "Plastinemor","Learn2Program");</b>     
     * The NULLs are set automatically, normally they are dates which use the CURRENT_TIMESTAMP value.
     * @param type $arrayValues A simple array that contains all table values.
     */
    public function createNewMensajeClient($arrayValues){            
        
            $this->cols_vals['id_empresa']['val'] = $arrayValues[1];
            $this->cols_vals['txt']['val'] = $arrayValues[2];
            $this->cols_vals['de_quien']['val'] = $arrayValues[3];
            $this->cols_vals['para_quien']['val'] = $arrayValues[4];
            
            $this->mensajesDBAdmin->createMensaje($this->cols_vals);
    }
    
    public function getAllMessagesById_Empresa_fk($id){
        
        $id_assoc = array("id_empresa" => array("val" => $id, "data_type" => PDO::PARAM_STR));
        return $this->mensajesDBAdmin->readMensajeByData($id_assoc);
    }
    
    /**
     * Gets id,id_empresa,num_mensajes FROM mensajes.
     * @return ASSOC
     */
    public function getCountMessagesByClient(){
        $query = "SELECT id,id_empresa,count(id_empresa) AS num_mensajes from mensajes GROUP BY(id_empresa)";
        $dbcon = $this->mensajesDBAdmin->getCon();        
        $statement = $dbcon->prepare($query);
        $statement->execute();        
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }
}