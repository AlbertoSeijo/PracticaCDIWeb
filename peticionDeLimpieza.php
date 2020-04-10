<?php
include './header.php';
if(!isset($_SESSION['sesionIniciada']) || $_SESSION['tipoCuentaSesión'] != "Encargado"){
  header("Location: ./");
}
?>
<link href="./css/peticionDeLimpieza.css" rel="stylesheet">
<?php
$nombrePagina = "Petición de limpieza";
include './cabeceraContenido.php';
?>

<div class="row">
  <div class="col-3">
    <button type="button" class="btn btn-primary seleccion-tipo-prenda" onclick="holaMundo()">Lana</button>
  </div>
</div>
<script src="./js/peticionDeLimpieza.js"></script>


/*
'SELECT nombre, apellidos
FROM cuenta
WHERE correoElectronico = ? AND ? = Encargado'

$esExpress = false;
if (boton_pnormal) 'INSERT INTO pedido VALUES (idPedido, ?, ?, null, ?, false)'
  else if (boton_pexpress) 'INSERT INTO pedido VALUES (idPedido, ?, ?, null, ?, true)'

'INSERT INTO etapa VALUES (null, null, idPedido, ?, ?)'

'INSERT INTO arreglos VALUES (idDesperfectos, ?, null, idPedido, ?, null, "Servicio_adicional")'
*/


<?php
include './footer.php';
?>
