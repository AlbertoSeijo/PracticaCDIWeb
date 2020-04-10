<?php
include './header.php';
if(!isset($_SESSION['sesionIniciada']) || $_SESSION['tipoCuentaSesión'] != "Cliente"){
  header("Location: ./");
}
?>
<?php
$nombrePagina = "Tarjeta de puntos";
include './cabeceraContenido.php';
?>

/*
SELECT puntos FROM tarjeta WHERE numtarjeta = ?;

SELECT d.puntos, d.valor, d.descripcion
FROM tarjeta t INNER JOIN descuentos d ON t.idCuenta = d.idCuenta
WHERE numtarjeta = ?;

UPDATE tarjeta t INNER JOIN descuentos d ON t.idCuenta = d.idCuenta
SET t.puntos = t.puntos - d.puntos
WHERE numtarjeta = ? AND d.idDescuentos = ?;
*/

<?php
include './footer.php';
?>
