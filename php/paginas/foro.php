<?php
    session_start();
    // Obtener la isla y categoria sobre la que se va a maquetar la imagen y la pagina actua
    $categoria = (isset($_GET['categoria'])) ? $_GET['categoria'] : "1";
    $isla = (isset($_GET['isla'])) ? $_GET['isla'] : "1";
    $pagina = (isset($_GET['pagina'])) ? (int)$_GET['pagina'] : 1;
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

    // Obtener el total de actividades para dicha isla y categoria
    $consulta = "SELECT COUNT(id) AS total FROM actividades WHERE idcategoria = :categoria AND idisla = :isla";
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
                <a href="#actividades" onclick = $("#menu-close").click(); >Actividades</a>
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
                        <a href="./perfil.php?usuario='.$sesionId.'">'.$sesionNick.'</a>
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
                    <p class="lead">Aqui podrás encontrar desde una clase de costura, </br>hasta un curso profesional de desarrollo web </br>con certificación internacional</p>
                </div>
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container -->
    </section>

    
    <!-- The circle icons use Font Awesome's stacked icon classes. For more information, visit http://fontawesome.io/examples/ -->
    <section id="actividades" class="services bg-primary">
        <div class="container">
            <div class="row text-center">
                <div class="col-lg-10 col-lg-offset-1">
                    <h1><?php echo $nombreCategoria." en ".$nombreIsla; ?></h1>
                    <hr class="small">
                    <div>
                        <?php
                        if($sesionIsla == $isla){
                            echo'<a href="./crearactividad.php" class="btn btn-lg btn-dark" type="submit">Publicar Actividad</a>';
                        }
                        ?>
                    </div>
                    <div class="row">
                        <hr>
                        <?php
                        $consulta = "SELECT act.id, act.titulo, act.descripcion, DATE_FORMAT(act.created, '%d-%m-%Y') AS creada, r.ruta, ";
                        $consulta .= "cat.nombre AS categoria, COUNT( v.id ) AS veces, ROUND( AVG( v.valoracion ) ) AS media, ";
                        $consulta .= "act.idisla, i.nombre AS nombreisla, m.nombre AS nombremunicipio ";
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
                                echo '            <h3>'.($z+1).". ".$arrayResult[$z]['titulo'].'</h3>';
                                echo '            <h4>'.$arrayResult[$z]['categoria'].'</h4>';
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
                                        if($totalActividades != 0){
                                        if($pagina != 1){
                                            echo '<li>
                                          <a href="foro.php?categoria='.$categoria.'&isla='.$isla.'&pagina='.($pagina-1).'" aria-label="Previous">
                                            <span aria-hidden="true">&laquo;</span>
                                          </a>
                                        </li>';
                                        }else{
                                            echo '
                                            <li class="disabled">
                                              <a href="#" aria-label="Previous">
                                                <span aria-hidden="true">&laquo;</span>
                                              </a>
                                            </li>
                                            ';
                                        }
                                        for($i=1;$i <= ceil($totalActividades / 3);$i++){
                                            if($i == $pagina){
                                                echo '<li class="active">';
                                            }else{
                                                echo '<li>';
                                            }
                                            echo '<a href="foro.php?categoria='.$categoria.'&isla='.$isla.'&pagina='.$i.'">'.$i.'</a>';
                                            echo '</li>';
                                        }
                                        if($pagina != ceil($totalActividades / 3)){
                                            echo '<li>
                                          <a href="foro.php?categoria='.$categoria.'&isla='.$isla.'&pagina='.($pagina+1).'" aria-label="Previous">
                                            <span aria-hidden="true">&raquo;</span>
                                          </a>
                                        </li>';
                                        }else{
                                            echo '
                                            <li class="disabled">
                                              <a href="#" aria-label="Previous">
                                                <span aria-hidden="true">&raquo;</span>
                                              </a>
                                            </li>
                                            ';
                                        }
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

</body>

</html>