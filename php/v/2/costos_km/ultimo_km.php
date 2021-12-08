<?php
include_once("../../../m/SQLConexion.php");
$sql = new SQLConexion();

$row_id_costo_km = $sql->obtenerResultado("SELECT COUNT(id_costo_km) AS 'id_costo' FROM costos_km ORDER BY km_hasta DESC LIMIT 0,1;");

if($row_id_costo_km){

    $row_costos_km = $sql->obtenerResultado("CALL sp_select_costos_km1();");
    $total_costos_km=count($row_costos_km);

    for ($i=0; $i < $total_costos_km; $i++) { 
        
        $hasta=$row_costos_km[$i]['km_hasta'];
        $total_costos_km_new = $sql->obtenerResultado("SELECT COUNT(id_costo_km) AS 'total' FROM costos_km WHERE km_desde=($hasta+0.01)");

        if($total_costos_km_new[0]['total']==0){
            $km_desde=($hasta+0.01);
            $km_hasta=$hasta+1;
            break;
        }
        else{
            $km_desde=$row_costos_km[$i]['km_hasta']+0.01;
            $km_hasta='';
        }
    }

    $response_array['costo_km_desde'] = $km_desde;
    $response_array['costo_km_hasta'] = $km_hasta;
}
else{
    $response_array['costo_km_desde'] = '0.00';
    $response_array['costo_km_hasta'] = '';
}

$row_simbolo = $sql->obtenerResultado("SELECT simbolo_tipo_cambio FROM empresa_reparto INNER JOIN tipos_cambios USING(id_tipo_cambio) WHERE id_empresa_reparto=1");

$response_array['simbolo']=$row_simbolo[0]['simbolo_tipo_cambio'];

header('Content-type: application/json');
echo json_encode($response_array);