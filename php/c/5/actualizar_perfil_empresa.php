<?php
session_start();
include_once("../../f/main_fnc.php");
if (isset($_FILES['foto_perfil'])){
    subir_imagen('usuarios',$_SESSION['id_usuario_bxpress'],$_FILES['foto_perfil'],array("jpg","jpeg","png"));
    $response_array['status'] = 'success';
    $response_array['msg'] = 'Foto actualizada';
    $response_array['titulo'] = '';
    $response_array['tipo'] = '';
}
header('Content-type: application/json');
echo json_encode($response_array);