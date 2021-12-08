<?php
session_start();
include_once("../../m/SQLConexion.php");
$sql = new SQLConexion();
$rpta = $sql->obtenerResultadoID("CALL sp_insert_categorias_productos1('".$_SESSION['id_sucursal_bxpress']."','".$_POST['nombre_categoria']."',@_ID)");
if($rpta[0][0] > 0){
    $response_array['status'] = 'success';
    $response_array['msg'] = 'Categoria agregada';
    $response_array['titulo'] = '';
    $response_array['tipo'] = '';
}else{
    $response_array['titulo'] = 'Error';
    $response_array['msg'] = 'La categoria no se a insertado correctamente, intenta más tarde';
    $response_array['titulo'] = 'Error al comunicarse con el servidor';
    $response_array['tipo'] = 'alerta';
}
header('Content-type: application/json');
echo json_encode($response_array);