<?php
include_once("../../../m/SQLConexion.php");
$sql = new SQLConexion();

$row_ultimas_acciones = $sql->obtenerResultado("CALL sp_select_ultimas_acciones1();");

?>
<div class="list-group list-group-flush my-n3">
    <div class="list-group-item">
        <div class="row align-items-center">
            <div class="col-auto">
                <span class="material-icons-round">edit_note</span>
            </div>
            <div class="col">
                <a href="javascript:void(0);" id="filtro_ordenes_dashboard" data-estado="6" class="text-decoration-none font-weight-bold text-dark">Ordenes pendientes por aceptar</a>
                <div class="my-0 text-muted small">#<?php echo $row_ultimas_acciones[0]['total_orden']; ?></div>
            </div>
        </div>
    </div>
</div>
<div class="list-group list-group-flush my-n3">
    <div class="list-group-item">
        <div class="row align-items-center">
            <div class="col-auto">
                <span class="material-icons-round">directions_bike</span>
            </div>
            <div class="col">
                <a href="javascript:void(0);" id="filtro_ordenes_dashboard" data-estado="9,10" class="text-decoration-none font-weight-bold text-dark">Ordenes en camino</a>
                <div class="my-0 text-muted small">#<?php echo $row_ultimas_acciones[1]['total_orden']; ?></div>
            </div>
        </div>
    </div>
</div>
<div class="list-group list-group-flush my-n3">
    <div class="list-group-item">
        <div class="row align-items-center">
            <div class="col-auto">
                <span class="material-icons-round">timer</span>
            </div>
            <div class="col">
                <a href="javascript:void(0);" id="filtro_ordenes_dashboard" data-estado="1" class="text-decoration-none font-weight-bold text-dark">Ordenes en temporizador</a>
                <div class="my-0 text-muted small">#<?php echo $row_ultimas_acciones[2]['total_orden']; ?></div>
            </div>
        </div>
    </div>
</div>
<div class="list-group list-group-flush my-n3">
    <div class="list-group-item">
        <div class="row align-items-center">
            <div class="col-auto">
                <span class="material-icons-round">check_circle_outline</span>
            </div>
            <div class="col">
                <a href="javascript:void(0);" id="filtro_ordenes_dashboard" data-estado="5" class="text-decoration-none font-weight-bold text-dark">Ordenes entregadas</a>
                <div class="my-0 text-muted small">#<?php echo $row_ultimas_acciones[3]['total_orden']; ?></div>
            </div>
        </div>
    </div>
</div>
<div class="list-group list-group-flush my-n3">
    <div class="list-group-item">
        <div class="row align-items-center">
            <div class="col-auto">
                <span class="material-icons-round">highlight_off</span>
            </div>
            <div class="col">
                <a href="javascript:void(0);" id="filtro_ordenes_dashboard" data-estado="3,4,7" class="text-decoration-none font-weight-bold text-dark">Ordenes canceladas</a>
                <div class="my-0 text-muted small">#<?php echo $row_ultimas_acciones[4]['total_orden']; ?></div>
            </div>
        </div>
    </div>
</div>