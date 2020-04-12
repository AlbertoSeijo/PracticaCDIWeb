<?php
if ( basename(__FILE__) == basename($_SERVER["SCRIPT_FILENAME"]) ) {//Así se sabe si se ha llamado directamente al fichero
  header("Location: ./");
}
?>
    <div class="page-container-element title">
      <div class="container-fluid contenedor-titulo-pagina">
        <div class="fondo-titulo-pagina">
        </div>
        <div class="container-fluid contenido-titulo-pagina">
          <button type="button" class="btn btn-primary ml-2 my-auto boton-retroceder-titulo-pagina" onclick="window.history.back();"><i class="fas fa-chevron-left fa-2x"></i></button></button>
          </button>
          <div class="mx-auto my-auto texto-titulo-pagina">
            <?php if (isset($nombrePagina)) {echo $nombrePagina;} else { echo 'Sin título';} ?>
          </div>
        </div>
      </div>
    </div>
