<?php

/**
 * ConversationHandler processes all info regarding its table.
 *
 * @author Esteban Rincón
 */
class ConversationHandler {

    private $conversacionDBAdmin;
    private $serverUtil;
    private $cols_vals;

    public function __construct() {
        $this->conversacionDBAdmin = new ConversacionAdministrator();
        $this->serverUtil = new ServerUtil();
        $this->cols_vals = array(
            "id_empresa" => array("val" => NULL, "data_type" => PDO::PARAM_STR),
            "ip_empresa" => array("val" => NULL, "data_type" => PDO::PARAM_STR),
            "fecha_inicio" => array("val" => NULL, "data_type" => PDO::PARAM_STR),
            "fecha_ultimo_mensaje" => array("val" => NULL, "data_type" => PDO::PARAM_STR),
            "hablaron" => array("val" => NULL, "data_type" => PDO::PARAM_BOOL),
            "correo" => array("val" => NULL, "data_type" => PDO::PARAM_STR)
        );
    }
    
    
    /**
     * Creates a new conversacion ROW  in plasti.conversacion TABLE.
     * <br /><br />
     * <b>array("nombre empresa","789.789.789.799",NULL,NULL,FALSE,"empresa@dominio.com");</b>     
     * The NULLs are set automatically
     * @param type $arrayValues A simple array that contains all table values.
     */
    public function createNewConversacionClient($arrayValues){
            $this->cols_vals['id_empresa']['val'] = $arrayValues[0];
            $this->cols_vals['ip_empresa']['val'] = $arrayValues[1];
            $this->cols_vals['hablaron']['val'] = $arrayValues[4];
            $this->cols_vals['correo']['val'] = $arrayValues[5];
            
            $this->conversacionDBAdmin->createConversacion($this->cols_vals);
    }
    
    public function getAllConversations(){
        return $this->conversacionDBAdmin->readAllConversacion();
    }
    
    /**
     * Verifies that the client requesting a chat already as an ip in db,
     * if the ip exists it grap the conversation object.
     * @return boolean|ArrayObject  FALSE or Conversacion Object
     */
    public function verifyClientByIp() {
        $ip = $this->serverUtil->getClientIp();

        $data = array(
            "ip_empresa" => array("val" => "$ip", "data_type" => PDO::PARAM_STR)
        );
        $result = $this->conversacionDBAdmin->readConversacionByData($data);        
        
        if (count($result) > 0) {
            return $result;
        } else {
            return FALSE;
        }                
    }

}