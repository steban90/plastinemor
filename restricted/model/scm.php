<?php

require_once '../../config.php';

# ========================= scm.php :: SEND CLIENT MESSAGE  ==========================

$serverUtil = new ServerUtil();
$msgHandler = new MessagesHandler();

if($serverUtil->checkRequest($_POST['id_empresa']) && $serverUtil->checkRequest($_POST['txt'])){
    
    $id_empresa = $_POST['id_empresa'];
    $txt = $_POST['txt'];
    $de_quien = $id_empresa;
    $para_quien = "Plastinemor";
    
    
    $txt_sanitized = StringUtil::cleanTextForShow($txt);
    
    $msgValues = array(NULL,$id_empresa,$txt,$de_quien,$para_quien);
    
    $msgHandler->createNewMensajeClient($msgValues);
    
    $cur_date =  date("l j F Y g:ia");
    
    echo json_encode(["date"=> $cur_date,"txt_sanitized" => $txt_sanitized]);
    
}