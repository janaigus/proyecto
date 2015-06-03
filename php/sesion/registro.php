<?php
    session_start();
    if(isset($_SESSION['nombreh2k'])){
        header('Location: ../../index.php');
    }
    // Requerir el fichero para la conexion con la base de datos 
    require('../bd/conexionBDlocal.php');
    $db = conectaDb();
    // Si han llegado datos del formulario de registro
    if(isset($_POST['registroNombre'])){
        $consulta = "SELECT * FROM usuarios where email=:email";
        $result = $db->prepare($consulta);
        $result->execute(array(":email" => $_POST['registroEmail']));
        // Si el email está disponible
        if((!$result->rowCount() > 0)){
            $consulta = "SELECT * FROM usuarios where nick=:nick";
            $result = $db->prepare($consulta);
            $result->execute(array(":nick" => $_POST['registroNick']));
            // Si el nick está disponible
            if((!$result->rowCount() > 0)){
                // Si el captcha es correcto
                $respuesta = json_decode(file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret=6LecTAcTAAAAAKg7meG4TT6RWFKD8i4jox9WlsEA&response='.$_POST['g-recaptcha-response'].'&remoteip='.$_SERVER['REMOTE_ADDR']), true);
                if($respuesta['success'] == 1){
                    $consulta = "INSERT INTO usuarios (email, nick, nombre, apellidos, password, idrol, idmunicipio, idisla) ";
                    $consulta .= "VALUES (:mail, :alias, :name, :sname, :pass, :rol, :mun, :isla)";

                    $result  = $db->prepare($consulta);
                    $resultado = $result->execute(array(
                        ":mail" => $_POST['registroEmail'],
                        ":alias" => $_POST['registroNick'],
                        ":name" => $_POST['registroNombre'],
                        ":sname" => $_POST['registroApellidos'],
                        ":pass" => md5(md5(md5($_POST['registroPassword']))),
                        ":rol" => 2,
                        ":mun" => $_POST['registroMunicipios'],
                        ":isla" => $_POST['registroIslas']
                    ));
                    $idUsuario = $db->lastInsertId();
                    if($resultado){
                        // Enviar correo de confirmacion de la creacion del usuario
                        $para      = 'janaigus@gmail.com, info@helptoknow.esy.es,'.$_POST['registroEmail'];
                        $titulo    = 'Gracias por registrarse en Help To Know.';
                        $cabeceras  = 'MIME-Version: 1.0' . "\r\n";
                        $cabeceras .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
                        $cabeceras .= 'From: '.$_POST['registroEmail'].'' . "\r\n" .
                            'Reply-To: info@helptoknow.esy.es' . "\r\n" .
                            'X-Mailer: PHP/' . phpversion();

                        $mensaje = '
                        <html>
                        <head>
                          <meta charset="utf-8">
                        </head>
                        <body>
                          <h1>Mensaje enviado: </h1>
                          <p>Ha sido registrado satisfactoriamente en Help to Know</p>
                          <p>Datos de acceso:</br>Email: '.$_POST['registroEmail'].'</br>Nick dentro de la página: '.$_POST['registroNick'].'
                          </p>
                        </body>
                        </html>
                        ';
                        // Crear las sesiones y redireccionar a index
                        $_SESSION['idh2k'] = $idUsuario;
                        $_SESSION['nickh2k'] = $_POST['registroNick'];
                        $_SESSION['nombreh2k'] = $_POST['registroNombre'];
                        $_SESSION['rolh2k'] = 2;
                        $_SESSION['municipioh2k'] = $_POST['registroMunicipios'];
                        $_SESSION['islah2k'] = $_POST['registroIslas'];
                        $_SESSION['emailh2k'] = $arrayResult[0]['email'];
                        $_SESSION['tiempoh2k'] = date("Y-n-j H:i:s");
                        header('Location: ../../index.php');
                    }else{
                        $error = '<span class="glyphicon glyphicon-remove"></span>No se ha podido completar el registro';
                    }//Resultado
                    
                }else{
                    $error = '<span class="glyphicon glyphicon-remove"></span>Captcha incorrecto';
                } //Captcha
                
            }else{
                $error = '<span class="glyphicon glyphicon-remove"></span>El nick no está disponible';
            } // Nick
        }else{
            $error = '<span class="glyphicon glyphicon-remove"></span>Ya existe un usuario regitrado con ese email';
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>H2K</title>

    <!-- Bootstrap Core CSS -->
    <link href="../../css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="../../font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="../../fonts/serif-pro.css" rel="stylesheet" type="text/css">

    <!-- Custom CSS -->
    <link href="../../css/index.css" rel="stylesheet">
    
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <!-- Api de google para recaptcha -->
    <script src='https://www.google.com/recaptcha/api.js'></script>
</head>

<body>
    <!-- Navigation -->
    <a id="menu-toggle" href="#" class="btn btn-dark btn-lg toggle"><i class="fa fa-bars"></i></a>
    <nav id="sidebar-wrapper">
        <ul class="sidebar-nav">
            <a id="menu-close" href="#" class="btn btn-light btn-lg pull-right toggle"><i class="fa fa-times"></i></a>
            <li class="sidebar-brand">
                <a href="../../index.php"  onclick = $("#menu-close").click(); >Help to Know</a>
            </li>
            <li>
                <a href="#registro" onclick = $("#menu-close").click(); >Registro</a>
            </li>
            <li>
                <a href="#contacto" onclick = $("#menu-close").click(); >Contacto</a>
            </li>
            <hr>
            <li>
                <a id="btnEntrar" href="#modalEntrar">Iniciar Sesión</a>
            </li>
        </ul>
    </nav>
    
    <!-- About -->
    <section id="about" class="about">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2>Ayudando a personas para aprender. <h1><b>Help to Know!</b></h1></h2>
                </div>
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container -->
    </section>
    
   <section class="services bg-primary" id="registro">
        <div class="container">
        <div class="row text-center">
            <div class="col-lg-8 col-lg-offset-2">
                <h1>Registro</h1>
            </div>
        </div>    
        <div class="row">
        <div class="col-lg-6 col-lg-offset-3">
        <hr class="small">
        <form role="form" action="./registro.php" method="POST" id="formularioRegistrarse">
            
        <div class="alert alert-info alert-dismissable" id="panelAlertas" <?php echo (!isset($error)) ? 'style="display: none;"' : ''; ?> >
            <a class="panel-close close" data-dismiss="alert">×</a>
            <?php echo (isset($error)) ? $error : ''; ?>
        </div>
            
        <div class="row">
            <div class="col-xs-6 col-sm-6 col-md-6">
                <div class="form-group">
                    <input type="text" name="registroNombre" id="registroNombre" class="form-control input-lg" placeholder="Nombre" value="<?php echo (isset($_POST['registroNombre'])) ? $_POST['registroNombre'] : ''; ?>">  
                </div>
            </div>
            <div class="col-xs-6 col-sm-6 col-md-6">
                <div class="form-group">
                    <input type="text" name="registroApellidos" id="registroApellidos" class="form-control input-lg" placeholder="Apellidos" value="<?php echo (isset($_POST['registroApellidos'])) ? $_POST['registroApellidos'] : ''; ?>">
                </div>
            </div>
        </div>

        <div class="form-group">
            <input type="email" name="registroEmail" id="registroEmail" class="form-control input-lg" placeholder="Email" value="<?php echo (isset($_POST['registroEmail'])) ? $_POST['registroEmail'] : ''; ?>">
        </div>
        <div class="form-group">
            <input type="text" name="registroNick" id="registroNick" class="form-control input-lg" placeholder="Nick" value="<?php echo (isset($_POST['registroNick'])) ? $_POST['registroNick'] : ''; ?>">
        </div>
        <div class="row">
            <div class="col-xs-6 col-sm-6 col-md-6">
                <div class="form-group">
                    <input type="password" name="registroPassword" id="registroPassword" class="form-control input-lg" placeholder="Contraseña" value="<?php echo (isset($_POST['registroPassword'])) ? $_POST['registroPassword'] : ''; ?>">
                </div>
            </div>
            <div class="col-xs-6 col-sm-6 col-md-6">
                <div class="form-group">
                    <input type="password" name="registroPass_con" id="registroPass_con" class="form-control input-lg" placeholder="Repetir Contraseña" value="<?php echo (isset($_POST['registroPass_con'])) ? $_POST['registroPass_con'] : ''; ?>">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-6 col-sm-6 col-md-6">
                <div class="form-group">
                    <select id="registroIslas" name="registroIslas" class="form-control input-lg">
                            <option value="0">Seleccione isla</option>
                            <?php
                                $consulta = "SELECT * FROM auxislas ORDER BY nombre";
                                $result = $db->prepare($consulta);
                                $result->execute();
                                $arrayResult = $result->fetchAll();
                                for($i=0;$i<$result->rowCount();$i++){
                                    echo '<option value="'.$arrayResult[$i]['id'].'"';
                                    if($arrayResult[$i]['id'] == $_POST['registroIslas']){
                                        echo 'selected="selected" ';
                                    }
                                    echo '>'.$arrayResult[$i]['nombre'].'</option>';
                                }
                            ?>
                    </select>
                </div>
            </div>
            <div class="col-xs-6 col-sm-6 col-md-6">
                <div class="form-group" id="cajaRegistroMunicipio">
                    <select id="registroMunicipios" name="registroMunicipios" class="form-control input-lg" <?php echo (!isset($_POST['registroMunicipios'])) ? 'disabled' : ''; ?>>
                        <?php
                        if(isset($_POST['registroMunicipios'])){
                            $consulta = "SELECT * FROM auxmunicipios WHERE idisla = :isla ORDER BY nombre";
                            $result = $db->prepare($consulta);
                            $result->execute(array(':isla' => $_POST['registroIslas']));
                            $arrayResult = $result->fetchAll();
                            for($i=0;$i<$result->rowCount();$i++){
                                echo '<option value="'.$arrayResult[$i]['id'].'"';
                                if($arrayResult[$i]['id'] == $_POST['registroMunicipios']){
                                    echo 'selected="selected" ';
                                }
                                echo '>'.$arrayResult[$i]['nombre'].'</option>';
                            }
                        }else{
                            echo '<option value="0">Seleccione municipio</option>';
                        }
                        ?>
                    </select>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12" align="center">
                <div class="form-group">
                    <div class="g-recaptcha" data-sitekey="6LecTAcTAAAAAFKmIACHrD4FhxgRTtNSdcVXUMss"></div>
                </div>
            </div>
        </div>
        <input id="registrarseBoton" type="submit" value="Registrarse" class="btn btn-lg btn-light btn-block">
        <hr>
        <div class="form-group">
            <div class="row">
                <div class="col-lg-4 col-lg-offset-2 col- text-center" style="padding: 6px 0px 6px 0px">
                    <a href='php/miFacebook.php' class="btn btn-light facebook"> <i class="fa fa-facebook modal-icons"></i> Entrar con Facebook </a>
                </div>
                <div class="col-lg-4 text-center" style="padding: 6px 0px 6px 0px">
                    <a href='php/miGoogle.php' class="btn btn-light google"> <i class="fa fa-google-plus modal-icons"></i> Entrar con Google </a>
                </div>
            </div>
        </div>
    </form>
    </div>
    </div>
   </div>
    </section>
    <!-- Footer -->
    <footer>
        <div id="contacto" class="container">
            <div class="row">
                <div class="col-lg-10 col-lg-offset-1 text-center">
                    <h4><strong>Help to know</strong>
                    </h4>
                    <p>P. SHERMAN, CALLE WALLABY 42,<br>SYDNEY, AU 90210</p>
                    <ul class="list-unstyled">
                        <li><i class="fa fa-phone fa-fw"></i> (123) 456-7890</li>
                        <li><i class="fa fa-envelope-o fa-fw"></i>  <a href="#modalContacto" id="btnContacto">Contacto</a>
                        <li><span><a href="">Uso de la web</a></span><span> / <a href="#">Ayuda</a></span></li>
                        </li>
                    </ul>
                    <br>
                    <ul class="list-inline">
                        <li>
                            <a href="https://www.facebook.com/pages/Help-to-know/1615724538676574?ref=hl"><i class="fa fa-facebook fa-fw fa-3x"></i></a>
                        </li>
                        <li>
                            <a href="https://twitter.com/?lang=es"><i class="fa fa-twitter fa-fw fa-3x"></i></a>
                        </li>
                    </ul>
                    <hr class="small">
                    <p class="text-muted">Copyright &copy; Help to Know! 2015</p>
                </div>
            </div>
        </div>
    </footer>

    <!-- Modal Inicio Sesión-->
    <div class="modal fade" id="modalEntrar" role="dialog">
        <div class="modal-dialog">
          <!-- Modal content-->
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              <div class="row">
                  <div class="col-lg-4 col-lg-offset-4 text-center">
                    <img src="../../img/img_pagina/logo.png" alt="Logo" width="180" height="95">
                  </div>
              </div>
            </div>
            <div class="modal-body">
                  <form class="form" action="./php/sesion/login.php" method="POST" id="formularioEntrar">
                    <div class="form-group" id="cajaEmailEntrar">
                        <div class="inner-addon left-addon">
                            <i class="glyphicon glyphicon-user"></i>
                            <input type="text" id="entrarEmail" name="entrarEmail" class="form-control input-lg" placeholder="Email"/>
                        </div>
                    </div>
                    <div class="form-group" id="cajaPassEntrar">
                        <div class="inner-addon left-addon">
                            <i class="glyphicon glyphicon-lock"></i>
                            <input id="entrarPass" name="entrarPass" type="password" class="form-control input-lg" placeholder="Password"/>
                        </div>
                    </div>
                    <div class="form-group">
                      <button id="entrarBoton" class="btn btn-lg btn-light btn-block">Iniciar sesión</button>
                      <span class="pull-right"><a href="" id="entrarRegistrarse">Registrarse</a></span><span><a href="#">Ayuda</a></span>
                    </div>
                    <hr>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-lg-4 col-lg-offset-2 text-center" style="padding: 6px 0px 6px 0px">
                                <a href='./php/miFacebook.php' class="btn btn-light facebook"> <i class="fa fa-facebook modal-icons"></i> Entrar con Facebook </a>
                            </div>
                            <!--<div class="col-lg-4 text-center" style="padding: 6px 0px 6px 0px">
                                <a href='#' class="btn btn-light twitter"> <i class="fa fa-twitter modal-icons"></i> Entrar con Twitter </a>
                            </div>-->
                            <div class="col-lg-4 text-center" style="padding: 6px 0px 6px 0px">
                                <a href='./php/miGoogle.php' class="btn btn-light google"> <i class="fa fa-google-plus modal-icons"></i> Entrar con Google </a>
                            </div>
                        </div>
                    </div>
                  </form>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-lg btn-dark" data-dismiss="modal" id="entrarCancelar">Cancelar</button>
            </div>
          </div>
        </div>
    </div>
        
    <!-- Modal Contacto-->
    <div class="modal fade" id="modalContacto" role="dialog">
        <div class="modal-dialog">
          <!-- Modal content-->
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              <div class="row">
                  <div class="col-lg-4 col-lg-offset-4 text-center">
                    <img src="../../img/img_pagina/logo.png" alt="Logo" width="180" height="95">
                    <h3 class="modal-title"><b>Contacto</b></h3>
                  </div>
              </div>
            </div>
            <div class="modal-body">
                  <form class="form" action="php/contacto.php" method="POST" id="formularioContacto">
                    <div class="form-group" id="cajaNombreContacto">
                        <input name="nombreContacto" type="text" id="nombreContacto" class="form-control input-lg" placeholder="Nombre"/>
                    </div>
                    <div class="form-group" id="cajaEmailContacto">
                        <input name="emailContacto" type="text" id="emailContacto" class="form-control input-lg" placeholder="Email"/>
                    </div>
                    <div class="form-group" id="cajaAsuntoContacto">
                        <input name="asuntoContacto" type="text" id="asuntoContacto" class="form-control input-lg" placeholder="Asunto"/>
                    </div>
                    <div class="form-group" id="cajaMensajeContacto">
                        <textarea name="mensajeContacto" class="form-control" id="mensajeContacto"rows="3" placeholder="Mensaje..."></textarea>
                    </div>
                    <div class="form-group">
                        <button id="enviarFormularioContacto" class="btn btn-lg btn-light btn-block">Enviar</button>
                    </div>
                  </form>
            </div>
            <div class="modal-footer">
              <button id="cancelarContacto" type="button" class="btn btn-lg btn-dark" data-dismiss="modal">Cancelar</button>
            </div>
          </div>
        </div>
    </div>
        
    <!-- Modal Información-->
    <div class="modal fade" id="modalInfo" role="dialog">
        <div class="modal-dialog">
          <!-- Modal content-->
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              <div class="row">
                  <div class="col-lg-4 col-lg-offset-4 text-center">
                    <img src="../../img/img_pagina/logo.png" alt="Logo" width="180" height="95">
                  </div>
              </div>
            </div>
            <div class="modal-body">
                  <div id="mensajeInfo"></div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-lg btn-dark" data-dismiss="modal">Cerrar</button>
            </div>
          </div>
        </div>
    </div>
        
    <!-- jQuery -->
    <script src="../../js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="../../js/bootstrap.min.js"></script>
    
    <!-- Mis archivos JavaScript -->
    <script type="text/javascript" src="../../js/registro.js"></script>
        
    <!-- Custom Theme JavaScript -->
    <script>
    // Closes the sidebar menu
    $("#menu-close").click(function(e) {
        e.preventDefault();
        $("#sidebar-wrapper").toggleClass("active");
    });

    // Opens the sidebar menu
    $("#menu-toggle").click(function(e) {
        e.preventDefault();
        $("#sidebar-wrapper").toggleClass("active");
    });

    // Scrolls to the selected menu item on the page
    $(function() {
        $('a[href*=#]:not([href=#])').click(function() {
            if (location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '') || location.hostname == this.hostname) {

                var target = $(this.hash);
                target = target.length ? target : $('[name=' + this.hash.slice(1) + ']');
                if (target.length) {
                    $('html,body').animate({
                        scrollTop: target.offset().top
                    }, 1000);
                    return false;
                }
            }
        });
    });
    </script>

</body>

</html>