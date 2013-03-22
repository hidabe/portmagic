<?php
	include("class.phpmailer.php");
	//include("class.smtp.php");

class PSendEmail {

	public function sendEmail() {

		$name = $_POST['name'];
		$message = $_POST['message'];
		$email = $_POST['email'];

		$contenido = "Nombre: ".$name."<br />"."Email: ".$email."<br /><br />" . $message;

		$mail = new PHPMailer();
		$mail->IsSMTP();
		$mail->SMTPAuth = true;
		$mail->SMTPSecure = "ssl";

		$mail->Host = "smtp.gmail.com";
		$mail->Port = 465;
		$mail->Username = "lumilo8@gmail.com"; //Cambiarlo
		$mail->Password = "luismi91"; //Cambiarlo
	
		$mail->From = $email;
		$mail->FromName = $name;
		$mail->Subject = "PortMagic Report";
		$mail->AltBody = $message;
		$mail->MsgHTML($contenido);

		// Adjuntar archivos
		// Podemos agregar mas de uno si queremos.
		//$mail->AddAttachment("ruta-del-archivo/archivo.zip");

		$mail->AddAddress("ginzas_6@hotmail.com"); // Your Email //Tambien cambiarlo!
		$mail->IsHTML(true);

	
		/*if(!$mail->Send()) {
		  ?><script>alert('Algo ha fallado');</script><?
		} else {
			//echo PFrameWork::$config->get('site');
			header("Location: http://localhost/portmagic/portmagic/");
		}*/
		//echo 'luismi';
	
	}
}

?>
