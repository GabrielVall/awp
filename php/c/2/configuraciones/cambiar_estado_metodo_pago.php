<?php
session_start();
include_once("../../../m/SQLConexion.php");
$sql = new SQLConexion();

$rpta = $sql->obtenerResultadoSimple("CALL sp_update_empresa_metodo_pago1('" . $_POST['id_empresa_metodo_pago'] . "','" . $_POST['estado'] . "')");

if ($rpta) {
    $response_array['status'] = 'success';
    $response_array['title'] = 'Método de pago';
    $response_array['message'] = 'actualizado correctamente';
    $response_array['time'] = 1000;
} else {
    $response_array['status'] = 'error';
    $response_array['title'] = 'Error';
    $response_array['message'] = 'por favor inténtelo de nuevo';
    $response_array['time'] = 3000;
}

header('Content-type: application/json');
echo json_encode($response_array);
