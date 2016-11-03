<?php
require_once '../../config.php';

$ip = $_SERVER['REMOTE_ADDR'];

$conversationHandler = new ConversationHandler();

$result = $conversationHandler->verifyClientByIp();

if($result === FALSE){
    echo json_encode(array("response" => "new", "ip" => $ip));
}else{
    echo json_encode(array("response" => "old", "client" => $result));
}