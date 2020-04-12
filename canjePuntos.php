<?php
include './header.php';?>
<?php
$nombrePagina = "Canje de puntos";
include './cabeceraContenido.php';
?>

<div class="container-fluid">
  <div class="row" style="margin-top: 48px;">
    <div class="col-12 text-center" ><h2>Introduce la tarjeta de puntos del cliente</h2></div>
  </div>
  <div class="row text-center" style="margin-top: 24px; margin-bottom: 48px;">
    <div class="col">
      <img src="" style="width: 480px; height: 240px;"></img>
    </div>
  </div>
  <div class="row">
    <div class="col-4"></div>
    <div class="col-4">
      <form>
        <div class="form-row">
          <div class="col">
            <input type="text" class="form-control text-center" placeholder="First name">
          </div>
          <div class="col" style="margin-left: 40px; margin-right: 40px; font-size: 48px; font-weight: bold;">
            <a style="position: absolute; left: -30px; top: -32px;">-</a>
            <input type="text" class="form-control text-center" placeholder="Last name" >
            <a style="position: absolute; right: -30px; top: -32px;">-</a>
          </div>
          <div class="col">
            <input type="text" class="form-control text-center" placeholder="Last name">
          </div>
        </div>
      </form>
    </div>
    <div class="col-4"></div>
  </div>
  <div class="row text-center" style="margin-top: 48px;">
    <div class="col-12 text-center">
      <button class="btn btn-primary btn-lg">Continuar</button>
      <button class="btn btn-primary btn-lg" style="position: absolute; right: 48px;">Tramitar pedido sin aplicar descuentos</button>
    </div>
  </div>
</div>

<?php
include './footer.php';
?>
