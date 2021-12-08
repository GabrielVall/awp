<?php
session_start();
include_once("../../../m/SQLConexion.php");
$sql = new SQLConexion();

$rpta_producto = $sql->obtenerResultadoID("CALL sp_insert_producto1('" . $_POST['id_categoria_producto'] . "','" . $_POST['id_sucursal'] . "','" . $_POST['nombre_producto'] . "','" . $_POST['descripcion_producto'] . "','" . $_POST['tiempo_preparacion_producto'] . "','" . $_POST['precio_producto'] . "','" . $_POST['precio_kg_producto'] . "',@_ID)");

if ($rpta_producto[0]['_ID'] > 0) {

    // INGREDIENTES
    $ingredientes=json_decode(stripslashes($_POST['id_ingrediente']));

    for ($i=0; $i < count($ingredientes); $i++) { 
        $rpta_ingrediente = $sql->obtenerResultadoID("CALL sp_insert_detalle_productos_ingredientes1('" . $ingredientes[$i]->id_ingrediente . "','" . $rpta_producto[0]['_ID'] . "',@_ID)");
    }

    // MENUS
    $menus=json_decode(stripslashes($_POST['id_menu']));

    for ($i=0; $i < count($menus); $i++) { 
        $rpta_menu = $sql->obtenerResultadoSimple("CALL sp_insert_detalle_menu1('" . $menus[$i]->id_menu . "','" . $rpta_producto[0]['_ID'] . "')");
    }

    $response_array['status'] = 'success';
    $response_array['title'] = 'Producto';
    $response_array['message'] = 'agregado correctamente';
    $response_array['time'] = 1500;
    $response_array['id'] = $rpta_producto[0]['_ID'];
} else {
    $response_array['status'] = 'error';
    $response_array['title'] = 'Error';
    $response_array['message'] = 'Algo salió mal, por favor intente de nuevo';
    $response_array['time'] = 3000;
}

header('Content-type: application/json');
echo json_encode($response_array);