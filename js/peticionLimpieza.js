function actualizarEmpleadosLimpieza() {
  console.log("allévoy");
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

function limpiezacompleta(){

  document.getElementById("pednormalbot").disabled = false;
  document.getElementById("pedexpressbot").disabled = false;
  document.getElementById("idTipoPedido").value = "2";
  actualizarEmpleadosLimpieza();
}

function limpiezaseco(){

  document.getElementById("pednormalbot").disabled = false;
  document.getElementById("pedexpressbot").disabled = false;
  document.getElementById("idTipoPedido").value = "1";
  actualizarEmpleadosLimpieza();
}

function limpiezatintado(){

  document.getElementById("pednormalbot").disabled = false;
  document.getElementById("pedexpressbot").disabled = false;
  document.getElementById("idTipoPedido").value = "3";
  actualizarEmpleadosLimpieza();
}
