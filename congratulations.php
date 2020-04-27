<?php
include './header.php';
if(!isset($_SESSION['sesionIniciada']) || $_SESSION['tipoCuentaSesión'] != "Encargado"){
  header("Location: ./");
}


$nombrePagina = "CONGRATULATIONS!!";
include './cabeceraContenido.php';
?>

 <link rel="stylesheet" type="text/css" href="./css/congratulations.css">


<div class="page-container web-content">
  <div class="container-fluid">
    <div class="row justify-content-center">
      <div class="col-6">
        <div class="row justify-content-center" style="margin-top:15vh;">
          <a style="font-family:Verdana; font-size:52px; font-weight:bold; font-style:italic; color:white;">
            ¡El pedido ha sido completado
          </a>
          <a style="font-family:Verdana; font-size:52px; font-weight:bold; font-style:italic; color:white;">
            satisfactoriamente!
          </a>
        </div>
        <div class="row justify-content-center" style="margin-top:10vh;">
          <button class="btn btn-info borde-btn" onclick="location.href='./index'">
            <a style="font-size:28px; font-weight:bold;">Volver al Inicio</a>
          </button>
        </div>
      </div>
    </div>
  </div>
</div>


<?php
include './footer.php';
?>
