var nombreEtapaActualReal = "";
var idPedido = "";

function actualizarDetallesPedido() {
  $.post("./detallesPedidoConsulta.php",
    {
      idPedido: $("#idPedido")[0].value,
      ordenVerEtapa: $("#ordenVerEtapa")[0].value,
      ordenEtapaActual: $("#ordenEtapaActual")[0].value
    }, function(respuestaDetallesPedido) {
    if (true) {
      nombreEtapaActualReal = respuestaDetallesPedido.nombreEtapaActualReal;
      actualizarEtapas(respuestaDetallesPedido.nombreTipoEtapaAnterior,respuestaDetallesPedido.nombretipoEtapaVista,respuestaDetallesPedido.nombreTipoEtapaPosterior);
      actualizarFechas(respuestaDetallesPedido.inicioEtapa,respuestaDetallesPedido.finEtapa,respuestaDetallesPedido.inicioPedido,null);
      actualizarEmpleadoAsignado(respuestaDetallesPedido.empleadoNombre + " " + respuestaDetallesPedido.empleadoApellidos);
      actualizarDatosPrenda(respuestaDetallesPedido.tipoServicio, respuestaDetallesPedido.tipoPrenda);

      //actualizarServicios debe ir ultimo porque se refiere a elementos que se deben actualizar primero
      actualizarServicios(respuestaDetallesPedido.descServAdic, respuestaDetallesPedido.descArreglos);
      actualizarBotones(respuestaDetallesPedido.nombretipoEtapaVista);
      actualizarCampoDesperfectos(respuestaDetallesPedido.nombretipoEtapaVista);
    }
  });

}

function normalizarString(texto){
  return texto.toLowerCase().split(" ").join("").normalize("NFD").replace(/[\u0300-\u036f]/g, "")
}

function actualizarBotones(nombreTipoEtapa){
  if(normalizarString(nombreTipoEtapa) == "secadoyrevision"){
    document.getElementById("contenedorEnviarAtrásSiSyR").style.display = "inline-block";
  } else {
    document.getElementById("contenedorEnviarAtrásSiSyR").style.display = "none";
  }
}

function actualizarServicios(descServAdic, descArreglos){
  document.getElementById("ServiciosAdic").innerText = descServAdic;
  document.getElementById("Desperfectos").innerText = descArreglos;
  if(normalizarString(document.getElementById("etapaActualNombre").innerText) != "recepcionado"){
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
  } else {
    document.getElementById("contenedorEtapaAnterior").style.visibility = "hidden";
    document.getElementById("contenedorFlechaIzquierda").style.visibility = "hidden";
    $('#cardEtapaAnterior .card-body .etq-es-etapa-actual').css('visibility', 'hidden');
    $('#cardEtapaAnterior').removeClass("marca-pedido-actual-real");
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
  } else {
    document.getElementById("contenedorEtapaSiguiente").style.visibility = "hidden";
    document.getElementById("contenedorFlechaDerecha").style.visibility = "hidden";
    $('#cardEtapaSiguiente .card-body .etq-es-etapa-actual').css('visibility', 'hidden');
    $('#cardEtapaSiguiente').removeClass("marca-pedido-actual-real");
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

function actualizarCampoDesperfectos(){
  if(normalizarString(respuestaDetallesPedido.nombretipoEtapaVista) == normalizarString(nombreEtapaActualReal)){
      $("#Desperfectos").prop('disabled', false);
  } else {
      $("#Desperfectos").prop('disabled', true);
  }

}

function realizarPagos(idPedido){
  redirectPost('./canjepuntos.php', {'idPedido': idPedido, 'haEnviadoAPago': true});
}

function EnvSigEtEnc(idPedido){
  redirectPost('./consultapedidos.php', {'idPedido': idPedido, 'haEnviadoASiguienteEtapa': true});
}

function EnvSigEtEmp(idPedido){
  redirectPost('./consultapedidos.php', {'idPedido': idPedido, 'haEnviadoASiguienteEtapa': true});
}


function EnvEtAntEnc(idPedido){
  redirectPost('./detallesPedido.php', {'idPedido': idPedido, 'haEnviadoAEtapaAnterior': true});

}

function EnvEtAntEmp(idPedido){
  redirectPost('./consultapedidos.php', {'idPedido': idPedido, 'haEnviadoAEtapaAnterior': true});
}

actualizarDetallesPedido();
