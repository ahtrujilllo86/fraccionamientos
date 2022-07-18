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
    $_SESSION["id"] = $data['id'];
    $_SESSION["idfrac"] = $data['idfrac'];
    $_SESSION["nombre1"] = $data['nombre1'];
    $_SESSION["apellidop"] = $data['apellidop'];
    $_SESSION["correo"] = $data['correo'];
    $_SESSION["casa"] = $data['casa'];
    header("Location: main.php");
}
else{
    header("Location: index.html");
}

// Close connection
mysqli_close($conexion);
 ?>
