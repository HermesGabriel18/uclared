<?php session_start(); ?>
<?php  if(isset($_SESSION['usuario'])){?>
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Consulta de proyectos
            <small>Proyectos del sistema</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#" id="sistema/inicio/inicio.php" class="migas-de-pan"><i class="fa fa-home"></i> Inicio</a></li>
            <li class="">Proyectos</li>
            <li id="migadepan" class="active">Consultar</li>
        </ol>
        <br>
        <div class="pull-right btn-group">
        <?php if($_SESSION['rol']<=2){?>
            <button id="sistema/vistas/proyectoRegistrar.php" class="btn btn-app migas-de-pan btn-new-proyecto"><i class="fa fa-plus-circle text-teal"></i>Nuevo</button>
        <?php }else{?>
            <button class="btn btn-app" disabled><i class="fa fa-plus-circle text-teal"></i>Nuevo</button>
        <?php } ?>

            <button id="sistema/vistas/proyectoConsulta.php" class="btn btn-app migas-de-pan btn-vol-proyecto" disabled><i class="fa fa-reply"></i> Volver</button>
        </div>
        

        <section class="col-xs-8 col-md-9" id="info-project">
            <div class="box box-danger box-solid">
                <div class="box-header with-border bg-red">
                    <h3 class="box-title">Acciones para esta sección</h3>
                    <div class="box-tools pull-right">
                        <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                        <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                    </div>
                </div><!-- /.box-header -->
                <div class="box-body">
                    <ul class="products-list product-list-in-box">
                        <?php if($_SESSION['rol']<=2) {?>
                            <li class="item">(
                                <i style="color: #08F;" class="fa fa-edit"></i>) Actualizar proyecto.
                            </li><!-- /.item -->
                            <li class="item">(
                                <i style="color: #08F;" class="fa fa-comments-o"></i>) Ver o agregar calificación y comentarios del cliente.                    
                            </li><!-- /.item -->
                        <?php }else{?>
                            <li class="item">(
                                <i style="color: #08F;" class="fa fa-edit"></i>) Actualizar proyecto (Sólo para Jefes de proyectos).
                            </li><!-- /.item -->
                            <li class="item">(
                                <i style="color: #08F;" class="fa fa-search"></i>) Ver información del proyecto.
                            </li><!-- /.item -->
                        <?php } ?>
                    </ul>
                </div><!-- /.box-body -->
            </div><!-- /.box -->                                   
        </section><!-- right col -->

        <div class="row" id="project-pro" style="display: none;">
            <div class="col-lg-4 col-xs-8">
                <div id="box-text-proyecto" class="info-box bg-olive">
                    <span class="info-box-icon"><i class="fa fa-briefcase"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text"><?php echo "Fecha de creación:";?></span>
                        <span class="info-box-number" id="create"></span>
                        <div class="progress">
                            <div class="progress-bar" style="width: <?php echo "0%"?>"></div>
                        </div>
                        <span id="text-proyecto" class="progress-description"></span>
                    </div><!-- /.info-box-content -->
                </div><!-- /.info-box -->
            </div><!-- /.col -->
        </div>

        <div class="col-xs-12" id="opciones-proyecto" style="display: none;">
            <input type="hidden" name="codopc" id="codopc" value="">
            <button type="submit" id="btn-fin-proyecto" class="btn btn-danger"><i class="fa fa-check"></i> Finalizar proyecto</button>
                            
            <button type="button" id="btn-botar-proyecto" class="btn btn-warning"><i class="fa fa-trash"></i> Cancelar proyecto</button>
        </div>

        <div class="row">
            <div class="col-xs-12 col-md-12">
                <div id="msg-box" style="display: none;"></div>
            </div>
        </div>
        <input type="hidden" id="perfil-acceso" name="perfil-acceso" value="<?php echo $_SESSION['rol']?>">
        <input type="hidden" id="persona-acceso" name="persona-acceso" value="<?php echo $_SESSION['persona']?>">
    </section>

    <?php if($_SESSION['rol'] <=2){ ?>
    <!-- Main content -->
    <section class="content" id="content-lista-proyecto">
        <!-- Main row -->
        <div class="row">
            <!-- Left col -->
            <section class="col-xs-8 col-md-12">
                <!-- box -->
                <div class="box box-primary box-solid" id="box">
                    <div class="box-header with-border bg-olive">
                        <h3 class="box-title"><span class="hidden-xs">Listado de</span> Proyectos</h3>
                    </div><!-- /.box-header -->
                    <!-- box-body -->
                    <div class="box-body table-responsive" id="box-body-1">

                         <table id="tabla-proyecto" class="table table-condensed table-hover">
                            <thead>
                                <tr>
                                    <th><i class="fa fa-hashtag"></i>Codigo</th>
                                    <th><i class="fa fa-user"></i>Responsable</th>
                                    <th><i class="fa fa-vcard"></i>Cliente</th>
                                    <th><i class="fa fa-calendar"></i>Periodo(Inicio/Fin)</th>
                                    <th><i class="fa fa-money"></i>Total($)</th>
                                    <th><i class="fa fa-smile-o"></i>Estado</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>   
                    </div><!-- /.box-body -->
                </div> <!-- /.box -->  
            </section><!-- /.Left col -->
        </div><!-- /.row -->
    </section><!-- /.content main-->
    <?php }else{ ?>
    <!-- Main content -->
    <section class="content" id="content-lista-proyecto2">
        <!-- Main row -->
        <div class="row">
            <!-- Left col -->
            <section class="col-xs-8 col-md-12">
                <!-- box -->
                <div class="box box-primary box-solid" id="box">
                    <div class="box-header with-border bg-olive">
                        <h3 class="box-title"><span class="hidden-xs">Listado de</span> Proyectos</h3>
                    </div><!-- /.box-header -->
                    <!-- box-body -->
                    <div class="box-body table-responsive" id="box-body-2">

                         <table id="tabla-proyecto-a" class="table table-condensed table-hover">
                            <thead>
                                <tr>
                                    <th><i class="fa fa-hashtag"></i>Proyecto</th>
                                    <th><i class="fa fa-user"></i>Jefe de proyecto</th>
                                    <th><i class="fa fa-vcar"></i>Cliente</th>
                                    <th><i class="fa fa-calendar"></i>Termina el</th>
                                    <th><i class="fa fa-smile-o"></i>Estado</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>   
                    </div><!-- /.box-body -->
                </div> <!-- /.box -->  
            </section><!-- /.Left col -->
        </div><!-- /.row -->
    </section><!-- /.content main-->
    <?php } ?>

    <!-- Main content -->
    <section class="content" id="content-form-proyecto" style="display:none;">
        <!-- Main row -->
        <div class="row">
            <!-- Left col -->
            <section class="col-xs-12 col-md-12">
                <!-- box -->
                <div class="box box-primary">
                    <div class="box-header with-border bg-info">
                        <h3 class="box-title">Actualizar:</h3>
                    </div><!-- /.box-header -->
                    <!-- box-body -->
                    <div class="box-body">

                        <section class="col-xs-12">
                            <form action="#" method="post" id="form-proyecto-mod" name="form-proyecto-mod" role="form">

                                <input type="hidden" id="cantF">

                                <div id="div-codigo">

                                    <div class="col-xs-12 col-md-4">
                                        <h4 class="box-title">Codigo:</h4>
                                        <input type="text" class="form-control" id="codp" name="codigo" placeholder="Nuevo codigo"><hr>
                                        <input type="hidden" id="codp2" name="codigo">
                                    </div>
                                </div>

                                <div id="fecha">
                                    <input type="hidden" name="inicio" id="inicio2">
                                    <div class="col-xs-12 col-md-4">
                                        <h4 class="box-title">Fecha de inicio:</h4>
                                        <input type="date" name="inicio" id="inicio" class="form-control" data-inputmask='"mask": "99/99/9999"' placeholder="dd/mm/yy" required><hr>
                                    </div>
                                    <div class="col-xs-12 col-md-4">
                                        <h4 class="box-title">Fecha fin:</h4>
                                        <input type="date" name="fin" id="fin" class="form-control" data-inputmask='"mask": "99/99/9999"' placeholder="dd/mm/yy" required><hr>
                                    </div>
                                </div>

                                

                                <div class="col-xs-12 col-md-6" id="div-responsable">        <h4 class="box-title">Jefe de proyecto:</h4>
        
                                    <!-- <div class="col-xs-12 col-md-12">

                                        
                                

                                        <label for="fres" id="lblres">Cédula:</label>  

                                        <div id="div-ced" class="form-group">
                                            <input type="text" class="form-control find-usuario" id="fpersona" placeholder="Introduzca una cedula" maxlength="9">
                                            <hr>
                                            <input type="hidden" id="fpersona2" name="resp">
                                        </div>
                                    </div> -->

                                    <div class="col-xs-12 col-md-12">
                                        <div id="div-jefe" class="form-group">
                                            <label for="jefe" id="lbljefe">Nombre y apellido:</label>
                                            <select id="jefe" name="resp" class="form-control">
                                                <option value="">Seleccione...</option>
                                            </select><hr>
                                        </div>
                                    </div>


                                </div><!-- #responsable -->

                                <!-- <div class="col-xs-12 col-md-6">
                                            <div id="div-jefe" class="form-group">
                                                <span class="text-danger">(*)</span>
                                                <label for="jefe" class="control-label">Jefe:</label>
                                                <select id="jefe" name="jefe" class="form-control">
                                                    <option value="">Seleccione...</option>
                                                </select>
                                            </div>
                                        </div> --><!-- /.col-xs-4 -->

                                <div class="col-xs-12 col-md-6" id="div-cliente">
                                    <div class="col-xs-12 col-md-12">
                                        <h4 class="box-title"><!-- <span class="hidden-xs">Elija un</span>  -->Cliente<!-- <span class="hidden-xs"> para el proyecto</span> -->:</h4>
                                    </div>

                                        
                                        <div class="col-xs-12 col-md-12">
                                            
                                            <label for="fcli" id="lblcli">Cédula/RIF:</label>

                                            <!-- <div id="div-rif" class="form-group">
                                                <input type="text" class="form-control find-cli" id="fcli" placeholder="Introduzca una cedula" maxlength="9">
                                                <input type="hidden" id="fcli2" name="cliente">
                                                <hr>
                                            </div> -->
                                            <input class="form-control" id="fclip" type="text" disabled><hr>
                                        </div>

                                </div><!-- /#cliente -->

                                <div id="servicios">

                                    <div class="col-xs-12-col-md-12">
                                        <h4 class="box-title"><span class="hidden-xs">Elija los</span> Servicios<span class="hidden-xs"> para el proyecto</span>:</h4>
                                    </div>

                                    

                                    <div class="box-body table-responsive" id="box-body-1">

                                        <table id="tabla-servicio-p" class="table table-condensed table-hover">
                                            <thead>
                                                <tr>
                                                    <th>Nro.</th>
                                                    <th>Descripcion</th>
                                                    <th>Presupuesto(Bss)</th>
                                                    <th>Duración estimada(días)</th>
                                                    <th>(<i class="fa fa-times">) </i>Finalizar</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            </tbody>
                                        </table><hr>
                                    </div><!-- /.box-body -->
                                </div><!-- /#servicios -->

                                <div id="usuarios">

                                    <h4 class="box-title"><span class="hidden-xs">Elija los</span> Usuarios<span class="hidden-xs"> para el proyecto</span>:</h4>

                                    <div class="box-body table-responsive" id="box-body-1">

                                        <!-- <input type="hidden" id="permiso"> -->

                                        <table id="tabla-usuario-p" class="table table-condensed table-hover">
                                            <thead>
                                                <tr>
                                                    <th>Cedula</th>
                                                    <th>Nombre y Apellido</th>
                                                    <th>Especialidad</th>
                                                    <th></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            </tbody>
                                        </table><hr>
                                    </div><!-- /.box-body -->
                                </div><!-- /#servicios -->

                                <!-- <input type="text" id="pancito"> -->

                                    <div id="botonespro" class="col-xs-12">
                                        <input type="hidden" name="funcion" value="edit">
                                        <button type="submit" id="btn-add-proyecto" class="btn btn-success"><i class="fa fa-save"></i> Guardar</button>
                                    </div>

                            </form>

                        </section>


                    </div><!-- /.box-body -->
                </div> <!-- /.box -->
                <div class="row">
                    <div class="col-xs-12 col-md-12">
                        <div id="msg-box-pro" style="display: none;"></div>
                    </div>
                </div>
            </section><!-- /.Left col -->
        </div><!-- /.row -->
    </section><!-- /.content main-->

    <section class="content" id="content-proyecto-comentarios" style="display: none;">

         <div class="row">
            <!-- Left col -->
            <section class="col-xs-12 col-md-12">
                <!-- box -->
                <div class="box box-primary">
                    <div class="box-header with-border bg-info">
                        <h3 class="box-title">Observaciones del cliente:</h3>
                    </div><!-- /.box-header -->
                    <!-- box-body -->
                    <div class="box-body">

                        <section class="col-xs-12">
                            <form action="#" method="POST" id="form-proyecto-com" name="form-proyecto-com" role="form">

                                    <div id="div-codigop" class="form-group">
                                        <div class="col-xs-12 col-md-4">
                                            <label for="codigop" class="label-control">Código:</label>
                                            <input type="text" class="form-control" id="codigop" name="codigop" placeholder="Codigo">
                                        </div>
                                    </div>

                                    <div id="div-respc" class="form-group">
                                        <div class="col-xs-12 col-md-4">
                                            <label for="respc" class="label-control">Jefe de proyecto:</label>
                                            <input type="text" class="form-control" id="respc" name="respc" placeholder="Jefe de proyecto" disabled>
                                            <input type="hidden" id="cocodigo" name="cocodigo">
                                        </div>
                                    </div>

                                    <div id="div-clic" class="form-group">
                                        <div class="col-xs-12 col-md-4">
                                            <label for="clic" class="label-control">Cliente:</label>
                                            <input type="text" class="form-control" id="clic" name="clic" placeholder="Cliente" disabled><br>
                                        </div>
                                    </div>
                                    
                                    <div id="div-cali" class="form-group">
                                        <label for="cali" class="control-label">Calificación:</label>
                                        <input type="radio"  name="cali" class="minimal" checked value="5"/>
                                        <label for="cali">Excelente<i class="fa fa-smile-o"></i></label>

                                        <input type="radio" name="cali" class="minimal" value="4"/>
                                        <label for="cali">Buena<i class="fa fa-thumbs-o-up"></i></label>

                                        <input type="radio"  name="cali" class="minimal" value="3"/>
                                        <label for="cali">Regular<i class="fa fa-meh-o"></i></label>

                                        <input type="radio" name="cali" class="minimal" value="2"/>
                                        <label for="cali">Mala<i class="fa fa-thumbs-o-down"></i></label>

                                        <input type="radio"  name="cali" class="minimal" value="1"/>
                                        <label for="cali">Muy mala<i class="fa fa-frown-o"></i></label>
                                    </div>

                                    <div class="col-md-10">
                                        <div id="div-comentario" class="form-group">
                                            <label for="comen" class="control-label">Comentarios:</label>
                                            <textarea name="comen" id="comen" rows="3" class="form-control" maxlength="200"></textarea>
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <input type="hidden" name="funcion" value="addC">
                                        <button type="submit" id="btn-add-comentario" class="btn btn-success"><i class="fa fa-envelope-o"></i> Guardar</button>
                                    </div>

                            </form>
                        </section>
                    </div>
                </div>

            </section>
        </div>
        
    </section>


<?php }; ?>
<!-- validador.js -->
<script src="sistema/controladores/validador.js" type="text/javascript"></script>
<script src="sistema/controladores/usuario.js" type="text/javascript"></script>
<script src="sistema/controladores/persona.js" type="text/javascript"></script>
<script src="sistema/controladores/cliente.js" type="text/javascript"></script>
<!-- <script src="sistema/controladores/servicio.js" type="text/javascript"></script> -->
<script src="sistema/controladores/proyecto.js" type="text/javascript"></script>

<script src="sistema/controladores/reporteServicio.js" type="text/javascript"></script>