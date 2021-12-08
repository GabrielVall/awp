<?php
session_start();
include_once("../../../m/SQLConexion.php");
$sql = new SQLConexion();

$rpta = $sql->obtenerResultadoID("CALL sp_update_ingredientes_extras1('" . $_POST['id'] . "','" . $_POST['nombre'] . "','" . $_POST['precio'] . "')");

if ($rpta) {

    // INGREDIENTES ADICIONALES
    $ingredientes_adicionales=json_decode(stripslashes($_POST['id_ing_adicionales']));
    $id_detalles='';
    $nombre_detalles='';

    for ($i=0; $i < count($ingredientes_adicionales); $i++) {

        if($ingredientes_adicionales[$i]->id_detalle>0 && $ingredientes_adicionales[$i]->estado==0){
            $rpta_delete = $sql->obtenerResultadoSimple("CALL sp_delete_detalle_ingrediente_sub1('" . $ingredientes_adicionales[$i]->id_detalle . "')");
        }
        else if($ingredientes_adicionales[$i]->id_detalle==0 && $ingredientes_adicionales[$i]->estado==1){
            $rpta_detalle = $sql->obtenerResultadoID("CALL sp_insert_detalle_ingrediente_sub1('" . $ingredientes_adicionales[$i]->id_ingrediente . "','" . $_POST['id'] . "',@_ID)");
        }

    }

    $row_detalle_ing_extra = $sql->obtenerResultado("CALL sp_select_detalle_ingrediente_sub1('" . $_POST['id'] . "')");
    $total_row_detalle_ing_extra = count($row_detalle_ing_extra);

    for ($i=0; $i < $total_row_detalle_ing_extra; $i++) { 
        $id_detalles.=$row_detalle_ing_extra[$i]['id_ingrediente_sub'].',';
        $nombre_detalles.=$row_detalle_ing_extra[$i]['nombre_ingrediente'].',';
    }

    $response_array['status'] = 'success';
    $response_array['title'] = 'Adicional';
    $response_array['message'] = 'actualizado correctamente';
    $response_array['time'] = 1500;
    $response_array['id_detalles'] = $id_detalles;
    $response_array['nombre_detalles'] = $nombre_detalles;
} else {
    $response_array['status'] = 'error';
    $response_array['title'] = 'Error';
    $response_array['message'] = 'Algo salió mal, por favor intente de nuevo';
    $response_array['time'] = 3000;
}

header('Content-type: application/json');
echo json_encode($response_array);