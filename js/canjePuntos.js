$('.input-tarjetaCliente').on('keydown change', function(event){
  var t = $(this);
  var t1 = $('#tarjetaInput1');
  var t2 = $('#tarjetaInput2');
  var t3 = $('#tarjetaInput3');

  var tNext = null;
  var tPrevious = null;

  if(t.is(t1)){
    tNext = t2;
    tPrevious = null;
  } else if(t.is(t2)){
    tNext = t3;
    tPrevious = t1;
  } else if(t.is(t3)){
    tNext = null;
    tPrevious = t2;
  } else {
    console.log("No es ninguna");
  }

  var KEY_RETURN = 8;
  var ARROW_LEFT = 37;
  var ARROW_RIGHT = 39;
  if(event.which == KEY_RETURN){
    if (t.val().length == 0 || event.target.selectionStart == 0) {
      if(tPrevious != null){
        tPrevious.focus();
      }
    }
  } else if (event.which == ARROW_LEFT) {
    if(event.target.selectionStart == 0){
      if(tPrevious != null){
        tPrevious.focus();
        var tTemp = tPrevious[0];
        event.preventDefault();
        event.stopPropagation();
        tTemp.setSelectionRange(4, 4);
      }
    }
  } else if (event.which == ARROW_RIGHT) {
    if(event.target.selectionStart == 4 || event.target.selectionStart == t.val().length){
      if(tNext != null){
        tNext.focus();
        var tTemp = tNext[0];
        event.preventDefault();
        event.stopPropagation();
        tTemp.setSelectionRange(0, 0);
      }
    }
  } else {
    if (t.val().length > 3) {
      if(tNext != null){
        tNext.focus();
      }
    }
  }
});





/* INICIO - Sólo permitir números como entrada */


$(".input-tarjetaCliente").inputFilter(function(value) {
  return /^\d*$/.test(value); });
/* FIN - Sólo permitir números como entrada */

function tarjetavalida(idPedido,boton,numTarjeta,idCuenta){

  var in1 = document.getElementById("tarjetaInput1").value;
  var in2 = document.getElementById("tarjetaInput2").value;
  var in3 = document.getElementById("tarjetaInput3").value;

  if ((in1.length == 4 && in2.length == 4 && in3.length == 4)){
    var tarjeta = in1 + in2 + in3;
    if (boton == 0){
      crearnuevatarjeta (tarjeta,idCuenta,idPedido);
    } else {
      if (numTarjeta == tarjeta){
        if (boton == 2){
          pasarSinDescuentos (idPedido,tarjeta);
        } else {
          pasarConDescuentos (idPedido,tarjeta);
        }
      } else {
        document.getElementById("novalida").style.visibility = "visible";
      }
    }
  } else {
    document.getElementById("error").style.visibility = "visible";
  }
}


function pasarSinDescuentos(idPedido,tarjeta) {
  form = document.createElement('form');
  form.setAttribute('method', 'POST');
  form.setAttribute('action', './resumenPedido');
  form.setAttribute('style', 'display:none');
  tarj = document.createElement('input');
  tarj.setAttribute('name', 'tarjeta');
  tarj.setAttribute('value', tarjeta);
  form.appendChild(tarj);
  document.body.appendChild(form);
  idpe = document.createElement('input');
  idpe.setAttribute('name', 'idPedido');
  idpe.setAttribute('value', idPedido);
  form.appendChild(idpe);
  document.body.appendChild(form);
  form.submit();
}

function pasarConDescuentos(idPedido,tarjeta) {
  form = document.createElement('form');
  form.setAttribute('method', 'POST');
  form.setAttribute('action', './canjePuntos2');
  form.setAttribute('style', 'display:none');
  tarj = document.createElement('input');
  tarj.setAttribute('name', 'tarjeta');
  tarj.setAttribute('value', tarjeta);
  form.appendChild(tarj);
  document.body.appendChild(form);
  idpe = document.createElement('input');
  idpe.setAttribute('name', 'idPedido');
  idpe.setAttribute('value', idPedido);
  form.appendChild(idpe);
  document.body.appendChild(form);
  form.submit();
}

function pasarSinTarjeta(idPedido) {
  form = document.createElement('form');
  form.setAttribute('method', 'POST');
  form.setAttribute('action', './resumenPedido');
  form.setAttribute('style', 'display:none');
  idpe = document.createElement('input');
  idpe.setAttribute('name', 'idPedido');
  idpe.setAttribute('value', idPedido);
  form.appendChild(idpe);
  document.body.appendChild(form);
  form.submit();
}

function crearnuevatarjeta(tarjeta,idCuenta,idPedido){
  form = document.createElement('form');
  form.setAttribute('method', 'POST');
  form.setAttribute('action', './canjePuntosNuevaTarjeta');
  form.setAttribute('style', 'display:none');
  tarj = document.createElement('input');
  tarj.setAttribute('name', 'tarjeta');
  tarj.setAttribute('value', tarjeta);
  form.appendChild(tarj);
  document.body.appendChild(form);
  idcu = document.createElement('input');
  idcu.setAttribute('name', 'idCuenta');
  idcu.setAttribute('value', idCuenta);
  form.appendChild(idcu);
  document.body.appendChild(form);
  idpe = document.createElement('input');
  idpe.setAttribute('name', 'idPedido');
  idpe.setAttribute('value', idPedido);
  form.appendChild(idpe);
  document.body.appendChild(form);
  form.submit();
}

function tarjetamalcreada(idPedido,malacreacion){
  form = document.createElement('form');
  form.setAttribute('method', 'POST');
  form.setAttribute('action', './canjePuntos');
  form.setAttribute('style', 'display:none');
  idpe = document.createElement('input');
  idpe.setAttribute('name', 'idPedido');
  idpe.setAttribute('value', idPedido);
  form.appendChild(idpe);
  document.body.appendChild(form);
  mala = document.createElement('input');
  mala.setAttribute('name', 'malacreacion');
  mala.setAttribute('value', malacreacion);
  form.appendChild(mala);
  document.body.appendChild(form);
  form.submit();
}

/* A partir de aquí el código es de canjePuntos2 */

var idDescuentos = false;
var puntosGastados = false;

$(document).on('click', '.espacios-descuentos', function() {
  if (($(this).data("punt") <= $(this).data("canj")) && ($(this).data("apltp") == $(this).data("tped"))){
    idDescuentos = $(this).data("desc");
    puntosGastados = $(this).data("punt");
    $(".espacios-descuentos").removeClass("boton-seleccionado");
    $(this).addClass("boton-seleccionado");
  }
});

function continuarResumen (idPedido,tarjeta,puntosaGastar){
  if (puntosGastados <= puntosaGastar && puntosGastados!=false && idDescuentos!=false){
    pasarResumenConDescuentos(idPedido,tarjeta,idDescuentos,puntosGastados);
  }
}

function pasarResumenConDescuentos(idPedido,tarjeta,idDescuentos,puntosGastados) {
  form = document.createElement('form');
  form.setAttribute('method', 'POST');
  form.setAttribute('action', './resumenPedido');
  form.setAttribute('style', 'display:none');
  tarj = document.createElement('input');
  tarj.setAttribute('name', 'tarjeta');
  tarj.setAttribute('value', tarjeta);
  form.appendChild(tarj);
  document.body.appendChild(form);
  idpe = document.createElement('input');
  idpe.setAttribute('name', 'idPedido');
  idpe.setAttribute('value', idPedido);
  form.appendChild(idpe);
  document.body.appendChild(form);
  desc = document.createElement('input');
  desc.setAttribute('name', 'descuento');
  desc.setAttribute('value', idDescuentos);
  form.appendChild(desc);
  document.body.appendChild(form);
  punt = document.createElement('input');
  punt.setAttribute('name', 'puntosGastados');
  punt.setAttribute('value', puntosGastados);
  form.appendChild(punt);
  document.body.appendChild(form);
  form.submit();
}
