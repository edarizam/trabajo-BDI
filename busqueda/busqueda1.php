<?php
include "../includes/header.php";
?>

<!-- TÍTULO. Cambiarlo, pero dejar especificada la analogía -->
<h1 class="mt-3">Búsqueda 1</h1>

<p class="mt-3">
    El código de un contrato. Se debe mostrar todas las reparaciones ejecutadas
    por el mecánico asociado a dicho contrato pero siempre y cuando la fecha de dichas
    reparaciones esté por fuera del intervalo de fechas de dicho contrato. (Esto significa que
    fueron reparaciones ejecutadas por el mecánico cuando no tenía contrato).
</p>

<p class="mt-3">
    Analoga: El código de una fruta del diablo. Se debe mostrar todos los enfrentamientos finalizados en la isla asociada a dicha fruta del diablo pero siempre y cuando la fecha de dichos enfrentamientos esté por fuera del intervalo de fechas de dicha fruta del diablo. (Esto significa que fueron enfrentamientos finalizados en la isla cuando su fruta del diablo no había sido generada o ya había expirado)
</p>

<!-- FORMULARIO. Cambiar los campos de acuerdo a su trabajo -->
<div class="formulario p-4 m-3 border rounded-3">

    <!-- En esta caso, el Action va a esta mismo archivo -->
    <form action="busqueda1.php" method="post" class="form-group">

        <div class="mb-3">
            <label for="codigo" class="form-label">Código Fruta</label>
            <input type="number" class="form-control" id="codigo" name="codigo" required>
        </div>

        <button type="submit" class="btn btn-primary">Buscar</button>

    </form>
    
</div>

<?php
// Dado que el action apunta a este mismo archivo, hay que hacer eata verificación antes
if ($_SERVER['REQUEST_METHOD'] === 'POST'):

    // Crear conexión con la BD
    require('../config/conexion.php');

    $codigo = $_POST["codigo"];
    
    // Query SQL a la BD -> Crearla acá (No está completada, cambiarla a su contexto y a su analogía)
    $query = "SELECT * FROM enfrentamiento e WHERE e.lugar_fin = (SELECT i.codigo FROM isla i WHERE i.fruta_diablo = '$codigo') AND (e.fecha<(SELECT f.fecha_produccion FROM fruta_del_diablo f WHERE f.codigo = '$codigo') OR e.fecha>(SELECT f.fecha_expiracion FROM fruta_del_diablo f WHERE f.codigo = '$codigo'))";
// SELECT * FROM enfrentamiento e WHERE e.lugar_fin=(SELECT i.codigo FROM isla i WHERE i.fruta_diablo=input) AND (e.fecha<(SELECT f.fecha_produccion FROM fruta_del_diablo f WHERE f.codigo=input) OR e.fecha>(SELECT f.fecha_expiracion FROM fruta_del_diablo f WHERE f.codigo=input));
    // Ejecutar la consulta
    $resultadoB1 = mysqli_query($conn, $query) or die(mysqli_error($conn));

    mysqli_close($conn);

    // Verificar si llegan datos
    if($resultadoB1 and $resultadoB1->num_rows > 0):
?>

<!-- MOSTRAR LA TABLA. Cambiar las cabeceras -->
<div class="tabla mt-5 mx-3 rounded-3 overflow-hidden">

    <table class="table table-striped table-bordered">

        <!-- Títulos de la tabla, cambiarlos -->
        <thead class="table-dark">
            <tr>
                <th scope="col" class="text-center">Número</th>
                <th scope="col" class="text-center">Nombre</th>
                <th scope="col" class="text-center">Fecha</th>
                <th scope="col" class="text-center">Numero bajas</th>
                <th scope="col" class="text-center">Lugar inicio</th>
                <th scope="col" class="text-center">Lugar fin</th>

            </tr>
        </thead>

        <tbody>

            <?php
            // Iterar sobre los registros que llegaron
            foreach ($resultadoB1 as $fila):
            ?>

            <!-- Fila que se generará -->
            <tr>
                <!-- Cada una de las columnas, con su valor correspondiente -->
                <td class="text-center"><?= $fila["numero"]; ?></td>
                <td class="text-center"><?= $fila["nombre"]; ?></td>
                <td class="text-center"><?= $fila["fecha"]; ?></td>
                <td class="text-center"><?= $fila["numero_bajas"]; ?></td>
                <td class="text-center"><?= $fila["lugar_inicio"]; ?></td>
                <td class="text-center"><?= $fila["lugar_fin"]; ?></td>
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
endif;

include "../includes/footer.php";
?>