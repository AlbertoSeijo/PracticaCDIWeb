<!-- TODO Falta la validación de todos los campos (longitud, caracteres etc.) tanto en el lado del cliente como en el del servidor. -->
<?php
include './header.php';
if(isset($_SESSION['sesionIniciada'])){
  header("Location: ./");
}
?>
<div class="container-fluid" align="center">
  <div class="row" align="center" style="height:250px;"></div>
  <div class="row" align="center">
    <div class="col-4"></div>
    <div class="col-lg-4">
      <form action="./login" method="POST">
        <div class="form-group">
          <label for="emailLogin">Correo electrónico</label>
          <input type="email" class="form-control" name="emailLogin" id="emailLogin" aria-describedby="emailHelp">
        </div>
        <div class="form-group">
          <label for="contraseñaLogin">Contraseña</label>
          <input type="password" class="form-control" name="contraseñaLogin" id="contraseñaLogin">
        </div>
        <button type="submit" class="btn btn-primary">Iniciar sesión</button>
        <input type="hidden" name="triedLogin" id="triedLogin" value="true">
      </form>
    </div>
    <div class="col-3"></div>
  </div>
</div>
<?php
//Primero comprobamos si se han enviado datos desde el formulario para ver si se debe intentar insertar al cargar la página o no.
if(isset($_POST['triedLogin']) && $_POST['triedLogin'] == true){
  //Si no se ha introducido el usuario o la contraseña, advertir al usuario. En caso contrario, procedemos con el inicio de sesión.
  if (!isset($_POST['emailLogin'], $_POST['contraseñaLogin']) ) {
  	exit('Please fill both the username and password fields!');//TODO Echo Por favor rellena los campos, o algo así.
  } else {
    define('SERVIDOR_BD', 'localhost:3306');
    define('USUARIO_BD', 'webtintoreria');
    define('CONTRASENA_BD', 'lavanderia');
    define('NOMBRE_BD', 'tintoreria');

    $db = mysqli_connect(SERVIDOR_BD,USUARIO_BD,CONTRASENA_BD,NOMBRE_BD);
    //session_start(); TODO Ya se inicia en el header

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
          //Ahora buscamos al usuario en las tablas de clientes y empleados para saber qué tipo de usuario es
          if ($stmt2 = $db->prepare('SELECT esEncargado FROM Empleado WHERE Cuenta_idCuenta = ?')) {//Preparamos la consulta sql para evitar posibles ataques tipo SQL Injection
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
              if ($stmt3 = $db->prepare('SELECT Cuenta_idCuenta FROM Cliente WHERE Cuenta_idCuenta = ?')) {//Preparamos la consulta sql para evitar posibles ataques tipo SQL Injection
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
      		echo 'Welcome!';
          header("Location: ./");
      	} else {
      		echo 'Contraseña incorrecta';//TODO Mostrar mensaje de contraseña incorrecta
      	}
      } else {
      	echo '
          <div class="container-fluid" align="center">
            <div class="row" align="center">
              <div class="col-3"></div>
              <div class="col-6 alert alert-danger alert-dismissible fade show" role="alert">
                El usuario indicado no se encuentra registrado. Compruebe sus credenciales e inténtelo de nuevo.
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
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

<?php
include './footer.php';
?>
