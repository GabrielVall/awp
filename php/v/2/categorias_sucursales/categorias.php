<?php
include_once("../../../m/SQLConexion.php");
$sql = new SQLConexion();

$row_categorias = $sql->obtenerResultado("CALL sp_select_categorias_disponibles();");
$total_row_categorias = count($row_categorias);

?>
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="row align-items-center mb-2">
                <div class="col">
                    <h2 class="h3 page-title">Categorías de sucursales</h2>
                </div>
                <div class="col-auto">
                    <button class="btn btn-dark" data-toggle="modal" data-target="#modal_agregar">Agregar categoría</button>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <div class="card shadow">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <strong class="card-title float-left">Categorías de sucursales</strong>
                            <div class="form-group has-icon-left">
                                <div class="position-relative">
                                    <input type="text" class="form-control form-control-sm search-box" data-tbody="tbody_categorias_sucursal" data-colspan="2" placeholder="Buscar...">
                                    <div class="form-control-icon">
                                        <i class="fas fa-search"></i>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <ul class="pagination pagination-sm">
                                    <?php
                                        if($total_row_categorias>0){
                                            $limite_paginacion=10;
                                            $last_page=($total_row_categorias/$limite_paginacion);
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
                                            <th>Categoría</th>
                                            <th class="text-right">Opciones</th>
                                        </tr>
                                    </thead>
                                    <tbody id="tbody_categorias_sucursal">
                                        <?php
                                        if ($total_row_categorias > 0) {
                                            $page=1;    
                                            for ($i = 0; $i < $total_row_categorias; $i++) {

                                                if($i>=$limite_paginacion){
                                                    $page++;
                                                    $limite_paginacion+=$limite_paginacion;
                                                    $visibility='style="display:none;"';
                                                }
                                                else{
                                                    $visibility='';
                                                }

                                                echo
                                                '<tr '.$visibility.' class="page_'.$page.'" id="row_categoria_' . $row_categorias[$i]['id_categoria_sucursal'] . '">
                                                    <td class="title">' . $row_categorias[$i]['nombre_categoria_sucursal'] . '</td>
                                                    <td class="d-flex justify-content-end">
                                                        <button class="btn btn-sm btn-light d-flex align-items-center dropdown-toggle more-horizontal" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Opciones <span class="material-icons-round">expand_more</span></button>
                                                        <div class="dropdown-menu dropdown-menu-right">
                                                        <a class="dropdown-item" href="javascript:void(0);" data-id="' . $row_categorias[$i]['id_categoria_sucursal'] . '" id="editar_categoria_sucursal">Editar</a>
                                                        <a class="dropdown-item" href="javascript:void(0);" data-id="' . $row_categorias[$i]['id_categoria_sucursal'] . '" id="eliminar_categoria_sucursal">Eliminar</a>
                                                        </div>
                                                    </td>
                                                </tr>';
                                            }
                                        } else {
                                            echo
                                            '<tr id="categorias_empty">
                                                <td colspan="2">No se encontraron resultados</td>
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
                <h5 class="modal-title" id="defaultModalLabel">Agregar categoría</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body" id="content_agregar_categoria">
                <div class="form-group">
                    <label class="form-label">Nombre de la categoría</label>
                    <input type="text" class="form-control name_format form-control-sm" id="agregar_nombre_categoria">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn mb-2 btn-outline-dark" id="btn_agregar_categoria_sucursal">Agregar</button>
            </div>
        </div>
    </div>
</div>
<!-- EDITAR -->
<div class="modal fade" id="modal_editar" tabindex="-1" role="dialog" aria-labelledby="defaultModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="defaultModalLabel">Editar categoría</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body" id="content_editar_categoria">
                <div class="form-group">
                    <label class="form-label">Nombre de la categoría</label>
                    <input type="text" class="form-control name_format form-control-sm" id="editar_nombre_categoria">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn mb-2 btn-outline-dark" id="btn_editar_categoria_sucursal">Guardar</button>
            </div>
        </div>
    </div>
</div>
<!-- ELIMINAR -->
<div class="modal fade" id="modal_eliminar" tabindex="-1" role="dialog" aria-labelledby="defaultModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="defaultModalLabel">Eliminar categoría</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Está seguro de eliminar la categoría? De click en confirmar.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn mb-2 btn-outline-dark" id="btn_eliminar_categoria_sucursal">Confirmar</button>
            </div>
        </div>
    </div>
</div>