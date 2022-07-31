<?php

include("conexion.php");

$token = $_POST['token'];
$correo = $_POST['correo'];

$sql = "SELECT * FROM usuarios WHERE token ='$token' AND correo ='$correo'";
$resultado = mysqli_query($conexion,$sql);
$data = mysqli_fetch_array($resultado);
if ($data > 0)
{
    echo "si";
}else{
    echo "none";
}

// Close connection
mysqli_close($conexion);
?>