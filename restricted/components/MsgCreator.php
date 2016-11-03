<?php

class MsgCreator {

    /**
     * Creates an HTML message for the .message-container in the chat.
     *        
     * @param type $content Content of the message.
     * @param type $from    Who sent the message. this determines the .*-msg class to use [client-msg or plasti-msg]
     * @param type $timeSent The to show it in the HTML object <cite>..
     */
    public static function renderMsg($content, $from, $timeSent) {

        // set local to spanish to render date                      
        $msg_attr_class = "client-msg";
        $sanitizedContent = htmlentities($content);

        // render date; e.g.: viernes 31 de Octubre de 1999
        $dateFormated = date("l j F Y g:ia", strtotime($timeSent));

        if (strtolower($from) === "plastinemor") {
            $msg_attr_class = "plasti-msg";
        }

        $render = '<div class="' . $msg_attr_class . ' chat-msg">';
        $render .= '<p>' . $sanitizedContent . '</p>';
        $render .= '<cite>' . $dateFormated . '</cite>';
        $render .='</div>';

        return $render;
    }

    public static function renderNewAdminListItem($nombreEmpresa) {

        $new_chat_list_item = "";
        $new_chat_list_item .= '<div class = "list-group no-pad">';
        $new_chat_list_item .= '<button type = "button" class = "list-group-item list-group-item-action admin-chat-list-item">';
        $new_chat_list_item .= '<h5 class = "list-group-item-heading bold pull-left">' . $nombreEmpresa . '</h5>';
        $new_chat_list_item .= '<span class = "pull-right tag" data-init-msg="0">0</span>';
        $new_chat_list_item .= '</button>';
        $new_chat_list_item .= '</div> ';

        return $new_chat_list_item;
    }

    public static function renderArchivo($id_empresa, $nombre_archivo) {
        $archivo_link = "";

        $archivo_link .= '<tr> ';
        $archivo_link .= '<td>'.$id_empresa.'</td>';
        $archivo_link .= '<td><a href = "restricted/files/'.$nombre_archivo.'">'.$nombre_archivo.'</a></td>';
        $archivo_link .= '</tr>';
        
        return $archivo_link;
    }

}
