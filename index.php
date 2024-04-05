<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sitios Turisticos</title>
</head>
<body>
    <h1>Lista de sitios turisticos</h1>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <a  href="nuevositioturistico.php">agregar sitio turisticos</a>
    <br>
    <?php
      require_once("lib/nusoap.php");
      $urlws = new nusoap_client("http://localhost/caso4-server/turismoservices.php");
      $datos = json_decode($urlws->call('obtenerstios_turisticos'), true);
      // var_dump($datos);
      echo '<table class="table table-success table-striped">';
      echo "<thead><tr>
      <th>Id</th>  <th>Nombre</th>  <th>Ubicacion</th> <th>Descripcion</th> <th>Acciones</th> <th>Acciones</th>
      </tr></thead>";
      foreach ($datos as $item) {
          echo '<tr>';
          echo '<td>' . $item['Id'] . '</td>'; // Accediendo al elemento del array usando []
          echo '<td>' . $item['Nombre'] . '</td>'; // Accediendo al elemento del array usando []
          echo '<td>' . $item['Ubicacion'] . '</td>'; // Accediendo al elemento del array usando []
          echo '<td>' . $item['Descripcion'] . '</td>'; // Accediendo al elemento del array usando []
          echo "<td><a href='Modificarsitiosturisticos.php?id=" . $item['Id'] . "'>Modificar</a></td>"; // Accediendo al elemento del array usando []
          echo "<td><a href='borrarsitiosturisticos.php?id=" . $item['Id'] . "'>Eliminar</a></td>"; // Accediendo al elemento del array usando []
          echo '</tr>';
      }
    ?>
</body>
</html>

