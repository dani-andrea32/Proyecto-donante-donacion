<?php
// Función que procesa la donación recibida //
function procesarDonacion($monto) {
  // Verifica que el monto a ingresar sea numérico y mayor a cero //
  if (is_numeric($monto) && $monto > 0) {
      // Hace retornar un mensaje de agradecimiento //
      return "¡Gracias por donar $$monto!";
  } else {
      // Si el monto ingresado no es válido, solicita ingresar un valor correcto //
      return "Ingresar un monto válido para la donación.";
  }
}



// Verifica si el formulario fue enviado mediante el método POST //
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Sanitiza el valor recibido desde el formulario para evitar inyecciones de código //
  $monto = htmlspecialchars($_POST["donacion"]);
  // Hace un llamado a la función para procesar la donación y guarda el mensaje de respuesta //
  $mensaje = procesarDonacion($monto);
}
?>



<!--Estructura HTML para mostrar resultado donación-->
<!DOCTYPE html>
<html lang="es">
  <head>
      <meta charset="UTF-8">
      <title>Donación confirmada</title>
  </head>
  <body>
      <h2>Resultado de la donación</h2>



      <!--Muestra el mensaje de agradecimiento o error generado por la función-->
      <p><?php echo $mensaje; ?></p>



      <!--Enlace para volver al sitio principal-->
      <a href="index.html">Volver al sitio principal</a>
  </body>
</html>
