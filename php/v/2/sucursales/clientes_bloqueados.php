<?php
session_start();
include_once("../../../m/SQLConexion.php");
$sql = new SQLConexion();

$row_clientes = $sql->obtenerResultado("CALL sp_select_clientes_bloqueados_sucursal1('".$_POST['id_sucursal']."');");
$total_row_clientes = count($row_clientes);

$_SESSION['id_sucursal_cliente_ban']=$_POST['id_sucursal'];

?>
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="row align-items-center mb-2">
                <div class="col">
                    <h2 class="h3 page-title">Clientes bloqueados</h2>
                </div>
                <div class="col-auto">
                    <div class="page-header-breadcrumb">
                        <ul class="breadcrumb bg-light">
                            <li class="breadcrumb-item"><a href="#sucursales" class="text-decoration-none text-muted">Sucursales</a></li>
                            <li class="breadcrumb-item"><a href="#sucursal_<?php echo $_POST['id_sucursal']; ?>" class="text-decoration-none text-muted"><?php echo $_SESSION['nombre_sucursal']; ?></a></li>
                            <li class="breadcrumb-item"><a href="#ban_sucursal_<?php echo $_POST['id_sucursal']; ?>" class="text-decoration-none text-muted">Clientes bloqueados</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="row align-items-center mb-2">
                <div class="col"></div>
                <div class="col-auto">
                    <a href="#nuevo_cliente_bloqueado_sucursal" class="btn btn-dark">Bloquear clientes</a>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <div class="table-responsive">
                        <table class="table border table-hover bg-white">
                            <thead>
                                <tr role="row">
                                    <th>Cliente</th>
                                    <th class="text-right">Opciones</th>
                                </tr>
                            </thead>
                            <tbody id="tbody_cliente">
                                <?php
                                if ($total_row_clientes > 0) {
                                    for ($i = 0; $i < $total_row_clientes; $i++) {
                                        echo
                                        '<tr id="row_cliente_' . $row_clientes[$i]['id_cliente_bloqueado_sucursal'] . '">
                                            <td>' . $row_clientes[$i]['nombre_cliente'] .' '. $row_clientes[$i]['apellido_cliente'] .'</td>
                                            <td class="text-right">
                                                <a class="btn btn-light" href="javascript:void(0);" data-id="' . $row_clientes[$i]['id_cliente_bloqueado_sucursal'] . '" id="eliminar_cliente_bloqueado">Quitar bloqueo</a>
                                            </td>
                                        </tr>';
                                    }
                                } else {
                                    echo
                                    '<tr id="cliente_bloqueado_empty">
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
<!-- MODALES -->

<!-- ELIMINAR -->
<div class="modal fade" id="modal_eliminar" tabindex="-1" role="dialog" aria-labelledby="defaultModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="defaultModalLabel">Quitar bloqueo</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Está seguro de quitar el bloqueo al cliente? De click en confirmar.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn mb-2 btn-outline-dark" id="btn_eliminar_cliente_bloqueado">Confirmar</button>
            </div>
        </div>
    </div>
</div>