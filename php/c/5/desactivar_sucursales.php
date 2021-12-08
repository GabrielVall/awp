<?php
session_start();
include_once("../../m/SQLConexion.php");
$sql = new SQLConexion();
if (!isset($_SESSION['id_usuario_bxpress'])) {
    die();
}
$rpta = $sql->obtenerResultadoSimple("CALL sp_cambiar_estados_sucursales_emp_comida('".$_SESSION['id_empresa_comida_bxpress']."')");

if($rpta){
    $response_array['status'] = 'error';
        $response_array['msg'] = 'Conexion inestable, intenta más tarde';
        $response_array['titulo'] = '';
        $response_array['tipo'] = '';
    $response_array['status'] = 'success';
    $response_array['msg'] = 'Sucursales desactivadas';
}else{
    $response_array['titulo'] = 'Error';
    $response_array['msg'] = "Fallo al comunicar con el servidor, intenta más tarde";
}

header('Content-type: application/json');
echo json_encode($response_array);