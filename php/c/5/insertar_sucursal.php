<?php
session_start();
include_once("../../m/SQLConexion.php");
$sql = new SQLConexion();
include_once("../../f/main_fnc.php");
if($_POST['id'] != 0){
    $rpta = $sql->obtenerResultadoSimple("CALL sp_update_sucursal_empresa_comida('".$_POST['id']."','".$_SESSION['id_empresa_comida_bxpress']."','".$_POST['nombre_sucursal']."','".$_POST['id_ciudad']."','".$_POST['direccion']."','".$_POST['categoria_select']."','".$_POST['telefono']."','".$_POST['telefono_wsp']."','".$_POST['descripcion']."','".$_POST['lat']."','".$_POST['long']."')");
    if($rpta){
        $response_array['status'] = 'success';
        $response_array['msg'] = 'Sucursal editada';
        $response_array['titulo'] = '';
        $response_array['tipo'] = '';
        if (isset($_FILES['imagen_sucursal'])){
            subir_imagen('sucursales',$_POST['id'],$_FILES['imagen_sucursal'],array("jpg","jpeg","png","gif"));
        }
    }else{
        $response_array['titulo'] = 'Error';
        $response_array['msg'] = "Fallo al comunicar con el servidor, intenta más tarde";
    }
}else{
    $rpta = $sql->obtenerResultadoID("CALL sp_insert_sucursal_empresa_comida(1,'".$_SESSION['id_empresa_comida_bxpress']."','".$_POST['nombre_sucursal']."','".$_POST['id_ciudad']."','".$_POST['direccion']."','".$_POST['categoria_select']."','".$_POST['telefono']."','".$_POST['telefono_wsp']."','".$_POST['descripcion']."','".$_POST['lat']."','".$_POST['long']."',@_ID)");
    if($rpta[0][0] > 0){
        $response_array['status'] = 'success';
        $response_array['msg'] = 'Sucursal agregada';
        $response_array['titulo'] = '';
        $response_array['tipo'] = '';
        subir_imagen('sucursales',$rpta[0][0],$_FILES['imagen_sucursal'],array("jpg","jpeg","png","gif"));
    }else if($rpta[0][0] === 0){
        $response_array['titulo'] = 'Error';
        $response_array['msg'] = 'Haz alcanzado el limite de sucursales, comunicate con tu proveedor para obtener más información.';
        $response_array['titulo'] = 'Sin sucursales disponibles';
        $response_array['tipo'] = 'alerta';
        
        
    }else{
        $response_array['status'] = 'error';
        $response_array['msg'] = 'Conexion inestable, intenta más tarde';
        $response_array['titulo'] = '';
        $response_array['tipo'] = '';
    }
    
}


header('Content-type: application/json');
    echo json_encode($response_array);