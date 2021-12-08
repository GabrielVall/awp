<?php
session_start();
include_once("../../../m/SQLConexion.php");
$sql = new SQLConexion();

$rpta = $sql->obtenerResultadoSimple("CALL sp_update_empresa_reparto3('" . $_POST['id_tipo_cambio'] . "','" . $_POST['id_zona_horaria'] . "','" . $_POST['cuota_repartidor'] . "','" . $_POST['ordenes_maximas'] . "','" . $_POST['sucursales_express'] . "','" . $_POST['costo_por_km'] . "','" . $_POST['costo_minimo'] . "','" . $_POST['ordenes_punto_a_punto'] . "')");

if ($rpta) {
    $response_array['status'] = 'success';
    $response_array['title'] = 'Configuración avanzada';
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
