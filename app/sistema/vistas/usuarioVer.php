<?php session_start(); ?>
<?php  if(isset($_SESSION['usuario'])){?>
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Usuarios del sistema
            <small></small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#" id="sistema/inicio/inicio.php" class="migas-de-pan"><i class="fa fa-home"></i> Inicio</a></li>
            <li class="">Usuarios</li>
            <li id="migadepan" class="active">Consulta</li>
        </ol>
        <div class="row">
            <div class="col-xs-12 col-md-12">
                <div id="msg-box" style="display: none;"></div>
            </div>
        </div>
        <input type="hidden" id="perfil-acceso" name="perfil-acceso" value="<?php echo $_SESSION['rol']?>">
        <input type="hidden" id="persona-acceso" name="persona-acceso" value="<?php echo $_SESSION['persona']?>">
    </section>
    <!-- Main content -->
    <section class="content" id="content-ver-usuario">
        <!-- Main row -->
        <div class="row">
            <!-- Left col -->
            <section class="col-xs-12 col-md-4 col-lg-4">
                <!-- Widget: user widget style 1 -->
                <div class="box box-widget widget-user">
                    <!-- Add the bg color to the header using any of the bg-* classes -->
                    <div class="widget-user-header bg-green-active">
                        <h3 class="widget-user-username" id="etq-nombre"></h3>
                        <h5 class="widget-user-desc" id="etq-desperfil"></h5>
                    </div>
                    <div class="widget-user-image">
                        <img id="imguser" class="img-circle" src="dist/img/user-160x160.jpg" alt="User Avatar" style="width: 98px; height: 98px;">
                    </div>
                    <div class="box-footer">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="description-block">
                                    <h5 class="description-header" id="etq-user"></h5>
                                    <span class="" id="etq-mail"></span><br>
                                    <span class="" id="etq-mail"><a href="#slider-foto" data-toggle="collapse"><i class="fa fa-camera"></i> Foto de Perfil</a></span>
                                </div>
                                <!-- /.description-block -->
                            </div>
                            <!-- /.col -->
                        </div>
                        <!-- /.row -->
                    </div>
                </div>
                <!-- /.widget-user -->

                <!-- slider foto -->
                <div  class="collapse" id="slider-foto">
                    <h4>Foto de Perfil</h4>
                    <form id="form-subir" name="form-subir" method="post" role="form" enctype="multipart/form-data">
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
            </section><!-- /.Left col -->
            <!-- Right col -->
            <section class="col-xs-12 col-md-8">
               <!-- box -->
                <div class="box box-primary">
                    <div class="box-header ">
                        <h3 class="box-title"><span class="hidden-xs">Datos de</span> Usuario</h3>
                    </div><!-- /.box-header -->
                    <!-- box-body -->
                    <div class="box-body">
                        <div role="tabpanel">
                            <ul class="nav nav-tabs" role="tablist">
                                <li role="presentation" class="active">
                                    <a href="#seccion-1" aria-controls="seccion-1" data-toggle="tab" role="tab"><i class="fa fa-male"></i> Datos Personales</a>
                                </li>
                                <li role="presentation">
                                    <a href="#seccion-2" aria-controls="seccion-2" data-toggle="tab" role="tab"><i class="fa fa-user"></i> Datos de Usuario</a>
                                </li>
                            </ul>
                            <div class="tab-content">
                                <!-- seccion-1 -->
                                <div role="tabpanel" class="tab-pane active" id="seccion-1">
                                    <br>
                                    <form action="#" id="form-persona-mod" name="form-persona-mod" method="post" role="form">
                                        <div class="col-xs-12 col-md-12">
                                            <div class="form-group">
                                                <label>
                                                    <input type="radio" id="nac" name="nac" class="" checked value="V"/>
                                                    Venezolano
                                                </label>
                                                <label>
                                                  <input type="radio" id="nac" name="nac" class="" value="E"/>
                                                  Extranjero
                                                </label>
                                            </div>
                                        </div><!-- /.col-xs-12 -->
                                        <div class="col-xs-12 col-md-6">
                                            <div id="div-ced" class="form-group">
                                                <label class="control-label" for="ced">Cédula:</label>
                                                <input type="text" id="ced" name="ced" class="form-control input-sm" readonly placeholder="00000000" />
                                            </div>
                                        </div><!-- /.col-xs-4 -->

                                        <div class="col-xs-12 col-md-6">
                                            <div id="div-nom" class="form-group">
                                                <label class="control-label" for="nom">Nombre:</label>
                                                <input type="text" id="nom" name="nom" class="form-control input-sm valida-texto" placeholder="Su nombre" required/>
                                            </div>
                                        </div><!-- /.col-xs-4 -->

                                        <div class="col-xs-12 col-md-6">
                                            <div id="div-ape" class="form-group">
                                                <label class="control-label" for="ape">Apellido</label>
                                                <input type="text" id="ape" name="ape" class="form-control input-sm valida-texto" placeholder="Su Apellido" required/>
                                            </div>
                                        </div><!-- /.col-xs-4 -->

                                        <div class="col-xs-12 col-md-6">
                                            <div id="div-sexo" class="form-group">
                                                <label class="control-label" for="sexo">Sexo</label>
                                                <select id="sexo" name="sexo" class="form-control">
                                                    <option>Seleccione...</option>
                                                    <option value="M">Masculino</option>
                                                    <option value="F">Femenino</option>
                                                </select>
                                            </div>
                                        </div><!-- /.col-xs-4 -->
                                        
                                        <div class="col-xs-12 col-md-12">
                                            <div id="div-civil" class="form-group">
                                                <input type="radio" id="civil" name="civil" class="minimal" checked value="S"/>
                                                <label for="civil">Soltero</label>

                                                <input type="radio" id="civil" name="civil" class="minimal" value="C"/>
                                                <label for="civil">Casado</label>

                                                <input type="radio" id="civil" name="civil" class="minimal" value="V"/>
                                                <label for="civil">Viudo</label>

                                                <input type="radio" id="civil" name="civil" class="minimal" value="D"/>
                                                <label for="civil">Divorciado</label>
                                            </div>
                                        </div><!-- /.col-xs-4 -->
                                        <div class="col-xs-12 col-md-12">
                                            <div id="div-dir" class="form-group">
                                                <label class="control-label" for="dir">Domicilio:</label>
                                                <textarea class="form-control input-sm valida-charesp" id="dir" name="dir" rows="2" placeholder="Su direccion"></textarea>
                                            </div>
                                        </div><!-- /.col-xs-12 -->
                                                                                
                                        <div class="col-xs-12 col-md-6">
                                            <div class="form-group" id="div-tel">
                                                <label class="control-label" for="tel">Teléfono</label>
                                                <div class="input-group">
                                                    <div class="input-group-addon">
                                                        <i class="fa fa-phone"></i>
                                                    </div>
                                                    <input type="text" id="tel" name="tel" class="form-control valida-telefono" data-inputmask='"mask": "(9999) 999-9999"' data-mask/>
                                                </div><!-- /.input group -->
                                            </div>
                                        </div><!-- /.col-xs-4 -->

                                        <div class="col-xs-12 col-md-6">
                                            <div class="form-group" id="div-cel">
                                                <label class="control-label" for="cel">Celular</label>
                                                <div class="input-group">
                                                    <div class="input-group-addon">
                                                        <i class="fa fa-mobile"></i>
                                                    </div>
                                                    <input type="text" id="cel" name="cel" class="form-control valida-celular" data-inputmask='"mask": "(9999) 999-9999"' data-mask required/>
                                                </div><!-- /.input group -->
                                            </div>
                                        </div><!-- /.col-xs-4 -->
                                        <div class="col-xs-12 col-md-6">
                                            <div class="form-group" id="div-correo">
                                                <label class="control-label" for="correo">Email</label>
                                                <div class="input-group">
                                                    <div class="input-group-addon">
                                                        <i class="fa fa-envelope"></i>
                                                    </div>
                                                    <input type="email" id="correo" name="correo" class="form-control valida-email" placeholder="Email">
                                                </div><!-- /.input group -->
                                            </div>
                                        </div><!-- /.col-xs-4 -->
                                        <div class="col-xs-12">
                                            <button type="submit" id="btn-add-persona" class="btn btn-success" disabled><i class="fa fa-save"></i> Guardar</button>
                                        </div>
                                    </form>
                                </div><!-- /.seccion-1 -->
                                
                                <!-- seccion-2 -->
                                <div role="tabpanel" class="tab-pane" id="seccion-2">
                                    <br>
                                    <form id="form-usuario-mod" name="form-usuario-mod-2" method="post" role="form">
                                        <div class="col-xs-12 col-md-6">
                                            <div id="div-usuario" class="form-group">
                                                <label class="control-label" for="usuario">ID:</label>
                                                <input type="text" id="usuario" name="usuario" class="form-control input-sm valida-blancos valida-nom-usu" placeholder="Nombre de acceso" maxlength="15"/>
                                                <input type="hidden" id="old" name="old" value="">
                                                <input type="hidden" id="persona" name="persona" value="">
                                            </div>
                                        </div><!-- /.col-xs-6 -->

                                        <div class="col-xs-12 col-md-6">
                                            <div id="div-clave" class="form-group">
                                                <label class="control-label" for="clave">Clave:</label>
                                                <input type="password" id="clave" name="clave" class="form-control input-sm valida-seg-clave valida-blancos" placeholder="Nueva clave de acceso" maxlength="10"/>
                                            </div>
                                        </div><!-- /.col-xs-6 -->

                                        <div class="col-xs-12 col-md-6">
                                            <div id="div-confirmar" class="form-group">
                                                <label class="control-label" for="confirmar">Confirmar clave:</label>
                                                <input type="password" id="confirmar" name="confirmar" class="form-control input-sm valida-confirmacion valida-blancos" placeholder="Confimacion de clave" maxlength="10"/>
                                            </div>
                                        </div><!-- /.col-xs-6 -->
                                        <div class="col-xs-12 col-md-6">
                                            <div id="div-perfil" class="form-group">
                                                <label class="control-label" for="desperfil">Perfil en el sistema:</label>
                                                <input type="hidden" name="perfil" id="perfil">
                                                <input type="hidden" name="oldperfil" id="oldperfil">
                                                <input type="text" name="desperfil" id="desperfil" class="form-control" disabled>
                                            </div>
                                        </div><!-- /.col-xs-4 -->

                                        <div class="col-xs-12 col-md-6">
                                            <div id="div-especialidad" class="form-group">
                                                <label for="desespecialidad" class="control-label">Especialidad:</label>
                                                <input type="hidden" name="especialidad" id="especialidad">
                                                <input type="text" name="desespecialidad" id="desespecialidad" class="form-control" disabled>
                                            </div>
                                        </div><!-- /.col-xs-4 -->
                                    
                                        <div class="col-xs-12 col-md-6">
                                            <div id="div-estatus" class="form-group">
                                                <label class="control-label" for="estatus">Estado de usuario</label>
                                                <input type="hidden" name="estatus" id="estatus">
                                                <input type="text" id="desestatus" name="desestatus" class="form-control" disabled>
                                            </div>
                                        </div><!-- /.col-xs-4 -->
                                        <div class="col-md-12">
                                            <button type="submit" id="btn-add-usuario" class="btn btn-success" disabled><i class="fa fa-save"></i> Guardar</button>
                                        </div>
                                    </form>
                                </div><!-- /.seccion-1 -->  
                            </div><!-- /.tab-content -->
                            
                        </div><!-- /.box-tabpanel -->    
                    </div><!-- /.box-body -->
                </div> <!-- /.box -->
            </section><!-- /.Right col -->
        </div><!-- /.row -->
    </section><!-- /.content main-->   
<?php }; ?>
<!-- validador.js -->
<script src="sistema/controladores/validador.js" type="text/javascript"></script>
<script src="sistema/controladores/persona.js" type="text/javascript"></script>
<script src="sistema/controladores/usuario.js" type="text/javascript"></script>
