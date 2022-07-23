<?php

include("conexion.php");

$idfracc = $_POST['idfracc'];

$sql = "SELECT * FROM fraccionamientos WHERE idfrac ='$idfracc'";
$resultado = mysqli_query($conexion,$sql);
$data = mysqli_fetch_array($resultado);
if ($data > 0)
{
    echo "ok";
}

// Close connection
mysqli_close($conexion);
?>