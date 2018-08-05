<?php session_start(); ?>
<?php  if(isset($_SESSION['usuario'])){?>
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Buzon de mensajes
            <small></small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#" id="sistema/inicio/inicio.php" class="migas-de-pan"><i class="fa fa-home"></i> Inicio</a></li>
            <li class="">Mensajes</li>
            <li id="migadepan" class="active">Buzon</li>
        </ol>
        <br>
        <?php if($_SESSION['rol']<=2){?>
        <div class="pull-right btn-group">
            <button id="sistema/vistas/mensajeConsulta.php" class="btn btn-app migas-de-pan btn-vol-mensaje" disabled><i class="fa fa-reply"></i> Volver</button>
        </div>
        <?php }?>
        <div class="row">
            <div class="col-xs-12 col-md-12">
                <div id="msg-box" style="display: none;"></div>
            </div>
        </div>
        <input type="hidden" id="perfil-acceso" name="perfil-acceso" value="<?php echo $_SESSION['rol']?>">
        <input type="hidden" id="persona-acceso" name="persona-acceso" value="<?php echo $_SESSION['persona']?>">
    </section>
    <!-- Main content -->
    <section class="content" id="content-lista-mensaje">
        <!-- Main row -->
        <div class="row">
            <!-- Left col -->
            <section class="col-xs-8 col-md-12">
                <!-- box -->
                <div class="box box-primary box-solid" id="box">
                    <div class="box-header with-border bg-olive">
                        <h3 class="box-title"><span class="hidden-xs">Listado de</span> Mensajes</h3>
                    </div><!-- /.box-header -->
                    <!-- box-body -->
                    <div class="box-body table-responsive" id="box-body-1">

                         <table id="tabla-mensaje" class="table table-condensed table-hover">
                            <thead>
                                <tr>
                                    <th><i class="fa fa-at"></i>Origen</th>
                                    <th><i class="fa fa-crosshairs"></i>Asunto</th>
                                    <th><i class="fa fa-calendar"></i>Fecha</th>
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
    <section class="content" id="content-form-mensaje" style="display: none;">
        <!-- Main row -->
        <div class="row">
            <!-- Left col -->
            <section class="col-xs-12 col-md-12">
                <!-- box -->
                <div class="box box-primary">
                    <div class="box-header with-border bg-info">
                        <h3 class="box-title"><span class="hidden-xs">Revisión de</span> Mensaje</h3>
                    </div><!-- /.box-header -->
                    <!-- box-body -->
                    <div class="box-body">
                        <!-- section-servicio-datos -->
                        <section class="col-xs-12"><br>
                        
                            <form action="#" method="post" id="form-mensaje" name="form-mensaje" role="form">

                                <div class="col-xs-12 col-md-10">
                                    <div id="div-ori" class="form-group">
                                        <label class="control-label" for="ori">Origen:</label>
                                        <input type="text" id="ori" name="ori" class="form-control input-sm valida-texto" placeholder="Origen" disabled />
                                    </div>
                                </div><!-- /.col-xs-4 -->

                                <div class="col-xs-12 col-md-10">
                                    <div id="div-asu" class="form-group">
                                        <label class="control-label" for="asu">Asunto:</label>
                                        <input type="text" id="asu" name="asu" class="form-control input-sm valida-texto" placeholder="Asunto" disabled />
                                    </div>
                                </div><!-- /.col-xs-4 -->

                                <div class="col-xs-12 col-md-12">
                                    <div id="div-cont" class="form-group">
                                        <label class="control-label" for="cont">Contenido:</label>
                                        <textarea class="form-control input-sm valida-charesp" id="cont" name="cont" rows="5" placeholder="Contenido"></textarea>
                                    </div>
                                </div><!-- /.col-xs-12 -->

                                <div class="col-xs-12 col-md-6">
                                    <div id="div-fec" class="form-group">
                                        <label class="control-label" for="fec">Fecha:</label>
                                        <input type="text" id="fec" name="fec" class="form-control input-sm valida-numero" placeholder="Fecha" required/>
                                    </div>
                                </div><!-- /.col-xs-4 -->
                                                                                
                            </form><!-- /#form-servicio -->
                        </section><!-- /section-servicio-datos -->
                        
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
<script src="sistema/controladores/mensaje.js" type="text/javascript"></script>