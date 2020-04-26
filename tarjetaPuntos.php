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

<?php


define('SERVIDOR_BD', 'localhost:3306');
define('USUARIO_BD', 'webtintoreria');
define('CONTRASENA_BD', 'lavanderia');
define('NOMBRE_BD', 'tintoreria');

$db = mysqli_connect(SERVIDOR_BD,USUARIO_BD,CONTRASENA_BD,NOMBRE_BD);

if ($stmt = $db->prepare('SELECT puntos, numTarjeta FROM tarjeta WHERE idCuenta = ?')) {//Preparamos la consulta sql para evitar posibles ataques tipo SQL Injection
  $stmt->bind_param('i', $_SESSION['idCuentaSesión']);//Bindeamos al '?' el correo electrónico que nos ha mandado el usuario a través del formulario. El parámetro 's' indica que es un string.
  $stmt->execute();
  $stmt->store_result();
  if ($stmt->num_rows > 0) {//Si hay más de 0 filas es que se ha encontrado una cuenta con ese correo electrónico.
    $stmt->bind_result($puntos, $numtarjeta);//Guardamos la fila actual en viariables.
    $stmt->fetch();
}

echo '
 <link rel=stylesheet type="text/css" href="./css/canjePuntos.css">
 <script src="./js/canjePuntos.js" language="javascript" type="text/javascript"></script>


<div class="container-fluid">
  <div class="row">
    <div class="col-xl-4 col-lg-12 margen-superior-col1">
      <div class="text-center">
        <img src="./img/tarjetaPuntos.svg" width="350" height="auto" alt="" class="rounded">
        <h4><b>'. $numtarjeta .'</b></h4>
      <div class="row margen-puntos">
        <div class="col">
          <h6><b>Puntos:</b></h6>
        </div>
        <div class="col">
          <h6><b>'. $puntos .'</b></h6>
        </div>
      </div>
      <button type="button" class="btn btn-info btn-continuarPedido"><h4>Continuar con el pedido</h4></button>
      </div>
   </div>
';

}
echo '
   <div class="col-xl-4 col-lg-6">
      <h3><b>Descuentos</b></h3>
      <div class="card bg-primary text-black contenedor-descuentos">
        <div class="card-body">';
if ($stmt = $db->prepare('SELECT descripcion, puntos, titulo, aplicaATipoPedido FROM descuento WHERE usadoPorTarjeta IS NULL AND titulo LIKE "%descuento%"')) {
  $stmt->execute();
  $resultado = $stmt -> get_result();
  while($result = $resultado->fetch_assoc()){
      echo'<div class="card espacios-descuentos container-fluid bg-light">
      <div class="row" style="height: 90px;">
        <div class="col-2" style="padding: 0px;">
          <div class="card bg-white" style="width: 70px; height: 70px; position: absolute; top: 50%; left: 50%; transform: translateX(-50%) translateY(-50%);">
            <img src="./img/canjePuntos/iconosTipoDescuento/iconoRegalo.svg" style="width: 50px; height: 50px; position: absolute; top: 50%; left: 50%; transform: translateX(-50%) translateY(-50%);"></img>
            ';if($result["aplicaATipoPedido"] == 1)
            echo '
            <img src="./img/tipoPedido/limpiezacompleta.svg" style="width: 25px; height: 25px; position: absolute; bottom: -7px; right: -7px;"></img>
            ';else if ($result["aplicaATipoPedido"] == 2)
            echo'
            <img src="./img/tipoPedido/limpiezaenseco.svg" style="width: 25px; height: 25px; position: absolute; bottom: -7px; right: -7px;"></img>
            ';else if ($result["aplicaATipoPedido"] == 3)
            echo '
            <img src="./img/tipoPedido/tintado.svg" style="width: 25px; height: 25px; position: absolute; bottom: -7px; right: -7px;"></img>
            ';
            echo '
          </div>
        </div>
        <div class="col-10 text-center align-middle" style="height: 100%; overflow: hidden;">
          <a style="display: block; width: 100%; font-weight: bold; font-size: 20px;">'.$result ["titulo"].'</a>
          <a style="display: block; width: 100%; font-weight: bold; font-size: 16px;">' .$result ["descripcion"].'</a>
          <a style="position: absolute; bottom: 6px; right: 6px; font-size: 14px;">'.$result ["puntos"].'</a>
        </div>
      </div>
      </div>';}
      echo '</div>
    </div>
  </div>';
}


echo '
   <div class="col-xl-4 col-lg-6">
      <h3><b>Regalos</b></h3>
      <div class="card bg-primary text-black contenedor-descuentos">
        <div class="card-body">';
if ($stmt = $db->prepare('SELECT descripcion, puntos, titulo, aplicaATipoPedido FROM descuento WHERE usadoPorTarjeta IS NULL and titulo = "Servicio Gratuito"')) {
  $stmt->execute();
  $resultado = $stmt -> get_result();
  while($result = $resultado->fetch_assoc()){
    echo'<div class="card espacios-descuentos container-fluid bg-light">
    <div class="row" style="height: 90px;">
      <div class="col-2" style="padding: 0px;">
        <div class="card bg-white" style="width: 70px; height: 70px; position: absolute; top: 50%; left: 50%; transform: translateX(-50%) translateY(-50%);">
        <img src="./img/canjePuntos/iconosTipoDescuento/iconoRegalo.svg" style="width: 50px; height: 50px; position: absolute; top: 50%; left: 50%; transform: translateX(-50%) translateY(-50%);"></img>
        ';if($result["aplicaATipoPedido"] == 1)
        echo '
        <img src="./img/tipoPedido/limpiezacompleta.svg" style="width: 25px; height: 25px; position: absolute; bottom: -7px; right: -7px;"></img>
        ';else if ($result["aplicaATipoPedido"] == 2)
        echo'
        <img src="./img/tipoPedido/limpiezaenseco.svg" style="width: 25px; height: 25px; position: absolute; bottom: -7px; right: -7px;"></img>
        ';else if ($result["aplicaATipoPedido"] == 3)
        echo '
        <img src="./img/tipoPedido/tintado.svg" style="width: 25px; height: 25px; position: absolute; bottom: -7px; right: -7px;"></img>
        ';
        echo '
      </div>
    </div>
    <div class="col-10 text-center align-middle" style="height: 100%; overflow: hidden;">
      <a style="display: block; width: 100%; font-weight: bold; font-size: 20px;">'.$result ["titulo"].'</a>
      <a style="display: block; width: 100%; font-weight: bold; font-size: 16px;">' .$result ["descripcion"].'</a>
      <a style="position: absolute; bottom: 6px; right: 6px; font-size: 14px;">'.$result ["puntos"].'</a>
    </div>
  </div>
  </div>';}
    echo '</div>
    </div>
    </div>';
    }
 ?>
<?php
include './footer.php';
?>
