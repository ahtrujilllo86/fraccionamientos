<?php
session_start();
include("conexion.php");

$id = $_POST['autoid'];

$erroneos = "DELETE FROM autos WHERE id = '$id' ";
if(mysqli_query($conexion, $erroneos)){
    echo "Automovil Borrado!";
}else{
    echo "Error, intente de nuevo";
}

?>