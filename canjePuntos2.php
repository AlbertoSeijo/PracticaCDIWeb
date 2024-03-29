<?php
include './header.php';
if(!isset($_SESSION['sesionIniciada']) || $_SESSION['tipoCuentaSesión'] != "Encargado" || !isset($_POST["idPedido"]) || !isset($_POST["tarjeta"])){
  header("Location: ./");
}
?>

<?php
$varTarjeta = $_POST["tarjeta"];
$varIdPedido = $_POST["idPedido"];
$nombrePagina = "Canjeo de regalos y descuentos";
include './cabeceraContenido.php';

define('SERVIDOR_BD', 'localhost:3306');
define('USUARIO_BD', 'webtintoreria');
define('CONTRASENA_BD', 'lavanderia');
define('NOMBRE_BD', 'tintoreria');

$db = mysqli_connect(SERVIDOR_BD,USUARIO_BD,CONTRASENA_BD,NOMBRE_BD);

if ($stmtA = $db->prepare("SELECT t.puntos FROM  Tarjeta t WHERE t.numTarjeta = ?")) {
  $stmtA->bind_param('s', $varTarjeta);
  $stmtA->execute();
  $stmtA->store_result();
  $stmtA->bind_result($puntosTarjeta);
  $stmtA->fetch();
}

if ($stmtB = $db->prepare("SELECT idtipoPedido FROM  pedido WHERE idPedido = ?")) {
  $stmtB->bind_param('s', $varIdPedido);
  $stmtB->execute();
  $stmtB->store_result();
  $stmtB->bind_result($varTipoPedido);
  $stmtB->fetch();
}


?>

<link rel=stylesheet type="text/css" href="./css/canjePuntos.css">
<script src="./js/canjePuntos.js" language="javascript" type="text/javascript"></script>

<?php

echo'
  <form id="idPedidoSinDesc" method="POST" action="./resumenPedido" style="display: none">
    <input type="hidden" name="idPedidoS" value='.$varIdPedido.'>
    <input type="submit">
  </form>
';

echo'
<div class="container-fluid">
  <div class="row">
    <div class="col margen-superior-col1">
      <div class="text-center">
        <img src="./img/tarjetaPuntos.svg" width="350" height="auto" alt="" class="rounded">
        <h4><b>'. str_split($varTarjeta, 4)[0] .' - '.str_split($varTarjeta, 4)[1].' - '.str_split($varTarjeta, 4)[2].'</b></h4>
      <div class="row margen-puntos">
        <div class="col">
          <h6><b>Puntos:</b></h6>
        </div>
        <div class="col">
          <h6><b>'; if($puntosTarjeta == null){echo'0';}else{echo $puntosTarjeta;} echo '</b></h6>
        </div>
      </div>
      <button type="button" class="btn btn-info btn-continuarPedido" onclick="continuarResumen('.$varIdPedido.','.$varTarjeta.','.$puntosTarjeta.')"><h4>Continuar con el pedido</h4></button>
      </div>
   </div>
';
?>

<?php
echo '
   <div class="col-xl-4 col-lg-6">
      <h3><b>Descuentos</b></h3>
      <div class="card bg-primary text-black contenedor-descuentos">
        <div class="card-body">';
        if ($stmt = $db->prepare('SELECT idDescuentos, descripcion, puntos, titulo, aplicaATipoPedido FROM descuento WHERE titulo LIKE "%descuento%"')) {
          $stmt->execute();
          $resultado = $stmt -> get_result();
          while($result = $resultado->fetch_assoc()){
            echo'
            <div class="card espacios-descuentos container-fluid bg-light" data-desc="'.$result ["idDescuentos"].'" data-canj="'.$puntosTarjeta.'"
            data-punt="'.$result ["puntos"].'" data-apltp="'.$result["aplicaATipoPedido"].'" data-tped="'.$varTipoPedido.'">
              <div class="row" style="height: 90px;">
                <div class="col-2" style="padding: 0px;">
                  <div class="card bg-white" style="width: 70px; height: 70px; position: absolute; top: 50%; left: 50%; transform: translateX(-50%) translateY(-50%);">
                    <img src="./img/canjePuntos/iconosTipoDescuento/iconoDescuento.svg" style="width: 25px; height: 25px; position: absolute; bottom: -7px; right: -7px;"></img>
                    ';if($result["aplicaATipoPedido"] == 2)
                    echo '
                    <img src="./img/tipoPedido/limpiezacompleta.svg" style="width: 50px; height: 50px; position: absolute; top: 50%; left: 50%; transform: translateX(-50%) translateY(-50%);"></img>
                    ';else if ($result["aplicaATipoPedido"] == 1)
                    echo'
                    <img src="./img/tipoPedido/limpiezaenseco.svg" style="width: 50x; height: 50px; position: absolute; top: 50%; left: 50%; transform: translateX(-50%) translateY(-50%);"></img>
                    ';else if ($result["aplicaATipoPedido"] == 3)
                    echo '
                    <img src="./img/tipoPedido/tintado.svg" style="width: 50px; height: 50px; position: absolute; top: 50%; left: 50%; transform: translateX(-50%) translateY(-50%);"></img>
                    ';
                    echo '
                  </div>
                </div>
                <div class="col-10 text-center align-middle" style="height: 100%; overflow: hidden;">
                  <a style="display: block; width: 100%; font-weight: bold; font-size: 20px;">'.$result ["titulo"].'</a>
                  <a style="display: block; width: 100%; font-weight: bold; font-size: 16px;">' .$result ["descripcion"].'</a>
                  <a style="position: absolute; bottom: 6px; right: 6px; font-size: 14px;">'.$result ["puntos"].' puntos</a>
                </div>
              </div>
            </div>';}
          echo '
          </div>
        </div>
      </div>';
        }


        echo '
           <div class="col-xl-4 col-lg-6">
              <h3><b>Regalos</b></h3>
              <div class="card bg-primary text-black contenedor-descuentos">
                <div class="card-body">';
        if ($stmt = $db->prepare('SELECT idDescuentos, descripcion, puntos, titulo, aplicaATipoPedido FROM descuento WHERE titulo = "Servicio Gratuito"')) {
          $stmt->execute();
          $resultado = $stmt -> get_result();
          while($result = $resultado->fetch_assoc()){
            echo'
            <div class="card espacios-descuentos container-fluid bg-light" data-desc="'.$result ["idDescuentos"].'" data-canj="'.$puntosTarjeta.'"
            data-punt="'.$result ["puntos"].'" data-apltp="'.$result["aplicaATipoPedido"].'" data-tped="'.$varTipoPedido.'">
            <div class="row" style="height: 90px;">
              <div class="col-2" style="padding: 0px;">
              <div class="card bg-white" style="width: 70px; height: 70px; position: absolute; top: 50%; left: 50%; transform: translateX(-50%) translateY(-50%);">
                <img src="./img/canjePuntos/iconosTipoDescuento/iconoRegalo.svg" style="width: 25px; height: 25px; position: absolute; bottom: -7px; right: -7px;"></img>
                ';if($result["aplicaATipoPedido"] == 2)
                echo '
                <img src="./img/tipoPedido/limpiezacompleta.svg" style="width: 50px; height: 50px; position: absolute; top: 50%; left: 50%; transform: translateX(-50%) translateY(-50%);"></img>
                ';else if ($result["aplicaATipoPedido"] == 1)
                echo'
                <img src="./img/tipoPedido/limpiezaenseco.svg" style="width: 50x; height: 50px; position: absolute; top: 50%; left: 50%; transform: translateX(-50%) translateY(-50%);"></img>
                ';else if ($result["aplicaATipoPedido"] == 3)
                echo '
                <img src="./img/tipoPedido/tintado.svg" style="width: 50px; height: 50px; position: absolute; top: 50%; left: 50%; transform: translateX(-50%) translateY(-50%);"></img>
                ';
                echo '
              </div>
            </div>
            <div class="col-10 text-center align-middle" style="height: 100%; overflow: hidden;">
              <a style="display: block; width: 100%; font-weight: bold; font-size: 20px;">'.$result ["titulo"].'</a>
              <a style="display: block; width: 100%; font-weight: bold; font-size: 16px;">' .$result ["descripcion"].'</a>
              <a style="position: absolute; bottom: 6px; right: 6px; font-size: 14px;">'.$result ["puntos"].' puntos</a>
            </div>
          </div>
          </div>';}
    echo '</div>
    </div>
    </div>';
    } ?>
    </div>
  </div>



<?php
include './footer.php';
?>
