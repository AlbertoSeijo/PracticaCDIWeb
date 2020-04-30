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
      cambiarEmpleadosParaSerDistintos(null);
    }
  };

  var formElement = document.getElementById("peticionLimpiezaForm");
  xmlhttp.open("POST", "../peticionLimpiezaEmpleados.php");
  xmlhttp.send(new FormData(formElement));
}


$( ".seleccion-tipo-prenda" ).on( "click", function(){
  setTipoPrendaPedido(this.value);
  $(".seleccion-tipo-prenda").removeClass("boton-seleccionado");
  $(this).addClass("boton-seleccionado");
} );

$( ".seleccion-tipo-limpieza" ).on( "click", function(){
  $(".seleccion-tipo-limpieza").removeClass("boton-seleccionado");
  $(this).addClass("boton-seleccionado");
} );

$(document).on('change', '.seleccion-empleados', function() {
  cambiarEmpleadosParaSerDistintos(this);//TODO EN ESTE ORDEN A VECES NO VA A FUNCIONAR
});

function cambiarEmpleadosParaSerDistintos(excepcionSelect){
  var valSelect = new Array();
  if(excepcionSelect != null){
    valSelect.push(excepcionSelect.value);
  }
  $(".seleccion-empleados").not(excepcionSelect).each(
    function(i) {
      if($.inArray(this.value,valSelect) != -1){
        var changed = false;
        var valSelectAct = this.value;
        $(this).find("option").each(
          function() {
            if($.inArray(this.value,valSelect) == -1 && !changed){
              valSelectAct = this.value;
              changed = true;
            }
          }
        );
        this.value = valSelectAct;
        valSelect.push(valSelectAct);
      } else {
        valSelect.push(this.value);
      }
    }
  );
}

function empleadosActualmenteSeleccionados(){
  var empleados = new Array();
  $(".seleccion-empleados").each(
    function(i) {
      empleados[i] = this.value;
    }
  );
  return empleados;
}

function setTipoPrendaPedido(prenda){
  document.getElementById("idTipoPrenda").value = prenda;
  if(document.getElementById("idTipoPedido").value && document.getElementById("idTipoPrenda").value){
    document.getElementById("pednormalbot").disabled = false;
    document.getElementById("pedexpressbot").disabled = false;
    actualizarEmpleadosLimpieza();
  }
}

function limpiezacompleta(){
  document.getElementById("idTipoPedido").value = "2";
  if(document.getElementById("idTipoPedido").value && document.getElementById("idTipoPrenda").value){
    document.getElementById("pednormalbot").disabled = false;
    document.getElementById("pedexpressbot").disabled = false;
    actualizarEmpleadosLimpieza();
  }
}

function limpiezaseco(){
  document.getElementById("idTipoPedido").value = "1";
  if(document.getElementById("idTipoPedido").value && document.getElementById("idTipoPrenda").value){
    document.getElementById("pednormalbot").disabled = false;
    document.getElementById("pedexpressbot").disabled = false;
    actualizarEmpleadosLimpieza();
  }
}

function limpiezatintado(){
  document.getElementById("idTipoPedido").value = "3";
  if(document.getElementById("idTipoPedido").value && document.getElementById("idTipoPrenda").value){
    document.getElementById("pednormalbot").disabled = false;
    document.getElementById("pedexpressbot").disabled = false;
    actualizarEmpleadosLimpieza();
  }
}

function realizarPedido(esExpress){
  document.getElementById("esExpress").value = esExpress ? 1 : 0;
  document.getElementById("peticionLimpiezaForm").submit();
}

cambiarEmpleadosParaSerDistintos();
