<?php
    session_start();
    // Obtener el usuario sobre el que se va a maquetar la imagen
    $usuario = (isset($_GET['usuario'])) ? $_GET['usuario'] : "1";
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
    if(isset($_POST['nombre'])){
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
        $passUsuario = $arrayResult[0]['password'];
        
        $mensaje = '';
        $correcto = true;
        // Si el email anterior es distinto del nuevo
        if($_POST['email'] != $emailUsuario){
            // Comprobar que el email y el nick no existen en la base de datos
            $consulta = "SELECT * FROM usuarios where email=:email";
            $result = $db->prepare($consulta);
            $result->execute(array(":email" => $_POST['email']));
            if($result->rowCount() != 0){
                $mensaje = "El email está en uso<br/>";
                $correcto = false;
            }
        }
        // Si el nick anterior es distinto del nuevo
        if($_POST['nick'] != $nickUsuario){
            // Comprobar que el email y el nick no existen en la base de datos
            $consulta = "SELECT * FROM usuarios where nick=:nick";
            $result = $db->prepare($consulta);
            $result->execute(array(":nick" => $_POST['nick']));
            if($result->rowCount() != 0){
                $mensaje = "El nick ya está en uso<br/>";
                $correcto = false;
            }
        }
        // Una vez que los datos anteriores son correctos continuar la actualizacion
        if($correcto == true){
            // Realizar el update de todos los campos menos del avatar
            $consulta = 'UPDATE usuarios SET ';
            $consulta .= 'email = :email , ';
            $consulta .= 'nick = :nick , ';
            $consulta .= 'nombre = :nombre , ';
            if(isset($_POST['password']) and $_POST['password'] != ""){
                $consulta .= 'apellidos = :apell , ';
                $consulta .= 'password = :pass ';
            }else{
                $consulta .= 'apellidos = :apell ';
            }
            $consulta .= 'WHERE usuarios.id = '.$usuario;
            $result = $db->prepare($consulta);
            $valores = array(':email' => $_POST['email'],
                                                ':nick' => $_POST['nick'],
                                                ':nombre' => $_POST['nombre'],
                                                ':apell' => $_POST['apellidos']
                                               );
            if(isset($_POST['password']) and $_POST['password'] != ""){
                $valores['pass'] = md5(md5(md5($_POST['password'])));
            }
            $resultado = $result->execute($valores);
            
            if($resultado == true){
                $mensaje = 'Información actualizada correctamente<br/>';
                $_SESSION['nickh2k'] = $_POST['nick'];
                $_SESSION['nombreh2k'] = $_POST['nick'];
                $_SESSION['emailh2k'] = $_POST['email'];
                header('Location: ./perfil.php?usuario='.$usuario);
            }
        }
        // Hacer lo mismo con el avatar
        // Importante subir el archivo a la ruta img/img_usuarios/avatares/
        if(isset($_FILES['archivoAvatar']) and $_FILES['archivoAvatar']["error"] == 0){
            $tmp_name = $_FILES["archivoAvatar"]["tmp_name"];
            $name = $_FILES["archivoAvatar"]["name"];
            $arrayNombre = explode(".", $name);
            $rutaFinal = "img/img_usuarios/avatares/".$nickUsuario."avatar.".$arrayNombre[count($arrayNombre) - 1];
            // Mover el archivo antes de realizar la consulta
            if(!move_uploaded_file($tmp_name, "../../".$rutaFinal)){
                $mensaje .= 'No se ha cambiado el avatar<br/>';
            }else{
                // Realizar el update de todos los campos menos del avatar
                $consulta = 'UPDATE u135108308_h2k.usuarios SET ';
                $consulta .= 'avatar= :avatar ';
                $consulta .= 'WHERE usuarios.id = '.$usuario;

                $result = $db->prepare($consulta);
                $resultado = $result->execute(array(':avatar' => $rutaFinal ));
                if($resultado == true){
                    $mensaje .= 'El avatar se ha actualizado correctamente<br/>';
                }else{
                    $mensaje .= 'Error. su avatar sigue siendo el anterior<br/>';
                }
            }
        }
    }
    // Rellenar los datos
    $consulta = "SELECT * FROM usuarios WHERE id = :usuario ORDER BY nombre";
    $result = $db->prepare($consulta);
    $result->execute(array(':usuario' => $usuario));
    $arrayResult = $result->fetchAll();
    $idUsuario = $arrayResult[0]['id'];
    $nombreUsuario = $arrayResult[0]['nombre'];
    $apellidosUsuario = $arrayResult[0]['apellidos'];
    $nickUsuario = $arrayResult[0]['nick'];
    $emailUsuario = $arrayResult[0]['email'];
    $idIsla = $arrayResult[0]['idisla'];
    $idMunicipio = $arrayResult[0]['idmunicipio'];
    $avatarUsuario = $arrayResult[0]['avatar'];
    $passUsuario = $arrayResult[0]['password'];
    // Seguridad, el usuario debe haber iniciado sesion y ser el mismo que al que se está intentando acceder
    if(! ( ($sesionNombre != "" and $sesionId == $idUsuario) or $sesionRol == 1 ) ){
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
            <?php
            echo'
                <li>
                    <a href="perfil.php?usuario='.$sesionId.'">'.$sesionNick.'</a>
                </li>
                <li>
                    <a href="../sesion/cerrarsesion.php">Cerrar Sesión</a>
                </li>
                ';
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
    
    <!-- Perfil -->
    <!-- The circle icons use Font Awesome's stacked icon classes. For more information, visit http://fontawesome.io/examples/ -->
    <section id="perfil" class="services bg-primary">
        <div class="container">
          <h1 class="page-header text-center">Editar Perfil</h1>
          <div class="row">
            <form class="form-horizontal" role="form" action="<?php echo "./perfil.php?usuario=".$usuario; ?>" method="POST" id="formularioPerfil" enctype="multipart/form-data">
            <!-- left column -->
            <div class="col-md-4 col-sm-6 col-xs-12">
              <div class="text-center">
                <img src="../../<?php echo $avatarUsuario; ?>" class="avatar img-circle img-thumbnail" alt="avatar" style="height: 200px; width: 200px;">
                <h6>Subir otra foto...</h6>
                <input type="file" name="archivoAvatar" id="archivoAvatar" class="text-center center-block well well-sm" style="color: black;" disabled="disabled">
              </div>
            </div>
            <!-- edit form column -->
            <div class="col-md-8 col-sm-6 col-xs-12 personal-info">
              <div class="alert alert-info alert-dismissable" id="panelAlertas" <?php echo (!isset($mensaje)) ? 'style="display:none;"' : ''; ?> >
                <a class="panel-close close" data-dismiss="alert">×</a> 
                <?php echo (isset($mensaje)) ? $mensaje : ''; ?>
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
                  <label class="col-md-3 control-label" for="password">Nueva Contraseña:</label>
                  <div class="col-md-8">
                    <input class="form-control" name="password" id="password" type="password" disabled="disabled">
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-md-3 control-label" for="confirmPass">Repetir contraseña:</label>
                  <div class="col-md-8">
                    <input class="form-control" name="confirmPass" id="confirmPass" type="password" disabled="disabled">
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-md-3 control-label"></label>
                  <div class="col-md-6">
                    <input class="btn btn-lg btn-dark" id="guardarCambios" value="Guardar cambios" type="submit" style="visibility: hidden;">
                  </div>
                  <div class="col-md-1" style="padding-top: 13px;">
                    <div class="dropup">
                      <button class="btn btn-light dropdown-toggle" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-expanded="true">
                          <span class="glyphicon glyphicon-option-vertical"></span>  
                          Opciones
                      </button>
                      <ul class="dropdown-menu" role="menu" aria-labelledby="options">
                        <li role="presentation"><a role="menuitem" tabindex="-1" href="" id="procesarBaja">Darme de baja</a></li>
                        <li role="presentation" class="divider"></li>
                        <li role="presentation"><a role="menuitem" tabindex="-1" href="#" id="cambiarInfo">Cambiar información</a></li>
                      </ul>
                    </div>
                  </div>
                </div>
              </form>
              <form class="form-horizontal" role="form" action="../sesion/borrarperfil.php" method="POST" id="borrarPerfil">
                <input type="hidden" name="id" value="<?php echo $usuario;?>" />  
              </form>
            </div>
          </div>
        </div>
    </section>
    
    <!-- Footer -->
    <?php require('./footer.php'); ?> 
    
    <!-- Incluir los modales necesarios-->
    <?php require('../modales/contacto.php'); ?>   
    <?php require('../modales/info.php'); ?> 
        
    <!-- jQuery -->
    <script src="../../js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="../../js/bootstrap.min.js"></script>
    
    <!-- Mis archivos JavaScript -->
    <script type="text/javascript" src="../../js/funciones.js"></script>
    <script type="text/javascript" src="../../js/perfil.js"></script>
</body>

</html>