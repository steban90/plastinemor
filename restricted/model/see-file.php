<?php

if (isset($_GET['file-download'])) {

    $file_url = 'http://localhost/' . $_GET['file-download'];
    header('Content-Type: application/octet-stream');
    header("Content-Transfer-Encoding: Binary");
    header("Content-disposition: attachment; filename=\"" . basename($file_url) . "\"");
    readfile($file_url);
}

