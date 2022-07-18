<?php
date_default_timezone_set("America/Mexico_City");
session_start();
include("conexion.php");
$id = $_SESSION["id"];
$fechahoy = strtotime(date('Y-m-d'));
//antes que nada reviso vigencia de los accesos
$revisarvigencia = "SELECT * FROM accesos WHERE idusuario = '$id' and vigente = 'si'";
$resultado = mysqli_query($conexion,$revisarvigencia);
if (mysqli_num_rows($resultado) > 0) {
    while($row = mysqli_fetch_assoc($resultado)) {
        $vencimiento = strtotime($row['fin']);
        if($vencimiento < $fechahoy){
            $pasado = $row['indexacceso'];
            echo $pasado;
            $vencidos = "UPDATE accesos SET vigente = 'no' WHERE indexacceso = '$pasado' ";
            mysqli_query($conexion, $vencidos);
        }
    }
}

//despues de revisar vigencias y cambiar los vencidos a vigente=no, traigo los permisos vigentes
$sql = "SELECT * FROM accesos WHERE idusuario = '$id' and vigente = 'si'";
$resultado = mysqli_query($conexion,$sql);
if (mysqli_num_rows($resultado) > 0) {
?>
    <table class="table table-striped">
        <thead>
        <tr>
            <th scope="col">Nombre</th>
            <th scope="col">Vigencia</th>
            <th scope="col">QR</th>
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
                <td><?php echo $row['fin'];  ?></td>
                <td><button class="btn btn-warning"><img src="img/downicon.png" width="20px" alt=""></button></td>
                <td><button class="btn btn-danger"><img src="img/deleteicon.png" width="20px" alt=""></button></td>
            </tr>
<?php 
    }
 ?>
        </tbody>
    </table>   
<?php 

  }
?>