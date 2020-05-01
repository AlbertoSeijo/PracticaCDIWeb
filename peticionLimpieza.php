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
  <form id="peticionLimpiezaForm" method="POST">
    <input type="hidden" id="peticionRealizada" name="peticionRealizada" value="false">
    <input type="hidden" id="idTipoPedido" name="idTipoPedido" value="">
    <input type="hidden" id="idTipoPrenda" name="tipoPrenda" value="">
    <input type="hidden" id="esExpress" name="esExpress" value="">
    <input type="hidden" name="cargadoDesdePagina" value="true">
  </form>
<div class="container-fluid" style="margin-top: 25px;">
  <div class="row h-100">
    <div class="col-xl-2 mb-2 col-lg-12">

      <div class="card bg-light text-center supercontenedor-tipo-prenda" style="margin-top: 25px;">
      <a class="etiquetaSubapartados">Tipo de prenda</a>
          <div class="row text-center justify-content-center d-flex h-100 w-100 m-0" style="overflow-x: auto; justify-content: center;
  align-items: center; ">
            <div class="contenedor-tipo-prenda m-0 p-0">
              <button type="button" class="btn btn-primary seleccion-tipo-prenda" value="Lana">
                <img src="./img/tipoPrenda/lana.svg" style="width:50px;"><a>Lana</a>
              </button>
            </div>
            <div class="contenedor-tipo-prenda m-0 p-0">
              <button type="button" class="btn btn-primary seleccion-tipo-prenda" value="Seda">
                <img src="./img/tipoPrenda/seda.svg" style="width:50px;"><a>Seda</a>
              </button>
            </div>
            <div class="contenedor-tipo-prenda m-0 p-0">
              <button type="button" class="btn btn-primary seleccion-tipo-prenda" value="Cuero">
                <img src="./img/tipoPrenda/cuero.svg" style="width:50px;"><a>Cuero</a>
              </button>
            </div>
            <div class="contenedor-tipo-prenda m-0 p-0">
              <button type="button" class="btn btn-primary seleccion-tipo-prenda" value="Bambú">
                <img src="./img/tipoPrenda/bambu.svg" style="width:50px;"><a>Bambú</a>
              </button>
            </div>
            <div class="contenedor-tipo-prenda m-0 p-0">
              <button type="button" class="btn btn-primary seleccion-tipo-prenda" value="Algodón">
                <img src="./img/tipoPrenda/algodon.svg" style="width:50px;"><a>Algodón</a>
              </button>
            </div>
            <div class="contenedor-tipo-prenda m-0 p-0">
              <button type="button" class="btn btn-primary seleccion-tipo-prenda" value="Nailon">
                <img src="./img/tipoPrenda/nailon.svg" style="width:50px;"><a>Nailon</a>
              </button>
            </div>
            <div class="contenedor-tipo-prenda m-0 p-0">
              <button type="button" class="btn btn-primary seleccion-tipo-prenda" value="Traje">
                <img src="./img/tipoPrenda/traje.svg" style="width:50px;"><a>Trajes</a>
              </button>
            </div>
            <div class="contenedor-tipo-prenda m-0 p-0">
              <button type="button" class="btn btn-primary seleccion-tipo-prenda" value="Vestido">
                <img src="./img/tipoPrenda/vestido.svg" style="width:50px;"><a>Vestidos</a>
              </button>
            </div>
        </div>
      </div>
    </div>
    <div class="col-xl-10 col-lg-12 h-100">
      <div class="row">
        <div class="col-12 col-lg-9">
          <div class="row">
            <div class="col-12 justify-content-center" style="height: 100%; margin-top: 25px;">

              <div class="card bg-light" style="height: 90%;">
              <a class="etiquetaSubapartados">Tipo de servicio</a>
                <div class="row text-center">
                  <div class="col-4">
                    <button type="button" class="btn btn-primary seleccion-tipo-limpieza" style="margin:10px;  width: 190px; height: 190px;" onclick="limpiezacompleta()">
                      <img src="./img/tipoPedido/limpiezacompleta.svg" style="width:120px;"><a>Limpieza completa</a>
                    </button>
                  </div>
                  <div class="col-4">
                    <button type="button" class="btn btn-primary seleccion-tipo-limpieza" style="margin:10px; width: 190px; height: 190px;" onclick="limpiezaseco()">
                      <img src="./img/tipoPedido/limpiezaenseco.svg" style="width:120px;"><a>Limpieza en Seco</a>
                    </button>
                  </div>
                  <div class="col-4">
                    <button type="button" class="btn btn-primary seleccion-tipo-limpieza" style="margin:10px;  width: 190px; height: 190px;" onclick="limpiezatintado()">
                      <img src="./img/tipoPedido/tintado.svg" style="width:120px;"><a>Tintado</a>
                    </button>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-12" style="height: 100%;">
              <div class="form-group" style="height: 80%; margin-top: 0px;">
                <a class="etiquetaSubapartados">Trabajos adicionales</a>
                <textarea class="mt-3 form-control" form="peticionLimpiezaForm" id="TrabajosAdicionales" name="TrabajosAdicionales" rows="3" style="resize: none; height: 270px"></textarea>
              </div>
            </div>
          </div>
        </div>
        <div class="col-12 col-lg-3" style="height: 100%; margin-top:24px;">
          <div class="card bg-light" style="height: 17%;">
          <a class="etiquetaSubapartados">Cliente del Pedido</a>
            <div class="card-body" id="clientePedido" style="height: 20%;">
              <select name="idCliente" form="peticionLimpiezaForm" class="custom-select" style="margin-top:-5px;">';
                while ($stmt->fetch()) {
                  echo'<option value="'.$idCliente.'">'.$nombreCliente.' '.$apellidoCliente.'</option>';
                }
                echo'
              </select>
            </div>
          </div>
          <div class="card bg-light" style="height: 410px; margin-top:15px;"><a class="etiquetaSubapartados">Asignación de empleados</a>
            <div class="card-body" id="empleadosTipoLimpieza" style="height: 80%; overflow-x: hidden; overflow-y: auto;">
              <!-- Aquí no va nada, ajax hace su magia -->
            </div>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-12">
          <div class="row justify-md-center" style="height: 120px; margin-left:-25px;">
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


  if ($stmtA = $db->prepare('INSERT INTO Pedido (idTipoPedido,ClientePedido,idDescuentos,tipoPrenda,esPedidoExpress,precioAceptado) VALUES (?,?,null,?,?,false)')) {
    $stmtA->bind_param('iisi', $_POST['idTipoPedido'],$_POST['idCliente'],$_POST['tipoPrenda'],$_POST['esExpress']);
    $stmtA->execute();
    $stmtA->store_result();

    $idPedido = mysqli_stmt_insert_id ($stmtA);

    if (isset($_POST['TrabajosAdicionales']) &&  !is_null($_POST['TrabajosAdicionales']) && !empty($_POST['TrabajosAdicionales'])){
      if ($stmtB = $db->prepare('INSERT INTO arreglos (descripcion,coste,tipoArreglo,idPedido,idTipoPedido,ClientePedido) VALUES (?,null,"Servicio adicional",?,?,?)')) {
        $stmtB->bind_param('siii', $_POST['TrabajosAdicionales'], $idPedido, $_POST['idTipoPedido'],$_POST['idCliente']);
        $stmtB->execute();
        $stmtB->store_result();
      }
      if ($stmtC = $db->prepare('SELECT tEPTP.ordenEtapa, tEPTP.idTipoEtapa, tE.nombre FROM tipoEtapasPorTipoPedido tEPTP, tipoetapa tE
        WHERE tE.idTipoEtapa = tEPTP.idTipoEtapa AND tEPTP.idTipoPedido = ? ORDER BY tEPTP.OrdenEtapa ASC')) {
        $stmtC->bind_param('i', $_POST["idTipoPedido"]);
        $stmtC->execute();
        $stmtC->store_result();
        $stmtC->bind_result($ordenEtapa, $idEtapa, $nombreEtapa);
        while ($stmtC->fetch()) {
          echo $nombreEtapa;
          if ($stmtD = $db->prepare('INSERT INTO etapa (fechaIni,fechaFin,idPedido,empleadoasignado,idtipoetapa) VALUES (?,null,?,?,?)')) {
            $systemDate = normalizarTexto($nombreEtapa) == "recepcionado" ? date("Y-m-d H:i:s") : null;
            $stmtD->bind_param('siii', $systemDate, $idPedido,$_POST['empleadoEtapa'.normalizarTexto($nombreEtapa)],$idEtapa);
            $stmtD->execute();
            $stmtD->store_result();
          }
        }
      }

    } else {
      if ($stmtC = $db->prepare('SELECT tEPTP.ordenEtapa, tEPTP.idTipoEtapa, tE.nombre FROM tipoEtapasPorTipoPedido tEPTP, tipoetapa tE
        WHERE tE.idTipoEtapa = tEPTP.idTipoEtapa AND tEPTP.idTipoPedido = ? ORDER BY tEPTP.OrdenEtapa ASC')) {
        $stmtC->bind_param('i', $_POST["idTipoPedido"]);
        $stmtC->execute();
        $stmtC->store_result();
        $stmtC->bind_result($ordenEtapa, $idEtapa, $nombreEtapa);
        while ($stmtC->fetch()) {
          if (normalizarTexto($nombreEtapa) == "recepcionado"){
            $systemDate= date("Y-m-d H:i:s");
            if ($stmtD = $db->prepare('INSERT INTO etapa (fechaIni,fechaFin,idPedido,empleadoasignado,idtipoetapa) VALUES (?,null,?,?,?)')) {
              $stmtD->bind_param('siii', $systemDate, $idPedido,$_SESSION['idCuentaSesión'],$idEtapa);
              $stmtD->execute();
              $stmtD->store_result();
            }

          }else if (normalizarTexto($nombreEtapa) != "recepcionado(revisiondelaprenda)" && normalizarTexto($nombreEtapa) != "arreglado"){
            if (normalizarTexto($nombreEtapa) == "findepedido"){
              if ($stmtD = $db->prepare('INSERT INTO etapa (fechaIni,fechaFin,idPedido,empleadoasignado,idtipoetapa) VALUES (null,null,?,?,?)')) {
                $stmtD->bind_param('iii', $idPedido,$_SESSION['idCuentaSesión'],$idEtapa);
                $stmtD->execute();
                $stmtD->store_result();
              }
            } else {
              if ($stmtD = $db->prepare('INSERT INTO etapa (fechaIni,fechaFin,idPedido,empleadoasignado,idtipoetapa) VALUES (null,null,?,?,?)')) {
                $stmtD->bind_param('iii', $idPedido,$_POST['empleadoEtapa'.normalizarTexto($nombreEtapa)],$idEtapa);
                $stmtD->execute();
                $stmtD->store_result();
              }
            }
          }
        }
      }
    }


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
