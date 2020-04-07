<?php
include './header.php';?>



<?php
    define('SERVIDOR_BD', 'localhost:3306');
    define('USUARIO_BD', 'webtintoreria');
    define('CONTRASENA_BD', 'lavanderia');
    define('NOMBRE_BD', 'tintoreria');
    $db = mysqli_connect(SERVIDOR_BD,USUARIO_BD,CONTRASENA_BD,NOMBRE_BD);
    session_start();

    $sql = "SELECT * FROM tipopedido";
    $result = mysqli_query($db,$sql);
    while($row = $result->fetch_assoc()) {
            echo "idTipoPedido: " . $row["idTipoPedido"]. " - nombreTipoPedido: " . $row["nombreTipoPedido"]. " Precio:" . $row["precio"]. "<br>";
        }
?>




<?php
include './footer.php';
?>
