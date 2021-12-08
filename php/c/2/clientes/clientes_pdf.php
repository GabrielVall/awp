<?php
session_start();
include_once('../../../../librerias/fpdf/mc_table.php');
include_once("../../../m/SQLConexion.php");
$sql = new SQLConexion();

$row_clientes = $sql->obtenerResultado("CALL sp_select_clientes1();");
$total_row_clientes = count($row_clientes);

$pdf = new PDF_MC_Table('P','mm');
$pdf->AddPage();

// ENCABEZADO

    $pdf->Image('../../../../img/0/logo_blanco.png',180,5,20,20);

    $pdf->SetFont('Arial', 'B', 10);
    $pdf->SetFillColor(10,54,157);
    
    $pdf->setXY(5,15);
    $pdf->Cell(100, 5, "Clientes",0,0,'L', false);

    $pdf->Line(5,20,205,20);
    
// TABLA CLIENTES

    $coor_y=30;

    $pdf->SetFont('Arial', 'B', 10);
    // ENCABEZADO
        $pdf->SetFillColor(10,54,157);
        $pdf->SetTextColor(255,255,255);
        $pdf->setXY(5,$coor_y);
        $pdf->Cell(50, 7, "Cliente",1,1,'L', true);
        $pdf->setXY(55,$coor_y);
        $pdf->Cell(25, 7, utf8_decode("Teléfono"),1,1,'C', true);
        $pdf->setXY(80,$coor_y);
        $pdf->Cell(50, 7, "Correo",1,1,'C', true);
        $pdf->setXY(130,$coor_y);
        $pdf->Cell(25, 7, "Ciudad",1,1,'C', true);
        $pdf->setXY(155,$coor_y);
        $pdf->Cell(25, 7, "Estado",1,1,'C', true);
        $pdf->setXY(180,$coor_y);
        $pdf->Cell(25, 7, utf8_decode("País"),1,1,'C', true);

    // DATOS
        $pdf->SetTextColor(0,0,0);
        $pdf->SetFont('Arial', '', 8);
        
        $subtotal=0;
        if($total_row_clientes>0){
            $renglones=0;
            $limite_renglones=59;
            foreach($row_clientes as $dato){
                if($pdf->GetY()>259){
                    $pdf->AddPage();
                }
                $pdf->setX(5);
                $pdf->SetWidths(array(50,25,50,25,25,25));
                $pdf->Row(
                    array(
                        utf8_decode($dato['nombre_cliente'].' '.$dato['apellido_cliente']),
                        $dato['telefono_cliente'],
                        utf8_decode($dato['correo_cliente']),
                        utf8_decode($dato['nombre_ciudad']),
                        utf8_decode($dato['nombre_estado']),
                        utf8_decode($dato['nombre_pais'])
                    ),
                    4,
                    array('L','C','L','L','L','L'),
                    false
                );
            }
        }
        else{
            $pdf->setXY(5,$coor_y+=7);
            $pdf->Cell(200, 7, "No se encontraron resultados",1,1,'L', false);
        }

$pdf->Output("Clientes.pdf", "I");