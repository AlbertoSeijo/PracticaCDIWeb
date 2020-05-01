<?php
include './header.php';
if(!isset($_SESSION['sesionIniciada']) || $_SESSION['tipoCuentaSesión'] != "Encargado" || !isset($_POST["idCuenta"]) || !isset($_POST["tarjeta"])){
  header("Location: ./");
}
?>

<script src="./js/canjePuntos.js"></script>

<?php
$varIdCuenta = $_POST["idCuenta"];
$varTarjeta = $_POST["tarjeta"];
$varIdPedido = $_POST["idPedido"];

define('SERVIDOR_BD', 'localhost:3306');
define('USUARIO_BD', 'webtintoreria');
define('CONTRASENA_BD', 'lavanderia');
define('NOMBRE_BD', 'tintoreria');

$db = mysqli_connect(SERVIDOR_BD,USUARIO_BD,CONTRASENA_BD,NOMBRE_BD);

if ($stmt = $db->prepare('INSERT INTO tarjeta VALUES (?,0,?)')) {
  $stmt->bind_param('is', $varIdCuenta,$varTarjeta);
  $stmt->execute();
  $stmt->store_result();
}

if ($stmt->error){
  echo '<script>tarjetamalcreada('.$varIdPedido.',true);</script>';
} else {
  echo '<script>pasarSinDescuentos('.$varIdPedido.','.$varTarjeta.');</script>';
}

?>
