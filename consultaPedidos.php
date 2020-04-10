<?php
include './header.php';
if(!isset($_SESSION['sesionIniciada']) || $_SESSION['tipoCuentaSesión'] == "ERROR"){
  header("Location: ./");
}
?>

<link href="./css/peticionDeLimpieza.css" rel="stylesheet">
<?php
$nombrePagina = "Consulta de pedidos";
include './cabeceraContenido.php';
?>
<?php
if($_SESSION['tipoCuentaSesión'] != "Encargado"){


} else if($_SESSION['tipoCuentaSesión'] != "Empleado"){


} else if($_SESSION['tipoCuentaSesión'] != "Cliente"){


}

 ?>

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

<?php
include './footer.php';
?>
