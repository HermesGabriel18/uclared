<?php session_start();?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>UCLARED</title>
	<link rel="shortcut icon" href="dist/img/logos-solid.png" />
	<!-- Tell the browser to be responsive to screen width -->
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <!-- Bootstrap 3.3.6 -->
        <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
        <!-- FontAwesome 4.7.0 -->
        <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <!-- Ionicons -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
        
        <!-- iCheck for checkboxes and radio inputs -->
        <link rel="stylesheet" href="plugins/iCheck/all.css">
        <!-- Theme style -->
        <link rel="stylesheet" href="dist/css/AdminLTE.css">
        <link rel="stylesheet" href="dist/css/skins/skin-green.min.css">
        <!-- Date Picker -->
        <link rel="stylesheet" href="plugins/datepicker/datepicker3.css">
        <!-- Daterange picker -->
        <link rel="stylesheet" href="plugins/daterangepicker/daterangepicker.css">
        <!-- bootstrap wysihtml5 - text editor -->
        <link rel="stylesheet" href="plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
        <!-- DataTables -->
        <link rel="stylesheet" href="plugins/datatables/dataTables.bootstrap.css">
        

        
        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesnt work if you view the page via file:// -->
        <!-- [if lt IE 9] -->
        <!-- <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script> -->
        <!-- <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script> -->
        <!-- [endif] -->
        <?php require 'sistema/modelos/usuario.php';?>
        <?php require 'sistema/modelos/persona.php'; ?>
        <?php require 'sistema/modelos/usuarioRol.php'; ?>
        <?php require 'sistema/modelos/rolTarea.php'; ?>
        <?php require 'sistema/modelos/clienteNatural.php'; ?>
        <?php require 'sistema/modelos/clienteJuridico.php'; ?>
        <?php require 'sistema/modelos/servicio.php'; ?>
        <?php require 'sistema/modelos/proyecto.php'; ?>


</head>
<body class="hold-transition skin-green sidebar-mini">
	<?php if(isset($_SESSION['usuario'])){?>
        <!-- CUENTA USUARIO -->
        <?php $usuario=new Usuario();?>
        <?php $persona=new Persona();?>
        <?php $rol=new UsuarioRol();?> 
        <?php $menu=new RolTarea();?>
        <?php $natural=new clienteNatural();?>
        <?php $juridico=new clienteJuridico();?>
        <?php $servicio=new Servicio();?>
        <?php $proyecto=new Proyecto();?>

        <?php $usuario->set("user",$_SESSION['usuario']);?>
        <?php $usuario->find();?>

        <?php $persona->set("cedula",$_SESSION['persona']);?>
        <?php $persona->find();?>

        <?php $rol->set("usuario", $usuario->get("user")); ?>
        <?php $rol->set("rol",$_SESSION['rol']); ?>
        <?php $rol->find();?>
        <?php if($usuario->get("imagen")!="" || $usuario->get("imagen")!=NULL){?>
            <?php $imagen='sistema/img/user/'.$usuario->get("imagen");?>
        <?php }else{?>
        <?php $imagen='dist/img/user-160x160.jpg';?>
        <?php } ?>
        <!-- wrapper -->
            <div class="wrapper">
            	<!-- Main Header -->
                    <header class="main-header">
                        <!-- Logo -->
                        <a href="index.php" class="logo">
                            <span class="logo-mini"><b>G</b>P</span>
                            <span class="logo-lg"><b>Gestión Proyectos</b></span>
                        </a>
                        <!-- Navbar -->
                        <nav class="navbar navbar-static-top" role="navigation">
                            <!-- Sidebar toggle button-->
                            <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
                                <span class="sr-only">Toggle navigation</span>
                            </a>
                            <div class="navbar-custom-menu" id="<?php echo $persona->get("cedula"); ?>">
                                <ul class="nav navbar-nav">
                                    <!-- User Account Menu -->
                                    <li class="dropdown user user-menu">
                                        <!-- Menu Toggle Button -->
                                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                            <!-- The user image in the navbar-->
                                            <img id="user-1" src="<?php echo $imagen;?>" class="user-image" alt="User Image"/>
                                            <!-- hidden-xs hides the username on small devices so only the image appears. -->
                                            <span class="hidden-xs"><?php echo $persona->getShortNombreApellido()?></span>
                                        </a>
                                        <ul class="dropdown-menu">
                                            <!-- The user image in the menu -->
                                            <li class="user-header">
                                                <img id="user-2" src="<?php echo $imagen;?>" class="img-circle" alt="User Image" />
                                                <p>
                                                  <?php echo $persona->getShortNombreApellido();?>
                                                  <small><?php echo $rol->get("descripcion");?></small>
                                                </p>
                                            </li>
                                            <li class="user-body">
                                                <div class="row">
                                                    <div class="col-xs-4 text-center">
                                                        <a href="#" id="sistema/vistas/usuarioVer.php" class="pag-sesion ver-perfil"><i class="fa fa-gear"></i> Perfil</a>
                                                    </div>
                                                </div>
                                                <!-- /.row -->
                                            </li>
                                            <!-- Menu Footer-->
                                            <!-- <li class="user-footer">
                                                <div class="pull-right">
                                                    <a href="#" class="btn btn-default btn-flat cerrar-sesion">Salir</a>
                                                </div>
                                            </li> -->
                                        </ul>
                                    </li><!-- /.User Account Menu -->
                                    <!-- Control Sidebar Toggle Button -->
                                    <!--data-toggle="control-sidebar"-->
                                    <li><a href="#" class="cerrar-sesion"><i class="fa fa-power-off"></i> Cerrar sesión</a></li>
                                </ul>
                            </div>
                        </nav>
                        <!-- /.Navbar -->
                    </header>
                <!-- /.Main Header -->
                	<aside class="main-sidebar">
                        <section class="sidebar">
                            <!-- Sidebar panel-usuario-->
                            <div class="user-panel">
                                <div class="pull-left image">
                                    <img src="dist/img/iMac-icon.png" class="img" alt="User Image" />
                                </div>
                                <div class="pull-left info">
                                    <p><?php echo $persona->getShortNombreApellido();?></p>
                                    <!-- Status -->
                                    <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
                                </div>
                            </div>
                            <!-- /.Sidebar panel-usuario-->
                            <!-- Sidebar Menu -->
                            <ul class="sidebar-menu">
                                <li class="header">MENU PRINCIPAL</li>
                                <?php $actividades=$menu->actividadesDelUsuario($usuario->get("user"));?>
                                <?php if(!empty($actividades)){?>
                                    <?php foreach($actividades as $key => $actividad){?>
                                        <li class="treeview">
                                            <a href="#">
                                                <i class='fa <?php echo $actividad['icono']?>'></i> 
                                                <span><?php echo $actividad['actividad']?></span> 
                                                <i class="fa fa-angle-left pull-right"></i>
                                            </a>
                                            <?php $tareas=$menu->tareasDeUsuario($usuario->get("user"),$actividad['id']);?>
                                            <?php if(!empty($tareas)){?>
                                                <ul class="treeview-menu">
                                                <?php foreach ($tareas as $x => $tarea) {?>
                                                    <li>
                                                        <a href="#" class="pag-sesion" id="<?php echo $tarea['ruta']?>">
                                                            <i class="fa fa-dot-circle-o"></i> 
                                                            <?php echo $tarea['tarea'];?>
                                                        </a>
                                                    </li>
                                                <?php }//fin de foreach?>
                                                </ul>
                                            <?php }//if de tareas?>
                                        </li>
                                    <?php }//fin del foreach?>
                                <?php }//if de actividades?>
                            </ul>
                            <!-- /.Sidebar-menu -->
                        </section>
                    </aside>
                    <!-- /.sidebar columna izquierda-->


                    <div id="sistema" class="content-wrapper">
                        <!-- Content Header -->
                        <section class="content-header">
                            <h1>
                                UCLARED
                                <small>Bienvenido</small>
                            </h1>
                            <ol class="breadcrumb">
                                <li><a href="#" id="sistema/inicio/inicio.php" class="migas-de-pan"><i class="fa fa-home"></i> Inicio</a></li>
                                <li class="active">Aquí</li>
                            </ol>
                        </section>
                        <!-- /.Content Header-->
                        <!-- Main content -->
                        <section class="content">
                            <!-- Small boxes (Stat box) -->
                            <?php $usuario->set("estatus","IN('A','I')"); ?>
                            <?php $cantUsuarios=count($usuario->listar()); ?>
                            <?php $servicio->set("estatus","IN('A')"); ?>
                            <?php $cantServicios=count($servicio->listar()); ?>
                            <?php $proyecto->set("estatus","IN('A','I','E')"); ?>
                            <?php $cantProyectos=count($proyecto->listar()); ?>
                            <?php if($_SESSION['rol']<=2){?>
                            <div class="row">
                                <div class="col-md-6 col-xs-6">
                                    <!-- small box -->
                                    <div class="small-box bg-purple">
                                        <div class="inner">
                                            <h3><?php echo $cantUsuarios;?></h3>
                                            <p>Usuario(s) Registrado(s)</p>
                                        </div>
                                        <div class="icon">
                                            <i class="ion ion-ios-people"></i>
                                        </div>
                                        <a href="#" id="sistema/vistas/usuarioConsulta.php" class="small-box-footer pag-sesion">Más info <i class="fa fa-arrow-circle-right"></i></a>
                                    </div>
                                </div><!-- ./col -->

                                <div class="col-md-6 col-xs-6">
                                    <!-- small box -->
                                    <div class="small-box bg-teal">
                                        <div class="inner">
                                            <h3><?php echo $natural->cantNaturales("IN('A','I')")+$juridico->cantJuridicos("IN('A','I')");?></h3>
                                            <p>Cliente(s) Registrado(s)</p>
                                        </div>
                                        <div class="icon">
                                            <i class="ion ion-ios-cart"></i>
                                        </div>
                                        <a href="#" id="sistema/vistas/clienteConsulta.php" class="small-box-footer pag-sesion">Más info <i class="fa fa-arrow-circle-right"></i></a>
                                    </div>
                                </div><!-- ./col -->

                                <div class="col-md-6 col-xs-6">
                                    <!-- small box -->
                                    <div class="small-box bg-olive">
                                        <div class="inner">
                                            <h3><?php echo $cantServicios;?></h3>
                                            <p>Servicio(s) Disponible(s)</p>
                                        </div>
                                        <div class="icon">
                                            <i class="ion ion-star"></i>
                                        </div>
                                        <a href="#" id="sistema/vistas/servicioConsulta.php" class="small-box-footer pag-sesion">Más info <i class="fa fa-arrow-circle-right"></i></a>
                                    </div>
                                </div><!-- ./col -->

                                <div class="col-md-6 col-xs-6">
                                <!-- small box -->
                                    <div class="small-box bg-primary">
                                        <div class="inner">
                                            <h3><?php echo $cantProyectos;?></h3>
                                            <p>Proyecto(s) Gestionado(s)</p>
                                        </div>
                                        <div class="icon">
                                            <i class="ion ion-ribbon-b"></i>
                                        </div>
                                        <a href="#" id="sistema/vistas/proyectoConsulta.php" class="small-box-footer pag-sesion">Más info <i class="fa fa-arrow-circle-right"></i></a>
                                    </div>
                                </div><!-- ./col -->
                            </div><!-- /.row -->
                            <?php }?>
                            
                            <!-- CARTELERA -->
                            <div class="row">
                                <!-- central -->
                                <section class="col-lg-12">
                                     <!-- Widget: user widget style 1 -->
                                    <div class="box box-widget widget-user">
                                        <!-- Add the bg color to the header using any of the bg-* classes -->
                                        <div class="widget-user-header bg-aqua-active">
                                            <h3 class="widget-user-username">Proyectos en proceso</h3>
                                            <h5 class="widget-user-desc">UCLARED</h5>
                                        </div>
                                        <div class="widget-user-image" style="border-style: none !important;">
                                            <img class="img-thumbnail" src="dist/img/router-logo.png" alt="San  Pedro">
                                        </div>
                                        <div class="box-footer">
                                            <div class="row">
                                                <div class="box-body table-responsive" id="box-body-1">

                                                    <table id="tabla-proyecto-i" class="table table-condensed table-hover">
                                                        <thead>
                                                            <tr>
                                                                <th><i class="fa fa-hashtag"></i>Codigo</th>
                                                                <th><i class="fa fa-user"></i>Responsable</th>
                                                                <th><i class="fa fa-vcard"></i>Cliente</th>
                                                                <th><i class="fa fa-calendar"></i>Finaliza el:</th>
                                                                <th><i class="fa fa-smile-o"></i>Activos</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                        </tbody>
                                                    </table>   
                                                </div><!-- /.box-body -->
                                            </div>
                                            <!-- /.row -->
                                        </div>
                                    </div>
                                    <!-- /.widget-user -->
                                </section><!-- central -->
                            </div>
                            <!-- /.CARTELERA-->

                            <!-- Main row -->
                            <div class="row">
                              <!-- Left col -->
                                <section class="col-lg-7">
                                    <div class="box box-solid">
                                        <div class="box-header with-border">
                                            <h3 class="box-title">Nuestra Organizacion</h3>
                                        </div><!-- /.box-header -->
                                        <div class="box-body">
                                            <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
                                                <ol class="carousel-indicators">
                                                    <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
                                                    <?php for($i=1;$i<=4; $i++){?>
                                                    <li data-target="#carousel-example-generic" data-slide-to="<?php echo $i;?>" class=""></li>
                                                    <?php }?>
                                                </ol>
                                                <div class="carousel-inner">
                                                    <div class="item active">
                                                        <img src="dist/img/slider/0.jpg" alt="First slide">
                                                        <div class="carousel-caption"></div>
                                                    </div>
                                                    <?php for($i=1;$i<=4; $i++){?>
                                                    <div class="item">
                                                        <img src="dist/img/slider/<?php echo $i;?>.jpg" alt="Second slide">
                                                        <div class="carousel-caption"></div>
                                                    </div>
                                                    <?php }?>
                                                </div>
                                                <a class="left carousel-control" href="#carousel-example-generic" data-slide="prev">
                                                    <span class="fa fa-angle-left"></span>
                                                </a>
                                                <a class="right carousel-control" href="#carousel-example-generic" data-slide="next">
                                                    <span class="fa fa-angle-right"></span>
                                                </a>
                                            </div>
                                        </div><!-- /.box-body -->
                                    </div><!-- /.box -->
                                </section><!-- /.Left col -->

                            
                                <!-- right col (We are only adding the ID to make the widgets sortable)-->
                                <section class="col-lg-5">
                                    <div class="box box-primary">
                                        <div class="box-header with-border">
                                          <h3 class="box-title">De interés</h3>
                                          <div class="box-tools pull-right">
                                            <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                                            <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                                          </div>
                                        </div><!-- /.box-header -->
                                        <div class="box-body">
                                          <ul class="products-list product-list-in-box">
                                                <li class="item">
                                                    <div class="product-img">
                                                        <img src="dist/img/thumb/thumb3.jpg" alt="sanpedro"/>
                                                    </div>
                                                    <div class="product-info">
                                                        <a href="sistema/publicacion/doc/Manual de Usuario UCLARED.pdf" target="_blank" class="product-title ventana-modal" id="sistema/publicacion/doc/Manual de Usuario UCLARED.pdf" rel="triptico_seguro_escolar_1718">Manual de Usuario <span class="label label-danger pull-right"><i class="fa fa-download"></i></span></a>
                                                        <span class="product-description">
                                                        Instrucciones para el manejo del sistema
                                                        </span>
                                                    </div>
                                                </li><!-- /.item -->
                                                <li class="item">
                                                    <div class="product-img">
                                                        <img src="dist/img/red.jpg" alt="sanpedro"/>
                                                    </div>
                                                    <div class="product-info">
                                                        <a href="sistema/publicacion/doc/Primera_entrega_Tecnica_formal.pdf" target="_blank" class="product-title ventana-modal" id="sistema/publicacion/doc/Primera_entrega_Tecnica_formal.pdf" rel="Lista de útiles escolares">Primer punto de control<span class="label label-warning pull-right"><i class="fa fa-download"></i></span></a>
                                                        <span class="product-description">
                                                        Primera entrega Tecnica formal
                                                        </span>
                                                    </div>
                                                </li><!-- /.item -->
                                                <li class="item">
                                                    <div class="product-img">
                                                        <img src="dist/img/art.jpg" alt="camacaro"/>
                                                    </div>
                                                    <div class="product-info">
                                                        <a href="sistema/publicacion/doc/Articulo_Selección_de_Metodologías.pdf" target="_blank" class="product-title ventana-modal" id="sistema/publicacion/doc/Articulo_Selección_de_Metodologías.pdf" rel="Normas de convivencia">Articulo de interes<span class="label label-info pull-right"><i class="fa fa-download"></i></span></a>
                                                        <span class="product-description">
                                                        Articulo Selección de Metodologías
                                                        </span>
                                                    </div>
                                                </li><!-- /.item -->
                                            </ul>
                                        </div><!-- /.box-body -->
                                        <div class="box-footer text-center">
                                          <a href="#" id="sistema/publicacion/comunicados.php" class="uppercase migas-de-pan">Ver más</a>
                                        </div><!-- /.box-footer -->
                                    </div><!-- /.box -->
                                    
                                    <div class="callout callout-info">
                                        <h4>Amigo Usuario!</h4>
                                        <p>Bienvenido al Sistema,  te invitamos a cambiar tu usuario y clave para 
                                        mantener segura tu cuenta de acceso.
                                        </p>
                                    </div>
                                </section><!-- right col -->
                            </div><!-- /.row (main row) -->

                        </section>
                        <!-- /.content -->
                    </div>
                <!-- /.content-wrapper -->


                <!-- Main Footer -->
                    <footer class="main-footer col-xs-12 col-md-12">
                        <!-- To the right -->
                        <!-- <div class="pull-right image">
                            <img src="dist/img/down-image.jpg" class="img-responsive">
                        </div> -->
                        <!-- Default to the left -->
                        <strong>Copyright &copy; <a href="http://www.losdelaucla.com.ve" target="_blank">www.losdelaucla.com.ve</a></strong>. Todos los derechos reservados.<br>
                         EQUIPO DE GESTION DE PROYECTO, C.A. J-XXXXXXXX-X<br>
                        <span class="text-danger"><i class="fa fa-map-marker"></i> Barquisimeto, VE</span> | 
                        <span class="text-muted"><i class="fa fa-envelope"></i> losdelaUCLA@gmail.com</span>
                    </footer>
                <!-- /.Main Footer -->




            </div>
        <!-- ./wrapper -->

    <?php }else {?>
     <!--content page no fount 404 -->
            <div class="content">
                <section class="content-header">
                    <h1>404 Error Page</h1>
                </section>
                <!-- Main content -->
                <section class="content">
                    <div class="error-page">
                        <h2 class="headline text-yellow"> 404</h2>
                        <div class="error-content">
                            <h3><i class="fa fa-warning text-yellow"></i> Oops! Page not found.</h3>
                            <p>
                            We could not find the page you were looking for.
                            Meanwhile, you may <a href='../index.html'>return to Colegio San Pedro</a> or try using the session user.
                            </p>
                        </div><!-- /.error-content -->
                    </div><!-- /.error-page -->
                </section><!-- /.content -->
            </div>
        <!--content page no fount 404 -->
    <?php }?>


	<!-- REQUIRED JS SCRIPTS -->

        <!-- jQuery 2.2.3 -->
        <!-- <script src="plugins/jQuery/jquery-2.2.3.min.js"></script> -->
        <script src="plugins/jQuery/jquery.js"></script>

        <script src="plugins/jQuery/jquery.numeric.js"></script>
        <script src="plugins/jQuery/autocomplete.jquery.js"></script>
        <script src="plugins/sweetalert/sweetalert.js"></script>

        <!-- jQuery UI 1.11.4 -->
        <script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>
        <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
        <script>
          $.widget.bridge('uibutton', $.ui.button);
        </script>
        <!-- Bootstrap 3.3.6 -->
        <script src="bootstrap/js/bootstrap.min.js"></script>

        <!-- daterangepicker -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.2/moment.min.js"></script>
        <script src="plugins/daterangepicker/daterangepicker.js"></script>
        <!-- datepicker -->
        <script src="plugins/datepicker/bootstrap-datepicker.js"></script>
        <!-- Bootstrap WYSIHTML5 -->
        <script src="plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
        <!-- Slimscroll -->
        <script src="plugins/slimScroll/jquery.slimscroll.min.js"></script>
        <!-- FastClick -->
        <script src="plugins/fastclick/fastclick.js"></script>

        <!-- DATA TABES SCRIPT -->
        <script src="plugins/datatables/jquery.dataTables.min.js" type="text/javascript"></script>
        <script src="plugins/datatables/dataTables.bootstrap.min.js" type="text/javascript"></script> 

        <!-- iCheck -->
        <script src="plugins/iCheck/icheck.min.js"></script>
        <!-- InputMask -->
        <script src="plugins/input-mask/jquery.inputmask.js" type="text/javascript"></script>
        <script src="plugins/input-mask/jquery.inputmask.date.extensions.js" type="text/javascript"></script>
        <script src="plugins/input-mask/jquery.inputmask.extensions.js" type="text/javascript"></script>


        <!-- AdminLTE App -->
        <script src="dist/js/app.min.js"></script>

        <!-- Sistema-Gestion de proyecto  - CRM -->
        <script src="sistema/controladores/main.js" type="text/javascript"></script>
        <script src="sistema/controladores/usuario.js" type="text/javascript"></script>
        <script src="sistema/controladores/validador.js" type="text/javascript"></script>
        <script src="sistema/controladores/proyecto.js" type="text/javascript"></script>
</body>
</html>