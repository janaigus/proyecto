<?php
$nombre = $_POST['nombreContacto'];
$email = $_POST['emailContacto'];
$asunto = $_POST['asuntoContacto'];
$texto = $_POST["mensajeContacto"];

$para      = 'janaigus@gmail.com, info@helptoknow.esy.es,'.$email;
$titulo    = 'Solicitud de contacto Help To Know. Asunto:"'.$asunto.'"';
$cabeceras  = 'MIME-Version: 1.0' . "\r\n";
$cabeceras .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
$cabeceras .= 'From: '.$email.'' . "\r\n" .
    'Reply-To: info@helptoknow.esy.es' . "\r\n" .
    'X-Mailer: PHP/' . phpversion();

$mensaje = '
<html>
<head>
  <meta charset="utf-8">
</head>
<body>
  <h1>Mensaje enviado: </h1>
  <p>'.$texto.'</p>
</body>
</html>
';

if(mail($para, $titulo, $mensaje, $cabeceras)){
    echo "ENVIADO";
}else{
    echo "NO ENVIADO";
}
?>