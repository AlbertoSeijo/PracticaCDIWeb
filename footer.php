<!-- Pie de página, compartido por todas las páginas. Ya veremos qué ponemos aquí, si es que ponemos algo -->
<?php
if ( basename(__FILE__) == basename($_SERVER["SCRIPT_FILENAME"]) ) {//Así se sabe si se ha llamado directamente al fichero
  header("Location: ./");
}
?>
  <script src="./js/jquery-3.4.1.min.js"></script>
  <script src="./js/bootstrap.bundle.min.js"></script>
  </body>
</html>
