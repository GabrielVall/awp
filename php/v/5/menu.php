<?php
if( isset($_SESSION['id_empresa_comida_bxpress']) ){ 
    $row_sucursales = $sql->obtenerResultado("CALL sp_select_sucursales_empresa('".$_SESSION['id_empresa_comida_bxpress']."')");
    $total_sucursales = count($row_sucursales);
}
?>
<aside class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-3 " id="sidenav-main">
    <div class="sidenav-header">
      <i class="fas fa-times p-3 cursor-pointer text-secondary opacity-5 position-absolute end-0 top-0 d-none d-xl-none" aria-hidden="true" id="iconSidenav"></i>
      <a class="navbar-brand m-0 text-center" href="javascript:void(0)">
        <span class="font-weight-bold" >Nombre sucursal</span>
      </a>
    </div>
    <hr class="horizontal dark mt-0">
    <div class="collapse navbar-collapse  w-auto" id="sidenav-collapse-main">
      <ul class="navbar-nav">
        <!-- <li class="nav-item">
          <a class="nav-link inicio" href="#">
            <div class="active-icon icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
            <svg  fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"></path></svg>
            </div>
            <span class="nav-link-text ms-1">Inicio</span>
          </a>
        </li> -->
        <li class="nav-item mt-3">
          <h6 class="ps-4  ms-2 text-uppercase text-xs font-weight-bolder opacity-6">Sucursales</h6>
        </li>
       
          <?php
                if($total_sucursales > 0){
                  for ($i=0; $i < $total_sucursales; $i++) {  ?>
                   <li class="nav-item">
                    <a data-bs-toggle="collapse" href="#nav<?php echo $row_sucursales[$i]['id_sucursal'] ?>" class="nav-link" aria-controls="dashboardsExamples" role="button" aria-expanded="false">
                      <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center d-flex align-items-center justify-content-center  me-2">
                      <svg  fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4 4a2 2 0 012-2h8a2 2 0 012 2v12a1 1 0 110 2h-3a1 1 0 01-1-1v-2a1 1 0 00-1-1H9a1 1 0 00-1 1v2a1 1 0 01-1 1H4a1 1 0 110-2V4zm3 1h2v2H7V5zm2 4H7v2h2V9zm2-4h2v2h-2V5zm2 4h-2v2h2V9z" clip-rule="evenodd"></path></svg>
                      </div>
                      <span class="nav-link-text ms-1"><?php echo $row_sucursales[$i]['nombre_sucursal'] ?></span>
                    </a>
                    <div class="collapse" id="nav<?php echo $row_sucursales[$i]['id_sucursal'] ?>">
                      <ul class="nav ms-4 ps-3">
                        <li class="nav-item">
                          <a class="nav-link resumen_sucursal<?php echo $row_sucursales[$i]['id_sucursal'] ?>" href="#resumen_sucursal=<?php echo $row_sucursales[$i]['id_sucursal'] ?>">
                            <span class="sidenav-normal"> Inicio </span>
                          </a>
                          <a class="nav-link agregar_complementos_sucursal<?php echo $row_sucursales[$i]['id_sucursal'] ?>" href="#agregar_complementos_sucursal=<?php echo $row_sucursales[$i]['id_sucursal'] ?>">
                            <span class="sidenav-normal"> Servicios </span>
                          </a>
                          </a>
                        </li>
                      </ul>
                    </div>
                    </li>
                  <?php }
                }
              ?>
          
        
        <li class="nav-item mt-3">
          <h6 class="ps-4 ms-2 text-uppercase text-xs font-weight-bolder opacity-6">Otro</h6>
        </li>
        <li class="nav-item"  data-step="99" data-intro="Puedes volver a ver las ayudas desde la configuración">
          <a class="nav-link configuracion" href="#configuracion">
            <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
            <svg fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M11.49 3.17c-.38-1.56-2.6-1.56-2.98 0a1.532 1.532 0 01-2.286.948c-1.372-.836-2.942.734-2.106 2.106.54.886.061 2.042-.947 2.287-1.561.379-1.561 2.6 0 2.978a1.532 1.532 0 01.947 2.287c-.836 1.372.734 2.942 2.106 2.106a1.532 1.532 0 012.287.947c.379 1.561 2.6 1.561 2.978 0a1.533 1.533 0 012.287-.947c1.372.836 2.942-.734 2.106-2.106a1.533 1.533 0 01.947-2.287c1.561-.379 1.561-2.6 0-2.978a1.532 1.532 0 01-.947-2.287c.836-1.372-.734-2.942-2.106-2.106a1.532 1.532 0 01-2.287-.947zM10 13a3 3 0 100-6 3 3 0 000 6z" clip-rule="evenodd"></path></svg>
            </div>
            <span class="nav-link-text ms-1">Configuración</span>
          </a>
        </li>
        <li class="nav-item" >
          <a class="nav-link notificaciones" href="#notificaciones">
            <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
              <svg width="16px" height="16px" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M10 2a6 6 0 00-6 6v3.586l-.707.707A1 1 0 004 14h12a1 1 0 00.707-1.707L16 11.586V8a6 6 0 00-6-6zM10 18a3 3 0 01-3-3h6a3 3 0 01-3 3z"></path></svg>
            </div>
            <span class="nav-link-text ms-1">Notificaciones</span>
          </a>
        </li>
        <li class="nav-item mt-3">
          <h6 class="mt-5 ps-4 ms-2 text-uppercase text-xs font-weight-bolder opacity-6"></h6>
        </li>
        <li class="nav-item" >
          <a class="nav-link cerrar_sesion" href="#cerrar_sesion">
            <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
              <svg width="16px" height="16px" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M3 3a1 1 0 00-1 1v12a1 1 0 102 0V4a1 1 0 00-1-1zm10.293 9.293a1 1 0 001.414 1.414l3-3a1 1 0 000-1.414l-3-3a1 1 0 10-1.414 1.414L14.586 9H7a1 1 0 100 2h7.586l-1.293 1.293z" clip-rule="evenodd"></path></svg>
      
            </div>
            <span class="nav-link-text ms-1">Salir de la cuenta</span>
          </a>
        </li>
    </div>
  </aside>