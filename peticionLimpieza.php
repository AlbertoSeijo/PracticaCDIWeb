<?php
include './header.php';
if(!isset($_SESSION['sesionIniciada']) || $_SESSION['tipoCuentaSesión'] != "Encargado"){
  header("Location: ./");
}
?>
<link href="./css/peticionLimpieza.css" rel="stylesheet">
<?php
$nombrePagina = "Petición de limpieza";
include './cabeceraContenido.php';
?>
<form id="peticionLimpiezaForm" method="POST">
  <input type="hidden" id="peticionRealizada" name="peticionRealizada" value="false">
  <input type="hidden" id="idTipoPedido" name="idTipoPedido" value="">
  <input type="hidden" id="idTipoPrenda" name="tipoPrenda" value="">
  <input type="hidden" id="esExpress" name="esExpress" value="">
</form>
<?php
if(!isset($_POST["peticionRealizada"]) || $_POST["peticionRealizada"] == false){
  echo'
<div class="container-fluid" style="height:60vh; margin-top: 40px;">
  <div class="row h-100">
    <div class="col-lg-2 col-md-12 h-100">
      <label class="etiquetaSubapartados" for="">Tipo de prenda</label>
      <div class="card bg-light text-center h-100" style="overflow-x: hidden; overflow-y: auto;">
          <div class="row text-center justify-content-center">
            <div class="contenedor-tipo-prenda m-0 p-0">
              <button type="button" class="btn btn-primary seleccion-tipo-prenda">Lana</button>
            </div>
            <div class="contenedor-tipo-prenda m-0 p-0">
              <button type="button" class="btn btn-primary seleccion-tipo-prenda">Seda</button>
            </div>
            <div class="contenedor-tipo-prenda m-0 p-0">
              <button type="button" class="btn btn-primary seleccion-tipo-prenda">Cuero</button>
            </div>
            <div class="contenedor-tipo-prenda m-0 p-0">
              <button type="button" class="btn btn-primary seleccion-tipo-prenda">Bambú</button>
            </div>
            <div class="contenedor-tipo-prenda m-0 p-0">
              <button type="button" class="btn btn-primary seleccion-tipo-prenda">Algodón</button>
            </div>
            <div class="contenedor-tipo-prenda m-0 p-0">
              <button type="button" class="btn btn-primary seleccion-tipo-prenda">Nailon</button>
            </div>
            <div class="contenedor-tipo-prenda m-0 p-0">
              <button type="button" class="btn btn-primary seleccion-tipo-prenda">Trajes</button>
            </div>
            <div class="contenedor-tipo-prenda m-0 p-0">
              <button type="button" class="btn btn-primary seleccion-tipo-prenda">Vestidos</button>
            </div>
        </div>
      </div>
    </div>
    <div class="col-lg-10 col-md-12 h-100">
      <div class="row h-75">
        <div class="col-9" style="height: 100%;">
          <div class="row" style="height: 50%;">
            <div class="col-12" style="height: 100%;">
              <label class="etiquetaSubapartados" for="">Tipo de servicio</label>
              <div class="card bg-light" style="max-height: 100%; overflow-x:auto;">
                  <button type="button" class="btn btn-primary seleccion-tipo-limpieza" onclick="limpiezacompleta()">Limpieza completa</button>
                  <button type="button" class="btn btn-primary seleccion-tipo-limpieza" onclick="limpiezaseco()">Limpieza en seco</button>
                  <button type="button" class="btn btn-primary seleccion-tipo-limpieza" onclick="limpiezatintado()">Tintado</button>
              </div>
            </div>
          </div>
          <div class="row" style="height: 50%;">
            <div class="col-12" style="height: 100%;">
              <div class="form-group" style="height: 80%; margin-top: 0px;">
                <label for="exampleFormControlTextarea1">Trabajos adicionales</label>
                <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" style="resize: none; height: 100%"></textarea>
              </div>
            </div>
          </div>
        </div>
        <div class="col-3" style="height: 100%;">
          <div class="card bg-light" style="height: 95.3%;"><label class="etiquetaSubapartados" for="">Asignación de empleados</label>
            <div class="card-body" id="empleadosTipoLimpieza" style="height: 100%; overflow-x: hidden; overflow-y: auto;">
              <!-- Aquí no va nada, ajax hace su magia -->
            </div>
          </div>
        </div>
      </div>
      <div class="row h-25">
        <div class="col-8" style="height: 100%">
          <button id="pednormalbot" type="button" disabled class="btn btn-info seleccion-tipo-prenda" onclick="realizarPedido(true)" style="width: 100%; height: 60%;"><b>Pedido normal</b></button>
        </div>
        <div class="col-4" style="height: 100%">
          <button id="pedexpressbot" type="button" disabled class="btn btn-warning seleccion-tipo-prenda" onclick="realizarPedido(true)" style="width: 100%; height: 60%;"><b>Pedido express</b></button>
        </div>
      </div>
    </div>
  </div>
</div>
';
} else if(isset($_POST["peticionRealizada"]) && $_POST["peticionRealizada"] == true) {
  define('SERVIDOR_BD', 'localhost:3306');
  define('USUARIO_BD', 'webtintoreria');
  define('CONTRASENA_BD', 'lavanderia');
  define('NOMBRE_BD', 'tintoreria');

  $db = mysqli_connect(SERVIDOR_BD,USUARIO_BD,CONTRASENA_BD,NOMBRE_BD);

  if ($stmt = $db->prepare('INSERT INTO Pedido (idTipoPedido,ClientePedido,tipoPrenda,esPedidoExpress,precioAceptado) VALUES (?,?,?,"null",?,?,false)')) {
    $stmt->bind_param('iisi', $_POST['idTipoPedido'],$_POST['idCliente'],$_POST['tipoPrenda'],$_POST['esExpress']);
    $stmt->execute();
    $stmt->store_result();
    // Store the result so we can check if the account exists in the database.
    if ($stmt->num_rows > 0) {
        echo 'La petición se ha realizado correctamente. ¿Qué desea hacer? (Realizar nueva petición) | (Volver a la página principal)';
    } else {
        echo 'Ha ocurrido un error al procesar la petición de limpieza. ¿Qué desea hacer? (Realizar nueva petición) | (Volver a la página principal)';
    }
  } else {
    echo 'Ha ocurrido un error al procesar la petición de limpieza. ¿Qué desea hacer? (Realizar nueva petición) | (Volver a la página principal)';
  }

} else {
  echo 'ERROR';
}
echo '
<script src="./js/peticionLimpieza.js"></script>'
;
?>
<?php
include './footer.php';
?>
