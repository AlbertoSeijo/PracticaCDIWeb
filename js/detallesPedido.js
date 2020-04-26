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


function realizarPagos(idPedido){
  redirectPost('./canjepuntos.php', {'idPedido': idPedido, 'haEnviadoAPago': true});
}

function EnvSigEtEnc(idPedido){
  redirectPost('./detallesPedido.php', {'idPedido': idPedido, 'haEnviadoASiguienteEtapa': true});

}

function EnvSigEtEmp(idPedido){
  redirectPost('./consultapedidos.php', {'idPedido': idPedido, 'haEnviadoASiguienteEtapa': true});
}


function EnvEtAntEnc(idPedido){
  redirectPost('./detallesPedido.php', {'idPedido': idPedido, 'haEnviadoAEtapaAnterior': true});

}

function EnvEtAntEmp(idPedido){
  redirectPost('./consultapedidos.php', {'idPedido': idPedido, 'haEnviadoAEtapaAnterior': true});
}
