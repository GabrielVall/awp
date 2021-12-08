<?php
include_once("../../../m/SQLConexion.php");
$sql = new SQLConexion();

$row_empresa_metodo_pago = $sql->obtenerResultado("CALL sp_select_empresa_metodo_pago1();");
$total_row_empresa_metodo_pago = count($row_empresa_metodo_pago);

$row_config = $sql->obtenerResultado("CALL sp_select_empresa_reparto2();");

$row_bancos = $sql->obtenerResultado("CALL sp_select_bancos1();");
$total_row_bancos = count($row_bancos);

?>
<div class="container-fluid">
    <div class="row">
        <div class="col">
            <h2 class="h3 page-title">Métodos de pago</h2>
        </div>
        <div class="col-auto"></div>
        <div class="col-md-12">
            <div class="card shadow">
                <div class="card-header">
                    <strong class="card-title">Keys</strong>
                </div>
                <div class="card-body" id="content_keys">
                    <div class="list-group list-group-flush my-n3">
                        <div class="list-group-item">
                            <div class="row align-items-center">
                                <div class="col-auto">
                                    <span class="circle circle-sm bg-primary d-flex justify-content-center align-items-center"><i class="material-icons-round text-white">password</i></span>
                                </div>
                                <div class="col">
                                    <small><strong>Paypal</strong></small>
                                    <div class="mb-2 text-muted small">
                                        <input type="text" class="form-control form-control-sm" id="config_paypal" value="<?php echo $row_config[0]['config_paypal_empresa_reparto']; ?>">
                                    </div>
                                </div>
                                <div class="col-auto pr-0"></div>
                            </div>
                        </div>
                        <div class="list-group-item">
                            <div class="row align-items-center">
                                <div class="col-auto">
                                    <span class="circle circle-sm bg-success d-flex justify-content-center align-items-center"><i class="material-icons-round text-white">password</i></span>
                                </div>
                                <div class="col">
                                    <small><strong>Stripe</strong></small>
                                    <div class="mb-2 text-muted small">
                                        <input type="text" class="form-control form-control-sm" id="config_stripe_public" value="<?php echo $row_config[0]['config_stripe_empresa_reparto']; ?>">
                                    </div>
                                    <span class="badge badge-pill badge-dark">Public</span>
                                    <div class="my-2 text-muted small">
                                        <input type="text" class="form-control form-control-sm" id="config_stripe_secret" value="<?php echo $row_config[0]['config_stripe_empresa_reparto_sk']; ?>">
                                    </div>
                                    <span class="badge badge-pill badge-dark">Secret</span>
                                </div>
                                <div class="col-auto pr-0"></div>
                            </div>
                        </div>
                        <div class="list-group-item">
                            <div class="row align-items-center">
                                <div class="col-auto">
                                    <span class="circle circle-sm bg-warning d-flex justify-content-center align-items-center"><i class="material-icons-round text-white">password</i></span>
                                </div>
                                <div class="col">
                                    <small><strong>Mercado pago</strong></small>
                                    <div class="mb-2 text-muted small">
                                        <input type="text" class="form-control form-control-sm" id="config_mercado_pago" value="<?php echo $row_config[0]['config_mercado_pago_empresa_reparto']; ?>">
                                    </div>
                                </div>
                                <div class="col-auto pr-0"></div>
                            </div>
                        </div>
                        <div class="list-group-item">
                            <div class="row align-items-center">
                                <div class="col-auto">
                                    <span class="circle circle-sm bg-dark d-flex justify-content-center align-items-center"><i class="material-icons-round text-white">password</i></span>
                                </div>
                                <div class="col">
                                    <small><strong>Transferencia</strong></small>
                                    <div class="form-group">
                                        <select id="id_banco">
                                            <?php
                                            if ($total_row_bancos > 0) {
                                                foreach ($row_bancos as $dato) {
                                                    $row_config[0]['id_banco']==$dato['id_banco'] ? $selected='selected' : $selected='';
                                                    echo '<option '.$selected.' value="' . $dato['id_banco'] . '">' . $dato['nombre_banco'] . '</option>';
                                                }
                                            }
                                            ?>
                                        </select>
                                        <span class="badge badge-pill badge-dark mt-2">Banco</span>
                                    </div>
                                    <div class="mb-2 text-muted small">
                                        <input type="text" class="form-control" id="num_transferencia" value="<?php echo $row_config[0]['num_transferencia']; ?>">
                                    </div>
                                    <span class="badge badge-pill badge-dark">Num. de transferencia</span>
                                    <div class="my-2 text-muted small">
                                        <input type="text" class="form-control" id="num_deposito" value="<?php echo $row_config[0]['num_deposito']; ?>">
                                    </div>
                                    <span class="badge badge-pill badge-dark">Num. de depósito</span>
                                </div>
                                <div class="col-auto pr-0"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="form-group text-right">
                        <button class="btn btn-outline-dark" id="btn_guardar_keys_empresa_reparto">Guardar cambios</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-12 mt-4">
            <div class="card shadow">
                <div class="card-body">
                    <h5 class="card-title">Activar / Desactivar métodos de pago</h5>
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Método de pago</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if ($total_row_empresa_metodo_pago > 0) {
                                foreach ($row_empresa_metodo_pago as $dato) {
                                    echo
                                    '<tr>
                                        <td>' . $dato['nombre_metodo_pago'] . '</td>
                                        <td class="d-flex justify-content-end align-items-center">
                                            <select class="form-control col-4" id="estado_empresa_metodo_pago" data-id="' . $dato['id_empresa_metodo_pago'] . '">
                                                <option ';
                                    if ($dato['estado_empresa_metodo_pago'] == 1) {
                                        echo 'selected';
                                    }
                                    echo ' value="1">Activado</option>
                                                <option ';
                                    if ($dato['estado_empresa_metodo_pago'] == 0) {
                                        echo 'selected';
                                    }
                                    echo ' value="0">Desactivado</option>
                                            </select>
                                        </td>
                                    </tr>';
                                }
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    // SLIMSELECT
    var select_id_banco = new SlimSelect({
        select: '#id_banco',
        searchText: 'No se encontraron resultados',
        searchPlaceholder: 'Buscar',
        placeholder: 'Seleccione un banco',
    });
</script>