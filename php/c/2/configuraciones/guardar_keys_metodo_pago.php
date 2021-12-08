<?php
session_start();
include_once("../../../m/SQLConexion.php");
$sql = new SQLConexion();

$rpta = $sql->obtenerResultadoSimple("CALL sp_update_empresa_reparto2('" . $_POST['paypal'] . "','" . $_POST['stripe_public'] . "','" . $_POST['stripe_secret'] . "','" . $_POST['mercado_pago'] . "','" . $_POST['id_banco'] . "','" . $_POST['num_transferencia'] . "','" . $_POST['num_deposito'] . "')");

if ($rpta) {
    $response_array['status'] = 'success';
    $response_array['title'] = 'Keys';
    $response_array['message'] = 'actualizadas correctamente';
    $response_array['time'] = 1500;
} else {
    $response_array['status'] = 'error';
    $response_array['title'] = 'Error';
    $response_array['message'] = 'por favor inténtelo de nuevo';
    $response_array['time'] = 3000;
}

header('Content-type: application/json');
echo json_encode($response_array);
