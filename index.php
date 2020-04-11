<?php
include './header.php';?>
<link href="./css/index.css" rel="stylesheet">
<?php
$nombrePagina = "<a style='font-family: Brush Script MT; font-size: 64px;'>La Vandería</a><br><a style='font-size:16px; margin-top: 59px; display: inline-block;'>Tu lavandería de confianza</a>";
include './cabeceraContenido.php';
?>
<div class="web-content container-fluid">
<?php
if(!isset($_SESSION['sesionIniciada'])){
  echo 'Página principal, sin sesión iniciada';
} else {
  if($_SESSION['tipoCuentaSesión'] == "Cliente"){
    echo '
      <div class="row" align="center">
        <div class="col-sm-12"><h1 style="margin-top: 40px;">Bienvenido, ' .$_SESSION['nombreSesión']. '</h1></div>
      </div>
      <div class="row" align="center">
        <div class="col-sm-12"><h6 style="margin-top: 20px; margin-bottom: 50px;">Desde aquí puedes realizar distintas operaciones sobre tu cuenta. Consulta tu historial de pedidos o tus descuentos y puntos de tarjeta.</h6></div>
      </div>
      <div class="row" align="center">
        <div class="col-sm-2"></div>
        <div class="col-sm-4">
          <div class="card" style="width: 18rem;">
            <img src="./img/index/cardPedidosCliente.jpg" class="card-img-top" alt="...">
            <div class="card-body carta-menu-principal">
              <h5 class="card-title">Consulta de Pedidos</h5>
              <p class="card-text m-3">Accede al panel de consulta de pedidos para ver todos tus pedidos realizados.</p>
              <a href="#" class="btn btn-primary boton-menu-principal" onclick="location.href=\'./consultaPedidos\'">Acceder a consulta de pedidos</a>
            </div>
          </div>
        </div>
        <div class="col-sm-4">
          <div class="card" style="width: 18rem;">
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
        <div class="col-sm-12"><h1 style="margin-top: 40px;">Bienvenido, ' .$_SESSION['nombreSesión']. '</h1></div>
      </div>
      <div class="row" align="center">
        <div class="col-sm-12"><h6 style="margin-top: 20px; margin-bottom: 50px;">Accede a la consulta de pedidos para ver aquellos que tienes asignados.</h6></div>
      </div>
      <div class="row" align="center">
        <div class="col-sm-4"></div>
        <div class="col-sm-4">
          <div class="card" style="width: 18rem;">
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
        <div class="col-sm-12"><h1 style="margin-top: 40px;">Bienvenido, ' .$_SESSION['nombreSesión']. '</h1></div>
      </div>
      <div class="row" align="center">
        <div class="col-sm-12"><h6 style="margin-top: 20px; margin-bottom: 50px;">Desde aquí puedes realizar distintas tareas administrativas. Realiza una petición de limpieza o consulta los pedidos de los clientes.</h6></div>
      </div>
      <div class="row" align="center">
        <div class="col-sm-2"></div>
        <div class="col-sm-4">
          <div class="card" style="width: 18rem;">
            <img src="./img/index/cardPeticionLimpieza.png" class="card-img-top" alt="...">
            <div class="card-body carta-menu-principal">
              <h5 class="card-title">Petición de limpieza</h5>
              <p class="card-text m-3">Realiza desde aquí una nueva petición de limpieza para un cliente.</p>
              <a href="#" class="btn btn-primary boton-menu-principal" onclick="location.href=\'./peticionDeLimpieza\'">Realizar una petición de limpieza</a>
            </div>
          </div>
        </div>
        <div class="col-sm-4">
          <div class="card" style="width: 18rem;">
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
