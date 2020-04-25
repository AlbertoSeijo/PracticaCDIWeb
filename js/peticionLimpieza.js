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

$( ".seleccion-tipo-prenda" ).on( "click", function(){
  setTipoPrendaPedido(this.value);
  $( ".seleccion-tipo-prenda" ).removeClass("boton-seleccionado");
  $(this).addClass("boton-seleccionado");
} );




function setTipoPrendaPedido(prenda){
  document.getElementById("idTipoPrenda").value = prenda;
  if(document.getElementById("idTipoPedido").value && document.getElementById("idTipoPrenda").value){
    document.getElementById("pednormalbot").disabled = false;
    document.getElementById("pedexpressbot").disabled = false;
  }
}

function limpiezacompleta(){
  document.getElementById("idTipoPedido").value = "2";
  if(document.getElementById("idTipoPedido").value && document.getElementById("idTipoPrenda").value){
    document.getElementById("pednormalbot").disabled = false;
    document.getElementById("pedexpressbot").disabled = false;
  }
  actualizarEmpleadosLimpieza();
}

function limpiezaseco(){
  document.getElementById("idTipoPedido").value = "1";
  if(document.getElementById("idTipoPedido").value && document.getElementById("idTipoPrenda").value){
    document.getElementById("pednormalbot").disabled = false;
    document.getElementById("pedexpressbot").disabled = false;
  }
  actualizarEmpleadosLimpieza();
}

function limpiezatintado(){
  document.getElementById("idTipoPedido").value = "3";
  if(document.getElementById("idTipoPedido").value && document.getElementById("idTipoPrenda").value){
    document.getElementById("pednormalbot").disabled = false;
    document.getElementById("pedexpressbot").disabled = false;
  }
  actualizarEmpleadosLimpieza();
}

function realizarPedido(esExpress){
  document.getElementById("esExpress").value = esExpress ? 1 : 0;
  document.getElementById("peticionLimpiezaForm").submit();
}
