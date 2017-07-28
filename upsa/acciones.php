<?php

  require_once 'clases/dispositivos.php';

  $dispositivos = new Dispositivos();
  $op = $_GET['op'];

  if ($op == 'getEstados') {
    $list = $dispositivos->getAllDispositivos();
    if ($list != false) {
      foreach($list as $dispositivo) {
        echo 'iDispositivo_id = '.$dispositivo['iDispositivo_id'].' - iEstado_fl = '.$dispositivo['iEstado_fl'].'<br>';
      }
    }
  } else if ($op == 'changeDispositivoEstado') {
    $dispositivos->changeDispositivoEstado($_POST['iDispositivo_id'], $_POST['iEstado_fl']);
  } else if ($op == 'changeUbicacionEstado') {
    $dispositivos->changeUbicacionEstado($_POST['iUbicacion_id'], $_POST['iEstado_fl']);
  } else if ($op == 'deleteTipo') {
    $dispositivos->deleteTipo($_POST['iTipo_id']);
  } else if ($op == 'deleteUbicacion') {
    $dispositivos->deleteUbicacion($_POST['iUbicacion_id']);
  } else if ($op == 'deleteDispositivo') {
    $dispositivos->deleteDispositivo($_POST['iDispositivo_id']);
  } else if ($op == 'deleteUsuario') {
    $dispositivos->deleteUsuario($_POST['iUsuario_id']);
  }

?>
