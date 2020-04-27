<?php
include './header.php';
if(!isset($_SESSION['sesionIniciada']) || $_SESSION['tipoCuentaSesión'] != "Encargado"){
  header("Location: ./");
}


$nombrePagina = "¡¡ ENHORABUENA !!";
include './cabeceraContenido.php';
?>

 <link rel="stylesheet" type="text/css" href="./css/congratulations.css">
 <link rel="stylesheet" href="./css/animaciones/animate.css/animate.min.css">


<div class="page-container web-content">
  <div class="container-fluid">
    <div class="row justify-content-center">
      <div class="col-2">
        <div class="row animated infinite tada" style="margin-top:15vh;">
          <img src="./img/congrats.svg" width="300px;">
        </div>
      </div>
      <div class="col-6">
        <div class="row justify-content-center animated bounce infinite" style="margin-top:15vh;">
          <a style="font-family:Verdana; font-size:52px; font-weight:bold; font-style:italic; color:white;">
            ¡El pedido ha sido completado
          </a>
          <a style="font-family:Verdana; font-size:52px; font-weight:bold; font-style:italic; color:white;">
            satisfactoriamente!
          </a>
        </div>
        <div class="row justify-content-center animated bounceIn delay-4s" style="margin-top:10vh;">
          <button class="btn btn-info borde-btn " onclick="location.href='./index'">
            <a style="font-size:28px; font-weight:bold;">Volver al Inicio</a>
          </button>
        </div>
      </div>
      <div class="col-2 justify-content-center">
        <div class="row animated infinite pulse faster justify-content-center" style="margin-top:20vh;">
          <img src="./img/claps.svg" width="250px;">
        </div>
      </div>
    </div>
  </div>
</div>


<?php
include './footer.php';
?>
