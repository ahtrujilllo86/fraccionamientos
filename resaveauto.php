<?php 
session_start();
include("conexion.php");

$autoid = $_POST["autoid"];
$marca = $_POST['marca'];
$modelo = $_POST['modelo'];
$color = $_POST['color'];
$placas = $_POST['placas'];

$updateauto = "UPDATE autos SET marca = '$marca', modelo = '$modelo', 
color = '$color', placas = '$placas' WHERE id = '$autoid' ";
if(mysqli_query($conexion, $updateauto)){
    echo "Datos de auto modificados !!";
}else{
    echo "Error, intente de nuevo";
}
// Close connection
mysqli_close($conexion);
 ?>
