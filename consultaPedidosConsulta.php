<?php
session_start();
/* POST VARIABLES */
function mostrarPedido($tipoCuenta, $esPedidoExpress, $tipoPrenda, $tipoServicio, $etapaAnterior, $etapaActual, $etapaSiguiente){

}


function mostrarPedidoCliente($parametros){

}

function normalizarTexto($texto){//Elimina espacios, acentos y mayúsculas del texto
  $cambioCaracteres = array(
    'A'=>'a', 'B'=>'b', 'C'=>'c', 'D'=>'d', 'E'=>'e', 'F'=>'f', 'G'=>'g', 'H'=>'h', 'I'=>'i',
    'J'=>'j', 'K'=>'k', 'L'=>'l', 'M'=>'m', 'N'=>'n', 'Ñ'=>'ñ', 'O'=>'o', 'P'=>'p', 'Q'=>'q',
    'R'=>'r', 'S'=>'s', 'T'=>'t', 'U'=>'u', 'V'=>'v', 'W'=>'w', 'X'=>'x', 'Y'=>'y', 'Z'=>'z',
    ' '=>'',
    'Á'=>'a', 'É'=>'e', 'Í'=>'i', 'Ó'=>'o', 'Ú'=>'u',
    'á'=>'a', 'é'=>'e', 'í'=>'i', 'ó'=>'o', 'ú'=>'u',
  );
  return strtr($texto, $cambioCaracteres);

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


function consultaSQLCliente($consulta, $tiposParametros, $listaParametros){

  $resultado;
  $contador = 0;


  $db = mysqli_connect(SERVIDOR_BD,USUARIO_BD,CONTRASENA_BD,NOMBRE_BD);
  //echo $consulta;
  if ($stmt = $db->prepare($consulta)) {
    $stmt->bind_param($tiposParametros, $listaParametros);
    $stmt->execute();
    $stmt->store_result();
    $stmt->bind_result($idPedido, $tipoPrenda, $nombreTipoPedido, $esPedidoExpress, $nombreCliente, $apellidosCliente, $precioBasePedido, $precioDesperfectos,$precioServiciosAdicionales,$porcentajeDescuento,$inicioPedido,$finPedido,$precioAceptado);
    while ($stmt->fetch()) {

      $calculoPrecioTotal = calcularPrecioTotal($precioBasePedido, $precioDesperfectos, $precioServiciosAdicionales, $porcentajeDescuento);

      echo '
        <!-- A partir de aquí comienza la tarjeta que hay que repetir según las consultas -->
        <div class="container-fluid card bg-light" style="height: 250px; margin-bottom: 20px;">
          <div class="row" style="height: 100%;">
            <div class="col-8 container-fluid" style="">
              <div class="row" style="height: 35%;">
      ';
      if($esPedidoExpress){
        echo '
                <div class="col-4 my-auto text-center" style="font-size: 16px; font-weight: bold;">
                  <i class="fas fa-star fa-2x" style="color:  #f1c40f "></i> Pedido expréss
                </div>
        ';
      } else {
        echo '
                <div class="col-4 my-auto text-center" style=" font-size: 16px; font-weight: bold; ">
                  <i class="far fa-star fa-2x" style="color: #f1c40f"></i> Pedido normal
                </div>
        ';
      }

      echo'
                <div class="col-8" style="">
                  <h5 style="margin-top: 8px;">Cronología:</h5>
                  <div class="row" style="height: 100%;">
                    <div class="col-6 text-left" style="height: 100%; white-space: nowrap;">
                      <a style="display:block; margin-left: 20px; font-size: 14px;">Fecha de inicio:</a>
                      <a style="display:block; margin-left: 20px; font-size: 14px;">Fecha de fin:</a>
                    </div>
                    <div class="col-6 text-right" style="height: 100%; white-space: nowrap;">
                      <a style="display:block; margin-left: 20px; font-size: 14px;">'.$inicioPedido.'</a>
                      <a style="display:block; margin-left: 20px; font-size: 14px;">'.$finPedido.'</a>
                    </div>
                  </div>
                </div>
              </div>
              <div class="row" style="height: 65%;">
                <div class="col-6 " style=""><!-- TODO Esta fila puede ser col-6 o col-12 según haya factura o no -->
                  <div class="row" style="height: 100%;">
                    <div class="col-6 text-center" style="height: 100; padding-top: 25px;">
                      <h5>Tipo de prenda</h5>
                      <div class="card bg-white mx-auto" style="width: 75px; height: 75px;">
                        <img src="./img/tipoPrenda/'.normalizarTexto($tipoPrenda).'.svg" class="mx-auto my-auto" style="width: 75%"></img>
                      </div>
                      <div class="text-center" style="position: absolute; width: 69px; background-color: white; height: 12px; left:0; right: 0; margin-left: auto; margin-right: auto; margin-top: -12px; line-height: 18px;">'.$tipoPrenda.'</div>
                    </div>
                    <div class="col-6 text-center" style="height: 100; padding-top: 25px;">
                      <h5>Tipo de servicio</h5>
                      <div class="card bg-white mx-auto" style="width: 75px; height: 75px;">
                        <img src="./img/tipoPedido/'.normalizarTexto($nombreTipoPedido).'.svg" class="mx-auto my-auto" style="width: 75%"></img>
                      </div>
                      <div class="text-center" style="position: absolute; width: 69px; background-color: white; height: 12px; left:0; right: 0; margin-left: auto; margin-right: auto; margin-top: -12px; line-height: 18px;">'.$nombreTipoPedido.'</div>
                    </div>
                  </div>
                </div>
                <div class="col-6" style="">
                  <h5 style="margin-top: 15px;">Total desglosado</h5>
                  <div class="row" style="height: 100%;">
                    <div class="col-6 text-left" style="height: 100%;">
                      <a style="display:block; margin-left: 20px; font-size: 12px;">Servicio:</a>
                      <a style="display:block; margin-left: 20px; font-size: 12px;">Arreglos solicitados:</a>
                      <a style="display:block; margin-left: 20px; font-size: 12px;">Arreglos extras:</a>
                      <a style="display:block; margin-left: 20px; font-size: 12px;">Descuento:</a>
                      <a class="font-weight-bold" style="display:block; margin-left: 20px;">Total:</a>
                    </div>
                    <div class="col-6 text-right" style="height: 100%;">
                      <a style="position: absolute; left: 10px; top: 20px; font-size: 20px;">+</a>
                      <a style="display:block; margin-left: 20px; font-size: 12px;">'.$precioBasePedido.' €</a>
                      <a style="display:block; margin-left: 20px; font-size: 12px;">'.$precioDesperfectos.' €</a>
                      <a style="display:block; margin-left: 20px; font-size: 12px;">'.$precioServiciosAdicionales.' €</a>
                      <a style="display:block; margin-left: 20px; font-size: 12px;">(-'.$porcentajeDescuento.'%) -'.number_format(calcularTotalDescuento($precioBasePedido, $precioDesperfectos, $precioServiciosAdicionales, $porcentajeDescuento), 2, ',', '.').' €</a>
                      <hr style="margin: 0px; border-width: 2px;">
                      <a class="font-weight-bold" style="display:block; margin-left: 20px;">'.$calculoPrecioTotal.'</a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-4 container-fluid" style="">
              <div class="container-fluid" style="height: 70%;">
                <h3 style="margin-top: 10px;">Etapas</h3>
                <div class="row" style="height: 65%;">
                  <div class="col-4 my-auto" style="">
                    <div class="card bg-white mx-auto" style="width: 75px; height: 75px;">Etapa A</div>
                    <div class="text-center" style="position: absolute; width: 69px; background-color: white; height: 15px;  left:0; right: 0; margin-left: auto; margin-right: auto; margin-top: -15px;">Etapa 1</div>
                  </div>
                  <div class="col-4 my-auto" style="">
                    <i class="fas fa-caret-right fa-4x" style="position: absolute; left: -15px; transform: translate(0%, 20%);"></i>
                    <div class="card bg-white mx-auto" style="width: 90px; height: 90px;">Etapa B</div>
                    <div class="text-center" style="position: absolute; width: 84px; background-color: white; height: 15px;  left:0; right: 0; margin-left: auto; margin-right: auto; margin-top: -15px;">Etapa 2</div>
                  </div>
                  <div class="col-4 my-auto" style="">
                    <i class="fas fa-caret-right fa-4x" style="position: absolute; left: -7px; transform: translate(0%, 10%);"></i>
                    <div class="card bg-white mx-auto" style="width: 75px; height: 75px;">Etapa C</div>
                    <div class="text-center" style="position: absolute; width: 69px; background-color: white; height: 15px; left:0; right: 0; margin-left: auto; margin-right: auto; margin-top: -15px;">Etapa 3</div>
                  </div>
                </div>
              </div>
              <div class="container-fluid text-center" style="height: 30%;">
  ';
  if($precioAceptado){
    echo '
                <form action="./detallesPedido" method="POST">
                  <input type="submit" class="btn btn-primary btn-lg" value="Detalles del pedido">
                  <input type="hidden" name="idPedido" value="'.$idPedido.'">
                </form>
    ';
  } else {
    echo '
                <button type="button" onclick="cancelarPedido("'.$idPedido.'")" class="btn btn-danger btn-lg" style="width: 30%;">Cancelar pedido</button>
                <button type="button" class="btn btn-primary btn-lg" style="width: 60%;">Aceptar precio actualizado</button>
    ';
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
}

function cSQLOrdenarPor($consulta, $ordenarPor){//TODO En la consulta principal hay que hacer que fechaIni y fechaFin sean las del pedido y no las de las etapas
  if($ordenarPor == 'tipoPrenda'){
    return $consulta . ' ORDER BY p.tipoPrenda DESC';
  } else if($ordenarPor == 'fechaIniAsc'){
    return $consulta . ' ORDER BY actualEtapa.fechaIni ASC';
  } else if($ordenarPor == 'fechaIniDesc'){
    return $consulta . ' ORDER BY actualEtapa.fechaIni DESC';
  } else if($ordenarPor == 'fechaFinAsc'){
    return $consulta . ' ORDER BY actualEtapa.fechaFin ASC';
  } else if($ordenarPor == 'fechaFinDesc'){
    return $consulta . ' ORDER BY actualEtapa.fechaFin DESC';
  } else if($ordenarPor == 'express'){
    return $consulta . ' ORDER BY p.esPedidoExpress DESC';
  } else {
    return $consulta;
  }
}

function cSQLBusqueda($consulta, $nombreColumna, $texto){
  if(isset($texto) && !is_null($texto) && !empty($texto)) {
    return $consulta . ' AND ' . $nombreColumna . ' LIKE "^' . $texto .'"';
  } else {
    return $consulta;
  }
}

function cSQLMostrarUnicamente($consulta, $mostrar){
  if($mostrar == "todo"){
    return $consulta;
  } else if($mostrar == "porRealizar") {
    return $consulta . ' And actualEtapa.idTipoEtapa = 1';
  } else if($mostrar == "enProceso") {
    return $consulta . ' And (actualEtapa.idTipoEtapa != 1 OR !(actualEtapa.idTipoEtapa = 7 AND actualEtapa.fechaFin != null)';
  } else if($mostrar == "finalizado") {
    return $consulta . ' And actualEtapa.idTipoEtapa = 7 AND actualEtapa.fechaFin != null';
  } else {
    return $consulta;
  }
}

$seMuestra = $_POST["seMuestra"];
$ordenarPor = $_POST["ordenarPor"];
$buscarPor = $_POST["buscarPor"];
$entradaBusqueda = $_POST["entradaBusqueda"];

define('SERVIDOR_BD', 'localhost:3306');
define('USUARIO_BD', 'webtintoreria');
define('CONTRASENA_BD', 'lavanderia');
define('NOMBRE_BD', 'tintoreria');

$db = mysqli_connect(SERVIDOR_BD,USUARIO_BD,CONTRASENA_BD,NOMBRE_BD);

if($_SESSION['tipoCuentaSesión'] == "Cliente"){//TODO A LA CONSULTA LE FALTAN LAS ETAPAS
  $consultaPrincipalCliente = "
  SELECT
	p.idPedido idPedido,
	p.tipoPrenda tipoPrenda,
	tpedido.nombreTipoPedido,
	p.esPedidoExpress,
	c.nombre nombreCliente,
	c.apellidos apellidosCliente,
	tpedido.precio precioBasePedido,
	desperfectos.coste precioDesperfectos,
	serviciosAdicionales.coste precioServiciosAdicionales,
	d.valor porcentajeDescuento,
	primeraEtapa.fechaIni inicioPedido,
	ultimaEtapa.fechaFin finPedido,
	p.precioAceptado precioAceptado
FROM
	TipoPedido tpedido,
	Cuenta c,
	Etapa primeraEtapa,
	Pedido p
LEFT JOIN Descuento d
	ON p.idDescuentos = d.idDescuentos
LEFT JOIN (SELECT aD.idPedido, aD.idTipoPedido, aD.ClientePedido, aD.coste
		FROM Arreglos aD
		WHERE aD.tipoArreglo = 'Desperfecto') desperfectos
	ON desperfectos.idPedido = p.idPedido AND desperfectos.idTipoPedido = p.idTipoPedido AND desperfectos.ClientePedido = p.ClientePedido
LEFT JOIN (SELECT aSA.idPedido, aSA.idTipoPedido, aSA.ClientePedido, aSA.coste
		FROM Arreglos aSA
		WHERE aSA.tipoArreglo = 'Servicio adicional') serviciosAdicionales
	ON serviciosAdicionales.idPedido = p.idPedido AND serviciosAdicionales.idTipoPedido = p.idTipoPedido AND serviciosAdicionales.ClientePedido = p.ClientePedido
LEFT JOIN (SELECT * FROM Etapa uE WHERE uE.idTipoEtapa = '7' AND uE.fechaFin IS NOT NULL) ultimaEtapa
	ON ultimaEtapa.idPedido = p.idPedido
WHERE
	p.ClientePedido = ?
		AND
	p.idTipoPedido = tpedido.idTipoPedido
		AND
	p.ClientePedido = c.idCuenta
		AND
	primeraEtapa.idPedido = p.idPedido
		AND
	primeraEtapa.idTipoEtapa = '1'



  ";
  $tiposParametrosCliente = 's';
  $parametrosCliente = array($_SESSION['idCuentaSesión']);
  consultaSQLCliente(cSQLOrdenarPor(cSQLBusqueda(cSQLMostrarUnicamente($consultaPrincipalCliente, $seMuestra), $buscarPor, $entradaBusqueda), $ordenarPor),$tiposParametrosCliente,$_SESSION['idCuentaSesión']);
  /*consultaSQL(cSQLOrdenarPor(cSQLBusqueda(cSQLMostrarUnicamente($consultaPrincipal, $seMuestra), $buscarPor, $entradaBusqueda), $ordenarPor), 'i', array("foo", "bar", "hello", "world"), $funcionAnid);//Obtenemos

*/


/*
  if ($stmt = $db->prepare('SELECT p.idPedido, d.valor, p.tipoPrenda, p.esPedidoExpress, tpedido.nombreTipoPedido, tpedido.precio  FROM Pedido p, Descuento d, TipoPedido tpedido WHERE ClientePedido = ? AND p.TipoPedido_idTipoPedido = tpedido.idTipoPedido AND p.Descuentos_idDescuentos  = d.idDescuentos')) {//Preparamos la consulta sql para evitar posibles ataques tipo SQL Injection
    $stmt->bind_param('i', $_SESSION['idCuentaSesión']);//Bindeamos al '?' el correo electrónico que nos ha mandado el usuario a través del formulario. El parámetro 's' indica que es un string.
    $stmt->execute();
    $stmt->store_result();
    if ($stmt->num_rows > 0) {//Si hay más de 0 filas es que se ha encontrado una cuenta con ese correo electrónico.
      $stmt->bind_result($puntos, $numtarjeta);//Guardamos la fila actual en viariables.
      $stmt->fetch();*/
  } else if ($_SESSION['tipoCuentaSesión'] == "Empleado") {



  } else if ($_SESSION['tipoCuentaSesión'] == "Encargado") {



  } else {
    echo 'ERROR: Tipo de cuenta no definido.';
  }
?>
