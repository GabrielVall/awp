<?php
session_start();
include_once("../../m/SQLConexion.php");
$sql = new SQLConexion();
if (!isset($_SESSION['id_usuario_bxpress'])) {
    die();
}
$rpta = $sql->obtenerResultado("CALL sp_verificar_notificaciones_recientes('".$_SESSION['id_usuario_bxpress']."')");

if(count($rpta) > 0){
    $response_array['status'] = 'success';
    for ($i=0; $i < count($rpta); $i++) { 
        $response_array['header'][$i] = $rpta[$i]['titulo_notificacion'];
        $response_array['msg'][$i] = $rpta[$i]['mensaje_notificacion'];
        $response_array['hora'][$i] = $rpta[$i]['fecha_notificacion'];
    }
}else if($rpta[0][0] > 0){
    $response_array['status'] = 'error';
}
header('Content-type: application/json');
echo json_encode($response_array);