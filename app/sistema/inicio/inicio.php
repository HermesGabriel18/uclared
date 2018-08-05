<?php session_start();?>
<?php  if(isset($_SESSION['usuario'])){?>

    <?php require '../modelos/usuarioRol.php'; ?>
    <?php require '../modelos/usuario.php';?>
    <?php require '../modelos/clienteNatural.php'; ?>
    <?php require '../modelos/clienteJuridico.php'; ?>
    <?php require '../modelos/servicio.php'; ?>
    <?php require '../modelos/proyecto.php'; ?>
    
    <?php $usuario=new Usuario();?>
    <?php $rol=new UsuarioRol();?>

    <?php $natural=new clienteNatural();?>
    <?php $juridico=new clienteJuridico();?>
    <?php $servicio=new Servicio();?>
    <?php $proyecto=new Proyecto();?>

    <?php $rol->set("usuario", $_SESSION['usuario']); ?>
   
    <?php $usuario->set("estatus","IN('A')"); ?>


	<section class="content-header">
        <h1>
            UCLARED
            <small>Bienvenido</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#" id="sistema/inicio/inicio.php" class="migas-de-pan"><i class="fa fa-home"></i> Inicio</a></li>
            <li class="active">Principal</li>
        </ol>
    </section>

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
                <div class="col-lg-3 col-xs-6">
                    <!-- small box -->
                    <div class="small-box bg-purple">
                        <div class="inner">
                            <h3><?php echo $cantUsuarios;?></h3>
                            <p>Usuario(s) Registrado(s)</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-ios-people"></i>
                        </div>
                        <a href="#" id="sistema/vistas/usuarioConsulta.php" class="small-box-footer pag-sesion migas-de-pan">Más info <i class="fa fa-arrow-circle-right"></i></a>
                    </div>
                </div><!-- ./col -->

                <div class="col-lg-3 col-xs-6">
                    <!-- small box -->
                    <div class="small-box bg-teal">
                        <div class="inner">
                            <h3><?php echo $natural->cantNaturales("IN('A','I')")+$juridico->cantJuridicos("IN('A','I')");?></h3>
                            <p>Cliente(s) Registrado(s)</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-ios-cart"></i>
                        </div>
                        <a href="#" id="sistema/vistas/clienteConsulta.php" class="small-box-footer pag-sesion migas-de-pan">Más info <i class="fa fa-arrow-circle-right"></i></a>
                    </div>
                </div><!-- ./col -->

                <div class="col-lg-3 col-xs-6">
                    <!-- small box -->
                    <div class="small-box bg-olive">
                        <div class="inner">
                            <h3><?php echo $cantServicios;?></h3>
                            <p>Servicio(s) Disponible(s)</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-star"></i>
                        </div>
                        <a href="#" id="sistema/vistas/servicioConsulta.php" class="small-box-footer pag-sesion migas-de-pan">Más info <i class="fa fa-arrow-circle-right"></i></a>
                    </div>
                </div><!-- ./col -->

                <div class="col-lg-3 col-xs-6">
                    <!-- small box -->
                    <div class="small-box bg-primary">
                        <div class="inner">
                            <h3><?php echo $cantProyectos;?></h3>
                            <p>Proyecto(s) Gestionado(s)</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-ribbon-b"></i>
                        </div>
                        <a href="#" id="sistema/vistas/proyectoConsulta.php" class="small-box-footer pag-sesion migas-de-pan">Más info <i class="fa fa-arrow-circle-right"></i></a>
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
        </div><!-- /.CARTELERA-->

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
                                    <img src="dist/img/thumb/thumb3.jpg" alt=""/>
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
                                    <span class="product-description">Primera entrega Tecnica formal</span>
                                </div>
                            </li><!-- /.item -->
                            <li class="item">
                                <div class="product-img">
                                    <img src="dist/img/art.jpg" alt="camacaro"/>
                                </div>
                                <div class="product-info">
                                    <a href="sistema/publicacion/doc/Articulo_Selección_de_Metodologías.pdf" target="_blank" class="product-title ventana-modal" id="sistema/publicacion/doc/Articulo_Selección_de_Metodologías.pdf" rel="Normas de convivencia">Articulo de interes<span class="label label-info pull-right"><i class="fa fa-download"></i></span></a>
                                    <span class="product-description">Articulo Selección de Metodologías</span>
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
                    <p>Bienvenido al Sistema,  te invitamos a cambiar tu usuario y clave para mantener segura tu cuenta de acceso.</p>
                </div>
            </section><!-- right col -->
        </div><!-- /.row (main row) -->
        
    </section><!-- /.content -->
      <!--ventana modal-->





    
    <script src="sistema/controladores/main.js" type="text/javascript"></script>
    <script src="sistema/controladores/usuario.js" type="text/javascript"></script>
    <script src="sistema/controladores/validador.js" type="text/javascript"></script>
    <script src="sistema/controladores/proyecto.js" type="text/javascript"></script>
    
<!--end-->
<?php }?>