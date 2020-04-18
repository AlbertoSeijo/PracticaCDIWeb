<?php
  $idTipoPedido = "POSTTIPOPEDIDO";
  $tipoPrenda = "POSTTIIPOPRENDA";

  define('SERVIDOR_BD', 'localhost:3306');
  define('USUARIO_BD', 'webtintoreria');
  define('CONTRASENA_BD', 'lavanderia');
  define('NOMBRE_BD', 'tintoreria');

  $db = mysqli_connect(SERVIDOR_BD,USUARIO_BD,CONTRASENA_BD,NOMBRE_BD);

  if ($stmt = $db->prepare('SELECT tEPTP.ordenEtapa, tEPTP.idEtapa, tE.nombre FROM tipoEtapasPorTipoPedido tEPTP, tipoetapa tE WHERE tE.idEtapa = tEPTP.idEtapa AND tEPTP.idTipoPedido = ?')) {
    $stmt->bind_param('s', );//TODO
    $stmt->execute();
    $stmt->store_result();
    if ($stmt->num_rows > 0) {
      //esto se repite por cada empleado
      if ($stmt2 = $db->prepare('SELECT tE.nombre, c.nombre FROM Cuenta c, empleadoPuedeRealizarTipoEtapa ePRTE, tipoetapa tE WHERE tE.idEtapa = ? AND c.idCuenta = ePRTE.idCuenta AND tE.idEtapa = tEPTE.idEtapa')) {
        $stmt2->bind_param('s', );//TODO 
        $stmt2->execute();
        $stmt2->store_result();
        if ($stmt2->num_rows > 0) {

        }
      }
    }
  }

echo '
<label class="etiquetaElementosFormulario" for="aaaa">Lavandería</label>
<select class="custom-select" style="margin-bottom:15px;">
  <option value="1">Empleado 1</option>
  <option value="2">Empleado 2</option>
  <option value="3">Empleado 3</option>
</select>
<label class="etiquetaElementosFormulario" for="aaaa">Modista</label>
<select class="custom-select" style="margin-bottom:15px;">
  <option value="4">Empleado 4</option>
  <option value="5">Empleado 5</option>
  <option value="6">Empleado 6</option>
</select>
<label class="etiquetaElementosFormulario" for="aaaa">Eliminación de manchas</label>
<select class="custom-select" style="margin-bottom:15px;">
  <option value="7">Empleado 7</option>
  <option value="8">Empleado 8</option>
  <option value="9">Empleado 9</option>
</select>
<label class="etiquetaElementosFormulario" for="aaaa">Lavado en seco</label>
<select class="custom-select" style="margin-bottom:15px;">
  <option value="10">Empleado 10</option>
  <option value="11">Empleado 11</option>
  <option value="12">Empleado 12</option>
</select>
<label class="etiquetaElementosFormulario" for="aaaa">Planchado</label>
<select class="custom-select">
  <option value="13">Empleado 13</option>
  <option value="14">Empleado 14</option>
  <option value="15">Empleado 15</option>
</select>
';

?>
