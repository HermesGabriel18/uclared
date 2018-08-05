<?php session_start(); ?>
<?php  if(isset($_SESSION['usuario'])){?>
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Consulta de servicios
            <small>Servicios del sistema</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#" id="sistema/inicio/inicio.php" class="migas-de-pan"><i class="fa fa-home"></i> Inicio</a></li>
            <li class="">Servicios</li>
            <li id="migadepan" class="active">Consultar</li>
        </ol>
        <br>
        <div class="pull-right btn-group">
        <?php if($_SESSION['rol']<=2){?>
            <button id="sistema/vistas/servicioRegistrar.php" class="btn btn-app migas-de-pan btn-new-servicio"><i class="fa fa-plus-circle text-teal"></i>Nuevo</button>
        <?php }else{?>
            <button class="btn btn-app" disabled><i class="fa fa-plus-circle text-teal"></i>Nuevo</button>
        <?php } ?>

            <button id="sistema/vistas/servicioConsulta.php" class="btn btn-app migas-de-pan btn-vol-servicio" disabled><i class="fa fa-reply"></i> Volver</button>
        </div>
        

        <section class="col-xs-8 col-md-9" id="info-service">
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
                        <?php if($_SESSION['rol']<=2){ ?>
                            <li class="item">(
                            <i style="color: #08F;" class="fa fa-edit"></i>) Modificar datos del servicio.
                            </li><!-- /.item -->
                            <li class="item">(
                            <i style="color: #08F;" class="fa fa-trash"></i>) Eliminar de forma permanente el servicio del sistema.                    
                            </li><!-- /.item -->
                        <?php }else{ ?>
                            <li class="item">(
                                <i style="color: #08F;" class="fa fa-search"></i>) Ver información del servicio.
                            </li><!-- /.item -->
                        <?php } ?>
                    </ul>
                </div><!-- /.box-body -->
            </div><!-- /.box -->                                   
        </section><!-- right col -->


        <div class="row">
            <div class="col-xs-12 col-md-12">
                <div id="msg-box" style="display: none;"></div>
            </div>
        </div>
        <input type="hidden" id="perfil-acceso" name="perfil-acceso" value="<?php echo $_SESSION['rol']?>">
        <input type="hidden" id="persona-acceso" name="persona-acceso" value="<?php echo $_SESSION['persona']?>">
    </section>
    <!-- Main content -->
    <section class="content" id="content-lista-servicio">
        <!-- Main row -->
        <div class="row">
            <!-- Left col -->
            <section class="col-xs-8 col-md-12">
                <!-- box -->
                <div class="box box-primary box-solid" id="box">
                    <div class="box-header with-border bg-olive">
                        <h3 class="box-title"><span class="hidden-xs">Listado de</span> Servicios</h3>
                    </div><!-- /.box-header -->
                    <!-- box-body -->
                    <div class="box-body table-responsive" id="box-body-1">

                         <table id="tabla-servicio" class="table table-condensed table-hover">
                            <thead>
                                <tr>
                                    <th><i class="fa fa-hashtag"></i>Nro.</th>
                                    <th><i class="fa fa-crosshairs"></i>Descripcion</th>
                                    <th></th>
                                    <th><i class="fa fa-money"></i>Presupuesto(BsS)</th>
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


    <!-- Main content -->
    <section class="content" id="content-form-servicio" style="display: none;">
        <!-- Main row -->
        <div class="row">
            <!-- Left col -->
            <section class="col-xs-12 col-md-12">
                <!-- box -->
                <div class="box box-primary">
                    <div class="box-header with-border bg-info">
                        <h3 class="box-title">Modificar<span class="hidden-xs"> información</span>:</h3><br>
                        <span class="text-danger">(*)Campos que el usuario no puede dejar vacíos.</span>
                    </div><!-- /.box-header -->
                    <!-- box-body -->
                    <div class="box-body">
                        <!-- section-servicio-datos -->
                        <section class="col-xs-12 col-md-6"><br>
                        
                            <form action="#" method="post" id="form-servicio-mod" name="form-servicio" role="form">

                                <div class="col-xs-12 col-md-10">
                                    <div id="div-des" class="form-group">
                                        <label class="control-label" for="desm">Descripcion:</label>
                                        <input type="text" id="desm" name="desm" class="form-control input-sm valida-texto" placeholder="Descripcion" required/>
                                        <input type="hidden" id="cod" value="">
                                    </div>
                                </div><!-- /.col-xs-4 -->

                                <div class="col-xs-12 col-md-12">
                                    <div id="div-ob" class="form-group">
                                        <label class="control-label" for="obm">Observacion:</label>
                                        <textarea class="form-control input-sm valida-charesp" id="obm" name="obm" rows="5" placeholder="Observacion"></textarea>
                                    </div>
                                </div><!-- /.col-xs-12 -->

                                <div class="col-xs-12 col-md-8">
                                    <div id="div-durm" class="form-group">
                                        <span class="text-danger">(*)</span>
                                        <label class="control-label" for="durm">Duración estimada(Días):</label>
                                        <input type="text" id="durm" name="durm" class="form-control input-sm valida-numero" placeholder="00000000" required/>
                                    </div>
                                </div><!-- /.col-xs-4 -->

                                <div class="col-xs-12 col-md-6">
                                    <div id="div-pre" class="form-group">
                                        <label class="control-label" for="prem">Presupuesto(BsS):</label>
                                        <input type="text" id="prem" name="prem" class="form-control input-sm valida-numero" placeholder="00000000" required/>
                                    </div>
                                </div><!-- /.col-xs-4 -->

                                <div class="col-xs-12 col-md-6">
                                    <div id="div-est" class="form-group">
                                        <label class="control-label" for="estatus">Estatus:</label>
                                        <select name="estatus" id="sestatus" class="form-control">
                                            <option value="A">Activo</option>
                                            <option value="I">Inactivo</option>
                                        </select>
                                    </div>
                                </div><!-- /.col-xs-4 -->

                                <?php if($_SESSION['rol']<=2){ ?>
                                                                                
                                <div class="col-xs-12">
                                    <button type="submit" id="btn-add-servicio" class="btn btn-success"><i class="fa fa-save"></i> Guardar</button>
                                </div>

                                <?php } ?>

                            </form><!-- /#form-servicio -->
                        </section><!-- /section-servicio-datos -->

                        
                        <!-- Right col -->
                        <section class="col-xs-12 col-md-6">
                            <!-- Widget: user widget style 1 -->
                            <div class="box box-widget widget-user">

                                <div>
                                    <img id="imgservicem" src="dist/img/default.png" alt="Service Avatar" style="width: 300px; height: 300px;">
                                    <input type="hidden" id="imgservice2m" value="user-160x160.jpg">
                                </div>

                                <?php if($_SESSION['rol']<=2){ ?>

                                <div class="box-footer">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="description-block">
                                                <h5 class="description-header" id="etq-serive"></h5>
                                                <span class="" id="etq-mail"></span><br>
                                                <span class="" id="etq-mail"><a href="#slider-foto" data-toggle="collapse"><i class="fa fa-camera"></i> Cambiar imagen</a></span>
                                            </div><!-- /.description-block -->
                                        </div><!-- /.col -->
                                    </div><!-- /.row -->
                                </div>

                                <?php } ?>
                            </div><!-- /.widget-user -->
                            <!-- slider foto -->
                            <div  class="collapse" id="slider-foto">
                                <h4>Imagen ilustrativa</h4>
                                <form id="form-subir3" name="form-subir3" method="post" role="form" enctype="multipart/form-data">
                                    <div class="col-xs-12">
                                        <div id="mensaje"></div>
                                        <div class="form-group">
                                            <input type="file" id="imagen" name="imagen">
                                            <br>
                                            <button type="submit" id="btn-subir" class="btn bg-olive"><i class="fa fa-upload"></i> Cargar</button>
                                        </div>
                                    </div>
                                </form>
                            </div><!-- /.slider foto -->
                        </section><!-- /.Right col -->
                        
                    </div><!-- /.box-body -->
                </div> <!-- /.box -->
            </section><!-- /.Left col -->
        </div><!-- /.row -->
    </section><!-- /.content main-->


<?php }; ?>
<!-- validador.js -->
<script src="sistema/controladores/validador.js" type="text/javascript"></script>
<script src="sistema/controladores/usuario.js" type="text/javascript"></script>
<script src="sistema/controladores/persona.js" type="text/javascript"></script>
<script src="sistema/controladores/servicio.js" type="text/javascript"></script>