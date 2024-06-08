<?php
session_start();
include "conexion.php";

// Verificar si se recibe el id del usuario
if (empty($_REQUEST['id'])) {
    header('Location: lista_usuarios.php');
    exit;
}

$idusuario = $_REQUEST['id'];

// Consultar los datos del usuario
$query = mysqli_query($conection, "SELECT u.nombre, u.usuario, r.rol FROM usuario u INNER JOIN rol r ON u.rol = r.idrol WHERE u.idusuario = $idusuario");
$result = mysqli_num_rows($query);

if ($result == 0) {
    header('Location: lista_usuarios.php');
    exit;
} else {
    $data = mysqli_fetch_array($query);
    $nombre = $data['nombre'];
    $usuario = $data['usuario'];
    $rol = $data['rol'];
}

if (!empty($_POST)) {
    if ($_POST['idusuario'] == 1) {
        header('Location: lista_usuarios.php');
        exit;
    }

    $idusuario = $_POST['idusuario'];

    $query_delete = mysqli_query($conection, "DELETE FROM usuario WHERE idusuario = $idusuario");

    if ($query_delete) {
        header('Location: lista_usuarios.php');
        exit;
    } else {
        echo "<p class='msg_error'>Error al eliminar el usuario.</p>";
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
    <title>Eliminar Usuario</title>
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
                        <div class="form_register">
                            <h1>Eliminar Usuario</h1>
                            <hr>
                            <div class="alert"><?php echo isset($alert) ? $alert : ''; ?></div>
                            <form action="" method="POST">
                                <h2>¿Está seguro de eliminar el siguiente usuario?</h2>
                                <p>Nombre: <span><?php echo $nombre; ?></span></p>
                                <p>Usuario: <span><?php echo $usuario; ?></span></p>
                                <p>Rol: <span><?php echo $rol; ?></span></p>
                                <input type="hidden" name="idusuario" value="<?php echo $idusuario; ?>">
                                <input type="submit" value="Eliminar usuario" class="btn_save">
                                <a href="lista_usuarios.php" class="btn_cancel">Cancelar</a>
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
