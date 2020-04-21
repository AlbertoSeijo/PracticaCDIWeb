<?php
include './header.php';
if(!isset($_SESSION['sesionIniciada']) || $_SESSION['tipoCuentaSesión'] == "ERROR"){
  header("Location: ./");
}
?>
<link href="./css/consultaPedidos.css" rel="stylesheet">
<link href="./fontawesome/css/all.css" rel="stylesheet">
<?php
$nombrePagina = "Consulta de pedidos";
include './cabeceraContenido.php';
?>
<?php
if($_SESSION['tipoCuentaSesión'] != "Encargado"){


} else if($_SESSION['tipoCuentaSesión'] != "Empleado"){


} else if($_SESSION['tipoCuentaSesión'] != "Cliente"){
  echo '';
}

 ?>
 <!--
<div class="container-fluid w-100 h-100" style="position: absolute; top: 0; left: 0; z-index:1000; overflow: hidden;">
  <div class="container-fluid  w-100 h-100" style="background-color: black; filter: opacity(0.5); position: absolute; top: 0; left: 0; z-index:1000">
  </div>
  <div class="row w-100 justify-content-center align-self-center" style="position: absolute; top: 50%;transform: translateY(-50%); z-index:1001;">
    <div class="col-5 card" style="max-height: 500px;">
      <div class="row" style="margin-top: 24px;">
        <div class="col-4 d-flex align-items-center justify-content-center">
          <img style="width:125px;" src="./img/alert.svg" class=""></img>
        </div>
        <div class="col-8">
          <a class="text-center" style="font-weight: bold; font-size: 48px; display:block;">¡Atención!</a>
          <a class="text-center" style="font-size: 32px; display:block;">¿Está seguro de que desea eliminar el pedido?</a>
        </div>
      </div>
      <div class="row" style="margin-bottom: 24px; margin-top: 24px;">
        <div class="col-6 text-center">
          <button type="button" class="btn btn-lg btn-primary">No cancelarlo</button>
        </div>
        <div class="col-6 text-center">
          <button type="button" class="btn btn-lg btn-danger">Cancelar pedido</button>
        </div>
      </div>
    </div>
  </div>
</div>
-->
<form id="consultaPedidosForm"></form>
<div class="container-fluid">
  <div class="row justify-content-center contenedorFiltros">
    <div class="col-xl-2">
      <div class="form-group">
        <label class="etiquetaElementosFormulario" for="aaaa">Mostrar:</label>
        <select id="seMuestra" name="seMuestra" class="custom-select" id="aaaa" form="consultaPedidosForm" onchange="actualizarConsultaPedidos()">
          <option selected value="porRealizar">Por realizar</option>
          <option value="finalizado">Finalizado</option>
          <option value="enProceso">En proceso</option>
          <option value="todo">Todo</option>
        </select>
      </div>
    </div>
    <div class="col-xl-2">
      <label class="etiquetaElementosFormulario" for="aaaa">Ordenar por:</label>
      <select id="ordenarPor" name="ordenarPor" class="custom-select" form="consultaPedidosForm" onchange="actualizarConsultaPedidos()">
        <option selected value="express">Express</option>
        <option value="fechaIniAsc">Fecha de toma de pedido (ascendente)</option>
        <option value="fechaIniDesc">Fecha de toma de pedido (descendente)</option>
        <option value="fechaFinAsc">Fecha de fin de pedido (descendente)</option>
        <option value="fechaFinDesc">Fecha de fin de pedido (descendente)</option>
        <option value="tipoPrenda">Tipo de prenda (alfabético)</option>
      </select>
    </div>
    <div class="col-xl-4">
      <div class="input-group contenedorBusqueda">
        <div class="input-group-prepend">
          <select id="buscarPor" name="buscarPor" class="custom-select btn bg-light" form="consultaPedidosForm" onchange="actualizarConsultaPedidos()">
            <option selected value="c.nombre">Nombre de cliente</option>
            <option value="e.fechaIni">Fecha de pedido</option>
            <option value="p.tipoPrenda">Tipo de prenda</option>
          </select>
        </div>
        <input type="text" id="entradaBusqueda" name="entradaBusqueda" class="form-control" placeholder="Búsqueda..." form="consultaPedidosForm" oninput="actualizarConsultaPedidos()">
        <button type="submit" class="btn btn-primary botonBusqueda" form=""><i class="fas fa-search"></i></button>
      </div>
    </div>
  </div>
  <div class="row justify-content-center">
    <div class="col-xl-8">
      <div class="container-fluid card contElementoContenedorResPed">
        <div class="card-body" id="contenedorResumenesPedidos">
        </div>
      </div>
    </div>
  </div>
</div>
<script src="./js/consultaPedidos.js"></script>
<!--
/* CLIENTES

POR REALIZAR

SELECT idTipoPedido, tipoPrenda, esPedidoExpress, fechaIni, fechaFin
FROM pedidos p INNER JOIN etapa e ON p.idPedido = e.idPedido
WHERE idEtapa = 1 AND fechaIni = 'null' AND clientepedido = ?;
SELECT idTipoPedido, tipoPrenda, esPedidoExpress, fechaIni, fechaFin
FROM pedidos p INNER JOIN etapa e ON p.idPedido = e.idPedido
WHERE idEtapa = 7 AND fechaFin = 'null' AND clientepedido = ?;
SELECT idTipoPedido, tipoPrenda, esPedidoExpress, fechaIni, fechaFin
FROM pedidos p INNER JOIN etapa e ON p.idPedido = e.idPedido
WHERE idEtapa = 7 AND fechaIni != 'null' AND clientepedido = ?;
SELECT idTipoPedido, tipoPrenda, esPedidoExpress, fechaIni, fechaFin
FROM pedidos p INNER JOIN etapa e ON p.idPedido = e.idPedido
WHERE clientepedido = ?;
---------------------------------------------------------------------
SELECT idTipoPedido, tipoPrenda, esPedidoExpress, fechaIni, fechaFin
FROM pedidos p INNER JOIN etapa e ON p.idPedido = e.idPedido
WHERE clientepedido = ?
ORDER BY esPedidoExpress;
SELECT idTipoPedido, tipoPrenda, esPedidoExpress, fechaIni, fechaFin
FROM pedidos p INNER JOIN etapa e ON p.idPedido = e.idPedido
WHERE clientepedido = ?
ORDER BY fechaini ASC;
SELECT idTipoPedido, tipoPrenda, esPedidoExpress, fechaIni, fechaFin
FROM pedidos p INNER JOIN etapa e ON p.idPedido = e.idPedido
WHERE clientepedido = ?
ORDER BY fechaini DESC;
SELECT idTipoPedido, tipoPrenda, esPedidoExpress, fechaIni, fechaFin
FROM pedidos p INNER JOIN etapa e ON p.idPedido = e.idPedido
WHERE clientepedido = ?
ORDER BY fechafin ASC;
SELECT idTipoPedido, tipoPrenda, esPedidoExpress, fechaIni, fechaFin
FROM pedidos p INNER JOIN etapa e ON p.idPedido = e.idPedido
WHERE clientepedido = ?
ORDER BY fechafin DESC;
SELECT idTipoPedido, tipoPrenda, esPedidoExpress, fechaIni, fechaFin
FROM pedidos p INNER JOIN etapa e ON p.idPedido = e.idPedido
WHERE clientepedido = ?
ORDER BY tipoPrenda ASC;
*/

/* ENCARGADO
SELECT idTipoPedido, tipoPrenda, esPedidoExpress, fechaIni, fechaFin
FROM pedidos p INNER JOIN etapa e ON p.idPedido = e.idPedido
WHERE idEtapa = 1 AND fechaIni = 'null';
SELECT idTipoPedido, tipoPrenda, esPedidoExpress, fechaIni, fechaFin
FROM pedidos p INNER JOIN etapa e ON p.idPedido = e.idPedido
WHERE idEtapa = 7 AND fechaFin = 'null';
SELECT idTipoPedido, tipoPrenda, esPedidoExpress, fechaIni, fechaFin
FROM pedidos p INNER JOIN etapa e ON p.idPedido = e.idPedido
WHERE idEtapa = 7 AND fechaIni != 'null';
SELECT idTipoPedido, tipoPrenda, esPedidoExpress, fechaIni, fechaFin
FROM pedidos p INNER JOIN etapa e ON p.idPedido = e.idPedido;
---------------------------------------------------------------------
SELECT idTipoPedido, tipoPrenda, esPedidoExpress, fechaIni, fechaFin
FROM pedidos p INNER JOIN etapa e ON p.idPedido = e.idPedido
ORDER BY esPedidoExpress;
SELECT idTipoPedido, tipoPrenda, esPedidoExpress, fechaIni, fechaFin
FROM pedidos p INNER JOIN etapa e ON p.idPedido = e.idPedido
ORDER BY fechaini ASC;
SELECT idTipoPedido, tipoPrenda, esPedidoExpress, fechaIni, fechaFin
FROM pedidos p INNER JOIN etapa e ON p.idPedido = e.idPedido
ORDER BY fechaini DESC;
SELECT idTipoPedido, tipoPrenda, esPedidoExpress, fechaIni, fechaFin
FROM pedidos p INNER JOIN etapa e ON p.idPedido = e.idPedido
ORDER BY fechafin ASC;
SELECT idTipoPedido, tipoPrenda, esPedidoExpress, fechaIni, fechaFin
FROM pedidos p INNER JOIN etapa e ON p.idPedido = e.idPedido
ORDER BY fechafin DESC;
SELECT idTipoPedido, tipoPrenda, esPedidoExpress, fechaIni, fechaFin
FROM pedidos p INNER JOIN etapa e ON p.idPedido = e.idPedido
ORDER BY tipoPrenda ASC;
---------------------------------------------------------------------
SELECT idTipoPedido, tipoPrenda, esPedidoExpress, fechaIni, fechaFin
FROM pedidos p INNER JOIN etapa e ON p.idPedido = e.idPedido INNER JOIN cuenta c ON c.idCuenta = p.idCuenta
WHERE c.nombre LIKE ?%;
*/

/* EMPLEADO
SELECT idTipoPedido, tipoPrenda, esPedidoExpress, fechaIni, fechaFin
FROM pedidos p INNER JOIN etapa e ON p.idPedido = e.idPedido
WHERE idEtapa = 1 AND fechaIni = 'null' AND empleadoasignado = ?;
SELECT idTipoPedido, tipoPrenda, esPedidoExpress, fechaIni, fechaFin
FROM pedidos p INNER JOIN etapa e ON p.idPedido = e.idPedido
WHERE idEtapa = 7 AND fechaFin = 'null' AND empleadoasignado = ?;
SELECT idTipoPedido, tipoPrenda, esPedidoExpress, fechaIni, fechaFin
FROM pedidos p INNER JOIN etapa e ON p.idPedido = e.idPedido
WHERE idEtapa = 7 AND fechaIni != 'null' AND empleadoasignado = ?;
SELECT idTipoPedido, tipoPrenda, esPedidoExpress, fechaIni, fechaFin
FROM pedidos p INNER JOIN etapa e ON p.idPedido = e.idPedido
WHERE empleadoasignado = ?;
---------------------------------------------------------------------
SELECT idTipoPedido, tipoPrenda, esPedidoExpress, fechaIni, fechaFin
FROM pedidos p INNER JOIN etapa e ON p.idPedido = e.idPedido
WHERE empleadoasignado = ?
ORDER BY esPedidoExpress;
SELECT idTipoPedido, tipoPrenda, esPedidoExpress, fechaIni, fechaFin
FROM pedidos p INNER JOIN etapa e ON p.idPedido = e.idPedido
WHERE empleadoasignado = ?
ORDER BY fechaini ASC;
SELECT idTipoPedido, tipoPrenda, esPedidoExpress, fechaIni, fechaFin
FROM pedidos p INNER JOIN etapa e ON p.idPedido = e.idPedido
WHERE empleadoasignado = ?
ORDER BY fechaini DESC;
SELECT idTipoPedido, tipoPrenda, esPedidoExpress, fechaIni, fechaFin
FROM pedidos p INNER JOIN etapa e ON p.idPedido = e.idPedido
WHERE empleadoasignado = ?
ORDER BY fechafin ASC;
SELECT idTipoPedido, tipoPrenda, esPedidoExpress, fechaIni, fechaFin
FROM pedidos p INNER JOIN etapa e ON p.idPedido = e.idPedido
WHERE empleadoasignado = ?
ORDER BY fechafin DESC;
SELECT idTipoPedido, tipoPrenda, esPedidoExpress, fechaIni, fechaFin
FROM pedidos p INNER JOIN etapa e ON p.idPedido = e.idPedido
WHERE empleadoasignado = ?
ORDER BY tipoPrenda ASC;
----------------------------------------------------------------------
SELECT idTipoPedido, tipoPrenda, esPedidoExpress, fechaIni, fechaFin
FROM pedidos p INNER JOIN etapa e ON p.idPedido = e.idPedido INNER JOIN cuenta c ON c.idCuenta = p.idCuenta
WHERE empleadoasignado = ? AND c.nombre LIKE ?%;
*/
-->
<?php
include './footer.php';
?>
