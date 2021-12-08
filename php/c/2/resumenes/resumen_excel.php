<?php 
session_start();
include_once("../../../m/SQLConexion.php");
include_once('../../../../librerias/phpexcel/Classes/PHPExcel.php');
include_once('../../../../librerias/phpexcel/Classes/PHPExcel/Writer/Excel2007.php');

$objPHPExcel = new PHPExcel();
$objDrawing = new PHPExcel_Worksheet_MemoryDrawing();
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

	// Establecer propiedades
	$objPHPExcel->getProperties()
	->setCreator("BorderBytes.MX")
	->setLastModifiedBy("BorderBytes.MX")
	->setTitle("Detalles de orden")
	->setSubject("Detalles de orden")
	->setDescription("Detalles de orden")
	->setKeywords("Excel Office 2007 openxml php")
	->setCategory("Reportes");

	// TITULO
		$objPHPExcel->setActiveSheetIndex(0)->mergeCells("A1:C1");
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('A1', 'Resumen de ventas: '.$_GET['fecha'])->getStyle('A1')->applyFromArray(fontsize(10,true));

	// INFO ENCABEZADO DETALLE ORDEN
		$objPHPExcel->setActiveSheetIndex(0)->mergeCells("A3:C3");
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('A3', 'Ordenes ordinarias:')->getStyle('A3')->applyFromArray(fontsize(10,true));
		$objPHPExcel->setActiveSheetIndex(0)->getStyle('A3')->applyFromArray(colorText("FFFFFF"));
		bordeado("A3:C3");
		cellColor("A3",'0A369D');

		$objPHPExcel->setActiveSheetIndex(0)->mergeCells("A4:C4");
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('A4', 'Ordenes express:')->getStyle('A4')->applyFromArray(fontsize(10,true));
		$objPHPExcel->setActiveSheetIndex(0)->getStyle('A4')->applyFromArray(colorText("FFFFFF"));
		bordeado("A4:C4");
		cellColor("A4",'0A369D');

		$objPHPExcel->setActiveSheetIndex(0)->mergeCells("A5:C5");
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('A5', 'Ordenes punto a punto:')->getStyle('A5')->applyFromArray(fontsize(10,true));
		$objPHPExcel->setActiveSheetIndex(0)->getStyle('A5')->applyFromArray(colorText("FFFFFF"));
		bordeado("A5:C5");
		cellColor("A5",'0A369D');
		
		$objPHPExcel->setActiveSheetIndex(0)->mergeCells("G3:I3");
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('G3', 'Día con más demanta')->getStyle('G3')->applyFromArray(fontsize(10,true));
		$objPHPExcel->setActiveSheetIndex(0)->getStyle('G3')->applyFromArray(colorText("FFFFFF"));
		bordeado("G3:I3");
		cellColor("G3",'0A369D');

		$objPHPExcel->setActiveSheetIndex(0)->mergeCells("G4:I4");
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('G4', 'Día con más demanta')->getStyle('G4')->applyFromArray(fontsize(10,true));
		$objPHPExcel->setActiveSheetIndex(0)->getStyle('G4')->applyFromArray(colorText("FFFFFF"));
		bordeado("G4:I4");
		cellColor("G4",'0A369D');

		$objPHPExcel->setActiveSheetIndex(0)->mergeCells("G5:I5");
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('G5', 'Día con más demanta')->getStyle('G5')->applyFromArray(fontsize(10,true));
		$objPHPExcel->setActiveSheetIndex(0)->getStyle('G5')->applyFromArray(colorText("FFFFFF"));
		bordeado("G5:I5");
		cellColor("G5",'0A369D');
		
		$objPHPExcel->setActiveSheetIndex(0)->mergeCells("D3:E3");
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('D3',$row_totales_ordenes[0]['total'])->getStyle('D3')->applyFromArray(fontsize(10,false));
		bordeado("D3:E3");

		$objPHPExcel->setActiveSheetIndex(0)->mergeCells("D4:E4");
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('D4', $row_totales_ordenes[1]['total'])->getStyle('D4')->applyFromArray(fontsize(10,false));
		bordeado("D4:E4");

		$objPHPExcel->setActiveSheetIndex(0)->mergeCells("D5:E5");
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('D5', $row_totales_ordenes[2]['total'])->getStyle('D5')->applyFromArray(fontsize(10,false));
		bordeado("D5:E5");
		
		$objPHPExcel->setActiveSheetIndex(0)->mergeCells("J3:K3");
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('J3',$row_dia_frecuente[0]['dia_frecuente'])->getStyle('J3')->applyFromArray(fontsize(10,false));
		bordeado("J3:K3");

		$objPHPExcel->setActiveSheetIndex(0)->mergeCells("J4:K4");
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('J4', $row_dia_frecuente[1]['dia_frecuente'])->getStyle('J4')->applyFromArray(fontsize(10,false));
		bordeado("J4:K4");

		$objPHPExcel->setActiveSheetIndex(0)->mergeCells("J5:K5");
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('J5', $row_dia_frecuente[2]['dia_frecuente'])->getStyle('J5')->applyFromArray(fontsize(10,false));
		bordeado("J5:K5");
		

	// THEAD DE TABLA SUCURSALES
		$objPHPExcel->setActiveSheetIndex(0)->mergeCells("A8:G8");
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('A8', 'Top 5 mejores sucursales')->getStyle('A8')->applyFromArray(fontsize(10,true));
		$objPHPExcel->setActiveSheetIndex(0)->getStyle('A8')->applyFromArray(colorText("FFFFFF"));
		bordeado("A8:G8");
		cellColor("A8",'0A369D');
		
		$objPHPExcel->setActiveSheetIndex(0)->mergeCells("H8:I8");
		$objPHPExcel->setActiveSheetIndex(0)->getStyle('H8:I8')->applyFromArray(texto_centrado());
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('H8', 'Ventas')->getStyle('H8')->applyFromArray(fontsize(10,true));
		$objPHPExcel->setActiveSheetIndex(0)->getStyle('H8')->applyFromArray(colorText("FFFFFF"));
		bordeado("H8:I8");
		cellColor("H8",'0A369D');
		
		$objPHPExcel->setActiveSheetIndex(0)->mergeCells("J8:K8");
		$objPHPExcel->setActiveSheetIndex(0)->getStyle('J8:K8')->applyFromArray(texto_centrado());
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('J8', 'F. App')->getStyle('J8')->applyFromArray(fontsize(10,true));
		$objPHPExcel->setActiveSheetIndex(0)->getStyle('J8')->applyFromArray(colorText("FFFFFF"));
		bordeado("J8:K8");
		cellColor("J8",'0A369D');
		
	// TBODY DE TABLA SUCURSALES
		$row=9;
		$subtotal=0;
		if($total_row_sucursales>0){
			foreach($row_sucursales as $dato){
				
				$objPHPExcel->setActiveSheetIndex(0)->mergeCells("A".$row.":G".$row);
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue('A'.$row, $dato['nombre_sucursal'])->getStyle('A'.$row)->applyFromArray(fontsize(8,false));
				bordeado("A".$row.":G".$row);
				
				$objPHPExcel->setActiveSheetIndex(0)->getStyle('H'.$row.':I'.$row)->applyFromArray(texto_centrado());
				$objPHPExcel->setActiveSheetIndex(0)->mergeCells("H".$row.":I".$row);
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue('H'.$row, $dato['sum_ventas'])->getStyle('H'.$row)->applyFromArray(fontsize(8,false));
				bordeado("H".$row.":I".$row);
				
				$objPHPExcel->setActiveSheetIndex(0)->getStyle('J'.$row.':K'.$row)->applyFromArray(texto_centrado());
				$objPHPExcel->setActiveSheetIndex(0)->mergeCells("J".$row.":K".$row);
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue('J'.$row, $dato['porcentaje_uso'].'%')->getStyle('J'.$row)->applyFromArray(fontsize(8,false));
				bordeado("J".$row.":K".$row);
				
				$row++;
			}
		}
	// THEAD DE TABLA REPARTIDORES
		$objPHPExcel->setActiveSheetIndex(0)->mergeCells("A15:G15");
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('A15', 'Top 5 mejores repartidores')->getStyle('A15')->applyFromArray(fontsize(10,true));
		$objPHPExcel->setActiveSheetIndex(0)->getStyle('A15')->applyFromArray(colorText("FFFFFF"));
		bordeado("A15:G15");
		cellColor("A15",'0A369D');
		
		$objPHPExcel->setActiveSheetIndex(0)->mergeCells("H15:I15");
		$objPHPExcel->setActiveSheetIndex(0)->getStyle('H15:I15')->applyFromArray(texto_centrado());
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('H15', 'Orden C.')->getStyle('H15')->applyFromArray(fontsize(10,true));
		$objPHPExcel->setActiveSheetIndex(0)->getStyle('H15')->applyFromArray(colorText("FFFFFF"));
		bordeado("H15:I15");
		cellColor("H15",'0A369D');
		
		$objPHPExcel->setActiveSheetIndex(0)->mergeCells("J15:K15");
		$objPHPExcel->setActiveSheetIndex(0)->getStyle('J15:K15')->applyFromArray(texto_centrado());
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('J15', 'F. App')->getStyle('J15')->applyFromArray(fontsize(10,true));
		$objPHPExcel->setActiveSheetIndex(0)->getStyle('J15')->applyFromArray(colorText("FFFFFF"));
		bordeado("J15:K15");
		cellColor("J15",'0A369D');
		
	// TBODY DE TABLA REPARTIDORES
		$row=16;
		$subtotal=0;
		if($total_row_repartidores>0){
			foreach($row_repartidores as $dato){
				
				$objPHPExcel->setActiveSheetIndex(0)->mergeCells("A".$row.":G".$row);
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue('A'.$row, $dato['nombre_repartidor'].' '.$dato['apellido_repartidor'])->getStyle('A'.$row)->applyFromArray(fontsize(8,false));
				bordeado("A".$row.":G".$row);
				
				$objPHPExcel->setActiveSheetIndex(0)->getStyle('H'.$row.':I'.$row)->applyFromArray(texto_centrado());
				$objPHPExcel->setActiveSheetIndex(0)->mergeCells("H".$row.":I".$row);
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue('H'.$row, $dato['total_ordenes_repartidor'])->getStyle('H'.$row)->applyFromArray(fontsize(8,false));
				bordeado("H".$row.":I".$row);
				
				$objPHPExcel->setActiveSheetIndex(0)->getStyle('J'.$row.':K'.$row)->applyFromArray(texto_centrado());
				$objPHPExcel->setActiveSheetIndex(0)->mergeCells("J".$row.":K".$row);
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue('J'.$row, $dato['porcentaje_uso'].'%')->getStyle('J'.$row)->applyFromArray(fontsize(8,false));
				bordeado("J".$row.":K".$row);
				
				$row++;
			}
		}
	// THEAD DE TABLA MÉTODOS DE PAGO
		$objPHPExcel->setActiveSheetIndex(0)->mergeCells("A22:G22");
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('A22', 'Uso de métodos de pago')->getStyle('A22')->applyFromArray(fontsize(10,true));
		$objPHPExcel->setActiveSheetIndex(0)->getStyle('A22')->applyFromArray(colorText("FFFFFF"));
		bordeado("A22:G22");
		cellColor("A22",'0A369D');
		
		$objPHPExcel->setActiveSheetIndex(0)->mergeCells("H22:K22");
		$objPHPExcel->setActiveSheetIndex(0)->getStyle('H22:K22')->applyFromArray(texto_centrado());
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('H22', 'Usos')->getStyle('H22')->applyFromArray(fontsize(10,true));
		$objPHPExcel->setActiveSheetIndex(0)->getStyle('H22')->applyFromArray(colorText("FFFFFF"));
		bordeado("H22:K22");
		cellColor("H22",'0A369D');
		
	// TBODY DE TABLA MÉTODOS DE PAGO
		$row=23;
		$subtotal=0;
		if($total_row_metodos_pago>0){
			foreach($row_metodos_pago as $dato){
				
				$objPHPExcel->setActiveSheetIndex(0)->mergeCells("A".$row.":G".$row);
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue('A'.$row, $dato['nombre_metodo_pago'])->getStyle('A'.$row)->applyFromArray(fontsize(8,false));
				bordeado("A".$row.":G".$row);
				
				$objPHPExcel->setActiveSheetIndex(0)->getStyle('H'.$row.':I'.$row)->applyFromArray(texto_centrado());
				$objPHPExcel->setActiveSheetIndex(0)->mergeCells("H".$row.":I".$row);
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue('H'.$row, $dato['num_usos'])->getStyle('H'.$row)->applyFromArray(fontsize(8,false));
				bordeado("H".$row.":I".$row);
				
				$objPHPExcel->setActiveSheetIndex(0)->getStyle('J'.$row.':K'.$row)->applyFromArray(texto_centrado());
				$objPHPExcel->setActiveSheetIndex(0)->mergeCells("J".$row.":K".$row);
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue('J'.$row, $dato['porcentaje_uso'].'%')->getStyle('J'.$row)->applyFromArray(fontsize(8,false));
				bordeado("J".$row.":K".$row);
				
				$row++;
			}
		}
	// THEAD DE TABLA MEJOR COMPRADOR
		$objPHPExcel->setActiveSheetIndex(0)->mergeCells("A30:G30");
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('A30', 'Mejor comprador')->getStyle('A30')->applyFromArray(fontsize(10,true));
		$objPHPExcel->setActiveSheetIndex(0)->getStyle('A30')->applyFromArray(colorText("FFFFFF"));
		bordeado("A30:G30");
		cellColor("A30",'0A369D');
		
		$objPHPExcel->setActiveSheetIndex(0)->mergeCells("H30:I30");
		$objPHPExcel->setActiveSheetIndex(0)->getStyle('H30:I30')->applyFromArray(texto_centrado());
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('H30', 'Orden C.')->getStyle('H30')->applyFromArray(fontsize(10,true));
		$objPHPExcel->setActiveSheetIndex(0)->getStyle('H30')->applyFromArray(colorText("FFFFFF"));
		bordeado("H30:I30");
		cellColor("H30",'0A369D');
		
		$objPHPExcel->setActiveSheetIndex(0)->mergeCells("J30:K30");
		$objPHPExcel->setActiveSheetIndex(0)->getStyle('J30:K30')->applyFromArray(texto_centrado());
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('J30', 'F. App')->getStyle('J30')->applyFromArray(fontsize(10,true));
		$objPHPExcel->setActiveSheetIndex(0)->getStyle('J30')->applyFromArray(colorText("FFFFFF"));
		bordeado("J30:K30");
		cellColor("J30",'0A369D');
		
	// TBODY DE TABLA MEJOR COMPRADOR
				
		$objPHPExcel->setActiveSheetIndex(0)->mergeCells("A31:G31");
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('A31',$row_cliente[0]['nombre_cliente'].' '.$row_cliente[0]['apellido_cliente'])->getStyle('A31')->applyFromArray(fontsize(8,false));
		bordeado("A31:G31");
		
		$objPHPExcel->setActiveSheetIndex(0)->getStyle('H31:I31')->applyFromArray(texto_centrado());
		$objPHPExcel->setActiveSheetIndex(0)->mergeCells("H31:I31");
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('H31', $row_cliente[0]['total_ordenes_cliente'])->getStyle('H31')->applyFromArray(fontsize(8,false));
		bordeado("H31:I31");
		
		$objPHPExcel->setActiveSheetIndex(0)->getStyle('J31:K31')->applyFromArray(texto_centrado());
		$objPHPExcel->setActiveSheetIndex(0)->mergeCells("J31:K31");
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('J31', $row_cliente[0]['porcentaje_uso'].'%')->getStyle('J31')->applyFromArray(fontsize(8,false));
		bordeado("J31:K31");
				
	// Renombrar Hoja
	$objPHPExcel->getActiveSheet()->setTitle('Detalles de orden');

	// Establecer la hoja activa, para que cuando se abra el documento se muestre primero.
	$objPHPExcel->setActiveSheetIndex(0);

	// Se modifican los encabezados del HTTP para indicar que se envia un archivo de Excel.
	header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
	header('Content-Disposition: attachment;filename="Reporte/Detalles_orden.xlsx"');
	header('Cache-Control: max-age=0');
	$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
// 	$objWriter->save('php://output');
    $objWriter->save('../../../../documentos/reportes/resumen_ventas.xlsx');
	exit;
// FUNCIONES

	// IMAGENES
		function setimage($url_image, $position){
			global $objPHPExcel;
			global $objDrawing;
			$gdImage = @imagecreatefromjpeg($url_image);

			if(!$gdImage){
				$gdImage = imagecreatefrompng($url_image);
			}
			$objDrawing->setName('Sample image');
			$objDrawing->setDescription('Sample image');
			$objDrawing->setImageResource($gdImage);
			$objDrawing->setRenderingFunction(PHPExcel_Worksheet_MemoryDrawing::RENDERING_JPEG);
			$objDrawing->setMimeType(PHPExcel_Worksheet_MemoryDrawing::MIMETYPE_DEFAULT);
			$objDrawing->setHeight(150);
			$objDrawing->setCoordinates($position);
			$objDrawing->setWorksheet($objPHPExcel->getActiveSheet());
		}

	// TAMAÑO DE FUENTE
		function fontsize($size,$bold){
			return array(
					'font'  => array(
						'bold'  => $bold,
						'size'  => $size,
					));
		}

	// COLORES
		// COLOR DE CELDA
			function cellColor($cells,$color){
				global $objPHPExcel;

				$objPHPExcel->getActiveSheet()->getStyle($cells)->getFill()->applyFromArray(array(
					'type' => PHPExcel_Style_Fill::FILL_SOLID,
					'startcolor' => array(
						'rgb' => $color
					)
				));
			}
		// COLOR DE TEXTO
			function colorText($color){
				return array(
					'font'  => array(
						'color' => array('rgb' => $color),
					));
			}
	// BORDER
		function bordeado($celda){
			global $objPHPExcel;
				$border_style= array('borders' => array('left' => array('style' => 
				PHPExcel_Style_Border::BORDER_THIN,'color' => array('argb' => '000000'),)));
				$border_style2= array('borders' => array('right' => array('style' => 
				PHPExcel_Style_Border::BORDER_THIN,'color' => array('argb' => '000000'),)));
				$border_style3= array('borders' => array('top' => array('style' => 
				PHPExcel_Style_Border::BORDER_THIN,'color' => array('argb' => '000000'),)));
				$border_style4= array('borders' => array('bottom' => array('style' => 
				PHPExcel_Style_Border::BORDER_THIN,'color' => array('argb' => '000000'),)));
				$objPHPExcel->getActiveSheet()->getStyle($celda)->applyFromArray($border_style);
				$objPHPExcel->getActiveSheet()->getStyle($celda)->applyFromArray($border_style2);
				$objPHPExcel->getActiveSheet()->getStyle($celda)->applyFromArray($border_style3);
				$objPHPExcel->getActiveSheet()->getStyle($celda)->applyFromArray($border_style4);
		}
	// ALINEACIÓN DE TEXTO
		function texto_centrado(){
			return array(
				'alignment' => array(
					'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
				)
			);
		}
		function texto_derecha(){
			return array(
				'alignment' => array(
					'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_RIGHT,
				)
			);
		}
		function texto_izquierda(){
			return array(
				'alignment' => array(
					'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_LEFT,
				)
			);
		}