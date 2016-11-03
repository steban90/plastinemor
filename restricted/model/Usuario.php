<?php

/**
 * Usuario i.e, db entity
 *
 * @author Esteban Rincón
 */
class Usuario {

    private $usuario;
    private $pwd;
    private $tokn;
    private $exp_date;

    public function __construct() {
        
    }
    
    function getUsuario() {
        return $this->usuario;
    }

    function getPwd() {
        return $this->pwd;
    }

    function getTokn() {
        return $this->tokn;
    }

    function getExp_date() {
        return $this->exp_date;
    }

    function setUsuario($usuario) {
        $this->usuario = $usuario;
    }

    function setPwd($pwd) {
        $this->pwd = $pwd;
    }

    function setTokn($tokn) {
        $this->tokn = $tokn;
    }

    function setExp_date($exp_date) {
        $this->exp_date = $exp_date;
    }

}