<?php	
require_once('class.phpmailer.php');
require_once("class.smtp.php"); // optional, gets called from within class.phpmailer.php if not already loaded	
	
class EMail{
	
	public function __construct(){
	
	}

	public function enviar($to, $subject, $body, $cc, $bcc){			
		$emailOrigin = "ventas@borderbytes.mx";		
		$nameEmailOrigin = "BorderBytes";		
		
		$headers = "From: ". $nameEmailOrigin . " <". $emailOrigin .">\n";
		$headers .= "Reply-To: $emailOrigin\n";
		$headers .= "MIME-Version: 1.0" . "\r\n";
		$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";	
			
		if(mail($to,$subject,$body,$headers)){
			return true;
		}
		else{
			return false;
		}			
	}
}
?>