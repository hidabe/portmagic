<?php
	include(PFrameWork::$config->get('dir')."externals/mail/class.phpmailer.php");
	//include("class.smtp.php");

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
	$mail->Username = PFrameWork::$config->get('username');
	$mail->Password = PFrameWork::$config->get('password');

	$mail->From = $email;
	$mail->FromName = $name;
	$mail->Subject = "PortMagic Report";
	$mail->AltBody = $message;
	$mail->MsgHTML($contenido);

	// Adjuntar archivos
	// Podemos agregar mas de uno si queremos.
	//$mail->AddAttachment("ruta-del-archivo/archivo.zip");

	$mail->AddAddress(PFrameWork::$config->get('email'));
	$mail->IsHTML(true);

	if(!$mail->Send()) {
	  ?><script>alert('¡Algo ha fallado!');</script><?
	} else {
	  ?><script>alert('¡Envío con éxito!');</script><?
	}
?>
