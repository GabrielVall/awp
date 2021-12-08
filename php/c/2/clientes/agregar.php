<?php
session_start();
include_once("../../../m/SQLConexion.php");
$sql = new SQLConexion();

$rpta = $sql->obtenerResultadoID("CALL sp_insert_clientes1('" . $_POST['id_ciudad'] . "','" . $_POST['nombre'] . "','" . $_POST['apellido'] . "','" . $_POST['correo'] . "','" . $_POST['telefono'] . "','" . $_POST['usuario'] . "','" . $_POST['contrasena'] . "',@_ID)");

if ($rpta[0]['_ID']>0) {
    $response_array['status'] = 'success';
    $response_array['title'] = 'Cliente';
    $response_array['message'] = 'agregado correctamente';
    $response_array['time'] = 1500;
}
else if ($rpta[0]['_ID']==-1) {
    $response_array['status'] = 'error';
    $response_array['title'] = 'El nombre de usuario';
    $response_array['message'] = 'ya se encuentra en uso';
    $response_array['time'] = 3000;
}
else {
    $response_array['status'] = 'error';
    $response_array['title'] = 'Error';
    $response_array['message'] = 'Algo salió mal, por favor intente de nuevo';
    $response_array['time'] = 3000;
}

header('Content-type: application/json');
echo json_encode($response_array);