<?php
 
// Crear conexión con la BD
require('../config/conexion.php');

// Sacar los datos del formulario. Cada input se identifica con su "name"
$numero = $_POST["numero"];
$nombre = $_POST["nombre"];
$numero_bajas = $_POST["numero_bajas"];
$fecha = $_POST["fecha"];
$lugar_inicio = $_POST["lugar_inicio"];
$lugar_fin = $_POST["lugar_fin"];

// Query SQL a la BD. Si tienen que hacer comprobaciones, hacerlas acá (Generar una query diferente para casos especiales)
$query = "INSERT INTO `enfrentamiento`(`numero`,`nombre`, `numero_bajas`, `fecha`, `lugar_inicio`, `lugar_fin`) VALUES ('$numero', '$nombre', '$numero_bajas', '$fecha', '$lugar_inicio', '$lugar_fin')";

// Ejecutar consulta
$result = mysqli_query($conn, $query) or die(mysqli_error($conn));

// Redirigir al usuario a la misma pagina
if($result):
    // Si fue exitosa, redirigirse de nuevo a la página de la entidad
	header("Location: enfrentamiento.php");
else:
	echo "Ha ocurrido un error al crear la persona";
endif;

mysqli_close($conn);