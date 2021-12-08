<?php
include_once("../../../m/SQLConexion.php");
$sql = new SQLConexion();

$row_tipos_cambios = $sql->obtenerResultado("CALL sp_select_tipos_cambios1();");
$total_row_tipos_cambios = count($row_tipos_cambios);

$row_zonas_horarias = $sql->obtenerResultado("CALL sp_select_zonas_horarias1();");
$total_row_zonas_horarias = count($row_zonas_horarias);

$row_config = $sql->obtenerResultado("CALL sp_select_empresa_reparto3();");
?>
<div class="container-fluid">
    <div class="row">
        <div class="col">
            <h2 class="h3 page-title">Configuración avanzada</h2>
        </div>
        <div class="col-auto"></div>
        <div class="col-md-12">
            <div class="card shadow">
                <div class="card-header">
                    <strong class="card-title">Configuración avanzada</strong>
                </div>
                <div class="card-body" id="content_info">
                    <div class="row">
                        <div class="col-sm-12 col-md-6">
                            <div class="form-group">
                                <p class="mb-2"><strong>Tipo de cambio</strong></p>
                                <label class="form-label">El tipo de cambio se mostrará en los precios del producto y detalles de la orden</label>
                                <select id="id_tipo_cambio" class="col-6">
                                    <?php
                                        if($total_row_tipos_cambios>0){
                                            foreach ($row_tipos_cambios as $dato) {
                                                $row_config[0]['id_tipo_cambio']==$dato['id_tipo_cambio'] ? $selected='selected' : $selected='';
                                                echo '<option '.$selected.' value="'.$dato['id_tipo_cambio'].'">'.$dato['nombre_tipo_cambio'].'</option>';
                                            }
                                        }
                                    ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <p class="mb-2"><strong>Zona horaria</strong></p>
                                <select id="id_zona_horaria" class="col-6">
                                    <?php
                                        if($total_row_zonas_horarias>0){
                                            foreach ($row_zonas_horarias as $dato) {
                                                $row_config[0]['id_zona_horaria']==$dato['id_zona_horaria'] ? $selected='selected' : $selected='';
                                                echo '<option '.$selected.' value="'.$dato['id_zona_horaria'].'">'.$dato['nombre_zona_horaria'].' - ('.$dato['valor_zona_horaria'].')</option>';
                                            }
                                        }
                                    ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Cuota por repartidor</label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">%</span>
                                    </div>
                                    <input type="text" class="form-control col-6 price_format" placeholder="0.00" value="<?php echo $row_config[0]['cuota_repartidor']; ?>" id="cuota_repartidor">
                                </div>
                            </div>
                            <div class="form-group">
                                <p class="mb-2"><strong>Ordenes máximas por repartidor</strong></p>
                                <label class="form-label">Los repartidores no podrán tener más ordenes pendientes de entregar de lo permitido</label>
                                <input type="text" class="form-control col-6 phone_format" value="<?php echo $row_config[0]['ordenes_maximas'] ?>" id="ordenes_maximas">
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-6">
                            <div class="form-group">
                                <p class="mb-2"><strong>Permitir sucursales express?</strong></p>
                                <label class="form-label">Esto permitirá a los compradores realizar pedidos desde las sucursales express que tenga dadas de alta.</label>
                                <select id="sucursales_express" class="form-control col-6">
                                    <option <?php if($row_config[0]['sucursal_express']==1){ echo 'selected';} ?> value="1">Si</option>
                                    <option <?php if($row_config[0]['sucursal_express']==0){ echo 'selected';} ?> value="0">No</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <p class="mb-2"><strong>Permitir ordenes punto a punto?</strong></p>
                                <label class="form-label">Esto permitirá a los compradores realizar pedidos de punto a punto.</label>
                                <select id="ordenes_punto_a_punto" class="form-control col-6">
                                    <option <?php if($row_config[0]['config_punto_a_punto']==1){ echo 'selected'; } ?> value="1">Si</option>
                                    <option <?php if($row_config[0]['config_punto_a_punto']==0){ echo 'selected'; } ?> value="0">No</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <p class="mb-2"><strong>Costo mínimo de envío</strong></p>
                                <label class="form-label">Este costo aplicará para todos los pedidos, si se deja en 0, se aplicarán automáticamente el costo por km</label>
                                <input type="text" class="form-control col-6 price_format" value="<?php echo $row_config[0]['costo_minimo_empresa_reparto']; ?>" id="costo_minimo">
                            </div>
                            <div class="form-group">
                                <p class="mb-2"><strong>Costo por km de envío</strong></p>
                                <label class="form-label">El costo de envío dependerá de la distancia entre la sucursal y el destino de entrega</label>
                                <input type="text" class="form-control col-6 price_format" value="<?php echo $row_config[0]['costo_kilometraje_empresa_reparto']; ?>" id="costo_por_km">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="form-group text-right">
                        <button class="btn btn-outline-dark" id="btn_guardar_config_avanzada">Guardar cambios</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    // SLIMSELECT
    var select_id_tipo_cambio = new SlimSelect({
        select: '#id_tipo_cambio',
        searchText: 'No se encontraron resultados',
        searchPlaceholder: 'Buscar',
        placeholder: 'Seleccione un tipo de cambio',
    });
    var select_id_zona_horaria = new SlimSelect({
        select: '#id_zona_horaria',
        searchText: 'No se encontraron resultados',
        searchPlaceholder: 'Buscar',
        placeholder: 'Seleccione una zona horaria',
    });
</script>