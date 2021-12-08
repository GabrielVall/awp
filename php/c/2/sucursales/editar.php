<?php
session_start();
include_once("../../../m/SQLConexion.php");
$sql = new SQLConexion();

$rpta = $sql->obtenerResultadoSimple("CALL sp_update_sucursal1('" . $_POST['nombre'] . "','" . $_POST['telefono_sucursal'] . "','" . $_POST['telefono_whatsapp_sucursal'] . "','" . $_POST['descripcion'] . "','" . $_POST['direccion_sucursal'] . "','" . $_POST['latitud_sucursal'] . "','" . $_POST['longitud_sucursal'] . "','" . $_POST['id_sucursal'] . "')");

if ($rpta) {
    $response_array['status'] = 'success';
    $response_array['title'] = 'Información';
    $response_array['message'] = 'actualizada correctamente';
    $response_array['time'] = 1500;
} else {
    $response_array['status'] = 'error';
    $response_array['title'] = 'Error';
    $response_array['message'] = 'Algo salió mal, por favor intente de nuevo';
    $response_array['time'] = 3000;
}

header('Content-type: application/json');
echo json_encode($response_array);
