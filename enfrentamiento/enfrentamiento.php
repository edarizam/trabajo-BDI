<?php
include "../includes/header.php";
?>

<!-- TÍTULO. Cambiarlo, pero dejar especificada la analogía -->
<h1 class="mt-3">Entidad análoga a REPARACION (ENFRENTAMIENTO)</h1>

<!-- FORMULARIO. Cambiar los campos de acuerdo a su trabajo -->
<div class="formulario p-4 m-3 border rounded-3">

    <form action="enfrentamiento_insert.php" method="post" class="form-group">

        <div class="mb-3">
            <label for="numero" class="form-label">Número</label>
            <input type="number" class="form-control" id="numero_e" name="numero" required>
        </div>

        <div class="mb-3">
            <label for="nombre" class="form-label">Nombre</label>
            <input type="text" class="form-control" id="nombre_e" name="nombre" required>
        </div>

        <div class="mb-3">
            <label for="numero_bajas" class="form-label">Número de bajas</label>
            <input type="number" class="form-control" id="numero_bajas_e" name="numero_bajas" required>
        </div>

        <div class="mb-3">
            <label for="fecha" class="form-label">Fecha</label>
            <input type="date" class="form-control" id="fecha_e" name="fecha" required>
        </div>

        <!-- Consultar la lista de islas de inicio y desplegarlos -->
        <div class="mb-3">
            <label for="lugar_inicio" class="form-label">Lugar de inicio</label>
            <select name="lugar_inicio" id="lugar_inicio" class="form-select">
                
                <!-- Option por defecto -->
                <option value= "" selected disabled hidden></option>

                <?php
                // Importar el código del otro archivo
                require("../isla/isla_select.php");
                
                // Verificar si llegan datos
                if($resultadoIsla):
                    
                    // Iterar sobre los registros que llegaron
                    foreach ($resultadoIsla as $fila):
                ?>

                <!-- Opción que se genera -->
                <option value="<?= $fila["codigo"]; ?>">
                    <?= $fila["codigo"]; ?> - <?= $fila["nombre"]; ?> - <?= $fila["region"];?> - <?= $fila["fruta_diablo"] ?? "NULL"; ?>
                </option>

                <?php
                        // Cerrar los estructuras de control
                    endforeach;
                endif;
                ?>
            </select>
        </div>

        <!-- Consultar la lista de islas de fin y desplegarlos -->
        <div class="mb-3">
            <label for="lugar_fin" class="form-label">Lugar de fin</label>
            <select name="lugar_fin" id="lugar_fin" class="form-select">
                
                <!-- Option por defecto -->
                <option value= "" selected>NULL</option>

                <?php
                // Importar el código del otro archivo
                require("../isla/isla_select.php");
                
                // Verificar si llegan datos
                if($resultadoIsla):
                    
                    // Iterar sobre los registros que llegaron
                    foreach ($resultadoIsla as $fila):
                ?>

                <!-- Opción que se genera -->
                <option value="<?= $fila["codigo"]; ?>">
                    <?= $fila["codigo"]; ?> - <?= $fila["nombre"]; ?> - <?= $fila["region"];?> - <?= $fila["fruta_diablo"] ?? "NULL"; ?>
                </option>

                <?php
                        // Cerrar los estructuras de control
                    endforeach;
                endif;
                ?>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Agregar</button>

    </form>
    
</div>

<?php
// Importar el código del otro archivo
require("enfrentamiento_select.php");
            
// Verificar si llegan datos
if($resultadoEnfrentamiento and $resultadoEnfrentamiento->num_rows > 0):
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
                <th scope="col" class="text-center">Lugar de fin</th>
                <th scope="col" class="text-center">Acciones</th>
            </tr>
        </thead>

        <tbody>

            <?php
            // Iterar sobre los registros que llegaron
            foreach ($resultadoEnfrentamiento as $fila):
            ?>

            <!-- Fila que se generará -->
            <tr>
                <!-- Cada una de las columnas, con su valor correspondiente -->
                <td class="text-center"><?= $fila["numero"]; ?></td>
                <td class="text-center"><?= $fila["nombre"]; ?></td>
                <td class="text-center"><?= $fila["numero_bajas"]; ?></td>
                <td class="text-center"><?= $fila["fecha"]; ?></td>
                <td class="text-center"><?= $fila["lugar_inicio"]; ?></td>
                <td class="text-center"><?= $fila["lugar_fin"]; ?></td>
                
                <!-- Botón de eliminar. Debe de incluir la CP de la entidad para identificarla -->
                <td class="text-center">
                    <form action="enfrentamiento_delete.php" method="post">
                        <input hidden type="text" name="numeroEliminar" value="<?= $fila["numero"]; ?>">
                        <button type="submit" class="btn btn-danger">Eliminar</button>
                    </form>
                </td>

            </tr>

            <?php
            // Cerrar los estructuras de control
            endforeach;
            ?>

        </tbody>

    </table>
</div>

<?php
endif;

include "../includes/footer.php";
?>