<?php

#============== lali.php :: LOAD ADMIN LIST ITEMS

require_once '../../config.php';

$urlUtil = new ServerUtil();
$conversacionHandler = new ConversationHandler();        

$admin_list_items = "";
$assoc_conversaciones = $conversacionHandler->getAllConversations();

$li_count = count($assoc_conversaciones);

$map_empresa_email = array();

foreach ($assoc_conversaciones as $conversacion){
    
    $admin_list_items .= MsgCreator::renderNewAdminListItem($conversacion['id_empresa']);
    $map_empresa_email[] = array($conversacion['id_empresa'],$conversacion['correo']);
    
}

$assoc_response = array("li_count"=>$li_count,"li_dom"=>$admin_list_items,"map_empresa_email"=>$map_empresa_email);
echo json_encode($assoc_response);