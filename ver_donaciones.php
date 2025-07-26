<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Lista de Donaciones</title>
    <!-- Enlace a la hoja de estilos CSS -->
    <link rel="stylesheet" href="styles.css" />
</head>
<body>

<?php
include "conexion.php";

// Si se ha enviado el formulario para eliminar todas las donaciones
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["eliminar_todo"])) {
    // Ejecuta la eliminación de todos los registros de la tabla DONACION
    $conn->query("DELETE FROM DONACION");
    echo "<p style='color:red;'>Todas las donaciones han sido eliminadas.</p>";
}

// Consulta todas las donaciones registradas
$resultado = $conn->query("SELECT * FROM DONACION");

// Título principal
echo "<h2>Lista de Donaciones</h2>";

// Verifica si existen registros y los muestra
if ($resultado->num_rows > 0) {
    while ($fila = $resultado->fetch_assoc()) {
        echo "ID Donación: " . $fila["id_donacion"] . "<br>";
        echo "Monto: $" . $fila["monto"] . "<br>";
        echo "Fecha: " . $fila["fecha"] . "<br>";
        echo "ID Proyecto: " . $fila["id_proyecto"] . "<br>";
        echo "ID Donante: " . $fila["id_donante"] . "<br><hr>";
    }

    // Formulario para eliminar todas las donaciones
    echo '
    <form method="POST" onsubmit="return confirm(\'¿Estás seguro de que deseas eliminar TODAS las donaciones?\')">
        <input type="hidden" name="eliminar_todo" value="1">
        <input type="submit" value="Eliminar todas las donaciones" style="background-color:red; color:white;">
    </form>
    ';
} else {
    echo "No se han registrado donaciones.";
}

// Cierra la conexión con la base de datos
$conn->close();
?>

<!-- Enlace para volver a la página principal -->
<br>
<a href="index.html">Volver al inicio</a>

</body>
</html>
