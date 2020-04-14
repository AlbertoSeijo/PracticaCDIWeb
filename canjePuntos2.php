<?php
include './header.php';
if(!isset($_SESSION['sesionIniciada']) || $_SESSION['tipoCuentaSesión'] != "Encargado"){
  header("Location: ./");
}
?>
<?php
$nombrePagina = "Canjeo de regalos y descuentos";
include './cabeceraContenido.php';
?>

<link rel=stylesheet type="text/css" href="canjePuntos.css">
<script src="canjePuntos.js" language="javascript" type="text/javascript"></script>



<div class="container-fluid">
  <div class="row">
    <div class="col">
      <div class="text-center">
      <img src="./img/tarjetaPuntos.svg" width="300" height="auto" alt="" class="rounded">
      <h4><b>1234 - 5678 - 9012</b></h4>
      </div>
      <div class="row">
        <div class="col">
          <h6><b>Puntos:</b></h6>
      </div>
      <div class="col-rigth">
        <h6><b>2350</b></h6>
      </div>
     </div>
     <div class="text-center">
     <button type="button" class="btn btn-info"><h4>Continuar con el pedido</h4></button>
   </div>
   </div>


    <div class="col">
      <h3>DESCUENTOS</h3>
      <div class="card bg-primary text-white">
        <div class="card-body">
      <div class="card">
        <div class="card-body">
          <img src="./img/tarjetaPuntos.svg" width="50" height="auto" alt="" class="rounded">33% de descuento
        </div>
      </div>
      <div class="card">
        <div class="card-body">
          <img src="./img/tarjetaPuntos.svg" width="50" height="auto" alt="" class="rounded">33% de descuento
        </div>
      </div>
      <div class="card">
        <div class="card-body">
          <img src="./img/tarjetaPuntos.svg" width="50" height="auto" alt="" class="rounded">33% de descuento
        </div>
      </div>
      <div class="card">
        <div class="card-body">
          <img src="./img/tarjetaPuntos.svg" width="50" height="auto" alt="" class="rounded">33% de descuento
        </div>
      </div>
      <div class="card">
        <div class="card-body">
          <img src="./img/tarjetaPuntos.svg" width="50" height="auto" alt="" class="rounded">33% de descuento
        </div>
      </div>
      </div>
      </div>
    </div>


    <div class="col">
      <h3>REGALOS</h3>
      <div class="card bg-primary text-white">
        <div class="card-body">
      <div class="card">
        <div class="card-body">
          <img src="./img/tarjetaPuntos.svg" width="50" height="auto" alt="" class="rounded">33% de descuento
        </div>
      </div>
      <div class="card">
        <div class="card-body">
          <img src="./img/tarjetaPuntos.svg" width="50" height="auto" alt="" class="rounded">33% de descuento
        </div>
      </div>
      <div class="card">
        <div class="card-body">
          <img src="./img/tarjetaPuntos.svg" width="50" height="auto" alt="" class="rounded">33% de descuento
        </div>
      </div>
      <div class="card">
        <div class="card-body">
          <img src="./img/tarjetaPuntos.svg" width="50" height="auto" alt="" class="rounded">33% de descuento
        </div>
      </div>
      <div class="card">
        <div class="card-body">
          <img src="./img/tarjetaPuntos.svg" width="50" height="auto" alt="" class="rounded">33% de descuento
        </div>
      </div>
      </div>
      </div>
    </div>
    </div>
  </div>
</div>



<?php
include './footer.php';
?>
