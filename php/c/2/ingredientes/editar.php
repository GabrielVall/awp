<?php
session_start();
include_once("../../../m/SQLConexion.php");
$sql = new SQLConexion();

$rpta = $sql->obtenerResultadoSimple("CALL sp_updates_ingredientes1('" . $_POST['nombre_ingrediente'] . "','" . $_POST['cantidad_minima_ingrediente'] . "','" . $_POST['cantidad_maxima_ingrediente'] . "','" . $_POST['seleccion_multiple_ingrediente'] . "','" . $_POST['id_ingrediente'] . "')");

if ($rpta) {

    // INGREDIENTES EXTRAS
    $ingredientes_extras=json_decode(stripslashes($_POST['ingredientes_extras']));
    $ids_ingrediente_extra='';
    $ids_detalle='';

    for ($i=0; $i < count($ingredientes_extras); $i++) { 
        $rpta_ingrediente_extra = $sql->obtenerResultadoID("CALL sp_insert_ingredientes_extras1('" . $_POST['id_ingrediente'] . "','" . $ingredientes_extras[$i]->nombre . "','" . $ingredientes_extras[$i]->precio . "',@_ID)");

        $sub_complemento=explode(",",$ingredientes_extras[$i]->id_subcomplemento);

        for ($j=0; $j < count($sub_complemento); $j++) { 
            $rpta_detalle=$sql->obtenerResultadoID("CALL sp_insert_detalle_ingrediente_sub1('".$sub_complemento[$j]."','".$rpta_ingrediente_extra[0]['_ID']."',@_ID);");

            if($rpta_detalle[0]['_ID']>0){
                $j==0 ? $ids_detalle.=$rpta_ingrediente_extra[0]['_ID'].'-'.$rpta_detalle[0]['_ID'].',' : $ids_detalle.=$rpta_detalle[0]['_ID'].',';
                $j==(count($sub_complemento)-1) ? $ids_detalle=substr($ids_detalle, 0, -1).'/' : false;
            }
        }
        $ids_ingrediente_extra.=$rpta_ingrediente_extra[0]['_ID'].',';

    }

    $response_array['status'] = 'success';
    $response_array['title'] = 'Ingrediente';
    $response_array['message'] = 'actualizado correctamente';
    $response_array['time'] = 1500;
    $response_array['ids_ingredientes_extras'] = $ids_ingrediente_extra;
    $response_array['ids_detalle'] = $ids_detalle;
} else {
    $response_array['status'] = 'error';
    $response_array['title'] = 'Error';
    $response_array['message'] = 'Algo salió mal, por favor intente de nuevo';
    $response_array['time'] = 3000;
}

header('Content-type: application/json');
echo json_encode($response_array);