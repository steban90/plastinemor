<?php
require_once '../../config.php';
# ================  credm.php :: CREDENTIALS MODEL
$serverUtil = new ServerUtil();
$iauth = new Auth();

$response = array("response" => NULL,"remember_me"=>NULL);

if ($serverUtil->checkRequest($_POST['usuario']) && $serverUtil->checkRequest($_POST['pwd'])) {
    
    $usr = $_POST['usuario'];
    $pwd = $_POST['pwd'];       
        
    $are_credentials_good = $iauth->authenticate($usr, $pwd);   
    
    $response['response'] = ($are_credentials_good) ? "ok" : "fail";
    
    // set expire date if remember_me was checked
    
    if(isset($_POST['remember_me']) && $_POST['remember_me'] = "si" && $are_credentials_good){
        
        // ==============   CHANGE TO 15 DAYS in production
        $iauth->rememberUser($usr, Auth::DATETIME_ADD_15_DAYS);      
        $response['remember_me'] = "yes";        
    }
    
    if($are_credentials_good){
        $iauth->startUserSess($usr);
    }
    
         
}
echo json_encode($response);