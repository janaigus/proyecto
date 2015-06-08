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
                            <!-- Bootstrap Core CSS -->
                            <link href="http://helptoknow.esy.es/bootstrap" rel="stylesheet">
                        </head>
                        <body>
                              <div class="jumbotron">
                                    <div class="container">
                                    <div class="row">
                                        <div class="col-lg-4 col-lg-offset-4 text-center">
                                            <img src="http://helptoknow.esy.es/logo" alt="Logo" width="200" height="110">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-4 col-lg-offset-4 text-center">
                                            <h3>Ha enviado una solicitud de contacto</h3>
                                        </div>
                                    </div> 
                                    </div>
                              </div>
                              <div class="container">
                                <div class="row">
                                    <div class="col-lg-12 text-center">
                                        <div class="jumbotron" >
                                            <p>'.$texto.'
                                            </p>
                                          </div>
                                    </div>
                                </div> 
                              </div>
                                <!-- Footer -->
                            <footer>
                                <div class="container" >
                                    <div class="row">
                                        <div class="col-lg-12 text-center">
                                            <h4><strong>Help to know</strong>
                                            </h4>
                                            <p>P. SHERMAN, CALLE WALLABY 42,<br>SYDNEY, AU 90210</p>
                                            <ul class="list-unstyled">
                                                <li><i class="fa fa-phone fa-fw"></i> (123) 456-7890</li>
                                                <li><i class="fa fa-envelope-o fa-fw"></i><a href="mailto:info@helptoknow.esy.es">info@helptoknow.esy.es</a>
                                                </li>
                                            </ul>
                                            <br>
                                            <hr class="small">
                                            <p class="text-muted">Copyright &copy; Help to Know! 2015</p>
                                        </div>
                                    </div>
                                </div>
                            </footer>
                        </body>
                        </html>';

if(mail($para, $titulo, $mensaje, $cabeceras)){
    echo "ENVIADO";
}else{
    echo "NO ENVIADO";
}
?>