<?php

/**
 * Description of ServerUtil
 *
 * @author Esteban Rincón
 */
class ServerUtil extends StringUtil {

    public function getClientIp() {
        return $_SERVER['REMOTE_ADDR'];
    }

    /**
     * Makes sure the request variable, i.e., $_REQUEST, $_POST or $_GET is NOT EMPTY AND SET.
     * @param type $requestVar Request variable.
     * @return type TRUE if VAR is ok, else FALSE.
     */
    public function checkRequest($requestVar) {
        return (isset($requestVar) && !empty($requestVar));
    }

    public function genTokn() {
        $aud = __SECRET_KEY__;

        if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
            $aud .= $_SERVER['HTTP_CLIENT_IP'];
        } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $aud .= $_SERVER['HTTP_X_FORWARDED_FOR'];
        } else {
            $aud .= $_SERVER['REMOTE_ADDR'];
        }

        $aud .= @$_SERVER['HTTP_USER_AGENT'];
        $aud .= gethostname();

        return sha1($aud);
    }
    
    public function getIP(){        
        if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
            return $_SERVER['HTTP_CLIENT_IP'];
        } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            return $_SERVER['HTTP_X_FORWARDED_FOR'];
        } else if(!empty ( $_SERVER['REMOTE_ADDR'])){
            return  $_SERVER['REMOTE_ADDR'];
        }else{
            return $_SERVER['HTTP_USER_AGENT'];
        }
    }
    
    public function hash_pwd_or_tokn($pwd){
        $ops = ['cost' => 15];
        return password_hash($pwd, PASSWORD_BCRYPT,$ops);
    }
    
    public function verify_passwords_match($pwd_un_hashed, $pwd_from_db){
        return password_verify($pwd_un_hashed, $pwd_from_db);
    }

}