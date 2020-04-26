<?php
include './header.php';
if(!isset($_SESSION['sesionIniciada'])){
  header("Location: ./");
}
?>

<link href="./css/detallesPedido.css" rel="stylesheet">
<script src="./js/detallesPedido.js"></script>

<?php


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





define('SERVIDOR_BD', 'localhost:3306');
define('USUARIO_BD', 'webtintoreria');
define('CONTRASENA_BD', 'lavanderia');
define('NOMBRE_BD', 'tintoreria');

$db = mysqli_connect(SERVIDOR_BD,USUARIO_BD,CONTRASENA_BD,NOMBRE_BD);
  //echo $consulta;
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
    e.idTipoEtapa idTipoEtapa
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
WHERE
    p.idPedido =  ?
        AND
    p.estaCancelado = 0
        AND
    oe.idTipoPedido = p.idTipoPedido
        AND
    oe.ordenEtapa = (
      SELECT IFNULL(MIN(oeB.ordenEtapa),7) FROM tipoetapasportipopedido oeB WHERE oeB.idTipoPedido = p.idTipoPedido AND oeB.idTipoEtapa IN (
        SELECT e.idtipoetapa FROM etapa e
        WHERE (e.fechafin IS NULL OR e.fechaini IS NULL) AND e.idPedido = p.idPedido)
      )
    "
  )) {
    $stmt->bind_param('s', $_POST["idPedido"]);
    $stmt->execute();
    $stmt->store_result();
    $stmt->bind_result($nombreTipoEtapa, $tipoPrenda, $tipoServicio, $idTipoPedido, $esExpress, $precioBasePedido, $precioDesperfectos,
    $precioServiciosAdicionales,$porcentajeDescuento,$inicioPedido,$inicioEtapa,$finEtapa,$descArreglos,$descServAdic,$empleadoAsignado,$ordenActual, $idEtapa);
    while ($stmt->fetch()) {

      $calculoPrecioTotal = calcularPrecioTotal($precioBasePedido, $precioDesperfectos, $precioServiciosAdicionales, $porcentajeDescuento);

      /* ETAPA ANTERIOR Y POSTERIOR */
      if ($ordenActual == 1){
        $etapaAnterior = null;
        $etapaPosterior = $ordenActual +1;
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
          while ($stmtB->fetch()) {}}
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
            while ($stmtC->fetch()) {}}
      } else {$nombreTipoEtapaPosterior = null;}



        if ($stmtD = $db->prepare("SELECT c.nombre, c.apellidos FROM  cuenta c WHERE  c.idCuenta = ?")) {
          $stmtD->bind_param('s', $empleadoAsignado);
          $stmtD->execute();
          $stmtD->store_result();
          $stmtD->bind_result($empleadoNombre,$empleadoApellidos);
          while ($stmtD->fetch()) {}}



    $nombrePagina = $nombreTipoEtapa;
    include './cabeceraContenido.php';

if($_SESSION['tipoCuentaSesión'] == "Cliente"){
  echo'
  <div class="container-fluid">
    <div class="row" style="margin-top:20px;">
      <div id="col1" class="col-3" style="margin-top:20px;">
        <div class="row">
          <div class="col-12 text-center">
      '; if ($esExpress) {
        echo'
          <img src="./img/pedidoExpress.svg" style="width:5vw; height:5vh; margin-top:-15px;" alt="">
          <a style="font-weight:bold; font-size: 24px; font-style:italic;">Pedido Express</a>
        ';
      } else {
        echo'
          <img src="./img/pedidoNormal.svg" style="width:5vw; height:5vh; margin-top:-15px;" alt="">
          <a style="font-weight:bold; font-size: 24px; font-style:italic;">Pedido Normal</a>
        ';
      }
      echo'
          </div>
        </div>
        <div class="row d-flex justify-content-center">
          <div class="col-4 card bg-light text-center" style="margin-top:80px; width: 8vw; height:8vw;">
            <p>Tipo de Prenda</p>
            <div class="card-body text-center" style="margin-top:-20px;">
              <img src="./img/tipoPrenda/'.normalizarTexto($tipoPrenda).'.svg" style="width:4vw; height:8vh;" class="rounded" alt="">
              <p style="margin-top:10px;">'.$tipoPrenda.'</p>
            </div>
          </div>
        </div>
        <div class="row d-flex justify-content-center">
          <div class="col-4 card bg-light text-center" style="margin-top:40px; width: 8vw; height:8vw;">
            <p>Tipo de Servicio</p>
            <div class="card-body text-center" style="margin-top:-20px;">
              <img src="./img/tipoPedido/'.normalizarTexto($tipoServicio).'.svg" style="width:4vw; height:8vh;" class="rounded" alt="">
              <p style="margin-top:10px;">'.$tipoServicio.'</p>
            </div>
          </div>
        </div>
      </div>
      <div id="col2" class="col-6" style="margin-top:20px;">
        <div class="row">
          <div class="col-12">
            <div class="progress">
              <div class="progress-bar progress-bar-striped progress-bar-animated" style="width:'.round($ordenActual/7*100).'%"></div>
            </div>
          </div>
          ';if($nombreTipoEtapaAnterior == null){
          echo'
          <div class="col-3">
            <div class="row justify-content-md-center" style="visibility:hidden;">
              <div class="card bg-light text-center" style="margin-top:100px; width: 10vw; height:10vw;">
                <div class="card-body text-center" style="margin-top:-20px;">
                  <img src="./img/LaVandería Logo.png" style="width:6vw; height:12vh; margin-top:30px;" class="rounded" alt="">
                  <p style="margin-top:20px;">LaVandería Logo</p>
                </div>
              </div>
            </div>
          </div>
          <div class="col-1">
            <div class="row row justify-content-md-center" style="visibility:hidden;">
              <img src="./img/arrowRight.svg" style="width:50px; margin-top:18.5vh;"></img>
            </div>
          </div>
          ';
          } else {
            echo'
              <div class="col-3">
                <div class="row justify-content-md-center">
                  <div class="card bg-light text-center" style="margin-top:100px; width: 10vw; height:10vw;">
                    <div class="card-body text-center" style="margin-top:-20px;">
                      <img src="./img/etapas/'.normalizarTexto($nombreTipoEtapaAnterior).'.svg" style="width:6vw; height:12vh; margin-top:30px;" class="rounded" alt="">
                      <p style="margin-top:20px;">'.$nombreTipoEtapaAnterior.'</p>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-1">
                <div class="row row justify-content-md-center">
                  <img src="./img/arrowRight.svg" style="width:50px; margin-top:18.5vh;"></img>
                </div>
              </div>
              ';
        }
        echo'
          <div class="col-4">
            <div class="row justify-content-md-center">
              <div class="card bg-light text-center" style="margin-top:60px; width: 14vw; height:14vw;">
                <div class="card-body text-center" style="margin-top:-20px;">
                  <img src="./img/etapas/'.normalizarTexto($nombreTipoEtapa).'.svg" style="width:8vw; height:16vh; margin-top:50px;" class="rounded" alt="">
                  <p style="margin-top:20px;">'.$nombreTipoEtapa.'</p>
                </div>
              </div>
            </div>
          </div>
          '; if ($nombreTipoEtapaPosterior == null){
            echo'
          <div class="col-1">
            <div class="row justify-content-md-center" style="visibility:hidden;">
              <img src="./img/arrowRight.svg" style="width:50px; margin-top:18.5vh;"></img>
            </div>
          </div>
          <div class="col-3">
            <div class="row justify-content-md-center" style="visibility:hidden;">
              <div class="card bg-light text-center" style="margin-top:100px; width: 10vw; height:10vw;">
                <div class="card-body text-center" style="margin-top:-20px;">
                  <img src="./img/LaVandería Logo.png" style="width:6vw; height:12vh; margin-top:30px;" class="rounded" alt="">
                  <p style="margin-top:20px;">LaVandería Logo</p>
                </div>
              </div>
            </div>
          </div>
          ';
        } else {
            echo'
            <div class="col-1">
              <div class="row justify-content-md-center">
                <img src="./img/arrowRight.svg" style="width:50px; margin-top:18.5vh;"></img>
              </div>
            </div>
            <div class="col-3">
              <div class="row justify-content-md-center">
                <div class="card bg-light text-center" style="margin-top:100px; width: 10vw; height:10vw;">
                  <div class="card-body text-center" style="margin-top:-20px;">
                    <img src="./img/etapas/'.normalizarTexto($nombreTipoEtapaPosterior).'.svg" style="width:6vw; height:12vh; margin-top:30px;" class="rounded" alt="">
                    <p style="margin-top:20px;">'.$nombreTipoEtapaPosterior.'</p>
                  </div>
                </div>
              </div>
            </div>
            ';
          }
          echo'
        </div>
        <div class="row justify-content-md-center" style="margin-top:65px;">
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
              <a style="font-weight:bold; font-style:italic; text-decoration-line:underline;">Inicio etapa:</a> '.$inicioEtapa.'
            </div>
            <div class="fechas text-center">
              <a style="font-weight:bold; font-style:italic; text-decoration-line:underline;">Fin etapa:</a> '.$finEtapa.'
            </div>
          </div>
        </div>
        <div id="precio" class="row justify-content-md-center">
          <div class="col-8" style="margin-top:30vh;">
            <h5 style="margin-top: 15px;">Total desglosado</h5>
            <div class="row" style="height: 100%;">
              <div class="col-6 text-left" style="height: 100%;">
                <a style="display:block; margin-left: 20px; font-size: 12px;">Servicio:</a>
                <a style="display:block; margin-left: 20px; font-size: 12px;">Arreglos solicitados:</a>
                <a style="display:block; margin-left: 20px; font-size: 12px;">Arreglos extras:</a>
                <a style="display:block; margin-left: 20px; font-size: 12px;">Descuento:</a>
                <a class="font-weight-bold" style="display:block; margin-left: 20px;">Total:</a>
              </div>
              <div class="col-6 text-right h-100">
                <a style="position: absolute; left: 10px; top: 20px; font-size: 20px;">+</a>
                <a class="textoPrecio">'.$precioBasePedido.' €</a>
                <a class="textoPrecio">'.$precioDesperfectos.' €</a>
                <a class="textoPrecio">'.$precioServiciosAdicionales.' €</a>
                <a class="textoPrecio">(-'.$porcentajeDescuento.'%) -'.number_format(calcularTotalDescuento($precioBasePedido, $precioDesperfectos, $precioServiciosAdicionales, $porcentajeDescuento), 2, ',', '.').' €</a>
                <hr class="separadorPrecio">
                <a class="font-weight-bold totalPrecio">'.$calculoPrecioTotal.'</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
';
} else if ($_SESSION['tipoCuentaSesión'] == "Encargado"){
  if(!isset($_POST["haEnviadoASiguienteEtapa"]) || $_POST["haEnviadoASiguienteEtapa"] == false || !isset($_POST["haEnviadoAPago"])
  || $_POST["haEnviadoAPago"] == false || !isset($_POST["haEnviadoAEtapaAnterior"]) || $_POST["haEnviadoAEtapaAnterior"] == false) {
  echo'
  <div class="container-fluid">
    <div class="row" style="margin-top:20px;">
      <div id="col1" class="col-3" style="margin-top:20px;">
        <div class="row">
          <div class="col-12 text-center">
            <img src="./img/pedidoExpress.svg" style="width:5vw; height:5vh; margin-top:-15px;" alt="">
            <a style="font-weight:bold; font-size: 24px; font-style:italic;">Pedido Express</a>
          </div>
        </div>
        <div class="row d-flex justify-content-center">
          <div class="col-4 card bg-light text-center" style="margin-top:50px; width: 8vw; height:8vw;">
            <p>Tipo de Prenda</p>
            <div class="card-body text-center" style="margin-top:-20px;">
              <img src="./img/tipoPrenda/'.normalizarTexto($tipoPrenda).'.svg" style="width:4vw; height:8vh;" class="rounded" alt="">
              <p>'.$tipoPrenda.'</p>
            </div>
          </div>
        </div>
        <div class="row d-flex justify-content-center">
          <div class="col-4 card bg-light text-center" style="margin-top:40px; width: 8vw; height:8vw;">
            <p>Tipo de Servicio</p>
            <div class="card-body text-center" style="margin-top:-20px;">
              <img src="./img/tipoPedido/'.normalizarTexto($tipoServicio).'.svg" style="width:4vw; height:8vh;" class="rounded" alt="">
              <p>'.$tipoServicio.'</p>
            </div>
          </div>
        </div>
  '; if ("secadoyrevision" == normalizarTexto($nombreTipoEtapa)){
        echo'
        <div class="row" style="margin-top:65px;">
          <div class="col-12 text-center">
            <button type="button" class="btn btn-warning" style="width:15vw; height:10vh;" onclick="EnvEtAntEnc('.$_POST["idPedido"].')"><b>Devolver prenda a lavado</b></button>
          </div>
        </div>';
    }
    echo'
      </div>
      <div id="col2" class="col-6" style="margin-top:20px;">
        <div class="row">
          ';if($nombreTipoEtapaAnterior == null){
          echo'
          <div class="col-3">
            <div class="row justify-content-md-center" style="visibility:hidden;">
              <div class="card bg-light text-center" style="margin-top:100px; width: 10vw; height:10vw;">
                <div class="card-body text-center" style="margin-top:-20px;">
                  <img src="./img/LaVandería Logo.png" style="width:6vw; height:12vh; margin-top:30px;" class="rounded" alt="">
                  <p style="margin-top:20px;">LaVandería Logo</p>
                </div>
              </div>
            </div>
          </div>
          <div class="col-1">
            <div class="row row justify-content-md-center" style="visibility:hidden;">
              <img src="./img/arrowRight.svg" style="width:50px; margin-top:18.5vh;"></img>
            </div>
          </div>
          ';
          } else {
            echo'
              <div class="col-3">
                <div class="row justify-content-md-center">
                  <div class="card bg-light text-center" style="margin-top:100px; width: 10vw; height:10vw;">
                    <div class="card-body text-center" style="margin-top:-20px;">
                      <img src="./img/etapas/'.normalizarTexto($nombreTipoEtapaAnterior).'.svg" style="width:6vw; height:12vh; margin-top:30px;" class="rounded" alt="">
                      <p style="margin-top:20px;">'.$nombreTipoEtapaAnterior.'</p>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-1">
                <div class="row row justify-content-md-center">
                  <img src="./img/arrowRight.svg" style="width:50px; margin-top:18.5vh;"></img>
                </div>
              </div>
              ';
        }
        echo'
          <div class="col-4">
            <div class="row justify-content-md-center">
              <div class="card bg-light text-center" style="margin-top:60px; width: 14vw; height:14vw;">
                <div class="card-body text-center" style="margin-top:-20px;">
                  <img src="./img/etapas/'.normalizarTexto($nombreTipoEtapa).'.svg" style="width:8vw; height:16vh; margin-top:50px;" class="rounded" alt="">
                  <p style="margin-top:20px;">'.$nombreTipoEtapa.'</p>
                </div>
              </div>
            </div>
          </div>
          '; if ($nombreTipoEtapaPosterior == null){
            echo'
          <div class="col-1">
            <div class="row justify-content-md-center" style="visibility:hidden;">
              <img src="./img/arrowRight.svg" style="width:50px; margin-top:18.5vh;"></img>
            </div>
          </div>
          <div class="col-3">
            <div class="row justify-content-md-center" style="visibility:hidden;">
              <div class="card bg-light text-center" style="margin-top:100px; width: 10vw; height:10vw;">
                <div class="card-body text-center" style="margin-top:-20px;">
                  <img src="./img/LaVandería Logo.png" style="width:6vw; height:12vh; margin-top:30px;" class="rounded" alt="">
                  <p style="margin-top:20px;">LaVandería Logo</p>
                </div>
              </div>
            </div>
          </div>
          ';
        } else {
            echo'
            <div class="col-1">
              <div class="row justify-content-md-center">
                <img src="./img/arrowRight.svg" style="width:50px; margin-top:18.5vh;"></img>
              </div>
            </div>
            <div class="col-3">
              <div class="row justify-content-md-center">
                <div class="card bg-light text-center" style="margin-top:100px; width: 10vw; height:10vw;">
                  <div class="card-body text-center" style="margin-top:-20px;">
                    <img src="./img/etapas/'.normalizarTexto($nombreTipoEtapaPosterior).'.svg" style="width:6vw; height:12vh; margin-top:30px;" class="rounded" alt="">
                    <p style="margin-top:20px;">'.$nombreTipoEtapaPosterior.'</p>
                  </div>
                </div>
              </div>
            </div>
            ';
          }
          echo'
        </div>
  '; if("recepcionado(revisiondelaprenda)" == normalizarTexto($nombreTipoEtapa)){
    echo'
        <div class="row justify-content-md-center" style="margin-top:30px;">
          <div class="col-5">
              <div class="form-group">
                <label for="ServiciosAdic">Servicios adicionales</label>
                <textarea disabled class="form-control" id="ServiciosAdic" rows="4" style="resize: none; display: flex; align-items: stretch;">'.$descServAdic.'</textarea>
              </div>
            </div>
            <div class="col-5">
              <div class="form-group">
                <label for="Desperfectos">Desperfectos</label>
                <textarea disabled class="form-control" id="Desperfectos" rows="4" style="resize: none; display: flex; align-items: stretch;">'.$descArreglos.'</textarea>
              </div>
            </div>
        </div>
        <div class="row justify-content-md-center">
          <div class="col-5">
            <label for="Asignar_coste_SA">Asignar coste</label>
            <div class="input-group mb-3">
              <input type="text" class="form-control" style="margin-top:0px;">
              <div class="input-group-append">
                <span class="input-group-text">€</span>
              </div>
            </div>
          </div>
          <div class="col-5" >
            <label for="Asignar_coste_D">Asignar coste</label>
            <div class="input-group mb-3">
              <input type="text" class="form-control" style="margin-top:0px;">
              <div class="input-group-append">
                <span class="input-group-text">€</span>
              </div>
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
              <a style="font-weight:bold; font-style:italic; text-decoration-line:underline;">Inicio etapa:</a> '.$inicioEtapa.'
            </div>
            <div class="fechas text-center">
              <a style="font-weight:bold; font-style:italic; text-decoration-line:underline;">Fin etapa:</a> '.$finEtapa.'
            </div>
          </div>
        </div>
        <div id="precio" class="row justify-content-md-center">
          <div class="col-8" style="margin-top:30vh;">
            <h5 style="margin-top: 15px;">Total desglosado</h5>
            <div class="row" style="height: 100%;">
              <div class="col-6 text-left" style="height: 100%;">
                <a style="display:block; margin-left: 20px; font-size: 12px;">Servicio:</a>
                <a style="display:block; margin-left: 20px; font-size: 12px;">Arreglos solicitados:</a>
                <a style="display:block; margin-left: 20px; font-size: 12px;">Arreglos extras:</a>
                <a style="display:block; margin-left: 20px; font-size: 12px;">Descuento:</a>
                <a class="font-weight-bold" style="display:block; margin-left: 20px;">Total:</a>
              </div>
              <div class="col-6 text-right h-100">
                <a style="position: absolute; left: 10px; top: 20px; font-size: 20px;">+</a>
                <a class="textoPrecio">'.$precioBasePedido.' €</a>
                <a class="textoPrecio">'.$precioDesperfectos.' €</a>
                <a class="textoPrecio">'.$precioServiciosAdicionales.' €</a>
                <a class="textoPrecio">(-'.$porcentajeDescuento.'%) -'.number_format(calcularTotalDescuento($precioBasePedido, $precioDesperfectos, $precioServiciosAdicionales, $porcentajeDescuento), 2, ',', '.').' €</a>
                <hr class="separadorPrecio">
                <a class="font-weight-bold totalPrecio">'.$calculoPrecioTotal.'</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
';
    }else {
          echo'
          <div class="row justify-content-md-center" style="margin-top:65px;">
            <div class="col-5">
                <div class="form-group">
                  <label for="ServiciosAdic">Servicios adicionales</label>
                  <textarea disabled class="form-control" id="ServiciosAdic" rows="6" style="resize: none; display: flex; align-items: stretch;"></textarea>
                </div>
              </div>
              <div class="col-5">
                <div class="form-group">
                  <label for="Desperfectos">Desperfectos</label>
                  <textarea
    '; if ("recepcionado" != normalizarTexto($nombreTipoEtapa)){
          echo'
                  disabled
          ';
    }
    echo'
                 class="form-control" id="Desperfectos" name="Desperfectos" rows="6" style="resize: none;"></textarea>
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
                <a style="font-weight:bold; font-style:italic; text-decoration-line:underline;">Inicio etapa:</a> '.$inicioEtapa.'
              </div>
              <div class="fechas text-center">
                <a style="font-weight:bold; font-style:italic; text-decoration-line:underline;">Fin etapa:</a> '.$finEtapa.'
              </div>
            </div>
          </div>
          <div class="row justify-content-md-center" style="margin-top:40px;">
            <div class="col-8">
              <div class="form-group">
                <label for="empleadoasignado">Empleado asignado:</label>
                <textarea disabled class="form-control" id="empleadoasignado" rows="1" style="resize: none;">'.$empleadoNombre.' '.$empleadoApellidos.'</textarea>
              </div>
            </div>
          </div>
    '; if("findepedido" == normalizarTexto($nombreTipoEtapa)){
      echo'
            <div id="botones" class="row" style="margin-top:10vh;">
              <div class="col-12 text-center">
                <button type="button" class="btn btn-info" style="width:15vw; height:30vh;" onclick="realizarPagos('.$_POST["idPedido"].')"><b>Realizar Pago</b></button>
              </div>
            </div>
          </div>
        </div>
      </div>
    ';
      }else {
        echo'
          <div class="separador-fba"></div>
          <div id="botones" class="row">
            <div class="col-12 text-center">
              <button type="button" class="btn btn-info" style="width:15vw; height:10vh;" onclick="EnvSigEtEnc('.$_POST["idPedido"].')"><b>Enviar a la siguiente etapa</b></button>
            </div>
          </div>
        </div>
      </div>
    </div>
  ';
    }
  }
} else if (isset($_POST["haEnviadoASiguienteEtapa"]) && $_POST["haEnviadoASiguienteEtapa"] == true){

      $systemDate= date("Y-m-d H:i:s");

      $stmtE = $db->prepare("UPDATE etapa e SET e.fechaFin=? WHERE e.idPedido = ?  AND e.idTipoEtapa= ?");
      $stmtE->bind_param('sss', $systemDate,$_POST["idPedido"],$idEtapa);
      $stmtE->execute();

      $stmtF = $db->prepare("UPDATE etapa e SET e.fechaInicio=? WHERE e.idPedido = ?  AND e.idTipoEtapa= ?");
      $stmtF->bind_param('sss', $systemDate,$_POST["idPedido"],$idEtapaPosterior);
      $stmtF->execute();


} else if (isset($_POST["haEnviadoAPago"]) && $_POST["haEnviadoAPago"] == true){

      $systemDate= date("Y-m-d H:i:s");

      $stmtG = $db->prepare("UPDATE etapa e SET e.fechaFin=? WHERE e.idPedido = ?  AND e.idTipoEtapa= ?");
      $stmtG->bind_param('sss', $systemDate,$_POST["idPedido"],$idEtapa);
      $stmtG->execute();

} else if (isset($_POST["haEnviadoAEtapaAnterior"]) && $_POST["haEnviadoAEtapaAnterior"] == true){

      $systemDate= date("Y-m-d H:i:s");

      $stmtH = $db->prepare("UPDATE etapa e SET e.fechaInicio=null WHERE e.idPedido = ?  AND e.idTipoEtapa= ?");
      $stmtH->bind_param('ss', $_POST["idPedido"],$idEtapa);
      $stmtH->execute();

      $stmtI = $db->prepare("UPDATE etapa e SET e.fechaInicio=? AND e.fechaFin=null WHERE e.idPedido = ?  AND e.idTipoEtapa= ?");
      $stmtI->bind_param('sss', $systemDate,$_POST["idPedido"],$idEtapa);
      $stmtI->execute();

}


} else if ($_SESSION['tipoCuentaSesión'] == "Empleado"){
  if(!isset($_POST["haEnviadoASiguienteEtapa"]) || $_POST["haEnviadoASiguienteEtapa"] == false || !isset($_POST["haEnviadoAEtapaAnterior"]) || $_POST["haEnviadoAEtapaAnterior"] == false) {
  echo'
  <div class="container-fluid">
    <div class="row" style="margin-top:20px;">
      <div id="col1" class="col-3" style="margin-top:20px;">
        <div class="row">
          <div class="col-12 text-center">
            <img src="./img/pedidoExpress.svg" style="width:5vw; height:5vh; margin-top:-15px;" alt="">
            <a style="font-weight:bold; font-size: 24px; font-style:italic;">Pedido Express</a>
          </div>
        </div>
        <div class="row d-flex justify-content-center">
          <div class="col-4 card bg-light text-center" style="margin-top:50px; width: 8vw; height:8vw;">
            <p>Tipo de Prenda</p>
            <div class="card-body text-center" style="margin-top:-20px;">
              <img src="./img/tipoPrenda/'.$tipoPrenda.'.svg" style="width:4vw; height:8vh;" class="rounded" alt="">
              <p>'.$tipoPrenda.'</p>
            </div>
          </div>
        </div>
        <div class="row d-flex justify-content-center">
          <div class="col-4 card bg-light text-center" style="margin-top:40px; width: 8vw; height:8vw;">
            <p>Tipo de Servicio</p>
            <div class="card-body text-center" style="margin-top:-20px;">
              <img src="./img/tipoPedido/'.normalizarTexto($tipoServicio).'.svg" style="width:4vw; height:8vh;" class="rounded" alt="">
              <p>'.$tipoServicio.'</p>
            </div>
          </div>
        </div>
  '; if ("secadoyrevision" == normalizarTexto($nombreTipoEtapa)){
        echo'
        <div class="row" style="margin-top:65px;">
          <div class="col-12 text-center">
            <button type="button" class="btn btn-warning" style="width:15vw; height:10vh;" onclick="EnvEtAntEmp('.$_POST["idPedido"].')"><b>Devolver prenda a lavado</b></button>
          </div>
        </div>';
    }
    echo'
      </div>
      <div id="col2" class="col-6" style="margin-top:20px;">
        <div class="row">
          ';if($nombreTipoEtapaAnterior == null){
          echo'
          <div class="col-3">
            <div class="row justify-content-md-center" style="visibility:hidden;">
              <div class="card bg-light text-center" style="margin-top:100px; width: 10vw; height:10vw;">
                <div class="card-body text-center" style="margin-top:-20px;">
                  <img src="./img/LaVandería Logo.png" style="width:6vw; height:12vh; margin-top:30px;" class="rounded" alt="">
                  <p style="margin-top:20px;">LaVandería Logo</p>
                </div>
              </div>
            </div>
          </div>
          <div class="col-1">
            <div class="row row justify-content-md-center" style="visibility:hidden;">
              <img src="./img/arrowRight.svg" style="width:50px; margin-top:18.5vh;"></img>
            </div>
          </div>
          ';
          } else {
            echo'
              <div class="col-3">
                <div class="row justify-content-md-center">
                  <div class="card bg-light text-center" style="margin-top:100px; width: 10vw; height:10vw;">
                    <div class="card-body text-center" style="margin-top:-20px;">
                      <img src="./img/etapas/'.normalizarTexto($nombreTipoEtapaAnterior).'.svg" style="width:6vw; height:12vh; margin-top:30px;" class="rounded" alt="">
                      <p style="margin-top:20px;">'.$nombreTipoEtapaAnterior.'</p>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-1">
                <div class="row row justify-content-md-center">
                  <img src="./img/arrowRight.svg" style="width:50px; margin-top:18.5vh;"></img>
                </div>
              </div>
              ';
        }
        echo'
          <div class="col-4">
            <div class="row justify-content-md-center">
              <div class="card bg-light text-center" style="margin-top:60px; width: 14vw; height:14vw;">
                <div class="card-body text-center" style="margin-top:-20px;">
                  <img src="./img/etapas/'.normalizarTexto($nombreTipoEtapa).'.svg" style="width:8vw; height:16vh; margin-top:50px;" class="rounded" alt="">
                  <p style="margin-top:20px;">'.$nombreTipoEtapa.'</p>
                </div>
              </div>
            </div>
          </div>
          '; if ($nombreTipoEtapaPosterior == null){
            echo'
          <div class="col-1">
            <div class="row justify-content-md-center" style="visibility:hidden;">
              <img src="./img/arrowRight.svg" style="width:50px; margin-top:18.5vh;"></img>
            </div>
          </div>
          <div class="col-3">
            <div class="row justify-content-md-center" style="visibility:hidden;">
              <div class="card bg-light text-center" style="margin-top:100px; width: 10vw; height:10vw;">
                <div class="card-body text-center" style="margin-top:-20px;">
                  <img src="./img/LaVandería Logo.png" style="width:6vw; height:12vh; margin-top:30px;" class="rounded" alt="">
                  <p style="margin-top:20px;">LaVandería Logo</p>
                </div>
              </div>
            </div>
          </div>
          ';
        } else {
            echo'
            <div class="col-1">
              <div class="row justify-content-md-center">
                <img src="./img/arrowRight.svg" style="width:50px; margin-top:18.5vh;"></img>
              </div>
            </div>
            <div class="col-3">
              <div class="row justify-content-md-center">
                <div class="card bg-light text-center" style="margin-top:100px; width: 10vw; height:10vw;">
                  <div class="card-body text-center" style="margin-top:-20px;">
                    <img src="./img/etapas/'.normalizarTexto($nombreTipoEtapaPosterior).'.svg" style="width:6vw; height:12vh; margin-top:30px;" class="rounded" alt="">
                    <p style="margin-top:20px;">'.$nombreTipoEtapaPosterior.'</p>
                  </div>
                </div>
              </div>
            </div>
            ';
          }
          echo'
        </div>
        <div class="row justify-content-md-center" style="margin-top:65px;">
              <div class="col-5">
                <div class="form-group">
                  <label for="ServiciosAdic">Servicios adicionales</label>
                  <textarea disabled class="form-control" id="ServiciosAdic" rows="6" style="resize: none;">'.$descServAdic.'</textarea>
                </div>
              </div>
              <div class="col-5">
                <div class="form-group">
                  <label for="Desperfectos">Desperfectos</label>
                  <textarea
    '; if ("recepcionado" != normalizarTexto($nombreTipoEtapa)){
          echo'
                  disabled
          ';
    }
    echo'
              class="form-control" id="Desperfectos" rows="6" style="resize: none;">'.$descArreglos.'</textarea>
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
              <a style="font-weight:bold; font-style:italic; text-decoration-line:underline;">Inicio etapa:</a> '.$inicioEtapa.'
            </div>
            <div class="fechas text-center">
              <a style="font-weight:bold; font-style:italic; text-decoration-line:underline;">Fin etapa:</a> '.$finEtapa.'
            </div>
          </div>
        </div>
        <div class="row justify-content-md-center" style="margin-top:40px;">
          <div class="col-8">
            <div class="form-group">
              <label for="empleadoasignado">Empleado asignado:</label>
              <textarea disabled class="form-control" id="empleadoasignado" rows="1" style="resize: none;">'.$empleadoNombre.' '.$empleadoApellidos.'</textarea>
            </div>
          </div>
        </div>
        <div class="separador-fba"></div>
        <div id="botones" class="row">
          <div class="col-12 text-center">
            <button type="button" class="btn btn-info" style="width:15vw; height:10vh;" onclick="EnvSigEtEmp('.$_POST["idPedido"].')"><b>Enviar a la siguiente etapa</b></button>
          </div>
        </div>
      </div>
    </div>
  </div>
';
} else if(isset($_POST["haEnviadoASiguienteEtapa"]) && $_POST["haEnviadoASiguienteEtapa"] == true){

      $systemDate= date("Y-m-d H:i:s");

      $stmtE = $db->prepare("UPDATE etapa e SET e.fechaFin=? WHERE e.idPedido = ?  AND e.idTipoEtapa= ?");
      $stmtE->bind_param('sss', $systemDate,$_POST["idPedido"],$idEtapa);
      $stmtE->execute();

      $stmtF = $db->prepare("UPDATE etapa e SET e.fechaInicio=? WHERE e.idPedido = ?  AND e.idTipoEtapa= ?");
      $stmtF->bind_param('sss', $systemDate,$_POST["idPedido"],$idEtapaPosterior);
      $stmtF->execute();

}  else if (isset($_POST["haEnviadoAEtapaAnterior"]) && $_POST["haEnviadoAEtapaAnterior"] == true){

      $systemDate= date("Y-m-d H:i:s");

      $stmtK = $db->prepare("UPDATE etapa e SET e.fechaInicio=null WHERE e.idPedido = ?  AND e.idTipoEtapa= ?");
      $stmtK->bind_param('ss', $_POST["idPedido"],$idEtapa);
      $stmtK->execute();

      $stmtL = $db->prepare("UPDATE etapa e SET e.fechaInicio=? AND e.fechaFin=null WHERE e.idPedido = ?  AND e.idTipoEtapa= ?");
      $stmtL->bind_param('sss', $systemDate,$_POST["idPedido"],$idEtapa);
      $stmtL->execute();

}
}
}}

mysqli_close($db);
?>

<?php
include './footer.php';
?>
