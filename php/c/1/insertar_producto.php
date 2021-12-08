<?php
session_start();
include_once("../../m/SQLConexion.php");
include_once("../../f/main_fnc.php");
$sql = new SQLConexion();
$rpta_producto = $sql->obtenerResultadoID("CALL sp_insert_producto1('" . $_POST['id_categoria'] . "','" . $_SESSION['id_sucursal_bxpress'] . "','" . $_POST['nombre_producto'] . "','" . $_POST['descripcion'] . "','" . $_POST['tiempo_preparacion'] . "','" . $_POST['precio_venta'] . "','" . $_POST['precio_kg'] . "',@_ID)");

if (isset($_FILES['imagen_producto'])){
    subir_imagen('productos',$rpta_producto[0]['_ID'],$_FILES['imagen_producto'],array("jpg","jpeg","png"));
}

if ($rpta_producto[0]['_ID'] > 0) {

    // INGREDIENTES
    $ingredientes=json_decode(stripslashes($_POST['id_complementos']));

    for ($i=0; $i < count($ingredientes); $i++) { 
        $rpta_ingrediente = $sql->obtenerResultadoID("CALL sp_insert_detalle_productos_ingredientes1('" . $ingredientes[$i] . "','" . $rpta_producto[0]['_ID'] . "',@_ID)");
    }

    // MENUS
    $menus=json_decode(stripslashes($_POST['id_complementos']));

    for ($i=0; $i < count($menus); $i++) { 
        $rpta_menu = $sql->obtenerResultadoSimple("CALL sp_insert_detalle_menu1('" . $menus[$i] . "','" . $rpta_producto[0]['_ID'] . "')");
    }

    $response_array['status'] = 'success';
    $response_array['msg'] = 'agregado correctamente';
} else {
    $response_array['status'] = 'error';
    $response_array['msg'] = "CALL sp_insert_producto1('" . $_POST['id_categoria'] . "','" . $_SESSION['id_sucursal_bxpress'] . "','" . $_POST['nombre_producto'] . "','" . $_POST['descripcion'] . "','" . $_POST['tiempo_preparacion'] . "','" . $_POST['precio_venta'] . "','" . $_POST['precio_kg'] . "',@_ID)";
}

header('Content-type: application/json');
echo json_encode($response_array);