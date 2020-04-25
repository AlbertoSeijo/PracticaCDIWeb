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

  define('SERVIDOR_BD', 'localhost:3306');
  define('USUARIO_BD', 'webtintoreria');
  define('CONTRASENA_BD', 'lavanderia');
  define('NOMBRE_BD', 'tintoreria');

  $db = mysqli_connect(SERVIDOR_BD,USUARIO_BD,CONTRASENA_BD,NOMBRE_BD);

  if ($stmt = $db->prepare('SELECT c.nombre, c.apellidos, c.idCuenta
    FROM cuenta c INNER JOIN cliente cl ON c.idCuenta=cl.idCuenta ORDER BY c.nombre ASC')) {
    $stmt->execute();
    $stmt->store_result();
    $stmt->bind_result($nombreCliente, $apellidoCliente, $idCliente);
  }

if(!isset($_POST["peticionRealizada"]) || $_POST["peticionRealizada"] == false){
  echo'
<div class="container-fluid" style="height:60vh; margin-top: 25px;">
  <div class="row h-100">
    <div class="col-lg-2 col-md-12 h-100">
      <a>Tipo de prenda</a>
      <div class="card bg-light text-center h-100" style="overflow-x: hidden; overflow-y: auto;">
          <div class="row text-center justify-content-center">
            <div class="contenedor-tipo-prenda m-0 p-0">
              <button type="button" class="btn btn-primary seleccion-tipo-prenda" value="Lana">
                <img src="./img/tipoPrenda/lana.svg" style="width:3vw;"><a>Lana</a>
              </button>
            </div>
            <div class="contenedor-tipo-prenda m-0 p-0">
              <button type="button" class="btn btn-primary seleccion-tipo-prenda" value="Seda">
                <img src="./img/tipoPrenda/seda.svg" style="width:3vw;"><a>Seda</a>
              </button>
            </div>
            <div class="contenedor-tipo-prenda m-0 p-0">
              <button type="button" class="btn btn-primary seleccion-tipo-prenda" value="Cuero">
                <img src="./img/tipoPrenda/cuero.svg" style="width:3vw;"><a>Cuero</a>
              </button>
            </div>
            <div class="contenedor-tipo-prenda m-0 p-0">
              <button type="button" class="btn btn-primary seleccion-tipo-prenda" value="Bambú">
                <img src="./img/tipoPrenda/bambu.svg" style="width:3vw;"><a>Bambú</a>
              </button>
            </div>
            <div class="contenedor-tipo-prenda m-0 p-0">
              <button type="button" class="btn btn-primary seleccion-tipo-prenda" value="Algodón">
                <img src="./img/tipoPrenda/algodon.svg" style="width:3vw;"><a>Algodón</a>
              </button>
            </div>
            <div class="contenedor-tipo-prenda m-0 p-0">
              <button type="button" class="btn btn-primary seleccion-tipo-prenda" value="Nailon">
                <img src="./img/tipoPrenda/nailon.svg" style="width:3vw;"><a>Nailon</a>
              </button>
            </div>
            <div class="contenedor-tipo-prenda m-0 p-0">
              <button type="button" class="btn btn-primary seleccion-tipo-prenda" value="Trajes">
                <img src="./img/tipoPrenda/traje.svg" style="width:3vw;"><a>Trajes</a>
              </button>
            </div>
            <div class="contenedor-tipo-prenda m-0 p-0">
              <button type="button" class="btn btn-primary seleccion-tipo-prenda" value="Vestidos">
                <img src="./img/tipoPrenda/vestido.svg" style="width:3vw;"><a>Vestidos</a>
              </button>
            </div>
        </div>
      </div>
    </div>
    <div class="col-lg-10 col-md-12 h-100">
      <div class="row h-75">
        <div class="col-9" style="height: 100%;">
          <div class="row" style="height: 58%;">
            <div class="col-12" style="height: 100%;">
              <a>Tipo de servicio</a>
              <div class="card bg-light" style="height: 90%;">
                <div class="row text-center">
                  <div class="col-4">
                    <button type="button" class="btn btn-primary seleccion-tipo-limpieza" style="margin:10px; width: 10vw; height: 20vh;  " onclick="limpiezacompleta()">
                      <img src="./img/tipoPedido/limpiezacompleta.svg" style="width:7vw;"><a>Limpieza completa</a>
                    </button>
                  </div>
                  <div class="col-4">
                    <button type="button" class="btn btn-primary seleccion-tipo-limpieza" style="margin:10px; width: 10vw; height: 20vh;" onclick="limpiezaseco()">
                      <img src="./img/tipoPedido/limpiezaenseco.svg" style="width:7vw;"><a>Limpieza en Seco</a>
                    </button>
                  </div>
                  <div class="col-4">
                    <button type="button" class="btn btn-primary seleccion-tipo-limpieza" style="margin:10px; width: 10vw; height: 20vh;" onclick="limpiezatintado()">
                      <img src="./img/tipoPedido/tintado.svg" style="width:7vw;"><a>Tintado</a>
                    </button>
                  </div>
                </div>
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
        <div class="col-3" style="height: 100%; margin-top:20px;">
          <div class="card bg-light" style="height: 17%;"><label class="etiquetaSubapartados" for="">Cliente del Pedido</label>
            <div class="card-body" id="clientePedido" style="height: 20%;">
              <select name="idCliente" form="peticionLimpiezaForm" class="custom-select" style="margin-bottom:15px;">';
                while ($stmt->fetch()) {
                  echo'<option value="'.$idCliente.'">'.$nombreCliente.' '.$apellidoCliente.'</option>';
                }
                echo'
              </select>
            </div>
          </div>
          <div class="card bg-light" style="height: 80%; margin-top:15px;"><label class="etiquetaSubapartados" for="">Asignación de empleados</label>
            <div class="card-body" id="empleadosTipoLimpieza" style="height: 80%; overflow-x: hidden; overflow-y: auto;">
              <!-- Aquí no va nada, ajax hace su magia -->
            </div>
          </div>
        </div>
      </div>
      <div class="row h-25">
        <div class="col-12">
          <div class="row justify-md-center" style="height: 100%; margin-top:7vh; margin-left:-25px;">
            <div class="col-8" style="height: 100%">
              <button id="pednormalbot" type="button" disabled class="btn btn-info seleccion-tipo-prenda" onclick="realizarPedido(false)" style="width: 98%; height: 60%;"><b>Pedido normal</b></button>
            </div>
            <div class="col-4" style="height: 100%">
              <button id="pedexpressbot" type="button" disabled class="btn btn-warning seleccion-tipo-prenda" onclick="realizarPedido(true)" style="width: 98%; height: 60%;"><b>Pedido express</b></button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
';
} else if(isset($_POST["peticionRealizada"]) && $_POST["peticionRealizada"] == true) {

  if ($stmt = $db->prepare('INSERT INTO Pedido (idTipoPedido,ClientePedido,idDescuentos,tipoPrenda,esPedidoExpress,precioAceptado) VALUES (?,?,null,?,?,false)')) {
    $stmt->bind_param('iisi', $_POST['idTipoPedido'],$_POST['idCliente'],$_POST['tipoPrenda'],$_POST['esExpress']);
    $stmt->execute();
    $stmt->store_result();

    header("location: ./");
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
