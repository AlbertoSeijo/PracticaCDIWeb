<?php
header("Content-Type: application/json", true);
define('SERVIDOR_BD', 'localhost:3306');
define('USUARIO_BD', 'webtintoreria');
define('CONTRASENA_BD', 'lavanderia');
define('NOMBRE_BD', 'tintoreria');



$idPedido = $_POST["idPedido"];//Esto tambien se recibe
$ordenEtapaVista = $_POST["ordenVerEtapa"]; //2;//esto se recibe ...., al principio es igual que la actual, pero luego indica la que se ve
$ordenEtapaActualReal = $_POST["ordenEtapaActual"];//3;//Esto se recibe por post de consultaPedidos

function calcularPrecioTotal($precioBasePedido, $precioDesperfectos, $precioServiciosAdicionales, $porcentajeDescuento){
  $calculoPrecioTotal = $precioBasePedido;
  if(isset($precioDesperfectos) && !is_null($precioDesperfectos)){
    $calculoPrecioTotal += $precioDesperfectos;
  }
  if(isset($precioServiciosAdicionales) && !is_null($precioServiciosAdicionales)){
    $calculoPrecioTotal += $precioServiciosAdicionales;
  }
  if(isset($porcentajeDescuento) && !is_null($porcentajeDescuento)){
    $calculoPrecioTotal *= 1 - ($porcentajeDescuento / 100.0);
  }
  $calculoPrecioTotal = round($calculoPrecioTotal,2);
  return $calculoPrecioTotal;
}

function calcularTotalDescuento($precioBasePedido, $precioDesperfectos, $precioServiciosAdicionales, $porcentajeDescuento){
  $calculoTotalDescuento = $precioBasePedido;
  if(isset($precioDesperfectos) && !is_null($precioDesperfectos)){
    $calculoTotalDescuento += $precioDesperfectos;
  }
  if(isset($precioServiciosAdicionales) && !is_null($precioServiciosAdicionales)){
    $calculoTotalDescuento += $precioServiciosAdicionales;
  }
  if(isset($porcentajeDescuento) && !is_null($porcentajeDescuento)){
    $calculoTotalDescuento *= ($porcentajeDescuento / 100.0);
  } else {
    return 0.00;
  }
  $calculoTotalDescuento = round($calculoTotalDescuento,2);
  return $calculoTotalDescuento;
}

function mostrarDetallesPedido($idPedido, $idCuentaConsultante){

}



$db = mysqli_connect(SERVIDOR_BD,USUARIO_BD,CONTRASENA_BD,NOMBRE_BD);
  if ($stmt = $db->prepare(
    "SELECT
    te.nombre nombreTipoEtapa,
    p.tipoPrenda tipoPrenda,
    tpedido.nombreTipoPedido tipoServicio,
    tpedido.idTipoPedido idTipoPedido,
    p.esPedidoExpress esExpress,
    tpedido.precio precioBasePedido,
    desperfectos.coste precioDesperfectos,
    serviciosAdicionales.coste precioServiciosAdicionales,
    d.valor porcentajeDescuento,
    primeraEtapa.fechaIni inicioPedido,
    e.fechaIni inicioEtapa,
    e.fechaFin finEtapa,
    desperfectos.descripcion descArreglos,
    serviciosAdicionales.descripcion descServAdic,
    e.empleadoasignado empleadoAsignado,
    oe.ordenEtapa ordenActual,
    e.idTipoEtapa idTipoEtapa,
    eReal.nombre,
    eReal.OrdenEtapa,
    eReal.idTipoEtapa,
    p.ClientePedido
FROM
    Pedido p INNER JOIN tipoPedido tpedido ON p.idTipoPedido = tpedido.idTipoPedido
    INNER JOIN Cuenta c ON c.idCuenta = p.ClientePedido
    INNER JOIN Etapa e ON e.idPedido = p.idPedido
    INNER JOIN TipoEtapa te ON te.idTipoEtapa = e.idTipoEtapa
    INNER JOIN tipoEtapasportipopedido oe ON oe.idTipoEtapa = e.idTipoEtapa
LEFT JOIN Descuento d
    ON p.idDescuentos = d.idDescuentos
LEFT JOIN (SELECT aD.idPedido, aD.idTipoPedido, aD.ClientePedido, aD.coste, aD.descripcion
        FROM Arreglos aD
        WHERE aD.tipoArreglo = 'Desperfecto') desperfectos
    ON desperfectos.idPedido = p.idPedido AND desperfectos.idTipoPedido = p.idTipoPedido AND desperfectos.ClientePedido = p.ClientePedido
LEFT JOIN (SELECT aSA.idPedido, aSA.idTipoPedido, aSA.ClientePedido, aSA.coste, aSA.descripcion
        FROM Arreglos aSA
        WHERE aSA.tipoArreglo = 'Servicio adicional') serviciosAdicionales
    ON serviciosAdicionales.idPedido = p.idPedido AND serviciosAdicionales.idTipoPedido = p.idTipoPedido AND serviciosAdicionales.ClientePedido = p.ClientePedido
LEFT JOIN (SELECT * FROM Etapa uE WHERE uE.idTipoEtapa = '7' AND uE.fechaFin IS NOT NULL) ultimaEtapa
    ON ultimaEtapa.idPedido = p.idPedido
LEFT JOIN (SELECT * FROM Etapa pE WHERE pE.idTipoEtapa = '1') primeraEtapa
    ON primeraEtapa.idPedido = p.idPedido
LEFT JOIN (SELECT tEPTPX.OrdenEtapa, tEX.idTipoEtapa, tEX.nombre, tEPTPX.idTipoPedido FROM tipoEtapa tEX, tipoEtapasportipopedido tEPTPX WHERE tEX.idTipoEtapa = tEPTPX.idTipoEtapa) eReal
  ON (eReal.OrdenEtapa = ? AND eReal.idTipoPedido = p.idTipoPedido)
WHERE
    p.idPedido =  ?
        AND
    p.estaCancelado = 0
        AND
    oe.idTipoPedido = p.idTipoPedido
        AND
    oe.ordenEtapa = ?
    "
  )) {
    $stmt->bind_param('sss',$ordenEtapaActualReal, $idPedido, $ordenEtapaVista);
    $stmt->execute();
    $stmt->store_result();
    $stmt->bind_result($nombreTipoEtapa, $tipoPrenda, $tipoServicio, $idTipoPedido, $esExpress, $precioBasePedido, $precioDesperfectos,
    $precioServiciosAdicionales,$porcentajeDescuento,$inicioPedido,$inicioEtapa,$finEtapa,$descArreglos,$descServAdic,$empleadoAsignado,$ordenActual, $idEtapa,$nombreEtapaActualReal,$ordenEtapaActualReal,$idEtapaActualReal,$clientePedido);
    echo "{";
    while ($stmt->fetch()) {
      $calculoPrecioTotal = calcularPrecioTotal($precioBasePedido, $precioDesperfectos, $precioServiciosAdicionales, $porcentajeDescuento);
      echo
        '"nombretipoEtapaVista":"'.$nombreTipoEtapa.'", '.
        '"tipoPrenda":"'.$tipoPrenda.'", '.
        '"tipoServicio":"'.$tipoServicio.'", '.
        '"idTipoPedido":"'.$idTipoPedido.'", '.
        '"esExpress":"'.$esExpress.'", '.
        '"precioBasePedido":"'.$precioBasePedido.'", '.
        '"precioDesperfectos":"'.$precioDesperfectos.'", '.
        '"precioServiciosAdicionales":"'.$precioServiciosAdicionales.'", '.
        '"porcentajeDescuento":"'.$porcentajeDescuento.'", '.
        '"inicioPedido":"'.$inicioPedido.'", '.
        '"inicioEtapa":"'.$inicioEtapa.'", '.
        '"finEtapa":"'.$finEtapa.'", '.
        '"descArreglos":"'.$descArreglos.'", '.
        '"descServAdic":"'.$descServAdic.'", '.
        '"empleadoAsignado":"'.$empleadoAsignado.'", '.
        '"ordenActualVista":"'.$ordenActual.'", '.
        '"nombreEtapaActualReal":"'.$nombreEtapaActualReal.'", '.
        '"ordenEtapaActualReal":"'.$ordenEtapaActualReal.'", '.
        '"idEtapaActualReal":"'.$idEtapaActualReal.'", '.
        '"clientePedido":"'.$clientePedido.'", '.
        '"idEtapaVista":"'.$idEtapa.'", ';
      /* ETAPA ANTERIOR Y POSTERIOR */
      if ($ordenActual == 1){
        $etapaAnterior = null;
        if ($descArreglos != null || $descServAdic !=null){
          $etapaPosterior = $ordenActual +1;
        } else {
          $etapaPosterior = 4;
        }
      } else if ($ordenActual == 4){
        $etapaPosterior = $ordenActual +1;
        if ($descArreglos != null || $descServAdic !=null){
          $etapaAnterior = 3;
        } else {
          $etapaAnterior = 1;
        }
      } else if ($ordenActual == 7) {
        $etapaAnterior = $ordenActual -1;
        $etapaPosterior = null;
      } else {
        $etapaAnterior = $ordenActual -1;
        $etapaPosterior = $ordenActual +1;
      }



      if ($etapaAnterior != null){
        if ($stmtB = $db->prepare(
          "SELECT te.nombre nombreTipoEtapa, te.idTipoEtapa idEtapa
          FROM  TipoEtapa te, TipoEtapasportipopedido oe, tipoPedido tp
          WHERE  oe.ordenEtapa = ? AND tp.idTipoPedido = ? AND te.idTipoEtapa = oe.idTipoEtapa AND tp.idTipoPedido = oe.idTipoPedido"
        )) {
          $stmtB->bind_param('ss', $etapaAnterior,$idTipoPedido);
          $stmtB->execute();
          $stmtB->store_result();
          $stmtB->bind_result($nombreTipoEtapaAnterior, $idEtapaAnterior);
          while ($stmtB->fetch()) {
            echo
              '"nombreTipoEtapaAnterior":"'.$nombreTipoEtapaAnterior.'", '.
              '"idEtapaAnterior":"'.$idEtapaAnterior.'", ';
          }}
      } else {$nombreTipoEtapaAnterior = null;}



        if ($etapaPosterior != null){
          if ($stmtC = $db->prepare(
            "SELECT te.nombre nombreTipoEtapa, te.idTipoEtapa idEtapa
            FROM  TipoEtapa te, TipoEtapasportipopedido oe, tipoPedido tp
            WHERE  oe.ordenEtapa = ? AND tp.idTipoPedido = ? AND te.idTipoEtapa = oe.idTipoEtapa AND tp.idTipoPedido = oe.idTipoPedido"
          )) {
            $stmtC->bind_param('ss', $etapaPosterior,$idTipoPedido);
            $stmtC->execute();
            $stmtC->store_result();
            $stmtC->bind_result($nombreTipoEtapaPosterior, $idEtapaPosterior);
            while ($stmtC->fetch()) {
              echo
                '"nombreTipoEtapaPosterior":"'.$nombreTipoEtapaPosterior.'", '.
                '"idEtapaPosterior":"'.$idEtapaPosterior.'", ';
            }}
      } else {$nombreTipoEtapaPosterior = null;}



        if ($stmtD = $db->prepare("SELECT c.nombre, c.apellidos FROM  cuenta c WHERE  c.idCuenta = ?")) {
          $stmtD->bind_param('s', $empleadoAsignado);
          $stmtD->execute();
          $stmtD->store_result();
          $stmtD->bind_result($empleadoNombre,$empleadoApellidos);
          while ($stmtD->fetch()) {
            echo
              '"empleadoNombre":"'.$empleadoNombre.'", '.
              '"empleadoApellidos":"'.$empleadoApellidos.'"} ';
          }}
}}


    $nombrePagina = $nombreTipoEtapa;
?>
