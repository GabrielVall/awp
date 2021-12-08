<?php
include_once("../../../m/SQLConexion.php");
$sql = new SQLConexion();

$row_repartidores = $sql->obtenerResultado("CALL sp_select_repartidores2(1);");
$total_row_repartidores = count($row_repartidores);

?>
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="row align-items-center mb-2">
                <div class="col">
                    <h2 class="h3 page-title">Repartidores</h2>
                </div>
                <div class="col-auto">
                    <a href="#nuevo_repartidor" class="btn btn-dark">Agregar repartidor</a>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <div class="card shadow" id="content_repartidores_activos">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <strong class="card-title float-left">Repartidores</strong>
                            <div class="form-group has-icon-left">
                                <div class="position-relative">
                                    <input type="text" class="form-control form-control-sm search-box" data-tbody="tbody_repartidor" data-colspan="6" placeholder="Buscar...">
                                    <div class="form-control-icon">
                                        <i class="fas fa-search"></i>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <ul class="pagination pagination-sm">
                                    <?php
                                        if($total_row_repartidores>0){
                                            $limite_paginacion=10;
                                            $last_page=($total_row_repartidores/$limite_paginacion);
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
                            <div class="table-responsive">
                                <table class="table border table-hover bg-white">
                                    <thead>
                                        <tr role="row">
                                            <th>Repartidor</th>
                                            <th>Tel. contacto</th>
                                            <th>Correo</th>
                                            <th>Dirección</th>
                                            <th>Ciudad</th>
                                            <th class="text-right">Opciones</th>
                                        </tr>
                                    </thead>
                                    <tbody id="tbody_repartidor">
                                        <?php
                                        if ($total_row_repartidores > 0) {
                                            $page=1;
                                            for ($i = 0; $i < $total_row_repartidores; $i++) {

                                                if($i>=$limite_paginacion){
                                                    $page++;
                                                    $limite_paginacion+=$limite_paginacion;
                                                    $visibility='style="display:none;"';
                                                }
                                                else{
                                                    $visibility='';
                                                }
                                                echo
                                                '<tr '.$visibility.' class="page_'.$page.'" id="row_repartidor_' . $row_repartidores[$i]['id_repartidor'] . '">
                                                    <td class="title">
                                                        <p class="mb-0 text-muted text-truncate"><strong>' . $row_repartidores[$i]['nombre_repartidor'] . '</strong></p>
                                                        <small class="mb-0 text-muted text-truncate">' . $row_repartidores[$i]['apellido_repartidor'] . '</small>
                                                    </td>
                                                    <td>' . $row_repartidores[$i]['telefono_repartidor'] . '</td>
                                                    <td>' . $row_repartidores[$i]['correo_repartidor'] . '</td>
                                                    <td>' . $row_repartidores[$i]['direccion_repartidor'] . '</td>
                                                    <td>
                                                        <p class="mb-0 text-muted text-truncate"><strong>' . $row_repartidores[$i]['nombre_ciudad'] . '</strong></p>
                                                        <small class="mb-0 text-muted text-truncate">' . $row_repartidores[$i]['nombre_estado'] . '</small>
                                                        <small class="mb-0 text-muted text-truncate">' . $row_repartidores[$i]['nombre_pais'] . '</small>
                                                    </td>
                                                    <td class="d-flex justify-content-end">
                                                        <button class="btn btn-sm btn-light d-flex align-items-center dropdown-toggle more-horizontal" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Opciones <span class="material-icons-round">expand_more</span></button>
                                                        <div class="dropdown-menu dropdown-menu-right">
                                                            <a class="dropdown-item" href="#info_conductor_' . $row_repartidores[$i]['id_repartidor'] . '">Ver información</a>
                                                            <a class="dropdown-item" href="javascript:void(0);" data-id="' . $row_repartidores[$i]['id_repartidor'] . '" id="eliminar_repartidor">Eliminar</a>
                                                        </div>
                                                    </td>
                                                </tr>';
                                            }
                                        } else {
                                            echo
                                            '<tr id="repartidores_empty">
                                                <td colspan="6">No se encontraron resultados</td>
                                            </tr>';
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- MODALES -->

<!-- ELIMINAR -->
<div class="modal fade" id="modal_eliminar" tabindex="-1" role="dialog" aria-labelledby="defaultModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="defaultModalLabel">Eliminar repartidor</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Está seguro de eliminar al repartidor? De click en confirmar.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn mb-2 btn-outline-dark" id="btn_eliminar_repartidor">Confirmar</button>
            </div>
        </div>
    </div>
</div>