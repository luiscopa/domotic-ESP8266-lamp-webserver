<?php
  session_start();
  if (!isset($_SESSION['logged'])) {
    header('Location: index.php');
  }

  require_once 'clases/dispositivos.php';
  $dispositivos = new Dispositivos();

  if ($_GET['action'] == 'modificar') {
    if (isset($_POST['submit'])) {
      $dispositivos->modifyDispositivo($_POST['iDispositivo_id'], $_POST['iTipo_id'], $_POST['iUbicacion_id'], $_POST['sDispositivo_desc']);
      header('Location: listadoDispositivos.php');
    } else {
      $dispositivoData = $dispositivos->getDispositivoData($_GET['iDispositivo_id']);
      if ($dispositivoData != false) {
        $iDispositivo_id = $dispositivoData['iDispositivo_id'];
        $iTipo_id = $dispositivoData['iTipo_id'];
        $iUbicacion_id = $dispositivoData['iUbicacion_id'];
        $sDispositivo_desc = $dispositivoData['sDispositivo_desc'];
      }
    }
  } else if ($_GET['action'] == 'agregar') {
    if (isset($_POST['submit'])) {
      $dispositivos->newDispositivo($_POST['iDispositivo_id'], $_POST['iTipo_id'], $_POST['iUbicacion_id'], $_POST['sDispositivo_desc']);
      header('Location: listadoDispositivos.php');
    } else {
      $iDispositivo_id = $dispositivos->getLatestDispositivoId();
      $iTipo_id = '';
      $iUbicacion_id = '';
      $sDispositivo_desc = '';
    }
  }
?>

<form method="POST">
  <input type="hidden" name="iDispositivo_id" value="<?php echo $iDispositivo_id; ?>">
  <label>Tipo:</label>
  <select name="iTipo_id">
      <option>Seleccionar Tipo</option>
      <?php
        $listTipos = $dispositivos->getAllTipos();
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
  <label>Tipo:</label>
  <select name="iUbicacion_id">
      <option>Seleccionar Ubicacion</option>
      <?php
        $listUbicaciones = $dispositivos->getAllUbicaciones();
        if ($listUbicaciones != false) {
          foreach ($listUbicaciones as $ubicacion) {
            if ($iUbicacion_id == $ubicacion['iUbicacion_id']) {
              $selected = ' selected';
            } else {
              $selected = '';
            }
            echo '<option value="'.$ubicacion['iUbicacion_id'].'"'.$selected.'>'.$ubicacion['sUbicacion_desc'].'</option>';
          }
        }
      ?>
  </select>
  <br><br>
  <input type="text" name="sDispositivo_desc" value="<?php echo $sDispositivo_desc; ?>">
  <br><br>
  <input type="submit" name="submit" value="<?php echo $_GET['action']; ?>">
  <input type="button" onclick="location.href='listadoDispositivos.php'" value="volver">
</form>
