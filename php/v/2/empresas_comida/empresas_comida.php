<?php
include_once("../../../m/SQLConexion.php");
$sql = new SQLConexion();

$row_empresa_comida = $sql->obtenerResultado("CALL sp_select_empresas_comida1();");
$total_row_empresa_comida = count($row_empresa_comida);

?>
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="row align-items-center mb-2">
                <div class="col">
                    <h2 class="h3 page-title">Empresas de comida</h2>
                </div>
                <div class="col-auto">
                    <button class="btn btn-dark" data-toggle="modal" data-target="#modal_agregar">Agregar empresa</button>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <div class="card shadow" id="content_repartidores_activos">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <strong class="card-title float-left">Empresas de comida</strong>
                            <div class="form-group has-icon-left">
                                <div class="position-relative">
                                    <input type="text" class="form-control form-control-sm search-box" data-tbody="tbody_empresa_comida" data-colspan="5" placeholder="Buscar...">
                                    <div class="form-control-icon">
                                        <i class="fas fa-search"></i>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <ul class="pagination pagination-sm">
                                    <?php
                                        if($total_row_empresa_comida>0){
                                            $limite_paginacion=10;
                                            $last_page=($total_row_empresa_comida/$limite_paginacion);
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
                                            <th>Empresa</th>
                                            <th>Teléfono</th>
                                            <th>Correo</th>
                                            <th class="text-center">Límite de sucursales</th>
                                            <th class="text-right">Opciones</th>
                                        </tr>
                                    </thead>
                                    <tbody id="tbody_empresa_comida">
                                        <?php
                                        if ($total_row_empresa_comida > 0) {
                                            $page=1;
                                            for ($i = 0; $i < $total_row_empresa_comida; $i++) {

                                                if($i>=$limite_paginacion){
                                                    $page++;
                                                    $limite_paginacion+=$limite_paginacion;
                                                    $visibility='style="display:none;"';
                                                }
                                                else{
                                                    $visibility='';
                                                }
                                                echo
                                                '<tr '.$visibility.' class="page_'.$page.'" id="row_empresa_comida_' . $row_empresa_comida[$i]['id_empresa_comida'] . '">
                                                    <td class="title">' . $row_empresa_comida[$i]['nombre_empresa_comida'] . '</td>
                                                    <td>' . $row_empresa_comida[$i]['telefono_empresa_comida'] . '</td>
                                                    <td>' . $row_empresa_comida[$i]['correo_emp'] . '</td>
                                                    <td class="text-center">' . $row_empresa_comida[$i]['limite_sucursales_empresa_comida'] . '</td>
                                                    <td class="d-flex justify-content-end">
                                                        <button class="btn btn-sm btn-light d-flex align-items-center dropdown-toggle more-horizontal" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Opciones <span class="material-icons-round">expand_more</span></button>
                                                        <div class="dropdown-menu dropdown-menu-right">
                                                        <a class="dropdown-item" href="#empresa_comida_sucursales_' . $row_empresa_comida[$i]['id_empresa_comida'] . '">Ver sucursales</a>
                                                        <a class="dropdown-item" href="javascript:void(0);" data-id="' . $row_empresa_comida[$i]['id_empresa_comida'] . '" id="editar_empresa_comida">Editar</a>
                                                        <a class="dropdown-item" href="javascript:void(0);" data-id="' . $row_empresa_comida[$i]['id_empresa_comida'] . '" id="eliminar_empresa_comida">Eliminar</a>
                                                        </div>
                                                    </td>
                                                </tr>';
                                            }
                                        } else {
                                            echo
                                            '<tr id="empresas_comida_empty">
                                                <td colspan="5">No se encontraron resultados</td>
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
                <h5 class="modal-title" id="defaultModalLabel">Agregar empresa</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body" id="content_agregar_empresa">
                <div class="row">
                    <div class="col-sm-12 col-md-6">
                        <div class="form-group">
                            <label class="form-label">Nombre de empresa</label>
                            <input type="text" class="form-control form-control-sm name_format" id="agregar_nombre_empresa_comida">
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-6">
                        <div class="form-group">
                            <label class="form-label">Teléfono</label>
                            <input type="text" class="form-control form-control-sm phone_format" id="agregar_telefono_empresa_comida">
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-6">
                        <div class="form-group">
                            <label class="form-label">Correo</label>
                            <input type="text" class="form-control form-control-sm email_format" id="agregar_correo_empresa_comida">
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-6">
                        <div class="form-group">
                            <label class="form-label">Límite de sucursales</label>
                            <input type="text" class="form-control form-control-sm phone_format" id="agregar_limite_sucursal_empresa_comida">
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-6">
                        <div class="form-group">
                            <label class="form-label">Nombre de usuario</label>
                            <input type="text" class="form-control form-control-sm string_format" id="agregar_usuario_empresa_comida">
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-6">
                        <div class="form-group">
                            <label class="form-label">Contraseña</label>
                            <input type="password" class="form-control form-control-sm" id="agregar_contrasena_empresa_comida">
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn mb-2 btn-outline-dark" id="btn_agregar_empresa_comida">Agregar</button>
            </div>
        </div>
    </div>
</div>
<!-- EDITAR -->
<div class="modal fade" id="modal_editar" tabindex="-1" role="dialog" aria-labelledby="defaultModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="defaultModalLabel">Editar empresa</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body" id="content_editar_empresa">
                <div class="row">
                    <div class="col-sm-12 col-md-6">
                        <div class="form-group">
                            <label class="form-label">Nombre de empresa</label>
                            <input type="text" class="form-control form-control-sm name_format" id="editar_nombre_empresa_comida">
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-6">
                        <div class="form-group">
                            <label class="form-label">Teléfono</label>
                            <input type="text" class="form-control form-control-sm phone_format" id="editar_telefono_empresa_comida">
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-6">
                        <div class="form-group">
                            <label class="form-label">Correo</label>
                            <input type="text" class="form-control form-control-sm email_format" id="editar_correo_empresa_comida">
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-6">
                        <div class="form-group">
                            <label class="form-label">Límite de sucursales</label>
                            <input type="text" class="form-control form-control-sm phone_format" id="editar_limite_sucursal_empresa_comida">
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn mb-2 btn-outline-dark" id="btn_editar_empresa_comida">Guardar</button>
            </div>
        </div>
    </div>
</div>
<!-- ELIMINAR -->
<div class="modal fade" id="modal_eliminar" tabindex="-1" role="dialog" aria-labelledby="defaultModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="defaultModalLabel">Eliminar empresa</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Está seguro de eliminar la empresa? De click en confirmar.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn mb-2 btn-outline-dark" id="btn_eliminar_empresa_comida">Confirmar</button>
            </div>
        </div>
    </div>
</div>