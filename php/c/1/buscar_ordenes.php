<?php
session_start();
include_once("../../m/SQLConexion.php");
$sql = new SQLConexion();
$rpta = $sql->obtenerResultado("CALL sp_select_ordenes_sucursal(31,4)");

if(count($rpta) > 0){
    $response_array['status'] = 'success';
    $response_array['msg'] = $rpta[0][0].','.$rpta[0][1].','.$rpta[0][3].','.$rpta[0][5].','.$rpta[0][6];
}

header('Content-type: application/json');
echo json_encode($response_array);