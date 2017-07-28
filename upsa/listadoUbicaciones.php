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
        <th>Descripcion</th>
        <th>Opciones</th>
      </tr>
    </thead>
    <tbody>
      <?php
        $listUbicaciones = $dispositivos->getAllUbicaciones();
        if ($listUbicaciones != false) {
          foreach($listUbicaciones as $ubicacion) {
            echo '<tr>
              <td>'.$ubicacion['sUbicacion_desc'].'</td>
              <td><button onclick="modificarUbicacion(\''.$ubicacion['iUbicacion_id'].'\')">Modificar</button> <button onclick="eliminarUbicacion(\''.$ubicacion['iUbicacion_id'].'\')">Eliminar</button></td>
            </tr>';
          }
        }
      ?>
    </tbody>
  </table>
<script>
  function eliminarUbicacion(iUbicacion_id) {
    $.ajax({
			type:"post",
			url:"acciones.php?op=deleteUbicacion",
			data : {
				iUbicacion_id : iUbicacion_id
      },
			success:function(data){
        location.reload();
			}
		});
  }

  function modificarUbicacion(iUbicacion_id) {
    location.href = 'ubicacion.php?action=modificar&iUbicacion_id='+iUbicacion_id;
  }

</script>
</body>
</html>
