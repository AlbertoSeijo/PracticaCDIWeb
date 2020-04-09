<?php
include './header.php';?>
<?php
if(!isset($_SESSION['sesionIniciada'])){
  echo 'Página principal, sin sesión iniciada';
} else {
  if($_SESSION['tipoCuentaSesión'] == "Cliente"){
    echo 'Página principal del cliente logeado';//TODO Cambiar el mensaje por la página que se debe mostrar (en html y/o php)
  } else if ($_SESSION['tipoCuentaSesión'] == "Empleado"){
    echo 'Página principal del empleado no encargado logeado';//TODO Cambiar el mensaje por la página que se debe mostrar (en html y/o php)
  } else if ($_SESSION['tipoCuentaSesión'] == "Encargado"){
    echo 'Página principal del empleado encargado logeado';//TODO Cambiar el mensaje por la página que se debe mostrar (en html y/o php)
  } else {
    echo 'ERROR: Tu cuenta no tiene asignado un tipo o bien ha ocurrido algún error en su asignación.';
  }
}
?>
<?php
include './footer.php';
?>
