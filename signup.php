<!-- TODO Falta la validación de todos los campos (longitud, caracteres etc.) tanto en el lado del cliente como en el del servidor. -->
<?php
include './header.php';
if(isset($_SESSION['sesionIniciada'])){
  header("Location: ./");
}
?>
<link href="./css/signup.css" rel="stylesheet">
<div class="web-content container-fluid">
  <div class="row margen-superior" align="center">
    <div class="col-12 my-auto" align="center"><h1 class="font-weight-bold text-white">Registro</h1></div>
  </div>
  <div class="row justify-content-center">
    <div class="col-lg-8 col-xl-4">
      <div class="card bg-light">
        <div class="card-body">
          <form action="./signup" method="POST" id="formRegistro">
            <div class="form-row">
              <div class="form-group col-md-6">
                <label for="nombreRegistro">Nombre</label>
                <input type="text" class="form-control" name="nombreRegistro" id="nombreRegistro">
              </div>
              <div class="form-group col-md-6">
                <label for="apellidosRegistro">Apellidos</label>
                <input type="text" class="form-control" name="apellidosRegistro" id="apellidosRegistro">
              </div>
            </div>
            <div class="form-group">
              <label for="dniRegistro">DNI</label>
              <input type="text" class="form-control" name="dniRegistro" id="dniRegistro">
            </div>
            <div class="form-group">
              <label for="correoElectronicoRegistro">Correo electrónico</label>
              <input type="text" class="form-control" name="correoElectronicoRegistro" id="correoElectronicoRegistro">
            </div>
            <div class="form-group">
              <label for="contraseñaRegistro">Contraseña</label>
              <input type="password" class="form-control" name="contraseñaRegistro" id="contraseñaRegistro">
            </div>
            <div class="form-group">
              <label for="confirmaciónContraseñaRegistro">Repetir contraseña</label>
              <input type="password" class="form-control" name="confirmaciónContraseñaRegistro" id="confirmaciónContraseñaRegistro">
            </div>
            <input type="hidden" name="triedRegistro" id="triedRegistro" value="true">
          </form>
        </div>
      </div>
      <button type="submit" class="btn btn-primary btn-lg btn-registrarse" form="formRegistro" >Registrarse</button>
    </div>
  </div>
</div>
<?php
//Primero comprobamos si se han enviado datos desde el formulario para ver si se debe intentar insertar al cargar la página o no.
if(isset($_POST['triedRegistro'])  && $_POST['triedRegistro'] == true){
  //Si no se ha introducido algún campo, advertir al usuario. En caso contrario, procedemos con el registro.
  if (!isset($_POST['nombreRegistro'], $_POST['apellidosRegistro'], $_POST['dniRegistro'], $_POST['correoElectronicoRegistro'], $_POST['contraseñaRegistro'], $_POST['confirmaciónContraseñaRegistro']) || empty($_POST['nombreRegistro']) || empty($_POST['apellidosRegistro']) || empty($_POST['dniRegistro']) || empty($_POST['correoElectronicoRegistro']) || empty($_POST['contraseñaRegistro']) || empty($_POST['confirmaciónContraseñaRegistro'])) {
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

    if ($stmt = $db->prepare('SELECT nombre FROM Cuenta WHERE correoElectronico = ?')) {
    	$stmt->bind_param('s', $_POST['correoElectronicoRegistro']);
    	$stmt->execute();
    	$stmt->store_result();
    	// Store the result so we can check if the account exists in the database.
    	if ($stmt->num_rows > 0) {
    		// Username already exists
        echo '
          <div class="container-fluid" align="center">
            <div class="row justify-content-center" align="center">
              <div class="col-lg-8 col-xl-4">
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                  Este correo electrónico ya está en uso. Utiliza otro o <a href="./login">inicia sesión.</a>
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
              </div>
            </div>
          </div>
        ';
    	} else {
        if ($stmt2 = $db->prepare('INSERT INTO Cuenta (nombre, apellidos, correoElectronico, contraseña, dni) VALUES (?, ?, ?, ?, ?)')) {
        	// We do not want to expose passwords in our database, so hash the password and use password_verify when a user logs in.
        	$hashContraseña = password_hash($_POST['contraseñaRegistro'], PASSWORD_DEFAULT);
        	$stmt2->bind_param('sssss', $_POST['nombreRegistro'], $_POST['apellidosRegistro'], $_POST['correoElectronicoRegistro'], $hashContraseña, $_POST['dniRegistro']);
        	$stmt2->execute();
          $idCliente = mysqli_insert_id($db);
          if ($stmt3 = $db->prepare('INSERT INTO Cliente (idCuenta) VALUES (?)')) {
          	// We do not want to expose passwords in our database, so hash the password and use password_verify when a user logs in.
          	$stmt3->bind_param('s', $idCliente);
          	$stmt3->execute();
            echo '
              <div class="container-fluid" align="center">
                <div class="row justify-content-center" align="center">
                  <div class="col-lg-8 col-xl-4">
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                      ¡El registro ha sido completado satisfactoriamente! Ahora puedes <a href="./login">iniciar sesión.</a>
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
        	// Something is wrong with the sql statement, check to make sure accounts table exists with all 3 fields.
          echo '
            <div class="container-fluid" align="center">
              <div class="row justify-content-center" align="center">
                <div class="col-lg-8 col-xl-4">
                  <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    Ha ocurrido un error y no se ha podido completar el registro.
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                </div>
              </div>
            </div>
          ';
        }
    	}
    	$stmt->close();
    } else {
    	// Something is wrong with the sql statement, check to make sure accounts table exists with all 3 fields.
      echo '
        <div class="container-fluid" align="center">
          <div class="row justify-content-center" align="center">
            <div class="col-lg-8 col-xl-4">
              <div class="alert alert-danger alert-dismissible fade show" role="alert">
                Ha ocurrido un error y no se ha podido completar el registro.
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
            </div>
          </div>
        </div>
      ';
    }
  }
  $db->close();
} else {
}

?>
<script src="./js/signup.js"></script>
<?php
include './footer.php';
?>
