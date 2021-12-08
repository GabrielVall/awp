<?php
session_start();
include_once("../../m/SQLConexion.php");
$sql = new SQLConexion();

$rpta = $sql->obtenerResultadoSimple("CALL sp_updates_ingredientes2('" . $_POST['nombre_ingrediente'] . "','" . $_POST['cantidad_minima_ingrediente'] . "','" . $_POST['cantidad_maxima_ingrediente'] . "','" . $_POST['seleccion_multiple_ingrediente'] . "','" . $_POST['id'] . "')");

if ($rpta) {

    // INGREDIENTES EXTRAS
    $ingredientes_extras=json_decode(stripslashes($_POST['ingredientes_extras']));
    $ids_ingrediente_extra='';
    $ids_detalle='';
    if(count($ingredientes_extras) > 0){
        for ($i=0; $i < count($ingredientes_extras); $i++) { 
            $rpta_ingrediente_extra = $sql->obtenerResultadoID("CALL sp_insert_ingredientes_extras1('" . $_POST['id'] . "','" . $ingredientes_extras[$i]->nombre . "','" . $ingredientes_extras[$i]->precio . "',@_ID)");

            $sub_complemento=explode(",",$ingredientes_extras[$i]->id_subcomplemento);

            for ($j=0; $j < count($sub_complemento); $j++) { 
                $rpta_detalle=$sql->obtenerResultadoID("CALL sp_insert_detalle_ingrediente_sub1('".$sub_complemento[$j]."','".$rpta_ingrediente_extra[0]['_ID']."',@_ID);");
            }
            $ids_ingrediente_extra.=$rpta_ingrediente_extra[0]['_ID'].',';

        }
    }

    $response_array['status'] = 'success';
    $response_array['msg'] = 'Complemento editado';
} else {
    $response_array['status'] = 'error';
    $response_array['msg'] = 'Error al conectar';
}

header('Content-type: application/json');
echo json_encode($response_array);