<?php
if ( basename(__FILE__) == basename($_SERVER["SCRIPT_FILENAME"]) ) {//Así se sabe si se ha llamado directamente al fichero
  header("Location: ./");
}
function normalizarTexto($texto){//Elimina espacios, acentos y mayúsculas del texto
  $cambioCaracteres = array(
    'A'=>'a', 'B'=>'b', 'C'=>'c', 'D'=>'d', 'E'=>'e', 'F'=>'f', 'G'=>'g', 'H'=>'h', 'I'=>'i',
    'J'=>'j', 'K'=>'k', 'L'=>'l', 'M'=>'m', 'N'=>'n', 'Ñ'=>'ñ', 'O'=>'o', 'P'=>'p', 'Q'=>'q',
    'R'=>'r', 'S'=>'s', 'T'=>'t', 'U'=>'u', 'V'=>'v', 'W'=>'w', 'X'=>'x', 'Y'=>'y', 'Z'=>'z',
    ' '=>'',
    'Á'=>'a', 'É'=>'e', 'Í'=>'i', 'Ó'=>'o', 'Ú'=>'u',
    'á'=>'a', 'é'=>'e', 'í'=>'i', 'ó'=>'o', 'ú'=>'u',
  );
  return strtr($texto, $cambioCaracteres);
}
?>
