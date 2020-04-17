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
