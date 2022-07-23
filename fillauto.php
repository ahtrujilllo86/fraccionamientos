<?php
header('Content-Type: application/json; charset=utf-8');

include("conexion.php");

$id = $_POST['idauto'];

$fillauto = "SELECT * FROM autos WHERE id = '$id'";
$resultado = mysqli_query($conexion,$fillauto);
if (mysqli_num_rows($resultado) > 0) {

    $arre= mysqli_fetch_assoc($resultado);
    echo json_encode($arre);


}


?>