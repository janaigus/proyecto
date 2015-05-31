<?php
    session_start();
    // Obtener el usuario sobre el que se va a maquetar la imagen
    $usuario = (isset($_GET['usuario'])) ? $_GET['usuario'] : "1";
    // Obtener variables con los parametros de la sesión del usuario
    $sesionNombre = (isset($_SESSION['nombreh2k'])) ? $_SESSION['nombreh2k'] : "";
    $sesionRol = (isset($_SESSION['rolh2k'])) ? (int)$_SESSION['rolh2k'] : "";
    $sesionMunicipio = (isset($_SESSION['municipioh2k'])) ? (int)$_SESSION['municipioh2k'] : "";
    $sesionIsla = (isset($_SESSION['islah2k'])) ? (int)$_SESSION['islah2k'] : "";
    $sesionTiempo = (isset($_SESSION['tiempoh2k'])) ? $_SESSION['tiempoh2k'] : "";

    // Traer elementos de la base de datos
    require('../bd/conexionBDlocal.php');
    $db = conectaDb();
    if(isset($_POST['nombre'])){
        $campos = array('email','nick','nombre','apellidos','password');
        // Recorrer los campos haciendo los updates necesarios
        // Realizar el update sobre el propio formulario
        for($i=0;$i<count($campos);$i++){
            if($_POST[$campos[$i]] != ""){
                $consulta = 'UPDATE  usuarios SET '.$campos[$i].' = :valor WHERE id = '.$usuario;
                $result = $db->prepare($consulta);
                $resultado = $result->execute(array(':valor' => $_POST[$campos[$i]]) );
            }
        }
        // Hacer lo mismo con el avatar
        // Si el archivo se ha encontrado tener la ruta con el nuevo nombre
        // Importante subir el archivo a la ruta img/img_usuarios/avatares/
        /*$tmp_name = $_FILES["archivoAvatar"]["name"];
        $arrayNombre = explode(".", $tmp_name);
        $ruta = $_POST['nick']."avatar".$arrayNombre[count($arrayNombre) - 1];
        // Mover el archivo despuesde realizar la consulta
        if(!move_uploaded_file($tmp_name, "img/img_usuarios/avatares/$name")){
            $mensaje = '<span class="glyphicon glyphicon-remove-circle"></span> '.$name.' | No se ha podido subir el archivo correctamente<br />';
        }else{
            $mensaje = '<span class="glyphicon glyphicon-ok-circle"></span> '.$name.' | Completado correctamente<br/>';
        }*/
    }else{
        $consulta = "SELECT * FROM usuarios WHERE id = :usuario ORDER BY nombre";
        $result = $db->prepare($consulta);
        $result->execute(array(':usuario' => $usuario));
        $arrayResult = $result->fetchAll();
        $nombreUsuario = $arrayResult[0]['nombre'];
        $apellidosUsuario = $arrayResult[0]['apellidos'];
        $nickUsuario = $arrayResult[0]['nick'];
        $emailUsuario = $arrayResult[0]['email'];
        $idIsla = $arrayResult[0]['idisla'];
        $idMunicipio = $arrayResult[0]['idmunicipio'];
        $avatarUsuario = $arrayResult[0]['avatar'];
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
    <link href="http://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,700,300italic,400italic,700italic" rel="stylesheet" type="text/css">

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
                <a href="#perfil" onclick = $("#menu-close").click(); >Perfil</a>
            </li>
            <li>
                <a href="#contacto" onclick = $("#menu-close").click(); >Contacto</a>
            </li>
            <hr>
            
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
    
    <!-- Perfil -->
    <!-- The circle icons use Font Awesome's stacked icon classes. For more information, visit http://fontawesome.io/examples/ -->
    <section id="perfil" class="services bg-primary">
        <div class="container">
          <h1 class="page-header text-center">Editar Perfil</h1>
          <div class="row">
            <form class="form-horizontal" role="form" action="./perfil.php" method="POST" id="formularioPerfil">
            <!-- left column -->
            <div class="col-md-4 col-sm-6 col-xs-12">
              <div class="text-center">
                <img src="../../<?php echo $avatarUsuario; ?>" class="avatar img-circle img-thumbnail" alt="avatar" height="200px" width="200px">
                <h6>Subir otra foto...</h6>
                <input type="file" name="archivoAvatar" id="archivoAvatar" class="text-center center-block well well-sm" style="color: black;" disabled="disabled">
              </div>
            </div>
            <!-- edit form column -->
            <div class="col-md-8 col-sm-6 col-xs-12 personal-info">
              <div class="alert alert-info alert-dismissable" id="panelAlertas" style="display:none;">
                <a class="panel-close close" data-dismiss="alert">×</a> 
                <i class="fa fa-coffee"></i>
                Esto es una <strong>.alerta</strong>. Usar para mandar mensajes importantes al usuario
              </div>
              <h3>Información </h3>
                <div class="form-group">
                  <label class="col-lg-3 control-label" for="nombre">Nombre:</label>
                  <div class="col-lg-8">
                    <input class="form-control" name="nombre" id="nombre" value="<?php echo $nombreUsuario; ?>" type="text" disabled="disabled">
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-lg-3 control-label" for="apellidos">Apellidos:</label>
                  <div class="col-lg-8">
                    <input class="form-control" name="apellidos" id="apellidos" value="<?php echo $apellidosUsuario; ?>" type="text" disabled="disabled">
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-lg-3 control-label" for="nick">Nick:</label>
                  <div class="col-lg-8">
                    <input class="form-control" name="nick" id="nick" value="<?php echo $nickUsuario; ?>" type="text" disabled="disabled">
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-lg-3 control-label" for="email" >Email:</label>
                  <div class="col-lg-8">
                    <input class="form-control" name="email" id="email" value="<?php echo $emailUsuario; ?>" type="text" disabled="disabled">
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-md-3 control-label" for="password">Contraseña:</label>
                  <div class="col-md-8">
                    <input class="form-control" name="password" id="password" value="11111122333" type="password" disabled="disabled">
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-md-3 control-label" for="confirmPass">Repetir contraseña:</label>
                  <div class="col-md-8">
                    <input class="form-control" name="confirmPass" id="confirmPass" value="11111122333" type="password" disabled="disabled">
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-md-3 control-label"></label>
                  <div class="col-md-6">
                    <input class="btn btn-lg btn-dark" id="guardarCambios" value="Guardar cambios" type="button" style="visibility: hidden;">
                  </div>
                  <div class="col-md-1" style="padding-top: 13px;">
                    <div class="dropup">
                      <button class="btn btn-light dropdown-toggle" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-expanded="true">
                          <span class="glyphicon glyphicon-option-vertical"></span>  
                          Opciones
                      </button>
                      <ul class="dropdown-menu" role="menu" aria-labelledby="options">
                        <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Darme de baja</a></li>
                        <li role="presentation" class="divider"></li>
                        <li role="presentation"><a role="menuitem" tabindex="-1" href="#" id="cambiarInfo">Cambiar información</a></li>
                      </ul>
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
    <script type="text/javascript" src="../../js/perfil.js"></script>
        
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