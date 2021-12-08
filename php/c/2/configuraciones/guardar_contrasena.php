<?php
session_start();
include_once("../../../m/SQLConexion.php");
$sql = new SQLConexion();

$hashed_password = password_hash($_POST['contrasena'], PASSWORD_DEFAULT);

$rpta = $sql->obtenerResultadoSimple("CALL sp_update_usuarios1('" . $hashed_password . "','" . $_SESSION['id_empresa_reparto_bexpress'] . "')");

if ($rpta) {
    $response_array['status'] = 'success';
    $response_array['title'] = 'Contraseña';
    $response_array['message'] = 'actualizada correctamente';
    $response_array['time'] = 1500;
} else {
    $response_array['status'] = 'error';
    $response_array['title'] = 'Error';
    $response_array['message'] = 'por favor inténtelo de nuevo';
    $response_array['time'] = 3000;
}

header('Content-type: application/json');
echo json_encode($response_array);
