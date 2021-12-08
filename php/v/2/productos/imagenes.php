<?php
session_start();
function formatSizeUnits($bytes){
    if ($bytes >= 1073741824){
        $size = number_format($bytes / 1073741824, 2) . ' Gb';
    }
    elseif ($bytes >= 1048576){
        $size = number_format($bytes / 1048576, 2) . ' Mb';
    }
    elseif ($bytes >= 1024){
        $size = number_format($bytes / 1024, 2) . ' Kb';
    }
    elseif ($bytes > 1){
        $size = $bytes . ' Bytes';
    }
    elseif ($bytes == 1){
        $size = $bytes . ' Byte';
    }
    else
    {
        $size = '0 bytes';
    }

    return $size;
}
?>
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="row align-items-center mb-2">
                <div class="col">
                    <h2 class="h3 page-title">Imágenes del producto</h2>
                </div>
                <div class="col-auto"></div>
            </div>
            <div class="row">
                <!-- INGREDIENTES DEL PRODUCTO -->
                <div class="col-sm-12">
                    <div class="card shadow">
                        <div class="card-header d-flex align-items-center justify-content-between">
                            <strong class="card-title">Imágenes del producto</strong>
                            <a href="javascript:void(0);" class="text-muted" data-num="1" id="agregar_imagenes_producto">Agregar imágenes</a>
                        </div>
                        <div class="card-body">
                            <div class="row" id="content_imagenes">
                                <?php
                                if (file_exists('../../../../img/productos/' . $_POST['id_producto']) && count(glob('../../../../img/productos/' . $_POST['id_producto'] . '/*')) > 0) {
                                    $i=0;
                                    $directorio = opendir('../../../../img/productos/' . $_POST['id_producto']);
                                    while ($archivo = readdir($directorio)) {
                                        if ($archivo != '.' && $archivo != '.htaccess' && $archivo != '..') {
                                            echo
                                            '<div class="col-sm-12 col-md-3 img-row" id="image_'.$i.'">
                                                <div class="card bg-transparent">
                                                    <img src="../img/productos/' . $_POST['id_producto'] . '/' . $archivo . '" class="card-img-top img-fluid rounded">
                                                    <div class="card-body">
                                                        <h5 class="h6 card-title mb-1 text-truncate">'.$archivo.'</h5>
                                                        <p class="card-text">
                                                            <span class="badge badge-light text-muted mr-2">'.formatSizeUnits(filesize('../../../../img/productos/' . $_POST['id_producto'].'/'.$archivo)).'</span>
                                                            <span class="badge badge-pill badge-danger" style="cursor:pointer;" id="eliminar_imagen_producto" data-id="'.$_POST['id_producto'].'" data-posicion="'.$i.'" data-name="'.$archivo.'">Eliminar</span>
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>';

                                            $i++;
                                        }
                                    }
                                }
                                else{
                                    echo
                                    '<div class="col-sm-12">
                                        <div class="text-center my-5">
                                            <h2 class="mb-0">No se encontraron imágenes</h2>
                                            <p class="lead text-muted">No se han agregado imágenes al producto</p>
                                        </div>
                                    </div>';
                                }
                                ?>
                            </div>
                            <div class="form-group content_dropzone" style="display:none;">
                                <div class="dropzone" id="myDropzone"></div>
                            </div>
                            <div class="form-group text-right content_dropzone" style="display:none;">
                                <button class="btn btn-outline-dark" id="btn_agregar_imagenes_producto" data-id="<?php echo $_POST['id_producto']; ?>">Agregar</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- MODALES -->
<!-- ELIMINAR -->
<div class="modal fade" id="modal_eliminar" tabindex="-1" role="dialog" aria-labelledby="defaultModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="defaultModalLabel">Eliminar imagen</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Está seguro de eliminar la imagen? De click en confirmar.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn mb-2 btn-outline-dark" id="btn_eliminar_imagen_producto">Confirmar</button>
            </div>
        </div>
    </div>
</div>
<!-- CROPPER -->
<div class="modal fade" id="modal_cropper" data-backdrop="static" aria-modal="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Recorte de imagen</h5>
                <button type="button" class="close" data-dismiss="modal"><span>×</span></button>
            </div>
            <div class="modal-body"></div>
            <div class="modal-footer">
                <button type="button" class="btn btn-dark" data-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-primary" id="btn_cropper" data-id="">Confirmar</button>
            </div>
        </div>
    </div>
</div>
<script>
    // CROPPER
    cropper_dropzone('.dropzone', '.jpg, .jpeg', 10, 'cropper_dropzone', 'productos', <?php echo $_SESSION['id_empresa_reparto_bexpress'];?>, 800, 600);
</script>