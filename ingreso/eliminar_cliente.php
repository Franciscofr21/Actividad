<?php
session_start();
include "conexion.php";

// Verificar si se recibe el id del cliente
if (empty($_GET['id'])) {
    header('Location: lista_clientes.php');
    exit;
}

$idcliente = $_GET['id'];

// Consultar los datos del cliente
$query = mysqli_query($conection, "SELECT idcliente, nombre FROM cliente WHERE idcliente = $idcliente AND estatus = 1");
$result = mysqli_num_rows($query);

if ($result == 0) {
    header('Location: lista_clientes.php');
    exit;
} else {
    $data = mysqli_fetch_array($query);
    $idcliente = $data['idcliente'];
    $nombre = $data['nombre'];
}

if (!empty($_POST)) {
    if ($_POST['idcliente'] == $idcliente) {
        $query_delete = mysqli_query($conection, "UPDATE cliente SET estatus = 0 WHERE idcliente = $idcliente");

        if ($query_delete) {
            header('Location: lista_clientes.php');
            exit;
        } else {
            echo "Error al eliminar el cliente";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link href="https://fonts.googleapis.com/css?family=Raleway:300,400" rel="stylesheet">
    <link rel="stylesheet" href="portada/icon/css/fontello.css">
    <link rel="stylesheet" href="portada/css/main.css">
    <meta name="description" content="">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="./img/agua.png">
    <title>Eliminar Cliente</title>
</head>
<body>
    <?php include("nav.php"); ?>
    <?php include("include.php"); ?>

    <div class="content-wrapper">
        <center>
            <div class="container-portada">
                <div class="capa-gradient"></div>
                <div class="container-details">
                    <div class="details">
                        <br><br>
                        <div class="form_delete">
                            <h1>Eliminar Cliente</h1>
                            <hr>
                            <p>¿Está seguro de eliminar el siguiente cliente?</p>
                            <p>Nombre: <span><?php echo $nombre; ?></span></p>

                            <form method="POST" action="">
                                <input type="hidden" name="idcliente" value="<?php echo $idcliente; ?>">
                                <a href="lista_clientes.php" class="btn_cancel">Cancelar</a>
                                <input type="submit" value="Eliminar" class="btn_ok">
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </center>
        <div class="container"></div>
        <div class="row pad'botm"></div>
    </div>
</body>
</html>
