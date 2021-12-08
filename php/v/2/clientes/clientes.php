<?php
include_once("../../../m/SQLConexion.php");
$sql = new SQLConexion();

$row_clientes = $sql->obtenerResultado("CALL sp_select_clientes1();");
$total_row_clientes = count($row_clientes);

?>
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="row align-items-center mb-2">
                <div class="col">
                    <h2 class="h3 page-title">Clientes</h2>
                </div>
                <div class="col-auto">
                    <button class="btn btn-sm btn-dark d-flex align-items-center dropdown-toggle more-horizontal" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Opciones <span class="material-icons-round">expand_more</span></button>
                    <div class="dropdown-menu dropdown-menu-right">
                    <a href="#nuevo_cliente" class="dropdown-item d-flex align-items-center"><span class="material-icons">person_add</span>&nbspAgregar cliente</a>
                        <a class="dropdown-item d-flex align-items-center" href="javascript:void(0);" id="exportar_clientes_excel"><span class="material-icons text-success">description</span>&nbspFormato Excel</a>
                        <a class="dropdown-item d-flex align-items-center" href="javascript:void(0);" id="exportar_clientes_pdf"><span class="material-icons text-danger">picture_as_pdf</span>&nbspFormato PDF</a>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <div class="card shadow" id="content_repartidores_activos">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <strong class="card-title float-left">Clientes</strong>
                            <div class="form-group has-icon-left">
                                <div class="position-relative">
                                    <input type="text" class="form-control form-control-sm search-box" data-tbody="tbody_cliente" data-colspan="5" placeholder="Buscar...">
                                    <div class="form-control-icon">
                                        <i class="fas fa-search"></i>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <ul class="pagination pagination-sm">
                                    <?php
                                        if($total_row_clientes>0){
                                            $limite_paginacion=10;
                                            $last_page=($total_row_clientes/$limite_paginacion);
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
                                            <th>Cliente</th>
                                            <th>Teléfono</th>
                                            <th>Correo</th>
                                            <th>Ciudad</th>
                                            <th class="text-right">Opciones</th>
                                        </tr>
                                    </thead>
                                    <tbody id="tbody_cliente">
                                        <?php
                                        if ($total_row_clientes > 0) {
                                            $page=1;
                                            for ($i = 0; $i < $total_row_clientes; $i++) {

                                                if($i>=$limite_paginacion){
                                                    $page++;
                                                    $limite_paginacion+=$limite_paginacion;
                                                    $visibility='style="display:none;"';
                                                }
                                                else{
                                                    $visibility='';
                                                }
                                                echo
                                                '<tr '.$visibility.' class="page_'.$page.'" id="row_cliente_' . $row_clientes[$i]['id_cliente'] . '">
                                                    <td class="title">
                                                        <p class="mb-0 text-muted text-truncate"><strong>' . $row_clientes[$i]['nombre_cliente'] . '</strong></p>
                                                        <small class="mb-0 text-muted text-truncate">' . $row_clientes[$i]['apellido_cliente'] . '</small>
                                                    </td>
                                                    <td>' . $row_clientes[$i]['telefono_cliente'] . '</td>
                                                    <td>' . $row_clientes[$i]['correo_cliente'] . '</td>
                                                    <td>
                                                        <p class="mb-0 text-muted text-truncate"><strong>' . $row_clientes[$i]['nombre_ciudad'] . '</strong></p>
                                                        <small class="mb-0 text-muted text-truncate">' . $row_clientes[$i]['nombre_estado'] . '</small>
                                                        <small class="mb-0 text-muted text-truncate">' . $row_clientes[$i]['nombre_pais'] . '</small>
                                                    </td>
                                                    <td class="d-flex justify-content-end">
                                                        <a class="btn btn-light" href="#customer_' . $row_clientes[$i]['id_cliente'] . '">Ver información</a>
                                                    </td>
                                                </tr>';
                                            }
                                        } else {
                                            echo
                                            '<tr id="repartidores_empty">
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

<!-- ELIMINAR -->
<div class="modal fade" id="modal_eliminar" tabindex="-1" role="dialog" aria-labelledby="defaultModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="defaultModalLabel">Eliminar cliente</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Está seguro de eliminar al cliente? De click en confirmar.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn mb-2 btn-outline-dark" id="btn_eliminar_cliente">Confirmar</button>
            </div>
        </div>
    </div>
</div>