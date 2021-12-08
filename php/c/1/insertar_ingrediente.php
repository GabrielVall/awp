<?php
session_start();
include_once("../../m/SQLConexion.php");
$sql = new SQLConexion();

$rpta_ingrediente = $sql->obtenerResultadoID("CALL sp_insert_ingredientes1('" . $_SESSION['id_sucursal_bxpress'] . "','" . $_POST['nombre_ingrediente'] . "','" . $_POST['cantidad_minima_ingrediente'] . "','" . $_POST['cantidad_maxima_ingrediente'] . "','" . $_POST['seleccion_multiple_ingrediente'] . "',@_ID)");

if ($rpta_ingrediente[0]['_ID'] > 0) {

    // INGREDIENTES EXTRAS
    $ingredientes_extras=json_decode(stripslashes($_POST['ingredientes_extras']));

    for ($i=0; $i < count($ingredientes_extras); $i++) { 
        $rpta_ingrediente_extra = $sql->obtenerResultadoID("CALL sp_insert_ingredientes_extras1('" . $rpta_ingrediente[0]['_ID'] . "','" . $ingredientes_extras[$i]->nombre . "','" . $ingredientes_extras[$i]->precio . "',@_ID)");

        // $sub_complemento=explode(",",$ingredientes_extras[$i]->id_subcomplemento);

        // for ($j=0; $j < count($sub_complemento); $j++) { 
        //     $rpta_detalle=$sql->obtenerResultadoID("CALL sp_insert_detalle_ingrediente_sub1('".$sub_complemento[$j]."','".$rpta_ingrediente_extra[0]['_ID']."',@_ID);");
        // }

    }

    $response_array['status'] = 'success';
    $response_array['msg'] = 'Complemento agregado';
    $response_array['id'] = $rpta_ingrediente[0]['_ID'];
} else {
    $response_array['status'] = 'error';
    $response_array['msg'] = "CALL sp_insert_ingredientes1('" . $_SESSION['id_sucursal_bxpress'] . "','" . $_POST['nombre_ingrediente'] . "','" . $_POST['cantidad_minima_ingrediente'] . "','" . $_POST['cantidad_maxima_ingrediente'] . "','" . $_POST['seleccion_multiple_ingrediente'] . "',@_ID)";
}

header('Content-type: application/json');
echo json_encode($response_array);