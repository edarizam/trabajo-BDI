<?php
 
// Crear conexión con la BD
require('../config/conexion.php');

// Sacar los datos del formulario. Cada input se identifica con su "name"
$codigo = $_POST["codigo"];
$nombre = $_POST["nombre"];
$region = $_POST["region"];
$fruta_diablo = $_POST["fruta_diablo"];

// Query SQL a la BD. Si tienen que hacer comprobaciones, hacerlas acá (Generar una query diferente para casos especiales)
$query = ""	;

if ($fruta_diablo === "") {
    $query = "INSERT INTO `isla`(`codigo`,`nombre`, `region`) VALUES ('$codigo', '$nombre', '$region')";
} else {
   $query = "INSERT INTO `isla`(`codigo`,`nombre`, `region`, `fruta_diablo`) VALUES ('$codigo', '$nombre', '$region', '$fruta_diablo')";
}

// Ejecutar consulta
$result = mysqli_query($conn, $query) or die(mysqli_error($conn));

// Redirigir al usuario a la misma pagina
if($result):
    // Si fue exitosa, redirigirse de nuevo a la página de la entidad
	header("Location: isla.php");
else:
	echo "Ha ocurrido un error al crear la persona";
endif;

mysqli_close($conn);