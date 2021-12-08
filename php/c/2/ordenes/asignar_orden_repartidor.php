<?php
session_start();
include_once("../../../m/SQLConexion.php");
$sql = new SQLConexion();

$rpta = $sql->obtenerResultadoID("CALL sp_update_orden1('" . $_POST['id_orden'] . "','" . $_POST['id_repartidor'] . "',@_ID)");

if ($rpta[0]['_ID']>0) {

    $response_array['status'] = 'success';
    $response_array['title'] = 'Orden';
    $response_array['message'] = 'asignada correctamente';
    $response_array['time'] = 1500;
}
else if ($rpta[0]['_ID']==-1) {

    $response_array['status'] = 'error';
    $response_array['title'] = 'Lo siento';
    $response_array['message'] = 'la orden acaba de ser aceptada por otro repartidor';
    $response_array['time'] = 2500;
}
else if ($rpta[0]['_ID']==-2) {

    $response_array['status'] = 'error';
    $response_array['title'] = 'Error.';
    $response_array['message'] = 'El repartidor llegó a su límite de orden';
    $response_array['time'] = 2500;
}
else {
    $response_array['status'] = 'error';
    $response_array['title'] = 'Error.';
    $response_array['message'] = 'Algo salió mal, por favor intente de nuevo';
    $response_array['time'] = 3000;
}

header('Content-type: application/json');
echo json_encode($response_array);