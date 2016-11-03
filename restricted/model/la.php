<?php

#========== la.php :: LOAD ARCHIVOS

require_once '../../config.php';


$archivosHandler = new ArchivosHandler();

$archivos = $archivosHandler->getAllArchivos();

$response = "";

foreach($archivos as $archivo){
    
    $response .= MsgCreator::renderArchivo($archivo['id_empresa'], $archivo['file_name']);
    
}
echo $response;