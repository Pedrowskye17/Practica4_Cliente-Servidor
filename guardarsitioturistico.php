<?php
    $nombre= $_POST['nombre'];
    $ubicacion= $_POST['ubicacion'];
    $descripcion= $_POST['descripcion'];
    require_once("lib/nusoap.php");
    $urlws=new nusoap_client("http://localhost/caso4-server/turismoservices.php");
    $insertar= $urlws->call('insertarstios_turisticos',array('nombre'=>$nombre,'ubicacion'=>$ubicacion,'descripcion'=>$descripcion));
    echo '<a href="index.php">Regresar</a>';
?>
