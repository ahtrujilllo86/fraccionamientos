<?php 
session_start();
include("conexion.php");
$indexacceso = $_POST['indexo'];
$borraacceso = "UPDATE accesos SET vigente = 'borrado' WHERE indexacceso = '$indexacceso' ";
if(mysqli_query($conexion, $borraacceso)){
    echo "Acceso Borrado !!";
}else{
    echo "Error, intente de nuevo";
}
// Close connection
mysqli_close($conexion);
 ?>
