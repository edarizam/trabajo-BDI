<?php
include "../includes/header.php";
?>

<!-- TÍTULO. Cambiarlo, pero dejar especificada la analogía -->
<h1 class="mt-3">Consulta 1</h1>

<p class="mt-3">
    "El primer botón debe mostrar los datos de las tres reparaciones de mayor valor que no tienen mecánico ejecutor (en caso de empates, usted decide como proceder).
    Se debe mostrar para cada una de estas tres reparaciones los datos correspondientes del mecánico receptor."
</p>

<p class="mt-3">
    <b>Analogo de nuestro E-R:</b> Se muestran los datos de los tres enfrentamientos con mayor número de bajas que no han finalizado y la información de la isla donde se empezó.
    En caso de empates, se mostraran las de fechas más recientes. 
</p>

<?php
// Crear conexión con la BD
require('../config/conexion.php');

// Query SQL a la BD -> Crearla acá (No está completada, cambiarla a su contexto y a su analogía)
$query = "SELECT 
            e.numero,
            e.nombre,
            e.numero_bajas,
            e.fecha,
            e.lugar_inicio,
            i.codigo AS codigo_isla,
            i.nombre AS nombre_isla,
            i.region AS region_isla,
            i.fruta_diablo AS fruta_codigo
            FROM enfrentamiento e
            JOIN isla i ON e.lugar_inicio = i.codigo
            WHERE e.lugar_fin IS NULL
            ORDER BY e.numero_bajas DESC, e.fecha DESC
            LIMIT 3";

// Ejecutar la consulta
$resultadoC1 = mysqli_query($conn, $query) or die(mysqli_error($conn));

mysqli_close($conn);
?>

<?php
// Verificar si llegan datos
if($resultadoC1 and $resultadoC1->num_rows > 0):
?>

<!-- MOSTRAR LA TABLA. Cambiar las cabeceras -->
<div class="tabla mt-5 mx-3 rounded-3 overflow-hidden">

    <table class="table table-striped table-bordered">

        <!-- Títulos de la tabla, cambiarlos -->
        <thead class="table-dark">
            <tr>
                <th scope="col" class="text-center">Número</th>
                <th scope="col" class="text-center">Nombre</th>
                <th scope="col" class="text-center">Número de bajas</th>
                <th scope="col" class="text-center">Fecha</th>
                <th scope="col" class="text-center">Lugar de inicio</th>
                <th scope="col" class="text-center">Código de isla</th>                
                <th scope="col" class="text-center">Nombre de la isla</th>
                <th scope="col" class="text-center">Región</th>
                <th scope="col" class="text-center">Fruta del diablo</th>              
            </tr>
        </thead>

        <tbody>

            <?php
            // Iterar sobre los registros que llegaron
            foreach ($resultadoC1 as $fila):
            ?>

            <!-- Fila que se generará -->
            <tr>
                <!-- Cada una de las columnas, con su valor correspondiente -->
                <td class="text-center"><?= $fila["numero"]; ?></td>
                <td class="text-center"><?= $fila["nombre"]; ?></td>
                <td class="text-center"><?= $fila["numero_bajas"]; ?></td>
                <td class="text-center"><?= $fila["fecha"]; ?></td>
                <td class="text-center"><?= $fila["lugar_inicio"]; ?></td>
                <td class="text-center"><?= $fila["codigo_isla"]; ?></td>
                <td class="text-center"><?= $fila["nombre_isla"]; ?></td>
                <td class="text-center"><?= $fila["region_isla"]; ?></td>
                <td class="text-center"><?= $fila["fruta_codigo"]; ?></td>
            </tr>

            <?php
            // Cerrar los estructuras de control
            endforeach;
            ?>

        </tbody>

    </table>
</div>

<!-- Mensaje de error si no hay resultados -->
<?php
else:
?>

<div class="alert alert-danger text-center mt-5">
    No se encontraron resultados para esta consulta
</div>

<?php
endif;

include "../includes/footer.php";
?>