<?php
  if (!isset($_POST["cargadoDesdePagina"]) ) {//Así se sabe si se ha llamado directamente al fichero
    header("Location: ./");
  }
  include './commonFunctions.php';

  $idTipoPedido = $_POST["idTipoPedido"];

  define('SERVIDOR_BD', 'localhost:3306');
  define('USUARIO_BD', 'webtintoreria');
  define('CONTRASENA_BD', 'lavanderia');
  define('NOMBRE_BD', 'tintoreria');

  $db = mysqli_connect(SERVIDOR_BD,USUARIO_BD,CONTRASENA_BD,NOMBRE_BD);

  if ($stmtA = $db->prepare('SELECT tEPTP.ordenEtapa, tEPTP.idTipoEtapa, tE.nombre FROM tipoEtapasPorTipoPedido tEPTP, tipoetapa tE WHERE tE.idTipoEtapa = tEPTP.idTipoEtapa AND tEPTP.idTipoPedido = ? ORDER BY tEPTP.OrdenEtapa ASC')) {
    $stmtA->bind_param('s', $idTipoPedido);
    $stmtA->execute();
    $stmtA->store_result();
    $stmtA->bind_result($ordenEtapa, $idEtapa, $nombreEtapa);

    while ($stmtA->fetch()) {
      if ($stmtB = $db->prepare('SELECT c.nombre, c.apellidos, c.idCuenta FROM Cuenta c, empleadoPuedeRealizarTipoEtapa ePRTE, tipoetapa tE WHERE tE.idTipoEtapa = ? AND c.idCuenta = ePRTE.idCuenta AND tE.idTipoEtapa = ePRTE.idTipoEtapa')) {
        $stmtB->bind_param('s', $idEtapa);
        $stmtB->execute();
        $stmtB->store_result();
        $stmtB->bind_result($nombreEmpleado, $apellidosEmpleado, $idEmpleado);
        if(normalizarTexto($nombreEtapa) != "findepedido"){
          echo '<label class="etiquetaElementosFormulario" for="aaaa">'.$nombreEtapa.'</label><select id="empleadoEtapa'.normalizarTexto($nombreEtapa).'" name="empleadoEtapa'.normalizarTexto($nombreEtapa).'" class="custom-select" form="peticionLimpiezaForm" style="margin-bottom:10px;">';
          while ($stmtB->fetch()) {
            echo '<option value="'.$idEmpleado.'">'.$nombreEmpleado.' '.$apellidosEmpleado.'</option>';
          }
          echo '</select>';
        }
      }
    }
  }
?>
