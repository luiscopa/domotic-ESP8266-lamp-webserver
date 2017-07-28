<?php
  session_start();
  if (!isset($_SESSION['logged'])) {
    header('Location: index.php');
  }

  require_once 'clases/dispositivos.php';
  $dispositivos = new Dispositivos();

  if ($_GET['action'] == 'modificar') {
    if (isset($_POST['submit'])) {
      $dispositivos->modifyUbicacion($_POST['iUbicacion_id'], $_POST['sUbicacion_desc']);
      header('Location: listadoUbicaciones.php');
    } else {
      $ubicacionData = $dispositivos->getUbicacionData($_GET['iUbicacion_id']);
      if ($ubicacionData != false) {
        $iUbicacion_id = $ubicacionData['iUbicacion_id'];
        $sUbicacion_desc = $ubicacionData['sUbicacion_desc'];
      }
    }
  } else if ($_GET['action'] == 'agregar') {
    if (isset($_POST['submit'])) {
      $dispositivos->newUbicacion($_POST['sUbicacion_desc']);
      header('Location: listadoUbicaciones.php');
    } else {
      $iUbicacion_id = '';
      $sUbicacion_desc = '';
    }
  }
?>

<form method="POST">
  <input type="hidden" name="iUbicacion_id" value="<?php echo $iUbicacion_id; ?>" readonly>
  <label>Descripcion:</label>
  <input type="text" name="sUbicacion_desc" value="<?php echo $sUbicacion_desc; ?>">
  <br><br>
  <input type="submit" name="submit" value="<?php echo $_GET['action']; ?>">
  <input type="button" onclick="location.href='listadoUbicaciones.php'" value="volver">
</form>
