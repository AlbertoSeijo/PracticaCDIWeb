
function facturacion(){

  const btnfact = document.getElementById("facturar")
  btnfact.disabled = true;
  $('.toast').toast({delay:3000});
  $('.toast').toast('show');

}



function finalizar(){

  setTimeout(function () {
       window.location.href = "./congratulations.php";
    }, 2000);

}
