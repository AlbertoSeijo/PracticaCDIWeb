
function facturacion(){

  const btnfact = document.getElementById("facturar")
  btnfact.disabled = true;
  $('.toast').toast({delay:3000});
  $('.toast').toast('show');

}


function finalizarcontarjeta(tarjeta,puntos){

  setTimeout(function () {
    form = document.createElement('form');
    form.setAttribute('method', 'POST');
    form.setAttribute('action', './congratulations');
    form.setAttribute('style', 'display:none');
    tarj = document.createElement('input');
    tarj.setAttribute('name', 'tarjeta');
    tarj.setAttribute('value', tarjeta);
    form.appendChild(tarj);
    document.body.appendChild(form);
    punt = document.createElement('input');
    punt.setAttribute('name', 'puntos');
    punt.setAttribute('value', puntos);
    form.appendChild(punt);
    document.body.appendChild(form);
    form.submit();
  }, 3000);

}


function finalizar(){

  setTimeout(function () {
       window.location.href = "./congratulations.php";
    }, 3000);

}
