<?php
include './header.php';
if(!isset($_SESSION['sesionIniciada']) || $_SESSION['tipoCuentaSesión'] != "Cliente"){
  header("Location: ./");
}
?>
<?php
$nombrePagina = "Detalles del pedido";
include './cabeceraContenido.php';
?>

/*
SELECT t.nombre
FROM tipoetapa t INNER JOIN etapa e ON e.idEtapa = t.idEtapa
WHERE e.idpedido = ?;

(SI TIENE)
SELECT t.nombre
FROM tipoetapa t INNER JOIN etapa e ON e.idEtapa = t.idEtapa
WHERE t.idEtapa = t.idEtapa-1 AND e.idpedido = ?;
SELECT t.nombre
FROM tipoetapa t INNER JOIN etapa e ON e.idEtapa = t.idEtapa
WHERE t.idEtapa = t.idEtapa+1 AND e.idpedido = ?;

SELECT idTipoPedido, tipoPrenda, esPedidoExpress, fechaIni, fechaFin, empleadoasignado,
FROM pedidos p INNER JOIN etapa e ON p.idPedido = e.idPedido
WHERE e.idpedido = ?;
(SELECT idTipoPedido, tipoPrenda, esPedidoExpress, fechaIni, fechaFin
FROM pedidos p INNER JOIN etapa e ON p.idPedido = e.idPedido
WHERE e.idpedido = ?;
AÑADIR A CLIENTE EL PRECIO)

SELECT fechaIni FROM etapa WHERE idpedido = ? AND idEtapa = 1;

INSERT INTO arreglos VALUES (idDesperfectos, ?, ?, idPedido, idTipoPedido, clientepedido, null, Servicio_adicional);
INSERT INTO arreglos VALUES (idDesperfectos, ?, ?, idPedido, idTipoPedido, clientepedido, null, Desperfecto);
*/

<?php
include './footer.php';
?>
