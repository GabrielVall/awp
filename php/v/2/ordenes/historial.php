<?php
include_once("../../../m/SQLConexion.php");
$sql = new SQLConexion();

$row_ordenes = $sql->obtenerResultado("CALL sp_select_ordenes6(1,'".date("Y-m")."');");
$total_row_ordenes = count($row_ordenes);

$row_origenes_orden = $sql->obtenerResultado("CALL sp_select_origenes_orden1();");
$total_row_origenes_orden = count($row_origenes_orden);

$meses = array("Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre");
?>
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="row align-items-center mb-2">
                <div class="col">
                    <h2 class="h3 page-title">Historial de ordenes</h2>
                </div>
                <div class="col-auto">
                    <button class="btn btn-sm btn-dark d-flex align-items-center dropdown-toggle more-horizontal" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Opciones <span class="material-icons-round">expand_more</span></button>
                    <div class="dropdown-menu dropdown-menu-right">
                        <a href="#nuevo_cliente" class="dropdown-item d-flex align-items-center"><span class="material-icons">person_add</span>&nbspAgregar cliente</a>
                        <a class="dropdown-item d-flex align-items-center" href="javascript:void(0);" id="exportar_historial_ordenes_excel"><span class="material-icons text-success">description</span>&nbspFormato Excel</a>
                        <a class="dropdown-item d-flex align-items-center" href="javascript:void(0);" id="exportar_historial_ordenes_pdf"><span class="material-icons text-danger">picture_as_pdf</span>&nbspFormato PDF</a>
                    </div>
                </div>
            </div>
            <div class="row align-items-center mb-2 border-top pt-4">
                <div class="col"></div>
                <div class="col-auto">
                    <div class="row">
                        <div class="col">
                            <select id="tipo_historial" class="form-control form-control-sm">
                                <option value="1">Ordenes</option>
                                <option value="2">Ordenes express</option>
                                <option value="3">Ordenes punto a punto</option>
                            </select>
                        </div>
                        <div class="col">
                            <select id="tipo_fecha" class="form-control form-control-sm">
                                <option value="1">Por mes</option>
                                <option value="2">Por día</option>
                            </select>
                        </div>
                        <div class="col" id="group_mes_filtro">
                            <select id="mes_filtro" class="form-control form-control-sm">
                                <?php
                                for ($i = 0; $i < 12; $i++) {

                                    ($i + 1) < 10 ? $mes_option = date("Y"). '-' .'0' . ($i + 1) : $mes_option = date("Y") . '-' . ($i + 1);
                                    $mes_option == date("Y-m") ? $selected = 'selected' : $selected = '';

                                    echo '<option ' . $selected . ' value="' . $mes_option . '">' . $meses[$i] . ' - ' . date("Y") . '</option>';
                                }
                                ?>
                            </select>
                        </div>
                        <div class="col d-none" id="group_fecha_filtro">
                            <input type="text" id="fecha_filtro" class="form-control form-control-sm fecha-filtro bg-white" value="<?php echo date("d-m-Y"); ?>">
                        </div>
                        <div class="col text-right">
                            <button type="button" id="btn_aplicar_filtro_historial_ordenes" class="btn btn-sm btn-secondary w-75">Aplicar</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <div class="card shadow" id="content_historial">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <strong class="card-title float-left">Historial de ordenes</strong>
                            <div>
                                <!--<ul class="pagination pagination-sm">
                                    <?php
                                    if ($total_row_clientes > 0) {
                                        $limite_paginacion = 10;
                                        $last_page = ($total_row_clientes / $limite_paginacion);
                                        $bolean = false;

                                        if (is_float($last_page)) {
                                            $fin_for = ($last_page + 1);
                                        } else {
                                            $fin_for = $last_page;
                                        }

                                        echo
                                        '<li class="page-item paginate_button" id="prev_page">
                                                <a class="page-link"><span aria-hidden="true">Ant.</span></a>
                                            </li>';
                                        for ($i = 0; $i < intval($fin_for); $i++) {

                                            if (($i + 1) <= 5) {
                                                echo
                                                '<li class="page-item paginate_button page-item-' . ($i + 1) . ' ';
                                                if ($i == 0) {
                                                    echo 'active';
                                                }
                                                echo '" id="new_page" data-page="' . ($i + 1) . '"><a class="page-link">' . ($i + 1) . '</a></li>';
                                            } else {
                                                $bolean = true;
                                            }
                                        }
                                        if ($bolean == true) {

                                            echo
                                            '<li class="page-item paginate_button">
                                                    <a class="page-link">...</a>
                                                </li>';
                                        }
                                        echo
                                        '<li class="page-item paginate_button" id="next_page" data-last="' . intval($fin_for) . '">
                                                <a class="page-link"><span aria-hidden="true">Sig.</span></a>
                                            </li>';
                                    }
                                    ?>
                                </ul>-->
                            </div>
                            <div>
                                <div class="form-group my-0 py-0 text-right">
                                    <label class="font-weight-bold text-dark">Origen de orden</label>
                                </div>
                                <div class="form-group my-0 py-0">
                                    <?php
                                    if($total_row_origenes_orden>0){
                                        for($i=1; $i<$total_row_origenes_orden; $i++){
                                            echo '<label class="mr-2"><span class="dot dot-md '.$row_origenes_orden[$i]['color_origen_orden'].'"></span> '.$row_origenes_orden[$i]['nombre_origen_orden'].'</label>';
                                        }
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>
                        <div class="card-body p-0 m-0">
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th colspan="2" class="text-center">No.</th>
                                            <th>Comprador</th>
                                            <th>Sucursal</th>
                                            <th>Tipo de orden</th>
                                            <th>Método de pago</th>
                                            <th>Estado de orden</th>
                                            <th>Dirección</th>
                                            <th>Fecha</th>
                                            <th>Total de orden</th>
                                            <th>Opciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        if($total_row_ordenes>0){
                                            for ($i=0; $i < $total_row_ordenes; $i++) { 
                                                echo
                                                '<tr id="row_orden_'.$row_ordenes[$i]['id_orden'].'">
                                                    <td><span class="dot dot-md '.$row_ordenes[$i]['color_origen_orden'].'"></span></td>
                                                    <td>#'.$row_ordenes[$i]['id_orden'].'</td>
                                                    <td style="max-width:200px;">
                                                        <p class="mb-0 text-muted text-truncate"><strong>'.$row_ordenes[$i]['nombre_cliente'].'</strong></p>
                                                        <small class="mb-0 text-muted text-truncate">'.$row_ordenes[$i]['apellido_cliente'].'</small>
                                                    </td>
                                                    <td style="max-width:250px;">
                                                        <p class="mb-0 text-muted text-truncate">'.$row_ordenes[$i]['nombre_sucursal'].'</p>
                                                    </td>
                                                    <td>'.$row_ordenes[$i]['nombre_tipo_orden'].'</td>
                                                    <td style="max-width:350px;"
                                                        ><p class="mb-0 text-muted text-truncate">'.$row_ordenes[$i]['nombre_metodo_pago'].'</p>
                                                    </td>
                                                    <td style="max-width:350px;">
                                                        <p class="mb-0 text-muted text-truncate">'.$row_ordenes[$i]['nombre_estado_orden'].'</p>
                                                    </td>
                                                    <td style="max-width:350px;">
                                                        <p class="mb-0 text-muted text-truncate">'.$row_ordenes[$i]['direccion_orden'].'</p>
                                                    </td>
                                                    <td style="max-width:350px;">
                                                        <p class="mb-0 text-muted text-truncate">'.$row_ordenes[$i]['fecha_registro_orden'].' hrs.</p>
                                                    </td>
                                                    <td class="max-width:200px;">
                                                        <p class="mb-0 text-success text-truncate">'.$row_ordenes[$i]['simbolo_tipo_cambio']. $row_ordenes[$i]['costo_total_orden'].'</p>
                                                    </td>
                                                    <td>
                                                        <a class="btn btn-sm btn-outline-dark" style="width:90px;" href="#order_detail_'.$row_ordenes[$i]['id_orden'].'">Ver detalles</a>
                                                    </td>
                                                </tr>';
                                            }
                                        }
                                        else{
                                            echo
                                            '<tr>
                                                <td colspan="11">No se encontraron resultados</td>
                                            </tr>';
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    // FLATPICKR
    $(".fecha-filtro").flatpickr({
        enableTime: false,
        noCalendar: false,
        dateFormat: "d-m-Y",
        locale: {
            firstDayOfWeek: 1,
            weekdays: {
                shorthand: ['Do', 'Lu', 'Ma', 'Mi', 'Ju', 'Vi', 'Sa'],
                longhand: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'],
            },
            months: {
                shorthand: ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Оct', 'Nov', 'Dic'],
                longhand: ['Enero', 'Febrero', 'Мarzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
            },
        },
    });
</script>