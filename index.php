<?php
include './header.php';?>
<link href="./css/index.css" rel="stylesheet">
<?php
$nombrePagina = "<a class='cabeceraContenido-title'>La Vandería</a><br><a style='font-size:16px; margin-top: 59px; display: inline-block;'>Tu lavandería de confianza</a>";
include './cabeceraContenido.php';
?>
<div class="web-content container-fluid" style="height: 72vh;">
<?php
if(!isset($_SESSION['sesionIniciada'])){
  echo'
  <div id="demo" class="carousel slide carousel-tamanio" data-ride="carousel">
  <ul class="carousel-indicators">
    <li data-target="#demo" data-slide-to="0" class="active"></li>
    <li data-target="#demo" data-slide-to="1"></li>
    <li data-target="#demo" data-slide-to="2"></li>
  </ul>
  <div class="carousel-inner">
    <div class="carousel-item active" style="height:677px;">
      <img src="./img/laundry1.jpg" style="width:100%;" alt="">
      <div class="carousel-caption">
        <h3>Tintoreria La Vanderia</h3>
        <p>Satisfaciendo a nuestros clientes desde hace ya más de 20 años!!</p>
      </div>
    </div>
    <div class="carousel-item" style="height:677px;">
      <img src="./img/backgroundImage1.jpg" style="width:100%;" alt="">
      <div class="carousel-caption">
        <h3>Distintos Tipos de Prendas</h3>
        <p>En La Vanderia trabajamos hasta con ocho tipo de prendas para poder abarcar el mayor rango de prendas a lavar para nuestros clientes.</p>
      </div>
    </div>
    <div class="carousel-item" style="height:677px;">
      <img src="./img/laundryreception1.jpg" style="width:100%;" alt="">
      <div class="carousel-caption text-center" >
        <div class="card" style="filter: opacity(0.5); background-color: black; position: absolute; top: 0px; width: 100%; height: 300px; "><!--TODO Aquí falta arreglar esto -->
        </div>
        <div class="" style="filter: opacity(1) !important; color: white;">
          <h3>Distintos Servicios</h3>
          <p>En nuestra tintoreria disponemos de hasta 3 tipos de servicios, para un mayor abanico de posibilidades a elegir a nuestros usuarios.</p>
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
        <div class="col-sm-12"><h1 class="welcome-title">Bienvenido, ' .$_SESSION['nombreSesión']. '</h1></div>
      </div>
      <div class="row" align="center">
        <div class="col-sm-12"><h6 class="welcome-description">Desde aquí puedes realizar distintas operaciones sobre tu cuenta. Consulta tu historial de pedidos o tus descuentos y puntos de tarjeta.</h6></div>
      </div>
      <div class="row" align="center">
        <div class="col-sm-2"></div>
        <div class="col-sm-4">
          <div class="card index-action-card">
            <img src="./img/index/cardPedidosCliente.jpg" class="card-img-top" alt="...">
            <div class="card-body carta-menu-principal">
              <h5 class="card-title">Consulta de Pedidos</h5>
              <p class="card-text m-3">Accede al panel de consulta de pedidos para ver todos tus pedidos realizados.</p>
              <a href="#" class="btn btn-primary boton-menu-principal" onclick="location.href=\'./consultaPedidos\'">Acceder a consulta de pedidos</a>
            </div>
          </div>
        </div>
        <div class="col-sm-4">
          <div class="card index-action-card">
            <img src="./img/index/cardTarjetaPuntos.jpg" class="card-img-top" alt="...">
            <div class="card-body carta-menu-principal">
              <h5 class="card-title">Tarjeta de puntos</h5>
              <p class="card-text m-3">Comprueba los puntos que tienes acumulados en tu tarjeta así como los descuentos disponibles, canjeables al realizar el pago de tus pedidos.</p>
              <a href="#" class="btn btn-primary boton-menu-principal" onclick="location.href=\'./tarjetaPuntos\'">Consultar tarjeta de puntos</a>
            </div>
          </div>
        </div>
        <div class="col-sm-2"></div>
      </div>
    </div>
    ';//TODO Cambiar el mensaje por la página que se debe mostrar (en html y/o php)
  } else if ($_SESSION['tipoCuentaSesión'] == "Empleado"){
    echo '
      <div class="row" align="center">
        <div class="col-sm-12"><h1 class="welcome-title">Bienvenido, ' .$_SESSION['nombreSesión']. '</h1></div>
      </div>
      <div class="row" align="center">
        <div class="col-sm-12"><h6 class="welcome-description">Accede a la consulta de pedidos para ver aquellos que tienes asignados.</h6></div>
      </div>
      <div class="row" align="center">
        <div class="col-sm-4"></div>
        <div class="col-sm-4">
          <div class="card index-action-card">
            <img src="./img/index/cardPedidosEncargado.jpg" class="card-img-top" alt="...">
            <div class="card-body carta-menu-principal">
              <h5 class="card-title">Consulta de pedidos</h5>
              <p class="card-text m-3">Accede al panel de consulta de pedidos para ver los pedidos de los clientes.</p>
              <a href="#" class="btn btn-primary boton-menu-principal" onclick="location.href=\'./tarjetaPuntos\'">Consultar pedidos</a>//TODO Cambiar enlace
            </div>
          </div>
        </div>
        <div class="col-sm-4"></div>
      </div>
    </div>
    ';
  } else if ($_SESSION['tipoCuentaSesión'] == "Encargado"){
    echo '
      <div class="row" align="center">
        <div class="col-sm-12"><h1 class="welcome-title">Bienvenido, ' .$_SESSION['nombreSesión']. '</h1></div>
      </div>
      <div class="row" align="center">
        <div class="col-sm-12"><h6 class="welcome-description">Desde aquí puedes realizar distintas tareas administrativas. Realiza una petición de limpieza o consulta los pedidos de los clientes.</h6></div>
      </div>
      <div class="row" align="center">
        <div class="col-sm-2"></div>
        <div class="col-sm-4">
          <div class="card index-action-card">
            <img src="./img/index/cardPeticionLimpieza.png" class="card-img-top" alt="...">
            <div class="card-body carta-menu-principal">
              <h5 class="card-title">Petición de limpieza</h5>
              <p class="card-text m-3">Realiza desde aquí una nueva petición de limpieza para un cliente.</p>
              <a href="#" class="btn btn-primary boton-menu-principal" onclick="location.href=\'./peticionLimpieza\'">Realizar una petición de limpieza</a>
            </div>
          </div>
        </div>
        <div class="col-sm-4">
          <div class="card index-action-card">
            <img src="./img/index/cardPedidosEncargado.jpg" class="card-img-top" alt="...">
            <div class="card-body carta-menu-principal">
              <h5 class="card-title">Consulta de pedidos</h5>
              <p class="card-text m-3">Accede al panel de consulta de pedidos para ver los pedidos de los clientes.</p>
              <a href="#" class="btn btn-primary boton-menu-principal" onclick="location.href=\'./tarjetaPuntos\'">Consultar pedidos</a>//TODO Cambiar enlace
            </div>
          </div>
        </div>
        <div class="col-sm-2"></div>
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
