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
    // SEGURIDAD
    /*if($sesionRol != "1"){
        header("Location: ../../index.php");
    }*/
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
                <a href="../../index.php"  onclick = $("#menu-close").click(); >Help to Know</a>
            </li>
            <li>
                <a href="#comentarios" onclick = $("#menu-close").click(); >Comentarios</a>
            </li>
            <li>
                <a href="#votos" onclick = $("#menu-close").click(); >Votos</a>
            </li>
            <li>
                <a href="#actividades" onclick = $("#menu-close").click(); >Actividades</a>
            </li>
            <li>
                <a href="#usuarios" onclick = $("#menu-close").click(); >Usuarios</a>
            </li>
            <li>
                <a href="#categorias" onclick = $("#menu-close").click(); >Categorias</a>
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
                    <h1><b>Help to Know!</b></h1>
                    <h2>Administración</h2>
                </div>
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container -->
    </section>
    
    <section id="comentarios" class="services bg-primary">
        <div class="container">
          <h1 class="page-header text-center">Comentarios</h1>
          <div class="row">
              <div class="col-md-12" style="color:black;">
                  <div class="thumbnail" style="height: 350px;overflow: auto;" id="grupoComentarios">
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
$consulta =  "SELECT com.id, com.texto, DATE_FORMAT( com.created,  '%d-%m-%Y a las %k:%i' ) ";
$consulta .= " AS fecha, com.idusuario, com.idactividad, usr.nick AS nick ";
$consulta .= "FROM comentarios com ";
$consulta .= "INNER JOIN usuarios usr ON com.idusuario = usr.id ";
$consulta .= "ORDER BY com.created DESC ";
$result = $db->prepare($consulta);
$result->execute();
$arrayResult = $result->fetchAll();
for($i = 0;$i < count($arrayResult);$i++){
echo '
<div class="row text-center" style="margin: 10px 10px 10px 10px; border: 1px solid #ccc; border-radius: 4px;">
    <div class="col-xs-12 col-lg-1"  style="margin: 12px 0px 6px 0px;">
        <a href="./actividad.php?actividad='.$arrayResult[$i]['idactividad'].'">'.$arrayResult[$i]['idactividad'].'</a>
    </div>
    <div class="col-xs-12 col-lg-1" style="padding: 12px 0px 6px 0px;">
        <div>'.$arrayResult[$i]['nick'].'</div>
    </div>
    <div class="col-xs-12 col-lg-4" style="padding: 6px 0px 6px 15px;">
        <textarea id="textoComentario_'.$arrayResult[$i]['id'].'" class=" form-control" rows="1" style="resize:vertical;" maxlength="250" disabled="disabled">'.$arrayResult[$i]['texto'].'</textarea>
    </div>
    <div class="col-xs-12 col-lg-2" style="padding: 12px 0px 6px 0px;">
        <div>'.$arrayResult[$i]['fecha'].'</div>
    </div>
    <div class="col-xs-12 col-lg-2" style="padding: 8px 0px 6px 0px;">
        <button id="confirmarEditarComentario_'.$arrayResult[$i]['id'].'" class="btn btn-sm btn-light" style="display: none;"><span class="glyphicon glyphicon-save"></span> Guardar </button>
        <button id="editarComentario_'.$arrayResult[$i]['id'].'" class="btn btn-sm btn-light"><span class="glyphicon glyphicon-edit"></span> Editar </button>
    </div>
    <div class="col-xs-12 col-lg-2" style="padding: 8px 0px 6px 0px;">
        <button id="borrarComentario_'.$arrayResult[$i]['id'].'" class="btn btn-sm btn-light"><span class="glyphicon glyphicon-trash"></span> Borrar </button>
    </div>
</div>
';
}
?>
                  </div>
              </div>
          </div>
        </div>
    </section>
    
    <section id="votos" class="portfolio">
        <div class="container">
          <h1 class="page-header text-center">Votos</h1>
          <div class="row">
              <div class="col-md-12" style="color:black;">
                  <div class="thumbnail" style="height: 350px;overflow: auto;" id="grupoVotos">
                      <div class="row text-center" style="margin: 10px 10px 10px 15px;color:rgb(0,122,135);">
                            <div class="col-xs-2 col-lg-1"  style="margin: 6px 0px 6px 0px;">
                                Actividad
                            </div>
                            <div class="col-xs-2 col-lg-1" style="margin: 6px 0px 6px 0px;">
                                Usuario
                            </div>
                            <div class="col-xs-2 col-lg-4" style="margin: 6px 0px 6px 0px;">
                                Votos
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
$consulta =  "SELECT vot.id, vot.valoracion, DATE_FORMAT( vot.created,  '%d-%m-%Y a las %k:%i' ) ";
$consulta .= " AS fecha, vot.idusuario, vot.idactividad, usr.nick AS nick ";
$consulta .= "FROM votos vot ";
$consulta .= "INNER JOIN usuarios usr ON vot.idusuario = usr.id ";
$consulta .= "ORDER BY vot.created DESC ";
$result = $db->prepare($consulta);
$result->execute();
$arrayResult = $result->fetchAll();

for($i = 0;$i < count($arrayResult);$i++){
echo '
<div class="row text-center" style="margin: 10px 10px 10px 10px; border: 1px solid #ccc; border-radius: 4px;">
    <div class="col-xs-12 col-lg-1"  style="margin: 12px 0px 6px 0px;">
        <a href="./actividad.php?actividad='.$arrayResult[$i]['idactividad'].'">'.$arrayResult[$i]['idactividad'].'</a>
    </div>
    <div class="col-xs-12 col-lg-1" style="padding: 12px 0px 6px 0px;">
        <div>'.$arrayResult[$i]['nick'].'</div>
    </div>
    <div class="col-xs-12 col-lg-4" style="padding: 6px 0px 6px 15px;">
        <select id="selectVoto_'.$arrayResult[$i]['id'].'" class="form-control" disabled="disabled">
          <option value="1" '.(($arrayResult[$i]['valoracion'] == 1) ? "selected='selected'" : "").'>1</option>
          <option value="2" '.(($arrayResult[$i]['valoracion'] == 2) ? "selected='selected'" : "").'>2</option>
          <option value="3" '.(($arrayResult[$i]['valoracion'] == 3) ? "selected='selected'" : "").'>3</option>
          <option value="4" '.(($arrayResult[$i]['valoracion'] == 4) ? "selected='selected'" : "").'>4</option>
          <option value="5" '.(($arrayResult[$i]['valoracion'] == 5) ? "selected='selected'" : "").'>5</option>
        </select>
    </div>
    <div class="col-xs-12 col-lg-2" style="padding: 12px 0px 6px 0px;">
        <div>'.$arrayResult[$i]['fecha'].'</div>
    </div>
    <div class="col-xs-12 col-lg-2" style="padding: 8px 0px 6px 0px;">
        <button id="confirmarEditarVoto_'.$arrayResult[$i]['id'].'" class="btn btn-sm btn-light" style="display: none;"><span class="glyphicon glyphicon-save"></span> Guardar </button>
        <button id="editarVoto_'.$arrayResult[$i]['id'].'" class="btn btn-sm btn-light"><span class="glyphicon glyphicon-edit"></span> Editar </button>
    </div>
    <div class="col-xs-12 col-lg-2" style="padding: 8px 0px 6px 0px;">
        <button id="borrarVoto_'.$arrayResult[$i]['id'].'" class="btn btn-sm btn-light"><span class="glyphicon glyphicon-trash"></span> Borrar </button>
    </div>
</div>
';
}
?>
                  </div>
              </div>
          </div>
        </div>
    </section>
    
    <section id="actividades" class="services bg-primary">
        <div class="container">
          <h1 class="page-header text-center">Actividades</h1>
          <div class="row">
              <div class="col-md-12" style="color:black;">
                  <div class="thumbnail" style="height: 350px;overflow: auto;" id="grupoActividades">
                       <div class="row text-center" style="margin: 10px 10px 10px 40px;color:rgb(0,122,135);">
                            <div class="col-xs-2 col-lg-2"  style="margin: 6px 0px 6px 0px;">
                                Categoria
                            </div>
                            <div class="col-xs-2 col-lg-1"  style="margin: 6px 0px 6px 0px;">
                                Isla
                            </div>
                            <div class="col-xs-2 col-lg-2"  style="margin: 6px 0px 6px 0px;">
                                Municipio
                            </div>
                            <div class="col-xs-2 col-lg-1" style="margin: 6px 0px 6px 0px;">
                                Usuario
                            </div>
                            <div class="col-xs-2 col-lg-2" style="margin: 6px 0px 6px 0px;">
                                Titulo
                            </div>
                            <div class="col-xs-2 col-lg-2" style="margin: 6px 0px 6px 0px;">
                                Descripción
                            </div>
                            <div class="col-xs-2 col-lg-1" style="margin: 6px 0px 6px 0px;">
                                Acción
                            </div>
                        </div>
<?php
$consulta = "SELECT * FROM auxcategorias ORDER BY nombre";
$result = $db->prepare($consulta);
$result->execute();
$categorias = $result->fetchAll();
                                        
$consulta = "SELECT act.id, act.titulo, act.descripcion, DATE_FORMAT(act.created, '%d-%m-%Y') AS creada, ";
$consulta .= "act.idcategoria, cat.nombre AS categoria, u.nick AS nickusuario, act.idmunicipio, ";
$consulta .= "act.idisla, i.nombre AS nombreisla, m.nombre AS nombremunicipio ";
$consulta .= "FROM actividades act ";
$consulta .= "INNER JOIN auxcategorias cat ON act.idcategoria = cat.id ";
$consulta .= "INNER JOIN auxislas i ON act.idisla = i.id ";
$consulta .= "INNER JOIN auxmunicipios m ON act.idmunicipio = m.id ";
$consulta .= "INNER JOIN usuarios u ON act.idusuario = u.id ";
$consulta .= "ORDER BY act.idisla";
$result = $db->prepare($consulta);
$result->execute();
$arrayResult = $result->fetchAll();

for($i = 0;$i < count($arrayResult);$i++){
echo '
<div class="row text-center" style="margin: 10px 10px 10px 10px; border: 1px solid #ccc; border-radius: 4px;">
    <div class="col-xs-12 col-lg-2"  style="margin: 12px 0px 6px 15px;">
        <select id="categoriaActividad_'.$arrayResult[$i]['id'].'" class="form-control" disabled="disabled">
        '; // echo
    
        for($z=0;$z<count($categorias);$z++){
            echo '<option value="'.$categorias[$z]['id'].'"';
            if($arrayResult[$i]['categoria'] == $categorias[$z]['nombre']){
                echo ' selected="selected" ';
            }
            echo '>'.$categorias[$z]['nombre'].'</option>';
        }
    
    
    echo '
    </select>
    </div>
    <div class="col-xs-12 col-lg-1" style="padding: 12px 0px 6px 0px;">
        <select id="islaActividad_'.$arrayResult[$i]['id'].'" class="form-control" disabled="disabled">
        '; // echo
        
        $otrodb = conectaDb();
        $consulta = "SELECT * FROM auxislas";
        $resultado = $otrodb->prepare($consulta);
        $resultado->execute();
        $islas = $resultado->fetchAll();
        for($z=0;$z<count($islas);$z++){
            echo '<option value="'.$islas[$z]['id'].'"';
            if($arrayResult[$i]['idisla'] == $islas[$z]['id']){
                echo ' selected="selected" ';
            }
            echo '>'.$islas[$z]['nombre'].'</option>';
        }

    echo ' </select>
    </div>
    <div class="col-xs-12 col-lg-2" style="padding: 12px 0px 6px 15px;">
        <select id="municipioActividad_'.$arrayResult[$i]['id'].'" class="form-control" disabled="disabled">
    '; // echo
    
        $otrodb = conectaDb();
        $consulta = "SELECT * FROM auxmunicipios WHERE idisla = :isla ORDER BY nombre";
        $resultado = $otrodb->prepare($consulta);
        $resultado->execute(array( ':isla' => $arrayResult[$i]['idisla'] ) );
        $municipios = $resultado->fetchAll();
        for($z=0;$z<count($municipios);$z++){
            echo '<option value="'.$municipios[$z]['id'].'"';
            if($arrayResult[$i]['idmunicipio'] == $municipios[$z]['id']){
                echo ' selected="selected" ';
            }
            echo '>'.$municipios[$z]['nombre'].'</option>';
        }
    
    echo '</select>
    </div>
    <div class="col-xs-12 col-lg-1" style="padding: 18px 0px 6px 0px;">
        <div>'.$arrayResult[$i]['nickusuario'].'</div>
    </div>
    <div class="col-xs-12 col-lg-2" style="padding: 12px 0px 6px 0px;">
        <textarea id="tituloActividad_'.$arrayResult[$i]['id'].'" class=" form-control" rows="1" style="resize:vertical;" maxlength="250" disabled="disabled">'.$arrayResult[$i]['titulo'].'</textarea>
    </div>
    <div class="col-xs-12 col-lg-2" style="padding: 12px 0px 6px 15px;">
        <textarea id="descripcionActividad_'.$arrayResult[$i]['id'].'" class=" form-control" rows="1" style="resize:vertical;" maxlength="250" disabled="disabled">'.$arrayResult[$i]['descripcion'].'</textarea>
    </div>
    <div class="col-xs-12 col-lg-1" style="padding: 14px 0px 6px 0px;">
        <button id="confirmarEditarActividad_'.$arrayResult[$i]['id'].'" class="btn btn-sm btn-light" style="display: none;"><span class="glyphicon glyphicon-save"></span></button>
        <button id="editarActividad_'.$arrayResult[$i]['id'].'" class="btn btn-sm btn-light"><span class="glyphicon glyphicon-edit"></span> </button>
        <button id="borrarActividad_'.$arrayResult[$i]['id'].'" class="btn btn-sm btn-light"><span class="glyphicon glyphicon-trash"></span> </button>
    </div>
</div>
';
}
?>
                  </div>
              </div>
          </div>
        </div>
    </section>
       
    <section id="usuarios" class="portfolio">
        <div class="container">
          <h1 class="page-header text-center">Usuarios</h1>
          <div class="row">
              <div class="col-md-12" style="color:black;">
                  <div class="thumbnail" style="height: 350px;overflow: auto;" id="grupoVotos">
                      <div class="row text-center" style="margin: 10px 10px 10px 15px;color:rgb(0,122,135);">
                            <div class="col-xs-2 col-lg-3"  style="margin: 6px 0px 6px 0px;">
                                Nombre
                            </div>
                            <div class="col-xs-2 col-lg-2" style="margin: 6px 0px 6px 0px;">
                                Email
                            </div>
                            <div class="col-xs-2 col-lg-2" style="margin: 6px 0px 6px 0px;">
                                Nick
                            </div>
                            <div class="col-xs-2 col-lg-2" style="margin: 6px 0px 6px 0px;">
                                Fecha creado
                            </div>
                            <div class="col-xs-2 col-lg-2" style="margin: 6px 0px 6px 0px;">
                                Perfil
                            </div>
                        </div>
<?php
// Crear todas las filas necesarias para los comentarios
$consulta =  "SELECT * , DATE_FORMAT( created,  '%d-%m-%Y a las %k:%i' ) AS creado ";
$consulta .= "FROM usuarios ";
$consulta .= "ORDER BY usuarios.created DESC ";
$result = $db->prepare($consulta);
$result->execute();
$arrayResult = $result->fetchAll();

for($i = 0;$i < count($arrayResult);$i++){
echo '
<div class="row text-center" style="margin: 10px 10px 10px 10px; border: 1px solid #ccc; border-radius: 4px;">
    <div class="col-xs-12 col-lg-3"  style="margin: 12px 0px 6px 0px;">
        <div>'.$arrayResult[$i]['nombre'].' '.$arrayResult[$i]['apellidos'].'</div>
    </div>
    <div class="col-xs-12 col-lg-2" style="padding: 12px 0px 6px 0px;">
        <div>'.$arrayResult[$i]['email'].'</div>
    </div>
    <div class="col-xs-12 col-lg-2" style="padding: 12px 0px 6px 0px;">
        <div>'.$arrayResult[$i]['nick'].'</div>
    </div>
    <div class="col-xs-12 col-lg-2" style="padding: 12px 0px 6px 0px;">
        <div>'.$arrayResult[$i]['creado'].'</div>
    </div>
    <div class="col-xs-12 col-lg-2" style="padding: 8px 0px 6px 0px;">
        <a href="./perfil.php?usuario='.$arrayResult[$i]['id'].'" class="btn btn-sm btn-light"><span class="glyphicon glyphicon-user"></span> Modificar perfil </a>
    </div>
</div>
';
}
?>
                  </div>
              </div>
          </div>
        </div>
    </section>
    
    <section id="categorias" class="services bg-primary">
        <div class="container">
          <h1 class="page-header text-center">Categorias</h1>
          <div class="row">
              <div class="col-md-8" style="color:black;">
                  <div class="thumbnail" style="height: 350px;overflow: auto;" id="grupoCategorias">
                      <div class="row text-center" style="margin: 10px 10px 10px 15px;color:rgb(0,122,135);">
                            <div class="col-xs-2 col-lg-4"  style="margin: 6px 0px 6px 0px;">
                                Nombre
                            </div>
                            <div class="col-xs-2 col-lg-3" style="margin: 6px 0px 6px 0px;">
                                Fecha
                            </div>
                            <div class="col-xs-2 col-lg-3" style="margin: 6px 0px 6px 0px;">
                                Editar
                            </div>
                            <div class="col-xs-2 col-lg-2" style="margin: 6px 0px 6px 0px;">
                                Borrar
                            </div>
                        </div>
<?php
// Crear todas las filas necesarias para los comentarios
$consulta =  "SELECT * , DATE_FORMAT( created,  '%d-%m-%Y a las %k:%i' ) AS creado ";
$consulta .= "FROM auxcategorias ";
$consulta .= "ORDER BY created DESC ";
$result = $db->prepare($consulta);
$result->execute();
$arrayResult = $result->fetchAll();
for($i = 0;$i < count($arrayResult);$i++){
echo '
<div class="row text-center" style="margin: 10px 10px 10px 10px; border: 1px solid #ccc; border-radius: 4px;">
    <div class="col-xs-12 col-lg-4"  style="margin: 6px 0px 6px 0px;">
        <input type="text" class="form-control" id="nombreCategoria_'.$arrayResult[$i]['id'].'" value="'.$arrayResult[$i]['nombre'].'" disabled="disabled"/>
    </div>
    <div class="col-xs-12 col-lg-3" style="padding: 12px 0px 6px 0px;">
        <div>'.$arrayResult[$i]['creado'].'</div>
    </div>
    <div class="col-xs-12 col-lg-3" style="padding: 8px 0px 6px 0px;">
        <button id="confirmarEditarCategoria_'.$arrayResult[$i]['id'].'" class="btn btn-sm btn-light" style="display: none;"><span class="glyphicon glyphicon-save"></span> Guardar </button>
        <button id="editarCategoria_'.$arrayResult[$i]['id'].'" class="btn btn-sm btn-light"><span class="glyphicon glyphicon-edit"></span> Editar </button>
    </div>
    <div class="col-xs-12 col-lg-2" style="padding: 8px 0px 6px 0px;">
        <button id="borrarCategoria_'.$arrayResult[$i]['id'].'" class="btn btn-sm btn-light"><span class="glyphicon glyphicon-trash"></span> Borrar </button>
    </div>
</div>
';
}
?>
                  </div>
              </div>
              <div class="col-md-3 col-md-offset-1" style="color:black;">
                  <div class="thumbnail" id="grupoCategorias">
                      <div class="row text-center" style="margin: 15px 10px 10px 10px;">
                            <div class="alert alert-info alert-dismissable" id="panelAlertasCategorias" style="display:none;">
                                <a class="panel-close close" data-dismiss="alert">×</a> 
                                <div id="mensajeAlertasCategorias"></div>
                            </div>
                            <form class="form" action="../acciones/categoria.php" method="POST" id="formularioNuevaCategoria">
                            <h4 style="color:rgb(0,122,135);">Crear categoria</h4>
                            <input type="text" class="form-control" name="nombre" id="nombreNuevaCategoria" />
                            <br/>
                            <button type="submit" name="comando" value="agregar" id="botonNuevaCategoria" class="btn btn-light">
                                <span class="glyphicon glyphicon-plus"></span> 
                                Añadir categoria
                            </button>
                            </form>
                      </div>
                  </div>
              </div>
          </div>
        </div>
    </section>

  
    <section id="votos" class="portfolio">
        <div class="container">
          <h1 class="page-header text-center">Centros educativos</h1>
          <div class="row">
              <div class="col-md-12" style="color:black;">
                  <div class="thumbnail" style="height: 350px;overflow: auto;" id="grupoVotos">
                      <div class="row text-center" style="margin: 10px 10px 10px 15px;color:rgb(0,122,135);">
                            <div class="col-xs-2 col-lg-1"  style="margin: 6px 0px 6px 0px;">
                                Actividad
                            </div>
                            <div class="col-xs-2 col-lg-1" style="margin: 6px 0px 6px 0px;">
                                Usuario
                            </div>
                            <div class="col-xs-2 col-lg-4" style="margin: 6px 0px 6px 0px;">
                                Votos
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
$consulta =  "SELECT vot.id, vot.valoracion, DATE_FORMAT( vot.created,  '%d-%m-%Y a las %k:%i' ) ";
$consulta .= " AS fecha, vot.idusuario, vot.idactividad, usr.nick AS nick ";
$consulta .= "FROM votos vot ";
$consulta .= "INNER JOIN usuarios usr ON vot.idusuario = usr.id ";
$consulta .= "ORDER BY vot.created DESC ";
$result = $db->prepare($consulta);
$result->execute();
$arrayResult = $result->fetchAll();

for($i = 0;$i < count($arrayResult);$i++){
echo '
<div class="row text-center" style="margin: 10px 10px 10px 10px; border: 1px solid #ccc; border-radius: 4px;">
    <div class="col-xs-12 col-lg-1"  style="margin: 12px 0px 6px 0px;">
        <a href="./actividad.php?actividad='.$arrayResult[$i]['idactividad'].'">'.$arrayResult[$i]['idactividad'].'</a>
    </div>
    <div class="col-xs-12 col-lg-1" style="padding: 12px 0px 6px 0px;">
        <div>'.$arrayResult[$i]['nick'].'</div>
    </div>
    <div class="col-xs-12 col-lg-4" style="padding: 6px 0px 6px 15px;">
        <select id="selectVoto_'.$arrayResult[$i]['id'].'" class="form-control" disabled="disabled">
          <option value="1" '.(($arrayResult[$i]['valoracion'] == 1) ? "selected='selected'" : "").'>1</option>
          <option value="2" '.(($arrayResult[$i]['valoracion'] == 2) ? "selected='selected'" : "").'>2</option>
          <option value="3" '.(($arrayResult[$i]['valoracion'] == 3) ? "selected='selected'" : "").'>3</option>
          <option value="4" '.(($arrayResult[$i]['valoracion'] == 4) ? "selected='selected'" : "").'>4</option>
          <option value="5" '.(($arrayResult[$i]['valoracion'] == 5) ? "selected='selected'" : "").'>5</option>
        </select>
    </div>
    <div class="col-xs-12 col-lg-2" style="padding: 12px 0px 6px 0px;">
        <div>'.$arrayResult[$i]['fecha'].'</div>
    </div>
    <div class="col-xs-12 col-lg-2" style="padding: 8px 0px 6px 0px;">
        <button id="confirmarEditarVoto_'.$arrayResult[$i]['id'].'" class="btn btn-sm btn-light" style="display: none;"><span class="glyphicon glyphicon-save"></span> Guardar </button>
        <button id="editarVoto_'.$arrayResult[$i]['id'].'" class="btn btn-sm btn-light"><span class="glyphicon glyphicon-edit"></span> Editar </button>
    </div>
    <div class="col-xs-12 col-lg-2" style="padding: 8px 0px 6px 0px;">
        <button id="borrarVoto_'.$arrayResult[$i]['id'].'" class="btn btn-sm btn-light"><span class="glyphicon glyphicon-trash"></span> Borrar </button>
    </div>
</div>
';
}
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
                <h2>¿Realmente desea BORRAR?</h2>
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