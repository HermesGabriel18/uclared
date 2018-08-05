<?php session_start(); ?>
<?php  if(isset($_SESSION['usuario'])){?>
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Registrar proyecto
            <small>Registro de proyectos al sistema</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#" id="sistema/inicio/inicio.php" class="migas-de-pan"><i class="fa fa-home"></i> Inicio</a></li>
            <li class="">Proyectos</li>
            <li id="migadepan" class="active">Registrar</li>
        </ol>
        <br>

        <section class="col-md-12" id="advice-project">
            <div class="box box-danger box-solid">
                <div class="box-header with-border bg-red">
                    <h3 class="box-title">Consejos a la hora de crear proyectos:</h3>
                    <div class="box-tools pull-right">
                        <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                        <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                    </div>
                </div><!-- /.box-header -->
                <div class="box-body">
                    <ul class="products-list product-list-in-box">
                        <li class="item"><strong>*Para crear el código:</strong></li><!-- /.item -->
                        <p>1- Empezar con la letra S.</p>
                        <p>2- Tomar en cuenta los servicios a incluir (ejemplo): <br>
                        Si se incluirá el servicio 1 y 4 al proyecto, un código conveniente sería "S0104" (Sin las comillas).</p>
                        <li class="item"><strong>*Tener en cuenta la duración estimada de cada servicio al momento de registrar las fechas de inicio y fin del proyecto.</strong></li><!-- /.item -->
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
    <section class="content" id="content-form-proyecto">
        <!-- Main row -->
        <div class="row">
            <!-- Left col -->
            <section class="col-xs-12 col-md-12">
                <!-- box -->
                <div class="box box-primary">
                    <div class="box-header with-border bg-info">
                        <h3 class="box-title">Llenar<span class="hidden-xs"> campos</span>:</h3><br>
                        <span class="text-danger">(*)Campos obligatorios</span>
                    </div><!-- /.box-header -->
                    <!-- box-body -->
                    <div class="box-body">

                        <section class="col-xs-12">
                            <form action="#" method="post" id="form-proyecto" name="form-proyecto" role="form">

                                

                                <div id="div-codigo">

                                    <div class="col-xs-12 col-md-4">
                                        <h4 class="box-title"><span class="hidden-xs">Crear </span>Codigo:</h4>
                                        <input type="text" class="form-control" name="codigo" placeholder="S0000" required value="S####"><hr>
                                    </div>
                                </div>

                                <div id="fecha">
                                    <div class="col-xs-12 col-md-4">
                                        <h4 class="box-title">Fecha de inicio:</h4>
                                        <input type="date" name="inicio" id="inicio" class="form-control" required><hr>
                                    </div>
                                    <div class="col-xs-12 col-md-4">
                                        <h4 class="box-title">Fecha fin:</h4>
                                        <input type="date" name="fin" id="fin" class="form-control" required><hr>
                                    </div>
                                </div>
                                

                
                                
                                <!-- <div class="row">
                                    <div class="col-xs-12 col-md-12">
                                         <div id="msg-jefe" style="display: none;"></div>
                                    </div>
                                </div> -->

                                

                                <div class="col-md-12" id="div-responsable">
                                    <h4 class="box-title"><span class="hidden-xs">Elija el </span>Jefe de proyecto:</h4>          
        
                                    <!-- <div class="col-xs-12 col-md-4">
                                        <div id="div-ced" class="form-group">
                                            <input type="text" class="form-control find-usuario" id="fpersona" placeholder="Introduzca una cedula" maxlength="8">
                                            <input type="hidden" id="fpersona2" name="resp">
                                        </div>
                                    </div> -->

                                    <div class="col-xs-12 col-md-6">
                                        <div id="div-jefe" class="form-group">
                                            <label for="jefe" id="lbljefe">Nombre y apellido:</label>
                                            <select id="jefe" name="resp" class="form-control">
                                                <option value="">Seleccione...</option>
                                            </select><hr>
                                        </div>
                                    </div><!-- /.col-xs-4 -->

                                    <!-- <div class="col-xs-12 col-md-8">
                                        <div id="botones" class="form-group">
                                            <button type="submit" id="btn-add-res" class="btn btn-success"><i class="fa fa-check"></i> Aceptar</button>
                            
                                            <button type="button" id="btn-can-res" class="btn btn-default"><i class="fa fa-ban"></i> Cancelar</button>  
                                        </div>
                                    
                                    </div>
                                
                                    <div class="col-xs-12 col-md-4">
                                        <div id="div-nombre" class="form-group">
                                            <input type="text" class="form-control" id="found-name" placeholder="Nombre" disabled>
                                            <span class="hidden-xs"><hr></span>
                                        </div> 
                                    </div>

                                    <div class="col-xs-12 col-md-4">
                                        <div id="div-apellido" class="form-group">
                                            <input type="text" class="form-control" id="found-last" placeholder="Apellido" disabled>
                                        </div> 
                                    </div>

                                    <div class="col-xs-12 col-md-4">
                                        <div id="div-perfil" class="form-group">
                                        <input type="text" class="form-control" id="found-rol" placeholder="Especialidad" disabled>
                                        </div><br><br>
                                    </div> -->

                                </div><!-- /#responsable -->

                                <div class="col-md-12" id="cliente">
                                    <h4 class="box-title"><span class="hidden-xs">Elija un </span>Cliente para el proyecto:</h4> 

                                    <div class="col-sx-12 col-md-12 text-center">
                                        <input type="radio" name="tipocliente" value="1" checked><label for="nac">Natural</label>
                                        <input type="radio" name="tipocliente" value="2"><label for="jur">Juridico</label>
                                    </div>


                                    <div class="col-xs-12 col-md-6">
                                        <div id="div-clip" class="form-group">
                                            <label for="clip" id="lblclip">Nombre y apellido:</label>
                                            <select id="clip" name="cliente" class="form-control">
                                                <option value="">Seleccione...</option>
                                            </select><hr>
                                        </div>

                                    </div><!-- /.col-xs-4 -->

                                   <!--  <div class="col-md-12">
                                       <h4 class="box-title"><span class="hidden-xs">Elija un</span> Cliente<span class="hidden-xs"> para el proyecto</span>:</h4> 
                                    </div>
                                    

                                    <div class="col-sx-12 col-md-12 text-center">
                                        <input type="radio" name="tipocliente" value="1" checked><label for="nac">Natural</label>
                                        <input type="radio" name="tipocliente" value="2"><label for="jur">Juridico</label>
                                    </div>

                                    <div class="row">
                                        <div class="col-xs-12 col-md-12">
                                            <div id="msg-cli" style="display: none;"></div>
                                        </div>
                                    </div>
                                    
                                    <label for="fcli" id="lblcli">Cedula:</label>

                                    <div id="find-cli">
                                        
                                        <div class="col-xs-12 col-md-4">
                                            <div id="div-rif" class="form-group">
                                                <input type="text" class="form-control find-cli" id="fcli" placeholder="Introduzca una cedula" maxlength="8">
                                                <input type="hidden" id="fcli2" name="cliente">
                                            </div>
                                        </div>

                                        <div class="col-xs-12 col-md-8">
                                            <div id="botones" class="form-group">
                                                <button type="submit" id="btn-add-cli" class="btn btn-success"><i class="fa fa-check"></i> Aceptar</button>
                            
                                                <button type="button" id="btn-can-cli" class="btn btn-default"><i class="fa fa-ban"></i> Cancelar</button>  
                                            </div>
                                        </div>

                                        <div class="col-xs-12 col-md-4">
                                            <div id="div-nombre" class="form-group">
                                                <input type="text" class="form-control" id="found-namecn" placeholder="Nombre" disabled>
                                                <span class="hidden-xs"><hr></span>
                                            </div> 
                                        </div>

                                        <div class="col-xs-12 col-md-4">
                                            <div id="div-apellido" class="form-group">
                                                <input type="text" class="form-control" id="found-lastcn" placeholder="Apellido" disabled>
                                            </div> 
                                        </div>

                                        <div class="col-xs-12 col-md-4">
                                            <div id="div-correo" class="form-group">
                                                <input type="text" class="form-control" id="found-mailcn" placeholder="Correo" disabled>
                                            </div><br><br>
                                        </div>

                                    </div><hr> --><!-- /find-cli -->

                                </div><!-- /#cliente -->

                                <div id="servicios">

                                    <h4 class="box-title"><span class="hidden-xs">Elija los</span> Servicios<span class="hidden-xs"> para el proyecto</span>:</h4>

                                    <div class="box-body table-responsive" id="box-body-1">

                                        <table id="tabla-servicio-p" class="table table-condensed table-hover">
                                            <thead>
                                                <tr>
                                                    <th>Nro.</th>
                                                    <th>Descripcion</th>
                                                    <th>Presupuesto(BsS)</th>
                                                    <th>Duración estimada(días)</th>
                                                    <th></th>
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

                                        <table id="tabla-usuario-p" class="table table-condensed table-hover">
                                            <thead>
                                                <tr>
                                                    <th>Cedula</th>
                                                    <th>Nombre y Apellido</th>
                                                    <th>Especialidad</th>
                                                    <th>Estado</th>
                                                    <th></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            </tbody>
                                        </table><hr>
                                    </div><!-- /.box-body -->
                                </div><!-- /#servicios -->

                                <div class="col-xs-12">
                                    <input type="hidden" name="funcion" value="add">
                                    <button type="submit" id="btn-add-proyecto" class="btn btn-success"><i class="fa fa-save"></i> Guardar</button>
                            
                                    <button type="button" id="btn-can-proyecto" class="btn btn-default"><i class="fa fa-ban"></i> Cancelar</button>
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
    
<?php }; ?>
<!-- validador.js -->
<script src="sistema/controladores/validador.js" type="text/javascript"></script>
<script src="sistema/controladores/usuario.js" type="text/javascript"></script>
<script src="sistema/controladores/persona.js" type="text/javascript"></script>
<script src="sistema/controladores/cliente.js" type="text/javascript"></script>
<script src="sistema/controladores/servicio.js" type="text/javascript"></script>
<script src="sistema/controladores/proyecto.js" type="text/javascript"></script>