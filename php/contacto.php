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

$mensaje = '<!DOCTYPE html><html lang="es">
                <head>
                    <meta charset="utf-8">
                    <meta name="viewport" content="width=device-width, initial-scale=1">
                </head>
                <body>
                    <div>
                        <img src="http://helptoknow.esy.es/logo" alt="Logo" width="200" height="110">
                    </div>
                    <hr/>
                    <div>
                        <h3>Ha enviado una solicitud de contacto</h3>
                    </div>
                    <div>
                        <hr>
                        <p>
                        <h3>Mensaje: </h3>
                        </p>
                        <p>'.$texto.'</p>
                        <hr>
                    </div>
                        <h4><strong>Help to know</strong></h4>
                    <p>P. SHERMAN, CALLE WALLABY 42,<br>SYDNEY, AU 90210</p>
                    <a href="mailto:info@helptoknow.esy.es">info@helptoknow.esy.es</a>
                </body>
            </html>';

if(mail($para, $titulo, $mensaje, $cabeceras)){
    echo "ENVIADO";
}else{
    echo "NO ENVIADO";
}
?>