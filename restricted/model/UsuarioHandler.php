<?php

/**
 * UsuarioHandler
 *
 * @author Esteban Rincón
 */
class UsuarioHandler {

    private $usuarioDBA;
    private $cols_vals;
    private $serverUtil;

    public function __construct() {
        $this->serverUtil = new ServerUtil();
        $this->usuarioDBA = new UsuarioDBA();
        $this->cols_vals = array(
            "usuario" => array("val" => NULL, "data_type" => PDO::PARAM_STR),
            "pwd" => array("val" => NULL, "data_type" => PDO::PARAM_STR),
            "tokn" => array("val" => NULL, "data_type" => PDO::PARAM_STR),
            "exp_date" => array("val" => NULL, "data_type" => PDO::PARAM_STR)
        );
    }

    /**
     * Creates a new conversacion ROW  in plasti.conversacion TABLE.
     * <br /><br />
     * <b>array("nombre","y2$ñalksdf$"$"#$", "y2$$kdasñflkjqñlkjfad","2016-12-31 9:11:55");</b>          
     * @param type $arrayValues A simple array that contains all table values.
     */
    public function createNewUsuario($arrayValues) {
        $this->cols_vals['usuario']['val'] = $this->serverUtil->cleanTextForInsertion($arrayValues[0]);
        $this->cols_vals['pwd']['val'] = $this->serverUtil->cleanTextForInsertion($arrayValues[1]);
        $this->cols_vals['tokn']['val'] = $this->serverUtil->cleanTextForInsertion($arrayValues[4]);
        $this->cols_vals['exp_date']['val'] = $this->serverUtil->cleanTextForInsertion($arrayValues[5]);

        $this->usuarioDBA->createUsuario($this->cols_vals);
    }

    public function getUserByToken($tokn) {
        $assoc = ["tokn" => ["val" => $tokn, "data_type" => PDO::PARAM_STR]];
        return $this->usuarioDBA->readUsuarioByData_single_as_object($assoc);
    }

    public function getUserByCredentials($usr) {
        $assoc = ["usuario" => ["val" => $usr, "data_type" => PDO::PARAM_STR]];
        return $this->usuarioDBA->readUsuarioByData_single_as_object($assoc);
    }

    public function resetTokn_Exp_date($tokn) {
        $data = array("tokn" => array("val" => NULL, "data_type" => PDO::PARAM_STR),
            "exp_date" => array("val" => NULL, "data_type" => PDO::PARAM_STR));
        $this->usuarioDBA->updateUsuario($data, $tokn, "tokn");
    }

    public function update_tokn_and_exp_date($new_tokn, $exp_date, $usr) {
        $data = array("tokn" => ['val' => $new_tokn, 'data_type' => PDO::PARAM_STR],
            "exp_date" => ['val' => $exp_date, 'data_type' => PDO::PARAM_STR]);

        $this->usuarioDBA->updateUsuario($data, $usr, "usuario");
    }

}