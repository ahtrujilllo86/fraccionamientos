<?php
date_default_timezone_set("America/Mexico_City");
session_start();
include("conexion.php");
$iduser = $_SESSION["id"];

$marca = $_POST['marca'];
$modelo = $_POST['modelo'];
$color = $_POST['color'];
$placas = $_POST['placas'];
    
$saveauto = "INSERT INTO autos (iduser,marca,modelo,color,placas)VALUES 
('$iduser','$marca','$modelo','$color','$placas')";
if(mysqli_query($conexion, $saveauto)){
    echo "Auto Registrado!!";
}else{
        echo "Error al insertar, intente de nuevo";
}

// Close connection
mysqli_close($conexion);

?>