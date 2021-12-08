<?php
include_once("../../../m/SQLConexion.php");
$sql = new SQLConexion();

$row_costos_km = $sql->obtenerResultado("CALL sp_select_costos_km1();");
$total_row_costos_km = count($row_costos_km);

?>
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="row align-items-center mb-2">
                <div class="col">
                    <h2 class="h3 page-title">Costos por km</h2>
                </div>
                <div class="col-auto">
                    <button class="btn btn-dark" id="agregar_costo_km">Agregar costo</button>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <div class="card shadow" id="content_repartidores_activos">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <strong class="card-title float-left">Costos por km</strong>
                            <div>
                                <ul class="pagination pagination-sm">
                                    <?php
                                        if($total_row_costos_km>0){
                                            $limite_paginacion=10;
                                            $last_page=($total_row_costos_km/$limite_paginacion);
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
                                            <th class="text-center">Desde</th>
                                            <th class="text-center">Hasta</th>
                                            <th class="text-center">Costo</th>
                                            <th class="text-right">Opciones</th>
                                        </tr>
                                    </thead>
                                    <tbody id="tbody_costos_km">
                                        <?php
                                        if ($total_row_costos_km > 0) {
                                            $page=1;
                                            for ($i = 0; $i < $total_row_costos_km; $i++) {

                                                if($i>=$limite_paginacion){
                                                    $page++;
                                                    $limite_paginacion+=$limite_paginacion;
                                                    $visibility='style="display:none;"';
                                                }
                                                else{
                                                    $visibility='';
                                                }
                                                echo
                                                '<tr '.$visibility.' class="page_'.$page.'" id="row_costo_km_' . $row_costos_km[$i]['id_costo_km'] . '">
                                                    <td class="text-center">' . $row_costos_km[$i]['km_desde'] . '</td>
                                                    <td class="text-center">' . $row_costos_km[$i]['km_hasta'] . '</td>
                                                    <td class="text-center">' . $row_costos_km[$i]['simbolo'] . $row_costos_km[$i]['costo_km'] . '</td>
                                                    <td class="d-flex justify-content-end">
                                                        <button class="btn btn-sm btn-light d-flex align-items-center dropdown-toggle more-horizontal" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Opciones <span class="material-icons-round">expand_more</span></button>
                                                        <div class="dropdown-menu dropdown-menu-right">
                                                        <a class="dropdown-item" href="javascript:void(0);" data-simbolo="'.$row_costos_km[$i]['simbolo'].'" data-id="' . $row_costos_km[$i]['id_costo_km'] . '" id="editar_costo_km">Editar</a>
                                                        <a class="dropdown-item" href="javascript:void(0);" data-id="' . $row_costos_km[$i]['id_costo_km'] . '" id="eliminar_costo_km">Eliminar</a>
                                                        </div>
                                                    </td>
                                                </tr>';
                                            }
                                        } else {
                                            echo
                                            '<tr id="costos_empty">
                                                <td colspan="4">No se encontraron resultados</td>
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

<!-- AGREGAR -->
<div class="modal fade" id="modal_agregar" tabindex="-1" role="dialog" aria-labelledby="defaultModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="defaultModalLabel">Agregar costo por km</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body" id="content_agregar_costo">
                <div class="row">
                    <div class="col-sm-12 col-md-6">
                        <div class="form-group">
                            <label class="form-label">Desde</label>
                            <input type="text" disabled class="form-control form-control-sm price_format" id="agregar_desde_km">
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-6">
                        <div class="form-group">
                            <label class="form-label">Hasta</label>
                            <input type="text" class="form-control form-control-sm price_format" id="agregar_hasta_km">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label class="form-label">Costo</label>
                    <input type="text" class="form-control col-6 form-control-sm price_format" id="agregar_precio_km">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn mb-2 btn-outline-dark" id="btn_agregar_costo_km">Agregar</button>
            </div>
        </div>
    </div>
</div>
<!-- EDITAR -->
<div class="modal fade" id="modal_editar" tabindex="-1" role="dialog" aria-labelledby="defaultModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="defaultModalLabel">Editar costo por km</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body" id="content_editar_costo">
                <div class="row">
                    <div class="col-sm-12 col-md-6">
                        <div class="form-group">
                            <label class="form-label">Desde</label>
                            <input type="text" disabled class="form-control form-control-sm price_format" id="editar_desde_km">
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-6">
                        <div class="form-group">
                            <label class="form-label">Hasta</label>
                            <input type="text" class="form-control form-control-sm price_format" id="editar_hasta_km">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label class="form-label">Costo</label>
                    <input type="text" class="form-control col-6 form-control-sm price_format" id="editar_precio_km">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn mb-2 btn-outline-dark" id="btn_editar_costo_km">Guardar</button>
            </div>
        </div>
    </div>
</div>
<!-- ELIMINAR -->
<div class="modal fade" id="modal_eliminar" tabindex="-1" role="dialog" aria-labelledby="defaultModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="defaultModalLabel">Eliminar costo por km</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Está seguro de eliminar el costo por km? De click en confirmar.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn mb-2 btn-outline-dark" id="btn_eliminar_costo_km">Confirmar</button>
            </div>
        </div>
    </div>
</div>