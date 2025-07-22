<?php
include "../includes/header.php";
?>

<!-- TÍTULO. Cambiarlo, pero dejar especificada la analogía -->
<h1 class="mt-3">Búsqueda 2</h1>

<p class="mt-3">
    El código de una reparación. Se debe mostrar todos los datos del contrato asociado al mecánico que recibió (mecánico receptor) dicha reparación.

</p>

<p class="mt-3">
    ANALOGO: EL número de un enfrentamiento. Se debe mostrar todos los datos de la fruta del diablo asociada a la isla que es lugar de inicio de dicho enfrentamiento.
</p>

<!-- FORMULARIO. Cambiar los campos de acuerdo a su trabajo -->
<div class="formulario p-4 m-3 border rounded-3">

    <!-- En esta caso, el Action va a esta mismo archivo -->
    <form action="busqueda2.php" method="post" class="form-group">

        <div class="mb-3">
            <label for="numero_enfrentamiento" class="form-label">Numero enfrentamiento</label>
            <input type="number" class="form-control" id="numero_enfrentamiento" name="numero_enfrentamiento" required>
        </div>


        <button type="submit" class="btn btn-primary">Buscar</button>

    </form>
    
</div>

<?php
// Dado que el action apunta a este mismo archivo, hay que hacer eata verificación antes
if ($_SERVER['REQUEST_METHOD'] === 'POST'):

    // Crear conexión con la BD
    require('../config/conexion.php');

    $numero_enfrentamiento = $_POST["numero_enfrentamiento"];


    // Query SQL a la BD -> Crearla acá (No está completada, cambiarla a su contexto y a su analogía)
    $query = "SELECT  * FROM fruta_del_diablo WHERE codigo = (SELECT fruta_diablo FROM isla WHERE codigo = (SELECT lugar_inicio FROM enfrentamiento WHERE numero = '$numero_enfrentamiento'))";

    //SELECT * FROM `fruta_del_diablo` WHERE codigo= (
    //SELECT fruta_diablo FROM isla WHERE codigo = (
        //SELECT lugar_inicio FROM enfrentamiento where numero = 143));
        //'$numero_enfrentamiento'

    // Ejecutar la consulta
    $resultadoB2 = mysqli_query($conn, $query) or die(mysqli_error($conn));

    mysqli_close($conn);

    // Verificar si llegan datos
    if($resultadoB2 and $resultadoB2->num_rows > 0):
?>

<!-- MOSTRAR LA TABLA. Cambiar las cabeceras -->
<div class="tabla mt-5 mx-3 rounded-3 overflow-hidden">

    <table class="table table-striped table-bordered">

        <!-- Títulos de la tabla, cambiarlos -->
        <thead class="table-dark">
            <tr>
                <th scope="col" class="text-center">Codigo</th>
                <th scope="col" class="text-center">Nombre</th>
                <th scope="col" class="text-center">Tipo</th>
                <th scope="col" class="text-center">Poder otorgado</th>
                <th scope="col" class="text-center">Precio</th>
                <th scope="col" class="text-center">Fecha producción</th>
                <th scope="col" class="text-center">Fecha expiración</th>
                
            </tr>
        </thead>

        <tbody>

            <?php
            // Iterar sobre los registros que llegaron
            foreach ($resultadoB2 as $fila):
            ?>

            <!-- Fila que se generará -->
            <tr>
                <!-- Cada una de las columnas, con su valor correspondiente -->
                <td class="text-center"><?= $fila["codigo"]; ?></td>
                <td class="text-center"><?= $fila["nombre"]; ?></td>
                <td class="text-center"><?= $fila["tipo"]; ?></td>
                <td class="text-center"><?= $fila["poder_otorgado"]; ?></td>
                <td class="text-center"><?= $fila["precio"]; ?></td>
                <td class="text-center"><?= $fila["fecha_produccion"]; ?></td>
                <td class="text-center"><?= $fila["fecha_expiracion"]; ?></td>

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