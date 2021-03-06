<?php
    session_start();
    require('../bd/conexionBDlocal.php');
    $db = conectaDb();
    // Variables que representaran a la red social userid para ambas
    $userId = (isset($_POST['userid'])) ? $_POST['userid'] : "";
    if($userId == ""){
        header('Location: ../../index.php');
    }
    // Comprobar si el usuario existe en la base de datos, 
    // en este caso se hará por la password que es donde almacenaremos el userID de facebook
    $consulta = "SELECT * FROM usuarios WHERE social = :userid";
    $result = $db->prepare($consulta);
    $result->execute(array(":userid" => $userId));
    $arrayResult = $result->fetchAll();
    if($result->rowCount() > 0){
        // El usuario ya existe, iniciar sesion
        $_SESSION['idh2k'] = $arrayResult[0]['id'];
        $_SESSION['nickh2k'] = $arrayResult[0]['nick'];
        $_SESSION['nombreh2k'] = $arrayResult[0]['nombre'];
        $_SESSION['rolh2k'] = $arrayResult[0]['idrol'];
        $_SESSION['municipioh2k'] = $arrayResult[0]['idmunicipio'];
        $_SESSION['islah2k'] = $arrayResult[0]['idisla'];
        $_SESSION['emailh2k'] = $arrayResult[0]['email'];
        $_SESSION['tiempoh2k'] = date("Y-n-j H:i:s");
        header('Location: ../../index.php');
    }else{
        // Registrar al usuario
        // Comprobar si el email y el nick estan disponibles
        if(isset($_POST['registroMunicipios'])){
            $consulta = "SELECT * FROM usuarios where email=:email";
            $result = $db->prepare($consulta);
            $result->execute(array(":email" => $_POST['registroEmail']));
            // Si el email está disponible
            if((!$result->rowCount() > 0)){
                $consulta = "SELECT * FROM usuarios where nick=:nick";
                $result = $db->prepare($consulta);
                $result->execute(array(":nick" => $_POST['registroNick']));
                // Si el nick está disponible
                if((!$result->rowCount() > 0)){
                    $consulta = "INSERT INTO usuarios (email, nick, nombre, apellidos, idrol, idmunicipio, idisla, social) ";
                    $consulta .= "VALUES (:mail, :alias, :name, :sname, :rol, :mun, :isla, :userid)";

                    $result  = $db->prepare($consulta);
                    $resultado = $result->execute(array(
                        ":mail" => $_POST['registroEmail'],
                        ":alias" => $_POST['registroNick'],
                        ":name" => $_POST['registroNombre'],
                        ":sname" => $_POST['registroApellidos'],
                        ":rol" => 2,
                        ":mun" => $_POST['registroMunicipios'],
                        ":isla" => $_POST['registroIslas'],
                        ":userid" => $userId
                    ));
                    $idUsuario = $db->lastInsertId();
                    if($resultado){
                        // Enviar correo de confirmacion de la creacion del usuario
                        $para      = 'janaigus@gmail.com, info@helptoknow.esy.es,'.$_POST['registroEmail'];
                        $titulo    = 'Gracias por registrarse en Help To Know.';
                        $cabeceras  = 'MIME-Version: 1.0' . "\r\n";
                        $cabeceras .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
                        $cabeceras .= 'From: '.$_POST['registroEmail'].'' . "\r\n" .
                            'Reply-To: info@helptoknow.esy.es' . "\r\n" .
                            'X-Mailer: PHP/' . phpversion();

                        $mensaje = '<!DOCTYPE html><html lang="es">
                        <head>
                            <meta charset="utf-8">
                            <meta name="viewport" content="width=device-width, initial-scale=1">
                        </head>
                        <body>
                            <div>
                                <img src="http://helptoknow.esy.es/logo" alt="Logo" width="200" height="110">
                            </div>
                            <hr>
                            <div>
                                <h3>Se ha registrado correctamente</h3>
                            </div>
                            <hr>
                            <div>
                              <p>Ha sido registrado satisfactoriamente en Help to Know</p>
                                  <p>Datos de acceso:</p>
                                  <p>Email: '.$_POST['registroEmail'].'</p>
                                  <p>Nick dentro de la página: '.$_POST['registroNick'].'</p>
                            </div>
                            <hr>
                            <h4><strong>Help to know</strong></h4>
                            <p>P. SHERMAN, CALLE WALLABY 42,<br>SYDNEY, AU 90210</p>
                            <a href="mailto:info@helptoknow.esy.es">info@helptoknow.esy.es</a>
                        </body>
                        </html>';
                        mail($para, $titulo, $mensaje, $cabeceras);
                        // Crear las sesiones y redireccionar a index
                        $_SESSION['idh2k'] = $idUsuario;
                        $_SESSION['nickh2k'] = $_POST['registroNick'];
                        $_SESSION['nombreh2k'] = $_POST['registroNombre'];
                        $_SESSION['rolh2k'] = 2;
                        $_SESSION['municipioh2k'] = $_POST['registroMunicipios'];
                        $_SESSION['islah2k'] = $_POST['registroIslas'];
                        $_SESSION['emailh2k'] = $_POST['registroEmail'];
                        $_SESSION['tiempoh2k'] = date("Y-n-j H:i:s");
                        header('Location: ../../index.php');
                    }else{
                        $error = '<span class="glyphicon glyphicon-remove"></span>No se ha podido completar el registro';
                    }//Resultado
                }else{
                    $error = '<span class="glyphicon glyphicon-remove"></span>El nick no está disponible';
                } // Nick
            }else{
                $error = '<span class="glyphicon glyphicon-remove"></span>Ya existe un usuario regitrado con ese email';
            }
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
    <link href="../../fonts/serif-pro.css" rel="stylesheet" type="text/css">

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
                <a href="#registro" onclick = $("#menu-close").click(); >Registro</a>
            </li>
            <li>
                <a href="#contacto" onclick = $("#menu-close").click(); >Contacto</a>
            </li>
            <hr>
            <li>
                <a id="btnEntrar" href="#modalEntrar">Iniciar Sesión</a>
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
    
   <section class="services bg-primary" id="registro">
        <div class="container">
        <div class="row text-center">
            <div class="col-lg-8 col-lg-offset-2">
                <h1>Terminar registro</h1>
            </div>
        </div>    
        <div class="row">
        <div class="col-lg-6 col-lg-offset-3">
        <hr class="small">
        <form role="form" action="registrosocial.php" method="POST" id="formularioRegistrarse">
            
        <div class="alert alert-info alert-dismissable" id="panelAlertas" <?php echo (!isset($error)) ? 'style="display: none;"' : ''; ?> >
            <a class="panel-close close" data-dismiss="alert">×</a>
            <?php echo (isset($error)) ? $error : ''; ?>
        </div>
            
        <div class="row">
            <div class="col-xs-6 col-sm-6 col-md-6">
                <div class="form-group">
                    <input type="text" name="registroNombre" id="registroNombre" class="form-control input-lg" placeholder="Nombre" value="<?php echo (isset($_POST['registroNombre'])) ? $_POST['registroNombre'] : ''; ?>">  
                </div>
            </div>
            <div class="col-xs-6 col-sm-6 col-md-6">
                <div class="form-group">
                    <input type="text" name="registroApellidos" id="registroApellidos" class="form-control input-lg" placeholder="Apellidos" value="<?php echo (isset($_POST['registroApellidos'])) ? $_POST['registroApellidos'] : ''; ?>">
                </div>
            </div>
        </div>

        <div class="form-group">
            <input type="email" name="registroEmail" id="registroEmail" class="form-control input-lg" placeholder="Email" value="<?php echo (isset($_POST['registroEmail'])) ? $_POST['registroEmail'] : ''; ?>">
        </div>
        <div class="form-group">
            <input type="text" name="registroNick" id="registroNick" class="form-control input-lg" placeholder="Nick" value="<?php echo (isset($_POST['registroNick'])) ? $_POST['registroNick'] : ''; ?>">
        </div>
        <div class="row">
            <div class="col-xs-6 col-sm-6 col-md-6">
                <div class="form-group">
                    <select id="registroIslas" name="registroIslas" class="form-control input-lg">
                            <option value="0">Seleccione isla</option>
                            <?php
                                $consulta = "SELECT * FROM auxislas ORDER BY nombre";
                                $result = $db->prepare($consulta);
                                $result->execute();
                                $arrayResult = $result->fetchAll();
                                for($i=0;$i<$result->rowCount();$i++){
                                    echo '<option value="'.$arrayResult[$i]['id'].'"';
                                    if($arrayResult[$i]['id'] == $_POST['registroIslas']){
                                        echo 'selected="selected" ';
                                    }
                                    echo '>'.$arrayResult[$i]['nombre'].'</option>';
                                }
                            ?>
                    </select>
                </div>
            </div>
            <div class="col-xs-6 col-sm-6 col-md-6">
                <div class="form-group" id="cajaRegistroMunicipio">
                    <select id="registroMunicipios" name="registroMunicipios" class="form-control input-lg" <?php echo (!isset($_POST['registroMunicipios'])) ? 'disabled' : ''; ?>>
                        <?php
                        if(isset($_POST['registroMunicipios'])){
                            $consulta = "SELECT * FROM auxmunicipios WHERE idisla = :isla ORDER BY nombre";
                            $result = $db->prepare($consulta);
                            $result->execute(array(':isla' => $_POST['registroIslas']));
                            $arrayResult = $result->fetchAll();
                            for($i=0;$i<$result->rowCount();$i++){
                                echo '<option value="'.$arrayResult[$i]['id'].'"';
                                if($arrayResult[$i]['id'] == $_POST['registroMunicipios']){
                                    echo 'selected="selected" ';
                                }
                                echo '>'.$arrayResult[$i]['nombre'].'</option>';
                            }
                        }else{
                            echo '<option value="0">Seleccione municipio</option>';
                        }
                        ?>
                    </select>
                </div>
            </div>
        </div>
        <input type="hidden" name="userid" value="<?php echo (isset($_POST['userid'])) ? $_POST['userid'] : ''; ?>"/>
        <input id="registrarseBoton" type="submit" value="Registrarse" class="btn btn-lg btn-light btn-block">
    </form>
    </div>
    </div>
    </div>
    </section>
    
    <!-- Footer -->
    <?php require('../php/paginas/footer.php'); ?> 

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
    <script type="text/javascript" src="../../js/registrosocial.js"></script>

</body>

</html>