function actualizarConsultaPedidos() {
  if (window.XMLHttpRequest) {
    // Navegadores: Firefox, Chrome, Opera, Safari
    xmlhttp = new XMLHttpRequest();
  } else {
    // Navegadores: IE6, IE5
    xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
  }
  xmlhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      document.getElementById("contenedorResumenesPedidos").innerHTML = this.responseText;
    }
  };

  var formElement = document.getElementById("consultaPedidosForm");
  xmlhttp.open("POST", "../consultaPedidosConsulta.php");
  xmlhttp.send(new FormData(formElement));
}

actualizarConsultaPedidos();

var idPedidoDeshacer;

function cancelarPedido(idPedido){
  //$.redirect('detallesPedido.php', {'idPedido': idPedido});
  idPedidoDeshacer = idPedido;
  document.getElementById("contenedor-alerta-eliminar").style.display = "block";
  document.getElementById("contenedor-alerta-eliminar").style.visibility = "visible";
  document.getElementById("contenedor-eleccion-alerta-eliminar").style.visibility = "visible";
}

function confirmarCancelarPedido(){
  document.getElementById("contenedor-eleccion-alerta-eliminar").style.visibility = "hidden";
  document.getElementById("contenedor-alerta-eliminar").style.display = "none";
  document.getElementById("contenedor-deshacer").style.visibility = "visible";
  $.post("./consultaPedidosEliminar.php",
  {
    idPedido: idPedidoDeshacer,
    eliminarPedido: "Eliminar"
  },
  function(data, status){
    actualizarConsultaPedidos();
  });
}

function noCancelarPedido(){
  document.getElementById("contenedor-eleccion-alerta-eliminar").style.visibility = "hidden";
  document.getElementById("contenedor-alerta-eliminar").style.display = "none";
}

function cerrarDeshacer(){
  document.getElementById("contenedor-deshacer").style.visibility = "hidden";
}

function deshacerCancelarPedido(){
  $.post("./consultaPedidosEliminar.php",
  {
    idPedido: idPedidoDeshacer,
    eliminarPedido: "Deshacer"
  },
  function(data, status){
    actualizarConsultaPedidos();
    cerrarDeshacer();
  });
}

function aceptarPrecioActualizado(idPedido){
  $.post("./consultaPedidosAceptarPrecio.php",
  {
    idPedido: idPedido
  },
  function(data, status){
    actualizarConsultaPedidos();
  });
}
