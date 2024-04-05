<?php
require_once("lib/nusoap.php");

// Verificar si se han enviado datos mediante el método POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verificar si los datos del formulario han sido establecidos
    if (isset($_POST['id']) && isset($_POST['nombre']) && isset($_POST['ubicacion']) && isset($_POST['descripcion'])) {
        $id = $_POST['id'];
        $nombre = $_POST['nombre'];
        $ubicacion = $_POST['ubicacion'];
        $descripcion = $_POST['descripcion'];
        
        // Llamar a la función para modificar el sitio turístico
        $urlws = new nusoap_client("http://localhost/caso4-server/turismoservices.php");
        $resultado = $urlws->call('modificarstios_turisticos', array('id' => $id, 'nombre' => $nombre, 'ubicacion' => $ubicacion, 'descripcion' => $descripcion));
        
        // Verificar el resultado y mostrar un mensaje apropiado
        if ($resultado === json_encode(true)) {
            echo 'Sitio turístico modificado correctamente.';
        } else {
            echo 'Error al modificar el sitio turístico.';
        }
    } else {
        // Si los datos del formulario no están establecidos, muestra un mensaje de error
        echo 'Por favor, complete todos los campos del formulario.';
    }
} else {
    // Si no se ha enviado nada mediante POST, redirecciona a la página de inicio o realiza otra acción apropiada
    header("Location: index.php");
    exit();
}
?>
<br>
<a href="index.php">Regresar</a>
