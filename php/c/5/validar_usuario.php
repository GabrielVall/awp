<?php
session_start();
include_once("../../m/SQLConexion.php");
$sql = new SQLConexion();
if (!isset($_SESSION['id_usuario_bxpress'])) {
    die();
}
$rpta = $sql->obtenerResultado("CALL sp_verificar_usuario_existente('".$_POST['usuario']."')");

if($rpta[0][0] == 0){
    $response_array['status'] = 'success';
    $response_array['msg'] = 'Este usuario esta disponible';
    $response_array['titulo'] = '';
    $response_array['tipo'] = '';
}else if($rpta[0][0] > 0){
    $response_array['status'] = 'error';
    $response_array['msg'] = 'Este usuario esta ocupado';
    $response_array['titulo'] = '';
    $response_array['tipo'] = '';
}

header('Content-type: application/json');
echo json_encode($response_array);