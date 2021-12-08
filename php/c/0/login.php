<?php
session_start();
include_once("../../m/SQLConexion.php");
$sql = new SQLConexion();
$password = test_input($_POST['pass']);
$row = $sql->obtenerResultado("CALL sp_select_usuario_login('".test_input($_POST['usuario'])."')");
if(count($row) == 1){
    if (password_verify($_POST['pass'], $row[0]['contrasena_usuario'])) {
        if($row[0]['id_estado_usuario'] == (3 || 12) ){
            $_SESSION['id_usuario_bxpress'] = $row[0]['id_usuario'];
            $_SESSION['nivel_bxpress'] = $row[0]['nivel_usuario'];
            $response_array['status'] = 'success';
            $response_array['nivel'] = $row[0]['nivel_usuario'];
        }
        else{
            $response_array['title'] = 'Cuenta desactivada';
            $response_array['status'] = 'error';
            $response_array['msg'] = 'Su cuenta fue desactivada por un administrador.';
        }
    }else{
        $response_array['title'] = 'Credenciales invalidas';
        $response_array['status'] = 'error';
        $response_array['msg'] = 'Contraseña incorrecta';
    }
}else{
    $response_array['title'] = 'Error';
	$response_array['status'] = 'error';
	$response_array['msg'] = 'Este usuario no existe.';
}
header('Content-type: application/json');
echo json_encode($response_array);

function test_input($data) {
	return htmlspecialchars($data, ENT_QUOTES);
}
?>