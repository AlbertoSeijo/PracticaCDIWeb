<?php
include './header.php';
if(!isset($_SESSION['sesionIniciada']) || $_SESSION['tipoCuentaSesión'] != "Encargado" || !isset($_POST["idPedido"])){
  header("Location: ./");
}
?>

<link href="./css/resumenPedido.css" rel="stylesheet">
<script src="./js/resumenPedido.js"></script>

<?php
$varIdPedido = $_POST["idPedido"];

function calcularPrecioTotal($precioBasePedido, $precioDesperfectos, $precioServiciosAdicionales, $porcentajeDescuento, $IVA){
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
  $calculoPrecioTotal += $IVA;
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

function calculoIVA($precioBasePedido, $precioDesperfectos, $precioServiciosAdicionales, $porcentajeDescuento){
  if($porcentajeDescuento == 100){
    $calculoIVA = 0;
  } else {$calculoIVA = $precioBasePedido*0.21;}
  if(isset($precioDesperfectos) && !is_null($precioDesperfectos)){
    $calculoIVA = $calculoIVA + $precioDesperfectos*0.21;
  }
  if(isset($precioServiciosAdicionales) && !is_null($precioServiciosAdicionales)){
    $calculoIVA = $calculoIVA + $precioServiciosAdicionales*0.21;
  }
  $calculoIVA = round($calculoIVA,2);
  return $calculoIVA;
}





define('SERVIDOR_BD', 'localhost:3306');
define('USUARIO_BD', 'webtintoreria');
define('CONTRASENA_BD', 'lavanderia');
define('NOMBRE_BD', 'tintoreria');

$db = mysqli_connect(SERVIDOR_BD,USUARIO_BD,CONTRASENA_BD,NOMBRE_BD);

if(isset($_POST['descuento'])){
  $idDescuento = $_POST['descuento'];
  $stmt0 = $db->prepare("UPDATE pedido SET idDescuentos=? WHERE idPedido = ?");
  $stmt0->bind_param('ii', $idDescuento,$varIdPedido);
  $stmt0->execute();
}
  //echo $consulta;
  if ($stmt = $db->prepare(
    "SELECT
    p.tipoPrenda tipoPrenda,
    tpedido.nombreTipoPedido tipoServicio,
    tpedido.idTipoPedido idTipoPedido,
    p.esPedidoExpress esExpress,
    tpedido.precio precioBasePedido,
    desperfectos.coste precioDesperfectos,
    serviciosAdicionales.coste precioServiciosAdicionales,
    d.valor porcentajeDescuento,
    primeraEtapa.fechaIni inicioPedido,
    ultimaEtapa.fechaFin finPedido,
    desperfectos.descripcion descArreglos,
    serviciosAdicionales.descripcion descServAdic,
    d.descripcion descDescuento
FROM
    Pedido p INNER JOIN tipoPedido tpedido ON p.idTipoPedido = tpedido.idTipoPedido
    INNER JOIN Cuenta c ON c.idCuenta = p.ClientePedido
    INNER JOIN Etapa e ON e.idPedido = p.idPedido
    INNER JOIN TipoEtapa te ON te.idTipoEtapa = e.idTipoEtapa
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
LEFT JOIN (SELECT * FROM Etapa uE WHERE uE.idTipoEtapa = '7') ultimaEtapa
    ON ultimaEtapa.idPedido = p.idPedido
LEFT JOIN (SELECT * FROM Etapa pE WHERE pE.idTipoEtapa = '1') primeraEtapa
    ON primeraEtapa.idPedido = p.idPedido
WHERE
    p.idPedido =  ?
        AND
    p.estaCancelado = 0
        AND
    e.idTipoEtapa = 7
    "
  )) {
    $stmt->bind_param('s', $varIdPedido);
    $stmt->execute();
    $stmt->store_result();
    $stmt->bind_result($tipoPrenda, $tipoServicio, $idTipoPedido, $esExpress, $precioBasePedido, $precioDesperfectos,
    $precioServiciosAdicionales,$porcentajeDescuento,$inicioPedido,$finPedido,$descArreglos,$descServAdic,$descDescuento);
    while ($stmt->fetch()) {

      $IVA = calculoIVA($precioBasePedido, $precioDesperfectos, $precioServiciosAdicionales, $porcentajeDescuento);
      $calculoPrecioTotal = calcularPrecioTotal($precioBasePedido, $precioDesperfectos, $precioServiciosAdicionales, $porcentajeDescuento, $IVA);

      if (isset($_POST['tarjeta'])){
        $varTarjeta = $_POST["tarjeta"];
        if ($stmt = $db->prepare('SELECT puntos FROM tarjeta WHERE numTarjeta = ?')) {
          $stmt->bind_param('s', $varTarjeta);
          $stmt->execute();
          $stmt->store_result();
          $stmt->bind_result($varPuntos);
          $stmt->fetch();
        }
        $varNewPuntos = $varPuntos + intval($calculoPrecioTotal*20);

        if (isset($_POST['puntosGastados'])){
          $varPuntosGastados = $_POST['puntosGastados'];
          $varNewPuntos = $varNewPuntos - $varPuntosGastados;
        }
      }


$nombrePagina = "Resumen del Pedido";
include './cabeceraContenido.php';

echo'
<form id="finform" method="POST" action="./congratulations.php" style="display:none"></form>
<div class="container-fluid">
  <div class="row" style="margin-top:20px;">
    <div id="col1" class="col-3" style="margin-top:20px;">
      <div class="row">
        <div class="col-12 text-center">';
        if ($esExpress){
          echo'
          <img src="./img/pedidoExpress.svg" style="width:5vw; height:5vh; margin-top:-15px;" alt="">
          <a style="font-weight:bold; font-size: 24px; font-style:italic;">Pedido exprés</a>
          ';
        } else {
          echo'
          <img src="./img/pedidoNormal.svg" style="width:5vw; height:5vh; margin-top:-15px;" alt="">
          <a style="font-weight:bold; font-size: 24px; font-style:italic;">Pedido normal</a>
          ';
        }
        echo'
        </div>
      </div>
      <div class="row d-flex justify-content-center">
        <div class="col-4 card bg-light text-center" style="margin-top:30px; width: 8vw; height:8vw;">
          <p>Tipo de Prenda</p>
          <div class="card-body text-center" style="margin-top:-20px;">
            <img src="./img/tipoPrenda/'.normalizarTexto($tipoPrenda).'.svg" style="width:4vw; height:8vh;" class="rounded" alt="">
            <a>'.$tipoPrenda.'</a>
          </div>
        </div>
      </div>
      <div class="row d-flex justify-content-center">
        <div class="col-4 card bg-light text-center" style="margin-top:30px; width: 8vw; height:8vw;">
          <p>Tipo de Servicio</p>
          <div class="card-body text-center" style="margin-top:-20px;">
            <img src="./img/tipoPedido/'.normalizarTexto($tipoServicio).'.svg" style="width:4vw; height:8vh;" class="rounded" alt="">
            <a>'.$tipoServicio.'</a>
          </div>
        </div>
      </div>
      <div class="row justify-content-center" style="position:absolute; left:0; right:0; margin-top:10px;">
        <div class="toast">
          <div class="toast-header">
            Factura Emitida
          </div>
          <div class="toast-body">
            "Se ha enviado al correo la factura"
          </div>
        </div>
      </div>
      <div class="row btn-facturar" style="margin-top:8vh;">
        <div class="col-12 text-center">
<button id="facturar" type="button" class="btn btn-info" style="width:15vw; height:10vh; position: relative;" onclick="facturacion()"><b>Emitir Factura </b><img src="./img/pago/factura.svg" style="width: 56px; position: absolute; right:20px;  top: 20px;"></img></button>
        </div>
      </div>
    </div>
    <div id="col2" class="col-6" style="margin-top:20px;">
      <div class="row justify-content-md-center">
        <div class="col-10">
          <table class="table table-bordered">
            <thead class="bg-table-special">
              <tr>
                <th>Tipo de Servicio</th>
                <th>Precio</th>
              </tr>
            </thead>
            <tbody class="bg-table">
              <tr>
                <td>Servicio de '.$tipoServicio.'</td>
                <td class="text-right">+'.$precioBasePedido.'</td>
              </tr>
              <tr>
                <td>Servicios adicionales solicitados por el cliente</td>
                <td class="text-right">+';if($precioServiciosAdicionales==null){echo'0.00';}else{echo number_format($precioServiciosAdicionales, 2, ',', '.');} echo'€</td>
              </tr>
              <tr>
                <td>Desperfectos</td>
                <td class="text-right">+';if($precioDesperfectos==null){echo'0.00';}else{echo number_format($precioDesperfectos, 2, ',', '.');} echo'€</td>
              </tr>
              <tr>
                <td>Descuentos'; if($descDescuento!=null){echo' "'.$descDescuento.'"';} echo'</td>
                <td class="text-right">';if($porcentajeDescuento==0){echo'-0.00€';}else{echo'(-'.$porcentajeDescuento.'%) -'.number_format(calcularTotalDescuento($precioBasePedido, $precioDesperfectos, $precioServiciosAdicionales, $porcentajeDescuento), 2, ',', '.').'€';}echo'</td>
              </tr>
              <tr>
                <td>IVA (21%)</td>
                <td class="text-right">+'.number_format($IVA, 2, ',', '.').'€</td>
              </tr>
              <tr class="bg-table-special">
                <th>TOTAL</th>
                <th class="text-right">'.number_format($calculoPrecioTotal, 2, ',', '.').'€</th>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
      <div class="row justify-content-md-center" style="margin-top:45px;">
            <div class="col-5">
              <div class="form-group">
                <label for="ServiciosAdic">Servicios adicionales</label>
                <textarea disabled class="form-control" id="ServiciosAdic" rows="6" style="resize: none;">'.$descServAdic.'</textarea>
              </div>
            </div>
            <div class="col-5">
              <div class="form-group">
                <label for="Desperfectos">Desperfectos</label>
                <textarea disabled class="form-control" id="Desperfectos" rows="6" style="resize: none;">'.$descArreglos.'</textarea>
              </div>
            </div>
      </div>
    </div>
    <div id="col3" class="col-3" style="margin-top:20px;">
      <div id="fechas" class="row">
        <div class="col-12">
          <div class="fechas">
            <img src="./img/calendar.svg" style="width:3vw; height:3vh; position:absolute; left: 20%;" alt="">
          </div>
          <div class="fechas text-center" style="margin-top:30px;">
            <a style="font-weight:bold; font-style:italic; text-decoration-line:underline;">Inicio pedido:</a> '.$inicioPedido.'
          </div>
          <div class="fechas text-center">
            <a style="font-weight:bold; font-style:italic; text-decoration-line:underline;">Fin pedido:</a> '.$finPedido.'
          </div>
        </div>
      </div>
      <div id="separador" class="separador-fb">
      </div>
      <div id="botones" class="row">
        <div class="col-12 text-center">
          <div class="btn-group-vertical">';
          if(isset($_POST['tarjeta'])){
            echo'
              <button type="button" class="btn btn-info" style="width:20vw; height:10vh; margin:5px;" onclick="finalizarcontarjeta('.$varTarjeta.','.$varNewPuntos.')"><b>Pago en efectivo</b><img src="./img/pago/pagoEfectivo.svg" style="width: 48px; position: absolute; right:20px; top: 30px;"></img></button>
              <button type="button" class="btn btn-info" style="width:20vw; height:10vh; margin:5px;" onclick="finalizarcontarjeta('.$varTarjeta.','.$varNewPuntos.')"><b>Pago con tarjeta</b><img src="./img/pago/pagoTarjeta.svg" style="width: 48px; position: absolute; right:20px; top: 24px;"></img></button>
            ';
          } else {
            echo'
            <button type="button" class="btn btn-info" style="width:20vw; height:10vh; margin:5px;" onclick="finalizarsintarjeta()"><b>Pago en efectivo</b><img src="./img/pago/pagoEfectivo.svg" style="width: 48px; position: absolute; right:20px; top: 30px;"></img></button>
            <button type="button" class="btn btn-info" style="width:20vw; height:10vh; margin:5px;" onclick="finalizarsintarjeta()"><b>Pago con tarjeta</b><img src="./img/pago/pagoTarjeta.svg" style="width: 48px; position: absolute; right:20px; top: 24px;"></img></button>
            ';
          }
          echo'
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
';

}}

?>

<?php
include './footer.php';
?>
