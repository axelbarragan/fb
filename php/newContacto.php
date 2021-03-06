<?php
/*
Archivo de contacto para enviar datos mediante correo
*/

include_once('../config/config.php');
require('PHPMailer-master/PHPMailerAutoload.php');
include_once('funciones.php');

$estado = 1;

switch ($estado) {
	case '0':
	$datos = array();
	foreach ($_POST as $clave=>$valor) {
		$datos[] = $valor;
	}

	break;
	
	case '1':
	$ipWeb = obtenerIP();
	$datos = array();
	foreach ($_POST as $clave=>$valor) {
		$datos[] = $valor;
	}

	$captcha = $datos[4];
	$secret = KEYSECRET;
	$data = url_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=$secret&response=$captcha&remoteip=$ipWeb");
	if(!$data) {
		$respuesta = array("respuesta" => 'mal', "res" => 'NO SE PUDO VERIFICAR EL RECAPTCHA');
		echo json_encode($respuesta);
		break;
	} else {
		$mail = new PHPMailer;
    //$mail->SMTPDebug = 3;                               // Enable verbose debug output
    $mail->isSMTP();                                      // Set mailer to use SMTP
    $mail->Host = 'hv20svg057.neubox.net';  // Specify main and backup SMTP servers
    $mail->SMTPAuth = true;                               // Enable SMTP authentication
    $mail->Username = 'contacto@flubox.com.mx';                 // SMTP username
    $mail->Password = 'awelpo128@';                           // SMTP password
    $mail->SMTPSecure = 'ssl';                            // Enable TLS encryption, `ssl` also accepted
    $mail->Port = 465;                                    // TCP port to connect to
    $mail->setFrom(CORREO_CONTACTO, 'Flubox');
    $mail->addAddress(CORREO_CONTACTO, 'Flubox');     // Add a recipient
    //$mail->addAddress('ellen@example.com');               // Name is optional
    //$mail->addReplyTo('info@example.com', 'Information');
    //$mail->addCC('cc@example.com');
    //$mail->addBCC('bcc@example.com');
    //$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
    //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = TITULO_CORREO_CONTACTO;
    $mail->Body    = 'Se ha recibido un nuevo mensaje de contacto de la página<br>
    <b>Nombre:</b> '.$datos[0].'<br>
    <b>Correo:</b> '.$datos[1].'<br>
    <b>Asunto:</b> '.$datos[2].'<br>
    <b>Mensaje:</b> '.$datos[3].'<br>
    <b>IP</b> '.$ipWeb.'<br>';
    $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    if(!$mail->send()) {
    	$respuesta = array("respuesta" => 'mal', "res" => 'Envio de correo no posible: '.$mail->ErrorInfo);
    	echo json_encode($respuesta);
    } else {
    	$respuesta = array("respuesta" => 'bien', "res" => 'Mensaje enviado!');
    	echo json_encode($respuesta);
    }
  }
  break;
}



/*

$to      = CORREO_CONTACTO;
$subject = utf8_decode(TITULO_CORREO_CONTACTO);
$message = '      
Se ha recibido un nuevo mensaje de contacto de la página<br>
<b>Nombre:</b> '.$datos[0].'<br>
<b>Correo:</b> '.$datos[1].'<br>
<b>Asunto:</b> '.$datos[2].'<br>
<b>Mensaje:</b> '.$datos[3].'<br>
';
$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
$headers .= "From: Flubox <contacto@flubox.com.mx>";
if(mail($to,$subject,$message,$headers)) {
	$respuesta = array("respuesta" => 'bien', "res" => 'Mensaje enviado!');
	echo json_encode($respuesta);
} else {
	$respuesta = array("respuesta" => 'mal', "res" => 'Envio de segundo correo no posible');
	echo json_encode($respuesta);
}*/

?>