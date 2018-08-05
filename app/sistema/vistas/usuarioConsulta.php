<?php session_start(); ?>
<?php  if(isset($_SESSION['usuario'])){?>
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Consulta de usuarios
            <small>Usuarios del sistema</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#" id="sistema/inicio/inicio.php" class="migas-de-pan"><i class="fa fa-home"></i> Inicio</a></li>
            <li class="">Usuarios</li>
            <li id="migadepan" class="active">Consultar</li>
        </ol>
        <br>
        <?php if($_SESSION['rol']<=2){?>
        <div class="pull-right btn-group">
            <button id="sistema/vistas/usuarioRegistrar.php" class="btn btn-app migas-de-pan btn-new-usuario"><i class="fa fa-plus-circle text-teal"></i> Nuevo</button>

            <button id="sistema/vistas/usuarioConsulta.php" class="btn btn-app migas-de-pan btn-vol-usuario" disabled><i class="fa fa-reply"></i> Volver</button>
            
        </div>
        <?php }?>

        <section class="col-xs-8 col-md-9" id="info-user">
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
                        <li class="item">(
                        <i style="color: #08F;" class="fa fa-edit"></i>) Modificar datos del usuario.
                        </li><!-- /.item -->
                        <li class="item">(
                        <i style="color: #08F;" class="fa fa-trash"></i>) Eliminar de forma permanente al usuario del sistema.                    
                        </li><!-- /.item -->
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
    <section class="content" id="content-lista-usuario">
        <!-- Main row -->
        <div class="row">
            <!-- Left col -->
            <section class="col-xs-8 col-md-12">
                <!-- box -->
                <div class="box box-primary box-solid" id="box">
                    <div class="box-header with-border bg-olive">
                        <h3 class="box-title"><span class="hidden-xs">Listado de</span> Usuarios</h3>
                    </div><!-- /.box-header -->
                    <!-- box-body -->
                    <div class="box-body table-responsive" id="box-body-1">
                        <table id="tabla-usuario" class="table table-condensed table-hover">
                            <thead>
                                <tr>
                                    <th><i class="fa fa-hashtag"></i>Cedula</th>
                                    <th><i class="fa fa-crosshairs"></i>Nombre y Apellido</th>
                                    <th><i class="fa fa-street-view"></i>Perfil</th>
                                    <th><i class="fa fa-id-badge"></i>Especialidad</th>
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
    <section class="content" id="content-form-usuario" style="display: none;">
        <!-- Main row -->
        <div class="row">
            <!-- Left col -->
            <section class="col-xs-8 col-md-12">
                <!-- box -->
                <div class="box box-primary">
                    <div class="box-header with-border bg-info">
                        <h3 class="box-title">Modificar<span class="hidden-xs"> información</span>:</h3><br>
                        <span class="text-danger">(*)Campos que el usuario no puede dejar vacíos.</span>
                    </div><!-- /.box-header -->
                    <!-- box-body -->
                    <div class="box-body">
                        <!-- .box-tabpanel -->
                        <div role="tabpanel">
                            <ul class="nav nav-tabs" role="tablist">
                                <li role="presentation" class="active">
                                    <a href="#seccion-1" aria-controls="seccion-1" data-toggle="tab" role="tab"><i class="fa fa-male"></i> Datos Personales</a>
                                </li>
                                <li role="presentation">
                                    <a href="#seccion-2" aria-controls="seccion-2" data-toggle="tab" role="tab"><i class="fa fa-user"></i> Datos de Usuario</a>
                                </li>
                            </ul>
                            <!-- tab-content -->
                            <div class="tab-content">
        
                                <!-- seccion-1 -->
                                <div role="tabpanel" class="tab-pane active" id="seccion-1">
                                    <br>
                                    <form action="#" method="post" id="form-persona-mod" name="form-persona" role="form">
                                        <div class="col-xs-12 col-md-12">
                                            <div id="div-nav" class="form-group">
                                                <input type="radio" id="nac" name="nac" class="minimal" checked value="V"/>
                                                <label for="nac">Venezolano</label>
                                                
                                                <input type="radio" id="nac" name="nac" class="minimal" value="E"/>
                                                <label for="nac">Extranjero</label>
                                            </div>
                                        </div><!-- /.col-xs-12 -->

                                        <div class="col-xs-12 col-md-4">
                                            <div id="div-ced" class="form-group">
                                                <span class="text-danger">(*)</span>
                                                <label class="control-label" for="ced">Cédula:</label>
                                                <input type="text" id="ced" name="ced" class="form-control input-sm valida-numero" placeholder="00000000" required/>
                                            </div>
                                        </div><!-- /.col-xs-4 -->

                                        <div class="col-xs-12 col-md-4">
                                            <div id="div-nom" class="form-group">
                                                <span class="text-danger">(*)</span>
                                                <label class="control-label" for="nom">Nombre:</label>
                                                <input type="text" id="nom" name="nom" class="form-control input-sm valida-texto" placeholder="Su nombre" required/>
                                            </div>
                                        </div><!-- /.col-xs-4 -->

                                        <div class="col-xs-12 col-md-4">
                                            <div id="div-ape" class="form-group">
                                                <span class="text-danger">(*)</span>
                                                <label class="control-label" for="ape">Apellido:</label>
                                                <input type="text" id="ape" name="ape" class="form-control input-sm valida-texto" placeholder="Su Apellido" required/>
                                            </div>
                                        </div><!-- /.col-xs-4 -->

                                        <div class="col-xs-12 col-md-4">
                                            <div id="div-sexo" class="form-group">
                                                <label class="control-label" for="sexo">Sexo:</label>
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
                                                                                
                                        <div class="col-xs-12 col-md-4">
                                            <div id="div-tel" class="form-group">
                                                <label class="control-label" for="tel">Teléfono:</label>
                                                <div class="input-group">
                                                    <div class="input-group-addon">
                                                        <i class="fa fa-phone"></i>
                                                    </div>
                                                    <input type="text" id="tel" name="tel" class="form-control valida-telefono" data-inputmask='"mask": "(9999) 999-9999"' data-mask  title="Prefijo aceptado: (0251)"/>
                                                </div><!-- /.input group -->
                                            </div>
                                            <div id="bad-tel" style="display: none;">
                                               <span class="label label-danger">
                                                   Ejemplo: 0251 442-6852
                                               </span>
                                            </div>
                                        </div><!-- /.col-xs-4 -->

                                        <div class="col-xs-12 col-md-4">
                                            <div id="div-cel" class="form-group">
                                                <span class="text-danger">(*)</span>
                                                <label class="control-label" for="cel">Celular:</label>
                                                <div class="input-group">
                                                    <div class="input-group-addon">
                                                        <i class="fa fa-mobile"></i>
                                                    </div>
                                                    <input type="text" id="cel" name="cel" class="form-control valida-celular" data-inputmask='"mask": "(9999) 999-9999"' data-mask  title="Prefijos aceptados: (0416), (0426), (0414), (0424), (0412)" required/>
                                                </div><!-- /.input group -->
                                            </div>
                                            <div id="bad-cel" style="display: none;">
                                               <span class="label label-danger">
                                                   Ejemplo: 0424 520-7646
                                               </span>
                                            </div>
                                        </div><!-- /.col-xs-4 -->

                                        <div class="col-xs-12 col-md-4">
                                            <div id="div-correo" class="form-group">
                                                <span class="text-danger">(*)</span>
                                                <label class="control-label" for="correo">Email:</label>
                                                <div class="input-group">
                                                    <div class="input-group-addon">
                                                        <i class="fa fa-envelope"></i>
                                                    </div>
                                                    <input type="email" id="correo" name="correo" class="form-control valida-email" placeholder="ejemplo@gmail.com"  title="Debe contener '@'' y un punto (.)" required>
                                                </div><!-- /.input group -->
                                            </div>
                                            <div id="bad-email" style="display: none;">
                                               <span class="label label-danger">
                                                   Debe contener "@" y un punto (.)
                                               </span>
                                            </div>
                                        </div><!-- /.col-xs-4 -->

                                        <div class="col-xs-12">
                                            <button type="submit" id="btn-add-persona" class="btn btn-success"><i class="fa fa-save"></i> Guardar</button>
                                        </div>

                                    </form><!-- /#form-persona -->

                                </div><!-- /.seccion-1 -->
                                
                                <!-- seccion-2 -->
                                <div role="tabpanel" class="tab-pane" id="seccion-2">
                                    <br>
                                    <form action="#" method="post" id="form-usuario-mod" name="form-usuario" role="form">

                                        <div class="col-xs-12 col-md-4">
                                            <div id="div-usuario" class="form-group">
                                                <span class="text-danger">(*)</span>
                                                <label for="usuario" class="control-label">ID:</label>
                                                <input type="text" id="usuario" name="usuario" class="form-control input-sm valida-blancos" placeholder="Nombre de acceso" maxlength="15" required />
                                                <input type="hidden" id="persona" name="persona" value="">
                                                <input type="hidden" id="old" name="old" value="">
                                                <input type="hidden" id="user-1">
                                            </div>
                                        </div><!-- /.col-xs-6 -->

                                        <div class="col-xs-12 col-md-4">
                                            <div id="div-clave" class="form-group">
                                                <span class="text-danger">(*)</span>
                                                <label for="clave" class="control-label">Clave:</label>
                                                <input type="password" id="clave" name="clave" class="form-control input-sm valida-seg-clave valida-blancos" placeholder="Nueva clave de acceso" maxlength="10" required />
                                            </div>
                                        </div><!-- /.col-xs-6 -->

                                        <div class="col-xs-12 col-md-4">
                                            <div id="div-confirmar" class="form-group">
                                                <span class="text-danger">(*)</span>
                                                <label for="confirmar" class="control-label">Confirmar clave:</label>
                                                <input type="password" id="confirmar" name="confirmar" class="form-control input-sm valida-confirmacion valida-blancos" placeholder="Confimacion de clave" maxlength="10" required />
                                            </div>
                                        </div><!-- /.col-xs-6 -->

                                        <div class="col-xs-12 col-md-4">
                                            <div id="div-perfil" class="form-group">
                                                <span class="text-danger">(*)</span>
                                                <label for="perfil" class="control-label">Perfil en el sistema:</label>
                                                <select id="perfil" name="perfil" class="form-control">
                                                    <option value="">Seleccione...</option>
                                                </select>
                                                <input type="hidden" id="oldperfil" name="oldperfil" value="">
                                            </div>
                                        </div><!-- /.col-xs-4 -->

                                        <div class="col-xs-12 col-md-4">
                                            <div id="div-especialidad" class="form-group">
                                                <span class="text-danger">(*)</span>
                                                <label for="especialidad" class="control-label">Especialidad:</label>
                                                <select id="especialidad" name="especialidad" class="form-control">
                                                    <option value="">Seleccione...</option>
                                                </select>
                                            </div>
                                        </div><!-- /.col-xs-4 -->

                                        <div class="col-xs-12 col-md-4">
                                            <div id="div-estatus" class="form-group">
                                                <span class="text-danger">(*)</span>
                                                <label for="estatus" class="control-label">Estado en el sistema:</label>
                                                <select id="estatus" name="estatus" class="form-control">
                                                    <option value="">Seleccione...</option>
                                                    <option value="A">Activo</option>
                                                    <option value="I">Inactivo</option>
                                                </select>
                                            </div>
                                        </div><!-- /.col-xs-4 -->

                                        <div class="col-md-12">
                                            <button type="submit" value="Guardar" id="btn-add-usuario" class="btn btn-success"><i class="fa fa-save"></i> Guardar</button>
                                            
                                        </div>
                                        <!-- <a href="prueba.php">Link</a> -->
                                    </form>
                                </div><!-- /.seccion-2 -->  

                            </div><!-- /.tab-content --> 
                        </div><!-- /.box-tabpanel -->    
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