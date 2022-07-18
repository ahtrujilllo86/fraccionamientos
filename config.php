<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>QG Access Master</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <link rel="stylesheet" href="css/estilos.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
    <script src="js/funciones.js"></script>
</head>
<body>

<?php
date_default_timezone_set("America/Mexico_City");
session_start();
include("conexion.php");
$id = $_SESSION["id"];

?>

<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-8 col-lg-4 regform">
            <div class="row logorow">
                <h3>Cambiar Password</h3>
            </div>
            <!--<form action="login.php" method="POST"></form>-->
            <br><br><input name="antpassword" id="antpassword" type="password" class="form-control" onkeyup="checkpass(<?php echo $id?>);" placeholder="password anterior">
            <br><input name="password" id="newpass" type="password" class="form-control" placeholder="nuevo password">
            <br><button class="btn btn-block btn-primary" id="btnpass" onclick="changepass()" disabled>Guardar</button>
            
        </div>
    </div>  
</div>
    
</body>
</html>