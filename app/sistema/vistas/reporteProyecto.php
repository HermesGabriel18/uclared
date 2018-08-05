<?php session_start(); ?>
<?php  if(isset($_SESSION['usuario'])){?>

<?php require '../modelos/proyecto.php'; ?>
<?php $proyecto=new Proyecto(); ?>
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Reporte de proyectos
            <small>Números y porcentajes de los proyectos del sistema.</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#" id="sistema/inicio/inicio.php" class="migas-de-pan"><i class="fa fa-home"></i> Inicio</a></li>
            <li class="">Reporte</li>
            <li id="migadepan" class="active">Proyectos</li>
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
    <section class="content" id="content-reporte-proyecto">
        <!-- Main row -->
        <div class="row">

            <div class="col-md-4 col-xs-4">
                <div class="info-box bg-blue">
                    <span class="info-box-icon"><i class="fa fa-crosshairs"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Activos:</span>
                        <span class="info-box-number" id="create"><?php echo $proyecto->contarTodos("'A'");?></span>
                        <div class="progress">
                            <div class="progress-bar" style="width: <?php echo $proyecto->contarTodos("'A'")*100/($proyecto->contarTodos("'A'")+$proyecto->contarTodos("'I'")+$proyecto->contarTodos("'E'"));?>%"></div>
                        </div>
                        <span id="text-proyecto" class="progress-description"><?php echo round($proyecto->contarTodos("'A'")*100/($proyecto->contarTodos("'A'")+$proyecto->contarTodos("'I'")+$proyecto->contarTodos("'E'")),2);?>% del total.</span>
                    </div><!-- /.info-box-content -->
                </div><!-- /.info-box -->
            </div><!-- /.col -->

            <div class="col-md-4 col-xs-4">
                <div class="info-box bg-orange">
                    <span class="info-box-icon"><i class="fa fa-trash"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Cancelados:</span>
                        <span class="info-box-number" id="create"><?php echo $proyecto->contarTodos("'E'");?></span>
                        <div class="progress">
                            <div class="progress-bar" style="width: <?php echo $proyecto->contarTodos("'E'")*100/($proyecto->contarTodos("'A'")+$proyecto->contarTodos("'I'")+$proyecto->contarTodos("'E'"));?>%"></div>
                        </div>
                        <span id="text-proyecto" class="progress-description"><?php echo round($proyecto->contarTodos("'E'")*100/($proyecto->contarTodos("'A'")+$proyecto->contarTodos("'I'")+$proyecto->contarTodos("'E'")),2);?>% del total.</span>
                    </div><!-- /.info-box-content -->
                </div><!-- /.info-box -->
            </div><!-- /.col -->

            
            <div class="col-md-4 col-xs-4">
                <div class="info-box bg-red">
                    <span class="info-box-icon"><i class="fa fa-check"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Finalizados:</span>
                        <span class="info-box-number" id="create"><?php echo $proyecto->contarTodos("'I'");?></span>
                        <div class="progress">
                            <div class="progress-bar" style="width: <?php echo $proyecto->contarTodos("'I'")*100/($proyecto->contarTodos("'A'")+$proyecto->contarTodos("'I'")+$proyecto->contarTodos("'E'"));?>%"></div>
                        </div>
                        <span id="text-proyecto" class="progress-description"><?php echo round($proyecto->contarTodos("'I'")*100/($proyecto->contarTodos("'A'")+$proyecto->contarTodos("'I'")+$proyecto->contarTodos("'E'")),2);?>% del total.</span>
                    </div><!-- /.info-box-content -->
                </div><!-- /.info-box -->
            </div><!-- /.col -->

            <section class="col-xs-12 col-md-4 pull-right">

                <div class="alert alert-info">
                    <h5>Total de proyectos asignados a clientes naturales:<strong> <?php echo $proyecto->contarTodos("todosn"); ?></strong></h5>

                    <div class="icon">
                        <i class="fa fa-male"></i>
                    </div>
                </div>

            </section>

            <section class="col-xs-12 col-md-8">
                <div class="box box-danger box-solid">
                <div class="box-header with-border bg-red">
                    <h3 class="box-title">Seleccione un cliente(Natural) para mostrar los proyectos a los cuales está relacionado:</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                    <div class="col-xs-8 col-md-8">
                        <select id="clientenr" name="clientenr" class="form-control">
                        <option value="">Seleccione...</option>
                    </select>
                    </div>
                    
                    <div class="col-xs-4 col-md-4">
                        <button id="mostrarcnp" class="btn btn-default"><i class="fa fa-search"></i> Mostrar</button>
                    </div>
                    <div class="col-xs-12 col-md-12">
                    <table id="tabla-clienten-reporte" class="table table-condensed table-hover">
                            <thead>
                                <tr>
                                    <th><i class="fa fa-crosshairs"></i>Proyectos:</th>
                                    <th><i class="fa fa-money"></i>Total:</th>
                                    <th><i class="fa fa-smile-o"></i>Estado:</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>  
                        </div>
                </div><!-- /.box-body -->
            </div><!-- /.box -->   
            </section>

            <section class="col-xs-12 col-md-8 pull-right">
                <div class="box box-danger box-solid">
                <div class="box-header with-border bg-red">
                    <h3 class="box-title">Seleccione un cliente(Juridico) para mostrar los proyectos a los cuales está relacionado:</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                    <div class="col-xs-8 col-md-8">
                        <select id="clientejr" name="clientejr" class="form-control">
                        <option value="">Seleccione...</option>
                    </select>
                    </div>
                    
                    <div class="col-xs-4 col-md-4">
                        <button id="mostrarcjp" class="btn btn-default pull-right"><i class="fa fa-search"></i> Mostrar</button>
                    </div>
                    <div class="col-xs-12 col-md-12">
                    <table id="tabla-clientej-reporte" class="table table-condensed table-hover">
                            <thead>
                                <tr>
                                    <th><i class="fa fa-crosshairs"></i>Proyectos:</th>
                                    <th><i class="fa fa-money"></i>Total:</th>
                                    <th><i class="fa fa-smile-o"></i>Estado:</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>  
                        </div>
                </div><!-- /.box-body -->
            </div><!-- /.box -->   
            </section>

            <section class="col-xs-12 col-md-4 pull-left">

                <div class="alert alert-info">
                    <h5>Total de proyectos asignados a clientes juridicos:<strong> <?php echo $proyecto->contarTodos("todosj"); ?></strong></h5>
                    <div class="icon">
                        <i class="fa fa-institution"></i>
                    </div>
                </div>

            </section>

            <section class="col-xs-12 col-md-12">
                <div class="box box-primary box-solid">
                    <div class="box-header with-border">
                        <h3 class="box-title">Listado de proyectos activos:</h3>
                    </div><!-- /.box-header -->
                    <div class="box-body">
                        <div class="col-xs-12 col-md-12">
                            <table id="tabla-activos" class="table table-condensed table-hover">
                                <thead>
                                    <tr>
                                        <th><i class="fa fa-crosshairs"></i>Codigo:</th>
                                        <th><i class="fa fa-smile-o"></i>Responsable:</th>
                                        <th><i class="fa fa-smile-o"></i>Cliente:</th>
                                        <th><i class="fa fa-money"></i>Precio:</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>  
                        </div>
                    </div><!-- /.box-body -->
                </div><!-- /.box -->   
            </section>

            <section class="col-xs-12 col-md-12">
                <div class="box box-warning box-solid">
                    <div class="box-header with-border">
                        <h3 class="box-title">Listado de proyectos cancelados:</h3>
                    </div><!-- /.box-header -->
                    <div class="box-body">
                        <div class="col-xs-12 col-md-12">
                            <table id="tabla-cancelados" class="table table-condensed table-hover">
                                <thead>
                                    <tr>
                                        <th><i class="fa fa-crosshairs"></i>Codigo:</th>
                                        <th><i class="fa fa-smile-o"></i>Responsable:</th>
                                        <th><i class="fa fa-smile-o"></i>Cliente:</th>
                                        <th><i class="fa fa-money"></i>Precio:</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>  
                        </div>
                    </div><!-- /.box-body -->
                </div><!-- /.box -->   
            </section>

            <section class="col-xs-12 col-md-12">
                <div class="box box-danger box-solid">
                    <div class="box-header with-border">
                        <h3 class="box-title">Listado de proyectos finalizados:</h3>
                    </div><!-- /.box-header -->
                    <div class="box-body">
                        <div class="col-xs-12 col-md-12">
                            <table id="tabla-finalizados" class="table table-condensed table-hover">
                                <thead>
                                    <tr>
                                        <th><i class="fa fa-crosshairs"></i>Codigo:</th>
                                        <th><i class="fa fa-smile-o"></i>Responsable:</th>
                                        <th><i class="fa fa-smile-o"></i>Cliente:</th>
                                        <th><i class="fa fa-money"></i>Precio:</th>
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
<script src="sistema/controladores/reporteProyecto.js" type="text/javascript"></script>