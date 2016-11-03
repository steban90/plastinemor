<?php
session_start();
date_default_timezone_set("America/Bogota");

require_once 'restricted/util/constants.php';
require_once 'restricted/util/StringUtil.php';
require_once 'restricted/util/ServerUtil.php';
require_once 'restricted/util/UrlUtil.php';
require_once 'restricted/components/MenuItem.php';
require_once 'restricted/model/DBConector.php';
require_once 'restricted/model/AbstractDBHandler.php';
require_once 'restricted/model/DBAdministrator.php';
require_once 'restricted/model/ConversacionAdministrator.php';
require_once 'restricted/model/ConversationHandler.php';
require_once 'restricted/model/MensajesAdministrator.php';
require_once 'restricted/model/MessagesHandler.php';
require_once 'restricted/model/IAuth.php';
require_once 'restricted/model/Auth.php';
require_once 'restricted/model/Usuario.php';
require_once 'restricted/model/UsuarioDBA.php';
require_once 'restricted/model/UsuarioHandler.php';
require_once 'restricted/model/ArchivosAdministrator.php';
require_once 'restricted/model/ArchivosHandler.php';
require_once 'restricted/components/MsgCreator.php';
//require_once 'restricted/model/chat-init.php';

?>