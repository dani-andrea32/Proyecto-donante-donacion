<?php
// Incluye el archivo que establece la conexión con la base de datos
include "conexion.php";

// Recupera los datos enviados por el formulario usando el método POST
$id_proyecto = $_POST["id_proyecto"];  
$id_donante = $_POST["id_donante"];    
$monto = floatval($_POST["monto"]);    
$fecha = date("Y-m-d");               

// Verifica que el monto ingresado sea mayor a 0 //
if ($monto <= 0) {
    // Detiene la ejecución si el monto es inválido
    die("El monto debe ser mayor que cero.");
}

// Usa sentencia preparada para evitar inyección SQL //
$stmt = $conn->prepare("INSERT INTO DONACION (monto, fecha, id_proyecto, id_donante) VALUES (?, ?, ?, ?)");
$stmt->bind_param("dsii", $monto, '$fecha', $id_proyecto, $id_donante);

// Ejecuta la consulta y verifica si fue exitosa
if ($stmt->execute()) {
    // Muestra un mensaje si la donación se registró correctamente
    echo "Donación registrada correctamente.";
} else {
    // Muestra un mensaje de error si la consulta falló
    echo "Error: " . $stmt->error;
}

// Cierra la conexión con la base de datos
$stmt->close();
$conn->close();
?>


