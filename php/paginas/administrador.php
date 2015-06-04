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
    // Traer elementos de la base de datos
    require('../bd/conexionBDlocal.php');
    $db = conectaDb();
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
                <a href="#top"  onclick = $("#menu-close").click(); >Help to Know</a>
            </li>
            <li>
                <a href="#top" onclick = $("#menu-close").click(); >Home</a>
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
                    <a href="../cerrarsesion.php">Cerrar Sesión</a>
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
                    <h1><b>Help to Know!</b></h1>
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
          <h1 class="page-header text-center">Comentarios</h1>
          <div class="row">
              <div class="col-md-12" style="color:black;height: 350px;overflow: auto;">
                  <div class="thumbnail" style="">
                      <div class="row text-center" style="margin: 10px 10px 10px 15px;color:rgb(0,122,135);">
                            <div class="col-xs-2 col-lg-1"  style="margin: 6px 0px 6px 0px;">
                                Actividad
                            </div>
                            <div class="col-xs-2 col-lg-1" style="margin: 6px 0px 6px 0px;">
                                Usuario
                            </div>
                            <div class="col-xs-2 col-lg-4" style="margin: 6px 0px 6px 0px;">
                                Texto
                            </div>
                            <div class="col-xs-2 col-lg-2" style="margin: 6px 0px 6px 0px;">
                                Fecha
                            </div>
                            <div class="col-xs-2 col-lg-2" style="margin: 6px 0px 6px 0px;">
                                Editar
                            </div>
                            <div class="col-xs-2 col-lg-2" style="margin: 6px 0px 6px 0px;">
                                Borrar
                            </div>
                        </div>
<?php
// Crear todas las filas necesarias para los comentarios
echo '
<div class="row text-center" style="margin: 10px 10px 10px 10px; border: 1px solid #ccc; border-radius: 4px;">
    <div class="col-xs-2 col-lg-1"  style="margin: 12px 0px 6px 0px;">
        <a id="comentarioActividadId"> asd</a>
    </div>
    <div class="col-xs-2 col-lg-1" style="margin: 12px 0px 6px 0px;">
        <a id="comentarioUsuarioId"> asd</a>
    </div>
    <div class="col-xs-2 col-lg-4" style="margin: 6px 0px 6px 0px;">
        <textarea id="comentarioTextoId"class=" form-control" rows="1" style="resize:vertical;" maxlength="250" disabled="disabled"></textarea>
    </div>
    <div class="col-xs-2 col-lg-2" style="margin: 12px 0px 6px 0px;">
        <div id="comentarioFechaId">algo</div>
    </div>
    <div class="col-xs-2 col-lg-2" style="margin: 8px 0px 6px 0px;">
        <button id="comentarioEditarId" class="btn btn-sm btn-light"><span class="glyphicon glyphicon-edit"></span> Editar </button>
    </div>
    <div class="col-xs-2 col-lg-2" style="margin: 8px 0px 6px 0px;">
        <button id="comentarioBorrarId" class="btn btn-sm btn-light"><span class="glyphicon glyphicon-trash"></span> Borrar </button>
    </div>
</div>
';
?>
                  </div>
              </div>
          </div>
        </div>
    </section>
    
    <!-- Modal Información-->
    <div class="modal fade" id="modalWarning" role="dialog">
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
            <div class="modal-body text-center">
                <h2>¿Realmente desea hacer esto?</h2>
                <p class="lead">Una vez confirmada la accion no podrá volver atras.</p>
                <hr class="small">
                <button class="btn btn-lg btn-danger" id="warningConfirmar"> Si</button>
                <button class="btn btn-lg btn-light" data-dismiss="modal">No</button>
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
    <script type="text/javascript" src="../../js/administrador.js"></script>
        
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