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
        $listTipos = $dispositivos->getAllTipos();
        if ($listTipos != false) {
          foreach($listTipos as $tipo) {
            echo '<tr>
              <td>'.$tipo['sTipo_desc'].'</td>
              <td><button onclick="modificarTipo(\''.$tipo['iTipo_id'].'\')">Modificar</button> <button onclick="eliminarTipo(\''.$tipo['iTipo_id'].'\')">Eliminar</button></td>
            </tr>';
          }
        }
      ?>
    </tbody>
  </table>
<script>
  function eliminarTipo(iTipo_id) {
    $.ajax({
			type:"post",
			url:"acciones.php?op=deleteTipo",
			data : {
				iTipo_id : iTipo_id
      },
			success:function(data){
        location.reload();
			}
		});
  }

  function modificarTipo(iTipo_id) {
    location.href = 'tipo.php?action=modificar&iTipo_id='+iTipo_id;
  }

</script>
</body>
</html>
