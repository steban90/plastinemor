<?php
require_once '../../config.php';

# ==================   spm.php  :::  SEND PLASTINEMOR MESSAGE

$serverUtil = new ServerUtil();
$msgHandler = new MessagesHandler();

if($serverUtil->checkRequest($_POST['id_empresa']) && $serverUtil->checkRequest($_POST['txt'])){
    
    $id_empresa = $_POST['id_empresa'];
    $txt = $_POST['txt'];
    $de_quien = "Plastinemor";
    $para_quien = $id_empresa;
    
    $msgValues = array(NULL,$id_empresa,$txt,$de_quien,$para_quien);
    
    $msgHandler->createNewMensajeClient($msgValues);
    
    echo date("l j F Y g:ia");
    
}