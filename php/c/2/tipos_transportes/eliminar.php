<?php
session_start();
include_once("../../../m/SQLConexion.php");
$sql = new SQLConexion();

$rpta = $sql->obtenerResultadoSimple("CALL sp_update_tipo_transporte2('" . $_POST['id'] . "','0')");

if ($rpta) {
    $response_array['status'] = 'success';
    $response_array['title'] = 'Tipo  de transporte';
    $response_array['message'] = 'eliminado correctamente';
    $response_array['time'] = 1500;
} else {
    $response_array['status'] = 'error';
    $response_array['title'] = 'Error';
    $response_array['message'] = 'Algo salió mal, por favor intente de nuevo';
    $response_array['time'] = 3000;
}

header('Content-type: application/json');
echo json_encode($response_array);
