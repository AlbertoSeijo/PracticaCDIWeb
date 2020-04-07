//Verificación de la contraseña
//TODO Añadir requisitos de longitud, etc a la contraseña
var contraseña = document.getElementById("contraseñaRegistro")
var confirmaciónContraseña = document.getElementById("confirmaciónContraseñaRegistro");

function coindicenciaContraseñas(){
  if(contraseña.value != "" && confirmaciónContraseña.value != ""){
    if(contraseña.value != confirmaciónContraseña.value) {
      contraseña.setCustomValidity("La contraseña no coincide");
      confirmaciónContraseña.setCustomValidity("La contraseña no coincide");
    } else {
      contraseña.setCustomValidity("");
      confirmaciónContraseña.setCustomValidity("");
    }
  } else {
    contraseña.setCustomValidity("");
    confirmaciónContraseña.setCustomValidity("");
  }
}

contraseña.onkeyup = coindicenciaContraseñas;
confirmaciónContraseña.onkeyup = coindicenciaContraseñas;
