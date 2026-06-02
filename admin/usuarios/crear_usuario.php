<?php
include ('../../app/config.php');
include ('../../admin/layout/parte1.php');
?>
<br>
<div class="container-fluid">
    <h2 class="mb-4"><i class="fas fa-user-plus"></i> <b>Registrar un nuevo usuario:</b> </h2>
    <div class="row justify-content-center">
        <div class="col-md-8"> <!-- Ancho medio centrado -->
            <div class="card card-outline card-success">
                <div class="card-header">
                    <h3 class="card-title"><b>Ingresa los Datos del Usuario:</b></h3>
                </div>
                <div class="card-body">
                    <form action="../../app/controllers/usuarios/crear_usuario.php" method="post">
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="">Nombre: <b>*</b></label>
                                <input type="text" name="nombre" class="form-control border-success" require>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="">Apellido:<b>*</b></label>
                                <input type="text" name="apellido" class="form-control border-success" require>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="">Cédula:<b>*</b></label>
                               <input type="number" name="cedula" class="form-control border-success" min="0" onkeydown="return !['e', 'E', '+', '-', '.'].includes(event.key)" oninput="this.value = this.value.replace(/[^0-9]/g, '')" onpaste="return false"/>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="">Correo Electrónico:<b>*</b></label>
                                <input type="email" name="correo" class="form-control border-success" require>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="">Contraseña:<b>*</b></label>
                                <div class="input-group">
                                    <input type="password" id="password" name="contrasenna" class="form-control border-success" require>
                                    <div class="input-group-append">
                                        <span class="input-group-text form-control border-success" onclick="togglePassword('password', this)" style="cursor:pointer; color:#469255;">
                                            <i class="fas fa-eye"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="">Verifica la contraseña:<b>*</b></label>
                                <div class="input-group">
                                    <input type="password" id="password2" name="contrasenna_repetida" class="form-control border-success" require>
                                    <div class="input-group-append">
                                        <span class="input-group-text form-control border-success" onclick="togglePassword('password2', this)" style="cursor:pointer; color:#469255; ">
                                            <i class="fas fa-eye" ></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="">Rol de Usuario:</label>
                            <select name="rol_usuario" class="form-control border-success">
                                <option value="CLIENTE">CLIENTE</option>
                                <option value="RECEPCIÓN">RECEPCIÓN</option>
                                <option value="VETERINARIO">VETERINARIO</option>
                                <option value="ADMINISTRADOR">ADMINISTRADOR</option>
                            </select>
                        </div>
                        <hr>
                        <div class="text-right">
                            <div class="col-md-12">
                                <a href="<?php echo $URL;?>/admin/usuarios/index.php" class="btn btn-secondary" style="margin-right:10px;"><i class="fas fa-ban"> </i>  Cancelar</a>
                                <button type="submit" class="btn btn-success" style="background-color:#469255;">
                                    <i class="fas fa-user-plus"></i>  Registrar Usuario
                                </button>
                            </div>
                        </div>
                    </form>
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
