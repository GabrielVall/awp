<?php
session_start();
include_once("../../m/SQLConexion.php");
$sql = new SQLConexion();

$rpta = $sql->obtenerResultadoSimple("CALL sp_update_ingredientes2('" . $_POST['id'] . "','0')");

if ($rpta) {

    $response_array['status'] = 'success';
    $response_array['msg'] = 'eliminado correctamente';
} else {
    $response_array['status'] = 'error';
    $response_array['msg'] = 'Algo salió mal, por favor intente de nuevo';
}

header('Content-type: application/json');
echo json_encode($response_array);