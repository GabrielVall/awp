<?php
session_start();
include_once("../../../m/SQLConexion.php");
$sql = new SQLConexion();

$rpta = $sql->obtenerResultadoID("CALL sp_insert_costos_km1('" . $_POST['desde'] . "','" . $_POST['hasta'] . "','" . $_POST['costo'] . "',@_ID)");

if ($rpta[0]['_ID']>0) {
    $response_array['status'] = 'success';
    $response_array['title'] = 'Costo por km';
    $response_array['message'] = 'agregado correctamente';
    $response_array['time'] = 1500;
    $response_array['id'] = $rpta[0]['_ID'];
} else {
    $response_array['status'] = 'error';
    $response_array['title'] = 'Error';
    $response_array['message'] = 'Algo salió mal, por favor intente de nuevo';
    $response_array['time'] = 3000;
}

header('Content-type: application/json');
echo json_encode($response_array);