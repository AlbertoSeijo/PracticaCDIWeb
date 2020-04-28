<?php



$db = mysqli_connect(SERVIDOR_BD,USUARIO_BD,CONTRASENA_BD,NOMBRE_BD);
if ($stmtX = $db->prepare("SELECT tE.nombre FROM Etapa e, tipoEtapa tE, tipoEtapasPorTipoPedido teptp, Pedido p WHERE e.idPedido = ? AND e.EmpleadoAsignado = ? AND e.idTipoEtapa = teptp.idTipoEtapa AND teptp.idTipoPedido = p.idTipoPedido AND e.idPedido = p.idPedido AND teptp.idTipoEtapa = tE.idTipoEtapa")) {
  $stmtX->bind_param("ss", $result["idPedido"], $result["empleadoAsignado"]);
  $stmtX->execute();
  $stmtX->store_result();
  $stmtX->bind_result($tEN);
  while ($stmtX->fetch()) {
    echo "MAL Empleado (arreglar consulta y cambiar echo)".$result["empleadoAsignado"].'
    <div class="card bg-white mx-auto contenedorTipoServicioTipoPrenda">
    <img src="./img/etapas/'.normalizarTexto($tEN).'.svg" class="mx-auto my-auto w-75"></img></div>

    <div class="text-center" style="position: absolute; width: 100px; background-color: white; height: 12px; left:0; right: 0; margin-left: -13px; margin-right: auto; margin-top: 65px; line-height: 18px;">'.$tEN.'</div>
    ';
  }
}
?>
