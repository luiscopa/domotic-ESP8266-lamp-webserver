<?php
  session_start();
  if (!isset($_SESSION['logged'])) {
    header('Location: index.php');
  }

  require_once 'clases/dispositivos.php';

  $dispositivos = new Dispositivos();
?>
<!doctype html>
<html lang="es">
<head>
  <script src="public/js/jquery.min.js"></script>
</head>
<body>
  <table border="1" cellpadding="10" style="text-align: center">
    <thead>
      <tr>
        <th>Tipo</th>
        <th>Ubicacion</th>
        <th>Detalle</th>
        <th>Opciones</th>
      </tr>
    </thead>
    <tbody>
      <?php
        $listDispositivos = $dispositivos->listAllDispositivos();
        if ($listDispositivos != false) {
          foreach($listDispositivos as $dispositivo) {
            echo '<tr>
              <td>'.$dispositivo['sTipo_desc'].'</td>
              <td>'.$dispositivo['sUbicacion_desc'].'</td>
              <td>'.$dispositivo['sDispositivo_desc'].'</td>
              <td><button onclick="modificarDispositivo(\''.$dispositivo['iDispositivo_id'].'\')">Modificar</button> <button onclick="eliminarDispositivo(\''.$dispositivo['iDispositivo_id'].'\')">Eliminar</button></td>
            </tr>';
          }
        }
      ?>
    </tbody>
  </table>
<script>
  function eliminarDispositivo(iDispositivo_id) {
    $.ajax({
			type:"post",
			url:"acciones.php?op=deleteDispositivo",
			data : {
				iDispositivo_id : iDispositivo_id
      },
			success:function(data){
        location.reload();
			}
		});
  }

  function modificarDispositivo(iDispositivo_id) {
    location.href = 'dispositivo.php?action=modificar&iDispositivo_id='+iDispositivo_id;
  }

</script>
</body>
</html>
