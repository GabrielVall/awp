<?php
include_once('../../../m/SQLConexion.php');
include_once('../../../../librerias/phpmailer/class.email.php');

$sql = new SQLConexion();
$email = new EMail();

$rpta = $sql->obtenerResultadoSimple("CALL sp_update_panel_historial_pago1('".$_POST['id_historial_pago']."','3','" . $_POST['factura'] . "')");

if($rpta){

    include_once("pago_revision/correo.php");
    $response_array['status'] = 'success';
}
else{
    $response_array['status'] = 'error';
}

header('Content-type: application/json');
echo json_encode($response_array);