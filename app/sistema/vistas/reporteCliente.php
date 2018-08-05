<?php session_start(); ?>
<?php  if(isset($_SESSION['usuario'])){?>

<?php require '../modelos/proyecto.php'; ?>
<?php $proyecto=new Proyecto(); ?>
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Reporte de clientes
            <small>Números y porcentajes de los clientes del sistema.</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#" id="sistema/inicio/inicio.php" class="migas-de-pan"><i class="fa fa-home"></i> Inicio</a></li>
            <li class="">Reporte</li>
            <li id="migadepan" class="active">Clientes</li>
        </ol>
        <br>
        <div class="row">
            <div class="col-xs-12 col-md-12">
                <div id="msg-box" style="display: none;"></div>
            </div>
        </div>
        <input type="hidden" id="perfil-acceso" name="perfil-acceso" value="<?php echo $_SESSION['rol']?>">
        <input type="hidden" id="persona-acceso" name="persona-acceso" value="<?php echo $_SESSION['persona']?>">
    </section>
    <!-- Main content -->
    <section class="content" id="content-reporte-cliente">

        <div class="row">
            <div class="col-md-4 col-xs-12">

                <div class="info-box bg-blue">
                    <span class="info-box-icon"><i class="fa fa-thumbs-up"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Nro de clientes <br> SATISFECHOS:</span>
                        <span class="info-box-number" id="create"><?php echo $proyecto->contar('4,5');?></span>
                        <div class="progress">
                            <div class="progress-bar" style="width: <?php echo $proyecto->porc('4,5');?>%"></div>
                        </div>
                    </div><!-- /.info-box-content -->
                </div><!-- /.info-box -->
                
                <div class="info-box bg-blue">
                    <span class="info-box-icon"><i class="fa fa-thumbs-up"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Porcentaje de clientes<br> SATISFECHOS:</span>
                        <span class="info-box-number" id="create"><?php echo round($proyecto->porc('4,5'),2);?> %</span>
                        <div class="progress">
                            <div class="progress-bar" style="width: <?php echo $proyecto->porc('4,5');?>%;"></div>
                        </div>
                    </div><!-- /.info-box-content -->
                </div><!-- /.info-box -->

            </div><!-- /.col -->

            <div class="col-xs-12 col-md-8">
                <div class="box box-warning box-solid">
                    <div class="box-header with-border">
                        <h3 class="box-title">Listado de clientes que dieron una buena calificación:</h3>
                    </div><!-- /.box-header -->
                    <table id="tabla-calificacion-buena" class="table table-condensed table-hover">
                        <thead>
                            <tr>
                                <th><i class="fa fa-vcard"></i>Cliente:</th>
                                <th><i class="fa fa-briefcase"></i>Proyecto:</th>
                                <th><i class="fa fa-thumbs-up"></i>Calificación:</th>
                               <th></th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div> 
            </div>
            
        </div>

        <!-- Main row -->
        <div class="row">
            
            <div class="col-md-8 col-xs-12">
                <div class="box box-warning box-solid">
                    <div class="box-header with-border">
                        <h3 class="box-title">Listado de clientes que dieron una mala calificación:</h3>
                    </div><!-- /.box-header -->
                    <table id="tabla-calificacion-mala" class="table table-condensed table-hover">
                        <thead>
                            <tr>
                                <th><i class="fa fa-vcard"></i>Cliente:</th>
                                <th><i class="fa fa-briefcase"></i>Proyecto:</th>
                                <th><i class="fa fa-thumbs-down"></i>Calificación:</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div><!-- /.col -->

            <div class="col-md-4 col-xs-12">

                <div class="info-box bg-red">
                    <span class="info-box-icon"><i class="fa fa-thumbs-down"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Nro de clientes <br> INSATISFECHOS:</span>
                        <span class="info-box-number" id="create"><?php echo $proyecto->contar('1,2');?></span>
                        <div class="progress">
                            <div class="progress-bar" style="width: <?php echo $proyecto->porc('1,2');?>%"></div>
                        </div>
                    </div><!-- /.info-box-content -->
                </div><!-- /.info-box -->


                <div class="info-box bg-red">
                    <span class="info-box-icon"><i class="fa fa-thumbs-down"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Porcentaje de clientes<br> INSATISFECHOS:</span>
                        <span class="info-box-number" id="create"><?php echo round($proyecto->porc('1,2'),2);?> %</span>
                        <div class="progress">
                            <div class="progress-bar" style="width: <?php echo $proyecto->porc('1,2');?>%;"></div>
                        </div>
                    </div><!-- /.info-box-content -->
                </div><!-- /.info-box -->


            </div><!-- /.col -->

        </div><!-- /.row -->
    </section><!-- /.content main-->


<?php }; ?>
<!-- validador.js -->
<script src="sistema/controladores/validador.js" type="text/javascript"></script>
<script src="sistema/controladores/proyecto.js" type="text/javascript"></script>