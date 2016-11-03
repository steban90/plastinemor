<?php

require_once '../../config.php';

$serverUtil = new ServerUtil();
$archivosHandler = new ArchivosHandler();

$response = array("response" => "wrong file type", "saved_file_name" => NULL);


if (isset($_FILES['file']['type']) && $serverUtil->checkRequest($_POST['id_empresa'])) {

    $validExtensions = ['jpeg', 'jpg', 'png', 'txt', 'gif', 'pdf', 'docx', 'docm', 'dotx', 'dotm', 'docb', 'ppt',
        'xls', 'xlsm', 'xlsx', 'dot', 'doc', 'xltx', 'xstm', 'ppt', 'pptm', 'potx', 'sldm'];

    $valid_types = ["application/pdf",
        "application/vnd.openxmlformats-officedocument.wordprocessingml.document",
        "text/plain", "image/jpeg", "image/jpg", "image/png", "image/gif", "application/vnd.ms-excel",
        "application/vnd.openxmlformats-officedocument.presentationml.presentation", "application/msword",
        "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet"];

    $fname = $_FILES['file']['name'];
    $fname_extension = explode(".", $fname);
    $file_extension = end($fname_extension);

    $id_empresa = $_POST['id_empresa'];
    $rootpath = $_SERVER['DOCUMENT_ROOT'] . "/restricted/files/";
    $new_fname = $rootpath . $fname;

    if (in_array($file_extension, $validExtensions) && in_array($_FILES['file']['type'], $valid_types)) {

        if (file_exists($new_fname)) {
            
            $rand_fname = rand(100, 999) . $fname;
            $response["response"] = "success";
            $response["saved_file_name"] = $rand_fname;
            move_uploaded_file($_FILES['file']['tmp_name'], $rootpath.$rand_fname);            
            $archivosHandler->createNewArchivo([$rand_fname, $id_empresa, $file_extension, $_FILES['file']['type']]);
        } else {

            $response["response"] = "success";
            $response["saved_file_name"] = $fname;

            move_uploaded_file($_FILES['file']['tmp_name'], $new_fname);
            $archivosHandler->createNewArchivo([$fname, $id_empresa, $file_extension, $_FILES['file']['type']]);
        }
    }
}
echo json_encode($response);
