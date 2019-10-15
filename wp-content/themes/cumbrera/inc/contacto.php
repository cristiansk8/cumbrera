<?php
	
if($_SERVER['REQUEST_METHOD'] === 'POST') {
	
	$nombreUsu = strip_tags(trim($_POST['nombre']));
	$apellidoUsu = strip_tags(trim($_POST['apellido']));
	$asuntoMail = strip_tags(trim($_POST['asunto']));
	$mailUsu = strip_tags(trim($_POST['email']));
	$telefonoUsu = strip_tags(trim($_POST['telefono']));
	$msnUsu = strip_tags(trim($_POST['mensaje']));
	$cargoUsu = strip_tags(trim($_POST['cargo']));
	$selproy = strip_tags(trim($_POST['selproy']));
	$errores = array();
	
	if(empty($nombreUsu)){ 
		$errores[] = "El nombre está vacío";
	}
	
	if(empty($apellidoUsu)){ 
		$errores[] = "El apellido está vacío";
	}
		
	if(empty($telefonoUsu)){ 
		$errores[] = "El teléfono está vacío";
	}elseif(filter_var($telefonoUsu, FILTER_VALIDATE_INT) === false){ 
		$errores[] = "El teléfono solo números";
	}elseif(strlen($telefonoUsu) < 7){ $errores[] = "El teléfono que ingresaste es muy corto";}
		
	if(empty($mailUsu)){ 
		$errores[] = "El e-mail está vacío";
	}elseif(filter_var($mailUsu, FILTER_VALIDATE_EMAIL) === false){ $errores[] = "El e-mail que ingresaste no es válido";	}
	
	if($formulario == "proyecto" OR $formulario == "contacto"){
		if(empty($asuntoMail)){ 
			$errores[] = "El asunto está vacío";
		}elseif(strlen($asuntoMail) <= 10){ $errores[] = "El asunto que ingresaste es muy corto";}
		
		if(empty($msnUsu)){
			$errores[] = "El mensaje vacio";
		}elseif(strlen($msnUsu) <= 15){ $errores[] = "El mensaje que ingresaste es muy corto";}
	}
	if($formulario == "sobreC"){
		$asuntoMail = "Contacto: Trabaje con nosotros";
		$file = $_FILES['file'];
		if ($file['error'] != UPLOAD_ERR_OK) {
			$errores[] = 'El archivo no se pudo enviar por: '. $file['error'];
			//die("Upload failed with error " . $_FILES['file']['error']);
		}else{
			if($file['type'] == 'application/pdf' OR $file['type'] == 'application/msword'  OR $file['type'] == 'application/vnd.openxmlformats-officedocument.wordprocessingml.document' ){
				$fileCheck = true; 
			}else{ $errores[] = "El archivo no es valido"; }
		}
		
		if(empty($cargoUsu)){ 
			$errores[] = "El cargo está vacío";
		}elseif(strlen($cargoUsu) <= 2){ $errores[] = "El cargo que ingresaste es muy corto";}
	}
	
	//validamos si no hay errores
	if(count($errores) == 0){
	
	require_once('class.phpmailer.php');
	
	$ruta = get_template_directory_uri();

		$mensaje = '<html><body>';
		$mensaje .= '<table width="100%" align="center">
			   <tr>
				  <td>
					<table border="0" cellspacing="0" align="left" cellpadding="0" width="500">
					  <tr>
						<td valign="top" align="center" style="padding-bottom:8px;">
						   <img src="'.$ruta.'/images/logo2.png" align="absmiddle"><br /><br />
						</td>
					  </tr>
					  <tr>
						<td><b>SOLICITUD CONTACTO</b></td>
					  </tr>
					  <tr>
						<td><br></td>
					  </tr>
					  <tr>
						<td><b>Proyecto:</b> '.$selproy.'</td>
					  </tr>
					  <tr>
						<td><b>Nombre:</b> '.$nombreUsu.' '.$apellidoUsu.'</td>
					  </tr>
					  <tr>
						<td><b>Teléfono:</b> '.$telefonoUsu.'</td>
					  </tr>
					  <tr>
						<td><b>Email:</b> '.$mailUsu.'</td>
					  </tr>
					  <tr>
						<td><b>Cargo:</b> '.$cargoUsu.'</td>
					  </tr>
					  <tr>
						<td><b>Mensaje:</b> '.nl2br($msnUsu).'</td>
					  </tr>
				  </table>
			  </td>
		   </tr>
		   </table>';
		   $mensaje .= "</body></html>";
		
		if($formulario == "sobreC" OR $formulario == "contacto"){
			$emails = 'administracion@cumbrera.com.co';
			//$emails = 'wilder@fragmadigital.com';
			//$emails = 'carlo.75@gmail.com';
		}
		
		
		$mail = new PHPMailer();
		$mail->CharSet = 'UTF-8';
		$mail->From      = 'contacto@cumbrera.com.co';
		$mail->FromName  = 'Contacto Cumbrera';
		$mail->Subject   = $asuntoMail;
		$mail->msgHTML($mensaje);		
		$mail->AddAddress( $emails );
		$mail->addReplyTo($mailUsu, $nombreUsu);
		
		//enviamos attachment solo en el de trabaje con nosotros
		if($formulario == "sobreC" AND $fileCheck == true){
			//$file_to_attach = 'PATH_OF_YOUR_FILE_HERE';
			$file_to_attach = $file['tmp_name'];
			$mail->AddAttachment( $file_to_attach , $file["name"] );
		}
		$sent = $mail->send();
		if($sent == false){
			$response_sent ="Disc&uacute;lpenos, ha ocurrido un problema, intente nuevamente.";
		}elseif($sent == true){
			$response_sent = "Tu mensaje ya fue enviado.";
		}
	}
}
?>