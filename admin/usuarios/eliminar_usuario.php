<?php
include ('../../app/config.php');
include ('../../admin/layout/parte1.php');
$id_usuario = $_GET['id_usuario'];
include ('../../app/controllers/usuarios/ver_datos_usuario.php');
?>
<br>
    <div class="container-fluid">
        <h3 class="mb-4"><i class="bi bi-trash3"></i> <b>Eliminar datos del usuario: </b><?php echo " ". $nombre ." ". $apellido ."<b> con el rol de: </b>". $rol_usuario ." ?"; ?></h3><br>
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card card-outline card-danger">
                    <div class="card-header">
                        <h3 class="card-title"> <b> ¿Estas seguro de que quieres eliminar a este usuario?</b></h3>
                    </div>
                    <div class="card-body">
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="">Nombre: </label>
                                <input type="text" value="<?php echo $nombre;?>" name="nombre" class="form-control border-dark" disabled>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="">Apellido: </label>
                                <input type="text" value="<?php echo $apellido;?>" name="apellido" class="form-control border-dark" disabled>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="">Cédula: </label>
                                <input type="number" value="<?php echo $cedula;?>" name="cedula" class="form-control border-dark" disabled>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="">Correo Electrónico: </label>
                                <input type="email" value="<?php echo $correo;?>" name="correo" class="form-control border-dark" disabled>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="">Rol de Usuario: </label>
                                <input type="text" value="<?php echo $rol_usuario;?>" name="rol_usuario" class="form-control border-dark" disabled>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="">Registrado desde: </label>
                                <input type="date-time" value="<?php echo $fyh_creacion;?>" name="fyh_creacion" class="form-control border-dark" disabled>
                            </div>
                        </div>
                        <hr>
                        <div class="text-right">
                            <div class="col-md-12">
                                <form action="<?php echo $URL?>/app/controllers/usuarios/eliminar_usuario.php" method="post" id="formEliminar">
                                    <input type="hidden" name="id_usuario" value="<?php echo $id_usuario; ?>">
                                    <a href="<?php echo $URL;?>/admin/usuarios/index.php" class="btn btn-secondary" style="margin-right:10px;"><i class="fas fa-ban"></i> Cancelar</a>
                                    <button type="button" class="btn btn-danger" id="btnEliminarUsuario"><i class="bi bi-trash3"></i> Eliminar Usuario</button>
                                </form>
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
