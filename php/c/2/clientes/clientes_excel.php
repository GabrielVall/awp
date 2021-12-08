<?php 
session_start();
include_once("../../../m/SQLConexion.php");
include_once('../../../../librerias/phpexcel/Classes/PHPExcel.php');
include_once('../../../../librerias/phpexcel/Classes/PHPExcel/Writer/Excel2007.php');

$objPHPExcel = new PHPExcel();
$objDrawing = new PHPExcel_Worksheet_MemoryDrawing();
$sql = new SQLConexion();

$row_clientes = $sql->obtenerResultado("CALL sp_select_clientes1();");
$total_row_clientes = count($row_clientes);

	// Establecer propiedades
	$objPHPExcel->getProperties()
	->setCreator("BorderBytes.MX")
	->setLastModifiedBy("BorderBytes.MX")
	->setTitle("Clientes")
	->setSubject("Clientes")
	->setDescription("Clientes")
	->setKeywords("Excel Office 2007 openxml php")
	->setCategory("Reportes");

	// TITULO
		$objPHPExcel->setActiveSheetIndex(0)->mergeCells("A1:B1");
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('A1', 'Clientes')->getStyle('A1')->applyFromArray(fontsize(10,true));
		
	// THEAD DE TABLA
		$objPHPExcel->setActiveSheetIndex(0)->mergeCells("A3:D3");
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('A3', 'Cliente')->getStyle('A3')->applyFromArray(fontsize(10,true));
		$objPHPExcel->setActiveSheetIndex(0)->getStyle('A3')->applyFromArray(colorText("FFFFFF"));
		bordeado("A3:B3");
		cellColor("A3",'0A369D');
		
		$objPHPExcel->setActiveSheetIndex(0)->mergeCells("E3:F3");
		$objPHPExcel->setActiveSheetIndex(0)->getStyle('E3:F3')->applyFromArray(texto_centrado());
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('E3', 'Teléfono')->getStyle('E3')->applyFromArray(fontsize(10,true));
		$objPHPExcel->setActiveSheetIndex(0)->getStyle('E3')->applyFromArray(colorText("FFFFFF"));
		bordeado("E3:F3");
		cellColor("E3",'0A369D');
		
		$objPHPExcel->setActiveSheetIndex(0)->mergeCells("G3:J3");
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('G3', 'Correo')->getStyle('G3')->applyFromArray(fontsize(10,true));
		$objPHPExcel->setActiveSheetIndex(0)->getStyle('G3')->applyFromArray(colorText("FFFFFF"));
		bordeado("G3:J3");
		cellColor("G3:J3",'0A369D');
		
		$objPHPExcel->setActiveSheetIndex(0)->mergeCells("K3:L3");
		$objPHPExcel->setActiveSheetIndex(0)->getStyle('K3:L3')->applyFromArray(texto_centrado());
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('K3', 'Ciudad')->getStyle('K3')->applyFromArray(fontsize(10,true));
		$objPHPExcel->setActiveSheetIndex(0)->getStyle('K3')->applyFromArray(colorText("FFFFFF"));
		bordeado("K3:L3");
		cellColor("K3:L3",'0A369D');
		
		$objPHPExcel->setActiveSheetIndex(0)->mergeCells("M3:N3");
		$objPHPExcel->setActiveSheetIndex(0)->getStyle('M3:N3')->applyFromArray(texto_centrado());
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('M3', 'Estado')->getStyle('M3')->applyFromArray(fontsize(10,true));
		$objPHPExcel->setActiveSheetIndex(0)->getStyle('M3')->applyFromArray(colorText("FFFFFF"));
		bordeado("M3:N3");
		cellColor("M3:N3",'0A369D');
		
		$objPHPExcel->setActiveSheetIndex(0)->mergeCells("O3:P3");
		$objPHPExcel->setActiveSheetIndex(0)->getStyle('O3:P3')->applyFromArray(texto_centrado());
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('O3', 'País')->getStyle('O3')->applyFromArray(fontsize(10,true));
		$objPHPExcel->setActiveSheetIndex(0)->getStyle('O3')->applyFromArray(colorText("FFFFFF"));
		bordeado("O3:P3");
		cellColor("O3:P3",'0A369D');

	// TBODY DE TABLA
		$row=4;
		$subtotal=0;
		if($total_row_clientes>0){
			foreach($row_clientes as $dato){
				
				$objPHPExcel->setActiveSheetIndex(0)->mergeCells("A".$row.":D".$row);
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue('A'.$row, $dato['nombre_cliente'].' '.$dato['apellido_cliente'])->getStyle('A'.$row)->applyFromArray(fontsize(8,false));
				bordeado("A".$row.":D".$row);
				
				$objPHPExcel->setActiveSheetIndex(0)->mergeCells("E".$row.":F".$row);
				$objPHPExcel->setActiveSheetIndex(0)->getStyle('E'.$row.':F'.$row)->applyFromArray(texto_centrado());
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue('E'.$row, $dato['telefono_cliente'])->getStyle('E'.$row)->applyFromArray(fontsize(8,false));
				bordeado("E".$row.":F".$row);
				
				$objPHPExcel->setActiveSheetIndex(0)->mergeCells("G".$row.":J".$row);
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue('G'.$row, $dato['correo_cliente'])->getStyle('G'.$row)->applyFromArray(fontsize(8,false));
				bordeado("G".$row.":J".$row);
				
				$objPHPExcel->setActiveSheetIndex(0)->mergeCells("K".$row.":L".$row);
				$objPHPExcel->setActiveSheetIndex(0)->getStyle('K'.$row.':L'.$row)->applyFromArray(texto_centrado());
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue('K'.$row, $dato['nombre_ciudad'])->getStyle('K'.$row)->applyFromArray(fontsize(8,false));
				bordeado("K".$row.":L".$row);
				
				$objPHPExcel->setActiveSheetIndex(0)->mergeCells("M".$row.":N".$row);
				$objPHPExcel->setActiveSheetIndex(0)->getStyle('M'.$row.':N'.$row)->applyFromArray(texto_centrado());
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue('M'.$row, $dato['nombre_estado'])->getStyle('M'.$row)->applyFromArray(fontsize(8,false));
				bordeado("M".$row.":N".$row);
				
				$objPHPExcel->setActiveSheetIndex(0)->mergeCells("O".$row.":P".$row);
				$objPHPExcel->setActiveSheetIndex(0)->getStyle('O'.$row.':P'.$row)->applyFromArray(texto_centrado());
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue('O'.$row, $dato['nombre_pais'])->getStyle('O'.$row)->applyFromArray(fontsize(8,false));
				bordeado("O".$row.":P".$row);

				$row++;
			}
		}

	// Renombrar Hoja
	$objPHPExcel->getActiveSheet()->setTitle('Clientes');

	// Establecer la hoja activa, para que cuando se abra el documento se muestre primero.
	$objPHPExcel->setActiveSheetIndex(0);

	// Se modifican los encabezados del HTTP para indicar que se envia un archivo de Excel.
	header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
	header('Content-Disposition: attachment;filename="Reporte/Detalles_orden.xlsx"');
	header('Cache-Control: max-age=0');
	$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
// 	$objWriter->save('php://output');
    $objWriter->save('../../../../documentos/reportes/clientes.xlsx');
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
			// $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A4', '')->getStyle('A4')->applyFromArray(texto_centrado());
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