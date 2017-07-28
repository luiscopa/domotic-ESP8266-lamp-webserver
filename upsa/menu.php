<?php
  session_start();
  if (!isset($_SESSION['logged'])) {
    header('Location: index.php');
  }

  require_once 'clases/dispositivos.php';
  $dispositivos = new Dispositivos();
  $userData = $dispositivos->getUsuarioData($_SESSION['iUsuario_id']);
?>
<center>
  <?php if ($userData['iTipo_id'] == 1) { ?>
  <table cellpadding="10">
    <tbody>
      <tr>
        <td colspan="3" style="text-align: center"><b>Menu Principal</b></td>
      </tr>
      <tr>
        <td>
          <table border="1" cellpadding="20" style="text-align: center">
            <thead>
              <tr>
                <th>Tipos</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td><a target="_blank" href="listadoTipos.php">Lista de tipos</a></td>
              </tr>
              <tr>
                <td><a target="_blank" href="tipo.php?action=agregar">Agregar nuevo tipo</a></td>
              </tr>
            </tbody>
          </table>
        </td>
        <td>
          <table border="1" cellpadding="20" style="text-align: center">
            <thead>
              <tr>
                <th>Ubicaciones</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td><a target="_blank" href="listadoUbicaciones.php">Lista de ubicaciones</a></td>
              </tr>
              <tr>
                <td><a target="_blank" href="ubicacion.php?action=agregar">Agregar nueva ubicacion</a></td>
              </tr>
            </tbody>
          </table>
        </td>
        <td>
          <table border="1" cellpadding="20" style="text-align: center">
            <thead>
              <tr>
                <th>Dispositivos</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td><a target="_blank" href="listadoDispositivos.php">Lista de dispositivos</a></td>
              </tr>
              <?php if ($dispositivos->getLatestDispositivoId() <= 6) { ?>
              <tr>
                <td><a target="_blank" href="dispositivo.php?action=agregar">Agregar nuevo dispositivo</a></td>
              </tr>
              <?php } ?>
            </tbody>
          </table>
        </td>
      </tr>
    </tbody>
  </table>
  <?php } ?>
  <table cellpadding="10">
    <tbody>
      <tr>
        <td colspan="3" style="text-align: center"><b>Administracion Especial</b></td>
      </tr>
      <tr>
        <?php if ($userData['iTipo_id'] == 1) { ?>
        <td>
          <table border="1" cellpadding="20" style="text-align: center">
            <thead>
              <tr>
                <th>Usuarios</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td><a href="listadoUsuarios.php" target="_blank">Lista de usuarios</a></td>
              </tr>
              <tr>
                <td><a href="usuario.php?action=agregar" target="_blank">Agregar nuevo usuario</a></td>
              </tr>
            </tbody>
          </table>
        </td>
        <?php } ?>
        <td>
          <table border="1" cellpadding="20" style="text-align: center">
            <thead>
              <tr>
                <th>Hogar</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td><a href="listadoGeneral.php" target="_blank">Administracion del Hogar</a></td>
              </tr>
            </tbody>
          </table>
        </td>
      </tr>
    </tbody>
  </table>
</center>
