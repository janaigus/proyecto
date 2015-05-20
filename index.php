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
                <a href="#valoradas" onclick = $("#menu-close").click(); >Mejor Valoradas</a>
            </li>
            <li>
                <a href="#recientes" onclick = $("#menu-close").click(); >Más Recientes</a>
            </li>
            <li>
                <a href="#islas" onclick = $("#menu-close").click(); >Nuestras Islas</a>
            </li>
            <li>
                <a href="#contacto" oonclick = $("#menu-close").click(); >Contacto</a>
            </li>
            <hr>
            <li>
                <a id="btnEntrar" href="#modalEntrar">Iniciar Sesión</a>
            </li>
            <li>
                <a id="btnLateralRegistrarse" href="#modalRegistrarse">Registrarse</a>
            </li>
        </ul>
    </nav>

    <!-- Header -->
    <header id="top" class="header">
        <div class="text-vertical-center">
            <h1><img src="img/logo.png" height="200" width="350"></h1>
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
                                <div class="carousel-inner">
                                    <div class="item active">
                                        <div class="row">
                                            <div class="col-xs-12 col-sm-12 col-md-6">
                                                <a href=" "> <img src="img/logo.png" class="thumbnail"
                                                    alt="Image" height="100%" width="100%" /></a>
                                            </div>
                                            <div class="col-xs-12 col-sm-12 col-md-6" style="text-align: left;">
                                                <h3>Titulo actividad 1</h3>
                                                <h4>Subheading</h4>
                                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ut, odit velit cumque vero doloremque repellendus distinctio maiores rem expedita a nam vitae modi quidem similique ducimus! Velit, esse totam tempore.</p>
                                                <div class="ratings">
                                                    <p class="pull-right" style="color:#fff">11 reviews</p>
                                                    <p>
                                                        <span class="fa fa-star-o"></span>
                                                        <span class="glyphicon glyphicon-star"></span>
                                                        <span class="glyphicon glyphicon-star"></span>
                                                        <span class="glyphicon glyphicon-star-empty"></span>
                                                        <span class="glyphicon glyphicon-star-empty"></span>
                                                    </p>
                                                </div>
                                                <a href="#" class="btn btn-lg btn-light">Ver más<span class="glyphicon glyphicon-chevron-right"></span></a>
                                            </div>
                                        </div>
                                        <!--/row-fluid-->
                                    </div>
                                    <!--/item-->
                                    <div class="item ">
                                        <div class="row">
                                            <div class="col-xs-12 col-sm-12 col-md-6">
                                                <a href=" "> <img src="img/logo.png" class="thumbnail"
                                                    alt="Image" height="100%" width="100%" /></a>
                                            </div>
                                            <div class="col-xs-12 col-sm-12 col-md-6" style="text-align: left;">
                                                <h3>Titulo actividad 2</h3>
                                                <h4>Subheading</h4>
                                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ut, odit velit cumque vero doloremque repellendus distinctio maiores rem expedita a nam vitae modi quidem similique ducimus! Velit, esse totam tempore.</p>
                                                <div class="ratings">
                                                    <p class="pull-right" style="color:#fff">10 reviews</p>
                                                    <p>
                                                        <span class="glyphicon glyphicon-star"></span>
                                                        <span class="glyphicon glyphicon-star"></span>
                                                        <span class="glyphicon glyphicon-star"></span>
                                                        <span class="glyphicon glyphicon-star"></span>
                                                        <span class="glyphicon glyphicon-star-empty"></span>
                                                    </p>
                                                </div>
                                                <a href="#" class="btn btn-lg btn-light">Ver más<span class="glyphicon glyphicon-chevron-right"></span></a>
                                            </div>
                                        </div>
                                        <!--/row-fluid-->
                                    </div>
                                    <!--/item-->
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
                                <div class="carousel-inner">
                                    <div class="item active">
                                        <div class="row">
                                            <div class="col-xs-12 col-sm-12 col-md-6">
                                                <a href=" "> <img src="img/logo.png" class="thumbnail"
                                                    alt="Image" height="100%" width="100%" /></a>
                                            </div>
                                            <div class="col-xs-12 col-sm-12 col-md-6" style="text-align: left;">
                                                <h3>Titulo actividad 1</h3>
                                                <h4>Subheading</h4>
                                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ut, odit velit cumque vero doloremque repellendus distinctio maiores rem expedita a nam vitae modi quidem similique ducimus! Velit, esse totam tempore.</p>
                                                <div class="ratings">
                                                    <p class="pull-right" style="color:#fff">6 reviews</p>
                                                    <p>
                                                        <span class="glyphicon glyphicon-star"></span>
                                                        <span class="glyphicon glyphicon-star"></span>
                                                        <span class="glyphicon glyphicon-star"></span>
                                                        <span class="glyphicon glyphicon-star"></span>
                                                        <span class="glyphicon glyphicon-star-empty"></span>
                                                    </p>
                                                </div>
                                                <a href="#" class="btn btn-lg btn-light">Ver más<span class="glyphicon glyphicon-chevron-right"></span></a>
                                            </div>
                                        </div>
                                        <!--/row-fluid-->
                                    </div>
                                    <!--/item-->
                                    <div class="item ">
                                        <div class="row">
                                            <div class="col-xs-12 col-sm-12 col-md-6">
                                                <a href=" "> <img src="img/logo.png" class="thumbnail"
                                                    alt="Image" height="100%" width="100%" /></a>
                                            </div>
                                            <div class="col-xs-12 col-sm-12 col-md-6" style="text-align: left;">
                                                <h3>Titulo actividad 2</h3>
                                                <h4>Subheading</h4>
                                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ut, odit velit cumque vero doloremque repellendus distinctio maiores rem expedita a nam vitae modi quidem similique ducimus! Velit, esse totam tempore.</p>
                                                <div class="ratings">
                                                    <p class="pull-right" style="color:#fff">7 reviews</p>
                                                    <p>
                                                        <span class="glyphicon glyphicon-star"></span>
                                                        <span class="glyphicon glyphicon-star"></span>
                                                        <span class="glyphicon glyphicon-star"></span>
                                                        <span class="glyphicon glyphicon-star"></span>
                                                        <span class="glyphicon glyphicon-star-empty"></span>
                                                    </p>
                                                </div>
                                                <a href="#" class="btn btn-lg btn-light">Ver más<span class="glyphicon glyphicon-chevron-right"></span></a>
                                            </div>
                                        </div>
                                        <!--/row-fluid-->
                                    </div>
                                    <!--/item-->
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
                                <a href="#" class="portfolio-box">
                                    <img src="img/portfolio-2.jpg" class="img-responsive" alt="">
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
                                <a href="#" class="portfolio-box">
                                    <img src="img/portfolio-2.jpg" class="img-responsive" alt="">
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
                                <a href="#" class="portfolio-box">
                                    <img src="img/portfolio-2.jpg" class="img-responsive" alt="">
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
                                <a href="#" class="portfolio-box">
                                    <img src="img/portfolio-2.jpg" class="img-responsive" alt="">
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
                                <a href="#" class="portfolio-box">
                                    <img src="img/portfolio-2.jpg" class="img-responsive" alt="">
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
                                <a href="#" class="portfolio-box">
                                    <img src="img/portfolio-2.jpg" class="img-responsive" alt="">
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
                                <a href="#" class="portfolio-box">
                                    <img src="img/portfolio-2.jpg" class="img-responsive" alt="">
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

        
    <!-- Call to Action -->
    <aside class="call-to-action bg-primary">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h3>The buttons below are impossible to resist.</h3>
                    <a href="#" class="btn btn-lg btn-light">Click Me!</a>
                    <a href="#" class="btn btn-lg btn-dark">Look at Me!</a>
                </div>
            </div>
        </div>
    </aside>

    <!-- Map -->

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
                        <li><i class="fa fa-envelope-o fa-fw"></i>  <a href="#modalContacto" id="btnContacto">info@helptoknow.esy.es</a>
                        </li>
                    </ul>
                    <br>
                    <ul class="list-inline">
                        <li>
                            <a href="#"><i class="fa fa-facebook fa-fw fa-3x"></i></a>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-twitter fa-fw fa-3x"></i></a>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-dribbble fa-fw fa-3x"></i></a>
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
                    <img src="img/logo.png" alt="Logo" width="180" height="95">
                    <h3 class="modal-title"><b>Iniciar sesión</b></h3>
                  </div>
              </div>
            </div>
            <div class="modal-body">
                  <form class="form">
                    <div class="form-group">
                        <div class="inner-addon left-addon">
                            <i class="glyphicon glyphicon-user"></i>
                            <input type="text" id="emailinicio" class="form-control input-lg" placeholder="Email"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="inner-addon left-addon">
                            <i class="glyphicon glyphicon-lock"></i>
                            <input type="password" class="form-control input-lg" placeholder="Password"/>
                        </div>
                    </div>
                    <div class="form-group">
                      <button class="btn btn-lg btn-light btn-block">Iniciar sesión</button>
                      <span class="pull-right"><a href="#">Registrarse</a></span><span><a href="#">Ayuda</a></span>
                    </div>
                    <hr>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-lg-4  text-center" style="padding: 6px 0px 6px 0px">
                                <a href='#' class="btn btn-light facebook"> <i class="fa fa-facebook modal-icons"></i> Entrar con Facebook </a>
                            </div>
                            <div class="col-lg-4 text-center" style="padding: 6px 0px 6px 0px">
                                <a href='#' class="btn btn-light twitter"> <i class="fa fa-twitter modal-icons"></i> Entrar con Twitter </a>
                            </div>
                            <div class="col-lg-4 text-center" style="padding: 6px 0px 6px 0px">
                                <a href='#' class="btn btn-light google"> <i class="fa fa-google-plus modal-icons"></i> Entrar con Google </a>
                            </div>
                        </div>
                    </div>
                  </form>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-lg btn-dark" data-dismiss="modal">Cancelar</button>
            </div>
          </div>
        </div>
    </div>
        
    <!-- Modal Registro-->
    <div class="modal fade" id="modalRegistrarse" role="dialog">
        <div class="modal-dialog">
          <!-- Modal content-->
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              <div class="row">
                  <div class="col-lg-4 col-lg-offset-4 text-center">
                    <img src="img/logo.png" alt="Logo" width="180" height="95">
                    <h3 class="modal-title"><b>Registrarse</b></h3>
                  </div>
              </div>
            </div>
            <div class="modal-body">
                <form role="form">
                    <div class="row">
                        <div class="col-xs-6 col-sm-6 col-md-6">
                            <div class="form-group">
                                <input type="text" name="first_name" id="first_name" class="form-control input-sm" placeholder="Nombre">  
                            </div>
                        </div>
                        <div class="col-xs-6 col-sm-6 col-md-6">
                            <div class="form-group">
                                <input type="text" name="last_name" id="last_name" class="form-control input-sm" placeholder="Apellidos">
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <input type="email" name="email" id="email" class="form-control input-sm" placeholder="Email">
                    </div>

                    <div class="row">
                        <div class="col-xs-6 col-sm-6 col-md-6">
                            <div class="form-group">
                                <input type="password" name="password" id="password" class="form-control input-sm" placeholder="Contraseña">
                            </div>
                        </div>
                        <div class="col-xs-6 col-sm-6 col-md-6">
                            <div class="form-group">
                                <input type="password" name="password_confirmation" id="password_confirmation" class="form-control input-sm" placeholder="Repetir Contraseña">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-6 col-sm-6 col-md-6">
                            <div class="form-group">
                                <select id="registroIslas" class="form-control">
                                  <option>Seleccione isla</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-xs-6 col-sm-6 col-md-6">
                            <div class="form-group">
                                <select id="resgistroMunicipios" class="form-control" disabled>
                                  <option>Seleccione municipio</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <input type="submit" value="Registrarse" class="btn btn-lg btn-light btn-block">
                    <hr>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-lg-4  text-center" style="padding: 6px 0px 6px 0px">
                                <a href='#' class="btn btn-light facebook"> <i class="fa fa-facebook modal-icons"></i> Entrar con Facebook </a>
                            </div>
                            <div class="col-lg-4 text-center" style="padding: 6px 0px 6px 0px">
                                <a href='#' class="btn btn-light twitter"> <i class="fa fa-twitter modal-icons"></i> Entrar con Twitter </a>
                            </div>
                            <div class="col-lg-4 text-center" style="padding: 6px 0px 6px 0px">
                                <a href='#' class="btn btn-light google"> <i class="fa fa-google-plus modal-icons"></i> Entrar con Google </a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-lg btn-dark" data-dismiss="modal">Cancelar</button>
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
                    <img src="img/logo.png" alt="Logo" width="180" height="95">
                    <h3 class="modal-title"><b>Contacto</b></h3>
                  </div>
              </div>
            </div>
            <div class="modal-body">
                  <form class="form" action="php/contacto.php" method="POST" id="formularioContacto">
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
        
    <!-- Modal Inicio Sesión-->
    <div class="modal fade" id="modalInfo" role="dialog">
        <div class="modal-dialog">
          <!-- Modal content-->
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              <div class="row">
                  <div class="col-lg-4 col-lg-offset-4 text-center">
                    <img src="img/logo.png" alt="Logo" width="180" height="95">
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
        
    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>
    
    <!-- Mis archivos JavaScript -->
    <script type="text/javascript" src="js/index.js"></script>
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
