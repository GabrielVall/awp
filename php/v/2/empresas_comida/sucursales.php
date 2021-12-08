<?php
include_once("../../../m/SQLConexion.php");
$sql = new SQLConexion();

$row_sucursales = $sql->obtenerResultado("CALL sp_select_sucursales4('".$_POST['id_empresa_comida']."');");
$total_row_sucursales = count($row_sucursales);

?>
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="row align-items-center mb-2">
                <div class="col">
                    <h2 class="h3 page-title">Sucursales de la empresa</h2>
                </div>
                <div class="col-auto">
                    <div class="page-header-breadcrumb">
                        <ul class="breadcrumb bg-light">
                            <li class="breadcrumb-item"><a href="#empresas_comida" class="text-decoration-none text-muted">Empresas de reparto</a></li>
                            <li class="breadcrumb-item"><a href="javascript:void(0);" class="text-decoration-none text-muted">Sucursales</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <div class="card shadow" id="content_repartidores_activos">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <strong class="card-title float-left">Sucursales</strong>
                            <div class="form-group has-icon-left">
                                <div class="position-relative">
                                    <input type="text" class="form-control form-control-sm search-box" data-tbody="tbody_sucursal" data-colspan="7" placeholder="Buscar...">
                                    <div class="form-control-icon">
                                        <i class="fas fa-search"></i>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <ul class="pagination pagination-sm">
                                    <?php
                                        if($total_row_sucursales>0){
                                            $limite_paginacion=10;
                                            $last_page=($total_row_sucursales/$limite_paginacion);
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
                                            <th>Sucursal</th>
                                            <th>Categoría</th>
                                            <th>Tel. contacto</th>
                                            <th>Tel. whatsapp</th>
                                            <th>Dirección</th>
                                            <th>Ciudad</th>
                                            <th>Empresa</th>
                                            <th class="text-right">Opciones</th>
                                        </tr>
                                    </thead>
                                    <tbody id="tbody_sucursal">
                                        <?php
                                        if ($total_row_sucursales > 0) {
                                            $page=1;
                                            for ($i = 0; $i < $total_row_sucursales; $i++) {

                                                if($i>=$limite_paginacion){
                                                    $page++;
                                                    $limite_paginacion+=$limite_paginacion;
                                                    $visibility='style="display:none;"';
                                                }
                                                else{
                                                    $visibility='';
                                                }

                                                echo
                                                '<tr '.$visibility.' class="page_'.$page.'" id="row_sucursal_' . $row_sucursales[$i]['id_sucursal'] . '">
                                                    <td class="title">' . $row_sucursales[$i]['nombre_sucursal'] . '</td>
                                                    <td>' . $row_sucursales[$i]['nombre_categoria_sucursal'] . '</td>
                                                    <td>' . $row_sucursales[$i]['telefono_sucursal'] . '</td>
                                                    <td>' . $row_sucursales[$i]['telefono_whatsapp_sucursal'] . '</td>
                                                    <td>' . $row_sucursales[$i]['direccion_sucursal'] . '</td>
                                                    <td>
                                                        <p class="mb-0 text-muted text-truncate"><strong>' . $row_sucursales[$i]['nombre_ciudad'] . '</strong></p>
                                                        <small class="mb-0 text-muted text-truncate">' . $row_sucursales[$i]['nombre_estado'] . '</small>
                                                        <small class="mb-0 text-muted text-truncate">' . $row_sucursales[$i]['nombre_pais'] . '</small>
                                                    </td>
                                                    <td>' . $row_sucursales[$i]['nombre_empresa_comida'] . '</td>
                                                    <td class="d-flex justify-content-end">
                                                        <button class="btn btn-sm btn-light d-flex align-items-center dropdown-toggle more-horizontal" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Opciones <span class="material-icons-round">expand_more</span></button>
                                                        <div class="dropdown-menu dropdown-menu-right">
                                                            <a class="dropdown-item" href="#sucursal_' . $row_sucursales[$i]['id_sucursal'] . '">Ver información</a>
                                                            <a class="dropdown-item" href="javascript:void(0);" data-id="' . $row_sucursales[$i]['id_sucursal'] . '" id="eliminar_sucursal">Eliminar</a>
                                                        </div>
                                                    </td>
                                                </tr>';
                                            }
                                        } else {
                                            echo
                                            '<tr id="sucursal_express_empty">
                                                <td colspan="7">No se encontraron resultados</td>
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
                <h5 class="modal-title" id="defaultModalLabel">Eliminar sucursal</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Está seguro de eliminar la sucursal? De click en confirmar.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn mb-2 btn-outline-dark" id="btn_eliminar_sucursal">Confirmar</button>
            </div>
        </div>
    </div>
</div>