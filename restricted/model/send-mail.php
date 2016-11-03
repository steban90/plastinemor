<?php

require_once '../../config.php';

$serverUtil = new ServerUtil();
$response = array("response" => "no data found");


if ($serverUtil->checkRequest($_POST['email_empresa']) && $serverUtil->checkRequest($_POST['email_content'])) {

    $email_empresa = $_POST['email_empresa'];
    $email_content = $_POST['email_content'];


    $to = $email_empresa;
    $subject = "Plastinemor SAS";

    $message = '
    <!DOCTYPE html>
    <html>
    <body style = "padding: 0; margin: 0; background: rgb(253,253,253)">
    <a href = "http://www.plastinemor.com" style = "text-align: center;">
    <img src = "http://www.plastinemor.com/resources/img/plastinemor-ico.png"
    style = "height: 90px; display: block; margin: 10px auto;" alt = "Plastinemor"/>
    </a>
    <div style = "width: 60%; margin: 50px auto; background: white;
             border: 1px solid rgb(240,240,240); border-radius: 3px;
             padding: 15px 25px 15px 25px; -webkit-box-shadow: 0 0 45px rgba(190,190,190,.1);
             -ms-box-shadow: 0 0 45px rgba(190,190,190,.2);
             -o-box-shadow: 0 0 45px rgba(190,190,190,.2);
             -moz-box-shadow: 0 0 45px rgba(190,190,190,.2);
             box-shadow: 0 0 45px rgba(190,190,190,.2);">
    <p style = "font-family: \'Century Gothic\',sans-serif; font-size: 15px; text-align: justify;">';
    $message .= wordwrap($email_content, 70, "\r\n");
    $message .= '
    </p>
    </div>
    <a href = "http://www.plastinemor.com">
    <div style = "width: 100%; height: 100px; background: url(\'http://www.plastinemor.com/resources/img/bouquests.png\'); background-size: auto;">
    </div>
    </a>
    </body>
    </html >
    ';

    $message_final = wordwrap($message, 70, "\r\n");

    $header = "From: plastinemor@plastinemor.com \r\n";
    $header .= "Cc: plastinemor@plastinemor.com \r\n";
    $header .= "MIME-Version: 1.0\r\n";
    $header .= "Content-type: text/html; charset=UTF-8 \r\n";

    $retval = mail($to, $subject, $message_final, $header);

    if ($retval == true) {
        $response['response'] = "Correo enviado satisfactoriamente. a: " . $to;
    } else {
        $response['response'] = "Hubo un error enviando el correo, intente más tarde.";
    }
}
echo json_encode($response);


