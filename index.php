<?php
include './header.php';?>
<link href="./css/index.css" rel="stylesheet">

<?php
$nombrePagina = "<a class='cabeceraContenido-title'>La Vandería</a><br><a style='font-size:16px; margin-top: 59px; display: inline-block;'>Tu lavandería de confianza</a>";
include './cabeceraContenido.php';

define('SERVIDOR_BD', 'localhost:3306');
define('USUARIO_BD', 'webtintoreria');
define('CONTRASENA_BD', 'lavanderia');
define('NOMBRE_BD', 'tintoreria');

$db = mysqli_connect(SERVIDOR_BD,USUARIO_BD,CONTRASENA_BD,NOMBRE_BD);

if ($stmt = $db->prepare('SELECT numTarjeta FROM tarjeta WHERE idCuenta = ?')) {
  $stmt->bind_param('i', $_SESSION['idCuentaSesión']);
  $stmt->execute();
  $stmt->store_result();
  if ($stmt->num_rows > 0) {
    $tarjeta = true;
  } else {$tarjeta = false;}
}
?>

<?php
echo'
<div class="web-content container-fluid '; echo !isset($_SESSION['sesionIniciada']) ? 'p-0">' : '">';
if(!isset($_SESSION['sesionIniciada'])){
  echo'
  <div id="demo" class="carousel slide carousel-tamanio" data-ride="carousel">
  <ul class="carousel-indicators">
    <li data-target="#demo" data-slide-to="0" class="active"></li>
    <li data-target="#demo" data-slide-to="1"></li>
    <li data-target="#demo" data-slide-to="2"></li>
  </ul>
  <div class="carousel-inner h-100" style="position: absolute; bottom: 0;">
    <div class="carousel-item active h-100" style=" position: absolute;  bottom: 0;  overflow: hidden;">
      <img src="./img/laundry1.jpg" style="object-fit: cover; width: 100%; height: 100%;" alt="">
      <div class="carousel-caption text-center" >
        <div class="card" style="filter: opacity(0.5); background-color: black; position: absolute; top: 0px; width: 100%; height: 100%;">
        </div>
        <div class="" style="filter: opacity(1) !important; color: white;">
        <h3>Tintorería La Vandería</h3>
        <p>¡Satisfaciendo a nuestros clientes desde hace ya más de 20 años!</p>
        </div>
      </div>
    </div>
    <div class="carousel-item h-100" style="position: absolute; bottom: 0; overflow: hidden;">
      <img src="./img/backgroundImage1.jpg" style="object-fit: cover; width: 100%; height: 100%;" alt="">
      <div class="carousel-caption text-center" >
        <div class="card" style="filter: opacity(0.5); background-color: black; position: absolute; top: 0px; width: 100%; height: 100%;"><!--TODO Aquí falta arreglar esto -->
        </div>
        <div class="" style="filter: opacity(1) !important; color: white;">
        <h3>Distintos Tipos de Prendas</h3>
        <p>En La Vandería trabajamos hasta con ocho tipo de prendas para poder abarcar el mayor rango de prendas a lavar para nuestros clientes.</p>
        </div>
      </div>
    </div>
    <div class="carousel-item h-100" style="position: absolute; bottom: 0;  overflow: hidden;">
      <img src="./img/laundryreception1.jpg" style="object-fit: cover; width: 100%; height: 100%;" alt="">
      <div class="carousel-caption text-center" >
        <div class="card" style="filter: opacity(0.5); background-color: black; position: absolute; top: 0px; width: 100%; height: 100%; "><!--TODO Aquí falta arreglar esto -->
        </div>
        <div class="" style="filter: opacity(1) !important; color: white;">
          <h3>Distintos Servicios</h3>
          <p>En nuestra tintorería disponemos de hasta 3 tipos de servicios, para un mayor abanico de posibilidades a elegir a nuestros usuarios.</p>
        </div>
      </div>
    </div>
  </div>
  <a class="carousel-control-prev" href="#demo" data-slide="prev">
    <span class="carousel-control-prev-icon"></span>
  </a>
  <a class="carousel-control-next" href="#demo" data-slide="next">
    <span class="carousel-control-next-icon"></span>
  </a>
</div>
  ';
} else {
  if($_SESSION['tipoCuentaSesión'] == "Cliente"){
    echo '
      <div class="row" align="center">
        <div class="col-sm-12"><h1 class="welcome-title">Bienvenido/a, ' .$_SESSION['nombreSesión']. '</h1></div>
      </div>
      <div class="row" align="center">
        <div class="col-sm-12"><h6 class="welcome-description">Desde aquí puedes realizar distintas operaciones sobre tu cuenta. Consulta tu historial de pedidos o tus descuentos y puntos de tarjeta.</h6></div>
      </div>
      <div class="row justify-content-md-center" align="center">
        <div class="col-lg-4 col-md-12">
          <div class="card index-action-card">
            <img src="./img/index/cardPedidosCliente.jpg" class="card-img-top" alt="...">
            <div class="card-body carta-menu-principal">
              <h5 class="card-title">Consulta de Pedidos</h5>
              <p class="card-text m-3">Accede al panel de consulta de pedidos para ver todos tus pedidos realizados.</p>
              <button class="btn btn-primary boton-menu-principal" onclick="location.href=\'./consultaPedidos\'">Acceder a consulta de pedidos</button>
            </div>
          </div>
        </div>
        <div class="col-lg-4 col-md-12">
          <div class="card index-action-card">
            <img src="./img/index/cardTarjetaPuntos.jpg" class="card-img-top" alt="...">
            <div class="card-body carta-menu-principal">
              <h5 class="card-title">Tarjeta de puntos</h5>
              <p class="card-text m-3">Comprueba los puntos que tienes acumulados en tu tarjeta así como los descuentos disponibles, canjeables al realizar el pago de tus pedidos.</p>';
              if (!$tarjeta){
                echo'
                <button disabled class="btn btn-primary boton-menu-principal" data-placement="bottom" title="Necesitas tener tarjeta" onclick="location.href=\'./tarjetaPuntos\'">Consultar tarjeta de puntos</button>';
              } else {
                echo'<button class="btn btn-primary boton-menu-principal" onclick="location.href=\'./tarjetaPuntos\'">Consultar tarjeta de puntos</button>';
              }
              echo'
            </div>
          </div>
        </div>
      </div>
    </div>
    ';//TODO Cambiar el mensaje por la página que se debe mostrar (en html y/o php)
  } else if ($_SESSION['tipoCuentaSesión'] == "Empleado"){
    echo '
      <div class="row" align="center">
        <div class="col-sm-12"><h1 class="welcome-title">Bienvenido/a, ' .$_SESSION['nombreSesión']. '</h1></div>
      </div>
      <div class="row" align="center">
        <div class="col-sm-12"><h6 class="welcome-description">Accede a la consulta de pedidos para ver aquellos que tienes asignados.</h6></div>
      </div>
      <div class="row justify-content-md-center" align="center">
        <div class="col-12">
          <div class="card index-action-card">
            <img src="./img/index/cardPedidosEncargado.jpg" class="card-img-top" alt="...">
            <div class="card-body carta-menu-principal">
              <h5 class="card-title">Consulta de pedidos</h5>
              <p class="card-text m-3">Accede al panel de consulta de pedidos para ver los pedidos de los clientes.</p>
              <a href="#" class="btn btn-primary boton-menu-principal" onclick="location.href=\'./consultaPedidos\'">Consultar pedidos</a>
            </div>
          </div>
        </div>
      </div>
    </div>
    ';
  } else if ($_SESSION['tipoCuentaSesión'] == "Encargado"){
    echo '
      <div class="row" align="center">
        <div class="col-sm-12"><h1 class="welcome-title">Bienvenido/a, ' .$_SESSION['nombreSesión']. '</h1></div>
      </div>
      <div class="row" align="center">
        <div class="col-sm-12"><h6 class="welcome-description">Desde aquí puedes realizar distintas tareas administrativas. Realiza una petición de limpieza o consulta los pedidos de los clientes.</h6></div>
      </div>
      <div class="row justify-content-md-center" align="center">
        <div class="col-lg-4 col-md-12">
          <div class="card index-action-card">
            <img src="./img/index/cardPeticionLimpieza.png" class="card-img-top" alt="...">
            <div class="card-body carta-menu-principal">
              <h5 class="card-title">Petición de limpieza</h5>
              <p class="card-text m-3">Realiza desde aquí una nueva petición de limpieza para un cliente.</p>
              <a href="#" class="btn btn-primary boton-menu-principal" onclick="location.href=\'./peticionLimpieza\'">Realizar una petición de limpieza</a>
            </div>
          </div>
        </div>
        <div class="col-lg-4 col-md-12">
          <div class="card index-action-card">
            <img src="./img/index/cardPedidosEncargado.jpg" class="card-img-top" alt="...">
            <div class="card-body carta-menu-principal">
              <h5 class="card-title">Consulta de pedidos</h5>
              <p class="card-text m-3">Accede al panel de consulta de pedidos para ver los pedidos de los clientes.</p>
              <a href="#" class="btn btn-primary boton-menu-principal" onclick="location.href=\'./consultaPedidos\'">Consultar pedidos</a>
            </div>
          </div>
        </div>
      </div>
    </div>
    ';
  } else {
    echo 'ERROR: Tu cuenta no tiene asignado un tipo o bien ha ocurrido algún error en su asignación.';
  }
}
?>
<?php
include './footer.php';
?>
