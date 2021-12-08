<?php
session_start();
include_once("../../../m/SQLConexion.php");
$sql = new SQLConexion();

$rpta = $sql->obtenerResultadoSimple("CALL sp_update_sucursal2('" . $_POST['schedule'] . "','" . $_POST['proceso_auto'] . "','" . $_POST['metodo_pago_obligatorio'] . "','" . $_POST['id_zona_horaria'] . "','" . $_POST['id_categoria_sucursal'] . "','" . $_POST['id_ciudad'] . "','" . $_POST['id_estado_usuario'] . "','" . $_POST['id_sucursal'] . "')");

if ($rpta) {
    $response_array['status'] = 'success';
    $response_array['title'] = 'Configuración';
    $response_array['message'] = 'actualizada correctamente';
    $response_array['time'] = 1000;
} else {
    $response_array['status'] = 'error';
    $response_array['title'] = 'Error';
    $response_array['message'] = 'Algo salió mal, por favor intente de nuevo';
    $response_array['time'] = 3000;
}

header('Content-type: application/json');
echo json_encode($response_array);
