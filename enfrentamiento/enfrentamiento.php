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

        <div class="mb-3">
            <label for="lugar_inicio" class="form-label">Lugar de inicio</label>
            <input type="number" class="form-control" id="lugar_inicio_e" name="lugar_inicio" required>
        </div>

        <div class="mb-3">
            <label for="lugar_fin" class="form-label">Lugar de fin</label>
            <input type="number" class="form-control" id="lugar_fin_e" name="lugar_fin" required>
        </div>
        
        <!-- Consultar la lista de islas y desplegarlos -->
        <div class="mb-3">
            <label for="isla" class="form-label">Isla</label>
            <select name="isla" id="isla" class="form-select">
                
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
                <option value="<?= $fila["cedula"]; ?>"><?= $fila["nombre"]; ?> - C.C. <?= $fila["cedula"]; ?></option>

                <?php
                        // Cerrar los estructuras de control
                    endforeach;
                endif;
                ?>
            </select>
        </div>

       <!-- Consultar la lista de empresas y desplegarlos -->
        <div class="mb-3">
            <label for="empresa" class="form-label">Empresa</label>
            <select name="empresa" id="empresa" class="form-select">
                
                <!-- Option por defecto -->
                <option value="" selected disabled hidden></option>

                <?php
                // Importar el código del otro archivo
                require("../empresa/empresa_select.php");
                
                // Verificar si llegan datos
                if($resultadoEmpresa):
                    
                    // Iterar sobre los registros que llegaron
                    foreach ($resultadoEmpresa as $fila):
                ?>

                <!-- Opción que se genera -->
                <option value="<?= $fila["nit"]; ?>"><?= $fila["nombre"]; ?> - NIT: <?= $fila["nit"]; ?></option>

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
                <th scope="col" class="text-center">Código</th>
                <th scope="col" class="text-center">Fecha de creación</th>
                <th scope="col" class="text-center">Valor</th>
                <th scope="col" class="text-center">Cliente</th>
                <th scope="col" class="text-center">Empresa</th>
                <th scope="col" class="text-center">Acciones</th>
            </tr>
        </thead>

        <tbody>

            <?php
            // Iterar sobre los registros que llegaron
            foreach ($resultadoProyecto as $fila):
            ?>

            <!-- Fila que se generará -->
            <tr>
                <!-- Cada una de las columnas, con su valor correspondiente -->
                <td class="text-center"><?= $fila["codigo"]; ?></td>
                <td class="text-center"><?= $fila["fechacreacion"]; ?></td>
                <td class="text-center">$<?= $fila["valor"]; ?></td>
                <td class="text-center">C.C. <?= $fila["cliente"]; ?></td>
                <td class="text-center">NIT: <?= $fila["empresa"]; ?></td>
                
                <!-- Botón de eliminar. Debe de incluir la CP de la entidad para identificarla -->
                <td class="text-center">
                    <form action="proyecto_delete.php" method="post">
                        <input hidden type="text" name="codigoEliminar" value="<?= $fila["codigo"]; ?>">
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