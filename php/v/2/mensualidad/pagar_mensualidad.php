<?php
include_once("../../../m/SQLConexion.php");
$sql = new SQLConexion();

$row_metodos_pago = $sql->obtenerResultado("CALL sp_select_panel_metodos_pago1();");
$total_row_metodos_pago = count($row_metodos_pago);

$row_detalles_historial_pago = $sql->obtenerResultado("CALL sp_select_panel_detalles_pago1('" . $_POST['id_historial_pago'] . "');");

$row_mejoras_plus = $sql->obtenerResultado("CALL sp_select_panel_mejoras_plus1('" . $_POST['id_historial_pago'] . "');");
$total_mejoras_plus = count($row_mejoras_plus);

?>
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="row align-items-center mb-4">
                <div class="col">
                    <h2 class="h5 page-title"><small class="text-muted text-uppercase">Proceder a pagar</small></h2>
                </div>
                <div class="col-auto">
                    <div class="page-header-breadcrumb">
                        <ul class="breadcrumb bg-light">
                            <li class="breadcrumb-item"><a href="#pagar_servicio" class="text-decoration-none text-muted">Pagar servicio</a></li>
                            <li class="breadcrumb-item"><a href="#mensualidad_detalles_<?php echo $_POST['id_historial_pago']; ?>" class="text-decoration-none text-muted">Detalles de mensualidad</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="row my-4">
                <div class="col-sm-12">
                    <div class="card shadow mb-4">
                        <div class="card-header">
                            <strong class="card-title">Selecciona un método de pago</strong>
                        </div>
                        <div class="card-body" id="content_metodos_pago">
                            <?php
                            if ($total_row_metodos_pago > 0) {
                                echo
                                '<ul class="nav nav-tabs mb-3" id="myTab" role="tablist">';
                                foreach ($row_metodos_pago as $key => $value) {
                                    echo
                                    '<li class="nav-item">
                                        <a class="nav-link" id="home-tab" data-toggle="tab" href="#metodo_pago_' . $value['id_metodo'] . '" role="tab" aria-controls="home" aria-selected="true">' . $value['nombre'] . '</a>
                                    </li>';
                                }
                                echo
                                '</ul>';
                            }
                            ?>
                            <div class="tab-content" id="myTabContent">
                                <!-- DEFAULT -->
                                <div class="tab-pane fade active show" role="tabpanel" aria-labelledby="home-tab">
                                    <div class="card shadow bg-light text-center mb-4">
                                        <div class="card-body p-5">
                                            <span class="circle circle-md bg-secondary-lighter d-flex justify-content-center" style="margin:auto;">
                                                <span class="material-icons-round text-dark">touch_app</span>
                                            </span>
                                            <h3 class="h4 mt-4 mb-1">Selecciona un método de pago</h3>
                                            <p class="mb-4">Estás a un paso de renovar tu servicio.</p>
                                        </div>
                                    </div>
                                </div>
                                <!-- STRIPE -->
                                <div class="tab-pane fade" id="metodo_pago_2" role="tabpanel" aria-labelledby="home-tab">
                                    <p class="mb-2"><strong>Tarjeta de Crédito o Débito</strong><img src="../img/0/tarjetas-de-credito.png" class="ml-2"></p>
                                    <div class="table-responsive">
                                        <table class="table table-hover">
                                            <thead>
                                                <tr>
                                                    <th>Concepto</th>
                                                    <th class="text-center">Mes(es)</th>
                                                    <th class="text-right">Precio</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>
                                                        <p class="mb-0 text-dark font-weight-bold">Sistema Bexpress nivel: <?php echo $row_detalles_historial_pago[0]['nombre_nivel']; ?></p>
                                                    </td>
                                                    <td class="text-center">
                                                        <p class="mb-0 text-muted"><?php echo $row_detalles_historial_pago[0]['meses']; ?></p>
                                                    </td>
                                                    <td class="text-right">
                                                        <p class="mb-0 text-dark">$<?php echo $row_detalles_historial_pago[0]['pago']; ?>MXN</p>
                                                    </td>
                                                </tr>
                                                <?php
                                                $subtotal = (str_replace(",", "", $row_detalles_historial_pago[0]['pago']) * $row_detalles_historial_pago[0]['meses']);
                                                if ($total_mejoras_plus > 0) {
                                                    foreach ($row_mejoras_plus as $key => $value) {
                                                        echo
                                                        '<tr>
                                                            <td>
                                                                <p class="mb-0 text-dark font-weight-bold">' . $value['nombre_plus'] . '</p>
                                                            </td>
                                                            <td class="text-center">
                                                                <p class="mb-0 text-muted">N/A</p>
                                                            </td>
                                                            <td class="text-right">
                                                                <p class="mb-0 text-dark">$' . $value['precio'] . 'MXN</p>
                                                            </td>
                                                        </tr>';
                                                        $subtotal += str_replace(",", "", $value['precio']);
                                                    }
                                                }
                                                ?>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="form-group text-right">
                                        <p class="mb-2 h6">
                                            <span class="text-muted">Subtotal : </span>
                                            <strong>$<?php echo number_format($subtotal,2,'.',','); ?>MXN</strong>
                                        </p>
                                        <p class="mb-2 h6">
                                            <span class="text-muted">Factura : </span>
                                            <strong><?php echo $_POST['factura_text']; ?></strong>
                                        </p>
                                        <p class="mb-2 h6">
                                            <span class="text-muted">Total : </span>
                                            <strong id="text_factura">$<?php echo number_format($_POST['monto_total'],2,'.',','); ?>MXN</strong>
                                        </p>
                                    </div>
                                    <div>
                                        <div id="main_stripe">
                                            <form action="../librerias/stripe/CreateCharge.php" method="post" id="payment-form-stripe">
                                                <input type="hidden" name="factura" value="<?php echo $_POST['factura'] ?>">
                                                <input type="hidden" name="id_historial_pago" value="<?php echo $_POST['id_historial_pago'] ?>">
                                                <input type="hidden" name="factura_text" value="<?php echo $_POST['factura_text'] ?>">
                                                <input type="hidden" name="monto_total" value="<?php echo $_POST['monto_total'] ?>">
                                                <div class="form-row">
                                                    <div id="card-element" id="cardholder"></div>
                                                    <div id="card-errors" role="alert"></div>
                                                </div>
                                                <button class="btn" id="btn_stripe">Pagar con stripe</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <!-- TRANSFERENCIA -->
                                <div class="tab-pane fade" id="metodo_pago_3" role="tabpanel" aria-labelledby="home-tab">
                                    <p class="mb-2"><strong>Transferencia bancaria</strong><img src="../img/0/transferencia-bancaria.png" class="ml-2"></p>
                                    <dl class="row align-items-center mb-0">
                                        <dt class="col-sm-2 mb-3 text-muted">Banco:</dt>
                                        <dd class="col-sm-4 mb-3">
                                            <strong>BBVA Bancomer</strong>
                                        </dd>
                                        <dt class="col-sm-2 mb-3 text-muted">Pagado a:</dt>
                                        <dd class="col-sm-4 mb-3">
                                            <strong class="d-block">Border bytes</strong>
                                        </dd>
                                    </dl>
                                    <dl class="row mb-0">
                                        <dt class="col-sm-2 mb-3 text-muted">Nombre de cuenta:</dt>
                                        <dd class="col-sm-4 mb-3">Alejandro Bermejo Tovar</dd>
                                        <dt class="col-sm-2 mb-3 text-muted">Correo de contacto:</dt>
                                        <dd class="col-sm-4 mb-3">ventas@borderbytes.mx</dd>
                                        <dt class="col-sm-2 mb-3 text-muted">Num. de cuenta:</dt>
                                        <dd class="col-sm-4 mb-3">0120 7501 5827 714286</dd>
                                        <dt class="col-sm-2 mb-3 text-muted">Fecha de vencimiento:</dt>
                                        <dd class="col-sm-4 mb-3"><?php echo $row_detalles_historial_pago[0]['fecha_pago']; ?></dd>
                                        <dt class="col-sm-2 mb-3 text-muted">Num. de tarjeta:</dt>
                                        <dd class="col-sm-4 mb-3">4152 3138 6900 9162</dd>
                                        <dt class="col-sm-2 mb-3 text-muted">Estado de pago:</dt>
                                        <dd class="col-sm-4 mb-3"><?php echo $row_detalles_historial_pago[0]['nombre_estado_pago']; ?></dd>
                                    </dl>
                                    <div class="table-responsive">
                                        <table class="table table-hover">
                                            <thead>
                                                <tr>
                                                    <th>Concepto</th>
                                                    <th class="text-center">Mes(es)</th>
                                                    <th class="text-right">Precio</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>
                                                        <p class="mb-0 text-dark font-weight-bold">Sistema Bexpress nivel: <?php echo $row_detalles_historial_pago[0]['nombre_nivel']; ?></p>
                                                    </td>
                                                    <td class="text-center">
                                                        <p class="mb-0 text-muted"><?php echo $row_detalles_historial_pago[0]['meses']; ?></p>
                                                    </td>
                                                    <td class="text-right">
                                                        <p class="mb-0 text-dark">$<?php echo $row_detalles_historial_pago[0]['pago']; ?>MXN</p>
                                                    </td>
                                                </tr>
                                                <?php
                                                $subtotal = (str_replace(",", "", $row_detalles_historial_pago[0]['pago']) * $row_detalles_historial_pago[0]['meses']);
                                                if ($total_mejoras_plus > 0) {
                                                    foreach ($row_mejoras_plus as $key => $value) {
                                                        echo
                                                        '<tr>
                                                            <td>
                                                                <p class="mb-0 text-dark font-weight-bold">' . $value['nombre_plus'] . '</p>
                                                            </td>
                                                            <td class="text-center">
                                                                <p class="mb-0 text-muted">N/A</p>
                                                            </td>
                                                            <td class="text-right">
                                                                <p class="mb-0 text-dark">$' . $value['precio'] . 'MXN</p>
                                                            </td>
                                                        </tr>';
                                                        $subtotal += str_replace(",", "", $value['precio']);
                                                    }
                                                }
                                                ?>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="form-group text-right">
                                        <p class="mb-2 h6">
                                            <span class="text-muted">Subtotal : </span>
                                            <strong>$<?php echo number_format($subtotal,2,'.',','); ?>MXN</strong>
                                        </p>
                                        <p class="mb-2 h6">
                                            <span class="text-muted">Factura : </span>
                                            <strong><?php echo $_POST['factura_text']; ?></strong>
                                        </p>
                                        <p class="mb-2 h6">
                                            <span class="text-muted">Total : </span>
                                            <strong id="text_factura">$<?php echo number_format($_POST['monto_total'],2,'.',','); ?>MXN</strong>
                                        </p>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label text-muted">Agregar comprobante <i class="fas fa-paperclip"></i></label>
                                        <form action="../php/c/0/upload_mensualidad.php" id="frmTarget"  data-content="Por favor agrega un archivo o imagen de la facturación" enctype="multipart/form-data" class="dropzone" id="image-upload">
                                            <input type="hidden" name="request" value="add_mensualidad_transferencia">
                                            <input type="hidden" name="carpeta" value="comprobantes">
                                        </form>
                                        <button class="btn-block btn bg-success-dark text-white mt-3 py-3" data-factura="<?php echo $_POST['factura']; ?>" data-factura_text="<?php echo $_POST['factura_text']; ?>" data-id="<?php echo $_POST['id_historial_pago']; ?>" data-monto_total="<?php echo $_POST['monto_total']; ?>" id="btn_subir_comprobante_mensualidad">Subir comprobante</button>
                                    </div>
                                </div>
                                <!-- PAYPAL -->
                                <div class="tab-pane fade" id="metodo_pago_4" role="tabpanel" aria-labelledby="home-tab">
                                    <p class="mb-2"><strong>Paypal</strong><img src="../img/0/paypal.png" class="ml-2"></p>
                                    <div class="table-responsive">
                                        <table class="table table-hover">
                                            <thead>
                                                <tr>
                                                    <th>Concepto</th>
                                                    <th class="text-center">Mes(es)</th>
                                                    <th class="text-right">Precio</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>
                                                        <p class="mb-0 text-dark font-weight-bold">Sistema Bexpress nivel: <?php echo $row_detalles_historial_pago[0]['nombre_nivel']; ?></p>
                                                    </td>
                                                    <td class="text-center">
                                                        <p class="mb-0 text-muted"><?php echo $row_detalles_historial_pago[0]['meses']; ?></p>
                                                    </td>
                                                    <td class="text-right">
                                                        <p class="mb-0 text-dark">$<?php echo $row_detalles_historial_pago[0]['pago']; ?>MXN</p>
                                                    </td>
                                                </tr>
                                                <?php
                                                $subtotal = (str_replace(",", "", $row_detalles_historial_pago[0]['pago']) * $row_detalles_historial_pago[0]['meses']);
                                                if ($total_mejoras_plus > 0) {
                                                    foreach ($row_mejoras_plus as $key => $value) {
                                                        echo
                                                        '<tr>
                                                            <td>
                                                                <p class="mb-0 text-dark font-weight-bold">' . $value['nombre_plus'] . '</p>
                                                            </td>
                                                            <td class="text-center">
                                                                <p class="mb-0 text-muted">N/A</p>
                                                            </td>
                                                            <td class="text-right">
                                                                <p class="mb-0 text-dark">$' . $value['precio'] . 'MXN</p>
                                                            </td>
                                                        </tr>';
                                                        $subtotal += str_replace(",", "", $value['precio']);
                                                    }
                                                }
                                                ?>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="form-group text-right">
                                        <p class="mb-2 h6">
                                            <span class="text-muted">Subtotal : </span>
                                            <strong>$<?php echo number_format($subtotal,2,'.',','); ?>MXN</strong>
                                        </p>
                                        <p class="mb-2 h6">
                                            <span class="text-muted">Factura : </span>
                                            <strong><?php echo $_POST['factura_text']; ?></strong>
                                        </p>
                                        <p class="mb-2 h6">
                                            <span class="text-muted">Total : </span>
                                            <strong id="text_factura">$<?php echo number_format($_POST['monto_total'],2,'.',','); ?>MXN</strong>
                                        </p>
                                    </div>
                                    <div class="form-group">
                                        <div id="paypal-button-container" class="text-center"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    /* --------------------------------- STRIPE --------------------------------- */
    var stripe = Stripe("pk_test_oDFP670r0EFdJQVbdReBSQKN00RyIqKOwk");
	var elements = stripe.elements();
	var style = {
		base: {
			color: '#32325d',
			lineHeight: '18px',
			fontFamily: '"Helvetica Neue", Helvetica, sans-serif',
			fontSmoothing: 'antialiased',
			fontSize: '16px',
			'::placeholder': {
				color: '#aab7c4'
			}
		},
		invalid: {
			color: '#fa755a',
			iconColor: '#fa755a'
		}
	};
	var card = elements.create('card', {style: style});
	card.mount('#card-element');
	card.addEventListener('change', function(event) {
		var displayError = document.getElementById('card-errors');
		if (event.error) {
			displayError.textContent = event.error.message;
		} else {
			displayError.textContent = '';
		}
	});
	var form = document.getElementById('payment-form-stripe');
	form.addEventListener('submit', function(event) {
		event.preventDefault();
		stripe.createToken(card).then(function(result) {
			if (result.error) {
				var errorElement = document.getElementById('card-errors');
				errorElement.textContent = result.error.message;
			} else {
				stripeTokenHandler(result.token);
			}
		});
	});
	function stripeTokenHandler(token) {
		var form = document.getElementById('payment-form-stripe');
		var hiddenInput = document.createElement('input');
		hiddenInput.setAttribute('type', 'hidden');
		hiddenInput.setAttribute('name', 'stripeToken');
		hiddenInput.setAttribute('value', token.id);
		form.appendChild(hiddenInput);
		form.submit();
	}
    /* --------------------------------- PAYPAL --------------------------------- */
    paypal.Buttons({
        createOrder: function(data, actions) {
            return actions.order.create({
                purchase_units: [{
                    amount: {
                        value: <?php echo $_POST['monto_total']; ?>,
                    }
                }]
            });
        },
        onApprove: function(data, actions) {
            return actions.order.capture().then(function(details) {
                $.ajax({
                    type:"POST",
                    url:"../php/c/2/mensualidad/realizar_pago_paypal.php",
                    data:{id_historial_pago: <?php echo $_POST['id_historial_pago']; ?>, factura: <?php echo $_POST['factura']; ?>, monto_total: <?php echo $_POST['monto_total']; ?>, factura_text: '<?php echo $_POST['factura_text']; ?>'},
                    beforeSend:function(){
                        loader("#content_metodos_pago");
                    },
                    success:function(response){
                        response.status=="success" ? window.location.href="../php/v/2/mensualidad/pago_exitoso.php" : $("#loader").remove();
                    }
                });
                return fetch('/paypal-transaction-complete', {
                    method: 'post',
                    headers: {
                        'content-type': 'application/json'
                    },
                    body: JSON.stringify({
                        orderID: data.orderID
                    })
                });
            });
        }
    }).render('#paypal-button-container');
    /* ------------------------------ TRANSFERENCIA ----------------------------- */
    Dropzone.autoDiscover = false;
    var myDropzone = new Dropzone(".dropzone", {
        autoProcessQueue: false,
        maxFilesize: 10,
        acceptedFiles: ".jpeg, .jpg, .png",
        addRemoveLinks: true,
        maxFiles: 1,
        parallelUploads: 1,
        dictDefaultMessage: '<strong class="card-title">Suelta el archivo aquí o da click</strong>',
        dictRemoveFile: "Eliminar",
        init: function() {
            this.on("error", function(file, errorMessage) {
                $(file.previewElement).find('.dz-error-message').text("Por favor agregar un comprobante con extensión .jpeg, .jpg, .png");
            });
            this.on('queuecomplete', function(file){
                var total_archivos_rechazados = myDropzone.getRejectedFiles().length;
                total_archivos_rechazados==0 ? window.location.href="../php/v/2/mensualidad/pago_exitoso.php" : void 0;
            });
        }
    });
</script>