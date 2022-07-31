<?php
include("conexion.php");

$newpass = $_POST['newpass'];
$correo = $_POST['correo'];


$cambiapass = "UPDATE usuarios SET password = '$newpass' WHERE correo = '$correo' ";
if(mysqli_query($conexion, $cambiapass)){
    echo "Password modificado con exito !!";
}else{
    echo "Error, intente de nuevo";
}
// Close connection
mysqli_close($conexion);

?>