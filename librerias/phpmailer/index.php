<?php
		require_once('class.email.php');
		$email = new EMail();
					
			
		
		$body = '<div style="background-color:black;"><br>
		<img src="https://bexpress.mx/BX/img/logo.png" style=" margin-left:5%; display:block; max-width:50%;">
		<div style="background-color:#E7E7DF; margin:2%;"><div style="background-color:#2A2A2A;font-size:2.5em; "><h3 style="text-align:center;color:white;">Gracias por realizar tu compra</h3></div>			
			<div style="margin:5%;">
			<h2 style="font-family: sans-serif;">Hola, Nombreusuario</h2>
			<p style="font-family:sans-serif;">
			Te damos la bienvenida a nuestro sistema de reparto, una vez procesado y verificado el pago nosotros nos comunicaremos para poner en marcha tu sitio
			Esto no demorara demasiado y no afectara al tiempo de servicio</h4>	
			<p>Saludos,</p>
            <h3 style="font-family:sans-serif;">Departamento de soporte de BorderExpress</h3>
			<p style="margin:auto; display:block; color:gray;"> Este correo es generado automaticamente </p></div>
            <br><br>
		</div>
		<p style="color:gray; margin-left:2%; ">
		© 2020 BorderBytes Los Pinos 208, Las Palmas, Piedras Negras, Coahuila de Zaragoza, CP 26070, México <br>
        Este mensaje ha sido enviado a gabrielvallejo2000@gmail.com para informarte acerca de cambios importantes sobre tu sistema.
        <br>
        </p>
		</div>
		
		';	
	
	
		$email->enviar("gabrielvallejo2000@gmail.com", "Gracias por realizar tu pago", $body, '', '');			
?>