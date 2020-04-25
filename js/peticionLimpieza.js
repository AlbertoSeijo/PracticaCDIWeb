function actualizarEmpleadosLimpieza() {
  if (window.XMLHttpRequest) {
    // Navegadores: Firefox, Chrome, Opera, Safari
    xmlhttp = new XMLHttpRequest();
  } else {
    // Navegadores: IE6, IE5
    xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
  }
  xmlhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      document.getElementById("empleadosTipoLimpieza").innerHTML = this.responseText;
    }
  };

  var formElement = document.getElementById("peticionLimpiezaForm");
  xmlhttp.open("POST", "../peticionLimpiezaEmpleados.php");
  xmlhttp.send(new FormData(formElement));
}

function actualizarClientes() {
  if (window.XMLHttpRequest) {
    // Navegadores: Firefox, Chrome, Opera, Safari
    xmlhttp = new XMLHttpRequest();
  } else {
    // Navegadores: IE6, IE5
    xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
  }
  xmlhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      document.getElementById("clientePedido").innerHTML = this.responseText;
    }
  };

  var formElement = document.getElementById("peticionLimpiezaForm");
  xmlhttp.open("POST", "../peticionLimpiezaEmpleados.php");
  xmlhttp.send(new FormData(formElement));
}

function limpiezacompleta(){

  document.getElementById("pednormalbot").disabled = false;
  document.getElementById("pedexpressbot").disabled = false;
  document.getElementById("idTipoPedido").value = "2";
  actualizarEmpleadosLimpieza();
  actualizarClientes();
}

function limpiezaseco(){

  document.getElementById("pednormalbot").disabled = false;
  document.getElementById("pedexpressbot").disabled = false;
  document.getElementById("idTipoPedido").value = "1";
  actualizarEmpleadosLimpieza();
  actualizarClientes();
}

function limpiezatintado(){

  document.getElementById("pednormalbot").disabled = false;
  document.getElementById("pedexpressbot").disabled = false;
  document.getElementById("idTipoPedido").value = "3";
  actualizarEmpleadosLimpieza();
  actualizarClientes();
}

function realizarPedido(esExpress){
  document.getElementById("esExpress").value = esExpress;
  document.getElementById("peticionLimpiezaForm").submit();
}
