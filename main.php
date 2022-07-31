<?php 
date_default_timezone_set("America/Mexico_City");
session_start();
include("conexion.php");
if($_SESSION["correo"]){
    $user = $_SESSION["nombre1"] . " " . $_SESSION["apellidop"];
    $id = $_SESSION["id"];
    $casa = $_SESSION["casa"];
    $idfrac = $_SESSION["idfrac"];
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
    <script src="js/qrcode.js"></script>
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
        <a class="nav-link" href="javascript:configurar();">Administrar</a>
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
            <img src="img/addiconblue.png" width="60px" alt="Agregar" data-toggle="modal" data-target="#NuevoAcceso">
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

            </div>
    </div>
</div><!--end container-fluid2-->


<!-- Modal nuevo acceso-->
<div class="modal fade modalnew" id="NuevoAcceso" tabindex="-1" aria-labelledby="NuevoAccesoLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title modtitulo" id="exampleModalLabel">Nuevo acceso casa <?php echo $casa; ?></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="row justify-content-center" >
        <div class="col-8" id="qrgen"></div>
      </div>
      
      
      <div class="modal-body" id="modbody">
        <div class="row modcuerpo">
            <div class="col-12">
              <h5>Tipo de acceso</h5>
              <select name="tipoacceso" id="tipoacceso" class="form-control">
                <option value="Visita">Visita</option>
                <option value="Empleado">Empleado</option>
                <option value="Proveedor">Proveedor</option>
              </select><br>
              <input type="text" id="nombrevisita" class="form-control" placeholder="Nombre del visitante"><br>
              <div class="row">
                <div class="col-1">
                    <input type="checkbox" id="checkauto" onclick="showautodiv(this.checked)"> 
                </div>
                <div class="col">
                    <h5>Automovil</h5>
                </div>
              </div>
              <div class="col-12" id="autodatos" style="display: none;">
              <!--test select automovil desde BD-->

              <select name="autobd" id="autobd" onchange="fillauto(this.value)" class="form-control">
              <option value="none">Ingreso Manual</option>
              <?php 
              $autosbd = "SELECT * FROM autos WHERE iduser = '$id'";
              $resultado = mysqli_query($conexion,$autosbd);
              if (mysqli_num_rows($resultado) > 0) {
                  while($row = mysqli_fetch_assoc($resultado)) {?>
                    <option value="<?php echo $row['id']; ?>"><?php echo $row['modelo'] . " " . $row['color']. " " . $row['placas']; ?></option>
                  <?php 
                  }
              }
              
              ?>
              </select><br>
              <!--test select automovil desde BD-->

                  <input type="text" class="form-control" id="marca" placeholder="marca"><br>
                  <input type="text" class="form-control" id="modelo" placeholder="modelo"><br>
                  <input type="text" class="form-control" id="color" placeholder="color"><br>
                  <input type="text" class="form-control" id="placas" placeholder="placas" oninput="this.value = this.value.toUpperCase()">
              </div>
              <br><h5>Inicio</h5><input type="datetime-local" id="inicio" class="form-control">
              <br><h5>Fin</h5><input type="datetime-local" id="fin" class="form-control">              
            </div>
        </div>
      </div>
      <div class="modal-footer" id="modfoot">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
        <!--<button type="button" onclick="qrgen('2')" class="btn btn-success">QRGen</button>-->
        <button type="button" onclick="guardaracceso()" class="btn btn-info">Guardar</button>
      </div>
      
    </div>
  </div>
</div>
<!-- End Modal nuevo acceso-->

<!-- Editar auto-->
<div class="modal fade" id="editAuto" tabindex="-1" aria-labelledby="editAutoLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="">Editar automovil</h5>
        <span id="ideauto" style="display:none;"></span>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">
              <div class="col-12">
                  <input type="text" class="form-control" id="editmarca" placeholder="marca"><br>
                  <input type="text" class="form-control" id="editmodelo" placeholder="modelo"><br>
                  <input type="text" class="form-control" id="editcolor" placeholder="color"><br>
                  <input type="text" class="form-control" id="editplacas" placeholder="placas" oninput="this.value = this.value.toUpperCase()">
              </div>             
        </div>
      </div>
      <div class="modal-footer" id="">
        <button type="button" onclick="resaveauto()" class="btn btn-info">Guardar Cambios</button>
        <button type="button" onclick="deleteauto()" class="btn btn-danger">Eliminar</button>
        <button type="button" class="btn btn-secondary" id="closemodaledit" data-dismiss="modal">Cancelar</button>
      </div>
      
    </div>
  </div>
</div>
   <!-- End Editar auto--> 


</body>
</html>