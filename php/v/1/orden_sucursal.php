<?php
session_start();
include_once("../../m/SQLConexion.php");
include_once("../../f/main_fnc.php");
$sql = new SQLConexion();
$row_orden = $sql->obtenerResultado("CALL sp_select_orden_id('".$_POST['valor']."')");
$row_log = $sql->obtenerResultado("CALL sp_select_fechas_orden('".$_POST['valor']."')");
?>
<div class="container-fluid py-4">
  <div class="row">
    <div class="col-lg-8 mx-auto">
      <div class="card mb-4">
        <div class="card-header p-3 pb-0">
          <div class="d-flex justify-content-between align-items-center">
            <div>
              <h6>Detalles de la orden</h6>
              <p class="text-sm mb-0">
                Order no. <b>#<?php echo $row_orden[0]['id_orden']; ?></b> Fecha <b><?php echo $row_orden[0]['fecha_registro_orden']; ?></b>
              </p>
              <p class="text-sm">
                Fecha de entrega: <b><?php echo $row_orden[0]['nombre_estado_orden']; ?></b>
              </p>
            </div>
          </div>
        </div>
        <div class="card-body p-3 pt-0">
          <hr class="horizontal dark mt-0 mb-4">
          <div class="row">
            <div class="col-lg-6 col-md-6 col-12">
              <div class="d-flex">
                <div>
                  <img src="<?php echo select_imagen('sucursales/',$row_orden[0]['id_sucursal']) ?>" style="object-fit:cover;" class="avatar avatar-xxl me-3" alt="product image">
                </div>
                <div>
                  <h6 class="text-lg mb-0 mt-2"><?php echo $row_orden[0]['nombre_sucursal']; ?></h6>
                  <p class="text-sm mb-3">Esta orden se creo: <span fecha-hora="<?php echo $row_orden[0]['fecha_registro_orden']; ?>"></span></p>
                  <span class="badge badge-sm bg-gradient-success"><?php echo $row_orden[0]['nombre_estado_orden']; ?></span>
                </div>
              </div>
            </div>
            <div class="col-lg-6 col-md-6 col-12 my-auto text-end">
              <a href="javascript:;" class="btn bg-gradient-info mb-0">Contactar cliente</a>
            </div>
          </div>
          <div class="row my-3">
              <div class="col-lg-12 text-center">
                <h5>Detalles de la orden</h5>
            </div>
          <div class="row">
                <div class="col-12">
                    <div class="table-responsive">
                        <table class="table text-right">
                            <thead class="bg-default">
                                <tr>
                                <th scope="col" class="pe-2 text-start ps-2">Producto</th>
                                <th scope="col" class="pe-2">Cantidad</th>
                                <th scope="col" class="pe-2" colspan="2">Precio</th>
                                <th scope="col" class="pe-2">Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="text-start">Producto 1</td>
                                    <td class="ps-4">1</td>
                                    <td class="ps-4" colspan="2">$ 9.00</td>
                                    <td class="ps-4">$ 9.00</td>
                                </tr>
                            </tbody>
                            <tfoot>
                                <tr>
                                <th></th>
                                <th></th>
                                <th class="h5 ps-4" colspan="2">Total</th>
                                <th colspan="1" class="text-right h5 ps-4">$ 698</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
          <div class="row">
            <div class="col-lg-3 col-md-6 col-12">
              <h6 class="mb-3">Seguimiento</h6>
              <div class="timeline timeline-one-side">
                <div class="timeline-block mb-3">
                  <span class="timeline-step">
                    <i class="ni ni-bell-55 text-secondary"></i>
                  </span>
                  <div class="timeline-content">
                    <h6 class="text-dark text-sm font-weight-bold mb-0">Order creada</h6>
                    <p class="text-secondary font-weight-bold text-xs mt-1 mb-0"><?php echo $row_log[0]['inicio']; ?></p>
                  </div>
                </div>
                <div class="timeline-block mb-3">
                  <span class="timeline-step">
                    <i class="ni ni-html5 text-secondary"></i>
                  </span>
                  <div class="timeline-content">
                    <h6 class="text-dark text-sm font-weight-bold mb-0">La sucursal termino el pedido</h6>
                    <p class="text-secondary font-weight-bold text-xs mt-1 mb-0">22 NOV 7:21 AM</p>
                  </div>
                </div>
                <div class="timeline-block mb-3">
                  <span class="timeline-step">
                    <i class="ni ni-cart text-secondary"></i>
                  </span>
                  <div class="timeline-content">
                    <h6 class="text-dark text-sm font-weight-bold mb-0">El repartidor tomo la orden</h6>
                    <p class="text-secondary font-weight-bold text-xs mt-1 mb-0">22 DEC 8:10 AM</p>
                  </div>
                </div>
                <div class="timeline-block mb-3">
                  <span class="timeline-step">
                    <i class="ni ni-check-bold text-success text-gradient"></i>
                  </span>
                  <div class="timeline-content">
                    <h6 class="text-dark text-sm font-weight-bold mb-0">Order entregada</h6>
                    <p class="text-secondary font-weight-bold text-xs mt-1 mb-0">22 DEC 4:54 PM</p>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-5 col-md-6 col-12">
              <h6 class="mb-3">Detalles de la orden</h6>
              <div class="card card-body border card-plain border-radius-lg d-flex align-items-center flex-row">
                <h6 class="mb-0">Metodo de pago: <?php echo $row_orden[0]['nombre_metodo_pago']; ?> </h6>
                <button type="button" class="btn btn-icon-only btn-rounded btn-outline-secondary mb-0 ms-2 btn-sm d-flex align-items-center justify-content-center ms-auto" data-bs-toggle="tooltip" data-bs-placement="bottom" title="" data-bs-original-title="We do not store card details">
                  <i class="fas fa-info" aria-hidden="true"></i>
                </button>
              </div>
              <h6 class="mb-3 mt-4">Detalles del comprador</h6>
              <ul class="list-group">
                <li class="list-group-item border-0 d-flex p-4 mb-2 bg-gray-100 border-radius-lg">
                  <div class="d-flex flex-column">
                    <h6 class="mb-3 text-sm"><?php echo $row_orden[0]['nombre_cliente']; ?></h6>
                    <span class="mb-2 text-xs">Telefono: <span class="text-dark font-weight-bold ms-2"><?php echo $row_orden[0]['telefono_cliente']; ?></span></span>
                    <span class="mb-2 text-xs">Correo electronico: <span class="text-dark ms-2 font-weight-bold" ><?php echo $row_orden[0]['correo_cliente']; ?></span></span>
                    <span class="text-xs">Usuario desde: <span class="text-dark ms-2 font-weight-bold" fecha-hora="<?php echo $row_orden[0]['fecha_registro_usuario']; ?>"></span></span>
                  </div>
                </li>
              </ul>
            </div>
            <div class="col-lg-3 col-12 ms-auto align-items-end">
              <h6 class="mb-3">Detalle de la orden:</h6>
              <div class="d-flex justify-content-between">
                <span class="mb-2 text-sm"> Subtotal: </span>
                <span class="text-dark font-weight-bold ms-2">$<?php echo $row_orden[0]['costo_total_orden']; ?></span>
              </div>
              <div class="d-flex justify-content-between mt-4">
                <span class="mb-2 text-lg text-success"> Recibes: </span>
                <span class="text-success text-lg ms-2 font-weight-bold">$<?php echo $row_orden[0]['costo_total_orden']; ?></span>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>