<?php

require_once '../../config.php';

$serverUtil = new ServerUtil();

$new_chat_window = '';

if ($serverUtil->checkRequest($_POST['id_empresa'])) {
        
    $nombreEmpresa = $_POST['id_empresa'];
    $new_chat_window .= '<div class="admin-chat-window col-xs-12 col-sm-8 col-md-6 col-lg-4 no-pad">';
    $new_chat_window .= '<div class="panel panel-primary">';
    $new_chat_window .= '<div class="panel-heading admin-chat-window-header clearfix">';
    $new_chat_window .= '<h5 class="panel-title pull-left">'.$nombreEmpresa.'</h5>';
    $new_chat_window .= '<button type="button" class="close pull-right">&times;</button>';
    $new_chat_window .= '<div class="clearfix"></div>';
    $new_chat_window .= '</div>';
    $new_chat_window .= '<div class="panel-body no-pad">';
    $new_chat_window .= '<div class="container-fluid admin-chat-window-messages-container">';
    $new_chat_window .= '</div>';
    $new_chat_window .= '<div class="admin-chat-window-input-container">';
    $new_chat_window .= '<form class="admin-chat-messages-form"> ';
    $new_chat_window .= '<input type="hidden" name="id_empresa" value="'.$nombreEmpresa.'" />';
    $new_chat_window .= '<div class="col-xs-10 no-pad">';
    $new_chat_window .= '<input type="text" class="form-control" name="txt" placeholder="Escriba su mensaje.." required="true"/>';
    $new_chat_window .= '</div>';
    $new_chat_window .= '<div class="col-xs-2 no-pad">';
    $new_chat_window .= '<button type="submit" class="btn btn-flat btn-success btn-block">';
    $new_chat_window .= '<span class="glyphicon glyphicon-send" aria-hidden="true"></span>';
    $new_chat_window .= '</button>';
    $new_chat_window .= '</div>                                        ';
    $new_chat_window .= '</form>';
    $new_chat_window .= '</div>';
    $new_chat_window .= '</div>';
    $new_chat_window .= '</div>';
    $new_chat_window .= '</div> ';


    echo $new_chat_window;
} else {
    echo "<p class='bg-error'>No id_empresa found</p>";
}