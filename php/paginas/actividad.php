<?php
    session_start();
    // Obtener la isla sobre la que se va a maquetar la imagen y la pagina actual
    $idActividad = (isset($_GET['actividad'])) ? $_GET['actividad'] : "1";
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

    // Obtener la información completa de la actividad incluyendo votos y valoraciones
    $consulta = "SELECT act.id, act.titulo, act.descripcion, DATE_FORMAT(act.created, '%d-%m-%Y') AS creada, r.ruta, ";
    $consulta .= "act.idcategoria, cat.nombre AS categoria, COUNT( v.id ) AS veces, ROUND( AVG( v.valoracion ) ) AS media, ";
    $consulta .= "act.idisla, i.nombre AS nombreisla, m.nombre AS nombremunicipio ";
    $consulta .= "FROM actividades act ";
    $consulta .= "LEFT JOIN votos v ON act.id = v.idactividad ";
    $consulta .= "LEFT JOIN recursos r ON act.id = r.idactividad ";
    $consulta .= "LEFT JOIN auxcategorias cat ON act.idcategoria = cat.id ";
    $consulta .= "INNER JOIN auxislas i ON act.idisla = i.id ";
    $consulta .= "INNER JOIN auxmunicipios m ON act.idmunicipio = m.id ";
    $consulta .= "WHERE act.id = :actividad ";
    $result = $db->prepare($consulta);
    $result->execute(array(':actividad' => $idActividad));
    $arrayResult = $result->fetchAll();
    
    $bloqueo = true;
    if($sesionNick != ""){
        $bloqueo = false;
        // Si existe parametro post con uncomentario
        if(isset($_POST['comentarios'])){
            // Realizar el update de todos los campos menos del avatar
            $consulta = 'INSERT INTO comentarios (idactividad, idusuario, texto) ';
            $consulta .= ' VALUES (:actividad, :usuario, :com)';
            // Crear el path dependiendo de si existe o no una imagen a añadir
            $result = $db->prepare($consulta);
            $result->execute(array(':actividad' => $idActividad, ':usuario' => $sesionId, ':com' => $_POST['comentarios']));
            
            // Añadir la valoracion de estrellas si la hay
            if($_POST['valoracion'] != ""){
                $consulta = "INSERT INTO votos (idactividad, idusuario, valoracion) VALUES (:actividad, :usuario, :voto)";
                $result = $db->prepare($consulta);
                $result->execute(array(":actividad" => $idActividad, ":usuario" => $sesionId, ":voto" => $_POST['valoracion']));
            }
            header('Location: ./actividad.php?actividad='.$idActividad);
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
                <a href="#actividad" onclick = $("#menu-close").click(); >Actividad</a>
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
                </div>
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container -->
    </section>
        
    <!-- Actividad -->
    <!-- The circle icons use Font Awesome's stacked icon classes. For more information, visit http://fontawesome.io/examples/ -->
    <section id="actividad" class="services bg-primary">
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
                echo '            <a href=""> <img src="../../'.$arrayResult[0]['ruta'].'" class="thumbnail" alt="Image" style="height:280px;width:450px;" /></a>';
                echo '       </div>';
                echo '       <div class="col-xs-12 col-sm-12 col-md-6" style="text-align: left;">';
                echo '            <h3>'.$arrayResult[0]['titulo'].'</h3>';
                echo '            <a href="./foro.php?categoria='.$arrayResult[0]['idcategoria'].'&isla='.$arrayResult[0]['idisla'].'">';
                echo '            <h4>'.$arrayResult[0]['categoria'].' en '.$arrayResult[0]['nombreisla'].'</h4>';
                echo '            </a>';
                echo '            <h5>Creada el '.$arrayResult[0]['creada'];
                echo '            en '.$arrayResult[0]['nombremunicipio'].', '.$arrayResult[0]['nombreisla'].'</h5>';
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
                <div class="thumbnail" style="padding: 20px 20px 20px 20px;">
                    <div class="caption-full">
                    <div class="alert alert-info alert-dismissable" id="panelAlertas" <?php echo (!isset($error)) ? 'style="display: none;"' : ''; ?> >
                <a class="panel-close close" data-dismiss="alert">×</a>
                    <?php echo (isset($error)) ? $error : ''; ?>
                </div>
                <form accept-charset="UTF-8" action="./actividad.php?actividad=<?php echo $idActividad; ?>" method="POST">
                <textarea class="form-control" rows="3" style="resize:vertical;" id="comentarios" placeholder="Comentario" name="comentarios" <?php echo ($bloqueo) ? "disabled" : "" ?> maxlength="250"></textarea>
                <h5 class="pull-right" id="lrestantes" >250 letras restantes</h5>
                    <div id="mensajeValoracion">
                    <?php
                        // Comprobar si el usuario ya ha valorado esta actividad para no dejarlo volver a valorarla
                        $consulta = "SELECT * FROM votos WHERE idusuario = :usuario AND idactividad = :actividad";
                        $result = $db->prepare($consulta);
                        $result->execute(array(':usuario' => $sesionId, 'actividad' => $idActividad));
                        $arrayResult = $result->fetchAll();
                        if($result->rowCount() != 0){
                            // Bloquear la valoracion para ese usuario
                            $yavalorada = true;
                            echo "Has valorado esta actividad con ".$arrayResult[0]['valoracion']." estrellas";
                        }
                    ?>
                    </div>
                    <input type="hidden" id="valoracion" name="valoracion" value="">
                <div class="ec-stars-wrapper" style="padding-top: 10px;visibility:<?php echo ($bloqueo or isset($yavalorada)) ? "hidden" : "visible" ?>;" id="" >
                        <span id="1">&#9733;</span>
                        <span id="2">&#9733;</span>
                        <span id="3">&#9733;</span>
                        <span id="4">&#9733;</span>
                        <span id="5">&#9733;</span>
                </div>
                <div class="text-right">
                    <button class="btn btn-success" type="submit" id="enviarcom" <?php echo ($bloqueo) ? "disabled" : "" ?> ><?php echo ($bloqueo) ? "Inicie sesión" : "Enviar comentario" ?></button>
                </div>
                </form>
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
    <script type="text/javascript" src="../../js/actividad.js"></script>

</body>

</html>