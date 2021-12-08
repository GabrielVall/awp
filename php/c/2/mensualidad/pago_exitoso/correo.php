<?php
$row_detalles_historial_pago = $sql->obtenerResultado("CALL sp_select_panel_detalles_pago1('" . $_POST['id_historial_pago'] . "');");

$row_mejoras_plus = $sql->obtenerResultado("CALL sp_select_panel_mejoras_plus1('" . $_POST['id_historial_pago'] . "');");
$total_mejoras_plus = count($row_mejoras_plus);

$body_email =
'<!DOCTYPE html>

<html lang="en" xmlns:o="urn:schemas-microsoft-com:office:office" xmlns:v="urn:schemas-microsoft-com:vml">

<head>
	<title></title>
	<meta charset="utf-8" />
	<meta content="width=device-width, initial-scale=1.0" name="viewport" />
	<style>
		* {
			box-sizing: border-box;
		}

		body {
			margin: 0;
			padding: 0;
		}

		a[x-apple-data-detectors] {
			color: inherit !important;
			text-decoration: inherit !important;
		}

		#MessageViewBody a {
			color: inherit;
			text-decoration: none;
		}

		p {
			line-height: inherit
		}

		@media (max-width:820px) {
			.desktop_hide table.icons-inner {
				display: inline-block !important;
			}

			.icons-inner {
				text-align: center;
			}

			.icons-inner td {
				margin: 0 auto;
			}

			.row-content {
				width: 100% !important;
			}

			.mobile_hide {
				display: none;
			}

			.stack .column {
				width: 100%;
				display: block;
			}

			.mobile_hide {
				min-height: 0;
				max-height: 0;
				max-width: 0;
				overflow: hidden;
				font-size: 0px;
			}

			.desktop_hide,
			.desktop_hide table {
				display: table !important;
				max-height: none !important;
			}
		}
	</style>
</head>

<body style="background-color: #FFFFFF; margin: 0; padding: 0; -webkit-text-size-adjust: none; text-size-adjust: none;">
	<table border="0" cellpadding="0" cellspacing="0" class="nl-container" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; background-color: #FFFFFF;" width="100%">
		<tbody>
			<tr>
				<td>
					<table align="center" border="0" cellpadding="0" cellspacing="0" class="row row-1" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt;" width="100%">
						<tbody>
							<tr>
								<td>
									<table align="center" border="0" cellpadding="0" cellspacing="0" class="row-content" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; color: #000000; width: 800px;" width="800">
										<tbody>
											<tr>
												<td class="column" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; font-weight: 400; text-align: left; vertical-align: top; border-top: 0px; border-right: 0px; border-bottom: 0px; border-left: 0px;" width="50%">
													<table border="0" cellpadding="0" cellspacing="0" class="divider_block" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt;" width="100%">
														<tr>
															<td style="padding-bottom:5px;padding-left:5px;padding-right:5px;padding-top:15px;">
																<div align="center">
																	<table border="0" cellpadding="0" cellspacing="0" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt;" width="100%">
																		<tr>
																			<td class="divider_inner" style="font-size: 1px; line-height: 1px; border-top: 0px solid #BBBBBB;"><span> </span></td>
																		</tr>
																	</table>
																</div>
															</td>
														</tr>
													</table>
													<table border="0" cellpadding="0" cellspacing="0" class="image_block" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt;" width="100%">
														<tr>
															<td style="padding-left:15px;padding-right:15px;width:100%;padding-bottom:5px;">
																<div style="line-height:10px"><a href="http://example.com" style="outline:none" tabindex="-1" target="_blank"><img alt="Your Logo" src="images/logo_bb.jpg" style="display: block; height: auto; border: 0; width: 140px; max-width: 100%;" title="Your Logo" width="140" /></a></div>
															</td>
														</tr>
													</table>
												</td>
												<td class="column" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; font-weight: 400; text-align: left; vertical-align: top; border-top: 0px; border-right: 0px; border-bottom: 0px; border-left: 0px;" width="50%">
													<table border="0" cellpadding="0" cellspacing="0" class="empty_block" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt;" width="100%">
														<tr>
															<td style="padding-right:0px;padding-bottom:5px;padding-left:0px;padding-top:5px;">
																<div></div>
															</td>
														</tr>
													</table>
												</td>
											</tr>
										</tbody>
									</table>
								</td>
							</tr>
						</tbody>
					</table>
					<table align="center" border="0" cellpadding="0" cellspacing="0" class="row row-2" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt;" width="100%">
						<tbody>
							<tr>
								<td>
									<table align="center" border="0" cellpadding="0" cellspacing="0" class="row-content stack" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; color: #000000; width: 800px;" width="800">
										<tbody>
											<tr>
												<td class="column" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; font-weight: 400; text-align: left; vertical-align: top; padding-left: 10px; padding-right: 10px; padding-top: 10px; padding-bottom: 10px; border-top: 0px; border-right: 0px; border-bottom: 0px; border-left: 0px;" width="100%">
													<table border="0" cellpadding="10" cellspacing="0" class="divider_block" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt;" width="100%">
														<tr>
															<td>
																<div align="center">
																	<table border="0" cellpadding="0" cellspacing="0" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt;" width="100%">
																		<tr>
																			<td class="divider_inner" style="font-size: 1px; line-height: 1px; border-top: 0px solid #BBBBBB;"><span> </span></td>
																		</tr>
																	</table>
																</div>
															</td>
														</tr>
													</table>
												</td>
											</tr>
										</tbody>
									</table>
								</td>
							</tr>
						</tbody>
					</table>
					<table align="center" border="0" cellpadding="0" cellspacing="0" class="row row-3" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt;" width="100%">
						<tbody>
							<tr>
								<td>
									<table align="center" border="0" cellpadding="0" cellspacing="0" class="row-content stack" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; color: #000000; width: 800px;" width="800">
										<tbody>
											<tr>
												<td class="column" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; font-weight: 400; text-align: left; vertical-align: top; border-top: 0px; border-right: 0px; border-bottom: 0px; border-left: 0px;" width="50%">
													<table border="0" cellpadding="0" cellspacing="0" class="divider_block" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt;" width="100%">
														<tr>
															<td style="padding-bottom:20px;padding-left:20px;padding-right:20px;padding-top:25px;">
																<div align="center">
																	<table border="0" cellpadding="0" cellspacing="0" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt;" width="100%">
																		<tr>
																			<td class="divider_inner" style="font-size: 1px; line-height: 1px; border-top: 0px solid #BBBBBB;"><span> </span></td>
																		</tr>
																	</table>
																</div>
															</td>
														</tr>
													</table>
													<table border="0" cellpadding="10" cellspacing="0" class="heading_block" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt;" width="100%">
														<tr>
															<td>
																<h1 style="margin: 0; color: #2b2d2d; direction: ltr; font-family: "Helvetica Neue", Helvetica, Arial, sans-serif; font-size: 43px; font-weight: normal; letter-spacing: normal; line-height: 120%; text-align: left; margin-top: 0; margin-bottom: 0;"><strong>Gracias por tu pago!!!</strong></h1>
															</td>
														</tr>
													</table>
													<table border="0" cellpadding="10" cellspacing="0" class="text_block" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; word-break: break-word;" width="100%">
														<tr>
															<td>
																<div style="font-family: sans-serif">
																	<div style="font-size: 14px; mso-line-height-alt: 21px; color: #6f7077; line-height: 1.5; font-family: Arial, Helvetica Neue, Helvetica, sans-serif;">
																		<p style="margin: 0; font-size: 14px; mso-line-height-alt: 30px;"><span style="font-size:20px;">Hola <strong>'.$row_detalles_historial_pago[0]['nombre_comercial'].'</strong>, tu pago fue realizado con éxito.</span></p>
																	</div>
																</div>
															</td>
														</tr>
													</table>
													<table border="0" cellpadding="0" cellspacing="0" class="button_block" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt;" width="100%">
														<tr>
															<td style="padding-bottom:15px;padding-left:15px;padding-right:15px;padding-top:10px;text-align:left;">
																<a href="http://example.com" style="text-decoration:none;display:inline-block;color:#2b2d2d;background-color:transparent;border-radius:4px;width:auto;border-top:1px solid #2B2D2D;border-right:1px solid #2B2D2D;border-bottom:1px solid #2B2D2D;border-left:1px solid #2B2D2D;padding-top:5px;padding-bottom:5px;font-family:Arial, Helvetica Neue, Helvetica, sans-serif;text-align:center;mso-border-alt:none;word-break:keep-all;" target="_blank"><span style="padding-left:20px;padding-right:20px;font-size:16px;display:inline-block;letter-spacing:normal;"><span style="font-size: 16px; line-height: 2; word-break: break-word; mso-line-height-alt: 32px;"><strong>Bexpress: '.$row_detalles_historial_pago[0]['nombre_nivel'].'</strong></span></span></a>
															</td>
														</tr>
													</table>
												</td>
												<td class="column" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; font-weight: 400; text-align: left; vertical-align: top; border-top: 0px; border-right: 0px; border-bottom: 0px; border-left: 0px;" width="50%">
													<table border="0" cellpadding="0" cellspacing="0" class="image_block" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt;" width="100%">
														<tr>
															<td style="width:100%;padding-right:0px;padding-left:0px;padding-top:5px;padding-bottom:5px;">
																<div align="center" style="line-height:10px"><img alt="Services Company" src="images/logo.png" style="display: block; height: auto; border: 0; width: 400px; max-width: 100%;" title="Services Company" width="400" /></div>
															</td>
														</tr>
													</table>
												</td>
											</tr>
										</tbody>
									</table>
								</td>
							</tr>
						</tbody>
					</table>
					<table align="center" border="0" cellpadding="0" cellspacing="0" class="row row-4" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt;" width="100%">
						<tbody>
							<tr>
								<td>
									<table align="center" border="0" cellpadding="0" cellspacing="0" class="row-content stack" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; color: #000000; width: 800px;" width="800">
										<tbody>
											<tr>
												<td class="column" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; font-weight: 400; text-align: left; vertical-align: top; padding-top: 5px; padding-bottom: 5px; border-top: 0px; border-right: 0px; border-bottom: 0px; border-left: 0px;" width="100%">
													<table border="0" cellpadding="10" cellspacing="0" class="divider_block" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt;" width="100%">
														<tr>
															<td>
																<div align="center">
																	<table border="0" cellpadding="0" cellspacing="0" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt;" width="100%">
																		<tr>
																			<td class="divider_inner" style="font-size: 1px; line-height: 1px; border-top: 0px solid #BBBBBB;"><span> </span></td>
																		</tr>
																	</table>
																</div>
															</td>
														</tr>
													</table>
												</td>
											</tr>
										</tbody>
									</table>
								</td>
							</tr>
						</tbody>
					</table>
					<table align="center" border="0" cellpadding="0" cellspacing="0" class="row row-5" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt;" width="100%">
						<tbody>
							<tr>
								<td>
									<table align="center" border="0" cellpadding="0" cellspacing="0" class="row-content stack" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; color: #000000; width: 800px;" width="800">
										<tbody>
											<tr>
												<td class="column" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; font-weight: 400; text-align: left; vertical-align: top; padding-top: 5px; padding-bottom: 5px; border-top: 0px; border-right: 0px; border-bottom: 0px; border-left: 0px;" width="100%">
													<table border="0" cellpadding="10" cellspacing="0" class="divider_block" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt;" width="100%">
														<tr>
															<td>
																<div align="center">
																	<table border="0" cellpadding="0" cellspacing="0" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt;" width="100%">
																		<tr>
																			<td class="divider_inner" style="font-size: 1px; line-height: 1px; border-top: 0px solid #BBBBBB;"><span> </span></td>
																		</tr>
																	</table>
																</div>
															</td>
														</tr>
													</table>
												</td>
											</tr>
										</tbody>
									</table>
								</td>
							</tr>
						</tbody>
					</table>
					<table align="center" border="0" cellpadding="0" cellspacing="0" class="row row-6" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; background-color: #090660;" width="100%">
						<tbody>
							<tr>
								<td>
									<table align="center" border="0" cellpadding="0" cellspacing="0" class="row-content stack" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; color: #000000; width: 800px;" width="800">
										<tbody>
											<tr>
												<td class="column" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; font-weight: 400; text-align: left; vertical-align: top; padding-left: 5px; padding-right: 5px; border-top: 0px; border-right: 0px; border-bottom: 0px; border-left: 0px;" width="66.66666666666667%">
													<table border="0" cellpadding="0" cellspacing="0" class="text_block" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; word-break: break-word;" width="100%">
														<tr>
															<td style="padding-top:10px;padding-right:5px;padding-bottom:10px;padding-left:5px;">
																<div style="font-family: sans-serif">
																	<div style="font-size: 14px; mso-line-height-alt: 16.8px; color: #ffffff; line-height: 1.2; font-family: Arial, Helvetica Neue, Helvetica, sans-serif;">
																		<p style="margin: 0; font-size: 14px; text-align: left;"><span style="font-size:16px;">Concepto</span></p>
																	</div>
																</div>
															</td>
														</tr>
													</table>
												</td>
												<td class="column" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; font-weight: 400; text-align: left; vertical-align: top; border-top: 0px; border-right: 0px; border-bottom: 0px; border-left: 0px;" width="33.333333333333336%">
													<div class="spacer_block" style="height:5px;line-height:5px;font-size:1px;"> </div>
													<table border="0" cellpadding="5" cellspacing="0" class="text_block mobile_hide" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; word-break: break-word;" width="100%">
														<tr>
															<td>
																<div style="font-family: sans-serif">
																	<div style="font-size: 14px; mso-line-height-alt: 16.8px; color: #ffffff; line-height: 1.2; font-family: Arial, Helvetica Neue, Helvetica, sans-serif;">
																		<p style="margin: 0; font-size: 14px; margin-left: 80px; text-align: right;"><span style="font-size:16px;">Precio</span></p>
																	</div>
																</div>
															</td>
														</tr>
													</table>
													<div class="spacer_block" style="height:5px;line-height:5px;font-size:1px;"> </div>
												</td>
											</tr>
										</tbody>
									</table>
								</td>
							</tr>
						</tbody>
					</table>
					<table align="center" border="0" cellpadding="0" cellspacing="0" class="row row-7" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt;" width="100%">
						<tbody>
							<tr>
								<td>
									<table align="center" border="0" cellpadding="0" cellspacing="0" class="row-content stack" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; color: #000000; width: 800px;" width="800">
										<tbody>
											<tr>
												<td class="column" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; font-weight: 400; text-align: left; vertical-align: top; border-top: 0px; border-right: 0px; border-bottom: 0px; border-left: 0px;" width="66.66666666666667%">
													<table border="0" cellpadding="0" cellspacing="0" class="text_block" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; word-break: break-word;" width="100%">
														<tr>
															<td style="padding-top:15px;padding-right:10px;padding-bottom:10px;padding-left:10px;">
																<div style="font-family: sans-serif">
																	<div style="font-size: 14px; mso-line-height-alt: 16.8px; color: #000000; line-height: 1.2; font-family: Arial, Helvetica Neue, Helvetica, sans-serif;">
																		<p style="margin: 0; font-size: 14px;"><span style="font-size:12px;"><strong>Sistema Bexpress nivel: '.$row_detalles_historial_pago[0]['nombre_nivel'].'</strong></span></p>
																	</div>
																</div>
															</td>
														</tr>
													</table>
													<table border="0" cellpadding="0" cellspacing="0" class="text_block desktop_hide" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; mso-hide: all; display: none; max-height: 0; overflow: hidden; word-break: break-word;" width="100%">
														<tr>
															<td style="padding-right:10px;padding-left:10px;">
																<div style="font-family: sans-serif">
																	<div style="font-size: 14px; mso-line-height-alt: 16.8px; color: #000000; line-height: 1.2; font-family: Arial, Helvetica Neue, Helvetica, sans-serif;">
																		<p style="margin: 0; font-size: 14px;">$'.$row_detalles_historial_pago[0]['pago'].'MXN</p>
																	</div>
																</div>
															</td>
														</tr>
													</table>
													<div class="spacer_block" style="height:5px;line-height:5px;font-size:1px;"> </div>
												</td>
												<td class="column" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; font-weight: 400; text-align: left; vertical-align: top; border-top: 0px; border-right: 0px; border-bottom: 0px; border-left: 0px;" width="33.333333333333336%">
													<div class="spacer_block" style="height:5px;line-height:5px;font-size:1px;"> </div>
													<table border="0" cellpadding="10" cellspacing="0" class="text_block mobile_hide" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; word-break: break-word;" width="100%">
														<tr>
															<td>
																<div style="font-family: sans-serif">
																	<div style="font-size: 14px; mso-line-height-alt: 16.8px; color: #000000; line-height: 1.2; font-family: Arial, Helvetica Neue, Helvetica, sans-serif;">
																		<p style="margin: 0; text-align: right;"><span style="font-size:12px;">$'.$row_detalles_historial_pago[0]['pago'].'MXN</span></p>
																	</div>
																</div>
															</td>
														</tr>
													</table>
													<div class="spacer_block" style="height:5px;line-height:5px;font-size:1px;"> </div>
												</td>
											</tr>';
											$subtotal = (str_replace(",", "", $row_detalles_historial_pago[0]['pago']) * $row_detalles_historial_pago[0]['meses']);
											if($total_mejoras_plus>0){
												foreach ($row_mejoras_plus as $key => $value) {
													$body_email.=
													'<tr>
														<td class="column" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; font-weight: 400; text-align: left; vertical-align: top; border-top: 0px; border-right: 0px; border-bottom: 0px; border-left: 0px;" width="66.66666666666667%">
															<table border="0" cellpadding="0" cellspacing="0" class="text_block" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; word-break: break-word;" width="100%">
																<tr>
																	<td style="padding-top:15px;padding-right:10px;padding-bottom:10px;padding-left:10px;">
																		<div style="font-family: sans-serif">
																			<div style="font-size: 14px; mso-line-height-alt: 16.8px; color: #000000; line-height: 1.2; font-family: Arial, Helvetica Neue, Helvetica, sans-serif;">
																				<p style="margin: 0; font-size: 14px;"><span style="font-size:12px;"><strong>Mejora plus: '. $value['nombre_plus'].'</strong></span></p>
																			</div>
																		</div>
																	</td>
																</tr>
															</table>
															<table border="0" cellpadding="0" cellspacing="0" class="text_block desktop_hide" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; mso-hide: all; display: none; max-height: 0; overflow: hidden; word-break: break-word;" width="100%">
																<tr>
																	<td style="padding-right:10px;padding-left:10px;">
																		<div style="font-family: sans-serif">
																			<div style="font-size: 14px; mso-line-height-alt: 16.8px; color: #000000; line-height: 1.2; font-family: Arial, Helvetica Neue, Helvetica, sans-serif;">
																				<p style="margin: 0; font-size: 14px;">$'.$value['precio'].'MXN.</p>
																			</div>
																		</div>
																	</td>
																</tr>
															</table>
															<div class="spacer_block" style="height:5px;line-height:5px;font-size:1px;"> </div>
														</td>
														<td class="column" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; font-weight: 400; text-align: left; vertical-align: top; border-top: 0px; border-right: 0px; border-bottom: 0px; border-left: 0px;" width="33.333333333333336%">
															<div class="spacer_block" style="height:5px;line-height:5px;font-size:1px;"> </div>
															<table border="0" cellpadding="10" cellspacing="0" class="text_block mobile_hide" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; word-break: break-word;" width="100%">
																<tr>
																	<td>
																		<div style="font-family: sans-serif">
																			<div style="font-size: 14px; mso-line-height-alt: 16.8px; color: #000000; line-height: 1.2; font-family: Arial, Helvetica Neue, Helvetica, sans-serif;">
																				<p style="margin: 0; text-align: right;"><span style="font-size:12px;">$'.$value['precio'].'MXN.</span></p>
																			</div>
																		</div>
																	</td>
																</tr>
															</table>
															<div class="spacer_block" style="height:5px;line-height:5px;font-size:1px;"> </div>
														</td>
													</tr>';
													$subtotal += str_replace(",", "", $value['precio']);
												}
											}
											$body_email.=
										'</tbody>
									</table>
								</td>
							</tr>
						</tbody>
					</table>
					<table align="center" border="0" cellpadding="0" cellspacing="0" class="row row-8" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt;" width="100%">
						<tbody>
							<tr>
								<td>
									<table align="center" border="0" cellpadding="0" cellspacing="0" class="row-content stack" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; color: #000000; width: 800px;" width="800">
										<tbody>
											<tr>
												<td class="column" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; font-weight: 400; text-align: left; vertical-align: top; padding-top: 5px; padding-bottom: 5px; border-top: 0px; border-right: 0px; border-bottom: 0px; border-left: 0px;" width="100%">
													<table border="0" cellpadding="10" cellspacing="0" class="text_block" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; word-break: break-word;" width="100%">
														<tr>
															<td>
																<div style="font-family: sans-serif">
																	<div style="font-size: 14px; mso-line-height-alt: 16.8px; color: #555555; line-height: 1.2; font-family: Arial, Helvetica Neue, Helvetica, sans-serif;">
																		<p style="margin: 0; font-size: 14px; text-align: right;"><strong>Subtotal: $'.number_format($subtotal,2,'.',',').'MXN</strong></p>
																	</div>
																</div>
															</td>
														</tr>
													</table>
													<table border="0" cellpadding="10" cellspacing="0" class="text_block" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; word-break: break-word;" width="100%">
														<tr>
															<td>
																<div style="font-family: sans-serif">
																	<div style="font-size: 14px; mso-line-height-alt: 16.8px; color: #555555; line-height: 1.2; font-family: Arial, Helvetica Neue, Helvetica, sans-serif;">
																		<p style="margin: 0; font-size: 14px; text-align: right;"><strong>Factura: '.$_POST['factura_text'].'</strong></p>
																	</div>
																</div>
															</td>
														</tr>
													</table>
													<table border="0" cellpadding="10" cellspacing="0" class="text_block" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; word-break: break-word;" width="100%">
														<tr>
															<td>
																<div style="font-family: sans-serif">
																	<div style="font-size: 14px; mso-line-height-alt: 16.8px; color: #555555; line-height: 1.2; font-family: Arial, Helvetica Neue, Helvetica, sans-serif;">
																		<p style="margin: 0; font-size: 14px; text-align: right;"><strong>Total: $'.$_POST['monto_total'].'MXN</strong></p>
																	</div>
																</div>
															</td>
														</tr>
													</table>
												</td>
											</tr>
										</tbody>
									</table>
								</td>
							</tr>
						</tbody>
					</table>
					<table align="center" border="0" cellpadding="0" cellspacing="0" class="row row-9" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; background-color: #090660;" width="100%">
						<tbody>
							<tr>
								<td>
									<table align="center" border="0" cellpadding="0" cellspacing="0" class="row-content stack" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; color: #000000; background-color: #090660; width: 800px;" width="800">
										<tbody>
											<tr>
												<td class="column" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; font-weight: 400; text-align: left; vertical-align: top; padding-top: 5px; padding-bottom: 5px; border-top: 0px; border-right: 0px; border-bottom: 0px; border-left: 0px;" width="100%">
													<table border="0" cellpadding="10" cellspacing="0" class="social_block" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt;" width="100%">
														<tr>
															<td>
																<table align="center" border="0" cellpadding="0" cellspacing="0" class="social-table" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt;" width="36px">
																	<tr>
																		<td style="padding:0 2px 0 2px;"><a href="https://www.facebook.com/BorderBytesMx" target="_blank"><img alt="Facebook" height="32" src="images/facebook2x.png" style="display: block; height: auto; border: 0;" title="facebook" width="32" /></a></td>
																	</tr>
																</table>
															</td>
														</tr>
													</table>
													<table border="0" cellpadding="0" cellspacing="0" class="text_block" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; word-break: break-word;" width="100%">
														<tr>
															<td style="padding-bottom:10px;padding-left:50px;padding-right:50px;padding-top:10px;">
																<div style="font-family: sans-serif">
																	<div style="font-size: 14px; mso-line-height-alt: 21px; color: #6f7077; line-height: 1.5; font-family: Arial, Helvetica Neue, Helvetica, sans-serif;">
																		<p style="margin: 0; font-size: 14px; text-align: center;"><span style="color:#ffffff;">Para dudas o aclaraciones favor de ponerse en contacto en soporte@borderbytes.mx</span></p>
																	</div>
																</div>
															</td>
														</tr>
													</table>
												</td>
											</tr>
										</tbody>
									</table>
								</td>
							</tr>
						</tbody>
					</table>
					<table align="center" border="0" cellpadding="0" cellspacing="0" class="row row-10" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt;" width="100%">
						<tbody>
							<tr>
								<td>
									<table align="center" border="0" cellpadding="0" cellspacing="0" class="row-content stack" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; color: #000000; width: 800px;" width="800">
										<tbody>
											<tr>
												<td class="column" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; font-weight: 400; text-align: left; vertical-align: top; padding-top: 5px; padding-bottom: 5px; border-top: 0px; border-right: 0px; border-bottom: 0px; border-left: 0px;" width="100%">
													<table border="0" cellpadding="0" cellspacing="0" class="icons_block" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt;" width="100%">
														<tr>
															<td style="color:#9d9d9d;font-family:inherit;font-size:15px;padding-bottom:5px;padding-top:5px;text-align:center;">
																<table cellpadding="0" cellspacing="0" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt;" width="100%">
																	<tr>
																		<td style="text-align:center;">
																			<table cellpadding="0" cellspacing="0" class="icons-inner" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; display: inline-block; margin-right: -4px; padding-left: 0px; padding-right: 0px;">
																				<tr>
																					<td style="text-align:center;padding-top:5px;padding-bottom:5px;padding-left:5px;padding-right:6px;"><a href="https://www.designedwithbee.com/"><img align="center" alt="Designed with BEE" class="icon" height="32" src="images/bee.png" style="display: block; height: auto; border: 0;" width="34" /></a></td>
																					<td style="font-family:Arial, Helvetica Neue, Helvetica, sans-serif;font-size:15px;color:#9d9d9d;vertical-align:middle;letter-spacing:undefined;text-align:center;"><a href="https://www.designedwithbee.com/" style="color:#9d9d9d;text-decoration:none;">Designed with BEE</a></td>
																				</tr>
																			</table>
																		</td>
																	</tr>
																</table>
															</td>
														</tr>
													</table>
												</td>
											</tr>
										</tbody>
									</table>
								</td>
							</tr>
						</tbody>
					</table>
				</td>
			</tr>
		</tbody>
	</table>
</body>

</html>';

$email->enviar($row_detalles_historial_pago[0]['correo'], "Border Express", $body_email, '', '');
?>