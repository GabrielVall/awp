<?php
session_start();
include_once("../../m/SQLConexion.php");
include_once("../../f/main_fnc.php");
$sql = new SQLConexion();
?>
<div class="container-fluid py-4">
    <div class="card mb-4">
        <div class="card-header">
            <div class="row">
                <div class="nav-wrapper position-relative end-0">
                    <ul class="nav nav-pills nav-fill p-1" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link mb-0 px-0 py-1 tab_suc active-tab" data-show="#complementos_card">
                                Agregar servicio
                            </a>
                        </li>
                        <li class="nav-item">
                        <a class="nav-link mb-0 px-0 py-1 tab_suc" data-show="#tabla_ingredientes">
                            Servicios agregados
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="card-body pt-0" id="complementos_card">
            <div class="row">
                <div class="col-md-6 col-sm-12" id="formulario_complementos">
                <label class="form-label">Folio</label>
            <div class="input-group mb-2">
                <input id="folio"  
                class="form-control " 
                type="text" disabled placeholder="Este campo se generara automaticamente">
            </div>
                    <label class="form-label">Fecha de registro</label>
                    <div class="input-group mb-2">
                        <input id="nombre_complemento"   autocomplete="off" name="nombre_complemento"
                        class="form-control val_text" val-min="3" val-max="20" val-text="1"
                        type="date" value="<?php echo date('Y-m-d'); ?>" placeholder="¿Como se llamara?">
                    </div>
                    <div class="row mt-3">
                        <div class="col-12 col-sm-6">
                            <div>
                                <label>Fecha de atencion</label>
                                <input id="cant_minima" class="multisteps-form__input form-control val_text" 
                                val-tel="1" val-min="1" val-max="2" 
                                type="date" value="<?php echo date('Y-m-d'); ?>" placeholder="Minimo de ingredientes a eligir">
                          </div>
                        </div>
                        <div class="col-12 col-sm-6 mt-3 mt-sm-0">
                            <div>
                                <label>Fecha de cierre</label>
                                <input class="multisteps-form__input form-control val_text" id="cant_maxima" 
                                val-tel="1" val-min="1" val-max="2" 
                                type="date" value="<?php echo date('Y-m-d'); ?>" placeholder="Máximo de ingredientes a eligir">
                            </div>
                        </div>
                    </div>
                    <label>Cliente atendido</label><button type="button" id="modal" data-modal="agregar_categoria_sucursal" class="btn btn-primary btn-sm mb-0 config-btn">
                        <i class="fas fa-plus" style="font-size:1.2em;" aria-hidden="true"></i>
                    </button>
                      <select id="id_categoria">
                          <?php
                            $row_categorias = $sql->obtenerResultado("CALL sp_select_categorias_producto1('".$_SESSION['id_sucursal_bxpress']."')");
                            $total_categorias = count($row_categorias);
                            ?>
                            <option selected disabled>Selecciona un cliente</option>
                            <?php 
                                if($total_categorias > 0){
                                    foreach($row_categorias as $categ){ 
                                        $nombre_categoria = $categ['nombre_categoria_producto'];
                                        $id = $categ['id_categoria_producto'];
                                        ?>
                                        <option value="<?php echo $id ?>"><?php echo $nombre_categoria ?></option>
                                    <?php }
                                }
                            ?>
                      </select>
                    <div class="row m-2 border-dot justify-content-center d-flex">
                        <span class="row m-0 p-0 justify-content-center d-flex" id="complementos_div">
                            <span class="row m-0 p-0 justify-content-center d-flex ingrediente_row">
                            <div class="col-12 col-sm-6 nom-comp">
                                <div>
                                    <label>Materiales</label>
                                    <input class="multisteps-form__input form-control val_text nombre"
                                    val-min="3" val-max="20" val-text="1"
                                    type="text" placeholder="Nombre del material">
                                </div>
                                <span id="validar"></span>
                            </div>
                            <div class="col-12 col-sm-6 precio-comp">
                                <div>
                                    <label>Costo(si aplica)</label>
                                    <input class="multisteps-form__input form-control val_text precio"
                                    val-min="1" val-tel="1"
                                    type="text" placeholder="Precio">
                                </div>
                                <a data-pos="0" complementos="0" class=" float-end btn btn-link text-dark p-0 m-0 my-1" id="modal_complementos" href="javascript:;"><i class="fas fa-link"></i> Materiales para el servicio</a>
                            </div>
                            </span>
                        </span>
                        <div class="row">
                            <div class="col-5">
                                <a href="javascript:void(0)" id="quitar_ing_vista" class="btn btn-sm btn-danger mt-4 w-100"><i class="fas fa-minus-circle"></i> Quitar</a>
                            </div>
                            <div class="col-7">
                                <a href="javascript:void(0)" id="agregar_ing_vista" class="btn btn-sm btn-primary mt-4 w-100"><i class="fas fa-plus-circle"></i> Agregar</a>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-12">
                          <label>Descripción del servicio</label>
                          <textarea type="text" class="form-control" id="seleccion_multiple" placeholder="Descripción del servicio que han solicitado"></textarea>
                          <!-- <select class="form-control" id="seleccion_multiple">
                              <option value="0" selected>Solo 1 por complemento</option>
                              <option value="1">Puede seleccionar varios</option>
                          </select> -->
                        </div>
                      </div>
                      
                    <div class="row d-flex m-2 p-2">
                        <a href="javascript:void(0)" id="preview_complemento" class="btn btn-sm btn-secondary" > Previsualizar</a>
                        <a href="javascript:void(0)" id="agregar_complemento" data-id="0" class="btn btn-primary" >Agregar servicio</a>
                    </div>
                </div>
                <div class="col-md-6 col-sm-12 justify-content-center d-flex">
                    <div class="mobile-dark"  style="max-height:700px;">
                        <iframe height="562" width="315" id="frame_sucursal" src="preview/sucursal.php?editar=0"></iframe>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-body pt-0" style="display:none;"  id="tabla_ingredientes">

        </div>
    </div>
    <script>
    $('select').each(function(){
        var close = 0;
        if($(this).is('[multiple]')){
            close = false;
        }else{
            close = true;
        }
        new SlimSelect({
            select: this,
            placeholderSearch: true,
            searchPlaceholder: 'Buscar...',
            placeholder: 'Selecciona una opción..', 
            searchText:'No hay resultados',
            closeOnSelect: close,
        });
    });
</script>