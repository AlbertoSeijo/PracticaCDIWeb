<?php
header("Content-Type: application/json", true);
  session_start();
  define('SERVIDOR_BD', 'localhost:3306');
  define('USUARIO_BD', 'webtintoreria');
  define('CONTRASENA_BD', 'lavanderia');
  define('NOMBRE_BD', 'tintoreria');
  $eA = "";
  $db = mysqli_connect(SERVIDOR_BD,USUARIO_BD,CONTRASENA_BD,NOMBRE_BD);
  if ($stmt = $db->prepare("SELECT teptp.OrdenEtapa, tE.nombre FROM Etapa e, tipoEtapa tE, tipoEtapasPorTipoPedido teptp, Pedido p WHERE e.idPedido = ? AND e.EmpleadoAsignado = ? AND e.idTipoEtapa = teptp.idTipoEtapa AND teptp.idTipoPedido = p.idTipoPedido AND e.idPedido = p.idPedido AND teptp.idTipoEtapa = tE.idTipoEtapa")) {
    $stmt->bind_param("ss", $_POST["idPedido"], $_POST["empleadoAsignado"]);
    $stmt->execute();
    $stmt->store_result();
    $stmt->bind_result($eAo, $eAn);
    while ($stmt->fetch()) {
      echo '{"oEtapaAsignada":"'.$eAo.'","nEtapaAsignada":"'.$eAn.'"}';
    }
  }
?>
