<?php
session_start();
include_once("../../../m/SQLConexion.php");
$sql = new SQLConexion();

$row_notificaciones = $sql->obtenerResultado("CALL sp_select_notificaciones1('" . $_SESSION['id_usuario_bexpress'] . "');");
$total_row_notificaciones = count($row_notificaciones);
$response_array['total_row']=$total_row_notificaciones;

if($total_row_notificaciones>0){
    $response_array['row']='';
    foreach ($row_notificaciones as $key => $value) {
        $response_array['row'].=
        '<div class="list-group-item bg-transparent"'; if($value['id_orden']>0){ $response_array['row'].= 'data-dismiss="modal"'; } $response_array['row'].= 'id="seleccionar_notificacion" data-orden="'.$value['id_orden'].'" style="cursor:pointer;">
            <div class="row align-items-center">
                <div class="col-auto">
                    <span class="material-icons-round">note_alt</span>
                </div>
                <div class="col">
                    <small><strong>'.$value['titulo_notificacion'].'</strong></small>
                    <div class="my-0 text-muted small">'.$value['mensaje_notificacion'].'</div>
                    <small fecha-hora="'.$value['fecha_notificacion'].'" class="badge badge-pill badge-light text-muted"></small>
                </div>
            </div>
        </div>';
    }
}
else{
    $response_array['row']=
    '<div class="list-group-item bg-transparent">
        <div class="row align-items-center">
            <div class="col-auto">
                <span class="material-icons-round">remove</span>
            </div>
            <div class="col">
                <small><strong>No tienes notificaciones</strong></small>
            </div>
        </div>
    </div>';
}

header('Content-type: application/json');
echo json_encode($response_array);

?>