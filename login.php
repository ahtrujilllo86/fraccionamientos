<?php 
session_start();

include("conexion.php");

$correo = $_POST['correo'];
$password = $_POST['password'];

$sql = "SELECT * FROM usuarios WHERE correo ='$correo' AND password = '$password'";
$resultado = mysqli_query($conexion,$sql);
$data = mysqli_fetch_array($resultado);
if ($data > 0)
{
    $_SESSION["id"] = $data['id']."<br>";
    $_SESSION["idfrac"] = $data['idfrac']."<br>";
    $_SESSION["nombre1"] = $data['nombre1']."<br>";
    $_SESSION["apellidop"] = $data['apellidop']."<br>";
    $_SESSION["correo"] = $data['correo']."<br>";
    $_SESSION["casa"] = $data['casa'];
    header("Location: main.php");
}
else{
    header("Location: index.html");
}

// Close connection
mysqli_close($conexion);
 ?>
