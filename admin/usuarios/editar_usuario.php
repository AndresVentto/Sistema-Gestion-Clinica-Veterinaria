<?php
include ('../../app/config.php');
include ('../../admin/layout/parte1.php');
$id_usuario = $_GET['id_usuario'];
include ('../../app/controllers/usuarios/ver_datos_usuario.php');
?>
<br>
<div class="container-fluid">
    <h2 class="mb-4"><i class="bi bi-pencil-square" style="color:#ffc107; "></i> <b>Actualizar al usuario:</b> <?php echo " ". $nombre. " " . $apellido;?></h2><br>
    <div class="row justify-content-center">
        <div class="col-md-8"> <!-- Ancho medio centrado -->
            <div class="card card-outline card-warning">
                <div class="card-header">
                    <h3 class="card-title"><b>Ingresa los Datos del Usuario:</b></h3>
                </div>
                <div class="card-body">
                    <form action="../../app/controllers/usuarios/editar_usuario.php" method="post">
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="">Nombre: </label>
                                <input type="text" value="<?php echo $nombre;?>" name="nombre" class="form-control border-dark" require>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="">Apellido:</label>
                                <input type="text" value="<?php echo $apellido;?>" name="apellido" class="form-control border-dark" require>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="">Cédula:</label>
                               <input type="number" value="<?php echo $cedula;?>" name="cedula" class="form-control border-dark" min="0" onkeydown="return !['e', 'E', '+', '-', '.'].includes(event.key)" oninput="this.value = this.value.replace(/[^0-9]/g, '')" onpaste="return false"/>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="">Correo Electrónico:</label>
                                <input type="email" value="<?php echo $correo;?>" name="correo" class="form-control border-dark" disabled>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="">Contraseña:</label>
                                <div class="input-group">
                                    <input type="password" id="password" name="contrasenna" class="form-control border-dark">
                                    <div class="input-group-append">
                                        <span class="input-group-text form-control border-dark" onclick="togglePassword('password', this)" style="cursor:pointer; color:#469255;">
                                            <i class="fas fa-eye"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="">Verifica la contraseña:</label>
                                <div class="input-group">
                                    <input type="password" id="password2" name="contrasenna_repetida" class="form-control border-dark">
                                    <div class="input-group-append">
                                        <span class="input-group-text form-control border-dark" onclick="togglePassword('password2', this)" style="cursor:pointer; color:#469255; ">
                                            <i class="fas fa-eye" ></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="">Rol de Usuario:</label>
                            <select name="rol_usuario" class="form-control border-dark" required>
                                <?php
                                $roles = ["CLIENTE", "RECEPCIÓN", "VETERINARIO", "ADMINISTRADOR"];
                                foreach ($roles as $rol) {
                                    $selected = ($rol_usuario == $rol) ? "selected" : "";
                                    echo "<option value='$rol' $selected>$rol</option>";
                                }
                                ?>
                            </select>
                        </div>
                        <input type="text" name="id_usuario" value="<?php echo $id_usuario; ?>" hidden>

                        <hr>
                        <div class="text-right">
                            <div class="col-md-12">
                                <a href="<?php echo $URL;?>/admin/usuarios/index.php" class="btn btn-secondary" style="margin-right:10px;"><i class="fas fa-ban"> </i>  Cancelar</a>
                                <button type="submit" class="btn btn-warning" >
                                    <i class="fas fa-user-plus"></i> Actualizar Datos
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<br><br>
<?php 
include ('../../admin/layout/parte2.php');
include ('../../admin/layout/alertas.php'); 
?>
