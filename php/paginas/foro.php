<?php
    session_start();
    // Obtener la isla sobre la que se va a maquetar la imagen y la pagina actual
    $categoria = (isset($_GET['categoria'])) ? $_GET['categoria'] : "1";
    $isla = (isset($_GET['isla'])) ? $_GET['isla'] : "1";
    $pagina = (isset($_GET['pagina'])) ? (int)$_GET['pagina'] : 1;
    // Obtener variables con los parametros de la sesión del usuario
    $sesionNombre = (isset($_SESSION['nombre'])) ? $_SESSION['nombre'] : "";
    $sesionRol = (isset($_SESSION['rol'])) ? (int)$_SESSION['rol'] : "";
    $sesionMunicipio = (isset($_SESSION['municipio'])) ? (int)$_SESSION['municipio'] : "";
    $sesionIsla = (isset($_SESSION['isla'])) ? (int)$_SESSION['isla'] : "";
    $sesionTiempo = (isset($_SESSION['tiempo'])) ? $_SESSION['tiempo'] : "";
    // Traer elementos de la base de datos
    require('../bd/conexionBDlocal.php');
    $db = conectaDb();

    // Saber el nombre de los campos de las categorias 
    $consulta = "SELECT * FROM auxcategorias WHERE id = :categoria";
    $result = $db->prepare($consulta);
    $result->execute(array(':categoria' => $categoria));
    $arrayResult = $result->fetchAll();
    $idCategoria = $arrayResult[0]['id'];
    $nombreCategoria = $arrayResult[0]['nombre'];
    
    // Saber el nombre de los campos de las islas
    $consulta = "SELECT * FROM auxislas WHERE id = :isla";
    $result = $db->prepare($consulta);
    $result->execute(array(':isla' => $isla));
    $arrayResult = $result->fetchAll();
    $idIsla = $arrayResult[0]['id'];
    $nombreIsla = $arrayResult[0]['nombre'];

    $consulta = "SELECT COUNT(id) as total FROM actividades WHERE idcategoria = :categoria AND idisla = :isla";
    $result = $db->prepare($consulta);
    $result->execute(array(':categoria' => $categoria, ':isla' => $isla));
    $arrayResult = $result->fetchAll();
    $totalActividades = $arrayResult[0]['total'];
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
                    <p class="lead">Aqui podrás encontrar desde una clase de costura, </br>hasta un curso profesional de desarrollo web </br>con certificación internacional</p>
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
                    <h1><?php echo $nombreCategoria." en ".$nombreIsla; ?></h1>
                    <hr class="small">
                    <div>
                        <button class="btn btn-lg btn-light" type="submit">Publicar Actividad</button>
                    </div>
                    <div class="row">
                        <hr>
                        <?php
                        $consulta = "SELECT act.id, act.titulo, act.descripcion, DATE_FORMAT(act.created, '%d-%m-%Y') AS creada, r.ruta, ";
                        $consulta .= "cat.nombre AS categoria, COUNT( v.id ) AS veces, ROUND( AVG( v.valoracion ) ) AS media, ";
                        $consulta .= "act.idisla, i.nombre, m.nombre as nombremunicipio ";
                        $consulta .= "FROM actividades act ";
                        $consulta .= "LEFT JOIN votos v ON act.id = v.idactividad ";
                        $consulta .= "LEFT JOIN recursos r ON act.id = r.idactividad ";
                        $consulta .= "LEFT JOIN auxcategorias cat ON act.idcategoria = cat.id ";
                        $consulta .= "INNER JOIN auxislas i ON act.idisla = i.id ";
                        $consulta .= "INNER JOIN auxmunicipios m ON act.idmunicipio = m.id ";
                        $consulta .= "WHERE act.idcategoria = :categoria AND act.idisla = :isla ";
                        $consulta .= "GROUP BY act.id ";
                        $consulta .= "ORDER BY act.created DESC ";
                        $consulta .= "LIMIT ".(3)." OFFSET ".(($pagina-1) * 3);
                        $result = $db->prepare($consulta);
                        $result->execute(array(':categoria' => $idCategoria, ':isla' => $idIsla) );
                        $arrayResult = $result->fetchAll();
                        // Comprobar que existan actividades o colocar en vacio
                        if($result->rowCount() != 0){
                            // Más Recientes 
                            for($z=0;$z<$result->rowCount();$z++){
                                if($z == 0){
                                    echo '<div class="item active">';
                                }else{
                                    echo '<div class="item">';
                                }
                                echo '    <div class="row">';
                                echo '       <div class="col-xs-12 col-sm-12 col-md-6">';
                                echo '            <a href="./actividad.php?actividad='.$arrayResult[$z]['id'].'"> <img src="../../'.$arrayResult[$z]['ruta'].'" class="thumbnail" alt="Image" height="280px" width="450px" /></a>';
                                echo '       </div>';
                                echo '       <div class="col-xs-12 col-sm-12 col-md-6" style="text-align: left;">';
                                echo '            <h3>'.$arrayResult[$z]['titulo'].'<h5>'.$arrayResult[$z]['creada'].'</h5></h3>';
                                echo '            <h4>'.$arrayResult[$z]['categoria'].'</h4>';
                                echo '            <p>'.$arrayResult[$z]['descripcion'].'</p>';
                                echo '            <div class="ratings">';
                                echo '                <p class="pull-right" style="color:#fff">'.$arrayResult[$z]['veces'].' veces valorado</p>';
                                echo '                <p>';
                                for($i = 0;$i < 5;$i++){
                                    if($i < $arrayResult[$z]['media']){
                                        echo '<span class="glyphicon glyphicon-star"></span>';
                                    }else{
                                        echo '<span class="glyphicon glyphicon-star-empty"></span>';
                                    }
                                }                 
                                echo '               </p>';
                                echo '           </div>';
                                echo '       <a href="./actividad.php?actividad='.$arrayResult[$z]['id'].'" class="btn btn-lg btn-light">Ver más<span class="glyphicon glyphicon-chevron-right"></span></a>';
                                echo '       </div>';
                                echo '    </div>';
                                echo '</div>';
                                echo '<hr>';
                            }
                        }else{
                            echo "<h3>No se encuentran resultados de <h2>".$nombreCategoria."</h2> para <h2>".$nombreIsla."</h2> </h3>";
                        }
                        ?>

                        <!-- Pagination -->
                        <div class="row text-center">
                            <div class="col-lg-12">
                                <ul class="pagination">
                                    <?php 
                                        for($i=1;$i <= ceil($totalActividades / 3);$i++){
                                            if($i == $pagina){
                                                echo '<li class="active">';
                                            }else{
                                                echo '<li>';
                                            }
                                            echo '<a href="foro.php?categoria='.$categoria.'&isla='.$isla.'&pagina='.$i.'">'.$i.'</a>';
                                            echo '</li>';
                                        }
                                    ?>
                                </ul>
                            </div>
                        </div>
                        <!-- /.row -->
                    </div>
                    <!-- /.row (nested) -->
                </div>
                <!-- /.col-lg-10 -->
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
    <script type="text/javascript" src="../../js/foro.js"></script>
        
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