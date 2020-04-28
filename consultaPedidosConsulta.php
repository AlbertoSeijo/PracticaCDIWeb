<?php
if (!isset($_POST["cargadoDesdePagina"]) ) {//Así se sabe si se ha llamado directamente al fichero
  header("Location: ./");
}
session_start();
include './commonFunctions.php';
define('SERVIDOR_BD', 'localhost:3306');
define('USUARIO_BD', 'webtintoreria');
define('CONTRASENA_BD', 'lavanderia');
define('NOMBRE_BD', 'tintoreria');

function bindParam($stmt, $tipoCuenta){
  if($tipoCuenta == "Cliente"){
    $stmt->bind_param("s", $_SESSION['idCuentaSesión']);
  } else if ($tipoCuenta == "Empleado") {
    $stmt->bind_param("s", $_SESSION['idCuentaSesión']);
  } else if ($tipoCuenta == "Encargado") {
    //No se añade ningún param (Encargado no lo necesita)
  }
}

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

function condicionTipoCuenta($tipoCuenta){
  if($tipoCuenta == "Cliente"){
    return " and p.ClientePedido = ?";
  } else if ($tipoCuenta == "Empleado") {
    return " and p.idPedido in (select distinct e.idPedido from etapa e where empleadoAsignado = ?)";//TODO Alguna condición que indique que el empleado está involucrado en este pedido
  } else if ($tipoCuenta == "Encargado") {
    return ""; //No se añade condición, devuelve todos los pedidos.
  } else { //Error al detectar tipoCuenta
    return " and '0' == '1'"; //Si el tipo de cuenta no es válido entonces la consulta no devuelve nada de esta forma
  }
}

function obtenerEtapas($ordenActual, $idTipoPedido ,$hayArreglos, $hayServiciosAdicionales){
  $etapaAnterior = null;
  $etapaPosterior = null;


  if ($ordenActual == 1){
          $etapaAnterior = null;
          if ($hayServiciosAdicionales){
            $etapaPosterior = $ordenActual +1;
          } else if (!$hayServiciosAdicionales) {
            $etapaPosterior = 4;
          }
        } else if ($ordenActual == 4){
          $etapaPosterior = $ordenActual +1;
          if ($hayArreglos || $hayServiciosAdicionales){
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
  $db = mysqli_connect(SERVIDOR_BD,USUARIO_BD,CONTRASENA_BD,NOMBRE_BD);
  if ($stmtA = $db->prepare(
    "SELECT te.nombre nombreTipoEtapa
    FROM  TipoEtapa te, TipoEtapasportipopedido oe, tipoPedido tp
    WHERE  oe.ordenEtapa = ? AND tp.idTipoPedido = ? AND te.idTipoEtapa = oe.idTipoEtapa AND tp.idTipoPedido = oe.idTipoPedido"
  )) {
    $stmtA->bind_param('ss', $etapaAnterior, $idTipoPedido);
    $stmtA->execute();
    $stmtA->store_result();
    $stmtA->bind_result($nombreTipoEtapaAnterior);
    $stmtA->fetch();
  }

    if ($stmtB = $db->prepare(
      "SELECT te.nombre nombreTipoEtapa
      FROM  TipoEtapa te, TipoEtapasportipopedido oe, tipoPedido tp
      WHERE  oe.ordenEtapa = ? AND tp.idTipoPedido = ? AND te.idTipoEtapa = oe.idTipoEtapa AND tp.idTipoPedido = oe.idTipoPedido"
    )) {
      $stmtB->bind_param('ss', $etapaPosterior,$idTipoPedido);
      $stmtB->execute();
      $stmtB->store_result();
      $stmtB->bind_result($nombreTipoEtapaPosterior);
      $stmtB->fetch();
    }

  return array ("nombreTipoEtapaPosterior" => $nombreTipoEtapaPosterior, "nombreTipoEtapaAnterior" => $nombreTipoEtapaAnterior);
}

function consultaSQL(){
  $consulta = "
    SELECT
      te.nombre nombreTipoEtapa,
      p.tipoPrenda tipoPrenda,
      tpedido.nombreTipoPedido nombreTipoPedido,
      tpedido.idTipoPedido idTipoPedido,
      p.esPedidoExpress esExpress,
      tpedido.precio precioBasePedido,
      desperfectos.coste precioDesperfectos,
      serviciosAdicionales.coste precioServiciosAdicionales,
      d.valor porcentajeDescuento,
      primeraEtapa.fechaIni inicioPedido,
      ultimaEtapa.fechaFin finPedido,
      e.fechaIni inicioEtapa,
      desperfectos.descripcion descArreglos,
      serviciosAdicionales.descripcion descServAdic,
      e.empleadoasignado empleadoAsignado,
      oe.ordenEtapa ordenActual,
      te.nombre nombreTipoEtapaActual,
      e.idTipoEtapa idTipoEtapa,
      p.precioAceptado precioAceptado,
      p.idPedido idPedido,
      p.estaCancelado estaCancelado,
      c.nombre nombreCliente,
      c.apellidos apellidosCliente
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
      oe.idTipoPedido = p.idTipoPedido
      AND
        p.estaCancelado = 0
      AND
      oe.ordenEtapa = (
        SELECT IFNULL(MIN(oeB.ordenEtapa),7) FROM tipoetapasportipopedido oeB WHERE oeB.idTipoPedido = p.idTipoPedido AND oeB.idTipoEtapa IN (
          SELECT e.idtipoetapa FROM etapa e
          WHERE (e.fechafin IS NULL OR e.fechaini IS NULL) AND e.idPedido = p.idPedido)
        )
      ".condicionTipoCuenta($_SESSION["tipoCuentaSesión"]) . cSQLBusqueda($_POST["buscarPor"], $_POST["entradaBusqueda"]) . cSQLMostrarUnicamente($_POST["seMuestra"]) . cSQLOrdenarPor($_POST["ordenarPor"]) ;
  $db = mysqli_connect(SERVIDOR_BD,USUARIO_BD,CONTRASENA_BD,NOMBRE_BD);
  if ($stmt = $db->prepare($consulta)) {
    bindParam($stmt,$_SESSION["tipoCuentaSesión"]);
    $stmt->execute();
    return $stmt->get_result();
  }
}

function mostrarPedido($resultadoConsulta){
  while($resultadoConsulta != null && $result = $resultadoConsulta->fetch_assoc()){
    $resultEtapas = obtenerEtapas($result["ordenActual"], $result["idTipoPedido"], $result["descArreglos"] != null,  $result["descServAdic"] != null);
    $alturaMinima = "275px";
    if(!$result["precioAceptado"]){
      $alturaMinima = "325px";
    }
    echo '
      <!-- A partir de aquí comienza la tarjeta que hay que repetir según las consultas -->
      <div class="container-fluid card bg-light" style="min-height: '.$alturaMinima.'; margin-bottom: 20px;">
        <div class="container-fluid">
          <div class="contenedorDeLoDemas ml-0 mr-0">
            <div class="row mt-2" style="height: 35%;">
    ';
    if($result["esExpress"]){
      echo '
              <div class="col-md-4 col-sm-12 my-auto text-center textoExpress ">
                <i class="fas fa-star fa-2x estrellaExpress"></i> Pedido expréss
              </div>
      ';
    } else {
      echo '
              <div class="col-md-4 col-sm-12 my-auto text-center textoExpress ">
                <i class="far fa-star fa-2x estrellaExpress"></i> Pedido normal
              </div>
      ';
    }
    $anchoColumnaCronologia = "col-12 col-md-6";
    if($_SESSION['tipoCuentaSesión'] == "Encargado") {
      $anchoColumnaCronologia = "col-12 col-md-4";
      echo '
      <div class="col-12 col-md-2">
        <h5 style="margin-top: 8px;">Cliente:</h5>
        <div class="row" style="height: 100%;">
          <div class="col-12 text-center h-100 p-0" style="white-space: nowrap;">
            <img src="./img/avatar/avatarCliente.svg" style="width: 35px;"></img> ' . $result["nombreCliente"] . ' ' . $result["apellidosCliente"] .'
          </div>
        </div>
      </div>
      ';
    }
    echo'
              <div class="'.$anchoColumnaCronologia.'">
                <h5 style="margin-top: 8px;">Cronología:</h5>
                <div class="row" style="height: 100%;">
                  <div class="col-4 text-left h-100 p-0" style="white-space: nowrap;">
                    <a style="display:block; margin-left: 20px; font-size: 14px;">Fecha de inicio:</a>
                    <a style="display:block; margin-left: 20px; font-size: 14px;">Fecha de fin:</a>
                  </div>
                  <div class="col-8 text-right h-100 p-0" style="white-space: nowrap; overflow: hidden;">
                    <a style="display:block; margin-left: 20px; font-size: 14px;">'.$result["inicioPedido"].'</a>
                    <a style="display:block; margin-left: 20px; font-size: 14px;">'.$result["finPedido"].'</a>
                  </div>
                </div>
              </div>
            </div>
            <div class="row" style="height: 65%;">
            ';
              $anchoColumnaTipoPedidoTipoPrenda = "col-12 col-sm-6";
              $anchoSubcolumnas = "col-6";
              if($_SESSION['tipoCuentaSesión'] == "Empleado"){
                $anchoColumnaTipoPedidoTipoPrenda = "col-12";
                $anchoSubcolumnas = "col-4";
              }
            echo '
              <div class="'.$anchoColumnaTipoPedidoTipoPrenda.'"><!-- TODO Esta fila puede ser col-6 o col-12 según haya factura o no -->
                <div class="row h-100">
                  <div class="'.$anchoSubcolumnas.' text-center h-100" style="padding-top: 25px;">
                    <h5>Tipo de prenda</h5>
                    <div class="card bg-white mx-auto contenedorTipoServicioTipoPrenda">
                      <img src="./img/tipoPrenda/'.normalizarTexto($result["tipoPrenda"]).'.svg" class="mx-auto my-auto w-75"></img>
                    </div>
                    <div class="text-center" style="position: absolute; width: 69px; background-color: white; height: 12px; left:0; right: 0; margin-left: auto; margin-right: auto; margin-top: -12px; line-height: 18px;">'.$result["tipoPrenda"].'</div>
                  </div>
                  <div class="'.$anchoSubcolumnas.' text-center h-100" style="padding-top: 25px;">
                    <h5>Tipo de servicio</h5>
                    <div class="card bg-white mx-auto contenedorTipoServicioTipoPrenda">
                      <img src="./img/tipoPedido/'.normalizarTexto($result["nombreTipoPedido"]).'.svg" class="mx-auto my-auto w-75"></img>
                    </div>
                    <div class="text-center" style="position: absolute; width: 69px; background-color: white; height: 12px; left:0; right: 0; margin-left: auto; margin-right: auto; margin-top: -12px; line-height: 18px;">'.$result["nombreTipoPedido"].'</div>
                  </div>
                  <div class="'.$anchoSubcolumnas.' text-center h-100" style="padding-top: 25px;">
                    <h5>Etapa asignada</h5>
                    <div class="card bg-white mx-auto contenedorTipoServicioTipoPrenda">';
                    include './consultaPedidosConsultaEtapaAsignada.php';echo'
                    </div>
                  </div>
                </div>
              </div>';
            if($_SESSION['tipoCuentaSesión'] == "Encargado" || $_SESSION['tipoCuentaSesión'] == "Cliente") {
              echo'
              <div class="col-12 col-sm-6">
                <h5 style="margin-top: 15px;">Total desglosado</h5>
                <div class="row h-100">
                  <div class="col-6 text-left h-100">
                    <a class="textoPrecio">Servicio:</a>
                    <a class="textoPrecio">Arreglos solicitados:</a>
                    <a class="textoPrecio">Arreglos extras:</a>
                    <a class="textoPrecio">Descuento:</a>
                    <a class="font-weight-bold totalPrecio">Total (IVA no inc.):</a>
                  </div>
                  <div class="col-6 text-right h-100">
                    <a style="position: absolute; left: 10px; top: 20px; font-size: 20px;">+</a>
                    <a class="textoPrecio">'.$result["precioBasePedido"].' €</a>
                    <a class="textoPrecio">'.$result["precioDesperfectos"].' €</a>
                    <a class="textoPrecio">'.$result["precioServiciosAdicionales"].' €</a>
                    <a class="textoPrecio">(-'.$result["porcentajeDescuento"].'%) -'.number_format(calcularTotalDescuento($result["precioBasePedido"], $result["precioDesperfectos"], $result["precioServiciosAdicionales"], $result["porcentajeDescuento"]), 2, ',', '.').' €</a>
                    <hr class="separadorPrecio">
                    <a class="font-weight-bold totalPrecio">'.calcularPrecioTotal($result["precioBasePedido"], $result["precioDesperfectos"], $result["precioServiciosAdicionales"], $result["porcentajeDescuento"]).'</a>
                  </div>
                </div>
              </div>';
            }
          echo'
            </div>
          </div>
          <div class="contenedorEtapas ml-0 mr-0">
            <div class="container-fluid">
              <h3 style="margin-top: 10px;">Etapas</h3>
              <div class="row mt-3 ml-0 mr-0 justify-content-center" style="height: 125px; position: relative;">
    ';
    if($resultEtapas["nombreTipoEtapaAnterior"] != null){
                echo '<img src="./img/arrowRight.svg" class="flechaIzquierdaTransicionPedidos"></img>';
    }
    if($resultEtapas["nombreTipoEtapaPosterior"] != null){
                echo '<img src="./img/arrowRight.svg" class="flechaDerechaTransicionPedidos"></img>';
    }
    echo '
                <div class="col-4 mx-auto my-auto">
    ';
    if($resultEtapas["nombreTipoEtapaAnterior"] != null){
      echo'
                  <div class="card bg-white mx-auto otrasEtapas">
                    <img src="./img/etapas/'.normalizarTexto($resultEtapas["nombreTipoEtapaAnterior"]).'.svg" class="mx-auto my-auto w-75"></img>
                  </div>
                  <a class="text-center etqEtapaPosteriorAnterior">'.$resultEtapas["nombreTipoEtapaAnterior"].'</a>
      ';
    }
    echo '
                </div>
                <div class="col-4 mx-auto my-auto">
                  <div class="card bg-white mx-auto etapaActual">
                    <img src="./img/etapas/'.normalizarTexto($result["nombreTipoEtapaActual"]).'.svg" class="mx-auto my-auto w-75"></img>
                  </div>
                  <div class="text-center etqEtapaActual">'.$result["nombreTipoEtapaActual"].'</div>
                </div>
                <div class="col-4 mx-auto my-auto">
    ';
    if($resultEtapas["nombreTipoEtapaPosterior"] != null){
      echo '
                  <div class="card bg-white mx-auto otrasEtapas">
                    <img src="./img/etapas/'.normalizarTexto($resultEtapas["nombreTipoEtapaPosterior"]).'.svg" class="mx-auto my-auto w-75"></img>
                  </div>
                  <a class="text-center etqEtapaPosteriorAnterior">'.$resultEtapas["nombreTipoEtapaPosterior"].'</a>
      ';
    }
    echo '
                </div>
              </div>
            </div>
            <div class="container-fluid text-center mt-3 mb-2 h-25">
  ';
  if($_SESSION["tipoCuentaSesión"] == "Cliente") {
    if($result["precioAceptado"]){
    echo '
                <form action="./detallesPedido" method="POST">
                  <input type="submit" class="btn btn-primary btn-lg" value="Detalles del pedido">
                  <input type="hidden" name="idPedido" value="'.$result["idPedido"].'">
                  <input type="hidden" name="ordenVerEtapa" value="'.$result["ordenActual"].'">
                  <input type="hidden" name="ordenEtapaActual" value="'.$result["ordenActual"].'">
                </form>
    ';
    } else {
    echo '
                <button type="button" onclick="cancelarPedido('.$result["idPedido"].')" class="btn btn-danger btn-lg btn-cancelar-pedido">Cancelar pedido</button>
                <button type="button" class="btn btn-primary btn-lg btn-aceptar-precio-actualizado">Aceptar precio actualizado</button>//TODO falta hacer lo de aceptar precio actualizado
    ';
    }
  } else if ($_SESSION["tipoCuentaSesión"] == "Empleado") {
    echo '
                <form action="./detallesPedido" method="POST">
                  <input type="submit" class="btn btn-primary btn-lg" value="Detalles del pedido">
                  <input type="hidden" name="idPedido" value="'.$result["idPedido"].'">
                  <input type="hidden" name="ordenVerEtapa" value="'.$result["ordenActual"].'">
                  <input type="hidden" name="ordenEtapaActual" value="'.$result["ordenActual"].'">
                </form>
    ';
  } else if ($_SESSION["tipoCuentaSesión"] == "Encargado"){
    if($result["precioAceptado"]){
    echo '
                <form action="./detallesPedido.php" method="POST">
                  <input type="submit" class="btn btn-primary btn-lg" value="Detalles del pedido">
                  <input type="hidden" name="idPedido" value="'.$result["idPedido"].'">
                  <input type="hidden" name="ordenVerEtapa" value="'.$result["ordenActual"].'">
                  <input type="hidden" name="ordenEtapaActual" value="'.$result["ordenActual"].'">
                </form>
    ';
    } else {
    echo '
                <button type="button" onclick="cancelarPedido('.$result["idPedido"].')" class="btn btn-danger btn-lg btn-cancelar-pedido">Cancelar pedido</button>
                <form action="./detallesPedido" method="POST">
                  <input type="submit" class="btn btn-primary btn-lg btn-aceptar-precio-actualizado" value="Detalles del pedido">
                  <input type="hidden" name="idPedido" value="'.$result["idPedido"].'">
                  <input type="hidden" name="ordenVerEtapa" value="'.$result["ordenActual"].'">
                  <input type="hidden" name="ordenEtapaActual" value="'.$result["ordenActual"].'">
                </form>
    ';
    }
  }
  echo'
            </div>
          </div>
        </div>
      </div>
      <!-- A partir de aquí termina la tarjeta que hay que repetir según las consultas -->
    ';
  }
}

function cSQLOrdenarPor($ordenarPor){
  if($ordenarPor == 'tipoPrenda'){
    return ' ORDER BY p.tipoPrenda ASC';
  } else if($ordenarPor == 'fechaIniAsc'){
    return ' ORDER BY primeraEtapa.fechaIni ASC';
  } else if($ordenarPor == 'fechaIniDesc'){
    return ' ORDER BY primeraEtapa.fechaIni DESC';
  } else if($ordenarPor == 'fechaFinAsc'){
    return ' ORDER BY ultimaEtapa.fechaFin ASC';
  } else if($ordenarPor == 'fechaFinDesc'){
    return ' ORDER BY ultimaEtapa.fechaFin DESC';
  } else if($ordenarPor == 'express'){
    return ' ORDER BY p.esPedidoExpress DESC, primeraEtapa.fechaIni DESC';
  } else {
    return '';
  }
}

function cSQLBusqueda($nombreColumna, $texto){
  $sqlColumna = "";
  if ($nombreColumna == "tipoPrenda"){
    $sqlColumna = "primeraEtapa.fechaIni";
  } else if ($nombreColumna == "fechaPedido"){
    $sqlColumna = "e.fechaIni";
  } else if ($nombreColumna == "nombreCliente"){
    $sqlColumna =  "CONCAT(c.nombre, ' ', c.apellidos)";
  }

  if(isset($texto) && !is_null($texto) && !empty($texto) && $sqlColumna != "") {
    if($nombreColumna == "nombreCliente"){
      return ' AND ' . $sqlColumna . ' LIKE "%' . $texto .'%"';

    } else {
      return ' AND ' . $sqlColumna . ' LIKE "' . $texto .'%"';
    }
  } else {
    return "";
  }
}

function cSQLMostrarUnicamente($mostrar){
  if($mostrar == "todo"){
    return "";
  } else if($mostrar == "porRealizar") {
    return ' And primeraEtapa.fechaIni IS NOT NULL AND  primeraEtapa.fechaFin IS NULL';
  } else if($mostrar == "enProceso") {
    return ' And primeraEtapa.fechaIni IS NOT NULL AND  primeraEtapa.fechaFin IS NOT NULL  AND  ultimaEtapa.fechaFin IS NULL';
  } else if($mostrar == "finalizado") {
    return ' And ultimaEtapa.fechaFin IS NOT NULL';
  } else {
    return '';
  }
}

mostrarPedido(consultaSQL());
?>
