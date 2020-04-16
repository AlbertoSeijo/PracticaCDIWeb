<?php
include './header.php';
if(!isset($_SESSION['sesionIniciada']) || $_SESSION['tipoCuentaSesión'] == "ERROR"){
  header("Location: ./");
}
?>
<link href="./css/consultaPedidos.css" rel="stylesheet">
<?php
$nombrePagina = "Consulta de pedidos";
include './cabeceraContenido.php';
?>
<?php
if($_SESSION['tipoCuentaSesión'] != "Encargado"){


} else if($_SESSION['tipoCuentaSesión'] != "Empleado"){


} else if($_SESSION['tipoCuentaSesión'] != "Cliente"){
  echo '';
}

 ?>
<div class="container-fluid">
  <div class="row" style="margin-top:16px;">
    <div class="col-2"></div>
    <div class="col-2">
      <div class="form-group">
        <label class="etiquetaElementosFormulario" for="aaaa">Mostrar:</label>
        <select class="custom-select" id="aaaa">
          <option selected>Por realizar</option>
          <option value="1">Finalizado</option>
          <option value="2">En proceso</option>
          <option value="3">Todo</option>
        </select>
      </div>
    </div>
    <link href="./fontawesome/css/all.css" rel="stylesheet"> <!--load all styles -->
    <div class="col-2">
      <label class="etiquetaElementosFormulario" for="aaaa">Ordenar por:</label>
      <select class="custom-select">
        <option selected>Express</option>
        <option value="1">Fecha de toma de pedido (ascendente)</option>
        <option value="2">Fecha de toma de pedido (descendente)</option>
        <option value="2">Fecha de fin de pedido (descendente)</option>
        <option value="2">Fecha de fin de pedido (descendente)</option>
      </select>
    </div>
    <div class="col-4">
      <div class="input-group" style="margin-top: 25px;">
        <div class="input-group-prepend">
          <select class="custom-select btn bg-light">
            <option selected>Nombre de cliente</option>
            <option value="1">Fecha de pedido</option>
            <option value="2">Tipo de prenda</option>
          </select>
        </div>
        <input type="text" class="form-control" placeholder="Búsqueda..." style="border-bottom-right-radius: 0.25rem; border-top-right-radius: 0.25rem; ">
        <button type="submit" class="btn btn-primary" style="margin-left: 16px; margin-top: -10px;" form="" ><i class="fas fa-search"></i></button>
      </div>
    </div>
    <div class="col-2"></div>
  </div>
  <div class="row">
    <div class="col-2"></div>
    <div class="col-8" style=" ">
      <div class="container-fluid card" style="height: 60vh; padding: 0px;">
        <div class="card-body" style="overflow-y: auto;">
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
                  <div class="col-4" style="">
                    <h5 style="margin-top: 8px;">Cliente</h5>
                    <div>
                      <img src="./img/avatar/avatarCliente.png" style="width: 36px; height: 36px; margin-left: 20px;"></img> Pepito Gómez
                    </div>
                  </div>
                  <div class="col-4" style="">
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
          <!-- A partir de aquí comienza la tarjeta que hay que repetir según las consultas -->
          <div class="container-fluid card bg-light" style="height: 250px; margin-bottom: 20px;">
            <div class="row" style="height: 100%;">
              <div class="col-8 container-fluid" style="">
                <div class="row" style="height: 35%;">
                  <div class="col-4 my-auto text-center" style="font-size: 16px; font-weight: bold;">
                    <i class="fas fa-star fa-2x" style="color:  #f1c40f "></i> Pedido expréss
                  </div><!--
                  <div class="col-4 my-auto text-center" style=" font-size: 16px; font-weight: bold; ">
                    <i class="far fa-star fa-2x" style="color: #f1c40f"></i> Pedido normal
                  </div>-->
                  <div class="col-4" style="">
                    <h5 style="margin-top: 8px;">Cliente</h5>
                    <div>
                      <img src="./img/avatar/avatarCliente.png" style="width: 36px; height: 36px; margin-left: 20px;"></img> Pepito Gómez
                    </div>
                  </div>
                  <div class="col-4" style="">
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
                  <div class="col-4" style="">
                    <h5 style="margin-top: 8px;">Cliente</h5>
                    <div>
                      <img src="./img/avatar/avatarCliente.png" style="width: 36px; height: 36px; margin-left: 20px;"></img> Pepito Gómez
                    </div>
                  </div>
                  <div class="col-4" style="">
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
                  <div class="col-4" style="">
                    <h5 style="margin-top: 8px;">Cliente</h5>
                    <div>
                      <img src="./img/avatar/avatarCliente.png" style="width: 36px; height: 36px; margin-left: 20px;"></img> Pepito Gómez
                    </div>
                  </div>
                  <div class="col-4" style="">
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
                  <div class="col-4" style="">
                    <h5 style="margin-top: 8px;">Cliente</h5>
                    <div>
                      <img src="./img/avatar/avatarCliente.png" style="width: 36px; height: 36px; margin-left: 20px;"></img> Pepito Gómez
                    </div>
                  </div>
                  <div class="col-4" style="">
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
                  <div class="col-4" style="">
                    <h5 style="margin-top: 8px;">Cliente</h5>
                    <div>
                      <img src="./img/avatar/avatarCliente.png" style="width: 36px; height: 36px; margin-left: 20px;"></img> Pepito Gómez
                    </div>
                  </div>
                  <div class="col-4" style="">
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
        </div>
      </div>
    <div class="col-2"></div>
  </div>
</div>
<!--
/* CLIENTES

POR REALIZAR

SELECT idTipoPedido, tipoPrenda, esPedidoExpress, fechaIni, fechaFin
FROM pedidos p INNER JOIN etapa e ON p.idPedido = e.idPedido
WHERE idEtapa = 1 AND fechaIni = 'null' AND clientepedido = ?;
SELECT idTipoPedido, tipoPrenda, esPedidoExpress, fechaIni, fechaFin
FROM pedidos p INNER JOIN etapa e ON p.idPedido = e.idPedido
WHERE idEtapa = 7 AND fechaFin = 'null' AND clientepedido = ?;
SELECT idTipoPedido, tipoPrenda, esPedidoExpress, fechaIni, fechaFin
FROM pedidos p INNER JOIN etapa e ON p.idPedido = e.idPedido
WHERE idEtapa = 7 AND fechaIni != 'null' AND clientepedido = ?;
SELECT idTipoPedido, tipoPrenda, esPedidoExpress, fechaIni, fechaFin
FROM pedidos p INNER JOIN etapa e ON p.idPedido = e.idPedido
WHERE clientepedido = ?;
---------------------------------------------------------------------
SELECT idTipoPedido, tipoPrenda, esPedidoExpress, fechaIni, fechaFin
FROM pedidos p INNER JOIN etapa e ON p.idPedido = e.idPedido
WHERE clientepedido = ?
ORDER BY esPedidoExpress;
SELECT idTipoPedido, tipoPrenda, esPedidoExpress, fechaIni, fechaFin
FROM pedidos p INNER JOIN etapa e ON p.idPedido = e.idPedido
WHERE clientepedido = ?
ORDER BY fechaini ASC;
SELECT idTipoPedido, tipoPrenda, esPedidoExpress, fechaIni, fechaFin
FROM pedidos p INNER JOIN etapa e ON p.idPedido = e.idPedido
WHERE clientepedido = ?
ORDER BY fechaini DESC;
SELECT idTipoPedido, tipoPrenda, esPedidoExpress, fechaIni, fechaFin
FROM pedidos p INNER JOIN etapa e ON p.idPedido = e.idPedido
WHERE clientepedido = ?
ORDER BY fechafin ASC;
SELECT idTipoPedido, tipoPrenda, esPedidoExpress, fechaIni, fechaFin
FROM pedidos p INNER JOIN etapa e ON p.idPedido = e.idPedido
WHERE clientepedido = ?
ORDER BY fechafin DESC;
SELECT idTipoPedido, tipoPrenda, esPedidoExpress, fechaIni, fechaFin
FROM pedidos p INNER JOIN etapa e ON p.idPedido = e.idPedido
WHERE clientepedido = ?
ORDER BY tipoPrenda ASC;
*/

/* ENCARGADO
SELECT idTipoPedido, tipoPrenda, esPedidoExpress, fechaIni, fechaFin
FROM pedidos p INNER JOIN etapa e ON p.idPedido = e.idPedido
WHERE idEtapa = 1 AND fechaIni = 'null';
SELECT idTipoPedido, tipoPrenda, esPedidoExpress, fechaIni, fechaFin
FROM pedidos p INNER JOIN etapa e ON p.idPedido = e.idPedido
WHERE idEtapa = 7 AND fechaFin = 'null';
SELECT idTipoPedido, tipoPrenda, esPedidoExpress, fechaIni, fechaFin
FROM pedidos p INNER JOIN etapa e ON p.idPedido = e.idPedido
WHERE idEtapa = 7 AND fechaIni != 'null';
SELECT idTipoPedido, tipoPrenda, esPedidoExpress, fechaIni, fechaFin
FROM pedidos p INNER JOIN etapa e ON p.idPedido = e.idPedido;
---------------------------------------------------------------------
SELECT idTipoPedido, tipoPrenda, esPedidoExpress, fechaIni, fechaFin
FROM pedidos p INNER JOIN etapa e ON p.idPedido = e.idPedido
ORDER BY esPedidoExpress;
SELECT idTipoPedido, tipoPrenda, esPedidoExpress, fechaIni, fechaFin
FROM pedidos p INNER JOIN etapa e ON p.idPedido = e.idPedido
ORDER BY fechaini ASC;
SELECT idTipoPedido, tipoPrenda, esPedidoExpress, fechaIni, fechaFin
FROM pedidos p INNER JOIN etapa e ON p.idPedido = e.idPedido
ORDER BY fechaini DESC;
SELECT idTipoPedido, tipoPrenda, esPedidoExpress, fechaIni, fechaFin
FROM pedidos p INNER JOIN etapa e ON p.idPedido = e.idPedido
ORDER BY fechafin ASC;
SELECT idTipoPedido, tipoPrenda, esPedidoExpress, fechaIni, fechaFin
FROM pedidos p INNER JOIN etapa e ON p.idPedido = e.idPedido
ORDER BY fechafin DESC;
SELECT idTipoPedido, tipoPrenda, esPedidoExpress, fechaIni, fechaFin
FROM pedidos p INNER JOIN etapa e ON p.idPedido = e.idPedido
ORDER BY tipoPrenda ASC;
---------------------------------------------------------------------
SELECT idTipoPedido, tipoPrenda, esPedidoExpress, fechaIni, fechaFin
FROM pedidos p INNER JOIN etapa e ON p.idPedido = e.idPedido INNER JOIN cuenta c ON c.idCuenta = p.idCuenta
WHERE c.nombre LIKE ?%;
*/

/* EMPLEADO
SELECT idTipoPedido, tipoPrenda, esPedidoExpress, fechaIni, fechaFin
FROM pedidos p INNER JOIN etapa e ON p.idPedido = e.idPedido
WHERE idEtapa = 1 AND fechaIni = 'null' AND empleadoasignado = ?;
SELECT idTipoPedido, tipoPrenda, esPedidoExpress, fechaIni, fechaFin
FROM pedidos p INNER JOIN etapa e ON p.idPedido = e.idPedido
WHERE idEtapa = 7 AND fechaFin = 'null' AND empleadoasignado = ?;
SELECT idTipoPedido, tipoPrenda, esPedidoExpress, fechaIni, fechaFin
FROM pedidos p INNER JOIN etapa e ON p.idPedido = e.idPedido
WHERE idEtapa = 7 AND fechaIni != 'null' AND empleadoasignado = ?;
SELECT idTipoPedido, tipoPrenda, esPedidoExpress, fechaIni, fechaFin
FROM pedidos p INNER JOIN etapa e ON p.idPedido = e.idPedido
WHERE empleadoasignado = ?;
---------------------------------------------------------------------
SELECT idTipoPedido, tipoPrenda, esPedidoExpress, fechaIni, fechaFin
FROM pedidos p INNER JOIN etapa e ON p.idPedido = e.idPedido
WHERE empleadoasignado = ?
ORDER BY esPedidoExpress;
SELECT idTipoPedido, tipoPrenda, esPedidoExpress, fechaIni, fechaFin
FROM pedidos p INNER JOIN etapa e ON p.idPedido = e.idPedido
WHERE empleadoasignado = ?
ORDER BY fechaini ASC;
SELECT idTipoPedido, tipoPrenda, esPedidoExpress, fechaIni, fechaFin
FROM pedidos p INNER JOIN etapa e ON p.idPedido = e.idPedido
WHERE empleadoasignado = ?
ORDER BY fechaini DESC;
SELECT idTipoPedido, tipoPrenda, esPedidoExpress, fechaIni, fechaFin
FROM pedidos p INNER JOIN etapa e ON p.idPedido = e.idPedido
WHERE empleadoasignado = ?
ORDER BY fechafin ASC;
SELECT idTipoPedido, tipoPrenda, esPedidoExpress, fechaIni, fechaFin
FROM pedidos p INNER JOIN etapa e ON p.idPedido = e.idPedido
WHERE empleadoasignado = ?
ORDER BY fechafin DESC;
SELECT idTipoPedido, tipoPrenda, esPedidoExpress, fechaIni, fechaFin
FROM pedidos p INNER JOIN etapa e ON p.idPedido = e.idPedido
WHERE empleadoasignado = ?
ORDER BY tipoPrenda ASC;
----------------------------------------------------------------------
SELECT idTipoPedido, tipoPrenda, esPedidoExpress, fechaIni, fechaFin
FROM pedidos p INNER JOIN etapa e ON p.idPedido = e.idPedido INNER JOIN cuenta c ON c.idCuenta = p.idCuenta
WHERE empleadoasignado = ? AND c.nombre LIKE ?%;
*/
-->
<?php
include './footer.php';
?>
