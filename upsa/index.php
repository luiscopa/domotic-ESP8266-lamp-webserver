<?php

  session_start();

  require_once 'clases/usuario.php';

  $usuario = new Usuario();

  if (isset($_POST['submit'])) {
    if ($_POST['sUsuario_nm'] != '' && $_POST['sUsuario_password'] != '') {
      $userData = $usuario->userExists($_POST['sUsuario_nm'], $_POST['sUsuario_password']);
      if ($userData != false) {
        $_SESSION['iUsuario_id'] = $userData['iUsuario_id'];
        $_SESSION['logged'] = true;
      }
    }
  }

  if (isset($_SESSION['logged'])) {
    header('Location: menu.php');
  }

?>

<form method="POST">
  <input type="text" name="sUsuario_nm">
  <input type="password" name="sUsuario_password">
  <input type="submit" name="submit" value="Login">
</form>
