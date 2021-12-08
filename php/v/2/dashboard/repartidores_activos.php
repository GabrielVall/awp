<?php
include_once("../../../m/SQLConexion.php");
$sql = new SQLConexion();

$row_repartidores_activos = $sql->obtenerResultado("CALL sp_select_repartidores_activos1();");
$total_row_repartidores_activos = count($row_repartidores_activos);

?>
<div class="card-header d-flex justify-content-between align-items-center">
    <strong class="card-title float-left">Repartidores activos</strong>
    <div>
        <ul class="pagination pagination-sm">
            <?php
                if($total_row_repartidores_activos>0){
                    $limite_paginacion=10;
                    $last_page=($total_row_repartidores_activos/$limite_paginacion);
                    $bolean=false;
                    
                    if(is_float($last_page)){
                        $fin_for=($last_page+1);
                    }
                    else{
                        $fin_for=$last_page;
                    }

                    echo
                    '<li class="page-item paginate_button" id="prev_page">
                        <a class="page-link"><span aria-hidden="true">Ant.</span></a>
                    </li>';
                    for($i=0; $i<intval($fin_for); $i++){
                        
                        if(($i+1)<=5){
                            echo
                            '<li class="page-item paginate_button page-item-'.($i+1).' '; if($i==0){ echo 'active'; } echo'" id="new_page" data-page="'.($i+1).'"><a class="page-link">'.($i+1).'</a></li>';
                        }
                        else{
                            $bolean=true;
                        }

                    }
                    if($bolean==true){
                        
                        echo
                        '<li class="page-item paginate_button">
                            <a class="page-link">...</a>
                        </li>';
                    }
                    echo
                    '<li class="page-item paginate_button" id="next_page" data-last="'.intval($fin_for).'">
                        <a class="page-link"><span aria-hidden="true">Sig.</span></a>
                    </li>';
                }
                ?>
        </ul>
    </div>
</div>
<div class="card-body p-0 m-0">
    <table class="table table-borderless table-hover">
        <thead>
            <tr>
                <th>No.</th>
                <th colspan="2">Repartidor</th>
                <th class="text-center">Ordenes en progreso</th>
                <th class="text-right">Opciones</th>
            </tr>
        </thead>
        <tbody id="tbody_repartidores_activos">
            <?php
            if ($total_row_repartidores_activos > 0) {
                $page=1;
                for ($i = 0; $i < $total_row_repartidores_activos; $i++) {
                    

                    if($i>=$limite_paginacion){
                        $page++;
                        $limite_paginacion+=$limite_paginacion;
                        $visibility='style="display:none;"';
                    }
                    else{
                        $visibility='';
                    }

                    echo
                    '<tr '.$visibility.' class="page_'.$page.'">
                        <td>
                            <p class="mb-0 text-muted"><strong>#' . $row_repartidores_activos[$i]['id_repartidor'] . '</strong></p>
                        </td>
                        <td>
                            <div class="avatar avatar-sm">';
                                if (file_exists('../../../../img/usuarios/' . $row_repartidores_activos[$i]['id_usuario_repartidor']) && count(glob('../../../../img/usuarios/' . $row_repartidores_activos[$i]['id_usuario_repartidor'] . '/*')) > 0) {
                                    $directorio = opendir('../../../../img/usuarios/' . $row_repartidores_activos[$i]['id_usuario_repartidor']);
                                    while ($archivo = readdir($directorio)) {
                                        if ($archivo != '.' && $archivo != '.htaccess' && $archivo != '..') {
                                            echo '<img src="../img/usuarios/' . $row_repartidores_activos[$i]['id_usuario_repartidor'] . '/' . $archivo . '" class="avatar-img rounded-circle">';
                                        }
                                    }
                                } else {
                                    echo '<img src="../img/0/user-0.jpg" class="avatar-img rounded-circle">';
                                }
                            echo
                            '</div>
                        </td>
                        <td>
                            <p class="mb-0 text-muted"><strong>' . $row_repartidores_activos[$i]['nombre_repartidor'] . ' ' . $row_repartidores_activos[$i]['apellido_repartidor'] . '</strong></p>
                            <small class="mb-0 text-success">' . $row_repartidores_activos[$i]['nombre_estado_usuario'] . '</small>
                        </td>
                        <td class="text-center">
                            <p class="mb-0 text-muted"><strong>' . $row_repartidores_activos[$i]['total_ordenes_progreso'] . '</strong></p>
                        </td>
                        <td class="d-flex justify-content-end">
                            <button class="btn btn-sm btn-light d-flex align-items-center dropdown-toggle more-horizontal" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Opciones <span class="material-icons-round">expand_more</span></button>
                            <div class="dropdown-menu dropdown-menu-right">
                                <a class="dropdown-item" href="#info_conductor_' . $row_repartidores_activos[$i]['id_repartidor'] . '">Ver información</a>
                                <a class="dropdown-item" href="#asignar_orden_' . $row_repartidores_activos[$i]['id_repartidor'] . '">Asignar orden</a>
                                <a class="dropdown-item" href="#ubicacion_repartidor_'.$row_repartidores_activos[$i]['id_repartidor'].'">Ver ubicación actual</a>
                            </div>
                        </td>
                    </tr>';
                }
            }
            else{
                echo
                '<tr>
                    <td colspan="5">No se encontraron resultados</td>
                </tr>';
            }
            ?>
        </tbody>
    </table>
</div>