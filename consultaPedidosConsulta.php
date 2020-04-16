<?php
/* POST VARIABLES */
function mostrarPedido($tipoCuenta, $esPedidoExpress, $tipoPrenda, $tipoServicio, $etapaAnterior, $etapaActual, $etapaSiguiente){

}


function mostrarPedidoCliente($tipoCuenta, $esPedidoExpress, $tipoPrenda, $tipoServicio, $etapaAnterior, $etapaActual, $etapaSiguiente){

}


function consultaSQL($consulta, $tiposParametros, $listaParametros, $resultadoParametros, $funcionAnidada){

}


}
$seMuestra = $_POST["seMuestra"];
$ordenarPor = $_POST["ordenarPor"];
$buscarPor = $_POST["buscarPor"];
$entradaBusqueda = $_POST["entradaBusqueda"];

define('SERVIDOR_BD', 'localhost:3306');
define('USUARIO_BD', 'webtintoreria');
define('CONTRASENA_BD', 'lavanderia');
define('NOMBRE_BD', 'tintoreria');

$db = mysqli_connect(SERVIDOR_BD,USUARIO_BD,CONTRASENA_BD,NOMBRE_BD);
if($_SESSION['tipoCuentaSesión'] == "Cliente"){
  if ($stmt = $db->prepare('SELECT p.idPedido, d.valor, p.tipoPrenda, p.esPedidoExpress, tpedido.nombreTipoPedido, tpedido.precio  FROM Pedido p, Descuento d, TipoPedido tpedido WHERE ClientePedido = ? AND p.TipoPedido_idTipoPedido = tpedido.idTipoPedido AND p.Descuentos_idDescuentos  = d.idDescuentos')) {//Preparamos la consulta sql para evitar posibles ataques tipo SQL Injection
    $stmt->bind_param('i', $_SESSION['idCuentaSesión']);//Bindeamos al '?' el correo electrónico que nos ha mandado el usuario a través del formulario. El parámetro 's' indica que es un string.
    $stmt->execute();
    $stmt->store_result();
    if ($stmt->num_rows > 0) {//Si hay más de 0 filas es que se ha encontrado una cuenta con ese correo electrónico.
      $stmt->bind_result($puntos, $numtarjeta);//Guardamos la fila actual en viariables.
      $stmt->fetch();
      echo '
        <!-- A partir de aquí comienza la tarjeta que hay que repetir según las consultas -->
        <div class="container-fluid card bg-light" style="height: 250px; margin-bottom: 20px;">
          <div class="row" style="height: 100%;">
            <div class="col-8 container-fluid" style="">
              <div class="row" style="height: 35%;"><!--
                <div class="col-4 my-auto text-center" style="font-size: 16px; font-weight: bold;">
                  <i class="fas fa-star fa-2x" style="color:  #f1c40f "></i> Pedido expréss
                </div>-->
                <div class="col-4 my-auto text-center" style=" font-size: 16px; font-weight: bold; ">
                  <i class="far fa-star fa-2x" style="color: #f1c40f"></i> Pedido normal
                </div>
                <div class="col-8" style="">
                  <h5 style="margin-top: 8px;">Cronología:</h5>
                  <div class="row" style="height: 100%;">
                    <div class="col-6 text-left" style="height: 100%; white-space: nowrap;">
                      <a style="display:block; margin-left: 20px; font-size: 14px;">Fecha de inicio:</a>
                      <a style="display:block; margin-left: 20px; font-size: 14px;">Fecha de fin:</a>
                    </div>
                    <div class="col-6 text-right" style="height: 100%; white-space: nowrap;">
                      <a style="display:block; margin-left: 20px; font-size: 14px;">16/03/2020</a>
                      <a style="display:block; margin-left: 20px; font-size: 14px;">21/03/2020</a>
                    </div>
                  </div>
                </div>
              </div>
              <div class="row" style="height: 65%;">
                <div class="col-6 " style=""><!-- TODO Esta fila puede ser col-6 o col-12 según haya factura o no -->
                  <div class="row" style="height: 100%;">
                    <div class="col-6 text-center" style="height: 100; padding-top: 25px;">
                      <h5>Tipo de prenda</h5>
                      <div class="card bg-white mx-auto" style="width: 75px; height: 75px;">Tipo prenda</div>
                      <div class="text-center" style="position: absolute; width: 69px; background-color: white; height: 12px; left:0; right: 0; margin-left: auto; margin-right: auto; margin-top: -12px; line-height: 18px;">Nombre t. prenda</div>
                    </div>
                    <div class="col-6 text-center" style="height: 100; padding-top: 25px;">
                      <h5>Tipo de servicio</h5>
                      <div class="card bg-white mx-auto" style="width: 75px; height: 75px;">Servicio</div>
                      <div class="text-center" style="position: absolute; width: 69px; background-color: white; height: 12px; left:0; right: 0; margin-left: auto; margin-right: auto; margin-top: -12px; line-height: 18px;">Nombre servicio</div>
                    </div>
                  </div>
                </div>
                <div class="col-6" style="">
                  <h5 style="margin-top: 15px;">Total desglosado</h5>
                  <div class="row" style="height: 100%;">
                    <div class="col-6 text-left" style="height: 100%;">
                      <a style="display:block; margin-left: 20px; font-size: 12px;">Servicio:</a>
                      <a style="display:block; margin-left: 20px; font-size: 12px;">Arreglos solicitados:</a>
                      <a style="display:block; margin-left: 20px; font-size: 12px;">Arreglos extras:</a>
                      <a style="display:block; margin-left: 20px; font-size: 12px;">Descuento:</a>
                      <a class="font-weight-bold" style="display:block; margin-left: 20px;">Total:</a>
                    </div>
                    <div class="col-6 text-right" style="height: 100%;">
                      <a style="position: absolute; left: 10px; top: 20px; font-size: 20px;">+</a>
                      <a style="display:block; margin-left: 20px; font-size: 12px;">12.34 €</a>
                      <a style="display:block; margin-left: 20px; font-size: 12px;">56.78 €</a>
                      <a style="display:block; margin-left: 20px; font-size: 12px;">90.12 €</a>
                      <a style="display:block; margin-left: 20px; font-size: 12px;">-34.56 €</a>
                      <hr style="margin: 0px; border-width: 2px;">
                      <a class="font-weight-bold" style="display:block; margin-left: 20px;">78.90€</a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-4 container-fluid" style="">
              <div class="container-fluid" style="height: 70%;">
                <h3 style="margin-top: 10px;">Etapas</h3>
                <div class="row" style="height: 65%;">
                  <div class="col-4 my-auto" style="">
                    <div class="card bg-white mx-auto" style="width: 75px; height: 75px;">Etapa A</div>
                    <div class="text-center" style="position: absolute; width: 69px; background-color: white; height: 15px;  left:0; right: 0; margin-left: auto; margin-right: auto; margin-top: -15px;">Etapa 1</div>
                  </div>
                  <div class="col-4 my-auto" style="">
                    <i class="fas fa-caret-right fa-4x" style="position: absolute; left: -15px; transform: translate(0%, 20%);"></i>
                    <div class="card bg-white mx-auto" style="width: 90px; height: 90px;">Etapa B</div>
                    <div class="text-center" style="position: absolute; width: 84px; background-color: white; height: 15px;  left:0; right: 0; margin-left: auto; margin-right: auto; margin-top: -15px;">Etapa 2</div>
                  </div>
                  <div class="col-4 my-auto" style="">
                    <i class="fas fa-caret-right fa-4x" style="position: absolute; left: -7px; transform: translate(0%, 10%);"></i>
                    <div class="card bg-white mx-auto" style="width: 75px; height: 75px;">Etapa C</div>
                    <div class="text-center" style="position: absolute; width: 69px; background-color: white; height: 15px; left:0; right: 0; margin-left: auto; margin-right: auto; margin-top: -15px;">Etapa 3</div>
                  </div>
                </div>
              </div>
              <div class="container-fluid text-center" style="height: 30%;">
                <button class="btn btn-primary btn-lg">Detalles del pedido</button>
                <!--
                <button type="button" class="btn btn-danger btn-lg" style="width: 30%;">Cancelar pedido</button>
                <button type="button" class="btn btn-primary btn-lg" style="width: 60%;">Aceptar precio actualizado</button>
                -->
              </div>
            </div>
          </div>
        </div>
        <!-- A partir de aquí termina la tarjeta que hay que repetir según las consultas -->
      ';
  else if ($_SESSION['tipoCuentaSesión'] == "Empleado") {



  } else if ($_SESSION['tipoCuentaSesión'] == "Encargado") {



  } else {
    echo 'ERROR: Tipo de cuenta no definido.'
  }
?>
