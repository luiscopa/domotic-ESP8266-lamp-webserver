<?php
  session_start();
  if (!isset($_SESSION['logged'])) {
    header('Location: index.php');
  }

  require_once 'clases/dispositivos.php';
  $dispositivos = new Dispositivos();

  if ($_GET['action'] == 'modificar') {
    if (isset($_POST['submit'])) {
      $dispositivos->modifyUsuario($_POST['iUsuario_id'], $_POST['sUsuario_nm'], $_POST['sUsuario_password'], $_POST['iTipo_id']);
      header('Location: listadoUsuarios.php');
    } else {
      $usuarioData = $dispositivos->getUsuarioData($_GET['iUsuario_id']);
      if ($usuarioData != false) {
        $iUsuario_id = $usuarioData['iUsuario_id'];
        $sUsuario_nm = $usuarioData['sUsuario_nm'];
        $sUsuario_password = $usuarioData['sUsuario_password'];
        $iTipo_id = $usuarioData['iTipo_id'];
      }
    }
  } else if ($_GET['action'] == 'agregar') {
    if (isset($_POST['submit'])) {
      $dispositivos->newUsuario($_POST['sUsuario_nm'], $_POST['sUsuario_password'], $_POST['iTipo_fl']);
      header('Location: listadoUsuarios.php');
    } else {
      $iUsuario_id = '';
      $sUsuario_nm = '';
      $sUsuario_password = '';
      $iTipo_id = '';
    }
  }
?>

<form method="POST">
  <input type="hidden" name="iUsuario_id" value="<?php echo $iUsuario_id; ?>">
  <label>Nombre de Usuario:</label>
  <input type="text" name="sUsuario_nm" value="<?php echo $sUsuario_nm; ?>">
  <br><br>
  <label>Contraseña:</label>
  <input type="password" name="sUsuario_password" value="<?php echo $sUsuario_password; ?>">
  <br><br>
  <label>Tipo de Usuario:</label>
  <select name="iTipo_id">
    <option>Seleccionar Tipo</option>
    <?php
      $listTipos = $dispositivos->getAllTipoUsuarios();
      if ($listTipos != false) {
        foreach ($listTipos as $tipo) {
          if ($iTipo_id == $tipo['iTipo_id']) {
            $selected = ' selected';
          } else {
            $selected = '';
          }
          echo '<option value="'.$tipo['iTipo_id'].'"'.$selected.'>'.$tipo['sTipo_desc'].'</option>';
        }
      }
    ?>
  </select>
  <br><br>
  <input type="submit" name="submit" value="<?php echo $_GET['action']; ?>">
  <input type="button" onclick="location.href='listadoUsuarios.php'" value="volver">
</form>
