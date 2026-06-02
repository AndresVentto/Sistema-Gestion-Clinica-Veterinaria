<h1>Pruebas de encriptación:</h1>
<br>

<?php

echo $contrasenna = "12345678";

echo md5($contrasenna) . "<br>";
echo sha1($contrasenna) . "<br>" ;
echo password_hash($contrasenna, PASSWORD_DEFAULT);

$hash = '$2y$10$PGSWDejJlZVv8qnWQfCcRukkYarz2IrgknuH3D4MgkemxkduBiDP2';

if (password_verify($contrasenna, $hash)) {
    echo 'La contraseña es CORRECTA!';
} else {
    echo 'La contraseña es INCORRECTA!';
}