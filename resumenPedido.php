<?php
include './header.php';
if(!isset($_SESSION['sesionIniciada']) || $_SESSION['tipoCuentaSesión'] != "Encargado"){
  header("Location: ./");
}
?>
<link href="./css/resumenPedido.css" rel="stylesheet">
<?php
$nombrePagina = "Resumen del Pedido";
include './cabeceraContenido.php';
?>

<div class="container-fluid">
  <div class="row" style="margin-top:20px;">
    <div id="col1" class="col-3" style="margin-top:20px;">
      <div class="row">
        <div class="col-12 text-center">
          <img src="./img/pedidoExpress.svg" style="width:5vw; height:5vh; margin-top:-15px;" alt="">
          <a style="font-weight:bold; font-size: 24px; font-style:italic;">Pedido Express</a>
        </div>
      </div>
      <div class="row d-flex justify-content-center">
        <div class="col-4 card bg-light text-center" style="margin-top:60px; width: 8vw; height:8vw;">
          <p>Tipo de Prenda</p>
          <div class="card-body text-center" style="margin-top:-20px;">
            <img src="./img/LaVandería Logo.png" style="width:4vw; height:8vh;" class="rounded" alt="">
            <p>Lana</p>
          </div>
        </div>
      </div>
      <div class="row d-flex justify-content-center">
        <div class="col-4 card bg-light text-center" style="margin-top:40px; width: 8vw; height:8vw;">
          <p>Tipo de Servicio</p>
          <div class="card-body text-center" style="margin-top:-20px;">
            <img src="./img/LaVandería Logo.png" style="width:4vw; height:8vh;" class="rounded" alt="">
            <p>Tintado</p>
          </div>
        </div>
      </div>
      <div class="row" style="margin-top:65px;">
        <div class="col-12 text-center">
          <button type="button" class="btn btn-info" style="width:15vw; height:10vh;"><b>Emitir Factura</b></button>
        </div>
      </div>
    </div>
    <div id="col2" class="col-6" style="margin-top:20px;">
      <div class="row justify-content-md-center">
        <div class="col-10">
          <table class="table table-bordered">
            <thead class="bg-table-special">
              <tr>
                <th>Tipo de Servicio</th>
                <th>Precio</th>
              </tr>
            </thead>
            <tbody class="bg-table">
              <tr>
                <td>Servicio de limpieza completa</td>
                <td>29.95€</td>
              </tr>
              <tr>
                <td>Servicios adicionales solicitados por el cliente</td>
                <td>0.00€</td>
              </tr>
              <tr>
                <td>Desperfectos</td>
                <td>9.99€</td>
              </tr>
              <tr>
                <td>Arreglo GRATIS</td>
                <td>-9.99€</td>
              </tr>
              <tr>
                <td>IVA (21%)</td>
                <td>+6.29€</td>
              </tr>
              <tr class="bg-table-special">
                <th>TOTAL</th>
                <th>36.24€</th>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
      <div class="row justify-content-md-center" style="margin-top:65px;">
            <div class="col-5">
              <div class="form-group">
                <label for="ServiciosAdic">Servicios adicionales</label>
                <textarea disabled class="form-control" id="ServiciosAdic" rows="6" style="resize: none;"></textarea>
              </div>
            </div>
            <div class="col-5">
              <div class="form-group">
                <label for="Desperfectos">Desperfectos</label>
                <textarea disabled class="form-control" id="Desperfectos" rows="6" style="resize: none;"></textarea>
              </div>
            </div>
      </div>
    </div>
    <div id="col3" class="col-3" style="margin-top:20px;">
      <div id="fechas" class="row">
        <div class="col-12">
          <div class="fechas">
            <img src="./img/calendar.svg" style="width:3vw; height:3vh; position:absolute; left: 20%;" alt="">
          </div>
          <div class="fechas text-center" style="margin-top:30px;">
            <a style="font-weight:bold; font-style:italic; text-decoration-line:underline;">Inicio pedido:</a> dd-mm-aaaa
          </div>
          <div class="fechas text-center">
            <a style="font-weight:bold; font-style:italic; text-decoration-line:underline;">Fin pedido:</a> dd-mm-aaaa
          </div>
        </div>
      </div>
      <div id="separador" class="separador-fb">
      </div>
      <div id="botones" class="row">
        <div class="col-12 text-center">
          <div class="btn-group-vertical">
            <button type="button" class="btn btn-info" style="width:20vw; height:10vh; margin:5px;"><b>Pago en efectivo</b></button>
            <button type="button" class="btn btn-info" style="width:20vw; height:10vh; margin:5px;"><b>Pago con tarjeta</b></button>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>


<?php
include './footer.php';
?>
