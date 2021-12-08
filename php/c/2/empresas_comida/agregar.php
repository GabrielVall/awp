<?php
session_start();
include_once("../../../m/SQLConexion.php");
$sql = new SQLConexion();

$hashed_password = password_hash($_POST['contrasena'], PASSWORD_DEFAULT);

$rpta = $sql->obtenerResultadoID("CALL sp_insert_empresa_comida1('" . $_POST['nombre'] . "','" . $_POST['telefono'] . "','" . $_POST['correo'] . "','" . $_POST['limite'] . "','" . $_POST['usuario'] . "','" . $hashed_password . "',@_ID)");

if ($rpta[0]['_ID']>0) {
    $response_array['status'] = 'success';
    $response_array['title'] = 'Empresa de comida';
    $response_array['message'] = 'agregado correctamente';
    $response_array['time'] = 1500;
    $response_array['id'] = $rpta[0]['_ID'];
}
else if ($rpta[0]['_ID']==-1) {
    $response_array['status'] = 'error';
    $response_array['title'] = 'El nombre de usuario';
    $response_array['message'] = 'ya se encuentra en uso, por favor pruebe con otro';
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
