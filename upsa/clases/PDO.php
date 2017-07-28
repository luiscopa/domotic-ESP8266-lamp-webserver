<?php

  class DB {

    public function connect() {
      $config = array(
        'server' => 'localhost',
        'usuario' => 'root',
        'pass' => 'websocket',
        'dbname' => 'pruebacasa'
      );

      try {
        $conn = new PDO('mysql:host='.$config['server'].';dbname='.$config['dbname'].';charset=utf8', $config['usuario'], $config['pass']);
        // set the PDO error mode to exception
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $conn;
      }
      catch(PDOException $e)
      {
        echo "Connection failed: " . $e->getMessage();
      }
    }
  }

?>
