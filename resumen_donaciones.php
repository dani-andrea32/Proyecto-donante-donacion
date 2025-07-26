<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <!-- Enlace a la hoja de estilos CSS -->
    <link rel="stylesheet" href="styles.css" />
</head>
<body>

<?php
// Incluye el archivo que contiene la conexión a la base de datos
include "conexion.php";

// Consulta SQL que resume la cantidad de donaciones y el total recaudado por proyecto //
// Solo se incluyen los proyectos que tienen más de 2 donaciones //
$sql = "
SELECT p.nombre AS nombre_proyecto, 
       COUNT(d.id_donacion) AS total_donaciones, 
       SUM(d.monto) AS total_recaudado
FROM DONACION d
JOIN PROYECTO p ON d.id_proyecto = p.id_proyecto
GROUP BY d.id_proyecto
HAVING COUNT(d.id_donacion) > 2
ORDER BY total_recaudado DESC";

// Ejecuta la consulta en la base de datos
$resultado = $conn->query($sql);

// Título principal de la sección
echo "<h2>Resumen de Donaciones por Proyecto (más de 2 donaciones)</h2>";

// Si hay resultados, se recorre cada fila y se muestra la información
if ($resultado->num_rows > 0) {
    while ($fila = $resultado->fetch_assoc()) {
        echo "Proyecto: <strong>" . $fila["nombre_proyecto"] . "</strong><br>";
        echo "Donaciones registradas: " . $fila["total_donaciones"] . "<br>";
        echo "Total recaudado: $" . number_format($fila["total_recaudado"], 0, ",", ".") . "<br><hr>";
    }
} else {
    // Mensaje si ningún proyecto cumple con la condición
    echo "No hay proyectos con más de 2 donaciones.";
}

// Cierra la conexión con la base de datos
$conn->close();
?>

<!-- Enlace para volver a la página principal -->
<br>
<a href="index.html">Volver al inicio</a>

</body>
</html>
