<!-- TODO Falta la validación de todos los campos (longitud, caracteres etc.) tanto en el lado del cliente como en el del servidor. -->
<?php
include './header.php';
if(isset($_SESSION['sesionIniciada'])){
  header("Location: ./");
}
?>
<link href="./css/login.css" rel="stylesheet">
<div class="web-content container-fluid">
  <div class="row margen-superior" align="center">
    <div class="col-12 my-auto" align="center"><h1 class="font-weight-bold text-white">Inicio de sesión</h1></div>
  </div>
  <div class="row justify-content-center">
    <div class="col-lg-8 col-xl-4">
      <div class="card bg-light">
        <div class="card-body">
          <form action="./login" method="POST" id="formLogin">
            <div class="form-group">
              <label for="emailLogin">Correo electrónico</label><a style="color:red;"> *</a>
              <input type="email" class="form-control" name="emailLogin" id="emailLogin" aria-describedby="emailHelp" value="<?php if(isset($_POST["emailLogin"])){echo $_POST["emailLogin"];}?>">
            </div>
            <div class="form-group">
              <label for="contraseñaLogin">Contraseña</label><a style="color:red;"> *</a>
              <input type="password" class="form-control" name="contraseñaLogin" id="contraseñaLogin" value="<?php if(isset($_POST["contraseñaLogin"])){echo $_POST["contraseñaLogin"];}?>">
            </div>
            <a style="color:red; font-size:10px;">Los campos marcados con * son obligatorios</a>
            <input type="hidden" name="triedLogin" id="triedLogin" value="true">
          </form>
        </div>
      </div>
      <button type="submit" class="btn btn-primary btn-lg btn-login" form="formLogin">Iniciar sesión</button>
    </div>
  </div>

<?php
//Primero comprobamos si se han enviado datos desde el formulario para ver si se debe intentar insertar al cargar la página o no.
if(isset($_POST['triedLogin']) && $_POST['triedLogin'] == true){
  //Si no se ha introducido el usuario o la contraseña, advertir al usuario. En caso contrario, procedemos con el inicio de sesión.
  if (!isset($_POST['emailLogin'], $_POST['contraseñaLogin']) || empty($_POST['emailLogin']) || empty($_POST['contraseñaLogin'])) {
  	echo '
    <div class="container-fluid" align="center">
      <div class="row justify-content-center" align="center">
        <div class="col-lg-8 col-xl-4">
          <div class="alert alert-danger alert-dismissible fade show" role="alert">
            Debes rellenar todos los campos para poder iniciar sesión.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
        </div>
      </div>
    </div>

    ';//TODO Echo Por favor rellena los campos, o algo así.
  } else {
    define('SERVIDOR_BD', 'localhost:3306');
    define('USUARIO_BD', 'webtintoreria');
    define('CONTRASENA_BD', 'lavanderia');
    define('NOMBRE_BD', 'tintoreria');

    $db = mysqli_connect(SERVIDOR_BD,USUARIO_BD,CONTRASENA_BD,NOMBRE_BD);

    if ($stmt = $db->prepare('SELECT idCuenta, nombre, apellidos, correoElectronico, contraseña FROM cuenta WHERE correoElectronico = ?')) {//Preparamos la consulta sql para evitar posibles ataques tipo SQL Injection
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
          $_SESSION['tipoCuentaSesión'] = "ERROR";
          //Ahora buscamos al usuario en las tablas de clientes y empleados para saber qué tipo de usuario es
          if ($stmt2 = $db->prepare('SELECT esEncargado FROM Empleado WHERE idCuenta = ?')) {//Preparamos la consulta sql para evitar posibles ataques tipo SQL Injection
          	$stmt2->bind_param('s', $idCuenta);//Bindeamos al '?' el correo electrónico que nos ha mandado el usuario a través del formulario. El parámetro 's' indica que es un string.
          	$stmt2->execute();
          	$stmt2->store_result();

            if ($stmt2->num_rows > 0) {//Si hay más de 0 filas es que se ha encontrado que la cuenta es de Empleado
            	$stmt2->bind_result($esEncargado);//Guardamos la fila actual en viariables.
            	$stmt2->fetch();
              if($esEncargado){
                $_SESSION['tipoCuentaSesión'] = "Encargado";
              } else {
                $_SESSION['tipoCuentaSesión'] = "Empleado";
              }
            } else { //Si no se encuentra la id en la tabla empleados, entonces se trata de un usuario.
              if ($stmt3 = $db->prepare('SELECT idCuenta FROM Cliente WHERE idCuenta = ?')) {//Preparamos la consulta sql para evitar posibles ataques tipo SQL Injection
              	$stmt3->bind_param('s', $idCuenta);//Bindeamos al '?' el correo electrónico que nos ha mandado el usuario a través del formulario. El parámetro 's' indica que es un string.
              	$stmt3->execute();
              	$stmt3->store_result();
                if ($stmt3->num_rows > 0) {//Si hay más de 0 filas es que se ha encontrado que la cuenta es de Cliente
                	$stmt3->bind_result($idCuentaCliente);//Guardamos la fila actual en viariables.
                	$stmt3->fetch();
                  $_SESSION['tipoCuentaSesión'] = "Cliente";
                } else {
                  $_SESSION['tipoCuentaSesión'] = "ERROR"; //La cuenta no tiene un tipo asignado.
                }
                $stmt3->close();
              }
            }
            $stmt2->close();
          }
          header("Location: ./");
      	} else {
          echo '
            <div class="container-fluid" align="center">
              <div class="row justify-content-center" align="center">
                <div class="col-lg-8 col-xl-4">
                  <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    La contraseña introducida es incorrecta. Comprueba tus credenciales e inténtalo de nuevo.
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                </div>
              </div>
            </div>
          ';
      	}
      } else {
      	echo '
          <div class="container-fluid" align="center">
            <div class="row justify-content-center" align="center">
              <div class="col-lg-8 col-xl-4">
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                  El usuario indicado no se encuentra registrado. Comprueba tus credenciales e inténtalo de nuevo o <a href="./signup">crea una nueva cuenta.</a>
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
              </div>
            </div>
          </div>
        ';
      }
      $stmt->close();
    }
  }
}
?>

</div>

<?php
include './footer.php';
?>
