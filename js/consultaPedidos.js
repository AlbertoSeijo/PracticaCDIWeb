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


function cancelarPedido(idPedido){
  //$.redirect('detallesPedido.php', {'idPedido': idPedido});
  document.getElementById("contenedor-alerta-eliminar").style.visibility = "visible";
}

function confirmarCancelarPedido(){
  document.getElementById("contenedor-eleccion-alerta-eliminar").style.visibility = "hidden";
  document.getElementById("contenedor-alerta-eliminar").style.display = "none";
  document.getElementById("contenedor-deshacer").style.visibility = "visible";


}

function noCancelarPedido(){
  document.getElementById("contenedor-alerta-eliminar").style.visibility = "hidden";
}
