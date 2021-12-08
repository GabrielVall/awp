<?php
session_start();
include_once("../../m/SQLConexion.php");
include_once("../../f/main_fnc.php");
$sql = new SQLConexion();
$row_complementos = $sql->obtenerResultado("CALL sp_select_ingredientes1('".$_SESSION['id_sucursal_bxpress']."')");
$total_complementos = count($row_complementos);
$complementos=json_decode($_POST['comp']);
?>
<div class="modal-header">
    <h5 class="modal-title" id="exampleModalToggleLabel">Ligar complementos</h5>
    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<div class="modal-body">
    <div class="col-12" id="formulario_categoria">
        <label class="form-label">Nombre del complemento</label>
        <div class="input-group mb-2">
            <select id="complementos_lista" multiple name="complementos_lista" >
                <?php
                    if($total_complementos > 0){
                        foreach($row_complementos as $complemento){ 
                            $id = $complemento['id_ingrediente'];
                            if(in_array($id, $complementos)){
                                $selected = 'selected ';
                            }else{
                                $selected = '';
                            }
                            $complemento = $complemento['nombre_ingrediente'];
                            ?>
                            <option <?php echo $selected ?> value="<?php echo $id ?>"><?php echo $complemento ?></option>
                        <?php }
                    }
                ?>
            </select>
        </div>
        <span id="validar"></span>
    </div>
</div>
<div class="modal-footer">
    <button class="btn btn-secondary">Cancelar</button>
    <button class="btn btn-primary" id="seleccionar_complementos" data-pos="<?php echo $_POST['pos']; ?>">Agregar</button>
</div>
<script>
    new SlimSelect({
    select: '#complementos_lista',
    placeholderSearch: true,
    searchPlaceholder: 'Buscar...',
    placeholder: 'Selecciona una opción..',
    closeOnSelect: false,
    searchText:'No se encontraron ingredientes'
    
});
</script>