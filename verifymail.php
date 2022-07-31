<?php 
include("conexion.php");
$correo = $_POST['correo'];

$sql = "SELECT * FROM usuarios WHERE correo = '$correo'";
$resultado = mysqli_query($conexion,$sql);
$data = mysqli_fetch_array($resultado);
if ($data > 0)
{
    echo "ok";
}
// Close connection
mysqli_close($conexion);

 ?>
