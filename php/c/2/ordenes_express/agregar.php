<?php
session_start();
include_once("../../../m/SQLConexion.php");
$sql = new SQLConexion();

$row_limite = $sql->obtenerResultado("SELECT fn_select_ordenes_repartidor1('".$_POST['id_repartidor']."')");

if($row_limite[0][0]==1){

    $row_cliente_bloqueado = $sql->obtenerResultado("CALL sp_select_clientes_bloqueados_sucursales_express1('" . $_POST['id_cliente'] . "','" . $_POST['id_sucursal_express'] . "')");

    if ((count($row_cliente_bloqueado)>0 && $row_cliente_bloqueado[0]['estado_cliente_bloqueado_sucursal_express']==0) || count($row_cliente_bloqueado)==0) {

        $rpta = $sql->obtenerResultadoSimple("CALL sp_insert_orden_express1('" . $_POST['id_sucursal_express'] . "','" . $_POST['id_cliente'] . "','" . $_POST['id_repartidor'] . "','" . $_POST['detalles_orden'] . "','" . $_POST['nombre_recibe_orden'] . "','" . $_POST['costo'] . "','" . $_POST['direccion_orden_express'] . "','" . $_POST['latitud_orden_express'] . "','" . $_POST['longitud_orden_express'] . "')");

        if($rpta){
            $response_array['status'] = 'success';
            $response_array['title'] = 'Orden';
            $response_array['message'] = 'agregada correctamente';
            $response_array['time'] = 1500;
        }
        else{
            $response_array['status'] = 'error';
            $response_array['title'] = 'Algo salió mal';
            $response_array['message'] = 'por favor inténtelo de nuevo';
            $response_array['time'] = 3000;
        }

    } else {
        $response_array['status'] = 'error';
        $response_array['title'] = 'Error.';
        $response_array['message'] = 'El cliente se encuentra bloqueado para la sucursal seleccionada';
        $response_array['time'] = 3000;
    }
}
else{
    $response_array['status'] = 'error';
    $response_array['title'] = 'Error.';
    $response_array['message'] = 'El repartidor llegó a su límite de orden';
    $response_array['time'] = 3000;
}

header('Content-type: application/json');
echo json_encode($response_array);
