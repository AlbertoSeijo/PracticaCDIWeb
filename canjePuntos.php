<?php
include './header.php';
if(!isset($_SESSION['sesionIniciada']) || $_SESSION['tipoCuentaSesión'] != "Encargado" || !isset($_POST["idPedido"])){
  header("Location: ./");
}
?>
<link href="./css/canjePuntos.css" rel="stylesheet">

<?php
$varIdPedido = $_POST["idPedido"];
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
            <a class="separador-numTarjeta-izquierdo" style="margin-top:10px;">-</a>
            <input type="text" class="form-control text-center input-tarjetaCliente" id="tarjetaInput2"  placeholder="XXXX" maxlength="4">
            <a class="separador-numTarjeta-derecho" style="margin-top:10px;">-</a>
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
      <?php
      echo '
      <form id="idPedidoContinuar" method="POST" action="./canjePuntos2" style="display: none">
        <input type="hidden" name="idPedidoC" value='.$varIdPedido.'>
        <input type="submit" style="visibility:hidden;">
      </form>
      <form id="idPedidoSinDesc" method="POST" action="./resumenPedido" style="display: none">
        <input type="hidden" name="idPedidoS" value='.$varIdPedido.'>
        <input type="submit" style="visibility:hidden;">
      </form>
      <button class="btn btn-primary btn-lg btn-continuar" onclick="tarjetavalida();">Continuar</button>
      <hr class="separadorBotones">
      <button class="btn btn-primary btn-lg btn-sin-tarjeta" onclick="pasarResumen()">Tramitar pedido sin aplicar descuentos</button>';?>
    </div>
  </div>
</div>
<script src="./js/canjePuntos.js"></script>
<?php
include './footer.php';
?>
