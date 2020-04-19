<?php
include './header.php';
if(!isset($_SESSION['sesionIniciada']) || $_SESSION['tipoCuentaSesión'] != "Encargado"){
  header("Location: ./");
}
?>
<link href="./css/peticionLimpieza.css" rel="stylesheet">
<?php
$nombrePagina = "Resumen del Pedido";
include './cabeceraContenido.php';
?>






<?php
include './footer.php';
?>
