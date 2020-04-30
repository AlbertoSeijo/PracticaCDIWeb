<?php
include './header.php';
if(!isset($_SESSION['sesionIniciada']) || $_SESSION['tipoCuentaSesión'] != "Encargado" || !isset($_POST["idPedido"])){
  header("Location: ./");
}
?>
<link href="./css/canjePuntos.css" rel="stylesheet">

<?php
$varIdPedido = $_POST["idPedido"];
$nombrePagina = "Aplicar Tarjeta";

$numtarjeta = false;
$idCuenta = false;
include './cabeceraContenido.php';

define('SERVIDOR_BD', 'localhost:3306');
define('USUARIO_BD', 'webtintoreria');
define('CONTRASENA_BD', 'lavanderia');
define('NOMBRE_BD', 'tintoreria');

$db = mysqli_connect(SERVIDOR_BD,USUARIO_BD,CONTRASENA_BD,NOMBRE_BD);

if ($stmt = $db->prepare('SELECT t.numTarjeta FROM tarjeta t INNER JOIN pedido p ON t.idCuenta = p.ClientePedido WHERE p.idPedido = ?')) {
  $stmt->bind_param('i', $varIdPedido);
  $stmt->execute();
  $stmt->store_result();
  if ($stmt->num_rows > 0) {
    $stmt->bind_result($numtarjeta);
    $stmt->fetch();
  }
}
if ($stmt = $db->prepare('SELECT ClientePedido FROM pedido WHERE idPedido = ?')) {
  $stmt->bind_param('i', $varIdPedido);
  $stmt->execute();
  $stmt->store_result();
  $stmt->bind_result($idCuenta);
  $stmt->fetch();
}
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
            <input type="text" class="form-control text-center input-tarjetaCliente" form="idPedidoContinuar" id="tarjetaInput1" name="tarjetaInput1" placeholder="XXXX" maxlength="4">
          </div>
          <div class="col contenedor-entradaTarjeta-central">
            <a class="separador-numTarjeta-izquierdo" style="margin-top:10px;">-</a>
            <input type="text" class="form-control text-center input-tarjetaCliente" form="idPedidoContinuar" id="tarjetaInput2" name="tarjetaInput2" placeholder="XXXX" maxlength="4">
            <a class="separador-numTarjeta-derecho" style="margin-top:10px;">-</a>
          </div>
          <div class="col">
            <input type="text" class="form-control text-center input-tarjetaCliente" form="idPedidoContinuar" id="tarjetaInput3" name="tarjetaInput3" placeholder="XXXX" maxlength="4">
          </div>
        </div>
      </form>
    </div>
  </div>
  <div class="row text-center contenedor-botones-continuar">
    <div class="col-12 text-center justify-content-center">
      <?php
      echo '
        <button '; if($numtarjeta != false) {echo'disabled';} echo' class="btn btn-warning btn-lg btn-nueva-tarjeta" onclick="tarjetavalida('.$varIdPedido.',0,0,'.$idCuenta.')"><b>Crear Nueva Tarjeta</b></button>
        <button class="btn btn-primary btn-lg btn-sin-tarjeta" onclick="pasarSinTarjeta('.$varIdPedido.')">Tramitar pedido sin tarjeta</button>
        <button '; if($numtarjeta == false) {echo'disabled';} echo' class="btn btn-info btn-lg btn-continuar" onclick="tarjetavalida('.$varIdPedido.',1,'.$numtarjeta.','.$idCuenta.')">Continuar</button>
        <button '; if($numtarjeta == false) {echo'disabled';} echo' class="btn btn-primary btn-lg btn-sin-descuentos" onclick="tarjetavalida('.$varIdPedido.',2,'.$numtarjeta.','.$idCuenta.')">Tramitar pedido sin aplicar descuentos</button>';
      ?>
    </div>
  </div>
</div>
<script src="./js/canjePuntos.js"></script>

<?php
include './footer.php';
?>
