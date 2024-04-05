<?php
// Verificar si se ha pasado el parámetro 'id' en la URL
if(isset($_GET['id'])) {
    $id = $_GET['id'];
    require_once("lib/nusoap.php");
    $urlws = new nusoap_client("http://localhost/caso4-server/turismoservices.php");
    // Llamar al método del servicio web para eliminar el sitio turístico por su ID
    $eliminar = $urlws->call('eliminarstios_turisticos', array('id' => $id));
    echo "Sitio turístico eliminado correctamente.";
} else {
    echo "No se ha proporcionado el ID del sitio turístico a eliminar.";
}
?>
<br>
<a href="index.php">Regresar</a>
