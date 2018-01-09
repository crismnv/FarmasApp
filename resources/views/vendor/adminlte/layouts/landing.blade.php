<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Acme</title>

    <!-- Bootstrap Core CSS -->
    <link href="landing/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Theme CSS -->
    <link href="landing/css/clean-blog.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="landing/vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href='https://fonts.googleapis.com/css?family=Lora:400,700,400italic,700italic' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css'>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>






    <!-- Navigation -->
    <nav class="navbar navbar-default navbar-custom navbar-fixed-top">
        <div class="container-fluid">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header page-scroll">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    Menu <i class="fa fa-bars"></i>
                </button>
                <a id="LinkAcme" name="LinkAcme" class="navbar-brand" href="#"><i class="fa fa-shopping-cart"></i> <span class="light"></span> ACME</a>

                @if(Auth::guest())
                    <a id="LinkAcme" name="LinkAcme" class="navbar-brand" href="{{ url('/login') }}"></span> Iniciar Sesión</a>
                    <a id="LinkAcme" name="LinkAcme" class="navbar-brand" href="{{ url('/register') }}"></span> Registrarse</a>
                @else
                    <a id="LinkAcme" name="LinkAcme" class="navbar-brand" href="/home"></i> <span class="light"></span> {{Auth::user()->name}}</a>
                @endif


            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                


                <ul class="nav navbar-nav navbar-right">
                    <li  id="LinkNossotros" name="LinkInicio">
                        <a id="LinkInicio" name="LinkInicio" href="#">Inicio</a>
                    </li>
                    <li>
                        <a id="LinkCaracteristicas"  name="LinkCaracteristicas" href="#">Nosotros</a>
                    </li>
                    <li>
                        <a id="LinkContacto"  name="LinkContacto" href="#">Contáctanos</a>
                    </li>
                    
                </ul>

            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>

    <!-- Page Header -->
    <!-- Set your background image for this header on the line below. -->
    <!-- style="background-image: url('landing/img/shop.jpg')" -->
    <header class="intro-header" style="background-image: url('landing/img/shop.jpg')">




        <div id="Acme" class="container">
            <div class="row">
                <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
                    <div class="site-heading">
                        <br>
                        <br>
                        <br>
                        <br>
                        <h1>ACME</h1>
                        <hr class="small">
                        <span class="subheading">Si no lo tenemos, solo pidalo.</span>
                        <br>
                        <br>
                        <br>
                        <br>
                        
                    </div>
                </div>
            </div>
        </div>
    </header>

    {{-- prueba --}}

{{-- fin prueba --}}


{{-- fin slidershow --}}

    <!--  <section id="Inicio">
        
        <div class="container">
            <div class="row">
                <div class="col-sm-12" >
                    <h2 class="text-center"></h2>
                </div>
            </div>
            <br>
            <br>
           
            <div class="row">
                <div class="col-sm-7 col-md-7">
                    <h3 class="text-left"><u>Una firma global con un enfoque local</u> </h3>
                    <p class="text-justify">  En <strong>Rockfield Capital Management</strong>, tenemos un claro propósito, ayudar a mejorar la vida financiera de nuestros clientes a     través del poder de cada transacción. 
                    </p>
                    <p class="text-justify">  Cumplimos este objetivo proveyendo una <strong>amplia gama de servicios financieros</strong>; de esta manera, aspiramos a ser el principal asesor y financiador de confianza de nuestros afiliados</p>

                    <p class="text-justify">Cada día, estamos <strong>orgullosos de los resultados</strong> obtenidos por nuestros altamente capacitados traders y con las decisiones de inversión de sus clientes.</p> 
                </div>
                <div class="col-sm-12 col-md-5">
                    
                </div>
            </div>
        </div>
    </section>
   <hr> -->





    <section>
        <div class="row">
            <div class="col-sm-12">
                <div class="container-fluid" id="home" name="home">
                    <h1 class="acme1 text-sm-center h1 font-italic" style="color: #ffffff;">
                        ACME
                    </h1>
                    <h2 class="text-center blanco">Si no lo tenemos, solo pidalo</h2>
                </div>
            </div>
            
        </div>
        

    </section>
    

    <section id="Caracteristicas">
        
        <div class="row">
            <div class="col-sm-12 col-md-4">
                <h2 class="text-center">Atención</h2>
                <p class="text-center"><i class="fa fa-5x fa-cube"></i></p>
                <div class="row">
                    <div class="col-sm-8 col-sm-push-2">
                        <p class="text-justify">
                            <i class="fa fa-check-circle-o"></i> Mas de <strong>1000 clientes</strong> no pueden estar equivocados.

                        </p>
                        <p class="text-justify">
                            <i class="fa fa-check-circle-o"></i> No confíes en nosotros, confía en miles de personas
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-sm-12 col-md-4">
                <h2 class="text-center">Comodidad</h2>
                <p class="text-center"><i class="fa fa-5x fa-btc"></i></p>
                <div class="row">
                    <div class="col-sm-8 col-sm-push-2">
                        <p class="text-justify">
                            <i class="fa fa-check-circle-o"></i> Multiples <strong>Metodos de Pago.</strong>
                            
                        </p>
                        <p class="text-justify">
                            <i class="fa fa-check-circle-o"></i> Monedas virtuales como <strong>Bitcoin y Ethereum.</strong>
                        </p>

                    </div>
                </div>
            </div>
            <div class="col-sm-12 col-md-4">
                <h2 class="text-center">Variedad</h2>
                <p class="text-center"><i class="fa fa-5x fa-bars"></i></p>
                <div class="row">
                    <div class="col-sm-8 col-sm-push-2">
                        <p class="text-justify">
                            <i class="fa fa-check-circle-o"></i> <strong>Muchas Categorías</strong>, para que encuentres lo que andas buscando.
                        </p>
                    </div>
                </div>
            </div>
        </div>

      



    </section>

   

    <hr>


    <section id="carrusel">
        <div class="container-fluid">
                  
         {{--  <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">  --}}
         <div class="col-sm-10 col-sm-offset-1">
           <div id="carousel-1" class="carousel slide" data-ride="carousel">
            <!-- Indicadores -->
                <ol class="carousel-indicators">
                    <li data-target="#carousel-1" data-slider-to="0" class="active"></li>
                    <li data-target="#carousel-1" data-slider-to="1"></li>
                    <li data-target="#carousel-1" data-slider-to="2"></li>
                </ol>

            <!--Contenedor de los slide -->
                <div class="carousel-inner" role="listbox">            
                     <div class ="item active">
                             <img src="/landing/img/tecno.jpg" class="img img-responsive"  width="1600" height="900" alt="Tecnologia">
                         <div class="carousel-caption">  
                         <h3> 
                            </h3>
                          <p> Tecnologia.</p>
                         </div>
                     </div>
<div class ="item">
                              <img src="/landing/img/boy_moda.jpg" class="img img-responsive"  width="1010" height="613" alt="Moda">
                        <div class="carousel-caption">
                            <h3> 
                            </h3>
                            <p> Moda.</p>
                        </div>
                     </div>

                     <div class ="item" >
                             <img src="/landing/img/carruselmueble.jpg" class="img img-responsive"  width="1600" height="900" alt="Muebles">
                        <div class="carousel-caption">
                             <h3> 
                            </h3>
                            <p> Muebles.</p>
                        </div>
                     </div>


                     <div class ="item">
                              <img src="/landing/img/girl_moda.gif" class="img img-responsive"  width="1600" height="900" alt="Moda">
                        <div class="carousel-caption">
                            <h3> 
                            </h3>
                            <p> Moda.</p>
                        </div>
                     </div>

                     
                            
                </div>

        <!-- Controles -->
        <a href="#carousel-1" class="left carousel-control" role="button" data-slide="prev">
            <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
            <span class="sr-only">Anterior </span>
        </a>

       <a href="#carousel-1" class="right carousel-control" role="button" data-slide="next">
            <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
            <span class="sr-only">Siguiente </span>
        </a>

    </div>
</div>
</div>
        
    </section>

    <section id="Contacto">
        <div class="container" >
            <div class="row">
                <h2 class="text-center">CONTÁCTANOS</h2>
            </div>
            <br>
            <br>
            
            <div class="row">
                <div class="col-sm-12 col-md-6">
                    <h3 class="text-center"> <i class="fa fa-clock-o"></i> <u>Horario de Atención</u></h3>
                    <p class="text-justify"><i class="fa fa-check-circle-o"></i>&nbsp; Los mensajes mandados por la aplicación se responderán en horario de oficina. &nbsp;</p>
                    <p class="text-justify"><i class="fa fa-check-circle-o"></i>&nbsp; Los mensajes en nuestras redes sociales se responderán cada vez que se pueda.&nbsp;</p>
                </div>

                <div class="col-sm-12 col-md-6">
                    <h3 class="text-center"> <i class="fa fa-dot-circle-o"></i> <u>Nuestras Redes Sociales</u></h3>
                   <p class="text-center"> <a class="sociales" href="https://www.facebook.com/ACME-1500286046714471/" target="_blank" title="Facebook" itemprop="followee"><i class="fa fa-facebook-square fa-4x" aria-hidden="true"></i></a>
                    <a  class="sociales" href="https://www.facebook.com/centrocomputouns/" target="_blank" title="Twitter" itemprop="followee"><i class="fa fa-twitter-square fa-4x" aria-hidden="true"></i></a>
                    <a class="sociales" href="https://www.facebook.com/centrocomputouns/" target="_blank" title ="YouTube" itemprop="followee"><i class="fa fa-youtube-square fa-4x" aria-hidden="true"></i></a> </p>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <h3 class="text-center"><i class="fa fa-envelope"></i> <u>Envíanos un mensaje</u></h3>
                    <br>
                </div>
            </div>


            <div class="row">
                <!-- style="background-color: #EAE8E8;" -->
                <div class="col-sm-12 col-md-4 col-md-offset-1" style="background-image: url('landing/img/fondo-form.jpg')" >
                    <div class="row">
                        <div class="col-sm-12 col-md-8 col-md-offset-1" >
                            <form name="sentMessage" id="contactForm" action="{{url('/')}}" method="POST" enctype="plain" novalidate>
                            <input name="_token" type="hidden" value="{{ csrf_token() }}">
                            <div class="row control-group">
                                <div class="form-group col-xs-12 floating-label-form-group controls">
                                    <label>&nbsp;Nombre</label>
                                    <input type="text" class="form-control" placeholder="Nombre" id="name" name="name" required data-validation-required-message="Ingresa tu nombre.">
                                    <p class="help-block text-danger"></p>
                                </div>
                            </div>
                            <div class="row control-group">
                                <div class="form-group col-xs-12 floating-label-form-group controls">
                                    <label>&nbsp;Correo Electrónico</label>
                                    <input type="email" class="form-control" placeholder="Correo Electrónico" id="email" name="email" required data-validation-required-message="Ingresa tu correo electrónico address.">
                                    <p class="help-block text-danger"></p>
                                </div>
                            </div>
                            <div class="row control-group">
                                <div class="form-group col-xs-12 floating-label-form-group controls">
                                    <label>&nbsp;Numero de Telefono</label>
                                    <input type="tel" class="form-control" placeholder="Numero de Telefono" id="phone" name="phone" required data-validation-required-message="Ingresa tu número de teléfono.">
                                    <p class="help-block text-danger"></p>
                                </div>
                            </div>
                            <div class="row control-group">
                                <div class="form-group col-xs-12 floating-label-form-group controls">
                                    <label>&nbsp;Mensaje</label>
                                    <textarea rows="5" class="form-control" placeholder="Mensaje" id="message" name="message" required data-validation-required-message="Ingresa tu mensaje."></textarea>
                                    <p class="help-block text-danger"></p>
                                </div>
                            </div>
                            <br>
                            <div id="success"></div>
                            <div class="row">
                                <div class="form-group col-xs-12">
                                    <button type="submit" class="btn btn-primary" style="color: #f1f230;">ENVIAR</button>
                                </div>
                            </div>
                            </form>
                        </div>
                    </div>
            </div>

            <div class="col-sm-12 col-md-4 col-md-offset-1"  >
                <div class="row">
                    <div class="col-sm-12 col-md-6 col-md-offset-3">
                        <iframe src="https://www.facebook.com/plugins/page.php?href=https%3A%2F%2Fwww.facebook.com%2FACME-1500286046714471%2F&tabs=messages&width=340&height=500&small_header=false&adapt_container_width=true&hide_cover=false&show_facepile=true&appId" width="340" height="500" style="border:none;overflow:hidden" scrolling="no" frameborder="0" allowTransparency="true"></iframe>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- <div class="contaier">
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <a href="https://twitter.com/CrismnV?ref_src=twsrc%5Etfw" class="twitter-follow-button" data-show-count="false">Follow @CrismnV</a><script async src="//platform.twitter.com/widgets.js" charset="utf-8"></script>
            </div>
            <div class="row">
                <blockquote class="twitter-tweet"><p lang="es" dir="ltr">El Sueño de un Millar de Gatos <a href="https://t.co/0vQ2pVBYKo">https://t.co/0vQ2pVBYKo</a></p>&mdash; Cristian Ycochea (@CrismnV) <a href="https://twitter.com/CrismnV/status/873914504710672384?ref_src=twsrc%5Etfw">June 11, 2017</a></blockquote> <script async src="//platform.twitter.com/widgets.js" charset="utf-8"></script>
                <blockquote class="twitter-tweet"><p lang="es" dir="ltr">El Sueño de un Millar de Gatos <a href="https://t.co/0vQ2pVBYKo">https://t.co/0vQ2pVBYKo</a></p>&mdash; Cristian Ycochea (@CrismnV) <a href="https://twitter.com/CrismnV/status/873914504710672384?ref_src=twsrc%5Etfw">June 11, 2017</a></blockquote> <script async src="//platform.twitter.com/widgets.js" charset="utf-8"></script>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-sm-6 col-md-6 col-md-offset-3">
                <a class="twitter-timeline" href="https://twitter.com/CrismnV?ref_src=twsrc%5Etfw">Tweets by CrismnV</a> <script async src="//platform.twitter.com/widgets.js" charset="utf-8"></script>
            </div>
        </div>
    </div> --}}
                

    </section>
    <hr>


    <!-- Footer -->
    <footer>
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
                    <ul class="list-inline text-center">
                        <li>
                            <a target="_blank" href="https://www.facebook.com/ACME-1500286046714471/">
                                <span class="fa-stack fa-lg">
                                    <i class="fa fa-circle fa-stack-2x"></i>
                                    <i class="fa fa-twitter fa-stack-1x fa-inverse"></i>
                                </span>
                            </a>
                        </li>
                        <li>
                            <a target="_blank" href="https://www.facebook.com/ACME-1500286046714471/">
                                <span class="fa-stack fa-lg">
                                    <i class="fa fa-circle fa-stack-2x"></i>
                                    <i class="fa fa-facebook fa-stack-1x fa-inverse"></i>
                                </span>
                            </a>
                        </li>
                        <li>
                            <a target="_blank" href="https://www.facebook.com/ACME-1500286046714471/">
                                <span class="fa-stack fa-lg">
                                    <i class="fa fa-circle fa-stack-2x"></i>
                                    <i class="fa fa-github fa-stack-1x fa-inverse"></i>
                                </span>
                            </a>
                        </li>
                    </ul>
                    <p class="copyright text-muted">Copyright &copy; ACME 2017</p>
                </div>
            </div>
        </div>
    </footer>

   
    

  <!--   <script type="text/javascript">
        $(document).on("ready",function(){
            $("#LinkInicio").on("click", function(){
                $("html,body").animate({ scrollTop : $("#Inicio").offset().top  }, 1500 );
            });
        });
    </script> -->

    <!-- jQuery -->
    <script src="landing/vendor/jquery/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="landing/vendor/bootstrap/js/bootstrap.min.js"></script>

    <!-- Contact Form JavaScript -->
    <script src="landing/js/jqBootstrapValidation.js"></script>
    <!-- <script src="landing/js/contact_me.js"></script> -->

    <!-- Theme JavaScript -->
    <script src="landing/js/clean-blog.min.js"></script>

     <script type="text/javascript">
        $(document).ready(function()
        {
            $('#LinkInicio').on("click", function(evt) {
            
                $("html,body").animate({ scrollTop : $("#Acme").offset().top  }, 1500 );
                
            })

            $('#LinkCaracteristicas').on("click", function(evt) {
            
                $("html,body").animate({ scrollTop : $("#Caracteristicas").offset().top  }, 1500 );
                
            })

            $('#LinkContacto').on("click", function(evt) {
            
                $("html,body").animate({ scrollTop : $("#Contacto").offset().top  }, 1500 );
                
            })

            $('#LinkAcme').on("click", function(evt) {
            
                $("html,body").animate({ scrollTop : $("#Acme").offset().top  }, 1500 );
                
            })
        })
    </script>

</body>

</html>
