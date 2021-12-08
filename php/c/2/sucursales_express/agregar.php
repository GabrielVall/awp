<?php
session_start();
include_once("../../../m/SQLConexion.php");
$sql = new SQLConexion();

$rpta = $sql->obtenerResultadoID("CALL sp_insert_sucursales_express1('" . $_POST['id_ciudad'] . "','" . $_POST['id_categoria_sucursal'] . "','" . $_POST['nombre'] . "','" . $_POST['costo_km'] . "',@_ID)");

$simbolo=$sql->obtenerResultado("SELECT simbolo_tipo_cambio FROM empresa_reparto INNER JOIN tipos_cambios USING(id_tipo_cambio) WHERE id_empresa_reparto=1");

if ($rpta[0]['_ID']>0) {
    $response_array['status'] = 'success';
    $response_array['title'] = 'Sucursal express';
    $response_array['message'] = 'agregada correctamente';
    $response_array['time'] = 1500;
    $response_array['id'] = $rpta[0]['_ID'];
    $response_array['simbolo'] = $simbolo[0][0];
} else {
    $response_array['status'] = 'error';
    $response_array['title'] = 'Error';
    $response_array['message'] = 'Algo salió mal, por favor intente de nuevo';
    $response_array['time'] = 3000;
}

header('Content-type: application/json');
echo json_encode($response_array);