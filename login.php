<?php
include './header.php';?>

<form method="post">
  <div class="form-group">
    <label for="emailLogin">Correo electrónico</label>
    <input type="email" class="form-control" id="emailLogin" aria-describedby="emailHelp">
  </div>
  <div class="form-group">
    <label for="contraseñaLogin">Contraseña</label>
    <input type="password" class="form-control" id="contraseñaLogin">
  </div>
  <button type="submit" class="btn btn-primary">Iniciar sesión</button>
  <input type="hidden" id="triedLogin" value="true">
</form>
<?php
if(isset($_POST['triedLogin'])){
  //Si no se ha introducido el usuario o la contraseña, advertir al usuario. En caso contrario, procedemos con el inicio de sesión.
  if (!isset($_POST['usuarioLogin'], $_POST['contraseñaLogin']) ) {
  	exit('Please fill both the username and password fields!');//TODO Echo Por favor rellena los campos, o algo así.
  } else {
    define('SERVIDOR_BD', 'localhost:3306');
    define('USUARIO_BD', 'webtintoreria');
    define('CONTRASENA_BD', 'lavanderia');
    define('NOMBRE_BD', 'tintoreria');

    $db = mysqli_connect(SERVIDOR_BD,USUARIO_BD,CONTRASENA_BD,NOMBRE_BD);
    session_start();

    if ($stmt = $con->prepare('SELECT idCuenta, nombre, apellidos, correoElectronico, contraseña FROM cuenta WHERE correoElectronico = ?')) {//Preparamos la consulta sql para evitar posibles ataques tipo SQL Injection
    	$stmt->bind_param('s', $_POST['emailLogin']);//Bindeamos al '?' el correo electrónico que nos ha mandado el usuario a través del formulario. El parámetro 's' indica que es un string.
    	$stmt->execute();
    	$stmt->store_result();

      if ($stmt->num_rows > 0) {//Si hay más de 0 filas es que se ha encontrado una cuenta con ese correo electrónico.
      	$stmt->bind_result($idCuenta, $nombreCuenta, $apellidosCuenta, $correoElectronicoCuenta, $contraseñaCuenta);//Guardamos la fila actual en viariables.
      	$stmt->fetch();
      	if (password_verify($_POST['contraseñaLogin'], $contraseñaCuenta)) {
          //Creamos una sesión
      		session_regenerate_id();
      		$_SESSION['sesionIniciada'] = true;
          $_SESSION['idCuentaSesión'] = $idCuenta;
      		$_SESSION['nombreSesión'] = $nombreCuenta;
      		$_SESSION['apellidosSesión'] = $apellidosCuenta;
          $_SESSION['correoElectronicoSesión'] = $correoElectronicoCuenta;
      		echo 'Welcome ' . $_SESSION['name'] . '!';
      	} else {
      		echo 'Contraseña incorrecta';//TODO Mostrar mensaje de contraseña incorrecta
      	}
      } else {
      	echo 'Usuario no encontrado';//TODO Mostrar mensaje de que no se ha encontrado al usuario en la base de datos (no está registrado)
      }

    	$stmt->close();
    }
  }
}





 ?>









  No vale reirse eh!
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
