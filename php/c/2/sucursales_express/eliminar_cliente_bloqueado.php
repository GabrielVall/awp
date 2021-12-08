<?php
session_start();
include_once("../../../m/SQLConexion.php");
$sql = new SQLConexion();

$rpta = $sql->obtenerResultadoSimple("CALL sp_update_clientes_bloqueados_sucursales_express1('" . $_POST['id'] . "','0')");

if ($rpta) {
    $response_array['status'] = 'success';
    $response_array['title'] = 'Cliente';
    $response_array['message'] = 'desbloqueado correctamente';
    $response_array['time'] = 1500;
} else {
    $response_array['status'] = 'error';
    $response_array['title'] = 'Error';
    $response_array['message'] = 'Algo salió mal, por favor intente de nuevo';
    $response_array['time'] = 3000;
}

header('Content-type: application/json');
echo json_encode($response_array);
