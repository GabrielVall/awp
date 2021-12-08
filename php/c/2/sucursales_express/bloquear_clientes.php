<?php
session_start();
include_once("../../../m/SQLConexion.php");
$sql = new SQLConexion();

$id_cliente=json_decode(stripslashes($_POST['id_clientes']));

for ($i=0; $i < count($id_cliente); $i++) {

    $rpta = $sql->obtenerResultadoSimple("CALL sp_insert_clientes_bloqueados_sucursales_express1('" . $id_cliente[$i] . "','" . $_SESSION['id_sucursal_express_cliente_ban'] . "')");
}
    
$response_array['status'] = 'success';
$response_array['title'] = 'Cliente(s) bloqueado(s)';
$response_array['message'] = 'correctamente';
$response_array['time'] = 1500;
$response_array['id'] = $_SESSION['id_sucursal_express_cliente_ban'];


header('Content-type: application/json');
echo json_encode($response_array);
