<?php

  require_once 'PDO.php';

  class Dispositivos {

    public function getAllUbicaciones() {
      $db = new DB();
      $sql = $db->connect();
      $res = $sql->query('SELECT * FROM ubicaciones');
      return $res->fetchAll();
    }

    public function getAllDispositivosByUbicacion($iUbicacion_id) {
      $db = new DB();
      $sql = $db->connect();
      $res = $sql->query('SELECT d.*, t.sTipo_desc as tipo FROM dispositivos as d LEFT JOIN tipos as t ON t.iTipo_id = d.iTipo_id WHERE iUbicacion_id = \''.$iUbicacion_id.'\'');
      return $res->fetchAll();
    }

    public function getAllDispositivos() {
      $db = new DB();
      $sql = $db->connect();
      $res = $sql->query('SELECT iDispositivo_id, iEstado_fl FROM dispositivos');
      return $res->fetchAll();
    }

    public function listAllDispositivos() {
      $db = new DB();
      $sql = $db->connect();
      $res = $sql->query('SELECT d.*, t.sTipo_desc, u.sUbicacion_desc FROM dispositivos as d LEFT JOIN tipos as t ON t.iTipo_id = d.iTipo_id LEFT JOIN ubicaciones as u ON u.iUbicacion_id = d.iUbicacion_id');
      return $res->fetchAll();
    }

    public function getAllUsuarios() {
      $db = new DB();
      $sql = $db->connect();
      $res = $sql->query('SELECT * FROM usuarios');
      return $res->fetchAll();
    }

    public function getAllTipos() {
      $db = new DB();
      $sql = $db->connect();
      $res = $sql->query('SELECT * FROM tipos');
      return $res->fetchAll();
    }

    public function getAllTipoUsuarios() {
      $db = new DB();
      $sql = $db->connect();
      $res = $sql->query('SELECT * FROM tipousuarios');
      return $res->fetchAll();
    }

    public function getTipoData($iTipo_id) {
      $db = new DB();
      $sql = $db->connect();
      $res = $sql->query('SELECT * FROM tipos WHERE iTipo_id = \''.$iTipo_id.'\'');
      return $res->fetch();
    }

    public function getDispositivoData($iDispositivo_id) {
      $db = new DB();
      $sql = $db->connect();
      $res = $sql->query('SELECT * FROM dispositivos WHERE iDispositivo_id = \''.$iDispositivo_id.'\'');
      return $res->fetch();
    }

    public function getUbicacionData($iUbicacion_id) {
      $db = new DB();
      $sql = $db->connect();
      $res = $sql->query('SELECT * FROM ubicaciones WHERE iUbicacion_id = \''.$iUbicacion_id.'\'');
      return $res->fetch();
    }

    public function getUsuarioData($iUsuario_id) {
      $db = new DB();
      $sql = $db->connect();
      $res = $sql->query('SELECT * FROM usuarios WHERE iUsuario_id = \''.$iUsuario_id.'\'');
      return $res->fetch();
    }

    public function deleteTipo($iTipo_id) {
      $db = new DB();
      $sql = $db->connect();
      return $sql->query('DELETE FROM tipos WHERE iTipo_id = \''.$iTipo_id.'\'');
    }

    public function deleteUsuario($iUsuario_id) {
      $db = new DB();
      $sql = $db->connect();
      return $sql->query('DELETE FROM usuarios WHERE iUsuario_id = \''.$iUsuario_id.'\'');
    }

    public function deleteUbicacion($iUbicacion_id) {
      $db = new DB();
      $sql = $db->connect();
      return $sql->query('DELETE FROM ubicaciones WHERE iUbicacion_id = \''.$iUbicacion_id.'\'');
    }

    public function deleteDispositivo($iDispositivo_id) {
      $db = new DB();
      $sql = $db->connect();
      return $sql->query('DELETE FROM dispositivos WHERE iDispositivo_id = \''.$iDispositivo_id.'\'');
    }

    public function changeDispositivoEstado($iDispositivo_id, $iEstado_fl) {
      $db = new DB();
      $sql = $db->connect();
      return $sql->query('UPDATE dispositivos SET iEstado_fl = \''.$iEstado_fl.'\' WHERE iDispositivo_id = \''.$iDispositivo_id.'\'');
    }

    public function changeUbicacionEstado($iUbicacion_id, $iEstado_fl) {
      $db = new DB();
      $sql = $db->connect();
      return $sql->query('UPDATE dispositivos SET iEstado_fl = \''.$iEstado_fl.'\' WHERE iUbicacion_id = \''.$iUbicacion_id.'\'');
    }

    public function modifyTipo($iTipo_id, $sTipo_desc) {
      $db = new DB();
      $sql = $db->connect();
      return $sql->query('UPDATE tipos SET sTipo_desc = \''.$sTipo_desc.'\' WHERE iTipo_id = \''.$iTipo_id.'\'');
    }

    public function newTipo($sTipo_desc) {
      $db = new DB();
      $sql = $db->connect();
      return $sql->query('INSERT INTO tipos(sTipo_desc) VALUES (\''.$sTipo_desc.'\')');
    }

    public function modifyUbicacion($iUbicacion_id, $sUbicacion_desc) {
      $db = new DB();
      $sql = $db->connect();
      return $sql->query('UPDATE ubicaciones SET sUbicacion_desc = \''.$sUbicacion_desc.'\' WHERE iUbicacion_id = \''.$iUbicacion_id.'\'');
    }

    public function newUbicacion($sUbicacion_desc) {
      $db = new DB();
      $sql = $db->connect();
      return $sql->query('INSERT INTO ubicaciones(sUbicacion_desc) VALUES (\''.$sUbicacion_desc.'\')');
    }

    public function modifyDispositivo($iDispositivo_id, $iTipo_id, $iUbicacion_id, $sDispositivo_desc) {
      $db = new DB();
      $sql = $db->connect();
      return $sql->query('UPDATE dispositivos SET iTipo_id = \''.$iTipo_id.'\', iUbicacion_id = \''.$iUbicacion_id.'\', sDispositivo_desc = \''.$sDispositivo_desc.'\' WHERE iDispositivo_id = \''.$iDispositivo_id.'\'');
    }

    public function newDispositivo($iDispositivo_id, $iTipo_id, $iUbicacion_id, $sDispositivo_desc) {
      $db = new DB();
      $sql = $db->connect();
      return $sql->query('INSERT INTO dispositivos(iDispositivo_id, iTipo_id, iUbicacion_id, sDispositivo_desc) VALUES (\''.$iDispositivo_id.'\', \''.$iTipo_id.'\', \''.$iUbicacion_id.'\', \''.$sDispositivo_desc.'\')');
    }

    public function newUsuario($sUsuario_nm, $sUsuario_password, $iTipo_id) {
      $db = new DB();
      $sql = $db->connect();
      return $sql->query('INSERT INTO usuarios(sUsuario_nm, sUsuario_password, iTipo_id) VALUES (\''.$sUsuario_nm.'\', \''.$sUsuario_password.'\', \''.$iTipo_id.'\')');
    }

    public function getLatestDispositivoId() {
      $db = new DB();
      $sql = $db->connect();
      $res = $sql->query('SELECT * FROM dispositivos ORDER BY iDispositivo_id DESC LIMIT 1');
      $data = $res->fetch();
      return ($data['iDispositivo_id'] + 1);
    }

    public function modifyUsuario($iUsuario_id, $sUsuario_nm, $sUsuario_password, $iTipo_id) {
      $db = new DB();
      $sql = $db->connect();
      return $sql->query('UPDATE usuarios SET sUsuario_nm = \''.$sUsuario_nm.'\', sUsuario_password = \''.$sUsuario_password.'\', iTipo_id = \''.$iTipo_id.'\' WHERE iUsuario_id = \''.$iUsuario_id.'\'');
    }

  }

?>
