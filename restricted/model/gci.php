<?php

require_once '../../config.php';

## GATHER CLIENT INFO  ::  CGI.PHP 

$urlUtil = new ServerUtil();
$conversationHandler = new ConversationHandler();

$response = array("response" => "no info",
    "client" => NULL,
    "validation" => "Ingrese Nombre de la empresa y un correo de contacto por favor.");

if ($urlUtil->checkRequest($_POST['id_empresa']) && $urlUtil->checkRequest($_POST['correo'])) {

    if (filter_var($_POST['correo'], FILTER_VALIDATE_EMAIL) === FALSE) {

        $response['validation'] = "Revice el correo electrónico, algo falta.";
    } else {

        $id_empresa = $_POST['id_empresa'];
        $correo = $_POST['correo'];
        $ip = $urlUtil->getClientIp();
        $hablaron = FALSE;

        $values = array($id_empresa, $ip, NULL, NULL, $hablaron, $correo);

        $conversationHandler->createNewConversacionClient($values);

        $response["response"] = "success";
        $response["client"] = $values;
        $response["validation"] = NULL;                
    }
} else {

    if ($urlUtil->checkRequest($_POST['id_empresa']) ^ $urlUtil->checkRequest($_POST['correo'])) {

        if (!($urlUtil->checkRequest($_POST['id_empresa']))) {
            $response['validation'] = "Falta el nombre de la empresa";
        }

        if (!($urlUtil->checkRequest($_POST['correo']))) {

            $response['validation'] = "Falta el correo electrónico";
        }
    }
}

echo json_encode($response);