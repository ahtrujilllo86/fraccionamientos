<?php 
//session_start();
/*
$usuario = $_POST['usuario'];
$password = $_POST['password'];

echo $usuario;
echo $password;
*/
echo "usuario";
echo "password";

/*
$checkiud = mysqli_connect("localhost", "root", "", "iot");

$sql = "SELECT iud FROM serie WHERE iud='$iud'";
$resultado = mysqli_query($checkiud,$sql);
$data = mysqli_fetch_array($resultado);
if ($data > 0)
{
echo "repetido";
//header("Location: main.php");

die();
}

// Close connection
mysqli_close($checkiud);
 ?>

<?php 

$registroiud = mysqli_connect("localhost", "root", "", "iot");
$nombre = $_POST['nombre'];
$iud = $_POST['iud'];
$tipo = $_POST['tipo'];
$ad = $_POST['ad'];

		//session_destroy();
		if(isset($_SESSION['s_usuario']))
		{
			//echo "Sesion exitosa!! <br>";
			echo "<title> Bienvenido ";
			echo $_SESSION['s_usuario'];
			echo "</title>";
			//echo "<a href='cerrarsesion.php'>Cerrar Sesion </a>";
		}
		else
		{
			header("Location: index.php");
		}



//inserto usuario y pass en tabla
$insertar = "INSERT INTO " . $_SESSION['s_usuario'] . "(id, nombre, iud, tipo, ad) VALUES ('', " . "'" . $nombre . "', " . "'" . $iud . "', " . "'" . $tipo . "', " . "'" . $ad . "')";

if(mysqli_query($registroiud, $insertar)){
    echo "Registros añadidos correctamente.";
} else{
    echo "ERROR: " . mysqli_error($registroiud);
}

// Close connection
mysqli_close($registroiud);

 ?>
 <?php 
$riud = mysqli_connect("localhost", "root", "", "iot");

$iiud = "INSERT INTO serie VALUES('" . $iud . "')";

if(mysqli_query($riud, $iiud)){
    echo "Registros añadidos correctamente.";
} else{
    echo "ERROR: " . mysqli_error($riud);
}
// Close connection
mysqli_close($riud);
header("Location: main.php");

*/
  ?>
