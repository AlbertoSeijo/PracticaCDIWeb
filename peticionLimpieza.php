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
?><form id="peticionLimpiezaForm"></form>


<div class="container-fluid" style="height:60vh; margin-top: 40px;">
  <div class="row" style="height: 100%;">
    <div class="col-2" style="height: 100%; width:100%;">
      <div class="card bg-light text-center" style="height: 91%; width:100%;"><label class="etiquetaSubapartados" for="">Tipo de prenda</label>
        <div class="card-body text-center" style="height: 91%; width:300px; margin-top:20px;">
          <div class="row text-center" style="height: 25%; width:280px;">
            <div class="col" style="height: 100%; width:250px;">
              <button type="button" class="btn btn-primary seleccion-tipo-prenda" style="height: 80%; width:100px;">Lana</button>
            </div>
            <div class="col" style="height: 100%; width:250px;">
              <button type="button" class="btn btn-primary seleccion-tipo-prenda" style="height: 80%; width:100px;">Seda</button>
            </div>
          </div>
          <div class="row text-center" style="height: 25%; width:280px;">
            <div class="col" style="height: 100%; width:250px;">
              <button type="button" class="btn btn-primary seleccion-tipo-prenda" style="height: 80%; width:100px;">Cuero</button>
            </div>
            <div class="col" style="height: 100%; width:250px;">
              <button type="button" class="btn btn-primary seleccion-tipo-prenda" style="height: 80%; width:100px;">Bambú</button>
            </div>
          </div>
          <div class="row text-center" style="height: 25%; width:280px;">
            <div class="col" style="height: 100%; width:250px;">
              <button type="button" class="btn btn-primary seleccion-tipo-prenda" style="height: 80%; width:100px;">Algodón</button>
            </div>
            <div class="col" style="height: 100%; width:250px;">
              <button type="button" class="btn btn-primary seleccion-tipo-prenda" style="height: 80%; width:100px;">Nailon</button>
            </div>
          </div>
          <div class="row text-center" style="height: 25%; width:280px;">
            <div class="col" style="height: 100%; width:250px;">
              <button type="button" class="btn btn-primary seleccion-tipo-prenda" style="height: 80%; width:100px;">Trajes</button>
            </div>
            <div class="col" style="height: 100%; width:250px;">
              <button type="button" class="btn btn-primary seleccion-tipo-prenda" style="height: 80%; width:100px;">Vestidos</button>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-10" style="height: 100%;">
      <div class="row" style="height: 78%;">
        <div class="col-9" style="height: 100%;">
          <div class="row" style="height: 50%;">
            <div class="col-12" style="height: 100%; ">
              <div class="card bg-light">
                <label class="etiquetaSubapartados" for="">Tipo de servicio</label>
                <div class="card-body text-center">
                  <button type="button" class="btn btn-primary seleccion-tipo-limpieza" onclick="limpiezacompleta()">Limpieza completa</button>
                  <button type="button" class="btn btn-primary seleccion-tipo-limpieza" onclick="limpiezaseco()">Limpieza en seco</button>
                  <button type="button" class="btn btn-primary seleccion-tipo-limpieza" onclick="limpiezatintado()">Tintado</button>
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
        <div class="col-3" style="height: 100%;">
          <div class="card bg-light" style="height: 95.3%;"><label class="etiquetaSubapartados" for="">Asignación de empleados</label>
            <div class="card-body" id="empleadosTipoLimpieza" style="height: 100%;">
              <!-- Aquí no va nada, ajax hace su magia -->
            </div>
          </div>
        </div>
      </div>
      <div class="row" style="height: 22%;">
        <div class="col-8" style="height: 100%">
          <button id="pednormalbot" type="button" disabled class="btn btn-info seleccion-tipo-prenda" onclick="./index" style="width: 100%; height: 60%;"><b>Pedido normal</b></button>
        </div>
        <div class="col-4" style="height: 100%">
          <button id="pedexpressbot" type="button" disabled class="btn btn-warning seleccion-tipo-prenda" onclick="./index" style="width: 100%; height: 60%;"><b>Pedido express</b></button>
        </div>
      </div>
    </div>
  </div>
</div>
<script src="./js/peticionLimpieza.js"></script>

<!--
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
-->

<?php
include './footer.php';
?>
