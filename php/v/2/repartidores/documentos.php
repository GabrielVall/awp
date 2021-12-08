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
                    <h2 class="h3 page-title">Documentos del repartidor</h2>
                </div>
                <div class="col-auto">
                    <div class="page-header-breadcrumb">
                        <ul class="breadcrumb bg-light">
                            <li class="breadcrumb-item"><a href="#repartidores" class="text-decoration-none text-muted">Repartidores</a></li>
                            <li class="breadcrumb-item"><a href="#info_conductor_<?php echo $_POST['id_repartidor']; ?>" class="text-decoration-none text-muted"><?php echo $_SESSION['nombre_repartidor']; ?></a></li>
                            <li class="breadcrumb-item"><a href="#documentos_repartidor_<?php echo $_POST['id_repartidor']; ?>" class="text-decoration-none text-muted">Documentos</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="row">
                <!-- INGREDIENTES DEL PRODUCTO -->
                <div class="col-sm-12">
                    <div class="card shadow">
                        <div class="card-header d-flex align-items-center justify-content-between">
                            <strong class="card-title">Documentos del repartidor</strong>
                        </div>
                        <div class="card-body">
                            <div class="row" id="content_imagenes">
                                <?php
                                if (file_exists('../../../../documentos/repartidores/' . $_POST['id_repartidor']) && count(glob('../../../../documentos/repartidores/' . $_POST['id_repartidor'] . '/*')) > 0) {
                                    $directorio = opendir('../../../../documentos/repartidores/' . $_POST['id_repartidor']);
                                    while ($archivo = readdir($directorio)) {
                                        if ($archivo != '.' && $archivo != '.htaccess' && $archivo != '..') {
                                            echo
                                            '<div class="col-sm-12 col-md-3 img-row">
                                                <div class="card shadow text-center mb-4">
                                                    <div class="card-body file">
                                                        <div class="file-action">
                                                            <button type="button" class="btn btn-link dropdown-toggle more-vertical p-0 text-muted mx-auto" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                <span class="text-muted sr-only">Action</span>
                                                            </button>
                                                            <div class="dropdown-menu m-2">
                                                                <a class="dropdown-item d-flex align-items-center" href="../../../../documentos/repartidores/' . $_POST['id_repartidor'].'/'.$archivo.'" download="'.$archivo.'"><span style="font-size:16px;" class="material-icons-round mr-2">cloud_download</span>Descargar</a>
                                                            </div>
                                                        </div>
                                                        <div class="circle circle-lg bg-light my-4 d-flex justify-content-center align-items-center" style="left:0; right:0; margin:auto;">
                                                            <span class="material-icons-round text-secondary">description</span>
                                                        </div>
                                                        <div class="file-info">
                                                            <span class="badge badge-light text-muted mr-2">'.formatSizeUnits(filesize('../../../../documentos/repartidores/' . $_POST['id_repartidor'].'/'.$archivo)).'</span>
                                                        </div>
                                                    </div>
                                                    <div class="card-footer bg-transparent border-0 fname">
                                                        <strong>'.$archivo.'</strong>
                                                    </div>
                                                </div>
                                            </div>';
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
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>