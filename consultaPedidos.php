<?php
include './header.php';
if(!isset($_SESSION['sesionIniciada']) || $_SESSION['tipoCuentaSesión'] == "ERROR"){
  header("Location: ./");
}
?>
<link href="./css/consultaPedidos.css" rel="stylesheet">
<link href="./fontawesome/css/all.css" rel="stylesheet">
<?php
$nombrePagina = "Consulta de pedidos";
include './cabeceraContenido.php';
?>

<div id="contenedor-alerta-eliminar" class="container-fluid w-100 h-100 contenedor-alerta-eliminar">
  <div id="fondo-contenedor-alerta-eliminar" class="container-fluid  w-100 h-100 fondo-contenedor-alerta-eliminar">
  </div>
  <div id="contenedor-eleccion-alerta-eliminar" class="row w-100 justify-content-center align-self-center" style="position: absolute; top: 50%;transform: translateY(-50%); z-index:10001;">
    <div class="col-xl-5 col-lg-6 col-md-7 col-9 card" style="max-height: 500px;">
      <div class="row" style="margin-top: 24px;">
        <div class="col-4 d-flex align-items-center justify-content-center">
          <img style="width:125px;" src="./img/alert.svg" class=""></img>
        </div>
        <div class="col-8">
          <a class="text-center" style="font-weight: bold; font-size: 48px; display:block;">¡Atención!</a>
          <a class="text-center" style="font-size: 32px; display:block;">¿Está seguro de que desea eliminar el pedido?</a>
        </div>
      </div>
      <div class="row" style="margin-bottom: 24px; margin-top: 24px;">
        <div class="col-6 text-center">
          <button type="button" onclick="noCancelarPedido()" class="btn btn-lg btn-primary">No cancelarlo</button>
        </div>
        <div class="col-6 text-center">
          <button type="button" class="btn btn-lg btn-danger" onclick="confirmarCancelarPedido()">Cancelar pedido</button>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="container-fluid">
  <div id="contenedor-deshacer" class="row justify-content-center contenedor-deshacer w-100">
    <div class="col-sm-6 col-md-5 col-lg-4 card text-center bg-light" style="border-bottom-left-radius: 0px; border-bottom-right-radius: 0px; display: inline;">
      <a>Pedido eliminado. </a><a href="javascript:deshacerCancelarPedido();"><img style="display: inline;"class="svg-icon" src="./img/undo.svg"></img>Deshacer</a> <button onclick="cerrarDeshacer()" style="border-color:transparent; background-color:transparent; padding: 0px; width: 28px; height: 28px; position: absolute; right: 8px; top: 2px;"><img  class="svg-icon-close" src="./img/close.svg"></img></button>
    </div>
  </div>
</div>

<form id="consultaPedidosForm"><input type="hidden" name="cargadoDesdePagina" value="true"></input></form>
<div class="container-fluid">
  <div class="row justify-content-center contenedorFiltros">
    <div class="col-xl-2">
      <div class="form-group">
        <label class="etiquetaElementosFormulario" for="aaaa">Mostrar:</label>
        <select id="seMuestra" name="seMuestra" class="custom-select" id="aaaa" form="consultaPedidosForm" onchange="actualizarConsultaPedidos()">
          <option selected value="todo">Todo</option>
          <option value="porRealizar">Por realizar</option>
          <option value="finalizado">Finalizado</option>
          <option value="enProceso">En proceso</option>
        </select>
      </div>
    </div>
    <div class="col-xl-2">
      <label class="etiquetaElementosFormulario" for="aaaa">Ordenar por:</label>
      <select id="ordenarPor" name="ordenarPor" class="custom-select" form="consultaPedidosForm" onchange="actualizarConsultaPedidos()">
        <option selected value="express">Express</option>
        <option value="fechaIniAsc">Fecha de toma de pedido (ascendente)</option>
        <option value="fechaIniDesc">Fecha de toma de pedido (descendente)</option>
        <option value="fechaFinAsc">Fecha de fin de pedido (ascendente)</option>
        <option value="fechaFinDesc">Fecha de fin de pedido (descendente)</option>
        <option value="tipoPrenda">Tipo de prenda (alfabético)</option>
      </select>
    </div>
    <div class="col-xl-4">
      <div class="input-group contenedorBusqueda">
        <div class="input-group-prepend">
          <select id="buscarPor" name="buscarPor" class="custom-select btn bg-light" form="consultaPedidosForm" onchange="actualizarConsultaPedidos()">
            <option selected value="nombreCliente">Nombre de cliente</option>
            <option value="fechaPedido">Fecha de pedido</option>
            <option value="tipoPrenda">Tipo de prenda</option>
          </select>
        </div>
        <input type="text" id="entradaBusqueda" name="entradaBusqueda" class="form-control" placeholder="Búsqueda..." form="consultaPedidosForm" oninput="actualizarConsultaPedidos()">
        <button type="submit" class="btn btn-primary botonBusqueda" form=""><i class="fas fa-search"></i></button>
      </div>
    </div>
  </div>
  <div class="row justify-content-center">
    <div class="col-xl-8">
      <div class="container-fluid card contElementoContenedorResPed">
        <div class="card-body" id="contenedorResumenesPedidos">
        </div>
      </div>
    </div>
  </div>
</div>
<script src="./js/consultaPedidos.js"></script>
<?php
include './footer.php';
?>
