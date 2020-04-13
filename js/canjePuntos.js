$('.input-tarjetaCliente').on('keydown change', function(event){
  var t = $(this);
  var t1 = $('#tarjetaInput1');
  var t2 = $('#tarjetaInput2');
  var t3 = $('#tarjetaInput3');

  var tNext = null;
  var tPrevious = null;

  function setCaretPosition(elemId, caretPos) {
      var elem = document.getElementById(elemId);

      if(elem != null) {
          if(elem.createTextRange) {
              var range = elem.createTextRange();
              range.move('character', caretPos);
              range.select();
          }
          else {
              if(elem.selectionStart) {
                  elem.focus();
                  elem.setSelectionRange(caretPos, caretPos);
              }
              else
                  elem.focus();
          }
      }
  }

  if(t.is(t1)){
    tNext = t2;
    tPrevious = null;
  } else if(t.is(t2)){
    tNext = t3;
    tPrevious = t1;
  } else if(t.is(t3)){
    tNext = null;
    tPrevious = t2;
  } else {
    console.log("No es ninguna");
  }

  var KEY_RETURN = 8;
  var ARROW_LEFT = 37;
  var ARROW_RIGHT = 39;
  if(event.which == KEY_RETURN){
    if (t.val().length == 0 || event.target.selectionStart == 0) {
      if(tPrevious != null){
        tPrevious.focus();
      }
    }
  } else if (event.which == ARROW_LEFT) {
    if(event.target.selectionStart == 0){
      if(tPrevious != null){
        tPrevious.focus();
        var tTemp = tPrevious[0];
        event.preventDefault();
        event.stopPropagation();
        tTemp.setSelectionRange(4, 4);
      }
    }
  } else if (event.which == ARROW_RIGHT) {
    if(event.target.selectionStart == 4 || event.target.selectionStart == t.val().length){
      if(tNext != null){
        tNext.focus();
        var tTemp = tNext[0];
        event.preventDefault();
        event.stopPropagation();
        tTemp.setSelectionRange(0, 0);
      }
    }
  } else {
    if (t.val().length > 3) {
      if(tNext != null){
        tNext.focus();
      }
    }
  }
  console.log(event.target.selectionStart);

});


/* INICIO - Sólo permitir números como entrada */
(function($) {
  $.fn.inputFilter = function(inputFilter) {
    return this.on("input keydown keyup mousedown mouseup select contextmenu drop", function() {
      if (inputFilter(this.value)) {
        this.oldValue = this.value;
        this.oldSelectionStart = this.selectionStart;
        this.oldSelectionEnd = this.selectionEnd;
      } else if (this.hasOwnProperty("oldValue")) {
        this.value = this.oldValue;
        this.setSelectionRange(this.oldSelectionStart, this.oldSelectionEnd);
      } else {
        this.value = "";
      }
    });
  };
}(jQuery));


$(".input-tarjetaCliente").inputFilter(function(value) {
  return /^\d*$/.test(value); });
/* FIN - Sólo permitir números como entrada */



/* A partir de aquí el código es de canjePuntos2 */
