<?php
    session_start();
    // Obtener variables con los parametros de la sesión del usuario

    $usuarioId = (isset($_POST['id'])) ? $_POST['id'] : "";
    
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
        $result->execute(array(":usuario" => $usuarioId));
        $arrayResult = $result->fetchAll();
        $arrayActividades = $arrayResult;
        
        // Comenzar borrando los votos
        $consulta = "DELETE FROM votos WHERE idusuario = :usuario";
        $result = $db->prepare($consulta);
        $result->bindParam(":usuario", $usuarioId, PDO::PARAM_STR);
        $result->execute();
        
        
        // Luego borrar los comentarios
        $consulta = "DELETE FROM comentarios WHERE idusuario = :usuario";
        $result = $db->prepare($consulta);
        $result->bindParam(":usuario", $usuarioId, PDO::PARAM_STR);
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
        $result->bindParam(":usuario", $usuarioId, PDO::PARAM_STR);
        $result->execute();
        if($sesionRol != 1){
            session_destroy();
            header('Location: ../../index.php');
        }else{
            header('Location: ../paginas/administrador.php#usuarios');
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
                        <a href="../../index.php" class="btn btn-lg btn-light">No</a>
                        <input type="hidden" name="id" value="<?php echo $usuarioId;?>" />
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
        
    <!-- Incluir los modales necesarios-->
    <?php require('../../php/modales/contacto.php'); ?>   
    <?php require('../../php/modales/info.php'); ?> 
        
    <!-- jQuery -->
    <script src="../../js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="../../js/bootstrap.min.js"></script>
    
    <!-- Mis archivos JavaScript -->
    <script type="text/javascript" src="../../js/funciones.js"></script>

</body>

</html>