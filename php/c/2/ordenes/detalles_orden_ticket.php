<?php
session_start();
include_once('../../../../librerias/fpdf/mc_table.php');
include_once("../../../m/SQLConexion.php");
$sql = new SQLConexion();

$row_orden = $sql->obtenerResultado("CALL sp_select_ordenes2('" . $_GET['id_orden'] . "');");

$simbolo = $sql->obtenerResultado("SELECT simbolo_tipo_cambio FROM empresa_reparto INNER JOIN tipos_cambios USING(id_tipo_cambio) WHERE id_empresa_reparto=1");

$row_ordenes_productos = $sql->obtenerResultado("CALL sp_select_ordenes_productos1('" . $_GET['id_orden'] . "');");
$total_ordenes_productos = count($row_ordenes_productos);

$pdf = new PDF_MC_Table('P','mm',array(85,600));
$pdf->AddPage();

$pdf->SetFont('Arial', 'B', 10);
$pdf->SetFillColor(10,54,157);

$pdf->setXY(5,5);
$pdf->Cell(75, 5, utf8_decode($row_orden[0]['nombre_sucursal']),0,0,'C', false);
$pdf->SetFont('Arial', '', 8);

$pdf->setXY(5,10);
$pdf->MultiCell(75, 5, utf8_decode($row_orden[0]['direccion_sucursal']),0,'C', false);

$pdf->setXY(5,13);
$pdf->Cell(75, 5, 'Tel: '.$row_orden[0]['telefono_sucursal'],0,0,'C', false);

$pdf->setXY(5,16);
$pdf->Cell(75, 5, 'Tel. WP: '.$row_orden[0]['telefono_whatsapp_sucursal'],0,0,'C', false);

$pdf->setXY(5,30);
$pdf->Cell(75, 5, 'Comprador: '.utf8_decode($row_orden[0]['nombre_cliente'].' '.$row_orden[0]['apellido_cliente']),0,0,'L', false);

$pdf->setXY(5,34);
$pdf->Cell(75, 5, 'Tipo de orden: '.$row_orden[0]['nombre_tipo_orden'],0,0,'L', false);

$pdf->setXY(5,38);
$pdf->Cell(75, 5, 'Pagado por: '.utf8_decode($row_orden[0]['nombre_metodo_pago']),0,0,'L', false);

$pdf->setXY(5,42);
$pdf->Cell(75, 5, 'Estado: '.$row_orden[0]['nombre_estado_orden'],0,0,'L', false);

if($row_orden[0]['id_tipo_orden']==1){
    
    $pdf->SetFont('Arial', 'B', 8);
    $pdf->setXY(5,46);
    $pdf->Cell(75, 7, utf8_decode("Dirección de entrega:"),0,1,'L', false);

    $pdf->SetFont('Arial', '', 8);
    $pdf->setXY(5,52);
    $pdf->MultiCell(75, 3, utf8_decode($row_orden[0]['direccion_orden']),0,'L', false);
}

$pdf->setXY(5,66);
$pdf->Cell(37, 5, 'Orden #: '.$_GET['id_orden'],0,0,'L', false);

$pdf->setXY(42,66);
$pdf->Cell(38, 5, 'Fecha: '.$row_orden[0]['fecha_registro_orden'].'hrs.',0,0,'R', false);


$pdf->SetFont('Arial', 'B', 8);
$pdf->setXY(5,72);
$pdf->Cell(50, 5, "Productos",1,1,'L', false);
$pdf->setXY(55,72);
$pdf->Cell(25, 5, "Subtotal",1,1,'R', false);

$pdf->SetFont('Arial', '', 6);
$subtotal=0;
if($total_ordenes_productos>0){
    foreach($row_ordenes_productos as $dato){
        
        $pdf->setX(5);
        $pdf->SetWidths(array(50,25));
        $pdf->Row(
            array(
                utf8_decode($dato['nombre_producto']),
                $simbolo[0]['simbolo_tipo_cambio'].$dato['importe_orden_producto']
            ),
            4,
            array('L','R'),
            false
        );
        $subtotal+=$dato['importe_orden_producto'];

        $row_ordenes_ingredientes = $sql->obtenerResultado("CALL sp_select_ordenes_ingredientes1('" . $dato['id_orden_producto'] . "');");
        $total_ordenes_ingredientes = count($row_ordenes_ingredientes);

        if($total_ordenes_ingredientes>0){
            $pdf->SetFont('Arial', 'B', 8);
            
            $pdf->setX(10);
            $pdf->SetWidths(array(45,25));
            $pdf->Row(
                array(
                    'Ingredientes',
                    'Subtotal',
                ),
                4,
                array('L','R'),
                false
            );
            $pdf->SetFont('Arial', '', 6);
            foreach ($row_ordenes_ingredientes as $dato_ing){
                $pdf->setX(10);
                $pdf->SetWidths(array(45,25));
                $pdf->Row(
                    array(
                        $dato_ing['nombre_ingrediente_extra'],
                        $dato_ing['simbolo_tipo_cambio'].$dato_ing['importe_orden_ingrediente'],
                    ),
                    4,
                    array('L','R'),
                    false
                );

                $subtotal+=$dato_ing['importe_orden_ingrediente'];
            }
            
        }
    }
}
else{
    $pdf->setXY(5,45);
    $pdf->Cell(75, 5, "No se encontraron resultados",1,1,'L', false);
}

$coor_y=$pdf->GetY()+5;
        
$pdf->SetFont('Arial', '', 8);
$pdf->setXY(5,$coor_y+=4);
$pdf->Cell(75, 5, 'Subtotal: '.$simbolo[0]['simbolo_tipo_cambio'].number_format($subtotal,2,'.',','),0,0,'R', false);
$pdf->setXY(5,$coor_y+=4);
$pdf->Cell(75, 5, 'Descuento: -'.$simbolo[0]['simbolo_tipo_cambio'].$row_orden[0]['descuento_cupon'],0,0,'R', false);
$pdf->setXY(5,$coor_y+=4);
$pdf->Cell(75, 5, utf8_decode('Costo de envío: ').$simbolo[0]['simbolo_tipo_cambio'].$row_orden[0]['costo_envio_orden'],0,0,'R', false);
$pdf->setXY(5,$coor_y+=4);
$pdf->Cell(75, 5, 'Servicio de app: '.$simbolo[0]['simbolo_tipo_cambio'].$row_orden[0]['servicio_app'],0,0,'R', false);
$pdf->setXY(5,$coor_y+=4);
$pdf->Cell(75, 5, 'Total a pagar: '.$simbolo[0]['simbolo_tipo_cambio'].number_format((str_replace(",", "", $row_orden[0]['servicio_app']) + str_replace(",", "", $row_orden[0]['costo_total_orden']) + str_replace(",", "", $row_orden[0]['costo_envio_orden'])),2,'.',','),0,0,'R', false);

$pdf->SetFont('Arial', 'B', 10);
$pdf->setXY(5,$coor_y+=10);
$pdf->Cell(75, 5, 'Gracias por tu compra',0,0,'C', false);


$pdf->Output("Detalles_orden_ticket.pdf", "I");