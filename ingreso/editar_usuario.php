<?php
session_start();
include "conexion.php";

// Verificar si se recibe el id del usuario
if (empty($_GET['id'])) {
    header('Location: lista_usuarios.php');
    exit;
}

$idusuario = $_GET['id'];

// Consultar los datos del usuario
$query = mysqli_query($conection, "SELECT u.idusuario, u.nombre, u.correo, u.usuario, r.idrol, r.rol FROM usuario u INNER JOIN rol r ON u.rol = r.idrol WHERE u.idusuario = $idusuario AND u.estatus = 1");
$result = mysqli_num_rows($query);

if ($result == 0) {
    header('Location: lista_usuarios.php');
    exit;
} else {
    $data = mysqli_fetch_array($query);
    $idusuario = $data['idusuario'];
    $nombre = $data['nombre'];
    $correo = $data['correo'];
    $usuario = $data['usuario'];
    $idrol = $data['idrol'];
    $rol = $data['rol'];
}

if (!empty($_POST)) {
    $alert = '';
    if (empty($_POST['nombre']) || empty($_POST['correo']) || empty($_POST['usuario']) || empty($_POST['rol'])) {
        $alert = '<p class="msg_error">Todos los campos son obligatorios.</p>';
    } else {
        $nombre = $_POST['nombre'];
        $correo = $_POST['correo'];
        $usuario = $_POST['usuario'];
        $rol = $_POST['rol'];

        $query_update = mysqli_query($conection, "UPDATE usuario SET nombre = '$nombre', correo = '$correo', usuario = '$usuario', rol = '$rol' WHERE idusuario = $idusuario");

        if ($query_update) {
            $alert = '<p class="msg_save">Usuario actualizado correctamente.</p>';
        } else {
            $alert = '<p class="msg_error">Error al actualizar el usuario.</p>';
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
    <title>Editar Usuario</title>
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
                            <h1>Editar Usuario</h1>
                            <hr>
                            <div class="alert"><?php echo isset($alert) ? $alert : ''; ?></div>
                            <form action="" method="POST">
                                <label for="nombre">Nombre:</label>
                                <input type="text" name="nombre" id="nombre" placeholder="Nombre completo" value="<?php echo $nombre; ?>">
                                <label for="correo">Correo:</label>
                                <input type="email" name="correo" id="correo" placeholder="Correo electrónico" value="<?php echo $correo; ?>">
                                <label for="usuario">Usuario:</label>
                                <input type="text" name="usuario" id="usuario" placeholder="Usuario" value="<?php echo $usuario; ?>">
                                <label for="rol">Tipo de usuario:</label>
                                <?php
                                $query_rol = mysqli_query($conection, "SELECT * FROM rol");
                                $result_rol = mysqli_num_rows($query_rol);
                                ?>
                                <select name="rol" id="rol">
                                    <?php
                                    if ($result_rol > 0) {
                                        while ($rol = mysqli_fetch_array($query_rol)) {
                                            $selected = ($idrol == $rol["idrol"]) ? "selected" : "";
                                            ?>
                                            <option value="<?php echo $rol["idrol"]; ?>" <?php echo $selected; ?>><?php echo $rol["rol"]; ?></option>
                                            <?php
                                        }
                                    }
                                    ?>
                                </select>
                                <input type="submit" value="Actualizar usuario" class="btn_save">
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
