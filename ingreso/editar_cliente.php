<?php
session_start();
include "conexion.php";

if (empty($_GET['id'])) {
    header('Location: lista_clientes.php');
}

$idcliente = $_GET['id'];
$sql = mysqli_query($conection, "SELECT * FROM cliente WHERE idcliente = $idcliente AND estatus = 1");
$result_sql = mysqli_num_rows($sql);

if ($result_sql == 0) {
    header('Location: lista_clientes.php');
} else {
    $data = mysqli_fetch_array($sql);
    $nit = $data['nit'];
    $nombre = $data['nombre'];
    $telefono = $data['telefono'];
    $direccion = $data['direccion'];
}

if (!empty($_POST)) {
    $alert = '';
    if (empty($_POST['nit']) || empty($_POST['nombre']) || empty($_POST['telefono']) || empty($_POST['direccion'])) {
        $alert = '<p class="msg_error">Todos los campos son obligatorios.</p>';
    } else {
        $nit = $_POST['nit'];
        $nombre = $_POST['nombre'];
        $telefono = $_POST['telefono'];
        $direccion = $_POST['direccion'];

        $query_update = mysqli_query($conection, "UPDATE cliente SET nit = '$nit', nombre = '$nombre', telefono = '$telefono', direccion = '$direccion' WHERE idcliente = $idcliente");

        if ($query_update) {
            $alert = '<p class="msg_save">Cliente actualizado correctamente.</p>';
        } else {
            $alert = '<p class="msg_error">Error al actualizar el cliente.</p>';
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
    <title>Editar Cliente</title>
</head>
<body>
    <?php include("nav.php");?>
    <?php include("include.php");?>

    <div class="content-wrapper">
        <center>
          <div class="container-portada">
              <div class="capa-gradient"></div>
              <div class="container-details">
                  <div class="details">
                     <br><br>
                     <div class="form_register">
                        <h1>Editar Cliente</h1>
                        <hr>
                        <div class="alert"><?php echo isset($alert) ? $alert : ''; ?></div>
                        <form action="" method="POST">
                            <label for="nit">NIT:</label>
                            <input type="text" name="nit" id="nit" placeholder="Número de NIT" value="<?php echo $nit; ?>">
                            <label for="nombre">Nombre:</label>
                            <input type="text" name="nombre" id="nombre" placeholder="Nombre completo" value="<?php echo $nombre; ?>">
                            <label for="telefono">Teléfono:</label>
                            <input type="text" name="telefono" id="telefono" placeholder="Número de teléfono" value="<?php echo $telefono; ?>">
                            <label for="direccion">Dirección:</label>
                            <input type="text" name="direccion" id="direccion" placeholder="Dirección completa" value="<?php echo $direccion; ?>">
                            <input type="submit" value="Actualizar cliente" class="btn_save">
                        </form>
                     </div>
                  </div>
              </div>
          </div>
        </center>
        <div class="container"></div>
        <div class="row pad-botm"></div>
    </div>
</body>
</html>
