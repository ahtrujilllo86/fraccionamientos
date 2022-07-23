<?php

include("conexion.php");

$indexacceso = $_GET['indexacceso'];

$sql = "SELECT * FROM accesos WHERE indexacceso ='$indexacceso'";
$resultado = mysqli_query($conexion,$sql);
$data = mysqli_fetch_array($resultado);
if ($data > 0)
{
    echo $data['nombre']. "<br>";
    echo $data['tipo']. "<br>";
    echo $data['modelo']. "<br>";
    echo $data['color'];
}
else{
    //header("Location: index.html");
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>QG Access Control</title>
</head>
<body>
    
</body>
</html>