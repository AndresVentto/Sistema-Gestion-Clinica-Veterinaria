<?php
include ('../../app/config.php');
include ('../../admin/layout/parte1.php');
$id_usuario = $_GET['id_usuario'];
include ('../../app/controllers/usuarios/ver_datos_usuario.php');
?>
<br>
    <div class="container-fluid">
        <h3 class="mb-4"><i class="bi bi-clipboard2-data"></i> <b> Vista de datos del usuario: </b><?php echo " ". $nombre ." ". $apellido ."<b> con el rol de: </b>". $rol_usuario; ?></h3><br>
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card card-outline card-success">
                    <div class="card-header">
                        <h3 class="card-title"> <b> Datos registrados:</b></h3>
                    </div>
                    <div class="card-body">
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="">Nombre: </label>
                                <input type="text" value="<?php echo $nombre;?>" name="nombre" class="form-control border-success" disabled>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="">Apellido: </label>
                                <input type="text" value="<?php echo $apellido;?>" name="apellido" class="form-control border-success" disabled>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="">Cédula: </label>
                                <input type="number" value="<?php echo $cedula;?>" name="cedula" class="form-control border-success" disabled>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="">Correo Electrónico: </label>
                                <input type="email" value="<?php echo $correo;?>" name="correo" class="form-control border-success" disabled>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="">Rol de Usuario: </label>
                                <input type="text" value="<?php echo $rol_usuario;?>" name="rol_usuario" class="form-control border-success" disabled>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="">Fecha y Hora de Registro: </label>
                                <input type="date-time" value="<?php echo $fyh_creacion;?>" name="fyh_creacion" class="form-control border-success" disabled>
                            </div>
                        </div>
                        <hr>
                        <div class="text-right">
                            <div class="col-md-12">
                                <a href="<?php echo $URL;?>/admin/usuarios/index.php" class="btn btn-secondary" style="margin-right:10px;"><i class="bi bi-arrow-return-left"></i>  Volver</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<br>
<?php 
include ('../../admin/layout/parte2.php');
include ('../../admin/layout/alertas.php'); 
?>
