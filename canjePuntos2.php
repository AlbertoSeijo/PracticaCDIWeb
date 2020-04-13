<?php
include './header.php';
if(!isset($_SESSION['sesionIniciada']) || $_SESSION['tipoCuentaSesión'] != "Encargado"){
  header("Location: ./");
}
?>
<?php
$nombrePagina = "canjePuntos";
include './cabeceraContenido.php';
?>

<link rel=stylesheet type="text/css" href="canjePuntos.css">
<script src="canjePuntos.js" language="javascript" type="text/javascript"></script>



<div class="container">
  <div class="row">
    <div class="col">
      <div class="text-center">
      <img src="..." alt="..." class="rounded">
      <p>1234 - 5678 - 9012</p>
      <p  align="left">Puntos:</p> <p align="rigth">2350</p>
      </div>
    </div>

    <div class="col">
      <div class="row">

    </div>
    <div class="col">
      <div class="row">

    </div>
  </div>
</div>



<?php
include './footer.php';
?>
