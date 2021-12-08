<?php
session_start();
include_once("../../../m/SQLConexion.php");
$sql = new SQLConexion();

$rpta = $sql->obtenerResultadoSimple("CALL sp_update_producto1('" . $_POST['id_categoria'] . "','" . $_POST['nombre'] . "','" . $_POST['descripcion'] . "','" . $_POST['tiempo'] . "','" . $_POST['precio'] . "','" . $_POST['precio_kg'] . "','" . $_POST['id_producto'] . "')");

if ($rpta) {

    $response_array['status'] = 'success';
    $response_array['title'] = 'Producto';
    $response_array['message'] = 'actualizado correctamente';
    $response_array['time'] = 1500;
} else {
    $response_array['status'] = 'error';
    $response_array['title'] = 'Error';
    $response_array['message'] = 'Algo salió mal, por favor intente de nuevo';
    $response_array['time'] = 3000;
}

header('Content-type: application/json');
echo json_encode($response_array);