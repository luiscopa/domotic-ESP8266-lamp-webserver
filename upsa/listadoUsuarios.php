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
        <th>Nombre de Usuario</th>
        <th>Opciones</th>
      </tr>
    </thead>
    <tbody>
      <?php
        $listUsuarios = $dispositivos->getAllUsuarios();
        if ($listUsuarios != false) {
          foreach($listUsuarios as $usuario) {
            echo '<tr>
              <td>'.$usuario['sUsuario_nm'].'</td>
              <td><button onclick="modificarUsuario(\''.$usuario['iUsuario_id'].'\')">Modificar</button> <button onclick="eliminarUsuario(\''.$usuario['iUsuario_id'].'\')">Eliminar</button></td>
            </tr>';
          }
        }
      ?>
    </tbody>
  </table>
<script>
  function eliminarUsuario(iUsuario_id) {
    $.ajax({
			type:"post",
			url:"acciones.php?op=deleteUsuario",
			data : {
				iUsuario_id : iUsuario_id
      },
			success:function(data){
        location.reload();
			}
		});
  }

  function modificarUsuario(iUsuario_id) {
    location.href = 'usuario.php?action=modificar&iUsuario_id='+iUsuario_id;
  }

</script>
</body>
</html>
