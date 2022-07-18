<?php 
session_start();
if($_SESSION["correo"]){
    $user = $_SESSION["nombre1"] . " " . $_SESSION["apellidop"];
    $id = $_SESSION["id"];
}else{
header("Location: index.html");
}
?>

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
<script>
    $(document).ready(function(){
        $("#tableaccesos").load("loadaccesos.php");
    });
</script>
<body>
<nav class="navbar navbar-expand-lg navbar-dark barrasuperior">
  <a class="navbar-brand" href="main.php"><h3><?php echo $user;?></h3></a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNav">
    <ul class="navbar-nav">
    <li class="nav-item active">
        <a class="nav-link" href="main.php">Inicio</a>
      </li>
      <li class="nav-item active">
        <a class="nav-link" href="javascript:historial();">Historico</a>
      </li>
      <li class="nav-item active">
        <a class="nav-link" href="javascript:configurar();">Configurar</a>
      </li>
      <li class="nav-item active">
        <a class="nav-link" href="logout.php">Salir</a>
      </li>
    </ul>
  </div>
</nav>

<div class="container-fluid" id="principal">
    <div class="row">
        <div class="col rowimg">
            <img src="img/addiconblue.png" width="60px" alt="Agregar">
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-9 col-lg-2 accesos">
            <h3>Mis Accesos</h3>
        </div>
    </div>
    
    


</div><!--end container-fluid1-->
<div class="container-fluid" id="acctabla">
    <div class="row justify-content-center accestable">
            <div class="col-12 col-lg-8" id="tableaccesos">
              <!--  <table class="table table-striped">
                    <thead>
                    <tr>
                        <th scope="col">Nombre</th>
                        <th scope="col">Vigencia</th>
                        <th scope="col">QR</th>
                        <th scope="col">Eliminar</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <th scope="row">Angel Hernandez</th>
                        <td>2022-07-22</td>
                        <td><button class="btn btn-warning"><img src="img/downicon.png" width="20px" alt=""></button></td>
                        <td><button class="btn btn-danger"><img src="img/deleteicon.png" width="20px" alt=""></button></td>
                    </tr>
                    </tbody>
                    
                </table>-->
            </div>
    </div>
</div><!--end container-fluid2-->
    
</body>
</html>