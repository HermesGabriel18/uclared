<?php session_start(); ?>
<?php  if(isset($_SESSION['usuario'])){?>

<?php require '../modelos/servicio.php'; ?>
<?php $servicio=new Servicio(); ?>
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Reporte de servicios
            <small>Números y porcentajes de los servicios del sistema.</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#" id="sistema/inicio/inicio.php" class="migas-de-pan"><i class="fa fa-home"></i> Inicio</a></li>
            <li class="">Reporte</li>
            <li id="migadepan" class="active">Servicios</li>
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
    <section class="content" id="content-reporte-servicio">
        <!-- Main row -->
        <div class="row">

            <div class="col-md-6 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-yellow">
                    <div class="inner">
                        <h4>Número de servicios que se han<br> convertido en proyectos.</h4>

                        <h3><u><?php echo $servicio->contar();?></u></h3>
                    </div>
                    <div class="icon">
                        <i class="ion ion-ribbon-b"></i>
                    </div>
                </div>
            </div><!-- ./col -->


            <section class="col-xs-12 col-md-12">
                <div class="box box-danger box-solid">
                <div class="box-header with-border bg-red">
                    <h3 class="box-title">Seleccione un servicio para mostrar en que proyectos han sido asignados:</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                    <div class="col-xs-8 col-md-8">
                        <select id="servicior" name="servicior" class="form-control">
                        <option value="">Seleccione...</option>
                    </select>
                    </div>
                    
                    <div class="col-xs-4 col-md-4">
                        <button id="mostrarsp" class="btn btn-default pull-right"><i class="fa fa-search"></i> Mostrar</button>
                    </div>
                    <div class="col-xs-8 col-md-8">
                    <table id="tabla-servicio-reporte" class="table table-condensed table-hover">
                            <thead>
                                <tr>
                                    <th><i class="fa fa-crosshairs"></i>Proyectos:</th>
                                    <th><i class="fa fa-smile-o"></i>Progreso del servicio:</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>  
                        </div>
                </div><!-- /.box-body -->
            </div><!-- /.box -->   
            </section>

        </div><!-- /.row -->
    </section><!-- /.content main-->


<?php }; ?>
<!-- validador.js -->
<script src="sistema/controladores/validador.js" type="text/javascript"></script>
<script src="sistema/controladores/proyecto.js" type="text/javascript"></script>
<script src="sistema/controladores/reporteServicio.js" type="text/javascript"></script>