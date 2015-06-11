<?php
    session_start();
    // Obtener la isla sobre la que se va a maquetar la imagen y la pagina actual
    $isla = (isset($_GET['isla'])) ? $_GET['isla'] : "7";
    
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

    // Saber el nombre de los campos de las islas 
    $consulta = "SELECT * FROM auxislas where id = :isla ORDER BY nombre";
    $result = $db->prepare($consulta);
    $result->execute(array(':isla' => $isla));
    $arrayResult = $result->fetchAll();
    $idIsla = $arrayResult[0]['id'];
    $nombreIsla = $arrayResult[0]['nombre'];
    $latitudIsla = $arrayResult[0]['latitud'];
    $longitudIsla = $arrayResult[0]['longitud'];
    $zoomIsla = $arrayResult[0]['zoom'];

    $consulta = "SELECT COUNT(id) as total FROM actividades where idisla = :isla";
    $result = $db->prepare($consulta);
    $result->execute(array(':isla' => $isla));
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
    
    <?php 
        // Obtener todos los centros educativos de una isla
        $otrodb = conectaDb();
        // Saber el nombre de los campos de las islas 
        $consulta = "SELECT * FROM centroseducativos WHERE idisla = :isla ORDER BY nombre";
        $result = $otrodb->prepare($consulta);
        $result->execute(array(':isla' => $isla));
        $arrayCentros = $result->fetchAll();
    ?>
    <script src="https://maps.googleapis.com/maps/api/js"></script>
    <script>
        function initialize() {
            var myLatlng = new google.maps.LatLng(<?php echo $latitudIsla.','.$longitudIsla;?>);
            var mapOptions = {
                zoom: <?php echo $zoomIsla; ?>,
                center: myLatlng
            };

            var map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);
            <?php
            $order   = array("\r\n", "\n", "\r");
            $replace = '<br />';
            for($i=0;$i<count($arrayCentros);$i++){
                $informacion = str_replace($order, $replace, $arrayCentros[$i]['informacion']);
                // Cadena que se adjuntara como cuerpo
                echo "
                var contentString".$i." = '<div id=\"content\">'+
                      '<h4 id=\"firstHeading\" class=\"firstHeading\" >".$arrayCentros[$i]['nombre']."</h4>'+
                      '<div id=\"bodyContent\">'+
                      '<p>".$informacion."</p>'+
                      '</div>'+
                      '</div>';
                      ";
                // Variable que contendrá el infowindow que monstrará dicho mensaje
                echo "
                var infowindow".$i." = new google.maps.InfoWindow({
                      content: contentString".$i."
                  }); 
                  ";
                // Crear el marcador con las posicion del lugar
                echo "
                var marker".$i." = new google.maps.Marker({
                      position: new google.maps.LatLng(".$arrayCentros[$i]['latitud'].",".$arrayCentros[$i]['longitud']."),
                      map: map,
                      title: '".$arrayCentros[$i]['nombre']."'
                  });
                ";
                // Añadir el infowindow al marcador que ira sobre el mapa
                echo "
                google.maps.event.addListener(marker".$i.", 'click', function() {
                        infowindow".$i.".open(map,marker".$i.");
                      });
                      ";
            }
            ?> 
        }
        google.maps.event.addDomListener(window, 'load', initialize);
    </script>
    
    <!-- Fichero de JS para la gestion del incio de sesion con las redes sociales -->
    <script type="text/javascript" src="../../js/social.js"></script>
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
                <a href="#valoradas" onclick = $("#menu-close").click(); >Mejor Valoradas</a>
            </li>
            <li>
                <a href="#busqueda" onclick = $("#menu-close").click(); >Buscar actividades en <?php echo $nombreIsla?></a>
            </li>
            <li>
                <a href="#recientes" onclick = $("#menu-close").click(); >Más Recientes</a>
            </li>
            <li>
                <a href="#centroseducativos" onclick = $("#menu-close").click(); >Centros educativos</a>
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
                    <a id="btnLateralRegistrarse" href="../sesion/registro.php">Registrarse</a>
                </li>';
            }else{
                echo'
                    <li>
                        <a href=".perfil.php?usuario='.$sesionId.'">'.$sesionNick.'</a>
                    </li>
                    <li>
                        <a href="../sesion/cerrarsesion.php">Cerrar Sesión</a>
                    </li>
                    ';
            }
            if($sesionRol == "1"){
                echo'
                <hr>
                <li>
                    <a href="./administrador.php">Admnistrar Sitio</a>
                </li>';
            }
            ?>
        </ul>
    </nav>

    <!-- About -->
    <section id="about" class="about">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2>Ayudando a personas para aprender. <h1><b>Help to Know!</b></h1></h2>
                    <h1>Actividades de <?php echo $nombreIsla; ?></h1>
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
                    <div>
                        <?php
                        if($sesionIsla == $isla){
                            echo'<a href="./crearactividad.php" class="btn btn-lg btn-dark" type="submit">Publicar Actividad</a>';
                        }
                        ?>
                    </div>
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
                    $consulta .= "WHERE act.idisla = :isla ";
                    $consulta .= "GROUP BY act.id ";
                    $consulta .= "ORDER BY AVG( v.valoracion ) DESC ";
                    $consulta .= "LIMIT 3";
                    $result = $db->prepare($consulta);
                    $result->execute(array(":isla" => $idIsla ) );
                    $arrayResult = $result->fetchAll();
                    //Comprobar que se haya devuelto algun resultado
                    if($result->rowCount() != 0){
                    // Más Recientes 
                    echo '<div class="carousel-inner" id="itemsCarouselMejorValoradas">';
                    for($z=0;$z<$result->rowCount();$z++){
                        if($z == 0){
                            echo '<div class="item active">';
                        }else{
                            echo '<div class="item">';
                        }
                        echo '    <div class="row">';
                        echo '       <div class="col-xs-12 col-sm-12 col-md-6">';
                        echo '            <a href=""> <img src="../../'.$arrayResult[$z]['ruta'].'" class="thumbnail" alt="Image" height="280px" width="450px" /></a>';
                        echo '       </div>';
                        echo '       <div class="col-xs-12 col-sm-12 col-md-6" style="text-align: left;">';
                        echo '            <h3>'.($z+1).". ".$arrayResult[$z]['titulo'].'</h3>';
                        echo '            <a href="./foro.php?categoria='.$arrayResult[$z]['idcategoria'].'&isla='.$arrayResult[$z]['idisla'];
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
                        echo '       <a href="./actividad.php?actividad='.$arrayResult[$z]['id'].'" class="btn btn-lg btn-light">Ver más<span class="glyphicon glyphicon-chevron-right"></span></a>';
                        echo '       </div>';
                        echo '    </div>';
                        echo '</div>';
                    }
                    echo '</div>';
                    }else{
                        echo "<h2>No hay actividades valoradas en la isla: ".$nombreIsla."</h2>";
                    }
                    ?>
                    
                                
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
    
    <!-- Seccion de busqueda -->
    <!-- The circle icons use Font Awesome's stacked icon classes. For more information, visit http://fontawesome.io/examples/ -->
    <section id="busqueda" class="portfolio">
        <div class="container">
            <div class="row text-center">
                <div class="col-lg-10 col-lg-offset-1">
                    <h2>Busqueda de actividades en <?php echo $nombreIsla;?></h2>
                    <hr class="small">
                    <div class="row">
                       <!-- Principio del carrousel -->
                       <div class="col-xs-12 col-sm-12 col-md-12">
                            <form class="form" action="./busqueda.php" method="GET" id="formularioBusqueda">
                                <div class="col-lg-4 col-lg-offset-2">
                                    <div class="form-group">
                                        <select id="busquedaMunicipios" name="municipio" class="form-control">
                                            <option value="0">Seleccione municipio</option>
                                            <?php
                                            $consulta = "SELECT * FROM auxmunicipios where idisla = :isla ORDER BY nombre";
                                            $result = $db->prepare($consulta);
                                            $result->execute(array(':isla' => $idIsla));
                                            $arrayResult = $result->fetchAll();
                                            for($i=0;$i<$result->rowCount();$i++){
                                                echo '<option value="'.$arrayResult[$i]['id'].'">'.$arrayResult[$i]['nombre'].'</option>';
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <select id="busquedaCategorias" name="categoria" class="form-control">
                                            <option value="0">Seleccione categoria</option>
                                            <?php
                                            $consulta = "SELECT * FROM auxcategorias ORDER BY nombre";
                                            $result = $db->prepare($consulta);
                                            $result->execute();
                                            $arrayResult = $result->fetchAll();
                                            for($i=0;$i<$result->rowCount();$i++){
                                                echo '<option value="'.$arrayResult[$i]['id'].'">'.$arrayResult[$i]['nombre'].'</option>';
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <input type="hidden" name="isla" value="<?php echo $isla; ?>">
                            <button id="enviarFormularioBusqueda" type="submit" class="btn btn-lg btn-dark"
                                <?php echo ($totalActividades == 0) ? 'disabled>No hay actividades' : ">Buscar actividades";?></button>
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
                    $consulta .= "WHERE act.idisla = :isla ";
                    $consulta .= "GROUP BY act.id ";
                    $consulta .= "ORDER BY act.created DESC ";
                    $consulta .= "LIMIT 3";
                    $result = $db->prepare($consulta);
                    $result->execute(array(":isla" => $idIsla ) );
                    $arrayResult = $result->fetchAll();
                    // Más Recientes
                    if($result->rowCount() != 0){
                    echo '<div class="carousel-inner" id="itemsCarouselMasRecientes">';
                    for($z=0;$z<$result->rowCount();$z++){
                        if($z == 0){
                            echo '<div class="item active">';
                        }else{
                            echo '<div class="item">';
                        }
                        echo '    <div class="row">';
                        echo '       <div class="col-xs-12 col-sm-12 col-md-6">';
                        echo '            <a href=""> <img src="../../'.$arrayResult[$z]['ruta'].'" class="thumbnail" alt="Image" height="280px" width="450px" /></a>';
                        echo '       </div>';
                        echo '       <div class="col-xs-12 col-sm-12 col-md-6" style="text-align: left;">';
                        echo '            <h3>'.($z+1).". ".$arrayResult[$z]['titulo'].'</h3>';
                        echo '            <a href="./foro.php?categoria='.$arrayResult[$z]['idcategoria'].'&isla='.$arrayResult[$z]['idisla'];
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
                        echo '       <a href="./actividad.php?actividad='.$arrayResult[$z]['id'].'" class="btn btn-lg btn-light">Ver más<span class="glyphicon glyphicon-chevron-right"></span></a>';
                        echo '       </div>';
                        echo '    </div>';
                        echo '</div>';
                    }
                    echo '</div>';
                    }else{
                        echo "<h2>No hay actividades en la isla: ".$nombreIsla."</h2>";
                    }
                    ?>
                                
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
        
    <section id="centroseducativos" class="map">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2>Centros educativos en <?php echo $nombreIsla?></h2>
                    <hr class="small">
                </div>
                <div class="col-lg-10 col-lg-offset-2 text-center">
                    <div class="contenedor-mapa">
                        <div id="map-canvas" style="width: 800px;height: 400px;"></div>
                    </div>
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

    <!-- Incluir los modales necesarios-->
    <?php require('../modales/login.php'); ?>
    <?php require('../modales/contacto.php'); ?>   
    <?php require('../modales/info.php'); ?>  
    
    <!-- Formulario oculto para el registro con redes sociales -->
    <form class="form" action="../sesion/registrosocial.php" method="POST" id="formularioRedes">
        <input type="hidden" name="registroNombre" value="" id="socialNombre"/>
        <input type="hidden" name="registroApellidos" value="" id="socialApellidos"/>
        <input type="hidden" name="registroEmail" value="" id="socialEmail"/>
        <input type="hidden" name="userid" value="" id="socialId"/>
    </form>
    
    <!-- jQuery -->
    <script src="../../js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="../../js/bootstrap.min.js"></script>
    
    <!-- Mis archivos JavaScript -->
    <script type="text/javascript" src="../../js/funciones.js"></script>
    <script type="text/javascript" src="../../js/islas.js"></script>

</body>

</html>