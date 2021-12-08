<?php
session_start();
include_once("../../../m/SQLConexion.php");
$sql = new SQLConexion();

$row_paises = $sql->obtenerResultado("CALL sp_select_paises();");
$total_row_paises = count($row_paises);

?>
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="row align-items-center mb-2">
                <div class="col">
                    <h2 class="h3 page-title">Agregar nuevo cliente</h2>
                </div>
                <div class="col-auto">
                    <div class="page-header-breadcrumb">
                        <ul class="breadcrumb bg-light">
                            <li class="breadcrumb-item"><a href="#clientes" class="text-decoration-none text-muted">Clientes</a></li>
                            <li class="breadcrumb-item"><a href="#nuevo_cliente" class="text-decoration-none text-muted">Nuevo cliente</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="card shadow">
                <div class="card-header">
                    <strong class="card-title">Nuevo cliente</strong>
                </div>
                <div class="card-body py-4 mb-1">
                    <div class="row" id="content_info">
                        <div class="row">
                            <div class="col-sm-12 col-md-6 border-right">
                                <div class="row">
                                    <div class="col-sm-12 col-md-6">
                                        <div class="form-group">
                                            <label class="form-label">Nombre(s)</label>
                                            <input type="text" class="form-control name_format" id="nombre_cliente">
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-6">
                                        <div class="form-group">
                                            <label class="form-label">Apellidos</label>
                                            <input type="text" class="form-control name_format" id="apellido_cliente">
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-6">
                                        <div class="form-group">
                                            <label class="form-label">Tel. contacto</label>
                                            <input type="text" class="form-control phone_format" id="telefono_cliente">
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-6">
                                        <div class="form-group">
                                            <label class="form-label">Ciudad</label>
                                            <select id="id_ciudad">
                                                <?php
                                                if($total_row_paises>0){
                                                    foreach ($row_paises as $dato_pais) {
                                                        
                                                        $row_estados = $sql->obtenerResultado("CALL sp_select_estados2('".$dato_pais['id_pais']."');");
                                                        $total_row_estados = count($row_estados);
                                                        
                                                        echo
                                                        '<optgroup label="'.$dato_pais['nombre_pais'].'">';
                                                            if($total_row_estados>0){
                                                                foreach ($row_estados as $dato_estado) {
            
                                                                    $row_ciudades = $sql->obtenerResultado("CALL sp_select_ciudades2('".$dato_estado['id_estado']."');");
                                                                    $total_row_ciudades = count($row_ciudades);
            
                                                                    echo
                                                                    '<optgroup label="&nbsp&nbsp&nbsp'.$dato_estado['nombre_estado'].'">';
                                                                        if($total_row_ciudades>0){
                                                                            foreach($row_ciudades as $dato_ciudad){
                                                                                echo '<option value="'.$dato_ciudad['id_ciudad'].'">&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp'.$dato_ciudad['nombre_ciudad'].'</option>';
                                                                            }
                                                                        }
                                                                    echo
                                                                    '</optgroup>';
                                                                }
                                                            }
                                                        echo
                                                        '</optgroup>';
                                                    }
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-6">
                                <div class="form-group">
                                    <label class="form-label">Correo</label>
                                    <input type="text" class="form-control email_format" id="correo_cliente">
                                </div>
                                <div class="row">
                                    <div class="col-sm-12 col-md-6">
                                        <div class="form-group">
                                            <label class="form-label">Nombre de usuario</label>
                                            <input type="text" class="form-control string_format" id="nombre_usuario">
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-6">
                                        <div class="form-group">
                                            <label class="form-label">Contraseña</label>
                                            <input type="password" class="form-control" id="contrasena">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group text-right">
                        <button class="btn btn-outline-dark" id="btn_agregar_cliente">Agregar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    // SLIMSELECT
    var select_id_ciudad = new SlimSelect({
        select: '#id_ciudad',
        searchText: 'No se encontraron resultados',
        searchPlaceholder: 'Buscar',
        placeholder: 'Seleccione una ciudad',
    });
</script>