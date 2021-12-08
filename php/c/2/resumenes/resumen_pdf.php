<?php
session_start();
include_once('../../../../librerias/fpdf/fpdf.php');
include_once("../../../m/SQLConexion.php");
$sql = new SQLConexion();

$row_totales_ordenes = $sql->obtenerResultado("CALL sp_select_resumen1('" . $_GET['fecha'] . "');");
$total_row_totales_ordenes = count($row_totales_ordenes);

$row_metodos_pago = $sql->obtenerResultado("CALL sp_select_metodos_pago1('" . $_GET['fecha'] . "');");
$total_row_metodos_pago = count($row_metodos_pago);

$row_sucursales = $sql->obtenerResultado("CALL sp_select_sucursales3('" . $_GET['fecha'] . "');");
$total_row_sucursales = count($row_sucursales);

$row_repartidores = $sql->obtenerResultado("CALL sp_select_repartidores5('" . $_GET['fecha'] . "');");
$total_row_repartidores = count($row_repartidores);

$row_cliente = $sql->obtenerResultado("CALL sp_select_cliente2('" . $_GET['fecha'] . "');");

$row_dia_frecuente = $sql->obtenerResultado("CALL sp_select_dia_frecuente_ordenes1('" . $_GET['fecha'] . "');");

$pdf = new FPDF('P','mm');
$pdf->AddPage();

// ENCABEZADO

    $pdf->Image('../../../../img/0/logo_blanco.png',55,10,80,80);

    $pdf->SetFillColor(10,54,157);
    $pdf->SetFont('Arial', 'B', 10);
    $pdf->setXY(5,15);
    $pdf->Cell(100, 5, "Resumen de ventas ".$_GET['fecha'],0,0,'L', false);

    $pdf->SetFont('Arial', 'B', 10);
    $pdf->Line(5,20,205,20);
    $pdf->setXY(5,25);
    $pdf->SetTextColor(255,255,255);
    $pdf->Cell(50, 7, "Ordenes ordinarias",1,1,'L', true);

    $pdf->SetFont('Arial', '', 10);
    $pdf->setXY(5,32);
    $pdf->SetTextColor(0,0,0);
    $pdf->Cell(50, 7, $row_totales_ordenes[0]['total'],1,1,'C', false);

    $pdf->SetFont('Arial', 'B', 10);
    $pdf->SetTextColor(255,255,255);
    $pdf->setXY(140,25);
    $pdf->Cell(65, 7, utf8_decode("Día con más demanda"),1,1,'C', true);
    
    $pdf->SetFont('Arial', '', 10);
    $pdf->SetTextColor(0,0,0);
    $pdf->setXY(140,32);
    $pdf->Cell(65, 7, utf8_decode($row_dia_frecuente[0]['dia_frecuente']),1,1,'C', false);

    $pdf->SetFont('Arial', 'B', 10);
    $pdf->setXY(5,47);
    $pdf->SetTextColor(255,255,255);
    $pdf->Cell(50, 7, "Ordenes express",1,1,'L', true);

    $pdf->SetFont('Arial', '', 10);
    $pdf->setXY(5,54);
    $pdf->SetTextColor(0,0,0);
    $pdf->Cell(50, 7, $row_totales_ordenes[1]['total'],1,1,'C', false);

    $pdf->SetFont('Arial', 'B', 10);
    $pdf->SetTextColor(255,255,255);
    $pdf->setXY(140,47);
    $pdf->Cell(65, 7, utf8_decode("Día con más demanda"),1,1,'C', true);
    
    $pdf->SetFont('Arial', '', 10);
    $pdf->SetTextColor(0,0,0);
    $pdf->setXY(140,54);
    $pdf->Cell(65, 7, utf8_decode($row_dia_frecuente[1]['dia_frecuente']),1,1,'C', false);

    $pdf->SetFont('Arial', 'B', 10);
    $pdf->setXY(5,65);
    $pdf->SetTextColor(255,255,255);
    $pdf->Cell(50, 7, "Ordenes punto a punto",1,1,'L', true);

    $pdf->SetFont('Arial', '', 10);
    $pdf->setXY(5,72);
    $pdf->SetTextColor(0,0,0);
    $pdf->Cell(50, 7, $row_totales_ordenes[2]['total'],1,1,'C', false);

    $pdf->SetTextColor(255,255,255);
    $pdf->SetFont('Arial', 'B', 10);
    $pdf->setXY(140,65);
    $pdf->Cell(65, 7, utf8_decode("Día con más demanda"),1,1,'C', true);

    $pdf->SetTextColor(0,0,0);
    $pdf->SetFont('Arial', '', 10);
    $pdf->setXY(140,72);
    $pdf->Cell(65, 7, utf8_decode($row_dia_frecuente[2]['dia_frecuente']),1,1,'C', false);


    

// TABLA DE SUCURSALES

    $pdf->SetFont('Arial', 'B', 10);
    // ENCABEZADO
        $pdf->SetFillColor(10,54,157);
        $pdf->SetTextColor(255,255,255);
        $pdf->setXY(5,88);
        $pdf->Cell(150, 7, "Top 5 mejores sucursales",1,1,'L', true);
        $pdf->setXY(155,88);
        $pdf->Cell(25, 7, "Ventas",1,1,'C', true);
        $pdf->setXY(180,88);
        $pdf->Cell(25, 7, "F. App",1,1,'C', true);

    // DATOS
        $pdf->SetTextColor(0,0,0);
        $pdf->SetFont('Arial', '', 10);
        $y=95;
        if($total_row_sucursales>0){
            foreach($row_sucursales as $dato){

                $pdf->setXY(5,$y);
                $pdf->Cell(150, 7, utf8_decode($dato['nombre_sucursal']),1,1,'L', false);
                $pdf->setXY(155,$y);
                $pdf->Cell(25, 7, $dato['sum_ventas'],1,1,'C', false);
                $pdf->setXY(180,$y);
                $pdf->Cell(25, 7, $dato['porcentaje_uso'].'%',1,1,'C', false);

                $y+=7;
            }
        }
        else{
            $pdf->setXY(5,95);
            $pdf->Cell(200, 7, "No se encontraron resultados",1,1,'L', false);
        }

// TABLA DE REPARTIDORES

    $pdf->SetFont('Arial', 'B', 10);
    // ENCABEZADO
        $pdf->SetFillColor(10,54,157);
        $pdf->SetTextColor(255,255,255);
        $pdf->setXY(5,140);
        $pdf->Cell(140, 7, "Top 5 mejores repartidores",1,1,'L', true);
        $pdf->setXY(145,140);
        $pdf->Cell(35, 7, "OC",1,1,'C', true);
        $pdf->setXY(180,140);
        $pdf->Cell(25, 7, "F. App",1,1,'C', true);

    // DATOS
        $pdf->SetTextColor(0,0,0);
        $pdf->SetFont('Arial', '', 10);
        $y=147;
        if($total_row_repartidores>0){
            foreach($row_repartidores as $dato){

                $pdf->setXY(5,$y);
                $pdf->Cell(140, 7, utf8_decode($dato['nombre_repartidor'].' '.$dato['apellido_repartidor']),1,1,'L', false);
                $pdf->setXY(145,$y);
                $pdf->Cell(35, 7, $dato['total_ordenes_repartidor'],1,1,'C', false);
                $pdf->setXY(180,$y);
                $pdf->Cell(25, 7, $dato['porcentaje_uso'].'%',1,1,'C', false);

                $y+=7;
            }
        }

// TABLA DE METODOS DE PAGO

    $pdf->SetFont('Arial', 'B', 10);
    // ENCABEZADO
        $pdf->SetTextColor(255,255,255);
        $pdf->setXY(5,190);
        $pdf->Cell(140, 7, utf8_decode("Uso de métodos de pago"),1,1,'L', true);
        $pdf->setXY(145,190);
        $pdf->Cell(60, 7, "Usos",1,1,'C', true);

    // DATOS
        $pdf->SetTextColor(0,0,0);
        $pdf->SetFont('Arial', '', 10);
        $y=197;
        if($total_row_metodos_pago>0){
            foreach($row_metodos_pago as $dato){

                $pdf->setXY(5,$y);
                $pdf->Cell(140, 7, utf8_decode($dato['nombre_metodo_pago']),1,1,'L', false);
                $pdf->setXY(145,$y);
                $pdf->Cell(35, 7, $dato['num_usos'],1,1,'C', false);
                $pdf->setXY(180,$y);
                $pdf->Cell(25, 7, $dato['porcentaje_uso'].'%',1,1,'C', false);

                $y+=7;
            }
        }

// MEJOR COMPRADOR

    $pdf->SetTextColor(255,255,255);
    $pdf->SetFillColor(10,54,157);
    $pdf->SetFont('Arial', 'B', 10);
    $pdf->setXY(5,250);
    $pdf->Cell(130, 7, "Mejor comprador",1,1,'L', true);
    $pdf->setXY(135,250);
    $pdf->Cell(40, 7, "OC.",1,1,'C', true);
    $pdf->setXY(175,250);
    $pdf->Cell(30, 7, "F. App",1,1,'C', true);

    $pdf->SetFont('Arial', '', 10);
    $pdf->SetTextColor(0,0,0);
    $pdf->setXY(5,257);
    $pdf->Cell(130, 7, utf8_decode($row_cliente[0]['nombre_cliente'].' '.$row_cliente[0]['apellido_cliente']),1,1,'L', false);
    $pdf->setXY(135,257);
    $pdf->Cell(40, 7, $row_cliente[0]['total_ordenes_cliente'],1,1,'C', false);
    $pdf->setXY(175,257);
    $pdf->Cell(30, 7, $row_cliente[0]['porcentaje_uso'].'%',1,1,'C', false);

$pdf->Output("Resumen de sum_ventas.pdf", "I");