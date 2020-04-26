<?php
  session_start();//Iniciamos la sesión para poder obtener datos de la sesión (o si está iniciada) tanto en este fichero como en aquellos que incluyan a éste.
  include './commonFunctions.php';
  if ( basename(__FILE__) == basename($_SERVER["SCRIPT_FILENAME"]) ) {//Así se sabe si se ha llamado directamente al fichero
    header("Location: ./");
  }
?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap CSS -->
    <link href="./css/bootstrap.min.css" rel="stylesheet">
    <link href="./fontawesome/css/fontawesome.min.css" rel="stylesheet">
    <link href="./fontawesome/css/all.min.css" rel="stylesheet">
    <link rel="icon" href="./img/favicon.ico" type="image/x-icon" />
    <link href="./css/common.css" rel="stylesheet">
    <link href="./css/header.css" rel="stylesheet">
    <script src="./js/jquery-3.4.1.min.js"></script>
    <script src="./js/bootstrap.bundle.min.js"></script>
    <script src="./js/common.js"></script>
    <title>La Vandería</title>
  </head>
  <body class=""><!--TODO Cambiar esto para que funcione en los fondos de imagen bg-light -->
    <div class="page-container">
      <div class="page-container-element header">
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
          <a class="navbar-brand logo-empresa" href=".\">
            <img src="./img/LaVandería Logo.png" width="90" height="auto" class="d-inline-block align-top" alt="">
            La Vandería
          </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarText">
              <ul class="navbar-nav mx-auto justify-content-center navbar-personalizado">
                <?php
                if(!isset($_SESSION['sesionIniciada'])){//TODO Cambiar elementos navbar para que los enlaces, textos y menú actual seleccionado coincidan como tienen que coincidir
                  echo '
                  <li class="nav-item '; echo (basename($_SERVER['PHP_SELF']) == "index.php") ? 'active' : ''; echo'">
                    <a class="nav-link" href="./">Inicio</a>
                  </li>
                  ';
                } else {
                  if($_SESSION['tipoCuentaSesión'] == "Cliente"){
                    echo '
                      <li class="nav-item '; echo (basename($_SERVER['PHP_SELF']) == "index.php") ? 'active' : ''; echo'">
                        <a class="nav-link" href="./">Inicio</a>
                      </li>
                      <li class="nav-item '; echo (basename($_SERVER['PHP_SELF']) == "consultaPedidos.php") ? 'active' : ''; echo'">
                        <a class="nav-link" href="./consultaPedidos">Consulta de pedidos</a>
                      </li>
                      <li class="nav-item '; echo (basename($_SERVER['PHP_SELF']) == "tarjetaPuntos.php") ? 'active' : ''; echo'">
                        <a class="nav-link" href="./tarjetaPuntos">Tarjeta de puntos</a>
                      </li>
                    ';
                  } else if ($_SESSION['tipoCuentaSesión'] == "Empleado"){
                    echo '
                      <li class="nav-item '; echo (basename($_SERVER['PHP_SELF']) == "index.php") ? 'active' : ''; echo'">
                        <a class="nav-link" href="./">Inicio</a>
                      </li>
                      <li class="nav-item '; echo (basename($_SERVER['PHP_SELF']) == "consultaPedidos.php") ? 'active' : ''; echo'">
                        <a class="nav-link" href="./consultaPedidos">Consulta de pedidos</a>
                      </li>
                    ';
                  } else if ($_SESSION['tipoCuentaSesión'] == "Encargado"){
                    echo '
                      <li class="nav-item '; echo (basename($_SERVER['PHP_SELF']) == "index.php") ? 'active' : ''; echo'">
                        <a class="nav-link" href="./">Inicio</a>
                      </li>
                      <li class="nav-item '; echo (basename($_SERVER['PHP_SELF']) == "peticionLimpieza.php") ? 'active' : ''; echo'">
                        <a class="nav-link" href="./peticionLimpieza">Petición de limpieza</a>
                      </li>
                      <li class="nav-item '; echo (basename($_SERVER['PHP_SELF']) == "consultaPedidos.php") ? 'active' : ''; echo'">
                        <a class="nav-link" href="./consultaPedidos">Consulta de pedidos</a>
                      </li>
                    ';
                  } else {//TODO Posiblemente sustituir por los mismos que una sesión iniciada, o alguno que cierre la sesión o similar.
                    echo '
                      <li class="nav-item active">
                        <a class="nav-link" href="#">ERROR<span class="sr-only">(current)</span></a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" href="#">ERROR</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" href="#">ERROR</a>
                      </li>
                    ';
                  }
                }
                ?>
              </ul>

                <?php
                  if(isset($_POST['cerrarSesión'])){
                    session_destroy();
                    header("Location: ./");
                  }
                  echo '<div class="contenedorCredencialesUsuario"><span class="navbar-text">';
                  if(isset($_SESSION['sesionIniciada']) && $_SESSION['sesionIniciada'] == true){
                      echo '<img src="./img/avatar/avatar'.$_SESSION['tipoCuentaSesión'].'.svg" style="border-color: darkgray;  border-style: solid; border-width: 2px; width:40px; margin-right: 16px; background-color: white; border-radius: 20px; padding: 2px; "></img>';

                    echo '

                    <a>' . $_SESSION["nombreSesión"] . ' ' . $_SESSION["apellidosSesión"] . '</a>

                    ';
                    echo '
                      <form method="POST" style="display: inline;">
                        <button type="submit" name="cerrarSesión" value="true" class="" style="background-color: transparent; border-color: transparent;"><img src="./img/logout.svg" style="width: 36px;"></img></button>
                      </form></span></div>
                    ';

                  } else {
                    echo '
                      <button type="button" class="btn btn-primary" onclick="location.href=\'./login\'">Iniciar sesión</button>
                      <button type="button" class="btn btn-primary" onclick="location.href=\'./signup\'">Registrarse</button>
                    ';
                  }
                ?>

            </div>
        </nav>
      </div>
