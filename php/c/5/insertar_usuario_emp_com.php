<?php
session_start();
include_once("../../m/SQLConexion.php");
$sql = new SQLConexion();
if (!isset($_SESSION['id_usuario_bxpress'])) {
    die();
}
$hashed_password = password_hash($_POST['pass'], PASSWORD_DEFAULT);
$rpta = $sql->obtenerResultadoID("CALL sp_insert_usuario_emp_com('".$_POST['usuario']."','".$hashed_password."','".$_POST['id_sucursal']."','".$_SESSION['id_empresa_comida_bxpress']."',@_ID)");

if($rpta[0][0] > 0){
    $response_array['status'] = 'success';
    $response_array['msg'] = 'Usuario asignado';
    $response_array['titulo'] = '';
    $response_array['tipo'] = '';
}else if($rpta[0][0] == -1){
    $response_array['status'] = '';
    $response_array['msg'] = "No tienes los permisos suficientes para realizar esta acción.";
    $response_array['titulo'] = 'Acción invaldia';
    $response_array['tipo'] = 'alerta';
}else if($rpta[0][0] == -2){
    $response_array['status'] = 'success';
    $response_array['msg'] = "Usuario actualizado.";
    $response_array['titulo'] = '';
    $response_array['tipo'] = '';
}
else{
    $response_array['status'] = '';
    $response_array['msg'] = "Ocurrio un error inesperado, intenta más tarde.";
    $response_array['titulo'] = 'Acción invaldia';
    $response_array['tipo'] = 'alerta';
}

header('Content-type: application/json');
echo json_encode($response_array);