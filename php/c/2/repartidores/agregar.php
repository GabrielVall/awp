<?php
session_start();
include_once("../../../m/SQLConexion.php");
$sql = new SQLConexion();

$rpta = $sql->obtenerResultadoID("CALL sp_insert_repartidores1('" . $_POST['id_ciudad'] . "','1','" . $_POST['nombre'] . "','" . $_POST['apellido'] . "','" . $_POST['correo'] . "','" . $_POST['telefono'] . "','" . $_POST['direccion'] . "','" . $_POST['latitud'] . "','" . $_POST['longitud'] . "','" . $_POST['usuario'] . "','" . $_POST['contrasena'] . "',@_ID)");

if ($rpta[0]['_ID']>0) {
    $response_array['status'] = 'success';
    $response_array['title'] = 'Repartidor';
    $response_array['message'] = 'agregado correctamente';
    $response_array['time'] = 1500;
    $response_array['id'] = $rpta[0]['_ID'];
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