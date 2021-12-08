<?php
session_start();
include_once("../../m/SQLConexion.php");
include_once("../../f/main_fnc.php");
$sql = new SQLConexion();
if( isset($_SESSION['id_empresa_comida_bxpress'])  ){ 
    $row_sucursales = $sql->obtenerResultado("CALL sp_select_sucursales_empresa('".$_SESSION['id_empresa_comida_bxpress']."')");
    $total_sucursales = count($row_sucursales);
    $row_totales = $sql->obtenerResultado("CALL sp_select_totales_emp_comida('".$_SESSION['id_empresa_comida_bxpress']."')");
}else{
    include_once("sin_cuenta.php");
    exit();
}
?>
<div class="row">
  <div class=" col-12">
  <div class="col-lg-12">
    <div class="row d-flex align-items-center">
      <div class="col-lg-4 col-12">
        <div class="card card-background card-background-mask-info h-100 tilt" data-tilt="" style="will-change: transform; transform: perspective(1000px) rotateX(0deg) rotateY(0deg) scale3d(1, 1, 1);">
          <div class="full-background"></div>
          <div class="card-body pt-4 text-center">
            <h2 class="text-white mb-0 mt-2 up">Ganancias</h2>
            <h1 class="text-white mb-0 up">$
                  <?php if($row_totales[0]['@ganancias'] === NULL){
                    echo 0;
                  }else{ echo agrupar_numero($row_totales[0]['@ganancias']); } ?>
            </h1>
            <span class="badge badge-lg d-block bg-gradient-dark mb-2 up"><?php echo agrupar_numero($row_totales[0]['@total_mes']); ?> ordenes este mes</span>
            <a href="javascript:;" class="btn btn-outline-white mb-2 px-5 up">Ver más</a>
          </div>
        </div>
      </div>
      <div class="col-lg-4 col-md-6 col-12 mt-4 mt-lg-0 ">
        <div class="card">
          <div class="card-body p-3 ">
            <div class="d-flex">
              <div>
                <div class="icon icon-shape bg-gradient-dark text-center border-radius-md">
                  <i class="far fa-file-alt text-lg opacity-10"></i>
                </div>
              </div>
              <div class="ms-3">
                <div class="numbers">
                  <p class="text-sm mb-0 text-capitalize font-weight-bold">Ordenes</p>
                  <h5 class="font-weight-bolder mb-0">
                  <?php echo agrupar_numero($row_totales[0]['@total']) ?>
                  </h5>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="card mt-4">
          <div class="card-body p-3">
            <div class="d-flex">
              <div>
                <div class="icon icon-shape bg-gradient-dark text-center border-radius-md">
                  <i class="ni ni-planet text-lg opacity-10" aria-hidden="true"></i>
                </div>
              </div>
              <div class="ms-3">
                <div class="numbers">
                  <p class="text-sm mb-0 text-capitalize font-weight-bold">Clientes</p>
                  <h5 class="font-weight-bolder mb-0">
                  <?php if($row_totales[0]['@total_clientes'] === NULL){ 
                    echo 0; 
                  }else{ echo agrupar_numero($row_totales[0]['@total_clientes']); } ?>
                  </h5>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-4 col-md-6 col-12 mt-4 mt-lg-0">
        <div class="card">
          <div class="card-body p-3">
            <div class="d-flex">
              <div>
                <div class="icon icon-shape bg-gradient-dark text-center border-radius-md">
                  <i class="ni ni-world text-lg opacity-10" aria-hidden="true"></i>
                </div>
              </div>
              <div class="ms-3">
                <div class="numbers">
                  <p class="text-sm mb-0 text-capitalize font-weight-bold">Productos</p>
                  <h5 class="font-weight-bolder mb-0">
                      <?php echo agrupar_numero($row_totales[0]['@total_prod']) ?>
                  </h5>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="card mt-4">
          <div class="card-body p-3">
            <div class="d-flex">
              <div>
                <div class="icon icon-shape bg-gradient-dark text-center border-radius-md">
                  <i class="ni ni-shop text-lg opacity-10" aria-hidden="true"></i>
                </div>
              </div>
              <div class="ms-3">
                <div class="numbers">
                  <p class="text-sm mb-0 text-capitalize font-weight-bold">Sucursales</p>
                  <h5 class="font-weight-bolder mb-0">
                    <?php echo agrupar_numero($total_sucursales).'/'.$row_sucursales[0]['@limite']; ?>
                  </h5>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  </div>
</div>

<div class="col-12 mt-4">
    <div class="card mb-4">
        <span id="card_empresa_comida">
        <div class="card-header pb-0 p-3 header_tb">
            <h6 class="mb-1">Mis sucursales</h6>
            <p class="text-sm">Agrega o selecciona una sucursal</p>
        </div>
  <div class="card-body p-3">
      <div class="row">
          <?php
          if ($total_sucursales > 0) {
              for ($i=0; $i < $total_sucursales; $i++) {  ?>
              <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 col-xs-12  mb-5">
                      <div class="card card-blog card-plain">
                          <div class="position-relative">
                              <a class="d-block shadow-xl border-radius-xl">
                              <img src="<?php echo select_imagen('sucursales/',$row_sucursales[$i]['id_sucursal']) ?>" alt="img-blur-shadow" class="img-fluid shadow border-radius-xl img_sucursal">
                              </a>
                          </div>
                          <div class="card-body px-1 pb-0">
                              <p class="text-gradient text-dark mb-2 text-sm ">#<?php echo $row_sucursales[$i]['nombre_categoria_sucursal'] ?></p>
                              <a href="javascript:;">
                              <h5 class="limit_line one_line">
                                  <?php echo $row_sucursales[$i]['nombre_sucursal'] ?>
                              </h5>
                              </a>
                              <p class="mb-2 text-sm limit_line three_line">
                                  <?php echo $row_sucursales[$i]['descripcion_sucursal'] ?>
                              </p>
                              <!-- <span class="text-sm" style="margin:0;">
                                  <i class="fas fa-user"></i> Administrador: <?php echo $row_sucursales[$i]['nombre_usuario'] ?>
                              </span> -->
                              <div class="d-flex align-items-center justify-content-end">
                              <?php if($row_sucursales[$i]['id_usuario'] == 1){ ?>
                              <button type="button" class="btn btn-primary btn-sm mb-0 config-btn" data-id="<?php echo $row_sucursales[$i]['id_sucursal'] ?>" id="modal_cuenta_sucursal" >
                                  <i class="fas fa-user" style="font-size:1.2em;"></i> 
                              </button>
                                <?php }else{?>
                                  <button type="button" class="btn btn-info btn-sm mb-0 config-btn" data-id="<?php echo $row_sucursales[$i]['id_sucursal'] ?>"  id="modal_cuenta_sucursal" >
                                  <i class="fas fa-user-edit" style="font-size:1.2em;"></i> 
                                  </button>
                                  <?php } ?>
                              <button type="button" class="btn btn-primary btn-sm mb-0 config-btn"  id="ref" data-ref="editar_formulario=<?php echo $row_sucursales[$i]['id_sucursal']; ?>">
                                  <i class="fas fa-pen" style="font-size:1.2em;"></i>
                              </button>
                              <button type="button" class="btn btn-primary btn-sm mb-0 ">Acceder</button>
                              </div>
                          </div>
                      </div>
                  </div> 
              <?php } ?>
              <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 col-xs-12  mb-5">
                <div class="card h-100 card-plain border agregar_sucursal" id="ref" data-ref="formulario">
                  <div class="card-body d-flex flex-column justify-content-center text-center img_sucursal">
                      <a href="javascript:;">
                      <i class="fa fa-plus text-secondary mb-3" aria-hidden="true"></i>
                      <h5 class=" text-secondary" > Agregar sucursal </h5>
                      </a>
                  </div>
                </div>
            </div>
          <?php }else{ ?>
            <style>
              .header_tb{
                display: none;
              }
            </style>
            <div class="row mt-5 mb-5 justify-content-center d-flex">
              <img src="../img/svg/default_suc.png" class="main_default_sucursal">
                <h3 class="text-center">No cuentas con ninguna sucursal</h3>
                <p class="text-center">Crea tu primer sucursal y empieza a generar ventas.</p>
                <div class="col-12 text-center">
                  <button id="ref" data-ref="formulario" type="button" style="font-size: 1.2em" class="btn btn-primary btn-sm mb-0 ">Comenzar</button>
                </div>
            </div>
          <?php }
          ?>
          
          
      </div>
  </div>
  </span>
    </div>
</div>
<div class="card">
  <div class="card-body border-radius-lg bg-gradient-dark p-3">
    <h6 class="mb-0 text-white">
      ¿Necesitas más sucursales?
    </h6>
    <p class="text-white text-sm mb-4">
      Puedes solicitar este cambio con tu proveedor de servicio
    </p>
    <button class="btn bg-gradient-light mb-0">Contactar</button>
  </div>
</div>



<div class="modal fade" id="cuenta_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document" id="content_modal">
    
  </div>
</div>