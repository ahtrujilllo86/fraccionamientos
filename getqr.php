<?php

date_default_timezone_set("America/Mexico_City");
include("conexion.php");
$indexacceso = $_GET['indexacceso'];
$fechahoy = strtotime(date('Y-m-d h:i:sa'));
//antes que nada reviso vigencia del acceso
$revisarvigencia = "SELECT * FROM accesos WHERE indexacceso = '$indexacceso' ";
$checkvigente = mysqli_query($conexion,$revisarvigencia);

$datos = mysqli_fetch_array($checkvigente);
if ($datos > 0){

    if($datos['vigente'] == "borrado"){

    }else{
        $vencimiento = strtotime($datos['fin']);
        //si la fecha de fin es menor que la fecha de hoy, actualizo estado a vigente no
        if($vencimiento < $fechahoy){
            $vencidos = "UPDATE accesos SET vigente = 'no' WHERE indexacceso = '$indexacceso' ";
            mysqli_query($conexion, $vencidos);
        }
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>QG Access Master</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <link rel="stylesheet" href="css/estilos.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
    <script src="js/funciones.js"></script>
<body>
<div class="container-fluid" id="divqrshow">
    <div class="row justify-content-center contenidoqr">
                
<?php 

//despues de revisar vigencias y cambiar los vencidos a vigente=no, consulto nuevamente
$sql = "SELECT * FROM accesos WHERE indexacceso = '$indexacceso' ";
$resultado = mysqli_query($conexion,$sql);
$data = mysqli_fetch_array($resultado);
if ($data > 0)
{
    $vigente = $data['vigente'];
    if($vigente == "borrado" ){
    ?>
                <div class="col-10 col-lg-4 ">
                    <h2>Permiso no existe!</h2> <br><br>
                    <h2 style="color: red;">Acceso No Autorizado</h2><br>
                    <img src="img/guardstop.png" alt="stop" height="320px">
                </div>
              
        
        
    <?php 


    }elseif($vigente == "no"){
        $initdate = strtotime( $data['inicio'] );
        $formatinitdate = date( 'd-M-Y H:i:s', $initdate );
        $enddate = strtotime( $data['fin'] );
        $formatenddate = date( 'd-M-Y H:i:s', $enddate );
    ?>
            <div class="col-10 col-lg-4 ">
                    <u><h2>Permiso Vencido</h2></u> <br>
                    <h3><?php echo $data['nombre']; ?></h3><br>
                    <?php echo $formatinitdate . "<br>"; ?>
                    <?php echo $formatenddate; ?>
                    <h2 style="color: red;">Acceso No Autorizado</h2><br>
                    <img src="img/guardstop.png" alt="stop" height="320px">
                </div>
    <?php     
    }else{
        $initdate = strtotime( $data['inicio'] );
        $formatinitdate = date( 'd-M-Y H:i:s', $initdate );
        $enddate = strtotime( $data['fin'] );
        $formatenddate = date( 'd-M-Y H:i:s', $enddate );
    ?>  
                <div class="col-10 col-lg-4 ">
                    <u><h1><?php echo $data['nombre']; ?></h1></u>
                    <h5><?php echo $data['tipo']; ?></h5>
                    <h2><?php echo "Casa " . $data['casa']; ?></h2>
                    <?php echo $formatinitdate . "<br>"; ?>
                    <?php echo $formatenddate; ?>
                    <h2 style="color: green;">Acceso Autorizado</h2><br>
                    <img src="img/carlogo.png" alt="carlogo" width="220px" height="120px">
                    
                    <table class="table table-bordered table-sm">
                        <tbody>
                            <tr>
                                <td class="bg-info">Marca</td>
                                <td><?php echo $data['marca'];  ?></td>
                            </tr>
                            <tr>
                                <td class="bg-info">Modelo</td>
                                <td><?php echo $data['modelo'];  ?></td>
                            </tr>
                            <tr>
                                <td class="bg-info">Color</td>
                                <td><?php echo $data['color'];  ?></td>
                            </tr>
                            <tr>
                                <td class="bg-info">Placas</td>
                                <td><?php echo $data['placas'];  ?></td>
                            </tr>
                        </tbody>
                    </table><br>
                    <h3>Autorizado por:</h3>
                    <h2><?php echo $data['autoriza']; ?></h2>


                </div>
             
        
    
    <?php 


    }
    //echo $vigente;
}
?>
<?php ?>

    </div>  
</div>
</body>
</html>
