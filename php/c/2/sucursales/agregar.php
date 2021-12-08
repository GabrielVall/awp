<?php
session_start();
include_once("../../../m/SQLConexion.php");
$sql = new SQLConexion();

$rpta_usuario = $sql->obtenerResultadoID("CALL sp_insert_usuarios1('" . $_POST['usuario'] . "','" . $_POST['contrasena'] . "',@_ID)");

if ($rpta_usuario[0]['_ID']>0) {

    $rpta_sucursal = $sql->obtenerResultadoID("CALL sp_insert_sucursal_empresa_comida('" . $rpta_usuario[0]['_ID'] . "','" . $_POST['id_empresa'] . "','" . $_POST['nombre'] . "','" . $_POST['id_ciudad'] . "','" . $_POST['direccion'] . "','".$_POST['id_categoria']."','".$_POST['telefono']."','".$_POST['telefono_whatsapp']."','".$_POST['descripcion']."','".$_POST['latitud']."','".$_POST['longitud']."',@_ID)");

    if($rpta_sucursal[0]['_ID']>0){
        $response_array['status'] = 'success';
        $response_array['title'] = 'Sucursal';
        $response_array['message'] = 'agregada correctamente';
        $response_array['time'] = 1500;
        $response_array['id'] = $rpta_sucursal[0]['_ID'];
    }
    else if($rpta_sucursal[0]['_ID']==0){

        $rpta = $sql->obtenerResultadoSimple("DELETE FROM usuarios WHERE id_usuario='".$rpta_sucursal[0]['_ID']."';");

        $response_array['status'] = 'error';
        $response_array['title'] = 'Error.';
        $response_array['message'] = 'La empresa de comida ya llegó a su límite de sucursales';
        $response_array['time'] = 3000;
    }
    else {
        $response_array['status'] = 'error';
        $response_array['title'] = 'Error';
        $response_array['message'] = 'Algo salió mal, por favor intente de nuevo';
        $response_array['time'] = 3000;
    }    

}
else if ($rpta_usuario[0]['_ID']==-1) {

    $response_array['status'] = 'error';
    $response_array['title'] = 'Error.';
    $response_array['message'] = 'El nombre de usuario ya está en uso';
    $response_array['time'] = 1500;
    $response_array['id'] = $rpta_usuario[0]['_ID'];
} 
else {
    $response_array['status'] = 'error';
    $response_array['title'] = 'Error';
    $response_array['message'] = 'Algo salió mal, por favor intente de nuevo';
    $response_array['time'] = 3000;
}

header('Content-type: application/json');
echo json_encode($response_array);
