<?php
date_default_timezone_set("America/Mexico_City");
session_start();
include("conexion.php");
$id = $_SESSION["id"];
?>
<div class="row justify-content-center">
        <div class="col-9 col-lg-3">
            <h3>Historial de Accesos</h3>
        </div>
</div>
<div class="row justify-content-center">
    <div class="col-12 col-lg-8">
<?php 
$sql = "SELECT * FROM accesos WHERE idusuario = '$id'";
$resultado = mysqli_query($conexion,$sql);
if (mysqli_num_rows($resultado) > 0) {
?>
    <table class="table table-striped table-sm">
        <thead>
        <tr>
            <th scope="col">Nombre</th>
            <th scope="col">Tipo</th>
            <th scope="col">Inicio</th>
            <th scope="col">Fin</th>
            <th scope="col">Vigente</th>
        </tr>
        </thead>
        <tbody>
<?php 
    // output data of each row
    while($row = mysqli_fetch_assoc($resultado)) {
?>
            <tr>
                <th scope="row"><?php echo $row['nombre'];  ?></th>
                <td><?php echo $row['tipo'];  ?></td>
                <td><?php echo $row['inicio'];  ?></td>
                <td><?php echo $row['fin'];  ?></td>
                <td><?php echo $row['vigente'];  ?></td>
                
            </tr>
<?php 
    }
 ?>
        </tbody>
    </table>
</div>
</div>   
<?php 

  }
?>