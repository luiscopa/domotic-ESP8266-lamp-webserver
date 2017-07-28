<?php

  require_once 'PDO.php';

  class Usuario {

    public function userExists($sUsuario_nm, $sUsuario_password) {
      $db = new DB();
      $sql = $db->connect();
      $res = $sql->query('SELECT * FROM usuarios WHERE sUsuario_nm = \''.$sUsuario_nm.'\' AND sUsuario_password = \''.$sUsuario_password.'\'');
      return $res->fetch();
    }

  }

?>
