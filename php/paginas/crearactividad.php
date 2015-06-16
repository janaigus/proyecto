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
    $sesionIsla = (isset($_SESSION['islah2k'])) ? (int)$_SESSION['islah2k'] : "1";
    $sesionTiempo = (isset($_SESSION['tiempoh2k'])) ? $_SESSION['tiempoh2k'] : "";
    // Traer elementos de la base de datos
    require('../bd/conexionBDlocal.php');
    $db = conectaDb();
    // Crear variables con datos recibidos por POST
    $correcto = true;
    $titulo = (isset($_POST['titulo'])) ? $_POST['titulo'] : "";
    $descripcion = (isset($_POST['descripcion'])) ? $_POST['descripcion'] : "";
    $categoria = (isset($_POST['categorias'])) ? $_POST['categorias'] : "";
    $municipio = (isset($_POST['municipios'])) ? $_POST['municipios'] : "";
    if(isset($_POST['titulo'])){
        // Realizar el update de todos los campos menos del avatar
        $consulta = 'INSERT INTO actividades (idusuario,  idcategoria,  titulo, descripcion , idmunicipio, idisla) ';
        $consulta .= ' VALUES (:usuario, :categoria, :titulo, :descripcion, :municipio, :isla)';
        // Crear el path dependiendo de si existe o no una imagen a añadir
        $result = $db->prepare($consulta);
        $resultado = $result->execute(array(':usuario' => $sesionId, 
                                            ':categoria' => $categoria,
                                            ':titulo' => $titulo,
                                            ':descripcion' => $descripcion,
                                            ':municipio' => $municipio,
                                            ':isla' => $sesionIsla
                                           ));
        if(!$resultado){
            $error = "No se ha podido añadir la actividad";
            $correcto = false;
        }else{
            $idActividad = $db->lastInsertId();
        }
    
        // Realizar insert en recursos de la iamgen. Si no hay, enlazar a por defecto
        // Hacer lo mismo con el avatar
        // Importante subir el archivo a la ruta img/img_usuarios/avatares/
        if(isset($_FILES['imagenActividad']) and $_FILES['imagenActividad']["error"] == 0){
            $tmp_name = $_FILES["imagenActividad"]["tmp_name"];
            $name = $_FILES["imagenActividad"]["name"];
            $arrayNombre = explode(".", $name);
            $rutaFinal = "img/img_actividades/".(str_replace(" ", "_",$titulo))."-".date("d-m-y_H_i_s.").$arrayNombre[count($arrayNombre) - 1];
            // Mover el archivo antes de realizar la consulta
            if(!move_uploaded_file($tmp_name, "../../".$rutaFinal)){
                $error = 'No se ha añadido la imagen<br/>';
                $correcto = false;
            }
        }else{
            $rutaFinal = 'img/img_actividades/default.jpg';
        }
        // Realizar el update de todos los campos menos del avatar
        $consulta = 'INSERT INTO recursos (idactividad, ruta) ';
        $consulta .= ' VALUES (:actividad, :ruta)';
        // Crear el path dependiendo de si existe o no una imagen a añadir
        
        $result = $db->prepare($consulta);
        $resultado = $result->execute(array(':actividad' => $idActividad, ':ruta' => $rutaFinal));

        if(!$resultado == true){
            $error = 'No se pudo añadir la imagen<br/>';
            $correcto = false;
        }
        if($correcto){
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
            echo'
                <li>
                    <a href="./perfil.php?usuario='.$sesionId.'">'.$sesionNick.'</a>
                </li>
                <li>
                    <a href="../sesion/cerrarsesion.php">Cerrar Sesión</a>
                </li>
                ';
            
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
                        <h2>Crear actividad</h2>
                        <hr class="small">
                    </div>
                    <!-- /.row (nested) -->
                </div>
                <!-- /.col-lg-10 -->
            <div class="row">
            <form class="form-horizontal" role="form" action="./crearactividad.php" method="POST" id="formularioActividad" enctype="multipart/form-data">
            
            <div class="col-md-10 col-lg-offset-1" style="color:black;text-align: left;">
            
            <div class="thumbnail" style="padding: 20px 20px 20px 20px;">
                <div class="caption-full">
                <div class="alert alert-info alert-dismissable" id="panelAlertas" <?php echo (!isset($error)) ? 'style="display: none;"' : ''; ?> >
            <a class="panel-close close" data-dismiss="alert">×</a>
                <?php echo (isset($error)) ? $error : ''; ?>
            </div>
                <div class="item">
                    <div class="row">
                       <div class="col-xs-12 col-sm-12 col-md-12 col-lg-6" >
                           <div class="text-center">
                            <img id="imagenColocada" src="../../img/img_actividades/default.jpg" class="" alt="">
                            <h6>Subir otra foto...</h6>
                            <input type="file" name="imagenActividad" id="imagenActividad" class="text-center center-block well well-sm" style="color: black;">
                          </div>
                       </div>
                    
                       <div class="col-xs-12 col-sm-12 col-md-12 col-lg-6" style="text-align: left;">
                            <form class="form-horizontal" action="" role="form">
                                <div class="form-group">
                                  <div class="col-lg-12">
                                    <input name="titulo" id="titulo" class="form-control" placeholder="Titulo" type="text">
                                  </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-lg-12">
                                    <select id="categorias" name="categorias" class="form-control">
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
                                <div class="form-group">
                                  <div class="col-lg-12">
                                        <select id="municipios" name="municipios" class="form-control">
                                            <option value="0">Seleccione municipio</option>
                                            <?php
                                            $consulta = "SELECT * FROM auxmunicipios WHERE idisla = :isla ";
                                            $result = $db->prepare($consulta);
                                            $result->execute(array(':isla' => $sesionIsla ));
                                            $arrayResult = $result->fetchAll();
                                            for($i=0;$i<$result->rowCount();$i++){
                                                echo '<option value="'.$arrayResult[$i]['id'].'">'.$arrayResult[$i]['nombre'].'</option>';
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                  <div class="col-lg-12">
                                    <textarea name="descripcion" id="descripcion" class="form-control" rows="6" style="resize:vertical;" placeholder="Comentario" maxlength="250"></textarea>
                                      <h5 class="pull-right"><span id="lrestantes">250 letras restantes</span></h5>
                                  </div>
                                </div>
                           </form>
                       </div>
                    </div>
                    <div class="row text-center">
                        <input class="btn btn-lg btn-dark" value="Publicar actividad" type="submit">
                    </div>
                </div>
                    
                </div>
            </div>
            </div>
            </form>
        </div>
        </div>
        <!-- /.row -->
        </div>
        <!-- /.container -->
    </section>
    
    <!-- Footer -->
    <?php require('./footer.php'); ?> 

    <!-- Incluir los modales necesarios-->
    <?php require('../modales/login.php'); ?>
    <?php require('../modales/contacto.php'); ?>   
    <?php require('../modales/info.php'); ?>  
        
    <!-- jQuery -->
    <script src="../../js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="../../js/bootstrap.min.js"></script>
    
    <!-- Mis archivos JavaScript -->
    <script type="text/javascript" src="../../js/funciones.js"></script> 
    <script type="text/javascript" src="../../js/crearactividad.js"></script>

</body>

</html>