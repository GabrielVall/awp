<?php
session_start();
include_once("../../../m/SQLConexion.php");
$sql = new SQLConexion();

$row_clientes = $sql->obtenerResultado("CALL sp_select_clientes4('".$_SESSION['id_sucursal_express_cliente_ban']."');");
$total_row_clientes = count($row_clientes);

?>
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="row align-items-center mb-2">
                <div class="col">
                    <h2 class="h3 page-title">Bloquear clientes</h2>
                </div>
                <div class="col-auto"></div>
            </div>
            <div class="row d-flex justify-content-center">
                <div class="col-sm-8">
                    <div class="card shadow">
                        <div class="card-header">
                            <strong class="card-title">Bloquear clientes</strong>
                        </div>
                        <div class="card-body py-4 mb-1">
                            <div class="form-group">
                                <label class="form-label">Cliente(s)</label>
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
                            <div class="form-group text-right">
                                <button class="btn btn-outline-dark" id="btn_bloquear_cliente_sucursal_express">Bloquear</button>
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
</script>