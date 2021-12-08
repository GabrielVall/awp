<?php 
session_start();
include_once("../../php/f/main_fnc.php");
?>
<html lang="es" class="flowx-none light"><head>
      <meta charset="UTF-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>Mockup Cliente</title>
      <link rel="stylesheet" href="css/estilos.css">
      <link rel="stylesheet" href="css/bootstrap.min.css">
      <link rel="stylesheet" href="css/icons.css">
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" referrerpolicy="no-referrer">
      <link href="https://fonts.googleapis.com/css2?family=Material+Icons+Round" rel="stylesheet">
     </head>
     <?php if( !isset($_GET['img']) &&  $_GET['editar'] == 0 ){ ?>
     <div class="img-container">
        <img src="../../img/svg/default_suc.png" class="cropped"/>
        <a href="#" class="prm-btn">Haz click en <b>previsualizar</b> para ver los cambios </a>
      </div>

     <style>
div.img-container {
   width: 100%;
   height: 100%;
     position: fixed;
     z-index: 9999;
     margin-left: auto;
     margin-right: auto;
     overflow: hidden;
     background-color:#eeeeee;
 }
img.cropped {
    position: absolute;
    margin: auto;
    width:50%;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
}
.prm-btn{
   position: absolute;
    margin: auto;
    width:90%;
    left: 0;
    right: 0;
    bottom: 25%;
   background-color: black !important;
    color: white !important;
    margin-bottom: 1rem;
    letter-spacing: -0.025rem;
    text-transform: uppercase;
    box-shadow: 0 4px 7px -1px rgb(0 0 0 / 11%), 0 2px 4px -1px rgb(0 0 0 / 7%);
    background-size: 150%;
    background-position-x: 25%;
    display: inline-block;
    line-height: 1.4;
    color: #67748e;
    text-align: center;
    vertical-align: middle;
    cursor: pointer;
    user-select: none;
    background-color: transparent;
    border: 1px solid transparent;
    padding: 0.75rem 1.5rem;
    font-size: 0.75rem;
    border-radius: 0.5rem;
    transition: all 0.15s ease-in;
    text-decoration: none;
}
}
body{
   zoom: 80%;
}
</style>
<?php }else{?> 
   <style>
      body{
   zoom: 80%;
}
   </style>
   <?php } ?>
   <body>
      <div class="row flowx-none w-100 d-flex justify-content-center m-main">
         <div id="container_full" class="col-12 col-lg-8 pr-0 mw-100"><div class="container content-busqueda">
   <div class="row mt-2 mb-2 pl-1">
      <div class="col-8 align-items-center d-flex">
         <input type="search" placeholder="Buscar..." value="Direccion de envio">
         <span id="ref" data-ref="menu=direcciones" class="material-icons-round icono-input" data-position="0" data-hash="" data-bs-toggle="popover" title="" data-bs-content="Puedes editar tu direccion en cualquier momento desde este boton" data-bs-original-title="Editar ubicación">edit</span>
      </div>
      <div class="col-4 justify-content-center d-flex align-items-center">
         <a href="#menu" class="btn-round-icon justify-content-center d-flex align-items-center" data-position="4" data-hash="" data-bs-toggle="popover" title="" data-bs-content="Puedes volver a ver los textos de ayuda desde la configuración" data-bs-original-title="Configuración">
            <i class="fa fa-user "></i>
         </a>
      </div>
   </div>
  
   <div class="scroll-body">
      <div class="row w-100 px-2  my-4 justify-content-between align-items-start d-flex">
         <div class="col-8">
            <h3 class="text-categorias mb-3">Tiendas cercanas </h3>
         </div>
         <div class="col-4 justify-content-end d-flex boton-row align-items-start">
            <ico class="active">
               <span class="material-icons-round">table_rows</span>
            </ico>
            <ico>
               <span class="material-icons-round">grid_view</span>
            </ico>
         </div>
      </div>
      <div class="contenedor-sucursales-row row  d-flex un-cuadro justify-content-start">
         <div class="contenedor-grid" id="ir_href" data-id="1" data-file="sucursal" data-filtro="comida,hamburgesas,rapida">
            <div class="col-12 imagen-sucursal" style="background-image:  url('<?php
            if($_GET['editar'] > 0){
               echo select_imagen('sucursales/',$_GET['editar'],2,2);
            }else{
            if( isset($_GET['img'])){ 
               echo select_imagen('preview_sucursal/',$_SESSION['id_usuario_bxpress'],2,2);
                } 
            }
            ?>');">
               <div class="badge-precio">
                  Envio $30.00 MXN
               </div>
            </div>
            <div class="row detalles-info d-flex justify-content-between text-center">
               <div class="grid-col mt-1">
                  <?php 
                     if( isset($_GET['nombre']) ){
                        echo $_GET['nombre'];
                     }else{
                        echo 'Nombre sucursal';
                     }
                  ?>
               </div>
               <div class="grid-col align-items-center d-flex justify-content-center ">
                  <span class="material-icons-round font-">grade</span>
                  <span>5.0</span>
               </div>
               <p class="px-4 mb-0 max-3-lines" style="overflow: hidden;
   text-overflow: ellipsis;
   display: -webkit-box;
   -webkit-line-clamp: 3; /* number of lines to show */
   -webkit-box-orient: vertical;">
               <?php 
                     if( isset($_GET['desc']) ){
                        echo $_GET['desc'];
                     }else{
                        echo 'Descripción';
                     }
                  ?>
               </p>
               <div class="row w-100 px-4 justify-content-start d-flex my-2">
                  <div class="sub-categ mx-1 col">
                  <?php 
                     if( isset($_GET['categ']) ){
                        echo $_GET['categ'];
                     }else{
                        echo 'Categoria';
                     }
                  ?>
                  </div>
               </div>
            </div>
         </div>
         
      </div>
      
   </div>
</div></div>
         
      </div>
      <div class="p-absoulute w-100 justify-content-between d-flex text-center menu-bottom">
         <div class="grid-btm first-div" data-href="">
            <span class="material-icons-round">arrow_back</span>  
         </div>
         <div class="bottom-menu logo-nav">
            <img src="https://logodownload.org/wp-content/uploads/2019/07/mini-logo.png">
         </div>
         <div class="grid-btm bottom-menu active" id="ref" data-ref="">
            <span class="material-icons-round ">
            home
            </span>
            <name>Inicio</name>
         </div>
         <div class="grid-btm bottom-menu" id="ref" data-ref="menu=perfil">
            <span class="material-icons-round">
            shopping_basket
            </span>
            <name>Mis compras</name>
         </div>
         <div class="grid-btm bottom-menu" id="ref" data-ref="tiendas">
            <span class="material-icons-round">
            store
            </span>
            <name>Tiendas</name>
         </div>
         <div class="grid-btm bottom-menu" id="ref" data-ref="enviar">
            <span class="material-icons-round"> 
            person_pin_circle
            </span>
            <name>Enviar</name>
         </div>
      </div>
   

</body></html>