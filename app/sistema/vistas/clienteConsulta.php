<?php session_start(); ?>
<?php  if(isset($_SESSION['usuario'])){?>
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Consulta de clientes
            <small>Clientes del sistema</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#" id="sistema/inicio/inicio.php" class="migas-de-pan"><i class="fa fa-home"></i> Inicio</a></li>
            <li class="">Clientes</li>
            <li id="migadepan" class="active">Consultar</li>
        </ol>
        <br>
        <?php if($_SESSION['rol']<=2){?>
        <div class="pull-right btn-group">
            <button id="sistema/vistas/clienteRegistrar.php" class="btn btn-app migas-de-pan btn-new-cliente"><i class="fa fa-plus-circle text-teal"></i> Nuevo</button>

            <button id="sistema/vistas/clienteConsulta.php" class="btn btn-app migas-de-pan btn-vol-cliente" disabled><i class="fa fa-reply"></i> Volver</button>
        </div>
        <?php }?>

        <?php if($_SESSION['rol']<=2){ ?>

        <section class="col-xs-8 col-md-9" id="info-client">
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
                        <i style="color: #08F;" class="fa fa-edit"></i>) Modificar datos del cliente.
                        </li><!-- /.item -->
                        <li class="item">(
                        <i style="color: #08F;" class="fa fa-trash"></i>) Eliminar de forma permanente al cliente del sistema.                    
                        </li><!-- /.item -->
                    </ul>
                </div><!-- /.box-body -->
            </div><!-- /.box -->                                   
        </section><!-- right col -->

        <?php } ?>

        <div class="row">
            <div class="col-xs-12 col-md-12">
                <div id="msg-box" style="display: none;"></div>
            </div>
        </div>
        <input type="hidden" id="perfil-acceso" name="perfil-acceso" value="<?php echo $_SESSION['rol']?>">
        <input type="hidden" id="persona-acceso" name="persona-acceso" value="<?php echo $_SESSION['persona']?>">
    </section>



    <!-- Main content -->
    <section class="content" id="content-cliente">
        <!-- Main row -->
        <div class="row">
            <!-- Left col -->
            <section class="col-xs-12 col-md-12">
                <!-- box -->
                <div class="box box-primary">
                    <div class="box-header with-border bg-info" id="tittle-mod" style="display: none;">
                        <h3 class="box-title">Modificar <span class="hidden-xs">información</span>:</h3><br>
                        <span class="text-danger">(*)Campos que el usuario no puede dejar vacíos.</span>
                    </div><!-- /.box-header -->

                    <!-- box-body -->
                    <div class="box-body">

                        <!-- <div class="col-sx-12 text-center" id="ask-tipocli">
                            <h3 class="box-title">¿Que tipo de cliente<span class="hidden-xs"> desea consultar</span>?</h3><br>
                            <input type="radio" name="consulta" value="1" checked><label for="nac">Natural</label>
                            <input type="radio" name="consulta" value="2"><label for="jur">Juridico</label>
                        </div> -->

                        <section class="col-md-12 text-center" id="ask-tipocli">
                            <div class="callout callout-warning">
                                <h4>¿Que tipo de cliente desea consultar?</h4>
                                <input type="radio" name="consulta" value="1" checked><label for="nac"><i class="fa fa-male"></i> Natural</label>
                                <input type="radio" name="consulta" value="2"><label for="jur"><i class="fa fa-institution"></i> Juridíco</label>
                            </div>
                        </section>


                        <!-- seccion-natural -->
                        <div id="seccion-natural">
                            <!-- Main content -->
                            <section class="content" id="content-lista-natural">
                                <!-- Main row -->
                                <div class="row">
                                    <!-- Left col -->
                                    <section class="col-xs-8 col-md-12">
                                        <!-- box -->
                                        <div class="box box-primary box-solid" id="box">
                                            <div class="box-header with-border bg-olive">
                                                <h3 class="box-title"><span class="hidden-xs">Listado de</span> Clientes (Naturales)</h3>
                                            </div><!-- /.box-header -->
                                            <!-- box-body -->
                                            <div class="box-body table-responsive" id="box-body-1">
                                                <table id="tabla-natural" class="table table-condensed table-hover">
                                                    <thead>
                                                        <tr>
                                                            <th><i class="fa fa-hashtag"></i>Cédula</th>
                                                            <th><i class="fa fa-crosshairs"></i>Nombre y Apellido</th>
                                                            <th><i class="fa fa-address-book"></i>Celular</th>
                                                            <th><i class="fa fa-at"></i>Correo</th>
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
                            <section class="content" id="content-form-natural-mod" style="display: none;">
                                <form action="#" method="post" id="form-natural-mod" name="form-natural-mod" role="form">
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
                                        <div id="div-rif" class="form-group">
                                            <label class="control-label" for="rif">RIF:</label>
                                            <input type="text" id="rif" name="rif" class="form-control input-sm valida-numero" placeholder="00000000" />
                                        </div>
                                    </div><!-- /.col-xs-4 -->

                                    <div class="col-xs-12 col-md-6">
                                        <div id="div-nom" class="form-group">
                                            <span class="text-danger">(*)</span>
                                            <label class="control-label" for="nom">Nombre:</label>
                                            <input type="text" id="nom" name="nom" class="form-control input-sm valida-texto" placeholder="Su nombre" required/>
                                        </div>
                                    </div><!-- /.col-xs-4 -->

                                    <div class="col-xs-12 col-md-6">
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
                                            <label class="control-label" for="dir">Direccion:</label>
                                            <textarea class="form-control input-sm valida-charesp" id="dir" name="dir" rows="3" placeholder="Su direccion"></textarea>
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
                                        <button type="submit" id="btn-add-natural" class="btn btn-success"><i class="fa fa-save"></i> Guardar</button>
                                    </div>

                                </form><!-- /#form-natural -->
                            </section><!-- /.content main-->
                        </div><!-- /.seccion-natural -->

                        
                        <!-- seccion-juridico -->
                        <div id="seccion-juridico" style="display: none;">

                            <!-- Main content -->
                            <section class="content" id="content-lista-juridico">
                                <!-- Main row -->
                                    <div class="row">
                                        <!-- Left col -->
                                        <section class="col-xs-8 col-md-12">
                                            <!-- box -->
                                            <div class="box box-primary box-solid" id="box">
                                                <div class="box-header with-border bg-olive">
                                                    <h3 class="box-title"><span class="hidden-xs">Listado de</span> Clientes (Juridicos)</h3>
                                                </div><!-- /.box-header -->
                                                <!-- box-body -->
                                                <div class="box-body table-responsive" id="box-body-1">
                                                    <table id="tabla-juridico" class="table table-condensed table-hover">
                                                        <thead>
                                                            <tr>
                                                                <th><i class="fa fa-hashtag"></i>RIF</th>
                                                                <th><i class="fa fa-institution"></i>Institucion</th>
                                                                <th><i class="fa fa-address-book"></i>Telefono</th>
                                                                <th><i class="fa fa-crosshairs"></i>Nombre y Apellido (Contacto)</th>
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
                                <section class="content" id="content-form-juridico-mod" style="display: none;">
                                    <form action="#" method="post" id="form-juridico-mod" name="form-juridico-mod" role="form">

                                        <div class="col-xs-12 col-md-12">
                                            <div id="div-nacJ" class="form-group">
                                                <input type="radio" id="nacJ" name="nacJ" class="minimal" checked value="V"/>
                                                <label for="nacJ">Venezolano</label>
                                                
                                                <input type="radio" id="nacJ" name="nacJ" class="minimal" value="E"/>
                                                <label for="nacJ">Extranjero</label>
                                            </div>
                                        </div><!-- /.col-xs-12 -->

                                        <div class="col-xs-12 col-md-4">
                                            <div id="div-rif" class="form-group">
                                                <label class="control-label" for="rifJ">RIF/Cedula:</label>
                                                <input type="text" id="rifJ" name="rifJ" class="form-control input-sm valida-numero" placeholder="00000000" required />
                                            </div>
                                        </div><!-- /.col-xs-4 -->

                                        <div class="col-xs-12 col-md-6">
                                            <div id="div-nom" class="form-group">
                                                <label class="control-label" for="nomJ">Nombre de la institucion:</label>
                                                <input type="text" id="nomJ" name="nomJ" class="form-control input-sm valida-texto" placeholder="Institucion" required/>
                                            </div>
                                        </div><!-- /.col-xs-4 -->

                                        <div class="col-xs-12 col-md-12">
                                            <div id="div-ubi" class="form-group">
                                                <label class="control-label" for="ubi">Ubicacion:</label>
                                                <textarea class="form-control input-sm valida-charesp" id="ubi" name="ubi" rows="3" placeholder="Ubicacion" required></textarea>
                                            </div>
                                        </div><!-- /.col-xs-12 -->

                                        <div class="col-xs-12 col-md-4">
                                            <div id="div-telJ" class="form-group">
                                                <label class="control-label" for="telJ">Teléfono:</label>
                                                <div class="input-group">
                                                    <div class="input-group-addon">
                                                        <i class="fa fa-phone"></i>
                                                    </div>
                                                    <input type="text" id="telJ" name="telJ" class="form-control valida-telefono" data-inputmask='"mask": "(9999) 999-9999"' data-mask  title="Prefijo aceptado: (0251)" required />
                                                </div><!-- /.input group -->
                                            </div>
                                        </div><!-- /.col-xs-4 -->

                                        <div class="col-xs-12 col-md-4">
                                            <div id="div-correoJ" class="form-group">
                                                <label class="control-label" for="correoJ">Email:</label>
                                                <div class="input-group">
                                                    <div class="input-group-addon">
                                                        <i class="fa fa-envelope"></i>
                                                    </div>
                                                    <input type="email" id="correoJ" name="correoJ" class="form-control valida-email" placeholder="ejemplo@gmail.com"  title="Debe contener '@'' y un punto (.)" required>
                                                </div><!-- /.input group -->
                                            </div>
                                            <div id="bad-email" style="display: none;">
                                               <span class="label label-danger">
                                                   Debe contener "@" y un punto (.)
                                               </span>
                                            </div><br>
                                        </div><!-- /.col-xs-4 -->

                                        <div class="text-center col-xs-12 col-md-12">
                                            <div id="div-contact">
                                                <label for="control-label"><u>Persona de contacto legal</u></label>
                                            </div>
                                        </div>

                                        <div class="col-xs-12 col-md-12">
                                            <div id="div-nacP" class="form-group">
                                                <input type="radio" id="nacP" name="nacP" class="minimal" checked value="V"/>
                                                <label for="nacP">Venezolano</label>
                                                
                                                <input type="radio" id="nacP" name="nacP" class="minimal" value="E"/>
                                                <label for="nacP">Extranjero</label>
                                            </div>
                                        </div><!-- /.col-xs-12 -->

                                        <div class="col-xs-12 col-md-4">
                                            <div id="div-cedP" class="form-group">
                                                <label class="control-label" for="rifJ">Cedula:</label>
                                                <input type="text" id="cedP" name="cedP" class="form-control input-sm valida-numero" placeholder="00000000" required />
                                            </div>
                                        </div><!-- /.col-xs-4 -->

                                        <div class="col-xs-12 col-md-4">
                                            <div id="div-nomP" class="form-group">
                                                <label class="control-label" for="nomP">Nombre:</label>
                                                <input type="text" id="nomP" name="nomP" class="form-control input-sm valida-texto" placeholder="Su nombre" required/>
                                            </div>
                                        </div><!-- /.col-xs-4 -->

                                        <div class="col-xs-12 col-md-4">
                                            <div id="div-apeP" class="form-group">
                                                <label class="control-label" for="apeP">Apellido:</label>
                                                <input type="text" id="apeP" name="apeP" class="form-control input-sm valida-texto" placeholder="Su apellido" required/>
                                            </div>
                                        </div><!-- /.col-xs-4 -->

                                        <div class="col-xs-12 col-md-4">
                                            <div id="div-sexoP" class="form-group">
                                                <label class="control-label" for="sexoP">Sexo:</label>
                                                <select id="sexoP" name="sexoP" class="form-control">
                                                    <option>Seleccione...</option>
                                                    <option value="M">Masculino</option>
                                                    <option value="F">Femenino</option>
                                                </select>
                                            </div>
                                        </div><!-- /.col-xs-4 -->
                                        
                                        <div class="col-xs-12 col-md-12">
                                            <div id="div-civilP" class="form-group">
                                                <input type="radio" id="civilP" name="civilP" class="minimal" checked value="S"/>
                                                <label for="civilP">Soltero</label>

                                                <input type="radio" id="civilP" name="civilP" class="minimal" value="C"/>
                                                <label for="civilP">Casado</label>

                                                <input type="radio" id="civilP" name="civilP" class="minimal" value="V"/>
                                                <label for="civilP">Viudo</label>

                                                <input type="radio" id="civilP" name="civilP" class="minimal" value="D"/>
                                                <label for="civilP">Divorciado</label>
                                            </div>
                                        </div><!-- /.col-xs-4 -->

                                        <div class="col-xs-12 col-md-4">
                                            <div id="div-celP" class="form-group">
                                                <label class="control-label" for="celP">Celular:</label>
                                                <div class="input-group">
                                                    <div class="input-group-addon">
                                                        <i class="fa fa-mobile"></i>
                                                    </div>
                                                    <input type="text" id="celP" name="celP" class="form-control valida-celular" data-inputmask='"mask": "(9999) 999-9999"' data-mask  title="Prefijos aceptados: (0416), (0426), (0414), (0424), (0412)" required/>
                                                </div><!-- /.input group -->
                                            </div>
                                        </div><!-- /.col-xs-4 -->

                                        <div class="col-xs-12 col-md-4">
                                            <div id="div-correoP" class="form-group">
                                                <label class="control-label" for="correoP">Email:</label>
                                                <div class="input-group">
                                                    <div class="input-group-addon">
                                                        <i class="fa fa-envelope"></i>
                                                    </div>
                                                    <input type="email" id="correoP" name="correoP" class="form-control valida-email" placeholder="ejemplo@gmail.com"  title="Debe contener '@'' y un punto (.)" required>
                                                </div><!-- /.input group -->
                                            </div><br>
                                        </div><!-- /.col-xs-4 -->

                                        <div class="col-md-12">
                                            <button type="submit" value="Guardar" id="btn-add-juridico" class="btn btn-success"><i class="fa fa-save"></i> Guardar</button>
                                        </div>
                                    </form>
                                </section><!-- /.content main-->
                            </section><!-- /.content main-->
                        </div><!-- /.seccion-juridico -->
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
<script src="sistema/controladores/cliente.js" type="text/javascript"></script>