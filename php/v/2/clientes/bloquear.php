<?php
include_once("../../../m/SQLConexion.php");
$sql = new SQLConexion();

$row_clientes = $sql->obtenerResultado("CALL sp_select_clientes2();");
$total_row_clientes = count($row_clientes);

$row_sucursales = $sql->obtenerResultado("CALL sp_select_sucursales2();");
$total_row_sucursales = count($row_sucursales);

$row_sucursales_express = $sql->obtenerResultado("CALL sp_select_sucursales_express2();");
$total_row_sucursales_express = count($row_sucursales_express);

?>
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="row align-items-center mb-2">
                <div class="col">
                    <h2 class="h3 page-title">Bloquear clientes de sucursales</h2>
                </div>
                <div class="col-auto"></div>
            </div>
            <div class="row d-flex justify-content-center">
                <div class="col-sm-8">
                    <div class="card shadow">
                        <div class="card-header">
                            <strong class="card-title">Bloquear clientes de sucursales</strong>
                            <p class="text-muted">Los clientes que ya fueron bloqueados previamente se omitirán</p>
                        </div>
                        <div class="card-body py-4 mb-1">
                            <div class="form-group">
                                <div class="d-flex justify-content-between">
                                    <label class="form-label">Cliente(s)</label>
                                    <div class="custom-control custom-switch">
                                        <input type="checkbox" class="custom-control-input" id="tipo_sucursal">
                                        <label class="custom-control-label" for="tipo_sucursal">Sucursal(es) express</label>
                                    </div>
                                </div>
                                <select id="id_cliente" multiple>
                                    <?php
                                    if($total_row_clientes>0){
                                        foreach($row_clientes as $dato){
                                            echo '<option value="'.$dato['id_cliente'].'">'.$dato['nombre_cliente'].'</option>';
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="form-group" id="group_sucursal">
                                <label class="form-label">Sucursal(es)</label>
                                <select id="id_sucursal" multiple>
                                    <?php
                                    if($total_row_sucursales>0){
                                        foreach($row_sucursales as $dato){
                                            echo '<option value="'.$dato['id_sucursal'].'">'.$dato['nombre_sucursal'].'</option>';
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="form-group d-none" id="group_express">
                                <label class="form-label">Sucursal(es) express</label>
                                <select id="id_sucursal_express" multiple>
                                    <?php
                                    if($total_row_sucursales_express>0){
                                        foreach($row_sucursales_express as $dato){
                                            echo '<option value="'.$dato['id_sucursal_express'].'">'.$dato['nombre_sucursal_express'].'</option>';
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="form-group text-right">
                                <button class="btn btn-outline-dark" id="btn_bloquear_cliente">Bloquear</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    var select_id_cliente = new SlimSelect({
        select: '#id_cliente',
        searchText: 'No se encontraron resultados',
        searchPlaceholder: 'Buscar',
        placeholder: 'Seleccione un cliente',
        closeOnSelect: false,
    });
    var select_id_sucursal = new SlimSelect({
        select: '#id_sucursal',
        searchText: 'No se encontraron resultados',
        searchPlaceholder: 'Buscar',
        placeholder: 'Seleccione una sucursal',
        closeOnSelect: false,
    });
    var select_id_sucursal_express = new SlimSelect({
        select: '#id_sucursal_express',
        searchText: 'No se encontraron resultados',
        searchPlaceholder: 'Buscar',
        placeholder: 'Seleccione una sucursal express',
        closeOnSelect: false,
    });
</script>