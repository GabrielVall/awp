<?php
session_start();
include_once("../../../m/SQLConexion.php");
$sql = new SQLConexion();

$row_ingredientes=$sql->obtenerResultado("CALL sp_select_ingredientes1('".$_SESSION['id_sucursal_ingrediente']."')");
$total_row_ingredientes=count($row_ingredientes);

$simbolo = $sql->obtenerResultado("SELECT simbolo_tipo_cambio FROM empresa_reparto INNER JOIN tipos_cambios USING(id_tipo_cambio) WHERE id_empresa_reparto=1");

?>
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="row align-items-center mb-2">
                <div class="col">
                    <h2 class="h3 page-title">Agregar nuevo ingrediente</h2>
                </div>
                <div class="col-auto"></div>
            </div>
            <div class="card shadow">
                <div class="card-header">
                    <strong class="card-title">Nuevo ingrediente</strong>
                </div>
                <div class="card-body py-4 mb-1">
                    <div class="row">
                        <div class="col-sm-12 col-md-4 border-right" id="content_ingrediente">
                            <div class="form-group">
                                <label class="form-label">Nombre</label>
                                <input type="text" class="form-control name_format form-control-sm" id="nombre_ingrediente">
                            </div>
                            <div class="row">
                                <div class="col-sm-12 col-md-6">
                                    <div class="form-group">
                                        <label class="form-label">Cantidad mínima</label>
                                        <input type="text" class="form-control phone_format form-control-sm" id="cantidad_minima_ingrediente">
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-6">
                                    <div class="form-group">
                                        <label class="form-label">Cantidad máxima</label>
                                        <input type="text" class="form-control phone_format form-control-sm" id="cantidad_maxima_ingrediente">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Selección múltiple</label>
                                <select id="seleccion_multiple_ingrediente" class="form-control form-control-sm">
                                    <option value="0">No</option>
                                    <option value="1">Si</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-8">
                            <div class="form-group text-right">
                                <a href="javascript:void(0)" class="text-muted" data-toggle="modal" data-target="#modal_ing_extra">Agregar adicional</a>
                            </div>
                            <div class="form-group">
                                <table class="table table-striped table-hover">
                                    <thead>
                                        <tr>
                                            <th>Nombre</th>
                                            <th class="text-center">Precio</th>
                                            <th>Subcomplementos</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody id="tbody_ingredientes_extras"></tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="form-group text-right mt-4">
                        <button class="btn btn-outline-dark" id="btn_agregar_ingrediente" data-simbolo="<?php echo $simbolo[0]['simbolo_tipo_cambio']; ?>" data-id="<?php echo $_SESSION['id_sucursal_producto']; ?>">Agregar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- MODALES -->

<!-- AGREGAR INGREDIENTE EXTRA -->
<div class="modal fade" id="modal_ing_extra" tabindex="-1" role="dialog" aria-labelledby="defaultModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="defaultModalLabel">Agregar adicional</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body" id="content_ing_adicional">
                <div class="row">
                    <div class="col-sm-12 col-md-6">
                        <label class="form-label">Nombre</label>
                        <input type="text" id="nombre_adicional" class="form-control name_format form-control-sm">
                    </div>
                    <div class="col-sm-12 col-md-6">
                        <label class="form-label">Precio</label>
                        <input type="text" id="precio_adicional" class="form-control price_format form-control-sm">
                    </div>
                </div>
                <div class="form-group mt-2">
                    <label class="form-label">Agregar subcomplementos</label>
                    <select multiple id="id_sub_complementos">
                        <?php
                        if($total_row_ingredientes>0){
                            foreach($row_ingredientes as $dato){
                                echo '<option name="'.$dato['nombre_ingrediente'].'" value="'.$dato['id_ingrediente'].'">'.$dato['nombre_ingrediente'].'</option>';
                            }
                        }
                        else{
                            echo '<option value="0">No se encontraron resultados</option>';
                        }
                        ?>
                    </select>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn mb-2 btn-outline-dark" id="btn_agregar_ingrediente_adicional" data-simbolo="<?php echo $simbolo[0]['simbolo_tipo_cambio']; ?>">Agregar</button>
            </div>
        </div>
    </div>
</div>
<script>
    // SLIMSELECT
    var select_id_sub_complementos = new SlimSelect({
        select: '#id_sub_complementos',
        searchText: 'No se encontraron resultados',
        searchPlaceholder: 'Buscar',
        placeholder: 'Seleccione un subcomplemento',
        closeOnSelect: false,
    });
</script>