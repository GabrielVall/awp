<?php
include_once("../../../m/SQLConexion.php");
$sql = new SQLConexion();

$row_sucursales_express = $sql->obtenerResultado("CALL sp_select_sucursales_express1();");
$total_row_sucursales_express = count($row_sucursales_express);

$row_categorias_sucursales = $sql->obtenerResultado("CALL sp_select_categorias_disponibles();");
$total_row_categorias_sucursales = count($row_categorias_sucursales);

$row_paises = $sql->obtenerResultado("CALL sp_select_paises();");
$total_row_paises = count($row_paises);

?>
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="row align-items-center mb-2">
                <div class="col">
                    <h2 class="h3 page-title">Sucursales express</h2>
                </div>
                <div class="col-auto">
                    <button class="btn btn-dark" data-toggle="modal" data-target="#modal_agregar">Agregar sucursal</button>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <div class="card shadow" id="content_repartidores_activos">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <strong class="card-title float-left">Sucursales express</strong>
                            <div class="form-group has-icon-left">
                                <div class="position-relative">
                                    <input type="text" class="form-control form-control-sm search-box" data-tbody="tbody_sucursal_express" data-colspan="4" placeholder="Buscar...">
                                    <div class="form-control-icon">
                                        <i class="fas fa-search"></i>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <ul class="pagination pagination-sm">
                                    <?php
                                        if($total_row_sucursales_express>0){
                                            $limite_paginacion=10;
                                            $last_page=($total_row_sucursales_express/$limite_paginacion);
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
                                            <th>Costo por km</th>
                                            <th class="text-right">Opciones</th>
                                        </tr>
                                    </thead>
                                    <tbody id="tbody_sucursal_express">
                                        <?php
                                        if ($total_row_sucursales_express > 0) {
                                            $page=1;
                                            for ($i = 0; $i < $total_row_sucursales_express; $i++) {

                                                if($i>=$limite_paginacion){
                                                    $page++;
                                                    $limite_paginacion+=$limite_paginacion;
                                                    $visibility='style="display:none;"';
                                                }
                                                else{
                                                    $visibility='';
                                                }
                                                echo
                                                '<tr '.$visibility.' class="page_'.$page.'" id="row_sucursal_' . $row_sucursales_express[$i]['id_sucursal_express'] . '">
                                                    <td class="title">' . $row_sucursales_express[$i]['nombre_sucursal_express'] . '</td>
                                                    <td>' . $row_sucursales_express[$i]['nombre_categoria_sucursal'] . '</td>
                                                    <td>' .$row_sucursales_express[$i]['simbolo_tipo_cambio']. $row_sucursales_express[$i]['costo_km_sucursal_express'] . '</td>
                                                    <td class="d-flex justify-content-end">
                                                        <button class="btn btn-sm btn-light d-flex align-items-center dropdown-toggle more-horizontal" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Opciones <span class="material-icons-round">expand_more</span></button>
                                                        <div class="dropdown-menu dropdown-menu-right">
                                                            <a class="dropdown-item" href="#ban_express_sucursal_'.$row_sucursales_express[$i]['id_sucursal_express'].'" id="ban_express_sucursal_'.$row_sucursales_express[$i]['id_sucursal_express'].'">Clientes bloqueados</a>
                                                            <a class="dropdown-item" href="javascript:void(0);" data-simbolo="'.$row_sucursales_express[$i]['simbolo_tipo_cambio'].'" data-ciudad="'.$row_sucursales_express[$i]['id_categoria_sucursal'].'" data-categoria="'.$row_sucursales_express[$i]['id_categoria_sucursal'].'" data-id="' . $row_sucursales_express[$i]['id_sucursal_express'] . '" id="editar_sucursal_express">Editar</a>
                                                            <a class="dropdown-item" href="javascript:void(0);" data-id="' . $row_sucursales_express[$i]['id_sucursal_express'] . '" id="eliminar_sucursal_express">Eliminar</a>
                                                        </div>
                                                    </td>
                                                </tr>';
                                            }
                                        } else {
                                            echo
                                            '<tr id="sucursal_express_empty">
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
                <h5 class="modal-title" id="defaultModalLabel">Agregar sucursal</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body" id="content_agregar_sucursal">
                <div class="row">
                    <div class="col-sm-12 col-md-6">
                        <div class="form-group">
                            <label class="form-label">Nombre de la sucursal</label>
                            <input type="text" class="form-control form-control-sm name_format" id="agregar_nombre_sucursal">
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-6">
                        <div class="form-group">
                            <label class="form-label">Costo por km</label>
                            <input type="text" class="form-control form-control-sm price_format" id="agregar_costo_km_sucursal">
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-6">
                        <div class="form-group">
                            <label class="form-label">Ciudad</label>
                            <select id="agregar_id_ciudad">
                                <?php
                                if($total_row_paises>0){
                                    foreach ($row_paises as $dato_pais) {
                                        
                                        $row_estados = $sql->obtenerResultado("CALL sp_select_estados2('".$dato_pais['id_pais']."');");
                                        $total_row_estados = count($row_estados);
                                        
                                        echo
                                        '<optgroup label="'.$dato_pais['nombre_pais'].'">';
                                            if($total_row_estados>0){
                                                foreach ($row_estados as $dato_estado) {

                                                    $row_ciudades = $sql->obtenerResultado("CALL sp_select_ciudades2('".$dato_estado['id_estado']."');");
                                                    $total_row_ciudades = count($row_ciudades);

                                                    echo
                                                    '<optgroup label="&nbsp&nbsp&nbsp'.$dato_estado['nombre_estado'].'">';
                                                        if($total_row_ciudades>0){
                                                            foreach($row_ciudades as $dato_ciudad){
                                                                echo '<option name="'.$dato_ciudad['nombre_ciudad'].'" value="'.$dato_ciudad['id_ciudad'].'">&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp'.$dato_ciudad['nombre_ciudad'].'</option>';
                                                            }
                                                        }
                                                    echo
                                                    '</optgroup>';
                                                }
                                            }
                                        echo
                                        '</optgroup>';
                                    }
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-6">
                        <div class="form-group">
                            <label class="form-label">Categoría de la sucursal</label>
                            <select id="agregar_id_categoria_sucursal">
                                <?php
                                if($total_row_categorias_sucursales>0){
                                    foreach ($row_categorias_sucursales as $dato) {
                                        
                                        $row_sucursal[0]['id_categoria_sucursal']==$dato['id_categoria_sucursal'] ? $selected='selected' : $selected='';

                                        echo '<option '.$selected.' name="'.$dato['nombre_categoria_sucursal'].'" value="'.$dato['id_categoria_sucursal'].'">'.$dato['nombre_categoria_sucursal'].'</option>';
                                    }
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn mb-2 btn-outline-dark" id="btn_agregar_sucursal_express">Agregar</button>
            </div>
        </div>
    </div>
</div>
<!-- EDITAR -->
<div class="modal fade" id="modal_editar" tabindex="-1" role="dialog" aria-labelledby="defaultModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="defaultModalLabel">Editar sucursal</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body" id="content_editar_sucursal">
                <div class="row">
                    <div class="col-sm-12 col-md-6">
                        <div class="form-group">
                            <label class="form-label">Nombre de la sucursal</label>
                            <input type="text" class="form-control form-control-sm name_format" id="editar_nombre_sucursal">
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-6">
                        <div class="form-group">
                            <label class="form-label">Costo por km</label>
                            <input type="text" class="form-control form-control-sm price_format" id="editar_costo_km_sucursal">
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-6">
                        <div class="form-group">
                            <label class="form-label">Ciudad</label>
                            <select id="editar_id_ciudad">
                                <?php
                                if($total_row_paises>0){
                                    foreach ($row_paises as $dato_pais) {
                                        
                                        $row_estados = $sql->obtenerResultado("CALL sp_select_estados2('".$dato_pais['id_pais']."');");
                                        $total_row_estados = count($row_estados);
                                        
                                        echo
                                        '<optgroup label="'.$dato_pais['nombre_pais'].'">';
                                            if($total_row_estados>0){
                                                foreach ($row_estados as $dato_estado) {

                                                    $row_ciudades = $sql->obtenerResultado("CALL sp_select_ciudades2('".$dato_estado['id_estado']."');");
                                                    $total_row_ciudades = count($row_ciudades);

                                                    echo
                                                    '<optgroup label="&nbsp&nbsp&nbsp'.$dato_estado['nombre_estado'].'">';
                                                        if($total_row_ciudades>0){
                                                            foreach($row_ciudades as $dato_ciudad){
                                                                echo '<option name="'.$dato_ciudad['nombre_ciudad'].'" value="'.$dato_ciudad['id_ciudad'].'">&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp'.$dato_ciudad['nombre_ciudad'].'</option>';
                                                            }
                                                        }
                                                    echo
                                                    '</optgroup>';
                                                }
                                            }
                                        echo
                                        '</optgroup>';
                                    }
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-6">
                        <div class="form-group">
                            <label class="form-label">Categoría de la sucursal</label>
                            <select id="editar_id_categoria_sucursal">
                                <?php
                                if($total_row_categorias_sucursales>0){
                                    foreach ($row_categorias_sucursales as $dato) {
                                        
                                        $row_sucursal[0]['id_categoria_sucursal']==$dato['id_categoria_sucursal'] ? $selected='selected' : $selected='';

                                        echo '<option '.$selected.' name="'.$dato['nombre_categoria_sucursal'].'" value="'.$dato['id_categoria_sucursal'].'">'.$dato['nombre_categoria_sucursal'].'</option>';
                                    }
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn mb-2 btn-outline-dark" id="btn_editar_sucursal_express">Guardar</button>
            </div>
        </div>
    </div>
</div>
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
                <button type="button" class="btn mb-2 btn-outline-dark" id="btn_eliminar_sucursal_express">Confirmar</button>
            </div>
        </div>
    </div>
</div>
<script>
    // SLIMSELECT
    var select_agregar_rid_categoria_sucursal = new SlimSelect({
        select: '#agregar_id_categoria_sucursal',
        searchText: 'No se encontraron resultados',
        searchPlaceholder: 'Buscar',
        placeholder: 'Seleccione una categoría de sucursal',
    });
    var select_agregar_id_ciudad = new SlimSelect({
        select: '#agregar_id_ciudad',
        searchText: 'No se encontraron resultados',
        searchPlaceholder: 'Buscar',
        placeholder: 'Seleccione una ciudad',
    });
    var select_editar_id_categoria_sucursal = new SlimSelect({
        select: '#editar_id_categoria_sucursal',
        searchText: 'No se encontraron resultados',
        searchPlaceholder: 'Buscar',
        placeholder: 'Seleccione una categoría de sucursal',
    });
    var select_editar_id_ciudad = new SlimSelect({
        select: '#editar_id_ciudad',
        searchText: 'No se encontraron resultados',
        searchPlaceholder: 'Buscar',
        placeholder: 'Seleccione una ciudad',
    });
</script>