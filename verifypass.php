<?php 
session_start();
include("conexion.php");
$password = $_POST['password'];
//echo $password . "desde AJAX";
/**/

$sql = "SELECT * FROM usuarios WHERE password = '$password'";
$resultado = mysqli_query($conexion,$sql);
$data = mysqli_fetch_array($resultado);
if ($data > 0)
{
    echo "ok";
}
// Close connection
mysqli_close($conexion);

 ?>
