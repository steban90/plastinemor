<?php

/**
 * Auth authentication service.
 *
 * @author Esteban Rincón
 */
class Auth implements IAuth {

    private $usuarioHandler;
    private $serverUtil;
    private $tokn;
    private $usuario_name;

    const DATETIME_ADD_10_MIN = "PT10M";
    const DATETIME_ADD_15_DAYS = "P15D";

    public function __construct() {
        $this->usuarioHandler = new UsuarioHandler();
        $this->serverUtil = new ServerUtil();
        $this->tokn = $this->serverUtil->genTokn();
        $this->setUsuario_name($this->tokn);
    }

    public function setUsuario_name($token) {
        $resultObj = $this->usuarioHandler->getUserByToken($token);

        if (is_object($resultObj)) {
            $this->usuario_name = $resultObj->usuario;
        } else {
            $this->usuario_name = "DEFAULT_USER";
        }
    }

    public function getUsuario_name() {
        return $this->usuario_name;
    }

    public function authenticate($usr, $pwd) {

        $usrObj = $this->usuarioHandler->getUserByCredentials($usr);

        if (!is_object($usrObj) && $usrObj === FALSE) {
            return false;
        }

        return $this->serverUtil->verify_passwords_match($pwd, $usrObj->pwd);
    }

    /**
     * Go to db and set TOKN and EXP_DATE to NULL.
     */
    public function destroyByTokn() {
        $this->usuarioHandler->resetTokn_Exp_date($this->tokn);
        unset($_SESSION['plasti_usuario']);
        unset($_SESSION['plasti_validate']);
    }
    
    public function logout(){
        $this->destroyByTokn();
        header("Refresh:0");
    }

    /**
     * Validate that the token is NOT expired
     * @return boolean <b>TRUE</b> if is authenticated, else FALSE.
     */
    public function isAuthenticated() {
        // gen Tokn        
        $usrObj = $this->usuarioHandler->getUserByToken($this->tokn);

        if ($usrObj === FALSE) {
            return false;
        }

        $exp_date = new DateTime($usrObj->exp_date);
        $cur_date = new DateTime();

        return ($exp_date > $cur_date);
    }

    /**
     * If checkbox is checked i.e., "remember_me" then set a new TOKN and EXP_DATE.
     * 
     * <b style="color: orange;">Note:</b><b>exp_date default is 15 days</b>
     * 
     * @param type $usr  Username, since this column is the PRIMARY KEY
     * @param type $exp_date  Expire date of the tokn.
     */
    public function rememberUser($usr, $exp_date = self::DATETIME_ADD_15_DAYS) {

        // create current time
        $new_exp_date = new DateTime();

        // add the time to expire
        $new_exp_date->add(new DateInterval($exp_date));

        // convert to be able to store in DB  
        $expires = $new_exp_date->format("Y-m-d H:i:s");

        $this->usuarioHandler->update_tokn_and_exp_date($this->tokn, $expires, $usr);
    }

    public function startUserSess($usr) {
        $client_ip = $this->serverUtil->getClientIp();
        $_SESSION["plasti_usuario"] = $usr;
        $_SESSION["plasti_validate"] = password_hash($usr . $client_ip, PASSWORD_BCRYPT, ["cost" => 7]);
    }

    public function is_user_sess_valid() {
        if (isset($_SESSION["plasti_usuario"]) && isset($_SESSION['plasti_validate'])) {
            $check = $_SESSION['plasti_usuario'] . $this->serverUtil->getClientIp();
            return $this->serverUtil->verify_passwords_match($check, $_SESSION['plasti_validate']);
        }
        return false;
    }

}