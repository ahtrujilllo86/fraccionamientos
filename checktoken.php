<?php

include("conexion.php");

$token = $_POST['token'];

$sql = "SELECT * FROM tokens WHERE token ='$token'";
$resultado = mysqli_query($conexion,$sql);
$data = mysqli_fetch_array($resultado);
if ($data > 0)
{
    echo "si";
}

// Close connection
mysqli_close($conexion);
?>