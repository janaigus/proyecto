<?php
    session_start();
    // Obtener variables con los parametros de la sesión del usuario
    $sesionId = (isset($_SESSION['idh2k'])) ? $_SESSION['idh2k'] : "";
    $sesionNick = (isset($_SESSION['nickh2k'])) ? $_SESSION['nickh2k'] : "";
    $sesionNombre = (isset($_SESSION['nombreh2k'])) ? $_SESSION['nombreh2k'] : "";
    $sesionRol = (isset($_SESSION['rolh2k'])) ? (int)$_SESSION['rolh2k'] : "";
    $sesionMunicipio = (isset($_SESSION['municipioh2k'])) ? (int)$_SESSION['municipioh2k'] : "";
    $sesionIsla = (isset($_SESSION['islah2k'])) ? (int)$_SESSION['islah2k'] : "";
    $sesionTiempo = (isset($_SESSION['tiempoh2k'])) ? $_SESSION['tiempoh2k'] : "";
    // Traer elementos de la base de datos
    require('../bd/conexionBDlocal.php');
    $db = conectaDb();

    if(isset($_POST['si']) and $_POST['si'] == "Si"){
        // Array para guardar las actividades que son del usuario y que serán borradas
        $indicesActividades = array();
        // Obtener las actividades del usuario
        $consulta = "SELECT id FROM actividades WHERE idusuario = :usuario";
        $result = $db->prepare($consulta);
        $result->execute(array(":usuario" => $sesionId));
        $arrayResult = $result->fetchAll();
        $arrayActividades = $arrayResult;
        
        // Comenzar borrando los votos
        $consulta = "DELETE FROM votos WHERE idusuario = :usuario";
        $result = $db->prepare($consulta);
        $result->bindParam(":usuario", $sesionId, PDO::PARAM_STR);
        $result->execute();
        
        
        // Luego borrar los comentarios
        $consulta = "DELETE FROM comentarios WHERE idusuario = :usuario";
        $result = $db->prepare($consulta);
        $result->bindParam(":usuario", $sesionId, PDO::PARAM_STR);
        $result->execute();
        
        for($i=0;$i < count($arrayActividades);$i++){
            // Borrar los recursos de esas actividades y luego las propias actividades
            $consulta = "DELETE FROM recursos WHERE idactividad = :actividad";
            $result = $db->prepare($consulta);
            $result->bindParam(":actividad", $arrayActividades[$i]['id'], PDO::PARAM_STR);
            $result->execute();            
        }
        
        for($i=0;$i < count($arrayActividades);$i++){
            // Borrar las actividades 
            $consulta = "DELETE FROM actividades WHERE id = :actividad";
            $result = $db->prepare($consulta);
            $result->bindParam(":actividad", $arrayActividades[$i]['id'], PDO::PARAM_STR);
            $result->execute(); 
        }
        // Borrar el usuario del sistema
        $consulta = "DELETE FROM usuarios WHERE id = :usuario";
        $result = $db->prepare($consulta);
        $result->bindParam(":usuario", $sesionId, PDO::PARAM_STR);
        $result->execute();
        
        session_destroy();
        header('Location: ../../index.php');
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

    <!-- About -->
    <section id="about" class="about">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2>Ayudando a personas para aprender. <h1><b>Help to Know!</b></h1></h2>
                    <p class="lead">Aqui podrás encontrar desde una clase de costura, </br>hasta un curso profesional de desarrollo web </br>con certificación internacional</p>
                </div>
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container -->
    </section>
    
    <!-- Portfolio -->
    <section id="islas" class="portfolio">
        <div class="container">
            <div class="row">
                <div class="col-lg-10 col-lg-offset-1 text-center">
                    <h2>¿Está seguro que desea borrar su perfil?</h2>
                    <p class="lead">Si hace esto, toda sus actividad, valoraciones y comentarios serán borrados completamente de Help to Know.</p>
                    <hr class="small">
                    <form class="form" action="./borrarperfil.php" method="POST">
                        <input type="submit" class="btn btn-lg btn-danger" value="Si" name="si"/>
                        <a href="" class="btn btn-lg btn-light">No</a>
                    </form>
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container -->
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
    <script type="text/javascript" src="../../js/borrarperfil.js"></script>


</body>

</html>