<?php
include "conexion.php";

// Consulta los proyectos y donantes registrados //
$proyectos = $conn->query("SELECT id_proyecto, nombre FROM PROYECTO");
$donantes = $conn->query("SELECT id_donante, nombre FROM DONANTE");
?>

<!DOCTYPE html>
<html lang="es">
<head>
 <meta charset="UTF-8" />
 <meta name="viewport" content="width=device-width, initial-scale=1.0" />
 <link rel="stylesheet" href="styles.css" />
</head>
<body>
    <h2>Registrar Donacion.</h2>

    <!--Formulario para registrar una donación-->
    <form action="procesar_donacion.php" method="POST">
        
        <!--Campo de selección de proyecto-->
        <label>Seleccionar proyecto:</label><br>
        <select name="id_proyecto" required>
            <?php
            // Se recorre cada proyecto y genera una opcion en la lista desplegable //
            while ($row = $proyectos->fetch_assoc()) {
                echo "<option value='{$row['id_proyecto']}'>{$row['nombre']}</option>";
            }
            ?>
        </select><br><br>

        <!--Campo de selección de donante-->
        <label>Seleccionar Donante:</label><br>
        <select name="id_donante" required>
            <?php
            // Se recorre cada donante y genera una opción en la lista desplegable //
            while ($row = $donantes->fetch_assoc()) {
                echo "<option value='{$row['id_donante']}'>{$row['nombre']}</option>";
            }
            ?>
        </select><br><br>

        <!--Campo para ingresar el monto de la donación-->
        <label>Monto donado:</label><br>
        <input type="number" name="monto" min="1000" required><br><br>

        <!--Botón para enviar el formulario-->
        <input type="submit" value="Registro de donacion">
    </form>

    <!--Enlace para volver a la página principal-->
     <br>
     <a href="index.html">Volver al inicio</a>
</body>
</html>

<?php
// Cierra la conexión con la base de datos //
$conn->close();
?>
