<?php
session_start();
include_once("../../../m/SQLConexion.php");
$sql = new SQLConexion();

$rpta_menu = $sql->obtenerResultadoID("CALL sp_insert_menu1('" . $_SESSION['id_sucursal_menu'] . "','" . $_POST['nombre'] . "','" . $_POST['hora_inicio'] . "','" . $_POST['hora_fin'] . "',@_ID)");

if ($rpta_menu[0]['_ID']>0) {

    $dia_semana=json_decode(stripslashes($_POST['dia']));
    $id_productos=json_decode(stripslashes($_POST['id_productos']));

    for ($i=0; $i < count($id_productos); $i++) {
        
        for ($j=0; $j < count($dia_semana); $j++) {
            $rpta = $sql->obtenerResultadoSimple("CALL sp_insert_detalle_menu2('" . $rpta_menu[0]['_ID'] . "','" . $id_productos[$i]->id . "','" . $dia_semana[$j] . "')");
        }
    }

    $response_array['status'] = 'success';
    $response_array['title'] = 'Schedule';
    $response_array['message'] = 'agregado correctamente';
    $response_array['time'] = 1500;
    $response_array['id'] = $rpta_menu[0]['_ID'];
} else {
    $response_array['status'] = 'error';
    $response_array['title'] = 'Error';
    $response_array['message'] = 'Algo salió mal, por favor intente de nuevo';
    $response_array['time'] = 3000;
}

header('Content-type: application/json');
echo json_encode($response_array);
