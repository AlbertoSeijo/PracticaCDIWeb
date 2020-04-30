<?php
include './header.php';
if(!isset($_SESSION['sesionIniciada']) || !isset($_POST["idPedido"])){
  header("Location: ./");
}
$nombrePagina = "<a id='tituloNombreEtapa'></a>"
?>

<link href="./css/detallesPedido.css" rel="stylesheet">

<?php
    include './cabeceraContenido.php';

if (isset($_SESSION['sesionIniciada'])){
  define('SERVIDOR_BD', 'localhost:3306');
  define('USUARIO_BD', 'webtintoreria');
  define('CONTRASENA_BD', 'lavanderia');
  define('NOMBRE_BD', 'tintoreria');

  $db = mysqli_connect(SERVIDOR_BD,USUARIO_BD,CONTRASENA_BD,NOMBRE_BD);
  if (isset($_POST["haEnviadoASiguienteEtapa"]) && $_POST["haEnviadoASiguienteEtapa"] == true){

        $systemDate= date("Y-m-d H:i:s");

        $stmtY = $db->prepare("INSERT INTUPDATE etapa e SET e.fechaFin=? WHERE e.idPedido = ?  AND e.idTipoEtapa= ?");
        $stmtY->bind_param('sss', $systemDate,$_POST["idPedido"],$_POST["idEtapa"]);
        $stmtY->execute();

        $stmtE = $db->prepare("UPDATE etapa e SET e.fechaFin=? WHERE e.idPedido = ?  AND e.idTipoEtapa= ?");
        $stmtE->bind_param('sss', $systemDate,$_POST["idPedido"],$_POST["idEtapa"]);
        $stmtE->execute();

        $stmtF = $db->prepare("UPDATE tipoEtapasPorTipoPedido teptp,etapa e, pedido p SET e.fechaIni=? WHERE e.idPedido = ?  AND e.idTipoEtapa = teptp.idTipoEtapa AND teptp.OrdenEtapa = ? AND e.idPedido = p.idPedido AND p.idTipoPedido = teptp.idTipoPedido");
        $stmtF->bind_param('sss', $systemDate,$_POST["idPedido"],$_POST["ordenEtapaSiguiente"]);
        $stmtF->execute();


  } else if (isset($_POST["haEnviadoAPago"]) && $_POST["haEnviadoAPago"] == true){ //TODO ESTO SOLO ES DE ENCARGADO HAY QUE TOCARLO!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!

        $systemDate= date("Y-m-d H:i:s");

        $stmtG = $db->prepare("UPDATE etapa e SET e.fechaFin=? WHERE e.idPedido = ?  AND e.idTipoEtapa= ?");
        $stmtG->bind_param('sss', $systemDate,$_POST["idPedido"],$_POST["idEtapaPago"]);
        $stmtG->execute();

  } else if (isset($_POST["haEnviadoAEtapaAnterior"]) && $_POST["haEnviadoAEtapaAnterior"] == true){

        $systemDate= date("Y-m-d H:i:s");

        $stmtH = $db->prepare("UPDATE etapa e SET e.fechaIni=null WHERE e.idPedido = ?  AND e.idTipoEtapa= ?");
        $stmtH->bind_param('ss', $_POST["idPedido"],$_POST["idEtapa"]);
        $stmtH->execute();

        $stmtI = $db->prepare("UPDATE tipoEtapasPorTipoPedido teptp,etapa e, pedido p SET e.fechaFin=null WHERE e.idPedido = ?  AND e.idTipoEtapa = teptp.idTipoEtapa AND teptp.OrdenEtapa = ? AND e.idPedido = p.idPedido AND p.idTipoPedido = teptp.idTipoPedido");
        $stmtI->bind_param('ss', $_POST["idPedido"],$_POST["ordenEtapaAnterior"]);
        $stmtI->execute();

  }
  echo'
  <form id="idPedidoForm" method="POST" action="./canjePuntos" style="display: none">
    <input type="hidden" name="idPedido" value="'.$_POST["idPedido"].'">
    <input type="submit">
  </form>

  <div class="container-fluid">
    <form id="detallesPedidoForm" method="POST"><input type="hidden" name="cargadoDesdePagina" value="true"><input id="idPedido" type="hidden" value="'.$_POST["idPedido"].'"><input id="ordenVerEtapa" type="hidden" value="'.$_POST["ordenVerEtapa"].'"><input id="ordenEtapaActual" type="hidden" value="'.$_POST["ordenEtapaActual"].'"><input id="tipoCuenta" type="hidden" value="'.$_SESSION['tipoCuentaSesión'].'"><input id="ordenEtapaAsignada" type="hidden" value=""><input id="idCuenta" type="hidden" value="'.$_SESSION['idCuentaSesión'].'"></form>
    <div id="botonesNavegacion" class="row">
      <div class="col-6 text-left">
      <button type="button" class="btn btn-info" style="width:250px; height: 50px;" onclick="verAnteriorEtapa()">Ver anterior etapa</button>
      </div>
      <div class="col-6 text-right">
        <button type="button" class="btn btn-info" style="width:250px; height: 50px;" onclick="verSiguienteEtapa()">Ver siguiente etapa</button>
      </div>
    </div>
    <div class="row" style="margin-top:20px;">
      <div id="col1" class="col-12 col-lg-3 order-1 order-lg-1" style="margin-top:20px;">
        <div class="row row d-flex justify-content-center">
          <div class="col-12 text-center">
            <img src="./img/pedidoExpress.svg" style="width:5vw; height:5vh; margin-top:-15px;" alt="">
            <a style="font-weight:bold; font-size: 24px; font-style:italic;">Pedido Express</a>
          </div>

          <div class="col-6 col-lg-12">
            <div class="card bg-light text-center mx-auto" style="margin-top:50px; width: 150px; height: 150px;">
              <p>Tipo de Prenda</p>
              <div class="card-body text-center" style="margin-top:-20px;">
                <img src="" id="tipoPrendaImagen" style="width: 80px;" class="rounded" alt="">
                <p id="tipoPrendaNombre"></p>
              </div>
            </div>
          </div>
          <div class="col-6 col-lg-12">
            <div class="card bg-light text-center mx-auto" style="margin-top:40px; width: 150px; height: 150px;">
              <p>Tipo de Servicio</p>
              <div class="card-body text-center" style="margin-top:-20px;">
                <img src="" id="tipoServicioImagen" style="width: 80px;" class="rounded" alt="">
                <p  id="tipoServicioNombre" ></p>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div id="col2" class="col-12 col-lg-6 order-3 order-lg-2" style="margin-top:20px;">
        <div class="row d-flex align-items-center">
          <div class="col-3">
            <div id="contenedorEtapaAnterior" class="row justify-content-center" style="visibility:hidden;">
              <div id="cardEtapaAnterior" class="card bg-light text-center" style="width: 140px; height: 140px;">
                <div class="card-body text-center" style="margin-top:-20px;">
                  <a class="etq-es-etapa-actual mx-auto">Etapa Actual</a>
                  <img id="etapaAnteriorImagen" src="" style="width:80px; height:80px;  margin-top:25px;" class="rounded" alt="">
                  <p id="etapaAnteriorNombre"style="margin-top:20px;"></p>
                </div>
              </div>
            </div>
          </div>
          <div class="col-1">
            <div id="contenedorFlechaIzquierda" class="row justify-content-center d-flex align-items-center" style="visibility:hidden;">
              <img src="./img/arrowRight.svg" style="width:50px;"></img>
            </div>
          </div>
          <div class="col-4">
            <div class="row justify-content-center">
              <div id="cardEtapaActual" class="card bg-light text-center" style="width: 180px; height: 180px;">
                <div class="card-body text-center" style="margin-top:-20px;">
                  <a class="etq-es-etapa-actual mx-auto">Etapa Actual</a>
                  <img id="etapaActualImagen" src="" style="width:120px; height:120px; margin-top:25px;" class="rounded" alt="">
                  <p id="etapaActualNombre" style="margin-top:10px;"></p>
                </div>
              </div>
            </div>
          </div>
          <div class="col-1">
            <div id="contenedorFlechaDerecha" class="row justify-content-center d-flex align-items-center" style="visibility:hidden;">
              <img src="./img/arrowRight.svg" style="width:50px;"></img>
            </div>
          </div>
          <div class="col-3">
            <div id="contenedorEtapaSiguiente" class="row justify-content-center" style="visibility:hidden;">
              <div id="cardEtapaSiguiente" class="card bg-light text-center" style="width: 140px; height: 140px;">
                <div class="card-body text-center" style="margin-top:-20px;">
                  <a class="etq-es-etapa-actual mx-auto">Etapa Actual</a>
                  <img id="etapaSiguienteImagen" src="" style="width:80px; height:80px; margin-top:25px;" class="rounded" alt="">
                  <p id="etapaSiguienteNombre" style="margin-top:20px;"></p>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="row justify-content-center" style="margin-top:65px;">
              <div class="col-5">
                <div class="form-group">
                  <label for="ServiciosAdic">Servicios adicionales</label>
                  <textarea disabled class="form-control" id="ServiciosAdic" rows="5" style="resize: none;"></textarea>
                </div>
              </div>
              <div class="col-5">
                <div class="form-group">
                  <label for="Desperfectos">Desperfectos</label>
                  <textarea class="form-control" id="Desperfectos" rows="5" style="resize: none;"></textarea>
                </div>
              </div>
        </div>';


        if($_SESSION['tipoCuentaSesión'] == "Encargado"){
          echo '
        <div class="row justify-content-center" id="contenedorSelecPrecios" style="margin-top:0px; visibility: hidden;">
              <div class="col-5">
                <div class="input-group mb-3" id="ServiciosAdicPrecio">
                  <input type="text" class="form-control input-dinero"/>
                  <div class="input-group-append">
                    <span class="input-group-text">€</span>
                  </div>
                </div>
              </div>
              <div class="col-5">
                <div class="input-group mb-3" id="DesperfectosPrecio">
                  <input type="text" class="form-control  input-dinero"/>
                  <div class="input-group-append">
                    <span class="input-group-text">€</span>
                  </div>
                </div>
              </div>
        </div>
        ';
      }



      echo '
      </div>
      <div id="col3" class="col-12 col-lg-3 order-2 order-lg-3" style="margin-top:20px;">
        <div class="row justify-content-center">
          <div class="col-8 col-lg-12 pl-5">
            <img src="./img/calendar.svg" style="width:24px; position:absolute; left: 10px;" alt="">
            <div class="fechas row w-100" style="margin-top:30px;">
              <div class="contenedorFechaNombre col-5">Inicio pedido:</div> <div class="contenedorFechaDato col-7" id="fechaInicioPedido"></div>
            </div>
            <div class="fechas row w-100">
              <div class="contenedorFechaNombre col-5">Fin pedido:</div> <div class="contenedorFechaDato col-7" id="fechaFinPedido"></div>
            </div>
            <div class="fechas row w-100">
              <div class="contenedorFechaNombre col-5">Inicio etapa:</div> <div class="contenedorFechaDato col-7" id="fechaInicioEtapa"></div>
            </div>
            <div class="fechas row w-100">
              <div class="contenedorFechaNombre col-5">Fin etapa:</div> <div class="contenedorFechaDato  col-7" id="fechaFinEtapa"></div>
            </div>
          </div>
        </div>
        <div class="row justify-content-center" style="margin-top:40px;">
          <div class="col-8">
            <div class="form-group">
              <label for="empleadoasignado">Empleado asignado:</label>
              <textarea disabled class="form-control" id="empleadoasignado" rows="1" style="resize: none;"></textarea>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div id="botonesPasoEtapas" class="row">
      <div class="col-6 text-left">
        <button id="botonEnviarAnteriorEtapa"type="button" class="btn btn-warning" style="width:250px; height:80px; visibility:hidden;" onclick="enviarAnteriorEtapa()">Enviar a la etapa anterior</button>
      </div>
      <div class="col-6 text-right">
        <button id="botonEnviarSiguienteEtapa" type="button" class="btn btn-info" style="width:250px; height:80px; visibility:hidden;" onclick="enviarSiguienteEtapa()">Enviar a la siguiente etapa</button>
      </div>
    </div>
  </div>
';
}

?>
<script src="./js/detallesPedido.js"></script>
<?php
include './footer.php';
?>
