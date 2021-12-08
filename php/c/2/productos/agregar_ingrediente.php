<?php
session_start();
include_once("../../../m/SQLConexion.php");
$sql = new SQLConexion();

$ingredientes=json_decode(stripslashes($_POST['id_ingrediente']));
$total_success=0;
$response_array['id_ingredientes']='';
$response_array['nombre_ingredientes']='';

for ($i=0; $i < count($ingredientes); $i++) { 
    $rpta = $sql->obtenerResultadoID("CALL sp_insert_detalle_productos_ingredientes1('" . $ingredientes[$i]->id_ingrediente . "','" . $_POST['id_producto'] . "',@_ID)");

    if($rpta[0]['_ID']>0){
        $total_success++;
        $response_array['id_ingredientes'] .= $rpta[0]['_ID'].',';
        $response_array['nombre_ingredientes'] .= $ingredientes[$i]->nombre_ingrediente.',';
    }
}

if ($total_success==count($ingredientes)) {
    $response_array['status'] = 'success';
    $response_array['title'] = 'Ingrediente(s)';
    $response_array['message'] = 'agregado(s) correctamente';
    $response_array['time'] = 1500;
    $response_array['total_ing'] = count($ingredientes);
}
else {
    $response_array['status'] = 'error';
    $response_array['title'] = 'Error';
    $response_array['message'] = 'Algo salió mal, por favor intente de nuevo';
    $response_array['time'] = 3000;
}

header('Content-type: application/json');
echo json_encode($response_array);