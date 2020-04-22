<?php
  $idTipoPedido = $_POST["idTipoPedido"];

  define('SERVIDOR_BD', 'localhost:3306');
  define('USUARIO_BD', 'webtintoreria');
  define('CONTRASENA_BD', 'lavanderia');
  define('NOMBRE_BD', 'tintoreria');

  $db = mysqli_connect(SERVIDOR_BD,USUARIO_BD,CONTRASENA_BD,NOMBRE_BD);

  if ($stmtA = $db->prepare('SELECT tEPTP.ordenEtapa, tEPTP.idEtapa, tE.nombre FROM tipoEtapasPorTipoPedido tEPTP, tipoetapa tE WHERE tE.idEtapa = tEPTP.idEtapa AND tEPTP.idTipoPedido = ? ORDER BY tEPTP.OrdenEtapa ASC')) {
    $stmtA->bind_param('s', $idTipoPedido);
    $stmtA->execute();
    $stmtA->store_result();
    $stmtA->bind_result($ordenEtapa, $idEtapa, $nombreEtapa);

    while ($stmtA->fetch()) {

      //esto se repite por cada empleado
      if ($stmtB = $db->prepare('SELECT c.nombre, c.apellidos, c.idCuenta FROM Cuenta c, empleadoPuedeRealizarTipoEtapa ePRTE, tipoetapa tE WHERE tE.idEtapa = ? AND c.idCuenta = ePRTE.idCuenta AND tE.idEtapa = ePRTE.idEtapa')) {
        $stmtB->bind_param('s', $idEtapa);
        $stmtB->execute();
        $stmtB->store_result();
        $stmtB->bind_result($nombreEmpleado, $apellidosEmpleado, $idEmpleado);
        echo '<label class="etiquetaElementosFormulario" for="aaaa">'.$nombreEtapa.'</label><select class="custom-select" style="margin-bottom:15px;">';
        while ($stmtB->fetch()) {
          echo '<option value="'.$idEmpleado.'">'.$nombreEmpleado.' '.$apellidosEmpleado.'</option>';
        }
      }
      echo '</select>';
    }
  }
?>
