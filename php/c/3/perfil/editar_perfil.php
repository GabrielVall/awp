<?php
session_start();
include_once ("../../../m/SQLConexion.php");
$sql = new SQLConexion();
$rpta=$sql->obtenerResultadoSimple("CALL sp_update_perfil_repartidor('".$_SESSION['id_usuario']."','".$_POST['usuario']."','".$_POST['password']."','".$_POST['correo']."','".$_POST['num']."','".$_POST['tipo_vehiculo']."','".$_POST['modelo']."','".$_POST['color']."','".$_POST['detalles']."')");

if ($rpta) {
	$response_array['status'] = 'success';
    $response_array['msg'] = 'Compra realizada!';
    unset($_SESSION['id_orden']);
}
else{
	$response_array['status'] = 'error';
	$response_array['msg'] = 'Por favor intente mas tarde';
}
header('Content-type: application/json');
echo json_encode($response_array);
?>