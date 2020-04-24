function redirectPost(url, data) {
    var form = document.createElement('form');
    document.body.appendChild(form);
    form.method = 'post';
    form.action = url;
    for (var name in data) {
        var input = document.createElement('input');
        input.type = 'hidden';
        input.name = name;
        input.value = data[name];
        form.appendChild(input);
    }
    form.submit();
}


function realizarPagos(){
  window.location.href = "./canjepuntos.php";
}

function EnvSigEtEnc(idPedido){
  redirectPost('./detallesPedido.php', {'idPedido': idPedido, 'haEnviadoASiguienteEtapa': true});

}

function EnvSigEtEmp(){
  window.location.href = "./consultapedidos.php";
}
