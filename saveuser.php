<?php

include("conexion.php");

$idfrac = $_POST['idfrac'];
$nombre1 = $_POST['nombre1'];
$nombre2 = $_POST['nombre2'];
$apellidop = $_POST['apellidop'];
$apellidom = $_POST['apellidom'];
$correo = $_POST['correo'];
$password = $_POST['password'];
$casa = $_POST['casa'];
$token = $_POST['token'];

//inserto el nuevo usuario 
$nuevoUsuario = "INSERT INTO usuarios (idfrac,nombre1,nombre2,apellidop,apellidom,correo,
password,casa,token)VALUES 
('$idfrac','$nombre1','$nombre2','$apellidop','$apellidom','$correo',
'$password','$casa','$token')";
if(mysqli_query($conexion, $nuevoUsuario)){
    echo "Registro insertado!!";
} 

//una vez insertado el usuario borro el token de la tabla tokens, previo ya lo guarde en el usuario
$flushtoken = "DELETE FROM tokens WHERE token ='$token'";
if(mysqli_query($conexion, $flushtoken)){
    echo "Token Eliminado";
}else{
    echo "Error, intente de nuevo";
}
// Close connection
mysqli_close($conexion);
header("Location: index.html");
?>