
function facturacion(){

  console.log("Hola mundo y tostada!");
  const btnfact = document.getElementById("facturar")
  btnfact.disabled = true;
  $('.toast').toast({delay:3000});
  $('.toast').toast('show');

}
