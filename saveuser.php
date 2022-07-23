<?php
date_default_timezone_set("America/Mexico_City");
session_start();
include("conexion.php");
$idusuario = $_SESSION["id"];
$idfrac = $_SESSION["idfrac"];
$casa = $_SESSION["casa"];
$autoriza = $_SESSION["nombre1"] . " " . $_SESSION["apellidop"];

$tipo = $_POST['tipo'];
$nombre = $_POST['nombre'];
$marca = $_POST['marca'];
$modelo = $_POST['modelo'];
$color = $_POST['color'];
$placas = $_POST['placas'];
$inicio = $_POST['inicio'];
$fin = $_POST['fin'];

//echo $fin;
$indexacc = "SELECT indexacceso  from accesos ORDER BY id DESC LIMIT 1";
$resultado = mysqli_query($conexion,$indexacc);
$indexacceso = mysqli_fetch_array($resultado);
$newindex = $indexacceso[0] +1;
//echo $newindex;

if($inicio == NULL || $fin == NULL ){
    echo ("0");
}else{
    
    $saveregistro = "INSERT INTO accesos (indexacceso,idusuario,idfrac,tipo,nombre,marca,
    modelo,color,placas,inicio,fin,vigente,casa,autoriza)VALUES 
    ('$newindex','$idusuario','$idfrac','$tipo','$nombre','$marca',
    '$modelo','$color','$placas','$inicio','$fin','si','$casa','$autoriza')";
    if(mysqli_query($conexion, $saveregistro)){
        //echo "Registro insertado!!";
        echo $newindex;
    }else{
         echo "0";
    }
    
}




// Close connection
mysqli_close($conexion);

?>