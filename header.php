<?php
  session_start();//Iniciamos la sesión para poder obtener datos de la sesión (o si está iniciada) tanto en este fichero como en aquellos que incluyan a éste.
  if ( basename(__FILE__) == basename($_SERVER["SCRIPT_FILENAME"]) ) {//Así se sabe si se ha llamado directamente al fichero
    header("Location: ./");
  }
?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no, user-scalable=no">
    <!-- Bootstrap CSS -->
    <link href="./css/bootstrap.min.css" rel="stylesheet">
    <link href="./fontawesome/css/fontawesome.min.css" rel="stylesheet">
    <link href="./fontawesome/css/all.min.css" rel="stylesheet">
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
              <ul class="navbar-nav mx-auto">
                <?php
                if(!isset($_SESSION['sesionIniciada'])){//TODO Cambiar elementos navbar para que los enlaces, textos y menú actual seleccionado coincidan como tienen que coincidir
                  echo '
                    <li class="nav-item active">
                      <a class="nav-link" href="#">Elementos <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" href="#">Sesión</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" href="#">No iniciada</a>
                    </li>
                  ';
                } else {
                  if($_SESSION['tipoCuentaSesión'] == "Cliente"){
                    echo '
                      <li class="nav-item active">
                        <a class="nav-link" href="#">Menú<span class="sr-only">(current)</span></a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" href="#">Cliente</a>
                      </li>
                    ';
                  } else if ($_SESSION['tipoCuentaSesión'] == "Empleado"){
                    echo '
                      <li class="nav-item active">
                        <a class="nav-link" href="#">Elementos<span class="sr-only">(current)</span></a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" href="#">Empleado</a>
                      </li>
                    ';
                  } else if ($_SESSION['tipoCuentaSesión'] == "Encargado"){
                    echo '
                      <li class="nav-item active">
                        <a class="nav-link" href="#">Páginas<span class="sr-only">(current)</span></a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" href="#">Encargado</a>
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
              <span class="navbar-text">
                <?php
                  if(isset($_POST['cerrarSesión'])){
                    session_destroy();
                    header("Location: ./");
                  }
                  if(isset($_SESSION['sesionIniciada']) && $_SESSION['sesionIniciada'] == true){
                    echo $_SESSION['nombreSesión'] . " " . $_SESSION['apellidosSesión'];
                    echo '
                      <form method="POST">
                        <button type="submit" name="cerrarSesión" value="true" class="btn btn-primary">Salir</button>
                      </form>
                    ';

                  } else {
                    echo '
                      <button type="button" class="btn btn-primary" onclick="location.href=\'./login\'">Iniciar sesión</button>
                      <button type="button" class="btn btn-primary" onclick="location.href=\'./signup\'">Registrarse</button>
                    ';
                  }
                ?>
              </span>
            </div>
        </nav>
      </div>
