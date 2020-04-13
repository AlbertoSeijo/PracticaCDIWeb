<?php
include './header.php';
if(!isset($_SESSION['sesionIniciada']) || $_SESSION['tipoCuentaSesión'] != "Encargado"){
  header("Location: ./");
}
?>
<link href="./css/peticionDeLimpieza.css" rel="stylesheet">
<?php
$nombrePagina = "Petición de limpieza";
include './cabeceraContenido.php';
?>
<div class="container-fluid" style="height:60vh; margin-top: 40px;">
  <div class="row" style="height: 100%; ">
    <div class="col-2" style="height: 100%;">
      <div class="card bg-light">
        <div class="card-body">
          <div class="row" style="">
            <div class="col-12 text-center" style="height: 100%;">
              <button type="button" class="btn btn-primary seleccion-tipo-prenda" onclick="holaMundo()">Lana</button>
              <button type="button" class="btn btn-primary seleccion-tipo-prenda" onclick="holaMundo()">Seda</button>
            </div>
          </div>
          <div class="row" style="">
            <div class="col-12 text-center" style="height: 100%;">
              <button type="button" class="btn btn-primary seleccion-tipo-prenda" onclick="holaMundo()">Cuero</button>
              <button type="button" class="btn btn-primary seleccion-tipo-prenda" onclick="holaMundo()">Bambú</button>
            </div>
          </div>
          <div class="row" style="">
            <div class="col-12 text-center" style="height: 100%;">
              <button type="button" class="btn btn-primary seleccion-tipo-prenda" onclick="holaMundo()">Algodón</button>
              <button type="button" class="btn btn-primary seleccion-tipo-prenda" onclick="holaMundo()">Nailon</button>
            </div>
          </div>
          <div class="row" style="">
            <div class="col-12 text-center" style="height: 100%;">
              <button type="button" class="btn btn-primary seleccion-tipo-prenda" onclick="holaMundo()">Trajes</button>
              <button type="button" class="btn btn-primary seleccion-tipo-prenda" onclick="holaMundo()">Vestidos</button>
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
                  <button type="button" class="btn btn-primary seleccion-tipo-limpieza" onclick="holaMundo()">Limpieza completa</button>
                  <button type="button" class="btn btn-primary seleccion-tipo-limpieza" onclick="holaMundo()">Limpieza en seco</button>
                  <button type="button" class="btn btn-primary seleccion-tipo-limpieza" onclick="holaMundo()">Tintado</button>
                </div>
              </div>
            </div>
          </div>
          <div class="row" style="height: 50%;">
            <div class="col-12" style="height: 100%;">
              <div class="form-group" style="height: 80%; margin-top: 0px;">
                <label for="exampleFormControlTextarea1">Example textarea</label>
                <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" style="resize: none; height: 100%"></textarea>
              </div>
            </div>
          </div>
        </div>
        <div class="col-3" style="height: 100%;">
          <div class="card bg-light" style="height: 95.3%;">
            <div class="card-body" style="height: 100%;">
              <div class="dropdown show">
                <a class="btn btn-secondary dropdown-toggle" style="width: 100%" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  Dropdown link
                </a>

                <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                  <a class="dropdown-item" href="#">Action</a>
                  <a class="dropdown-item" href="#">Another action</a>
                  <a class="dropdown-item" href="#">Something else here</a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="row" style="height: 22%;">
        <div class="col-12" style="">
          <button type="button" class="btn btn-primary seleccion-tipo-prenda" onclick="holaMundo()" style="width: 65%;">Pedido normal</button>
          <button type="button" class="btn btn-primary seleccion-tipo-prenda" onclick="holaMundo()" style="width: 30%;">Pedido express</button>
        </div>
      </div>
    </div>
  </div>
</div>
<script src="./js/peticionDeLimpieza.js"></script>

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
