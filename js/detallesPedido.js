var nombreEtapaActualReal = "";
var ordenEtapaActualReal = "";
var idEtapaActualReal = "";
var idPedido = "";

var descArreglos = "";
var descServAdic = "";

var ordenActualVista = 0;
var ordenAnteriorVista = 0;
var ordenSiguienteVista = 0;

var tipoCuenta = document.getElementById("tipoCuenta").value;
var ordenEtapaAsignada = "";
var nombreEtapaAsignada = "";

var nombretipoEtapaVista = "";
var nombreTipoEtapaPosterior = "";
var nombreTipoEtapaAnterior = "";

function actualizarDetallesPedido() {
  $.post("./detallesPedidoConsulta.php",
    {
      idPedido: $("#idPedido")[0].value,
      ordenVerEtapa: $("#ordenVerEtapa")[0].value,
      ordenEtapaActual: $("#ordenEtapaActual")[0].value
    }, function(respuestaDetallesPedido) {
      console.log(ordenActualVista + " aaa" + nombretipoEtapaVista);
      nombreEtapaActualReal = respuestaDetallesPedido.nombreEtapaActualReal;
      ordenActualVista = respuestaDetallesPedido.ordenActualVista;
      nombretipoEtapaVista = respuestaDetallesPedido.nombretipoEtapaVista;
      ordenEtapaActualReal = respuestaDetallesPedido.ordenEtapaActualReal;
      idEtapaActualReal = respuestaDetallesPedido.idEtapaActualReal;
      nombreTipoEtapaAnterior = respuestaDetallesPedido.nombreTipoEtapaAnterior;
      nombreTipoEtapaPosterior = respuestaDetallesPedido.nombreTipoEtapaPosterior;
      descArreglos = respuestaDetallesPedido.descArreglos;
      descServAdic = respuestaDetallesPedido.descServAdic;
      actualizarVariablesEtapas();

      actualizarEtapas(nombreTipoEtapaAnterior,nombretipoEtapaVista,nombreTipoEtapaPosterior);
      actualizarFechas(respuestaDetallesPedido.inicioEtapa,respuestaDetallesPedido.finEtapa,respuestaDetallesPedido.inicioPedido,null);
      actualizarEmpleadoAsignado(respuestaDetallesPedido.empleadoNombre + " " + respuestaDetallesPedido.empleadoApellidos);
      actualizarDatosPrenda(respuestaDetallesPedido.tipoServicio, respuestaDetallesPedido.tipoPrenda);

      //actualizarServicios debe ir ultimo porque se refiere a elementos que se deben actualizar primero
      actualizarServicios(respuestaDetallesPedido.descServAdic, respuestaDetallesPedido.descArreglos);
      mostrarBotonesAccionSobrePedidoSegunTipoCuenta();
  });
}

function actualizarEtapaAsignadaEmpleado(callback) {
  if(tipoCuenta == "Empleado"){
    $.post("./detallesPedidoVerEtapaAsignadaEmpleado.php",
      {
        idPedido: $("#idPedido")[0].value,
        empleadoAsignado: $("#idCuenta")[0].value,
      }, function(respuesta) {
        ordenEtapaAsignada = respuesta.oEtapaAsignada;
        nombreEtapaAsignada = respuesta.nEtapaAsignada;
        callback();
      }
    );
  } else {
    ordenEtapaAsignada = "";
    callback();
  }

}

function mostrarBotonesAccionSobrePedidoSegunTipoCuenta(){
  actualizarEtapaAsignadaEmpleado(function(){
    if(tipoCuenta == "Encargado"){
      if(ordenActualVista == ordenEtapaActualReal){
        if(ordenEtapaActualReal > 1){
          $("#botonEnviarAnteriorEtapa").css('visibility', 'visible');
        }
        $("#botonEnviarSiguienteEtapa").css('visibility', 'visible');
        if(ordenEtapaActualReal == "7"){
          $("#botonEnviarSiguienteEtapa").html("Finalizar pedido");
        } else {
          $("#botonEnviarSiguienteEtapa").html("Enviar a la siguiente etapa");
        }
      } else {
        $("#botonEnviarAnteriorEtapa").css('visibility', 'hidden');
        $("#botonEnviarSiguienteEtapa").css('visibility', 'hidden');
      }
    } else if (tipoCuenta == "Cliente"){
      $("#botonEnviarAnteriorEtapa").css('visibility', 'hidden');
      $("#botonEnviarSiguienteEtapa").css('visibility', 'hidden');
    } else if (tipoCuenta == "Empleado"){
      if(ordenEtapaAsignada == ordenActualVista){
        if(normalizarString(nombretipoEtapaVista) == "secadoyrevision"){
          $("#botonEnviarAnteriorEtapa").css('visibility', 'visible');
          if(ordenActualVista == ordenEtapaActualReal){
            $("#botonEnviarAnteriorEtapa").prop("disabled",false);
          } else {
            $("#botonEnviarAnteriorEtapa").prop("disabled",true);
          }
        } else {
          $("#botonEnviarAnteriorEtapa").css('visibility', 'hidden');
        }
        if(ordenSiguienteVista != null){
          $("#botonEnviarSiguienteEtapa").css('visibility', 'visible');
          if(ordenActualVista == ordenEtapaActualReal){
            $("#botonEnviarSiguienteEtapa").prop("disabled",false);
          } else {
            $("#botonEnviarSiguienteEtapa").prop("disabled",true);
          }
        } else {
          $("#botonEnviarSiguienteEtapa").css('visibility', 'hidden');
        }
      } else {
        $("#botonEnviarAnteriorEtapa").css('visibility', 'hidden');
        $("#botonEnviarSiguienteEtapa").css('visibility', 'hidden');
      }
    } else {
      console.log("error");
    }
    actualizarEtapas(nombreTipoEtapaAnterior,nombretipoEtapaVista,nombreTipoEtapaPosterior);
  });

}

function actualizarVariablesEtapas(){
  if (ordenActualVista == 1){
    ordenAnteriorVista = null;
    if (!(descArreglos == null || descArreglos == "") || !(descServAdic == null || descServAdic == "")){
      ordenSiguienteVista = parseInt(ordenActualVista) + 1;
    } else {
      ordenSiguienteVista = 4;
    }
  } else if (ordenActualVista == 4){
    ordenSiguienteVista = parseInt(ordenActualVista) + 1;
    if (!(descArreglos == null || descArreglos == "") || !(descServAdic == null || descServAdic == "")){
      ordenAnteriorVista = 3;
    } else {
      ordenAnteriorVista = 1;
    }
  } else if (ordenActualVista == 7) {
    ordenAnteriorVista = parseInt(ordenActualVista) - 1;
    ordenSiguienteVista = null;
  } else {
    ordenAnteriorVista = parseInt(ordenActualVista) - 1;
    ordenSiguienteVista = parseInt(ordenActualVista) + 1;
  }
}

function normalizarString(texto){
  return texto.toLowerCase().split(" ").join("").normalize("NFD").replace(/[\u0300-\u036f]/g, "")
}

function actualizarServicios(descServAdic, descArreglos){
  document.getElementById("ServiciosAdic").value = descServAdic;
  document.getElementById("Desperfectos").value = descArreglos;
  if(normalizarString(document.getElementById("etapaActualNombre").innerText) != "recepcionado" || !(tipoCuenta == "Empleado" || tipoCuenta == "Encargado") || normalizarString(nombreEtapaActualReal) != "recepcionado" ){
    document.getElementById("Desperfectos").disabled = true;

  } else {
    document.getElementById("Desperfectos").disabled = false;

  }
  document.getElementById("ServiciosAdic").innerText = descServAdic;
  document.getElementById("Desperfectos").innerText = descArreglos;
}

function actualizarDatosPrenda(tipoServicio, tipoPrenda){
  document.getElementById("tipoPrendaNombre").innerText = tipoPrenda;
  document.getElementById("tipoPrendaImagen").src = "./img/tipoPrenda/"+normalizarString(tipoPrenda)+".svg";
  document.getElementById("tipoServicioNombre").innerText = tipoServicio;
  document.getElementById("tipoServicioImagen").src = "./img/tipoPedido/"+normalizarString(tipoServicio)+".svg";
}

function actualizarEtapas(etapaAnterior, etapaActual, etapaSiguiente){
  document.getElementById("tituloNombreEtapa").innerText = etapaActual;
  if(etapaAnterior != null){
    document.getElementById("contenedorEtapaAnterior").style.visibility = "visible";
    document.getElementById("contenedorFlechaIzquierda").style.visibility = "visible";
    document.getElementById("etapaAnteriorNombre").innerText = etapaAnterior;
    document.getElementById("etapaAnteriorImagen").src = "./img/etapas/"+normalizarString(etapaAnterior)+".svg";
    if(normalizarString(etapaAnterior) == normalizarString(nombreEtapaActualReal)){
      $('#cardEtapaAnterior .card-body .etq-es-etapa-actual').css('visibility', 'visible');
      $('#cardEtapaAnterior').addClass("marca-pedido-actual-real");
    } else {
      $('#cardEtapaAnterior .card-body .etq-es-etapa-actual').css('visibility', 'hidden');
      $('#cardEtapaAnterior').removeClass("marca-pedido-actual-real");
    }
    if(normalizarString(etapaAnterior) == normalizarString(nombreEtapaAsignada)){
      $('#cardEtapaAnterior').addClass("marca-pedido-asignado");
    } else {
      $('#cardEtapaAnterior').removeClass("marca-pedido-asignado");
    }
  } else {
    document.getElementById("contenedorEtapaAnterior").style.visibility = "hidden";
    document.getElementById("contenedorFlechaIzquierda").style.visibility = "hidden";
    $('#cardEtapaAnterior .card-body .etq-es-etapa-actual').css('visibility', 'hidden');
    $('#cardEtapaAnterior').removeClass("marca-pedido-actual-real");
    $('#cardEtapaAnterior').removeClass("marca-pedido-asignado");
  }
  document.getElementById("etapaActualNombre").innerText = etapaActual;
  document.getElementById("etapaActualImagen").src = "./img/etapas/"+normalizarString(etapaActual)+".svg";
  if(normalizarString(etapaActual) == normalizarString(nombreEtapaActualReal)){
    $('#cardEtapaActual .card-body .etq-es-etapa-actual').css('visibility', 'visible');
    $('#cardEtapaActual').addClass("marca-pedido-actual-real");
  } else {
    $('#cardEtapaActual .card-body .etq-es-etapa-actual').css('visibility', 'hidden');
    $('#cardEtapaActual').removeClass("marca-pedido-actual-real");
  }
  if(normalizarString(etapaActual) == normalizarString(nombreEtapaAsignada)){
    $('#cardEtapaActual').addClass("marca-pedido-asignado");
  } else {
    $('#cardEtapaActual').removeClass("marca-pedido-asignado");
  }
  if(etapaSiguiente != null) {
    document.getElementById("contenedorEtapaSiguiente").style.visibility = "visible";
    document.getElementById("contenedorFlechaDerecha").style.visibility = "visible";
    document.getElementById("etapaSiguienteNombre").innerText = etapaSiguiente;
    document.getElementById("etapaSiguienteImagen").src = "./img/etapas/"+normalizarString(etapaSiguiente)+".svg";
    if(normalizarString(etapaSiguiente) == normalizarString(nombreEtapaActualReal)){
      $('#cardEtapaSiguiente .card-body .etq-es-etapa-actual').css('visibility', 'visible');
      $('#cardEtapaSiguiente').addClass("marca-pedido-actual-real");
    } else {
      $('#cardEtapaSiguiente .card-body .etq-es-etapa-actual').css('visibility', 'hidden');
      $('#cardEtapaSiguiente').removeClass("marca-pedido-actual-real");
    }
    if(normalizarString(etapaSiguiente) == normalizarString(nombreEtapaAsignada)){
      $('#cardEtapaSiguiente').addClass("marca-pedido-asignado");
    } else {
      $('#cardEtapaSiguiente').removeClass("marca-pedido-asignado");
    }
  } else {
    document.getElementById("contenedorEtapaSiguiente").style.visibility = "hidden";
    document.getElementById("contenedorFlechaDerecha").style.visibility = "hidden";
    $('#cardEtapaSiguiente .card-body .etq-es-etapa-actual').css('visibility', 'hidden');
    $('#cardEtapaSiguiente').removeClass("marca-pedido-actual-real");
    $('#cardEtapaSiguiente').removeClass("marca-pedido-asignado");
  }

}

function actualizarFechas(inicioEtapa, finEtapa, inicioPedido, finPedido){
  document.getElementById("fechaInicioPedido").innerText = (inicioPedido == "" || inicioPedido  == null)? " ":inicioPedido;
  document.getElementById("fechaFinPedido").innerText = (finPedido == "" || finPedido == null)  ? " ":finPedido;
  document.getElementById("fechaInicioEtapa").innerText = (inicioEtapa == "" || inicioEtapa == null)? " ":inicioEtapa;
  document.getElementById("fechaFinEtapa").innerText = (finEtapa == "" || finEtapa  == null)? " ":finEtapa;
}

function actualizarEmpleadoAsignado(empleadoAsignado){
  document.getElementById("empleadoasignado").value = empleadoAsignado;
}

function enviarSiguienteEtapa(){
  var datos;
  var ultimaEtapa = false;
  if(ordenSiguienteVista != null){
    if(descArreglos == ""){
      datos = {
        idPedido: $("#idPedido")[0].value,
        haEnviadoAPago: true,
        idEtapa: idEtapaActualReal,
        ordenEtapaSiguiente:  ordenSiguienteVista
      };
    } else { //TODO Esto hay que ver como hacerlo
      datos = {
        idPedido: $("#idPedido")[0].value,
        haEnviadoAPago: true,
        idEtapa: idEtapaActualReal,
        ordenEtapaSiguiente:  ordenSiguienteVista
      };
    }
  } else {
    datos = {
      idPedido: $("#idPedido")[0].value,
      haEnviadoASiguienteEtapa: true,
      idEtapaPago: "7"
    };
    ultimaEtapa = true;
  }
  $.post("./detallesPedido.php",
    datos,
    function(respuesta) {
      console.log(respuesta);
      $("#ordenVerEtapa")[0].value = ordenSiguienteVista;
      $("#ordenEtapaActual")[0].value = ordenSiguienteVista;
      actualizarDetallesPedido();
      if(ultimaEtapa){
        /*$.redirect('canjePuntos.php', {'idPedido': "'"+idPedido+"'"});*/
        document.getElementById("idPedidoForm").submit();
      }
    }
  );
}

function enviarAnteriorEtapa(){
  var datos;
  if(ordenAnteriorVista != "" && ordenAnteriorVista != null){
    datos = {
      idPedido: $("#idPedido")[0].value,
      haEnviadoAEtapaAnterior: true,
      idEtapa: idEtapaActualReal,
      ordenEtapaAnterior:  ordenAnteriorVista
    };
    $.post("./detallesPedido.php",
      datos,
      function(respuesta) {
        console.log(respuesta);
        $("#ordenVerEtapa")[0].value = ordenAnteriorVista;
        $("#ordenEtapaActual")[0].value = ordenAnteriorVista;
        actualizarDetallesPedido();
      }
    );
  }
}

function verAnteriorEtapa(){
  if(ordenActualVista > 1){
    ordenActualVista = ordenAnteriorVista;
    $("#ordenVerEtapa")[0].value = ordenActualVista;
    actualizarVariablesEtapas();
    actualizarDetallesPedido();
    console.log(ordenAnteriorVista + " " + ordenActualVista + " " + ordenSiguienteVista );
  }
}

function verSiguienteEtapa(){
  if(ordenActualVista != 7){
    ordenActualVista = ordenSiguienteVista;
    $("#ordenVerEtapa")[0].value = ordenActualVista;
    actualizarVariablesEtapas();
    actualizarDetallesPedido();
    console.log(ordenAnteriorVista + " " + ordenActualVista + " " + ordenSiguienteVista );
  }
}

actualizarDetallesPedido();
