<div class="container-fluid py-4">
    <div class="card mb-4">
        <div class="card-header">
            <h5>Agregar producto</h5>
        </div>
        <div class="card-body pt-0">
            <div class="row">
                <div class="col-md-6 col-sm-12" id="formulario_producto" data-title="¡Bienvenido!" data-step="1" data-intro="En este formulario agregaras la información básica de tu sucursal.">
                    <label class="form-label">Nombre del producto</label>
                    <input type="hidden" name="id" value="0">
                    <div class="input-group mb-2">
                        <input id="nombre_producto"  data-min="4" autocomplete="off" name="nombre_producto" class="form-control validar_no_especiales" type="text" placeholder="¿Como se llamara?">
                    </div>
                    <span id="validar"></span>
                    <label class="form-label">Categoria</label>
                    <button type="button" id="modal" data-modal="agregar_categoria_sucursal" class="btn btn-primary btn-sm mb-0 config-btn">
                        <i class="fas fa-plus" style="font-size:1.2em;" aria-hidden="true"></i>
                    </button>
                    <div class="input-group ">
                        <select id="id_categoria" name="id_categoria">
                            
                        </select>
                    </div>
                    <label class="form-label">Complementos</label>
                    <button type="button" id="ref" data-ref="agregar_complementos_sucursal" class="btn btn-primary btn-sm mb-0 config-btn">
                        <i class="fas fa-plus" style="font-size:1.2em;" aria-hidden="true"></i>
                    </button>
                    <div class="input-group ">
                        <select id="id_complementos" multiple name="id_complementos">
                        </select>
                    </div>
                    <label class="form-label">Descripción del producto</label>
                    <div class="input-group">
                        <textarea name="descripcion" data-min="30" id="desc_producto" class="form-control validar_no_especiales" placeholder="Describe tu producto"></textarea>
                    </div>
                    <label class="form-label">Imagen del producto</label>
                    <div class="input-group">
                        <input name="imagen_producto" accept="image/x-png,image/gif,image/jpeg" id="imagen_producto" class="form-control" type="file">
                    </div>
                    <label class="form-label">Tiempo de preparacion (Minutos)</label>
                    <div class="input-group mb-2">
                        <input id="tiempo_preparacion"   data-min="4" autocomplete="off" name="tiempo_preparacion" class="form-control validar_no_especiales" type="text" placeholder="¿Cuanto tiempo tomara?">
                    </div>
                    <label class="form-label">Precio de venta</label>
                    <div class="input-group mb-2">
                        <input id="precio_venta"  data-min="4" autocomplete="off" name="precio_venta" class="form-control validar_no_especiales" type="text" placeholder="¿A cuanto venderas tu producto?">
                    </div>
                    <label class="form-label">Tipo de venta</label>
                    <div class="input-group mb-2">
                        <select id="tipo_unidad">
                            <option value="0">Vender por unidad</option>
                            <option value="1">Vender por unidad y kilogramos</option>
                        </select>
                    </div>
                    <span style="display:none">
                        <label class="form-label">Precio por Kilogramo</label>
                        <div class="input-group mb-2">
                            <input id="precio_kg" value="0"  data-min="4" autocomplete="off" name="precio_kg" class="form-control validar_no_especiales" type="text" placeholder="¿A cuanto venderas tu producto?">
                        </div>
                    </span>
                    <label class="form-label">Asignar a schedule(s)</label>
                    <button type="button" id="modal" data-modal="agregar_categoria_sucursal" class="btn btn-primary btn-sm mb-0 config-btn">
                        <i class="fas fa-plus" style="font-size:1.2em;" aria-hidden="true"></i>
                    </button>
                    <div class="input-group ">
                        <select id="id_menus" name="id_menus">
                            
                        </select>
                    </div>
                    <div class="row d-flex m-2 p-2">
                        <a href="javascript:void(0)" id="preview_sucursal" class="btn btn-sm btn-secondary"> Previsualizar</a>
                        <a href="javascript:void(0)" id="agregar_producto" data-id="0" class="btn btn-primary">Agregar producto</a>
                    </div>
                </div>
                <div class="col-md-6 col-sm-12 justify-content-center d-flex">
                    <div class="mobile-dark"  style="max-height:700px;">
                        <iframe height="562" width="315" id="frame_sucursal" src="preview/sucursal.php?editar=0"></iframe>
                    </div>
                </div>
            </div>
        </div>
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