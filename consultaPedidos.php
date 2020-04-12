<?php
include './header.php';
if(!isset($_SESSION['sesionIniciada']) || $_SESSION['tipoCuentaSesión'] == "ERROR"){
  header("Location: ./");
}
?>
<link href="./css/consultaPedidos.css" rel="stylesheet">
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
<div class="container-fluid">
  <div class="row" style="margin-top:16px;">
    <div class="col-2"></div>
    <div class="col-2">
      <div class="form-group">
        <label class="etiquetaElementosFormulario" for="aaaa">Mostrar:</label>
        <select class="custom-select" id="aaaa">
          <option selected>Por realizar</option>
          <option value="1">Finalizado</option>
          <option value="2">En proceso</option>
          <option value="3">Todo</option>
        </select>
      </div>
    </div>
    <link href="./fontawesome/css/all.css" rel="stylesheet"> <!--load all styles -->
    <div class="col-2">
      <label class="etiquetaElementosFormulario" for="aaaa">Ordenar por:</label>
      <select class="custom-select">
        <option selected>Express</option>
        <option value="1">Fecha de toma de pedido (ascendente)</option>
        <option value="2">Fecha de toma de pedido (descendente)</option>
        <option value="2">Fecha de fin de pedido (descendente)</option>
        <option value="2">Fecha de fin de pedido (descendente)</option>
      </select>
    </div>
    <div class="col-4">
      <div class="input-group" style="margin-top: 25px;">
        <div class="input-group-prepend">
          <select class="custom-select btn bg-light">
            <option selected>Nombre de cliente</option>
            <option value="1">Fecha de pedido</option>
            <option value="2">Tipo de prenda</option>
          </select>
        </div>
        <input type="text" class="form-control" placeholder="Búsqueda..." style="border-bottom-right-radius: 0.25rem; border-top-right-radius: 0.25rem; ">
        <button type="submit" class="btn btn-primary" style="margin-left: 16px; margin-top: -10px;" form="" ><i class="fas fa-search"></i></button>
      </div>
    </div>
    <div class="col-2"></div>
  </div>
  <div class="row">
    <div class="col-2"></div>
    <div class="col-8" style=" ">
      <div class="container-fluid card" style="height: 60vh; padding: 0px;">
        <div class="card-body" style="overflow-y: auto;">
          <!-- A partir de aquí comienza la tarjeta que hay que repetir según las consultas -->
          <div class="container-fluid card bg-secondary" style="height: 250px; margin-bottom: 20px;">
            <div class="row" style="height: 100%;">
              <div class="col-8 container-fluid" style="background-color: green; opacity: 0.3;">
                <div class="row" style="height: 35%;">
                  <div class="col-4" style="background-color: orange; opacity: 0.3;">Pedido express
                  </div>
                  <div class="col-4" style="background-color: yellow; opacity: 0.3;">Fecha de inicio: XX/XX/XXXX
                  </div>
                  <div class="col-4" style="background-color: yellow; opacity: 0.3;">Fecha de fin: XX/XX/XXXX
                  </div>
                </div>
                <div class="row" style="height: 65%;">
                  <div class="col-6" style="background-color: orange; opacity: 0.3;">cccc
                  </div>
                  <div class="col-6" style="background-color: yellow; opacity: 0.3;">ddd
                  </div>
                </div>
              </div>
              <div class="col-4 container-fluid" style="background-color: blue; opacity: 0.3;">bbbb</div>
            </div>
          </div>
          <!-- A partir de aquí termina la tarjeta que hay que repetir según las consultas -->
          <!-- A partir de aquí comienza la tarjeta que hay que repetir según las consultas -->
          <div class="container-fluid card bg-secondary" style="height: 250px; margin-bottom: 20px;">
            <div class="row" style="height: 100%;">
              <div class="col-8 container-fluid" style="background-color: green; opacity: 0.3;">
                <div class="row" style="height: 35%;">
                  <div class="col-4" style="background-color: orange; opacity: 0.3;">Pedido express
                  </div>
                  <div class="col-4" style="background-color: yellow; opacity: 0.3;">Fecha de inicio: XX/XX/XXXX
                  </div>
                  <div class="col-4" style="background-color: yellow; opacity: 0.3;">Fecha de fin: XX/XX/XXXX
                  </div>
                </div>
                <div class="row" style="height: 65%;">
                  <div class="col-6" style="background-color: orange; opacity: 0.3;">cccc
                  </div>
                  <div class="col-6" style="background-color: yellow; opacity: 0.3;">ddd
                  </div>
                </div>
              </div>
              <div class="col-4 container-fluid" style="background-color: blue; opacity: 0.3;">bbbb</div>
            </div>
          </div>
          <!-- A partir de aquí termina la tarjeta que hay que repetir según las consultas -->
          <!-- A partir de aquí comienza la tarjeta que hay que repetir según las consultas -->
          <div class="container-fluid card bg-secondary" style="height: 250px; margin-bottom: 20px;">
            <div class="row" style="height: 100%;">
              <div class="col-8 container-fluid" style="background-color: green; opacity: 0.3;">
                <div class="row" style="height: 35%;">
                  <div class="col-4" style="background-color: orange; opacity: 0.3;">Pedido express
                  </div>
                  <div class="col-4" style="background-color: yellow; opacity: 0.3;">Fecha de inicio: XX/XX/XXXX
                  </div>
                  <div class="col-4" style="background-color: yellow; opacity: 0.3;">Fecha de fin: XX/XX/XXXX
                  </div>
                </div>
                <div class="row" style="height: 65%;">
                  <div class="col-6" style="background-color: orange; opacity: 0.3;">cccc
                  </div>
                  <div class="col-6" style="background-color: yellow; opacity: 0.3;">ddd
                  </div>
                </div>
              </div>
              <div class="col-4 container-fluid" style="background-color: blue; opacity: 0.3;">bbbb</div>
            </div>
          </div>
          <!-- A partir de aquí termina la tarjeta que hay que repetir según las consultas -->
          <!-- A partir de aquí comienza la tarjeta que hay que repetir según las consultas -->
          <div class="container-fluid card bg-secondary" style="height: 250px; margin-bottom: 20px;">
            <div class="row" style="height: 100%;">
              <div class="col-8 container-fluid" style="background-color: green; opacity: 0.3;">
                <div class="row" style="height: 35%;">
                  <div class="col-4" style="background-color: orange; opacity: 0.3;">Pedido express
                  </div>
                  <div class="col-4" style="background-color: yellow; opacity: 0.3;">Fecha de inicio: XX/XX/XXXX
                  </div>
                  <div class="col-4" style="background-color: yellow; opacity: 0.3;">Fecha de fin: XX/XX/XXXX
                  </div>
                </div>
                <div class="row" style="height: 65%;">
                  <div class="col-6" style="background-color: orange; opacity: 0.3;">cccc
                  </div>
                  <div class="col-6" style="background-color: yellow; opacity: 0.3;">ddd
                  </div>
                </div>
              </div>
              <div class="col-4 container-fluid" style="background-color: blue; opacity: 0.3;">bbbb</div>
            </div>
          </div>
          <!-- A partir de aquí termina la tarjeta que hay que repetir según las consultas -->
        </div>
      </div>
    <div class="col-2"></div>
  </div>
</div>
<!--
/* CLIENTES
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
