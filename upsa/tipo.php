<?php
  session_start();
  if (!isset($_SESSION['logged'])) {
    header('Location: index.php');
  }

  require_once 'clases/dispositivos.php';
  $dispositivos = new Dispositivos();

  if ($_GET['action'] == 'modificar') {
    if (isset($_POST['submit'])) {
      $dispositivos->modifyTipo($_POST['iTipo_id'], $_POST['sTipo_desc']);
      header('Location: listadoTipos.php');
    } else {
      $tipoData = $dispositivos->getTipoData($_GET['iTipo_id']);
      if ($tipoData != false) {
        $iTipo_id = $tipoData['iTipo_id'];
        $sTipo_desc = $tipoData['sTipo_desc'];
      }
    }
  } else if ($_GET['action'] == 'agregar') {
    if (isset($_POST['submit'])) {
      $dispositivos->newTipo($_POST['sTipo_desc']);
      header('Location: listadoTipos.php');
    } else {
      $iTipo_id = '';
      $sTipo_desc = '';
    }
  }
?>

<form method="POST">
  <input type="hidden" name="iTipo_id" value="<?php echo $iTipo_id; ?>" readonly>
  <label>Descripcion:</label>
  <input type="text" name="sTipo_desc" value="<?php echo $sTipo_desc; ?>">
  <br><br>
  <input type="submit" name="submit" value="<?php echo $_GET['action']; ?>">
  <input type="button" onclick="location.href='listadoTipos.php'" value="volver">
</form>
