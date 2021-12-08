<?php
session_start();
include_once("../../../m/SQLConexion.php");
$sql = new SQLConexion();

$row_limite = $sql->obtenerResultado("SELECT fn_select_ordenes_repartidor1('".$_POST['id_repartidor']."')");

if($row_limite[0][0]==1){

    $rpta_orden = $sql->obtenerResultadoID("CALL sp_insert_ordenes_punto_a_punto1('" . $_POST['id_cliente'] . "','" . $_POST['id_repartidor'] . "','" . $_POST['recibir_paquete'] . "','" . $_POST['descripcion'] . "','" . $_POST['telefono'] . "','" . $_POST['nombre_recibe'] . "','" . $_POST['direccion_remitente'] . "','" . $_POST['latitud_remitente'] . "','" . $_POST['longitud_remitente'] . "','" . $_POST['direccion_destinatario'] . "','" . $_POST['latitud_destinatario'] . "','" . $_POST['longitud_destinatario'] . "',@_ID)");
    
    if ($rpta_orden[0]['_ID']>0) {
    
        $productos=json_decode(stripslashes($_POST['productos']));
        $namep='';
            
        for ($i=0; $i < count($productos); $i++) {
            $rpta_insert = $sql->obtenerResultadoID("CALL sp_insert_productos_cliente1('" . $productos[$i]->nombre_producto . "','" . $_POST['id_cliente'] . "',@_ID)");
    
            $rpta = $sql->obtenerResultadoSimple("CALL sp_insert_historial_venta_punto_a_punto1('" . $rpta_orden[0]['_ID'] . "','" . $productos[$i]->nombre_producto . "','" . $productos[$i]->precio . "')");
            $namep.=$productos[$i]->nombre_producto.',';
        }
    
        $response_array['status'] = 'success';
        $response_array['title'] = 'Orden';
        $response_array['message'] = 'agregada correctamente';
        $response_array['time'] = 1500;
        $response_array['namep'] = $namep;
    }
    else {
        $response_array['status'] = 'error';
        $response_array['title'] = 'Error';
        $response_array['message'] = 'Algo salió mal, por favor intente de nuevo';
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
