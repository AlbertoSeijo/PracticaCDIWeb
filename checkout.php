<?php
include './header.php';
if(!isset($_SESSION['sesionIniciada']) || $_SESSION['tipoCuentaSesión'] != "Cliente"){
  header("Location: ./");
}
?>
<?php
$nombrePagina = "Resumen del Pedido";
include './cabeceraContenido.php';
?>

/*
fechainipedido, fechafinpedido

SELECT nombreTipoPedido, tipoPrenda, esPedidoExpress
FROM tipopedido tp INNER JOIN pedido p ON tp.idTipoPedido = p.idTipoPedido
WHERE p.idPedido = ?;

SELECT fechaIni AS fechainipedido
FROM pedido
WHERE idPedido = ? AND idEtapa = 1;

INSERT INTO etapa VALUES (fechaIni, ?, idPedido, empleadoasignado, 7);

SELECT descripcion, valor
FROM descuentos d INNER JOIN pedido p ON d.idDescuentos = p.idDescuentos
WHERE p.idPedido = ?;

SELECT descripcion, coste
FROM arreglos a INNER JOIN pedido p ON a.idTipoPedido = p.idTipoPedido
WHERE p.idPedido = ?;

(SI NO HAY DESCUENTOS)
UPDATE tarjeta t
SET t.puntos = $precio*100 + t.puntos
WHERE numtarjeta = ?;
*/

<?php
include './footer.php';
?>
