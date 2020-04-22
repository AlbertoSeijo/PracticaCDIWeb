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
  <input type="hidden" name="peticionRealizada" value="false">
  <input type="hidden" id="idTipoPedido" name="idTipoPedido" value="">
  <input type="hidden" id="idTipoPrenda" name="tipoPrenda" value="">
  <input type="hidden" id="esExpress" name="esExpress" value="">
</form>
<?php
if(!isset($_POST["peticionRealizada"]) || $_POST["peticionRealizada"] == false){
  echo'
<div class="container-fluid" style="height:60vh; margin-top: 40px;">
  <div class="row h-100">
    <div class="col-lg-2 col-md-12 h-100 mb-4">
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
      <div class="row h-100">
        <div class="col-md-9 col-sm-12 h-100">
          <div class="row h-50">
            <div class="col-12 h-100">
              <label class="etiquetaSubapartados" for="">Tipo de servicio</label>
              <div class=" d-flex flex-nowrap card bg-light" style="max-height: 100%; overflow-x:auto;">
                <button type="button" class="btn btn-primary seleccion-tipo-limpieza" onclick="limpiezacompleta()">Limpieza completa</button>
                <button type="button" class="btn btn-primary seleccion-tipo-limpieza" onclick="limpiezaseco()">Limpieza en seco</button>
                <button type="button" class="btn btn-primary seleccion-tipo-limpieza" onclick="limpiezatintado()">Tintado</button>
                <button type="button" class="btn btn-primary seleccion-tipo-limpieza" onclick="limpiezatintado()">Tintado</button>
                <button type="button" class="btn btn-primary seleccion-tipo-limpieza" onclick="limpiezatintado()">Tintado</button>
                <button type="button" class="btn btn-primary seleccion-tipo-limpieza" onclick="limpiezatintado()">Tintado</button>
                <button type="button" class="btn btn-primary seleccion-tipo-limpieza" onclick="limpiezatintado()">Tintado</button>
                <button type="button" class="btn btn-primary seleccion-tipo-limpieza" onclick="limpiezatintado()">Tintado</button>
                <button type="button" class="btn btn-primary seleccion-tipo-limpieza" onclick="limpiezatintado()">Tintado</button>
                <button type="button" class="btn btn-primary seleccion-tipo-limpieza" onclick="limpiezatintado()">Tintado</button>
              </div>
            </div>
          </div>
          <div class="row h-50">
            <div class="col-12">
              <div class="form-group h-100">
                <label for="exampleFormControlTextarea1">Trabajos adicionales</label>
                <textarea class="form-control h-100" id="exampleFormControlTextarea1" style="resize: none;"></textarea>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-3 col-sm-12 h-100">
          <div class="card bg-light mb-4"><label class="etiquetaSubapartados" for="">Asignación de cliente</label>
            <div class="card-body" style="height: 100%; overflow-x: hidden; overflow-y: auto;">
              <!-- Aquí no va nada, ajax hace su magia -->
            </div>
          </div>
          <div class="card bg-light"><label class="etiquetaSubapartados" for="">Asignación de empleados</label>
            <div class="card-body" id="empleadosTipoLimpieza" style="height: 100%; overflow-x: hidden; overflow-y: auto;">
              <!-- Aquí no va nada, ajax hace su magia -->
            </div>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-sm-8 col-12 mb-2">
          <button id="pednormalbot" type="button" disabled class="btn btn-info w-100 botonConfirmarPedido" onclick="realizarPedido(true)">Pedido normal</button>
        </div>
        <div class="col-sm-4 col-12 mb-2">
          <button id="pedexpressbot" type="button" disabled class="btn btn-warning w-100 botonConfirmarPedido" onclick="realizarPedido(true)">Pedido express</button>
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
<script src="./js/peticionLimpieza.js"></script>
<!--';
/*
'SELECT nombre, apellidos
FROM cuenta
WHERE correoElectronico = ? AND ? = Encargado'

$esExpress = false;
if (boton_pnormal) 'INSERT INTO pedido VALUES (idPedido, ?, ?, null, ?, false)'
  else if (boton_pexpress) 'INSERT INTO pedido VALUES (idPedido, ?, ?, null, ?, true)'

'INSERT INTO etapa VALUES (null, null, idPedido, ?, ?)'

'INSERT INTO arreglos VALUES (idDesperfectos, ?, null, idPedido, ?, null, "Servicio_adicional")'
*/

?>
<?php
include './footer.php';
?>
