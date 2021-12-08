<?php
session_start();
include_once("../../../m/SQLConexion.php");
$sql = new SQLConexion();

$rpta = $sql->obtenerResultadoID("CALL sp_update_empresa_reparto1('" . $_POST['nombre_empresa'] . "','" . $_POST['telefono_empresa'] . "','" . $_POST['correo_empresa'] . "','" . $_POST['nombre_usuario'] . "','" . $_SESSION['id_empresa_reparto_bexpress'] . "',@_ID)");

if ($rpta[0]['_ID']>0) {
    $response_array['status'] = 'success';
    $response_array['title'] = 'Datos de la cuenta';
    $response_array['message'] = 'actualizado correctamente';
    $response_array['time'] = 1500;
} else {
    $response_array['status'] = 'error';
    $response_array['title'] = 'Error';
    $response_array['message'] = 'Por favor seleccione otro nombre de usuario';
    $response_array['time'] = 3000;
}

header('Content-type: application/json');
echo json_encode($response_array);
