<?php

## ============================           lm.php :: LOAD MESSAGES  =========================

require_once '../../config.php';

$urlUtil = new ServerUtil();
$msgAdmin = new MessagesHandler();


if($urlUtil->checkRequest($_POST['id_empresa'])){
    
    $id_empresa =  $_POST['id_empresa'];
    
    $assoc_mensajes = $msgAdmin->getAllMessagesById_Empresa_fk($id_empresa);
    
    $resultHTML = "";
    
    foreach($assoc_mensajes as $msg){
        $resultHTML .= MsgCreator::renderMsg($msg['txt'], $msg['de_quien'], $msg['fec_msg']);
    }
    
    
    echo $resultHTML;
    
}else{
    die("no id found lm");
}