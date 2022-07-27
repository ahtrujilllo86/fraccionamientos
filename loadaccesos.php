<?php
date_default_timezone_set("America/Mexico_City");
session_start();
include("conexion.php");
$id = $_SESSION["id"];
$fechahoy = strtotime(date('Y-m-d h:i:sa'));
//echo $fechahoy . "<br>";
//echo date('Y-m-d h:i:sa') . "<br>";
//antes que nada reviso vigencia de los accesos
$revisarvigencia = "SELECT * FROM accesos WHERE idusuario = '$id' and vigente = 'si'";
$resultado = mysqli_query($conexion,$revisarvigencia);
if (mysqli_num_rows($resultado) > 0) {
    while($row = mysqli_fetch_assoc($resultado)) {
        $vencimiento = strtotime($row['fin']);
        //echo $vencimiento . "<br>";
        //si hay un error en la fecha se borra el acceso
        if($vencimiento < 0){
            $erroneo = $row['indexacceso'];
            $erroneos = "DELETE FROM accesos WHERE indexacceso = '$erroneo' ";
            mysqli_query($conexion, $erroneos);
        }
        //si la fecha de fin es menor que la fecha de hoy, actualizo estado a vigente no
        if($vencimiento < $fechahoy){
            $pasado = $row['indexacceso'];
            //echo $pasado;
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
            <th scope="col">Inicio</th>
            <th scope="col">Fin</th>
            <th scope="col">QR</th>
        </tr>
        </thead>
        <tbody>
<?php 
    // output data of each row
    while($row = mysqli_fetch_assoc($resultado)) {
?>
            <tr>
                <td><?php echo "<b>".$row['nombre'] . "</b><br>" . $row['tipo'] ;  ?></td>
                <td><?php echo $row['inicio'];  ?></td>
                <td><?php echo $row['fin'];  ?></td>
                <td><button onclick="qrgen(this.id)" class="btn btn-warning" id="<?php echo $row['indexacceso'];?>"><img src="img/downicon.png" width="20px" alt=""></button></td>
             <!--   <td><button class="btn btn-danger"><img src="img/deleteicon.png" width="20px" alt=""></button></td>-->
            </tr>
<?php 
    }
 ?>
        </tbody>
    </table>   
<?php 

  }else{
    ?>
     <h4 style="text-align: center;"><u>Sin Accesos Vigentes</u></h4><br><br>
 <?php
  }
?>