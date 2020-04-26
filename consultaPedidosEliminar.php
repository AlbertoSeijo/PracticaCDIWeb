<?php
if ( basename(__FILE__) == basename($_SERVER["SCRIPT_FILENAME"]) ) {//Así se sabe si se ha llamado directamente al fichero
  header("Location: ./");
}
  session_start();
  define('SERVIDOR_BD', 'localhost:3306');
  define('USUARIO_BD', 'webtintoreria');
  define('CONTRASENA_BD', 'lavanderia');
  define('NOMBRE_BD', 'tintoreria');

  $estaCancelado = false;
  if($_POST["eliminarPedido"] == "Eliminar") {
    $estaCancelado = 1;
  } else if ($_POST["eliminarPedido"] == "Deshacer") {
    $estaCancelado = 0;
  }
  $db = mysqli_connect(SERVIDOR_BD,USUARIO_BD,CONTRASENA_BD,NOMBRE_BD);
  if ($stmt = $db->prepare("UPDATE Pedido SET estaCancelado = " . $estaCancelado . " WHERE idPedido = ?")) {
    $stmt->bind_param("i", $_POST["idPedido"]);
    $stmt->execute();
  }
?>
