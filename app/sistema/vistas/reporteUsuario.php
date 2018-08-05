<?php session_start(); ?>
<?php  if(isset($_SESSION['usuario'])){?>
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Reporte de usuarios
            <small></small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#" id="sistema/inicio/inicio.php" class="migas-de-pan"><i class="fa fa-home"></i> Inicio</a></li>
            <li class="">Reporte</li>
            <li id="migadepan" class="active">Usuarios</li>
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
    <section class="content" id="content-reporte-usuario">
        <!-- Main row -->
        <div class="row">

            <div class="col-sx-6 text-center">
                <input type="radio" name="usu" value="1" checked><label for="todos">Todos</label>
                <input type="radio" name="usu" value="2"><label for="manager">Manager</label>
                <input type="radio" name="usu" value="3"><label for="administrador">Administrador</label>
                <input type="radio" name="usu" value="4"><label for="participante">Staff</label><br><br>
            </div>
            <!-- Left col -->
            <section id="usuario-todos" class="col-xs-8 col-md-12">
                <!-- box -->
                <div class="box box-primary box-solid" id="box">
                    <div class="box-header with-border bg-red">
                        <h3 class="box-title"><span class="hidden-xs">Listado de</span> Usuarios</h3>
                    </div><!-- /.box-header -->
                    <!-- box-body -->
                    <div class="box-body table-responsive" id="box-body-1">

                         <table id="tabla-reporte-usuario-t" class="table table-condensed table-hover">
                            <thead>
                                <tr>
                                    <th>Cedula</th>
                                    <th>Nombre y Apellido</th>
                                    <th>Perfil</th>
                                    <th>Correo</th>
                                    <th>Celular</th>
                                    <th>ID</th>
                                    <th>Estatus</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>   
                    </div><!-- /.box-body -->
                </div> <!-- /.box -->  
            </section><!-- /.Left col -->

            <section id="usuario-manager" class="col-xs-8 col-md-12" style="display: none;">
                <!-- box -->
                <div class="box box-primary box-solid" id="box">
                    <div class="box-header with-border bg-red">
                        <h3 class="box-title"><span class="hidden-xs">Listado de</span> Usuarios</h3>
                    </div><!-- /.box-header -->
                    <!-- box-body -->
                    <div class="box-body table-responsive" id="box-body-1">

                         <table id="tabla-reporte-usuario-m" class="table table-condensed table-hover">
                            <thead>
                                <tr>
                                    <th>Cedula</th>
                                    <th>Nombre y Apellido</th>
                                    <th>Perfil</th>
                                    <th>Correo</th>
                                    <th>Celular</th>
                                    <th>ID</th>
                                    <th>Estatus</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>   
                    </div><!-- /.box-body -->
                </div> <!-- /.box -->  
            </section><!-- /.Left col -->

            <section id="usuario-administrador" class="col-xs-8 col-md-12" style="display: none;">
                <!-- box -->
                <div class="box box-primary box-solid" id="box">
                    <div class="box-header with-border bg-red">
                        <h3 class="box-title"><span class="hidden-xs">Listado de</span> Usuarios</h3>
                    </div><!-- /.box-header -->
                    <!-- box-body -->
                    <div class="box-body table-responsive" id="box-body-1">

                         <table id="tabla-reporte-usuario-a" class="table table-condensed table-hover">
                            <thead>
                                <tr>
                                    <th>Cedula</th>
                                    <th>Nombre y Apellido</th>
                                    <th>Perfil</th>
                                    <th>Correo</th>
                                    <th>Celular</th>
                                    <th>ID</th>
                                    <th>Estatus</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>   
                    </div><!-- /.box-body -->
                </div> <!-- /.box -->  
            </section><!-- /.Left col -->

            <section id="usuario-participante" class="col-xs-8 col-md-12" style="display: none;">
                <!-- box -->
                <div class="box box-primary box-solid" id="box">
                    <div class="box-header with-border bg-red">
                        <h3 class="box-title"><span class="hidden-xs">Listado de</span> Usuarios</h3>
                    </div><!-- /.box-header -->
                    <!-- box-body -->
                    <div class="box-body table-responsive" id="box-body-1">

                         <table id="tabla-reporte-usuario-p" class="table table-condensed table-hover">
                            <thead>
                                <tr>
                                    <th>Cedula</th>
                                    <th>Nombre y Apellido</th>
                                    <th>Perfil</th>
                                    <th>Correo</th>
                                    <th>Celular</th>
                                    <th>ID</th>
                                    <th>Estatus</th>
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


<?php }; ?>
<!-- validador.js -->
<script src="sistema/controladores/validador.js" type="text/javascript"></script>
<script src="sistema/controladores/usuario.js" type="text/javascript"></script>
<script src="sistema/controladores/persona.js" type="text/javascript"></script>
<script src="sistema/controladores/reporteUsuario.js" type="text/javascript"></script>