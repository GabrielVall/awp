<?php
session_start();
include_once("../../m/SQLConexion.php");
include_once("../../f/main_fnc.php");
$sql = new SQLConexion();
if( isset($_SESSION['id_empresa_comida_bxpress']) ){ 
  $_SESSION['id_sucursal_bxpress'] = $_POST['valor'];   
}else if( isset($_SESSION['id_sucursal_bxpress']) ){
}else{
    include_once("sin_cuenta.php");
    exit();
}
$row_ordenes = $sql->obtenerResultado("CALL sp_select_ordenes_sucursal('".$_SESSION['id_sucursal_bxpress']."',0)");
$total_ordenes = count($row_ordenes);
?>
<div class="container-fluid py-5 mb-5">
      <div class="d-sm-flex justify-content-between">
        <div>
          <a href="#generar_orden_sucursal" class="btn btn-icon bg-gradient-primary">
            Crear orden
          </a>
        </div>
        <div class="d-flex">
          <div class="dropdown" style="padding-right:.5em">
              <a href="javascript:;" class="btn btn-outline-dark dropdown-toggle " data-bs-toggle="dropdown" id="navbarDropdownMenuLink2">
                Estado
              </a>
              <ul class="dropdown-menu dropdown-menu-lg-start px-2 py-3" aria-labelledby="navbarDropdownMenuLink2" data-popper-placement="left-end">
                <li><a class="dropdown-item border-radius-md" href="javascript:;">Pendiente</a></li>
                <li><a class="dropdown-item border-radius-md" href="javascript:;">Completadas</a></li>
                <li><a class="dropdown-item border-radius-md" href="javascript:;">Canceladas</a></li>
                <li>
                  <hr class="horizontal dark my-2">
                </li>
                <li><a class="dropdown-item border-radius-md text-danger" href="javascript:;">Quitar filtro</a></li>
              </ul>
          </div>
          <div class="dropdown" style="padding-right:.5em">
            <a href="javascript:;" class="btn btn-outline-dark dropdown-toggle " data-bs-toggle="dropdown" id="navbarDropdownMenuLink3">
              Fecha
            </a>
            <ul class="dropdown-menu dropdown-menu-lg-start px-2 py-3" aria-labelledby="navbarDropdownMenuLink3" data-popper-placement="right-start">
              <li><a class="dropdown-item border-radius-md" href="javascript:;">Más recientes</a></li>
              <li><a class="dropdown-item border-radius-md" href="javascript:;">Más antiguas</a></li>
              <li>
                <hr class="horizontal dark my-2">
              </li>
              <li><a class="dropdown-item border-radius-md text-danger" href="javascript:;">Quitar filtro</a></li>
            </ul>
          </div>
          <div class="dropdown" style="padding-right:.5em">
            <a href="javascript:;" class="btn btn-outline-dark dropdown-toggle " data-bs-toggle="dropdown" id="navbarDropdownMenuLink4">
              Total
            </a>
            <ul class="dropdown-menu dropdown-menu-lg-start px-2 py-3" aria-labelledby="navbarDropdownMenuLink4" data-popper-placement="left-end">
              <li><a class="dropdown-item border-radius-md" href="javascript:;">Mayor costo</a></li>
              <li><a class="dropdown-item border-radius-md" href="javascript:;">Menor costo</a></li>
              <li>
                <hr class="horizontal dark my-2">
              </li>
              <li><a class="dropdown-item border-radius-md text-danger" href="javascript:;">Quitar filtro</a></li>
            </ul>
          </div>
          <button class="btn btn-icon btn-outline-dark ms-2 export" data-type="csv" type="button">
            <span class="btn-inner--icon"><i class="ni ni-archive-2"></i></span>
            <span class="btn-inner--text">Exportar CSV</span>
          </button>
        </div>
      </div>
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="dataTable-container">
            <table class="table align-items-center mb-0">
                <thead>
                  <tr>
                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Id</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Creación del pedido</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Estado</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Cliente</th>
                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Orden</th>
                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Total a recibir</th>
                  </tr>
                </thead>
                <tbody>
                  <?php 
                    if($total_ordenes > 0){
                      for ($i=0; $i < $total_ordenes; $i++) { ?>
                          <tr>
                            <td>
                                <p class="text-xs font-weight-bold ms-2 mb-0 text-center">#<?php echo $row_ordenes[$i]['id_orden'] ?></p>
                            </td>
                            <td>
                              <span class="badge badge-dot me-4">
                                <i class="bg-info"></i>
                                <span class="text-dark text-xs" fecha-hora="<?php echo $row_ordenes[$i]['fecha_registro_orden'] ?>">Hace 2 minutos</span>
                              </span>
                            </td>
                            <td class="text-xs font-weight-bold">
                              <div class="d-flex align-items-center">
                                <button class="btn btn-icon-only btn-rounded btn-outline-success mb-0 me-2 btn-sm d-flex align-items-center justify-content-center"><i class="fas fa-check" aria-hidden="true"></i></button>
                                <span><?php echo $row_ordenes[$i]['nombre_estado_orden'] ?></span>
                              </div>
                            </td>
                            <td class="text-xs font-weight-bold">
                              <div class="d-flex align-items-center">
                                <span><?php echo $row_ordenes[$i]['nombre_cliente'] ?></span>
                              </div>
                            </td>
                            <td class="align-middle text-center">
                              <button class="btn btn-icon bg-gradient-primary" id="ref" data-ref="orden_sucursal=<?php echo $row_ordenes[$i]['id_orden'] ?>">Ver detalles </button>
                            </td>
                            <td class="align-middle text-center">
                              <span class="badge badge-dot me-4">
                                  <i class="bg-info"></i>
                                  <span class="text-success text-xs">$<?php echo agrupar_numero($row_ordenes[$i]['costo_total_orden']) ?></span>
                              </span>
                            </td>
                          </tr>
                      <?php }
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