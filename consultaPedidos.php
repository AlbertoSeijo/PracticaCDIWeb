<?php
include './header.php';
if(!isset($_SESSION['sesionIniciada']) || $_SESSION['tipoCuentaSesión'] == "ERROR"){
  header("Location: ./");
}
?>

<link href="./css/peticionDeLimpieza.css" rel="stylesheet">
<?php
$nombrePagina = "Petición de limpieza";
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
ORDER BY tipoPrenda DESC;
*/

/* ENCARGADO
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
ORDER BY tipoPrenda DESC;
*/

/* EMPLEADO
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
ORDER BY tipoPrenda DESC;
*/

<?php
include './footer.php';
?>
