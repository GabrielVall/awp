<?php
session_start();
include_once("../../../m/SQLConexion.php");
$sql = new SQLConexion();

$menus=json_decode(stripslashes($_POST['id_menu']));
$total_success=0;
$response_array['id_menu']='';
$response_array['nombre_menu']='';

for ($i=0; $i < count($menus); $i++) { 
    $rpta = $sql->obtenerResultadoSimple("CALL sp_insert_detalle_menu1('" . $menus[$i]->id_menu . "','" . $_POST['id_producto'] . "')");

    if($rpta){
        $total_success++;
        $response_array['id_menu'] .= $menus[$i]->id_menu.',';
        $response_array['nombre_menu'] .= $menus[$i]->nombre_menu.',';
    }
}

if ($total_success==count($menus)) {
    $response_array['status'] = 'success';
    $response_array['title'] = 'Schedule(s)';
    $response_array['message'] = 'agregado(s) correctamente';
    $response_array['time'] = 1500;
    $response_array['total_menu'] = count($menus);
}
else {
    $response_array['status'] = 'error';
    $response_array['title'] = 'Error';
    $response_array['message'] = 'Algo salió mal, por favor intente de nuevo';
    $response_array['time'] = 3000;
}

header('Content-type: application/json');
echo json_encode($response_array);