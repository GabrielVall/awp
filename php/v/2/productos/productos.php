<?php
session_start();
include_once("../../../m/SQLConexion.php");
$sql = new SQLConexion();

$row_productos = $sql->obtenerResultado("CALL sp_select_productos1('" . $_POST['id_sucursal'] . "');");
$total_row_productos = count($row_productos);

$_SESSION['id_sucursal_producto']=$_POST['id_sucursal'];

?>
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="row align-items-center mb-2">
                <div class="col">
                    <h2 class="h3 page-title">Productos de la sucursal</h2>
                </div>
                <div class="col-auto">
                    <div class="page-header-breadcrumb">
                        <ul class="breadcrumb bg-light">
                            <li class="breadcrumb-item"><a href="#sucursales" class="text-decoration-none text-muted">Sucursales</a></li>
                            <li class="breadcrumb-item"><a href="#sucursal_<?php echo $_POST['id_sucursal']; ?>" class="text-decoration-none text-muted"><?php echo $_SESSION['nombre_sucursal']; ?></a></li>
                            <li class="breadcrumb-item"><a href="#productos_sucursal_<?php echo $_POST['id_sucursal']; ?>" class="text-decoration-none text-muted">Productos</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="row align-items-center mb-2">
                <div class="col"></div>
                <div class="col-auto">
                    <a href="#nuevo_producto" class="btn btn-dark">Agregar producto</a>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <div class="table-responsive">
                        <table class="table border table-hover bg-white">
                            <thead>
                                <tr role="row">
                                    <th>Productos</th>
                                    <th>Categoria</th>
                                    <th>Precio unitario</th>
                                    <th>Precio por kg</th>
                                    <th class="text-right">Opciones</th>
                                </tr>
                            </thead>
                            <tbody id="tbody_categorias_sucursal">
                                <?php
                                if ($total_row_productos > 0) {
                                    for ($i = 0; $i < $total_row_productos; $i++) {
                                        echo
                                        '<tr id="row_producto_' . $row_productos[$i]['id_producto'] . '">
                                            <td>' . $row_productos[$i]['nombre_producto'] . '</td>
                                            <td>' . $row_productos[$i]['nombre_categoria_producto'] . '</td>
                                            <td>'. $row_productos[$i]['simbolo'] . $row_productos[$i]['precio_producto'] . '</td>
                                            <td>'. $row_productos[$i]['simbolo'] . $row_productos[$i]['precio_kg_producto'] . '</td>
                                            <td class="d-flex justify-content-end">
                                                <button class="btn btn-sm btn-light d-flex align-items-center dropdown-toggle more-horizontal" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Opciones <span class="material-icons-round">expand_more</span></button>
                                                <div class="dropdown-menu dropdown-menu-right">
                                                <a class="dropdown-item" href="#producto_info_'.$row_productos[$i]['id_producto'].'">Editar</a>
                                                <a class="dropdown-item" href="javascript:void(0);" data-id="' . $row_productos[$i]['id_producto'] . '" id="eliminar_producto">Eliminar</a>
                                                </div>
                                            </td>
                                        </tr>';
                                    }
                                } else {
                                    echo
                                    '<tr id="categorias_empty">
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
<!-- MODALES -->
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
                <button type="button" class="btn mb-2 btn-outline-dark" id="btn_eliminar_producto">Confirmar</button>
            </div>
        </div>
    </div>
</div>