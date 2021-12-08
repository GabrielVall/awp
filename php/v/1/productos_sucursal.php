<?php
session_start();
include_once("../../m/SQLConexion.php");
include_once("../../f/main_fnc.php");
$sql = new SQLConexion();
$row_productos = $sql->obtenerResultado("CALL sp_select_productos1('".$_SESSION['id_sucursal_bxpress']."')");
$total_prods = count($row_productos);
?>
<div class="container-fluid py-4">
    <div class="card">
    <div class="card-header pb-0">
              <div class="d-lg-flex mb-5">
                <div>
                  <h5 class="mb-0">Todos los productos</h5>
                </div>
                <div class="ms-auto my-auto mt-lg-0 mt-4">
                  <div class="ms-auto my-auto">
                    <a href="#agregar_producto_sucursal" class="btn bg-gradient-primary btn-sm mb-0" >+&nbsp; Agregar producto</a>
                    <button type="button" class="btn btn-outline-primary btn-sm mb-0 disabled" data-bs-toggle="modal" data-bs-target="#import">
                      Importar
                    </button>
                    <div class="modal fade" id="import" tabindex="-1" aria-hidden="true">
                      <div class="modal-dialog mt-lg-10">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="ModalLabel">Importar CSV</h5>
                            <i class="fas fa-upload ms-3" aria-hidden="true"></i>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                          </div>
                          <div class="modal-body">
                            <p>Sube un archivo en formato csv para agilizar la carga de productos.</p>
                            <input type="text" placeholder="Browse file..." class="form-control mb-3" onfocus="focused(this)" onfocusout="defocused(this)">
                            <div class="form-check">
                              <label class="custom-control-label" for="importCheck">Las imagenes se subiran por separado</label>
                            </div>
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn bg-gradient-secondary btn-sm" data-bs-dismiss="modal">Close</button>
                            <button type="button" class="btn bg-gradient-primary btn-sm">Subir</button>
                          </div>
                        </div>
                      </div>
                    </div>
                    <button class="btn btn-outline-primary btn-sm export mb-0 mt-sm-0 mt-1 disabled" data-type="csv" type="button" name="button">Exportar</button>
                  </div>
                </div>
              </div>
            </div>
        <div class="table-responsive">
            <table class="table align-items-center mb-0">
                <thead>
                    <tr>
                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nombre producto</th>
                        <th class="text-uppercase text-center text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Categoria</th>
                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Precio</th>
                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Stock</th>
                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Estado stock</th>
                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Acciones</th>
                    </tr>
                </thead>
                <tbody class="text-center">
                  <?php
                  if($total_prods > 0){
                    foreach($row_productos as $producto){ ?>
                    <tr>
                      <td>
                        <div class="d-flex">
                            <img class="m-2" style="border-radius:50px; width:60px; height:60px; object-fit:cover;" 
                            src="<?php echo select_imagen('productos/',$producto[0]) ?>" alt="<?php echo $producto['nombre_producto'] ?>">
                            <h6 class="ms-3 my-auto"><?php echo $producto['nombre_producto'] ?></h6>
                        </div>
                        </td>
                        <td class="text-sm">
                          <?php echo $producto['nombre_categoria_producto'] ?>
                        </td>
                        <td class="text-sm" data-precio="<?php echo $producto['precio_producto'] ?>"></td>
                        <td class="text-sm">
                          <?php 
                          switch ($producto['stock']) {
                            case '-1':
                              echo '<b>∞</b>';
                              break;
                            default:
                              echo $producto['stock'];
                              break;
                          }
                          ?>
                          </td>
                        <td class="text-sm">
                        <?php 
                          switch (true) {
                            case $producto['stock'] == '-1': ?>
                              <span class="badge bg-gradient-info">Siempre disponible</span>
                              <?php
                              break;
                              case $producto['stock'] == 0: ?>
                                <span class="badge bg-gradient-danger">Sin existencia</span>
                                <?php
                                break;
                              case $producto['stock'] < 10: ?>
                                <span class="badge bg-gradient-warning">Quedan pocos</span>
                                <?php
                                break;
                              case $producto['stock'] > 9: ?>
                                <span class="badge bg-gradient-success">Disponibles</span>
                                <?php
                                break;
                          }
                          ?>
                          
                        </td>
                        <td class="text-sm">
                            <a href="javascript:;" data-bs-toggle="tooltip" data-bs-original-title="Preview product">
                            <i class="fas fa-eye text-secondary" aria-hidden="true"></i>
                            </a>
                            <a href="javascript:;" class="mx-3" data-bs-toggle="tooltip" data-bs-original-title="Edit product">
                            <i class="fas fa-pen text-secondary" aria-hidden="true"></i>
                            </a>
                            <a href="javascript:;" data-bs-toggle="tooltip" data-bs-original-title="Delete product">
                            <i class="fas fa-trash text-secondary" aria-hidden="true"></i>
                            </a>
                        </td>
                     </tr>
                    <?php }
                  }else{ echo sinResultados('productos'); }
                  ?>
                </tbody>
            </table>
        </div>
    </div>
</div>