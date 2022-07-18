<?php 
session_start();
include("conexion.php");
$id = $_SESSION["id"];
$newpass = $_POST['newpass'];
$cambiapass = "UPDATE usuarios SET password = '$newpass' WHERE id = '$id' ";
if(mysqli_query($conexion, $cambiapass)){
    echo "Password modificado con exito !!";
}else{
    echo "Error, intente de nuevo";
}
// Close connection
mysqli_close($conexion);
 ?>
