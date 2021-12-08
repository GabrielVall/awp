<?php
session_start();

$ruta = '../../../../Bx_panel/img/' . $_POST['carpeta'] . '/' . $_POST['sub_carpeta'];
if (!file_exists($ruta)) {
    mkdir($ruta);
}

if ($_POST['request'] == "add_mensualidad_transferencia") {
    $nombre_archivo = $_FILES['file']['name'];
    $tipo_archivo = $_FILES['file']['type'];
    $tamano_archivo = $_FILES['file']['size'];
    $tmp_archivo = $_FILES['file']['tmp_name'];
    $archivador = $ruta . "/" . $nombre_archivo;

    if (!empty($_FILES)) {

        if(move_uploaded_file($tmp_archivo, $archivador)){
            echo 1;
        }
        else{
            echo 0;
        }
    }
}