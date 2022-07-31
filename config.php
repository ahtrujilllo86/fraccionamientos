 <!-- <!DOCTYPE html>
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
-->
<?php
date_default_timezone_set("America/Mexico_City");
session_start();
include("conexion.php");
$id = $_SESSION["id"];

?>

<div class="container-fluid">
    <div class="row justify-content-center cambiarpassword">
        <div class="col-8 col-lg-4">
                <h5>Cambiar Password</h5>
           <!-- <input name="antpassword" id="antpassword" type="password" class="form-control" onkeyup="checkpass(<?php //echo $id?>);" placeholder="password anterior">-->
            
            <!--div para input password ver digitos-->
            <br><div class="input-group mb-3">
                    <input type="password" id="antpassword" name="antpassword" class="form-control" onkeyup="checkpass(<?php echo $id?>);" placeholder="password anterior">
                    <div class="input-group-append">
                     <img src="img/eyeclose.png" alt="show" id="showantpass" width="50px" onclick="mostrarantContrasena()">
                    </div>
                </div>
                <!---->


            <!--div para input password ver digitos-->
            <br><div class="input-group mb-3">
                    <input type="password" id="newpass" name="password" class="form-control" placeholder="nuevo password">
                    <div class="input-group-append">
                     <img src="img/eyeclose.png" alt="show" id="shownewpass" width="50px" onclick="mostrarnewContrasena()">
                    </div>
                </div>
                <!---->
            <!--<br><input name="password" id="newpass" type="password" class="form-control" placeholder="nuevo password">-->
            
            
            <br><button class="btn btn-block btn-primary" id="btnpass" onclick="changepass()" disabled>Guardar</button>
            <br>
        </div>
    </div> <!--end row password form-->
    <div class="row justify-content-center">
        <div class="row" id="separacion"></div>
        <div class="col-12 col-lg-6 tableaccmanage">
            <br><h5>Administrar Accesos</h5><br>
            <?php
            $sql = "SELECT * FROM accesos WHERE idusuario = '$id' and vigente = 'si'";
            $resultado = mysqli_query($conexion,$sql);
            if (mysqli_num_rows($resultado) > 0) {
            ?>
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th scope="col">Nombre</th>
                        <th scope="col">Inicio</th>
                        <th scope="col">Fin</th>
                        <th scope="col">Eliminar</th>
                    </tr>
                    </thead>
                    <tbody>
            <?php 
                // output data of each row
                while($row = mysqli_fetch_assoc($resultado)) {
            ?>
                        <tr>
                            <th scope="row"><?php echo $row['nombre'];  ?></th>
                            <td><?php echo $row['inicio'];  ?></td>
                            <td><?php echo $row['fin'];  ?></td>
                           <td><button class="btn btn-danger" onclick="borraracceso(this.id)" id="<?php echo $row['indexacceso'];  ?>"><img src="img/deleteicon.png" width="20px" alt=""></button></td>
                        </tr>
            <?php 
                }
            ?>
                    </tbody>
                </table> <br>  
            <?php 

            }else{
                ?>
                <h4 style="text-align: center;"><u>Sin Accesos Vigentes</u></h4><br><br>
            <?php

            }
            ?>
        </div>
    </div><!--end row table accesos vigentes-->

    <div class="row justify-content-center">
        <div class="row" id="separacion"></div>
        <div class="col-12 col-lg-6 tableaccmanage">
            <div class="row">
                <div class="col-8 col-lg-10">
                    <h5>Autos Registrados</h5>
                </div>
                <div class="col-4 col-lg-2">
                    <button class="btn btn-warning" data-toggle="modal" data-target="#NuevoAuto">Nuevo</button><br>
                </div>
            </div>
            <?php
            $sql = "SELECT * FROM autos WHERE iduser = '$id'";
            $resultado = mysqli_query($conexion,$sql);
            if (mysqli_num_rows($resultado) > 0) {
            ?>
               <br> <table class="table table-striped">
                    <thead>
                    <tr>
                        <th scope="col">Modelo</th>
                        <th scope="col">Color</th>
                        <th scope="col">Placas</th>
                        <th scope="col">Editar</th>
                    </tr>
                    </thead>
                    <tbody>
            <?php 
                while($row = mysqli_fetch_assoc($resultado)) {
            ?>
                        <tr>
                            <th scope="row"><?php echo $row['modelo'];  ?></th>
                            <td><?php echo $row['color'];  ?></td>
                            <td><?php echo $row['placas'];  ?></td>
                         <!--   <td><button class="btn btn-warning"><img src="img/downicon.png" width="20px" alt=""></button></td>-->
                           <td><button id="<?php echo $row['id'];  ?>" class="btn btn-success" onclick="editauto(this.id);" ><img src="img/configicon.png" width="20px" alt=""></button></td>
                        </tr>
            <?php 
                }
            ?>
                    </tbody>
                </table>   
            <?php 

            }
            ?>
        </div>
    </div><!--end row table autos registrados-->
    
</div>


<!-- Modal nuevo auto-->
<div class="modal fade modalnew" id="NuevoAuto" tabindex="-1" aria-labelledby="NuevoAutoLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title modtitulo" id="exampleModalLabel">Registro de automovil</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">
              <div class="col-12">
                  <input type="text" class="form-control" id="newmarca" placeholder="marca"><br>
                  <input type="text" class="form-control" id="newmodelo" placeholder="modelo"><br>
                  <input type="text" class="form-control" id="newcolor" placeholder="color"><br>
                  <input type="text" class="form-control" id="newplacas" placeholder="placas" oninput="this.value = this.value.toUpperCase()">
              </div>             
        </div>
      </div>
      <div class="modal-footer" id="modfoot">
        <button type="button" class="btn btn-secondary" id="cancelnewauto" data-dismiss="modal">Cancelar</button>
        <button type="button" onclick="guardarauto()" class="btn btn-info">Guardar</button>
      </div>
      
    </div>
  </div>
</div>
   <!-- End Modal nuevo auto--> 


<!--    
</body>
</html>
          -->