<?php
include './header.php';?>
<link href="./css/canjePuntos.css" rel="stylesheet">
<?php
$nombrePagina = "Canje de puntos";
include './cabeceraContenido.php';
?>

<div class="container-fluid">
  <div class="row contenedor-titulo">
    <div class="col-12 text-center"><h2>Introduce la tarjeta de puntos del cliente</h2></div>
  </div>
  <div class="row text-center contenedor-imagen-tarjeta">
    <div class="col">
      <img draggable="false" id="imagen-tarjeta" src="./img/tarjetaPuntos.svg"></img>
    </div>
  </div>
  <div class="row justify-content-center">
    <div class="col-6 col-lg-4 col-md-6 col-sm-8">
      <form>
        <div class="form-row">
          <div class="col">
            <input type="text" class="form-control text-center input-tarjetaCliente" id="tarjetaInput1" placeholder="XXXX" maxlength="4">
          </div>
          <div class="col contenedor-entradaTarjeta-central">
            <a class="separador-numTarjeta-izquierdo">-</a>
            <input type="text" class="form-control text-center input-tarjetaCliente" id="tarjetaInput2"  placeholder="XXXX" maxlength="4">
            <a class="separador-numTarjeta-derecho">-</a>
          </div>
          <div class="col">
            <input type="text" class="form-control text-center input-tarjetaCliente" id="tarjetaInput3" placeholder="XXXX" maxlength="4">
          </div>
        </div>
      </form>
    </div>
  </div>
  <div class="row text-center contenedor-botones-continuar">
    <div class="col-12 text-center justify-content-center">
      <button class="btn btn-primary btn-lg btn-continuar">Continuar</button><hr class="separadorBotones">
      <button class="btn btn-primary btn-lg btn-sin-tarjeta">Tramitar pedido sin aplicar descuentos</button>
    </div>
  </div>
</div>
<script src="./js/canjePuntos.js"></script>
<?php
include './footer.php';
?>
