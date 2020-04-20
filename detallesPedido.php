<?php
include './header.php';
if(!isset($_SESSION['sesionIniciada'])){
  header("Location: ./");
}
?>
<link href="./css/detallesPedido.css" rel="stylesheet">
<?php
$nombrePagina = "Detalles del pedido";
include './cabeceraContenido.php';
?>

<?php
if($_SESSION['tipoCuentaSesión'] == "Cliente"){
  echo'
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
        <div class="col-4 card bg-light text-center" style="margin-top:80px; width: 8vw; height:8vw;">
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
    </div>
    <div id="col2" class="col-6" style="margin-top:20px;">
      <div class="row">
        <div class="col-3">
          <div class="row justify-content-md-center">
            <div class="card bg-light text-center" style="margin-top:120px; width: 10vw; height:10vw;">
              <div class="card-body text-center" style="margin-top:-20px;">
                <img src="./img/LaVandería Logo.png" style="width:6vw; height:12vh; margin-top:30px;" class="rounded" alt="">
                <a style=""></a>
              </div>
            </div>
          </div>
        </div>
        <div class="col-1">
          <div class="row row justify-content-md-center">
            <i class="fas fa-caret-right fa-4x" style="margin-top:20vh;"></i>
          </div>
        </div>
        <div class="col-4">
          <div class="row justify-content-md-center">
            <div class="card bg-light text-center" style="margin-top:80px; width: 14vw; height:14vw;">
              <div class="card-body text-center" style="margin-top:-20px;">
                <img src="./img/LaVandería Logo.png" style="width:8vw; height:16vh; margin-top:50px;" class="rounded" alt="">
                <a style=""></a>
              </div>
            </div>
          </div>
        </div>
        <div class="col-1">
          <div class="row justify-content-md-center">
            <i class="fas fa-caret-right fa-4x" style="margin-top:20vh;"></i>
          </div>
        </div>
        <div class="col-3">
          <div class="row justify-content-md-center">
            <div class="card bg-light text-center" style="margin-top:120px; width: 10vw; height:10vw;">
              <div class="card-body text-center" style="margin-top:-20px;">
                <img src="./img/LaVandería Logo.png" style="width:6vw; height:12vh; margin-top:30px;" class="rounded" alt="">
                <a style=""></a>
              </div>
            </div>
          </div>
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
            <a style="font-weight:bold; font-style:italic; text-decoration-line:underline;">Inicio etapa:</a> dd-mm-aaaa
          </div>
          <div class="fechas text-center">
            <a style="font-weight:bold; font-style:italic; text-decoration-line:underline;">Fin etapa:</a> dd-mm-aaaa
          </div>
        </div>
      </div>
      <div id="precio" class="row justify-content-md-center">
        <div class="col-6" style="margin-top:20vh;">
          <h5 style="margin-top: 15px;">Total desglosado</h5>
          <div class="row" style="height: 100%;">
            <div class="col-6 text-left" style="height: 100%;">
              <a style="display:block; margin-left: 20px; font-size: 12px;">Servicio:</a>
              <a style="display:block; margin-left: 20px; font-size: 12px;">Arreglos solicitados:</a>
              <a style="display:block; margin-left: 20px; font-size: 12px;">Arreglos extras:</a>
              <a style="display:block; margin-left: 20px; font-size: 12px;">Descuento:</a>
              <a class="font-weight-bold" style="display:block; margin-left: 20px;">Total:</a>
            </div>
            <div class="col-6 text-right" style="height: 100%;">
              <a style="position: absolute; left: 10px; top: 20px; font-size: 20px;">+</a>
              <a style="display:block; margin-left: 20px; font-size: 12px;">12.34 €</a>
              <a style="display:block; margin-left: 20px; font-size: 12px;">56.78 €</a>
              <a style="display:block; margin-left: 20px; font-size: 12px;">90.12 €</a>
              <a style="display:block; margin-left: 20px; font-size: 12px;">-34.56 €</a>
              <hr style="margin: 0px; border-width: 2px;">
              <a class="font-weight-bold" style="display:block; margin-left: 20px;">78.90€</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
';
} else if ($_SESSION['tipoCuentaSesión'] == "Encargado"){
  echo'
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
          <div class="col-4 card bg-light text-center" style="margin-top:80px; width: 8vw; height:8vw;">
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
      </div>
      <div id="col2" class="col-6" style="margin-top:20px;">
        <div class="row">
          <div class="col-3">
            <div class="row justify-content-md-center">
              <div class="card bg-light text-center" style="margin-top:120px; width: 10vw; height:10vw;">
                <div class="card-body text-center" style="margin-top:-20px;">
                  <img src="./img/LaVandería Logo.png" style="width:6vw; height:12vh; margin-top:30px;" class="rounded" alt="">
                  <a style=""></a>
                </div>
              </div>
            </div>
          </div>
          <div class="col-1">
            <div class="row row justify-content-md-center">
              <i class="fas fa-caret-right fa-4x" style="margin-top:20vh;"></i>
            </div>
          </div>
          <div class="col-4">
            <div class="row justify-content-md-center">
              <div class="card bg-light text-center" style="margin-top:80px; width: 14vw; height:14vw;">
                <div class="card-body text-center" style="margin-top:-20px;">
                  <img src="./img/LaVandería Logo.png" style="width:8vw; height:16vh; margin-top:50px;" class="rounded" alt="">
                  <a style=""></a>
                </div>
              </div>
            </div>
          </div>
          <div class="col-1">
            <div class="row justify-content-md-center">
              <i class="fas fa-caret-right fa-4x" style="margin-top:20vh;"></i>
            </div>
          </div>
          <div class="col-3">
            <div class="row justify-content-md-center">
              <div class="card bg-light text-center" style="margin-top:120px; width: 10vw; height:10vw;">
                <div class="card-body text-center" style="margin-top:-20px;">
                  <img src="./img/LaVandería Logo.png" style="width:6vw; height:12vh; margin-top:30px;" class="rounded" alt="">
                  <a style=""></a>
                </div>
              </div>
            </div>
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
              <a style="font-weight:bold; font-style:italic; text-decoration-line:underline;">Inicio etapa:</a> dd-mm-aaaa
            </div>
            <div class="fechas text-center">
              <a style="font-weight:bold; font-style:italic; text-decoration-line:underline;">Fin etapa:</a> dd-mm-aaaa
            </div>
          </div>
        </div>
        <div id="precio" class="row justify-content-md-center">
          <div class="col-6" style="margin-top:20vh;">
            <h5 style="margin-top: 15px;">Total desglosado</h5>
            <div class="row" style="height: 100%;">
              <div class="col-6 text-left" style="height: 100%;">
                <a style="display:block; margin-left: 20px; font-size: 12px;">Servicio:</a>
                <a style="display:block; margin-left: 20px; font-size: 12px;">Arreglos solicitados:</a>
                <a style="display:block; margin-left: 20px; font-size: 12px;">Arreglos extras:</a>
                <a style="display:block; margin-left: 20px; font-size: 12px;">Descuento:</a>
                <a class="font-weight-bold" style="display:block; margin-left: 20px;">Total:</a>
              </div>
              <div class="col-6 text-right" style="height: 100%;">
                <a style="position: absolute; left: 10px; top: 20px; font-size: 20px;">+</a>
                <a style="display:block; margin-left: 20px; font-size: 12px;">12.34 €</a>
                <a style="display:block; margin-left: 20px; font-size: 12px;">56.78 €</a>
                <a style="display:block; margin-left: 20px; font-size: 12px;">90.12 €</a>
                <a style="display:block; margin-left: 20px; font-size: 12px;">-34.56 €</a>
                <hr style="margin: 0px; border-width: 2px;">
                <a class="font-weight-bold" style="display:block; margin-left: 20px;">78.90€</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
';
} else {
  echo'
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
          <div class="col-4 card bg-light text-center" style="margin-top:50px; width: 8vw; height:8vw;">
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
            <button type="button" class="btn btn-warning" style="width:15vw; height:10vh;"><b>Devolver prenda a lavado</b></button>
          </div>
        </div>
      </div>
      <div id="col2" class="col-6" style="margin-top:20px;">
        <div class="row">
          <div class="col-3">
            <div class="row justify-content-md-center">
              <div class="card bg-light text-center" style="margin-top:120px; width: 10vw; height:10vw;">
                <div class="card-body text-center" style="margin-top:-20px;">
                  <img src="./img/LaVandería Logo.png" style="width:6vw; height:12vh; margin-top:30px;" class="rounded" alt="">
                  <a style=""></a>
                </div>
              </div>
            </div>
          </div>
          <div class="col-1">
            <div class="row row justify-content-md-center">
              <i class="fas fa-caret-right fa-4x" style="margin-top:20vh;"></i>
            </div>
          </div>
          <div class="col-4">
            <div class="row justify-content-md-center">
              <div class="card bg-light text-center" style="margin-top:80px; width: 14vw; height:14vw;">
                <div class="card-body text-center" style="margin-top:-20px;">
                  <img src="./img/LaVandería Logo.png" style="width:8vw; height:16vh; margin-top:50px;" class="rounded" alt="">
                  <a style=""></a>
                </div>
              </div>
            </div>
          </div>
          <div class="col-1">
            <div class="row justify-content-md-center">
              <i class="fas fa-caret-right fa-4x" style="margin-top:20vh;"></i>
            </div>
          </div>
          <div class="col-3">
            <div class="row justify-content-md-center">
              <div class="card bg-light text-center" style="margin-top:120px; width: 10vw; height:10vw;">
                <div class="card-body text-center" style="margin-top:-20px;">
                  <img src="./img/LaVandería Logo.png" style="width:6vw; height:12vh; margin-top:30px;" class="rounded" alt="">
                  <a style=""></a>
                </div>
              </div>
            </div>
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
              <a style="font-weight:bold; font-style:italic; text-decoration-line:underline;">Inicio etapa:</a> dd-mm-aaaa
            </div>
            <div class="fechas text-center">
              <a style="font-weight:bold; font-style:italic; text-decoration-line:underline;">Fin etapa:</a> dd-mm-aaaa
            </div>
          </div>
        </div>
        <div class="row justify-content-md-center" style="margin-top:40px;">
          <div class="col-8">
            <div class="form-group">
              <label for="empleadoasignado">Empleado asignado:</label>
              <textarea disabled class="form-control" id="empleadoasignado" rows="1" style="resize: none;"></textarea>
            </div>
          </div>
        </div>
        <div class="separador-fba"></div>
        <div id="botones" class="row">
          <div class="col-12 text-center">
            <button type="button" class="btn btn-info" style="width:15vw; height:10vh;"><b>Enviar a la siguiente etapa</b></button>
          </div>
        </div>
      </div>
    </div>
  </div>
';
}
?>




<!--SELECT t.nombre
FROM tipoetapa t INNER JOIN etapa e ON e.idEtapa = t.idEtapa
WHERE e.idpedido = ?;

(SI TIENE)
SELECT t.nombre
FROM tipoetapa t INNER JOIN etapa e ON e.idEtapa = t.idEtapa
WHERE t.idEtapa = t.idEtapa-1 AND e.idpedido = ?;
SELECT t.nombre
FROM tipoetapa t INNER JOIN etapa e ON e.idEtapa = t.idEtapa
WHERE t.idEtapa = t.idEtapa+1 AND e.idpedido = ?;

SELECT idTipoPedido, tipoPrenda, esPedidoExpress, fechaIni, fechaFin, empleadoasignado,
FROM pedidos p INNER JOIN etapa e ON p.idPedido = e.idPedido
WHERE e.idpedido = ?;
(SELECT idTipoPedido, tipoPrenda, esPedidoExpress, fechaIni, fechaFin
FROM pedidos p INNER JOIN etapa e ON p.idPedido = e.idPedido
WHERE e.idpedido = ?;
AÑADIR A CLIENTE EL PRECIO)

SELECT fechaIni FROM etapa WHERE idpedido = ? AND idEtapa = 1;

INSERT INTO arreglos VALUES (idDesperfectos, ?, ?, idPedido, idTipoPedido, clientepedido, null, Servicio_adicional);
INSERT INTO arreglos VALUES (idDesperfectos, ?, ?, idPedido, idTipoPedido, clientepedido, null, Desperfecto);
-->

<?php
include './footer.php';
?>
