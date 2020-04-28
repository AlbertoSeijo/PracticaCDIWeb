<?php

  session_start();
  define('SERVIDOR_BD', 'localhost:3306');
  define('USUARIO_BD', 'webtintoreria');
  define('CONTRASENA_BD', 'lavanderia');
  define('NOMBRE_BD', 'tintoreria');

  $db = mysqli_connect(SERVIDOR_BD,USUARIO_BD,CONTRASENA_BD,NOMBRE_BD);
  if ($stmtB = $db->prepare("UPDATE pedido p SET p.precioAceptado = 1 WHERE p.idPedido = ?")) {
    $stmtB->bind_param("i", $_POST["idPedido"]);
    $stmtB->execute();
  }

?>
