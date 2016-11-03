<?php

/**
 * Description of ArchivosHandler
 *
 * @author Esteban Rincón
 */
class ArchivosHandler {

    private $archivodDBA;
    private $cols_vals;

    public function __construct() {
        $this->archivodDBA = new ArchivosAdministrator();
        $this->cols_vals = array(
            "file_name" => array("val" => NULL, "data_type" => PDO::PARAM_STR),
            "id_empresa" => array("val" => NULL, "data_type" => PDO::PARAM_STR),
            "file_extension" => array("val" => NULL, "data_type" => PDO::PARAM_STR),
            "file_type" => array("val" => NULL, "data_type" => PDO::PARAM_STR)
        );
    }

    /**
     * Creates a NEW archivo ROW  in plasti.archivo TABLE.
     * <br /><br />
     * <b>array(file_name,id_empresa,file_extension,file_type);</b>          
     * @param type $arrayValues A simple array that contains all table values.
     */
    public function createNewArchivo($arrayValues) {

        $this->cols_vals['file_name']['val'] = $arrayValues[0];
        $this->cols_vals['id_empresa']['val'] = $arrayValues[1];
        $this->cols_vals['file_extension']['val'] = $arrayValues[2];
        $this->cols_vals['file_type']['val'] = $arrayValues[3];

        $this->archivodDBA->createArchivo($this->cols_vals);
    }

    public function getArchivoByName($file_name) {
        $assoc_array = ['file_name' => array('val' => $file_name, 'data_type' => PDO::PARAM_STR)];

        return $this->archivodDBA->readArchivoByData($assoc_array);
    }

    public function getAllArchivos() {
        return $this->archivodDBA->readAllArchivo();
    }

}
