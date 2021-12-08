<?php
session_start();
include_once("../../../m/SQLConexion.php");
$sql = new SQLConexion();

$rpta_menu = $sql->obtenerResultadoSimple("CALL sp_update_menu1('" . $_POST['nombre'] . "','" . $_POST['hora_inicio'] . "','" . $_POST['hora_fin'] . "','" . $_POST['id_menu'] . "')");

if ($rpta_menu) {

    $dia_semana=json_decode(stripslashes($_POST['dia']));
    $id_productos=json_decode(stripslashes($_POST['id_productos']));

    for ($i=0; $i < count($id_productos); $i++) {
        
        for ($j=0; $j < count($dia_semana); $j++) {
            $rpta = $sql->obtenerResultadoSimple("CALL sp_insert_detalle_menu2('" . $_POST['id_menu'] . "','" . $id_productos[$i]->id . "','" . $dia_semana[$j] . "')");
        }
    }
    $rpta = $sql->obtenerResultadoSimple("CALL sp_delete_detalle_menu2('" . $_POST['id_menu'] . "','" . $_POST['dia_string'] . "','" . $_POST['id_productos_string'] . "')");

    $response_array['status'] = 'success';
    $response_array['title'] = 'Schedule';
    $response_array['message'] = 'actualizado correctamente';
    $response_array['time'] = 1500;
} else {
    $response_array['status'] = 'error';
    $response_array['title'] = 'Error';
    $response_array['message'] = 'Algo salió mal, por favor intente de nuevo';
    $response_array['time'] = 3000;
}

header('Content-type: application/json');
echo json_encode($response_array);
