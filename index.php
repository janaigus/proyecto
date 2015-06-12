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
    require('php/bd/conexionBDlocal.php');
    $db = conectaDb();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>H2K</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="http://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,700,300italic,400italic,700italic" rel="stylesheet" type="text/css">

    <!-- Custom CSS -->
    <link href="css/index.css" rel="stylesheet">
    
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    
    <!-- Fichero de JS para la gestion del incio de sesion con las redes sociales -->
    <script type="text/javascript" src="js/social.js"></script>
    
    <!-- Api de google para recaptcha -->
    <script src='https://www.google.com/recaptcha/api.js'></script>
    
    <script>
      (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
      (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
      m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
      })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

      ga('create', 'UA-55175719-2', 'auto');
      ga('send', 'pageview');
    
    </script>
</head>

<body>

    <!-- Navigation -->
    <a id="menu-toggle" href="#" class="btn btn-dark btn-lg toggle"><i class="fa fa-bars"></i></a>
    <nav id="sidebar-wrapper">
        <ul class="sidebar-nav">
            <a id="menu-close" href="#" class="btn btn-light btn-lg pull-right toggle"><i class="fa fa-times"></i></a>
            <li class="sidebar-brand">
                <a href="#top"  onclick = $("#menu-close").click(); >Help to Know</a>
            </li>
            <li>
                <a href="#valoradas" onclick = $("#menu-close").click(); >Mejor Valoradas</a>
            </li>
            <li>
                <a href="#recientes" onclick = $("#menu-close").click(); >Más Recientes</a>
            </li>
            <li>
                <a href="#islas" onclick = $("#menu-close").click(); >Nuestras Islas</a>
            </li>
            <li>
                <a href="#busqueda" onclick = $("#menu-close").click(); >Buscar actividades</a>
            </li>
            <li>
                <a href="#contacto" onclick = $("#menu-close").click(); >Contacto</a>
            </li>
            <hr>
            <?php
            if($sesionNombre == ""){
                echo'
                <li>
                    <a id="btnEntrar" href="#modalEntrar">Iniciar Sesión</a>
                </li>
                <li>
                    <a id="btnLateralRegistrarse" href="./php/sesion/registro.php">Registrarse</a>
                </li>';
            }else{
                echo'
                    <li>
                        <a href="./php/paginas/perfil.php?usuario='.$sesionId.'">'.$sesionNick.'</a>
                    </li>
                    <li>
                        <a href="./php/sesion/cerrarsesion.php">Cerrar Sesión</a>
                    </li>
                    ';
            }
            if($sesionRol == "1"){
                echo'
                <hr>
                <li>
                    <a href="./php/paginas/administrador.php">Admnistrar Sitio</a>
                </li>';
            }
            ?>
        </ul>
    </nav>

    <!-- Header -->
    <header id="top" class="header">
        <div class="text-vertical-center">
            <h1><img src="img/img_pagina/logo.png" height="200" width="350"></h1>
            <h3>¿No encuentras esa actividad que siempre deseaste hacer?</br>Aquí la encontrarás</h3>
            <br>
            <a href="#about" class="btn btn-dark btn-lg">Saber más</a>
        </div>
    </header>

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
                    <h2>Actividades Mejor Valoradas</h2>
                    <hr class="small">
                    <div class="row">
                       <!-- Principio del carrousel -->
                       <div class="col-xs-12 col-sm-12 col-md-12">
                            <div id="myCarouselValoradas" class="vertical-slider carousel vertical slide col-md-12" data-ride="carousel">
                                <div class="row">
                                    <div class="col-md-4">
                                        <span data-slide="prev" class="btn-vertical-slider glyphicon glyphicon-circle-arrow-up "
                                            style="font-size: 30px"></span>  
                                    </div>
                                    <div class="col-md-8"> 
                                    </div>
                                </div>
                                <br />
                                
                                <!-- Carousel items -->
                                <div class="carousel-inner" id="itemsCarouselMejorValoradas">
                    <?php
                    $consulta = "SELECT act.id, act.titulo, act.descripcion, DATE_FORMAT(act.created, '%d-%m-%Y') AS creada, r.ruta, ";
                    $consulta .= "act.idcategoria, cat.nombre AS categoria, COUNT( v.id ) AS veces, ROUND( AVG( v.valoracion ) ) AS media, ";
                    $consulta .= "act.idisla, i.nombre AS nombreisla, m.nombre AS nombremunicipio ";
                    $consulta .= "FROM actividades act ";
                    $consulta .= "INNER JOIN votos v ON act.id = v.idactividad ";
                    $consulta .= "INNER JOIN recursos r ON act.id = r.idactividad ";
                    $consulta .= "INNER JOIN auxcategorias cat ON act.idcategoria = cat.id ";
                    $consulta .= "INNER JOIN auxislas i ON act.idisla = i.id ";
                    $consulta .= "INNER JOIN auxmunicipios m ON act.idmunicipio = m.id ";
                    $consulta .= "GROUP BY act.id ";
                    $consulta .= "ORDER BY AVG( v.valoracion ) DESC ";
                    $consulta .= "LIMIT 3";
                    $result = $db->prepare($consulta);
                    $result->execute();
                    $arrayResult = $result->fetchAll();
                    // Más Recientes 
                    for($z=0;$z<$result->rowCount();$z++){
                        if($z == 0){
                            echo '<div class="item active">';
                        }else{
                            echo '<div class="item">';
                        }
                        echo '    <div class="row">';
                        echo '       <div class="col-xs-12 col-sm-12 col-md-6">';
                        echo '            <a href="./php/paginas/actividad.php?actividad='.$arrayResult[$z]['id'].'"> <img src="'.$arrayResult[$z]['ruta'].'" class="img-thumbnail" alt="Image" style="height: 280px; width: 450px; margin-bottom:20px;" /></a>';
                        echo '       </div>';
                        echo '       <div class="col-xs-12 col-sm-12 col-md-6" style="text-align: left;">';
                        echo '            <h3>'.($z+1).". ".$arrayResult[$z]['titulo'].'</h3>';
                        echo '            <a href="php/paginas/foro.php?categoria='.$arrayResult[$z]['idcategoria'].'&isla='.$arrayResult[$z]['idisla'];
                        echo ' " style="color:white;">';
                        echo '            <h4>'.$arrayResult[$z]['categoria'].' en '.$arrayResult[$z]['nombreisla'].'</h4>';
                        echo '            </a>';
                        echo '            <h5>Creada el '.$arrayResult[$z]['creada'];
                        echo '            en '.$arrayResult[$z]['nombremunicipio'].', '.$arrayResult[$z]['nombreisla'].'</h5>';
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
                        echo '       <a href="./php/paginas/actividad.php?actividad='.$arrayResult[$z]['id'].'" class="btn btn-lg btn-light">Ver más<span class="glyphicon glyphicon-chevron-right"></span></a>';
                        echo '       </div>';
                        echo '    </div>';
                        echo '</div>';
                    }
                    ?>    
                                </div>
                                
                                <div class="row">
                                    <div class="col-md-4">
                                        <span data-slide="next" class="btn-vertical-slider glyphicon glyphicon-circle-arrow-down"
                                            style="color: Black; font-size: 30px"></span>
                                    </div>
                                    <div class="col-md-8">
                                    </div>
                                </div>
                            </div>
                            <!-- Fin del carrousel -->
                    </div>
                    <!-- /.row (nested) -->
                </div>
                <!-- /.col-lg-10 -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container -->
    </section>
    
    <!-- Callout -->
    <aside class="callout">
        <div class="text-vertical-center">
            <h1>Encuentra lo que deseas</h1>
        </div>
    </aside>
    
    <!-- Más Recientes -->
    <!-- The circle icons use Font Awesome's stacked icon classes. For more information, visit http://fontawesome.io/examples/ -->
    <section id="recientes" class="services bg-primary">
        <div class="container">
            <div class="row text-center">
                <div class="col-lg-10 col-lg-offset-1">
                    <h2>Actividades Más Recientes</h2>
                    <hr class="small">
                    <div class="row">
                       <!-- Principio del carrousel -->
                       <div class="col-xs-12 col-sm-12 col-md-12">
                            <div id="myCarouselRecientes" class="vertical-slider carousel vertical slide col-md-12" data-ride="carousel">
                                <div class="row">
                                    <div class="col-md-4">
                                        <span data-slide="prev" class="btn-vertical-slider glyphicon glyphicon-circle-arrow-up "
                                            style="font-size: 30px"></span>  
                                    </div>
                                    <div class="col-md-8"> 
                                    </div>
                                </div>
                                <br />
                                
                                <!-- Carousel items -->
                                <div class="carousel-inner" id="itemsCarouselMasRecientes">
                                
                    <?php
                    $consulta = "SELECT act.id, act.titulo, act.descripcion, DATE_FORMAT(act.created, '%d-%m-%Y') AS creada, r.ruta, ";
                    $consulta .= "act.idcategoria, cat.nombre AS categoria, COUNT( v.id ) AS veces, ROUND( AVG( v.valoracion ) ) AS media, ";
                    $consulta .= "act.idisla, i.nombre AS nombreisla, m.nombre AS nombremunicipio ";
                    $consulta .= "FROM actividades act ";
                    $consulta .= "LEFT JOIN votos v ON act.id = v.idactividad ";
                    $consulta .= "LEFT JOIN recursos r ON act.id = r.idactividad ";
                    $consulta .= "LEFT JOIN auxcategorias cat ON act.idcategoria = cat.id ";
                    $consulta .= "INNER JOIN auxislas i ON act.idisla = i.id ";
                    $consulta .= "INNER JOIN auxmunicipios m ON act.idmunicipio = m.id ";
                    $consulta .= "GROUP BY act.id ";
                    $consulta .= "ORDER BY act.created DESC ";
                    $consulta .= "LIMIT 3";
                    $result = $db->prepare($consulta);
                    $result->execute();
                    $arrayResult = $result->fetchAll();
                    // Más Recientes 
                    for($z=0;$z<$result->rowCount();$z++){
                        if($z == 0){
                            echo '<div class="item active">';
                        }else{
                            echo '<div class="item">';
                        }
                        echo '    <div class="row">';
                        echo '       <div class="col-xs-12 col-sm-12 col-md-6">';
                        echo '            <a href="./php/paginas/actividad.php?actividad='.$arrayResult[$z]['id'].'"> <img src="'.$arrayResult[$z]['ruta'].'" class="img-thumbnail" alt="Image" style="height: 280px; width: 450px; margin-bottom:20px;" /></a>';
                        echo '       </div>';
                        echo '       <div class="col-xs-12 col-sm-12 col-md-6" style="text-align: left;">';
                        echo '            <h3>'.($z+1).". ".$arrayResult[$z]['titulo'].'</h3>';
                        echo '            <a href="php/paginas/foro.php?categoria='.$arrayResult[$z]['idcategoria'].'&isla='.$arrayResult[$z]['idisla'];
                        echo ' " style="color:white;">';
                        echo '            <h4>'.$arrayResult[$z]['categoria'].' en '.$arrayResult[$z]['nombreisla'].'</h4>';
                        echo '            </a>';
                        echo '            <h5>Creada el '.$arrayResult[$z]['creada'];
                        echo '            en '.$arrayResult[$z]['nombremunicipio'].', '.$arrayResult[$z]['nombreisla'].'</h5>';
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
                        echo '       <a href="./php/paginas/actividad.php?actividad='.$arrayResult[$z]['id'].'" class="btn btn-lg btn-light">Ver más<span class="glyphicon glyphicon-chevron-right"></span></a>';
                        echo '       </div>';
                        echo '    </div>';
                        echo '</div>';
                    }
                    ?>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <span data-slide="next" class="btn-vertical-slider glyphicon glyphicon-circle-arrow-down"
                                            style="color: Black; font-size: 30px"></span>
                                    </div>
                                    <div class="col-md-8">
                                    </div>
                                </div>
                            </div>
                            <!-- Fin del carrousel -->
                    </div>
                    <!-- /.row (nested) -->
                </div>
                <!-- /.col-lg-10 -->
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
                    <h2>Islas</h2>
                    <hr class="small">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="portfolio-item">
                                <a href="./php/paginas/isla.php?isla=7" class="portfolio-box">
                                    <img src="img/img_pagina/islas/tenerife.png" class="img-responsive" alt="">
                                    <div class="portfolio-box-caption">
                                        <div class="portfolio-box-caption-content">
                                            <div class="project-category text-faded">
                                                Isla
                                            </div>
                                            <div class="project-name">
                                                Tenerife
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="portfolio-item">
                                <a href="./php/paginas/isla.php?isla=2" class="portfolio-box">
                                    <img src="img/img_pagina/islas/gran-canaria.png" class="img-responsive" alt="">
                                    <div class="portfolio-box-caption">
                                        <div class="portfolio-box-caption-content">
                                            <div class="project-category text-faded">
                                                Isla
                                            </div>
                                            <div class="project-name">
                                                Gran Canaria
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="portfolio-item">
                                <a href="./php/paginas/isla.php?isla=6" class="portfolio-box">
                                    <img src="img/img_pagina/islas/la-palma.png" class="img-responsive" alt="">
                                    <div class="portfolio-box-caption">
                                        <div class="portfolio-box-caption-content">
                                            <div class="project-category text-faded">
                                                Isla
                                            </div>
                                            <div class="project-name">
                                                La Palma
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="portfolio-item">
                                <a href="./php/paginas/isla.php?isla=1" class="portfolio-box">
                                    <img src="img/img_pagina/islas/fuerteventura.png" class="img-responsive" alt="">
                                    <div class="portfolio-box-caption">
                                        <div class="portfolio-box-caption-content">
                                            <div class="project-category text-faded">
                                                Isla
                                            </div>
                                            <div class="project-name">
                                                Fuerteventura
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="portfolio-item">
                                <a href="./php/paginas/isla.php?isla=5" class="portfolio-box">
                                    <img src="img/img_pagina/islas/el-hierro.png" class="img-responsive" alt="">
                                    <div class="portfolio-box-caption">
                                        <div class="portfolio-box-caption-content">
                                            <div class="project-category text-faded">
                                                Isla
                                            </div>
                                            <div class="project-name">
                                                El hierro
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="portfolio-item">
                                <a href="./php/paginas/isla.php?isla=3" class="portfolio-box">
                                    <img src="img/img_pagina/islas/lanzarote.png" class="img-responsive" alt="">
                                    <div class="portfolio-box-caption">
                                        <div class="portfolio-box-caption-content">
                                            <div class="project-category text-faded">
                                                Isla
                                            </div>
                                            <div class="project-name">
                                                Lanzarote
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                        <div class="col-md-6 col-md-offset-3">
                            <div class="portfolio-item">
                                <a href="./php/paginas/isla.php?isla=4" class="portfolio-box">
                                    <img src="img/img_pagina/islas/la-gomera.png" class="img-responsive" alt="">
                                    <div class="portfolio-box-caption">
                                        <div class="portfolio-box-caption-content">
                                            <div class="project-category text-faded">
                                                Isla
                                            </div>
                                            <div class="project-name">
                                                La Gomera
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.col-lg-10 -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container -->
    </section>
        
    <!-- Seccion de busqueda -->
    <!-- The circle icons use Font Awesome's stacked icon classes. For more information, visit http://fontawesome.io/examples/ -->
    <section id="busqueda" class="services bg-primary">
        <div class="container">
            <div class="row text-center">
                <div class="col-lg-10 col-lg-offset-1">
                    <h2>Busqueda de actividades</h2>
                    <hr class="small">
                    <div class="row">
                       <!-- Principio del carrousel -->
                       <div class="col-xs-12 col-sm-12 col-md-12">
                            <form class="form" action="php/paginas/busqueda.php" method="GET" id="formularioBusqueda">
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <select id="busquedaIslas" name="isla" class="form-control">
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <select id="busquedaMunicipios" name="municipio" class="form-control" disabled>
                                            <option value="0">Seleccione municipio</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <select id="busquedaCategorias" name="categoria" class="form-control">
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <button id="enviarFormularioBusqueda" type="submit" class="btn btn-lg btn-dark">Buscar actividades</button>
                            </form>
                       </div>
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
                    <img src="./img/img_pagina/logo.png" alt="Logo" width="180" height="95">
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
                      <span class="pull-right"><a href="php/sesion/registro.php" id="entrarRegistrarse">Registrarse</a></span><span><a href="#">Ayuda</a></span>
                    </div>
                    <hr>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-lg-4 col-lg-offset-2 text-center" style="padding: 6px 0px 6px 0px">
                                <fb:login-button size="large" scope="public_profile,email" onlogin="checkLoginState();">
                                </fb:login-button>
                            </div>
                            <div class="col-lg-4" style="padding: 6px 0px 6px 0px">
                                <span id="signinButton">
                                  <span
                                    class="g-signin"
                                    data-callback="signinCallback"
                                    data-clientid="588829378375-8d6r2pgvqjnsve27vthkofmifscipa9t.apps.googleusercontent.com"
                                    data-cookiepolicy="single_host_origin"
                                    data-requestvisibleactions="http://schemas.google.com/AddActivity"
                                    data-scope="https://www.googleapis.com/auth/plus.login https://www.googleapis.com/auth/userinfo.email">
                                  </span>
                                </span>
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

    <!-- Modal Información-->
    <div class="modal fade" id="modalInfo" role="dialog">
        <div class="modal-dialog">
          <!-- Modal content-->
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              <div class="row">
                  <div class="col-lg-4 col-lg-offset-4 text-center">
                    <img src="./img/img_pagina/logo.png" alt="Logo" width="180" height="95">
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

    <!-- Modal Contacto-->
    <div class="modal fade" id="modalContacto" role="dialog">
        <div class="modal-dialog">
          <!-- Modal content-->
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              <div class="row">
                  <div class="col-lg-4 col-lg-offset-4 text-center">
                    <img src="./img/img_pagina/logo.png" alt="Logo" width="180" height="95">
                    <h3 class="modal-title"><b>Contacto</b></h3>
                  </div>
              </div>
            </div>
            <div class="modal-body">
                  <form class="form" action="./php/contacto.php" method="POST" id="formularioContacto">
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

    <!-- Formulario oculto para el registro con redes sociales -->
    <form class="form" action="./php/sesion/registrosocial.php" method="POST" id="formularioRedes">
        <input type="hidden" name="registroNombre" value="" id="socialNombre"/>
        <input type="hidden" name="registroApellidos" value="" id="socialApellidos"/>
        <input type="hidden" name="registroEmail" value="" id="socialEmail"/>
        <input type="hidden" name="userid" value="" id="socialId"/>
    </form>

    <!-- jQuery -->
    <script src="./js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="./js/bootstrap.min.js"></script>
    
    <!-- Mis archivos JavaScript -->
    <script type="text/javascript" src="js/index.js"></script>
</body>

</html>
