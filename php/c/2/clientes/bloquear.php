<?php
session_start();
include_once("../../../m/SQLConexion.php");
$sql = new SQLConexion();

$id_cliente=json_decode(stripslashes($_POST['id_cliente']));

if($_POST['tipo_sucursal']==1){

    $id_sucursal_express=json_decode(stripslashes($_POST['id_sucursal_express']));

    for ($i=0; $i < count($id_cliente); $i++) {

        for ($j=0; $j < count($id_sucursal_express); $j++) { 
            
            $rpta = $sql->obtenerResultadoSimple("CALL sp_insert_clientes_bloqueados_sucursales_express1('" . $id_cliente[$i] . "','" . $id_sucursal_express[$j] . "')");
        }
    }
}
else{
    
    $id_sucursal=json_decode(stripslashes($_POST['id_sucursal']));

    for ($i=0; $i < count($id_cliente); $i++) {

        for ($j=0; $j < count($id_sucursal); $j++) { 
            
            $rpta = $sql->obtenerResultadoSimple("CALL sp_insert_clientes_bloqueados_sucursales1('" . $id_cliente[$i] . "','" . $id_sucursal[$j] . "')");
        }
    }
}
            
    
$response_array['status'] = 'success';
$response_array['title'] = 'Cliente(s) bloqueado(s)';
$response_array['message'] = 'correctamente';
$response_array['time'] = 1500;


header('Content-type: application/json');
echo json_encode($response_array);
