<?php
require __DIR__ . '/Classes/Autoload.php';

if (!isset($_FILES["userfile"])) {
    echo 'Problemas, sem arquivo';
    exit();
}

$upload  = new Upload();
$retorno = $upload->retornaUpload($_FILES);

if ($retorno["move"] != 1) {
    echo json_encode($retorno);
    exit();
}

$fileName        = $_FILES["userfile"]["name"];
$pathComplete    = __DIR__ . "/files_upload/" . $fileName;
$stringXml       = new XmltoString($pathComplete);
$convertedBase64 = new Apidanfe($stringXml->converted);
echo  $convertedBase64->returnBase64;
