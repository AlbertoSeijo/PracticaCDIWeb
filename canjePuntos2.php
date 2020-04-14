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

<link rel=stylesheet type="text/css" href="./css/canjePuntos.css">
<script src="./js/canjePuntos.js" language="javascript" type="text/javascript"></script>



<div class="container-fluid">
  <div class="row">
    <div class="col margen-superior-col1">
      <div class="text-center">
        <img src="./img/tarjetaPuntos.svg" width="350" height="auto" alt="" class="rounded">
        <h4><b>1234 - 5678 - 9012</b></h4>
      <div class="row margen-puntos">
        <div class="col">
          <h6><b>Puntos:</b></h6>
        </div>
        <div class="col">
          <h6><b>2350</b></h6>
        </div>
      </div>
      <button type="button" class="btn btn-info btn-continuarPedido"><h4>Continuar con el pedido</h4></button>
      </div>
   </div>


   <div class="col-4">
      <h3><b>Descuentos</b></h3>
      <div class="card bg-primary text-black contenedor-descuentos">
        <div class="card-body">
          <div class="card espacios-descuentos">
            <div class="card-body">
              <img src="./img/tarjetaPuntos.svg" width="50" height="auto" alt="" class="rounded">33% de descuento
            </div>
          </div>
          <div class="card espacios-descuentos">
            <div class="card-body">
              <img src="./img/tarjetaPuntos.svg" width="50" height="auto" alt="" class="rounded">33% de descuento
            </div>
          </div>
          <div class="card espacios-descuentos">
            <div class="card-body">
              <img src="./img/tarjetaPuntos.svg" width="50" height="auto" alt="" class="rounded">33% de descuento
            </div>
          </div>
          <div class="card espacios-descuentos">
            <div class="card-body">
              <img src="./img/tarjetaPuntos.svg" width="50" height="auto" alt="" class="rounded">33% de descuento
            </div>
          </div>
          <div class="card espacios-descuentos">
            <div class="card-body">
              <img src="./img/tarjetaPuntos.svg" width="50" height="auto" alt="" class="rounded">33% de descuento
            </div>
          </div>
          <div class="card espacios-descuentos container-fluid bg-light">
            <div class="row" style="height: 90px;">
              <div class="col-2" style="padding: 0px;">
                <div class="card bg-white" style="width: 70px; height: 70px; position: absolute; top: 50%; left: 50%; transform: translateX(-50%) translateY(-50%);">
                  <img src="./img/canjePuntos/iconosTipoDescuento/iconoRegalo.svg" style="width: 50px; height: 50px; position: absolute; top: 50%; left: 50%; transform: translateX(-50%) translateY(-50%);"></img>
                  <img src="./img/canjePuntos/iconosTipoDescuento/iconoDescuento.svg" style="width: 25px; height: 25px; position: absolute; bottom: -7px; right: -7px;"></img>
                </div>
              </div>
              <div class="col-10 text-center align-middle" style="height: 100%; overflow: hidden;">
                <a style="display: block; width: 100%; font-weight: bold; font-size: 20px;">Titulo de promoción</a>
                <a style="display: block; width: 100%; font-weight: bold; font-size: 16px;">Descripción (algo larga para ver lo que realmente...</a>
                <a style="position: absolute; bottom: 6px; right: 6px; font-size: 14px;">99999 puntos</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>


    <div class="col-4">
      <h3><b>Regalos</b></h3>
      <div class="card bg-primary text-black contenedor-descuentos">
        <div class="card-body" >
          <div class="card espacios-descuentos">
            <div class="card-body">
              <img src="./img/tarjetaPuntos.svg" width="50" height="auto" alt="" class="rounded">33% de descuento
            </div>
          </div>
          <div class="card espacios-descuentos">
            <div class="card-body">
              <img src="./img/tarjetaPuntos.svg" width="50" height="auto" alt="" class="rounded">33% de descuento
            </div>
          </div>
          <div class="card espacios-descuentos">
            <div class="card-body">
              <img src="./img/tarjetaPuntos.svg" width="50" height="auto" alt="" class="rounded">33% de descuento
            </div>
          </div>
          <div class="card espacios-descuentos">
            <div class="card-body">
              <img src="./img/tarjetaPuntos.svg" width="50" height="auto" alt="" class="rounded">33% de descuento
            </div>
          </div>
          <div class="card espacios-descuentos">
            <div class="card-body">
              <img src="./img/tarjetaPuntos.svg" width="50" height="auto" alt="" class="rounded">33% de descuento
            </div>
          </div>
          <div class="card espacios-descuentos">
            <div class="card-body">
              <img src="./img/tarjetaPuntos.svg" width="50" height="auto" alt="" class="rounded">33% de descuento
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
