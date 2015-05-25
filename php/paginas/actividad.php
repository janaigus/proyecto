<?php
    session_start();
    // Obtener la isla sobre la que se va a maquetar la imagen y la pagina actual
    $idActividad = (isset($_GET['actividad'])) ? $_GET['actividad'] : "1";
    // Traer elementos de la base de datos
    require('../bd/conexionBDlocal.php');
    $db = conectaDb();

    // Obtener la información completa de la actividad incluyendo votos y valoraciones
    $consulta = "SELECT * FROM auxislas where id = :isla ORDER BY nombre";
    $result = $db->prepare($consulta);
    $result->execute(array(':isla' => $isla));
    $arrayResult = $result->fetchAll();
    $idIsla = $arrayResult[0]['id'];
    $nombreIsla = $arrayResult[0]['nombre'];

    $consulta = "SELECT act.id, act.titulo, act.descripcion, DATE_FORMAT(act.created, '%d-%m-%Y') AS creada, r.ruta, ";
    $consulta .= "cat.nombre AS categoria, COUNT( v.id ) AS veces, ROUND( AVG( v.valoracion ) ) AS media ";
    $consulta .= "FROM actividades act ";
    $consulta .= "LEFT JOIN votos v ON act.id = v.idactividad ";
    $consulta .= "LEFT JOIN recursos r ON act.id = r.idactividad ";
    $consulta .= "LEFT JOIN auxcategorias cat ON act.idcategoria = cat.id ";
    $consulta .= "WHERE act.id = :actividad ";
    $result = $db->prepare($consulta);
    $result->execute(array(':actividad' => $idActividad));
    $arrayResult = $result->fetchAll();
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
                <a href="#top" onclick = $("#menu-close").click(); >Home</a>
            </li>
            <li>
                <a href="#contacto" onclick = $("#menu-close").click(); >Contacto</a>
            </li>
            <hr>
            <li>
                <a id="btnEntrar" href="#modalEntrar">Iniciar Sesión</a>
            </li>
            <li>
                <a id="btnLateralRegistrarse" href="#modalRegistrarse">Registrarse</a>
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
        
    <!-- Mejor valoradas -->
    <!-- The circle icons use Font Awesome's stacked icon classes. For more information, visit http://fontawesome.io/examples/ -->
    <section id="valoradas" class="services bg-primary">
        <div class="container">
            <div class="row text-center">
                <div class="col-lg-10 col-lg-offset-1">
                    <div class="row">
                    </div>
                    <!-- /.row (nested) -->
                </div>
                <!-- /.col-lg-10 -->
            <div class="row">

            <div class="col-md-10 col-lg-offset-1" style="color:black;text-align: left;">
            <div class="thumbnail" style="padding: 20px 20px 20px 20px;">
                <div class="caption-full">
                <?php
                echo '<div class="item">';
                echo '    <div class="row">';
                echo '       <div class="col-xs-12 col-sm-12 col-md-6">';
                echo '            <a href=""> <img src="../../'.$arrayResult[0]['ruta'].'" class="thumbnail" alt="Image" height="280px" width="450px" /></a>';
                echo '       </div>';
                echo '       <div class="col-xs-12 col-sm-12 col-md-6" style="text-align: left;">';
                echo '            <h3>'.$arrayResult[0]['titulo'].'<h5>'.$arrayResult[0]['creada'].'</h5></h3>';
                echo '            <h4>'.$arrayResult[0]['categoria'].'</h4>';
                echo '            <p>'.$arrayResult[0]['descripcion'].'</p>';
                echo '            <div class="ratings">';
                echo '                <p class="pull-right" style="color:#000">'.$arrayResult[0]['veces'].' veces valorado</p>';
                echo '                <p>';
                for($i = 0;$i < 5;$i++){
                    if($i < $arrayResult[0]['media']){
                        echo '<span class="glyphicon glyphicon-star"></span>';
                    }else{
                        echo '<span class="glyphicon glyphicon-star-empty"></span>';
                    }
                }                 
                echo '               </p>';
                echo '           </div>';
                echo '       </div>';
                echo '    </div>';
                echo '</div>';
                ?>
                    
                </div>
            </div>

            <div class="well">
                <textarea class="form-control" rows="3" style="resize:vertical;" placeholder="Comentario"></textarea>
                <div class="ratings" style="padding-top: 10px;">
                    <p>
                        <span class="glyphicon glyphicon-star"></span>
                        <span class="glyphicon glyphicon-star"></span>
                        <span class="glyphicon glyphicon-star"></span>
                        <span class="glyphicon glyphicon-star"></span>
                        <span class="glyphicon glyphicon-star-empty"></span>
                    </p>
                </div>
                <div class="text-right">
                    <a class="btn btn-success">Enviar comentario</a>
                </div>

                <hr>
        <?php 
        $consulta =  "SELECT com.texto, DATE_FORMAT( com.created,  '%d-%m-%Y a las %k:%i' ) AS fecha, usr.nombre, usr.apellidos, usr.avatar ";
        $consulta .= "FROM comentarios com ";
        $consulta .= "INNER JOIN usuarios usr ON com.idusuario = usr.id ";
        $consulta .= "WHERE com.idactividad = :actividad ";
        $consulta .= "ORDER BY com.created DESC ";
        $result = $db->prepare($consulta);
        $result->execute(array(':actividad' => $idActividad));
        $arrayResult = $result->fetchAll();
        if($result->rowCount() != 0){
            for($i = 0;$i < $result->rowCount();$i++){
                echo '<div class="well" style="background-color: rgb(220, 246, 216);">';
                echo '<h3><img src="../../'.$arrayResult[$i]['avatar'].'" alt="..." class="img-circle" height="30px" width="35px">'.$arrayResult[$i]['nombre'].' '.$arrayResult[$i]['apellidos'].'</h3>';
                echo '<span class="pull-right">'.$arrayResult[$i]['fecha'].'</span>';
                echo '<p>'.$arrayResult[$i]['texto'].'</p>';
                echo '</div>';
            }
        }else{
            echo '<div class="well" style="background-color: rgb(220, 246, 216);">';
            echo '<h3>No hay comentarios en la actividad.</h3>';
            echo '</div>';
        }
        ?>
                

                <hr>
            </div>

            </div>

        </div>
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
    <script type="text/javascript" src="../../js/actividad.js"></script>
        
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