<div class="modal-header">
    <h5 class="modal-title" id="exampleModalToggleLabel">Agregar categoria</h5>
    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<div class="modal-body">
    <div class="col-12" id="formulario_categoria">
        <label class="form-label">Nombre de la categoria</label>
        <div class="input-group mb-2">
            <input id="nombre_categoria" data-min="4" autocomplete="off" name="nombre_categoria" class="form-control validar_no_especiales" type="text" placeholder="¿Como se llamara?">
        </div>
        <span id="validar"></span>
    </div>
</div>
<div class="modal-footer">
    <button class="btn btn-secondary">Cancelar</button>
    <button class="btn btn-primary" id="insertar_categoria">Agregar</button>
</div>