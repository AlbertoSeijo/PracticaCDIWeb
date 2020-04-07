<?php
include './header.php';?>

<?php
    //Ejemplo de login
    define('SERVIDOR_BD', 'localhost:3306');
    define('USUARIO_BD', 'webtintoreria');
    define('CONTRASENA_BD', 'lavanderia');
    define('NOMBRE_BD', 'tintoreria');
    $db = mysqli_connect(SERVIDOR_BD,USUARIO_BD,CONTRASENA_BD,NOMBRE_BD);

    $sql = "SELECT * FROM tipopedido";
    $result = mysqli_query($db,$sql);
    while($row = $result->fetch_assoc()) {
            echo "idTipoPedido: " . $row["idTipoPedido"]. " - nombreTipoPedido: " . $row["nombreTipoPedido"]. " Precio:" . $row["precio"]. "<br>";
        }
?>

<div class="card" style="width: 18rem;">
<img src="./img/LaVandería Logo.png" class="card-img-top" alt="...">
<div class="card-body">
  <h5 class="card-title">Quienes somos</h5>
  <p class="card-text">Servicios integrales de lavandería

Contamos con el aval de nuestra trayectoria (desde 1982) y los más de 700 clientes atendidos semanalmente, adaptándonos a las exigencias y particularidades de cada uno de ellos.

Entendemos que cada cliente requiere de unas necesidades específicas y por ello estudiamos cada caso con el objetivo de ofrecerle un servicio a medida.

Servicio adaptado a las necesidades y demandas de los clientes

Ofrecemos a todos nuestros clientes el mejor servicio, eficacia y compromiso, disponiendo de una gran variedad de servicios y posibilidades.

Disponemos de un equipo de profesionales experimentados y  las últimas tecnologías en maquinaria con el fin de obtener un conjunto con el que seguir ofreciendo la atención, servicios y resultados de calidad en todos nuestros trabajos.</p>
  <a href="#" class="btn btn-primary">Ver más</a>
</div>
</div>

<?php
include './footer.php';
?>
