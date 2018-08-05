<?php session_start(); ?>
<?php  if(isset($_SESSION['usuario'])){?>
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Registrar servicio
            <small>Registro de servicios al sistema</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#" id="sistema/inicio/inicio.php" class="migas-de-pan"><i class="fa fa-home"></i> Inicio</a></li>
            <li class="">Servicios</li>
            <li id="migadepan" class="active">Registrar</li>
        </ol>
        <br>

        <section class="col-md-12">
            <div class="callout callout-info">
                <h4>Consejo!</h4>
                <p>Se sugiere ser breve en el campo de descripción. Se deja el campo de observaciones para más detalles.</p>
            </div>
        </section>

        <div class="row">
            <div class="col-xs-12 col-md-12">
                <div id="msg-box" style="display: none;"></div>
            </div>
        </div>
        <input type="hidden" id="perfil-acceso" name="perfil-acceso" value="<?php echo $_SESSION['rol']?>">
        <input type="hidden" id="persona-acceso" name="persona-acceso" value="<?php echo $_SESSION['persona']?>">
    </section>
    
    <!-- Main content -->
    <section class="content" id="content-form-servicio">
        <!-- Main row -->
        <div class="row">
            <!-- Left col -->
            <section class="col-xs-12 col-md-12">
                <!-- box -->
                <div class="box box-primary">
                    <div class="box-header with-border bg-info">
                        <h3 class="box-title"><span class="hidden-xs">Almacenar</span> Informacion</h3><br>
                        <span class="text-danger">(*)Campos obligatorios</span>
                    </div><!-- /.box-header -->
                    <!-- box-body -->
                    <div class="box-body">
                        <!-- section-servicio-datos -->
                        <section class="col-xs-12 col-md-6"><br>
                        
                            <form action="#" method="post" id="form-servicio" name="form-servicio" role="form">

                                <div class="col-xs-12 col-md-10">
                                    <div id="div-des" class="form-group">
                                        <span class="text-danger">(*)</span>
                                        <label class="control-label" for="des">Descripcion:</label>
                                        <input type="text" id="des" name="des" class="form-control input-sm valida-texto" placeholder="Descripcion" required/>
                                    </div>
                                </div><!-- /.col-xs-4 -->

                                <div class="col-xs-12 col-md-12">
                                    <div id="div-ob" class="form-group">
                                        <span class="text-danger">(*)</span>
                                        <label class="control-label" for="ob">Observacion:</label>
                                        <textarea class="form-control input-sm valida-charesp" id="ob" name="ob" rows="5" placeholder="Observacion"></textarea>
                                    </div>
                                </div><!-- /.col-xs-12 -->

                                <div class="col-xs-12 col-md-8">
                                    <div id="div-dur" class="form-group">
                                        <span class="text-danger">(*)</span>
                                        <label class="control-label" for="dur">Duración estimada(Días):</label>
                                        <input type="number" id="dur" name="dur" class="form-control input-sm valida-numero" placeholder="00000000" min="15" max="60" required/>
                                    </div>
                                </div><!-- /.col-xs-4 -->

                                <div class="col-xs-12 col-md-8">
                                    <div id="div-pre" class="form-group">
                                        <span class="text-danger">(*)</span>
                                        <label class="control-label" for="pre">Presupuesto(BsS):</label>
                                        <input type="number" id="pre" name="pre" class="form-control input-sm valida-numero" placeholder="00000000" step="0.0001" required/>
                                    </div>
                                </div><!-- /.col-xs-4 -->
                                                                                
                                <div class="col-xs-12">
                                    <button type="submit" id="btn-add-servicio" class="btn btn-success"><i class="fa fa-save"></i> Guardar</button>
                            
                                    <button type="button" id="btn-can-servicio" class="btn btn-default"><i class="fa fa-ban"></i> Cancelar</button>
                                </div>

                            </form><!-- /#form-servicio -->
                        </section><!-- /section-servicio-datos -->

                        
                        <!-- Right col -->
                        <section class="col-xs-12 col-md-6">
                            <!-- Widget: user widget style 1 -->
                            <div class="box box-widget widget-user">

                                <!-- Add the bg color to the header using any of the bg-* classes -->
                                <!-- <div class="bg-blue-active">
                                    <h3 class="widget-user-username" id="etq-nombre"></h3>
                                    <h5 class="widget-user-desc" id="etq-desperfil"></h5>
                                </div> -->
                                <div>
                                    <img id="imgservice" src="dist/img/default.png" alt="Service Avatar" style="width: 350px; height: 250px;">
                                    <input type="hidden" id="imgservice2" value="user-160x160.jpg">
                                </div>

                                <div class="box-footer">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="description-block">
                                                <h5 class="description-header" id="etq-serive"></h5>
                                                <span class="" id="etq-mail"></span><br>
                                                <span class="" id="etq-mail"><a href="#slider-foto" data-toggle="collapse"><i class="fa fa-camera"></i> Subir imagen</a></span>
                                            </div><!-- /.description-block -->
                                        </div><!-- /.col -->
                                    </div><!-- /.row -->
                                </div>
                            </div><!-- /.widget-user -->
                            <!-- slider foto -->
                            <div  class="collapse" id="slider-foto">
                                <h4>Imagen ilustrativa</h4>
                                <form id="form-subir2" name="form-subir2" method="post" role="form" enctype="multipart/form-data">
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