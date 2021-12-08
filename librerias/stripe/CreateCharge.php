<?php
include_once('../../php/m/SQLConexion.php');
include_once('../phpmailer/class.email.php');

$sql = new SQLConexion();
$email = new EMail();

$row_total_pago = $sql->obtenerResultado("CALL sp_select_panel_calcular_pago1('" . $_POST['id_historial_pago'] . "','" . $_POST['factura'] . "')");

require 'vendor/autoload.php';

\Stripe\Stripe::setApiKey('sk_test_AGE5b5Wf7fb4oLWly4TcRWy6006vS3zdqD');

try {
    $token = $_POST["stripeToken"];
    $error = 0;
    $charge = \Stripe\Charge::create([
        "amount" => $row_total_pago[0]['total'],
        "currency" => "mxn",
        "description" => "Sistema Border Express",
        "source" => $token
    ]);
} catch (\Stripe\Exception\CardException $e) {
    $error = 1;
} catch (\Stripe\Exception\RateLimitException $e) {
    $error = 1;
} catch (\Stripe\Exception\InvalidRequestException $e) {
    $error = 1;
} catch (\Stripe\Exception\AuthenticationException $e) {
    $error = 1;
} catch (\Stripe\Exception\ApiConnectionException $e) {
    $error = 1;
} catch (\Stripe\Exception\ApiErrorException $e) {
    $error = 1;
} catch (Exception $e) {
    $error = 1;
}
if($error==0){
    
    $rpta = $sql->obtenerResultadoSimple("CALL sp_update_panel_historial_pago1('".$_POST['id_historial_pago']."','2','" . $_POST['factura'] . "')");

    include_once("../../php/c/2/mensualidad/pago_exitoso/correo.php");
    echo '<script>window.location.href="../../php/v/2/mensualidad/pago_exitoso.php"</script>';
}
else{
    echo '<script>window.location.href="../../php/v/2/mensualidad/pago_rechazado.php"</script>';
}