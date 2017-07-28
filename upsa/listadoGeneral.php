<?php
  session_start();
  if (!isset($_SESSION['logged'])) {
    header('Location: index.php');
  }
?>
<!doctype html>
<html lang="es">
<head>
  <script src="public/js/jquery.min.js"></script>
</head>
<body>
<?php

  require_once 'clases/dispositivos.php';

  $dispositivos = new Dispositivos();

  $listUbicaciones = $dispositivos->getAllUbicaciones();

  if ($listUbicaciones != false) {
    foreach ($listUbicaciones as $ubicacion) {
      $i = 0;
      $table = '';
      $table .= '<h3>'.$ubicacion['sUbicacion_desc'].' <button onclick="changeUbicacionEstado(\''.$ubicacion['iUbicacion_id'].'\',\'1\')">Encender Todos</button> <button onclick="changeUbicacionEstado(\''.$ubicacion['iUbicacion_id'].'\',\'0\')">Apagar Todos</button></h3>';
      $table .= '<table border="1" cellpadding="10">
        <thead>
          <tr>
            <th>Nombre</th>
            <th>Tipo</th>
            <th>Estado</th>
          </tr>
        </thead>
        <tbody>';
      $listDispositivos = $dispositivos->getAllDispositivosByUbicacion($ubicacion['iUbicacion_id']);

      if ($listDispositivos != false) {
        foreach ($listDispositivos as $dispositivo) {
          $i++;
          $table .= '<tr>
                  <td>'.$dispositivo['sDispositivo_desc'].'</td>
                  <td>'.$dispositivo['tipo'].'</td>
                  <td><button onclick="changeDispositivoEstado(\''.$dispositivo['iDispositivo_id'].'\', \'1\')">Enceder</button> <button onclick="changeDispositivoEstado(\''.$dispositivo['iDispositivo_id'].'\', \'0\')">Apagar</button></td>
                </tr>';
        }
      }
      $table .= '</tbody>
            </table>';
      if ($i > 0) {
        echo $table;
      }
    }
  }
?>

<script>
  function changeDispositivoEstado(iDispositivo_id, iEstado_fl) {
    $.ajax({
			type:"post",
			url:"acciones.php?op=changeDispositivoEstado",
			data : {
				iDispositivo_id : iDispositivo_id,
        iEstado_fl : iEstado_fl
			},
			success:function(data){
			}
		});
  }

  function changeUbicacionEstado(iUbicacion_id, iEstado_fl) {
    $.ajax({
			type:"post",
			url:"acciones.php?op=changeUbicacionEstado",
			data : {
				iUbicacion_id : iUbicacion_id,
        iEstado_fl : iEstado_fl
			},
			success:function(data){
			}
		});
  }
</script>
</body>
</html>
