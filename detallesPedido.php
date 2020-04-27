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
  if (isset($_POST["haEnviadoASiguienteEtapa"]) && $_POST["haEnviadoASiguienteEtapa"] == true){

        $systemDate= date("Y-m-d H:i:s");

        $stmtE = $db->prepare("UPDATE etapa e SET e.fechaFin=? WHERE e.idPedido = ?  AND e.idTipoEtapa= ?");
        $stmtE->bind_param('sss', $systemDate,$_POST["idPedido"],$idEtapa);
        $stmtE->execute();

        $stmtF = $db->prepare("UPDATE etapa e SET e.fechaIni=? WHERE e.idPedido = ?  AND e.idTipoEtapa= ?");
        $stmtF->bind_param('sss', $systemDate,$_POST["idPedido"],$idEtapaPosterior);
        $stmtF->execute();


  } else if (isset($_POST["haEnviadoAPago"]) && $_POST["haEnviadoAPago"] == true){ //TODO ESTO SOLO ES DE ENCARGADO HAY QUE TOCARLO!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!

        $systemDate= date("Y-m-d H:i:s");

        $stmtG = $db->prepare("UPDATE etapa e SET e.fechaFin=? WHERE e.idPedido = ?  AND e.idTipoEtapa= ?");
        $stmtG->bind_param('sss', $systemDate,$_POST["idPedido"],$idEtapa);
        $stmtG->execute();

  } else if (isset($_POST["haEnviadoAEtapaAnterior"]) && $_POST["haEnviadoAEtapaAnterior"] == true){

        $systemDate= date("Y-m-d H:i:s");

        $stmtH = $db->prepare("UPDATE etapa e SET e.fechaIni=null WHERE e.idPedido = ?  AND e.idTipoEtapa= ?");
        $stmtH->bind_param('ss', $_POST["idPedido"],$idEtapa);
        $stmtH->execute();

        $stmtI = $db->prepare("UPDATE etapa e SET e.fechaInio=? AND e.fechaFin=null WHERE e.idPedido = ?  AND e.idTipoEtapa= ?");
        $stmtI->bind_param('sss', $systemDate,$_POST["idPedido"],$idEtapa);
        $stmtI->execute();

  }
  echo'
  <div class="container-fluid">
    <form id="detallesPedidoForm" method="POST"><input type="hidden" name="cargadoDesdePagina" value="true"><input id="idPedido" type="hidden" value="'.$_POST["idPedido"].'"><input id="ordenVerEtapa" type="hidden" value="'.$_POST["ordenVerEtapa"].'"><input id="ordenEtapaActual" type="hidden" value="'.$_POST["ordenEtapaActual"].'"></form>
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
        <div id="contenedorEnviarAtrásSiSyR" class="row" style="margin-top:65px;">
          <div class="col-12 text-center">
            <button type="button" class="btn btn-warning" style="width:15vw; height:10vh; visibility:hidden; onclick="EnvEtAntEmp('.$_POST["idPedido"].')"><b>Devolver prenda a lavado</b></button>
          </div>
        </div>
      </div>
      <div id="col2" class="col-12 col-lg-6 order-3 order-lg-2" style="margin-top:20px;">
        <div class="row d-flex align-items-center">
          ';if(true){//$nombreTipoEtapaAnterior == null
          echo'
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
          ';
          }
        echo'
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
          '; if (true){//$nombreTipoEtapaPosterior == null){
            echo'
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
          ';
        }
          echo'
        </div>
        <div class="row justify-content-center" style="margin-top:65px;">
              <div class="col-5">
                <div class="form-group">
                  <label for="ServiciosAdic">Servicios adicionales</label>
                  <textarea disabled class="form-control" id="ServiciosAdic" rows="6" style="resize: none;"></textarea>
                </div>
              </div>
              <div class="col-5">
                <div class="form-group">
                  <label for="Desperfectos">Desperfectos</label>
                  <textarea class="form-control" id="Desperfectos" rows="6" style="resize: none;"></textarea>
            </div>
          </div>
        </div>
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
    <div id="botones" class="row">
      <div class="col-6 text-left">
      </div>
      <div class="col-6 text-right">
        <button type="button" class="btn btn-info" style="width:50%;" onclick="EnvSigEtEmp('.$_POST["idPedido"].')"><b>Enviar a la siguiente etapa</b></button>
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
