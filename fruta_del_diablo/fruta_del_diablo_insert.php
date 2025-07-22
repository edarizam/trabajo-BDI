<?php
 
// Crear conexión con la BD
require('../config/conexion.php');

// Sacar los datos del formulario. Cada input se identifica con su "name"
$codigo = $_POST["codigo"];
$nombre = $_POST["nombre"];
$tipo = $_POST["tipo"];
$poder_otorgado = $_POST["poder_otorgado"];
$precio = $_POST["precio"];
$fecha_produccion = $_POST["fecha_produccion"];
$fecha_expiracion = $_POST["fecha_expiracion"];

// Query SQL a la BD. Si tienen que hacer comprobaciones, hacerlas acá (Generar una query diferente para casos especiales)
$query = "INSERT INTO `fruta_del_diablo`(`codigo`,`nombre`, `tipo`, `poder_otorgado`,`precio`, `fecha_produccion`, `fecha_expiracion`) VALUES ('$codigo', '$nombre', '$tipo', '$poder_otorgado', $precio,'$fecha_produccion', '$fecha_expiracion' )";

// Ejecutar consulta
$result = mysqli_query($conn, $query) or die(mysqli_error($conn));

// Redirigir al usuario a la misma pagina
if($result):
    // Si fue exitosa, redirigirse de nuevo a la página de la entidad
	header("Location: fruta_del_diablo.php");
else:
	echo "Ha ocurrido un error al crear la persona";
endif;

mysqli_close($conn);