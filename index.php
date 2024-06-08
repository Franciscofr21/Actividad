<?php
$alert = '';
session_start();
if(!empty($_SESSION['active']))
{
    header('location:ingreso/');
}else{
    if(!empty($_POST))
    {
       if(empty($_POST['usuario']) || empty($_POST['clave']))
       {
           $alert ='Ingrese su usuario y contraseña';
       }else{
        require_once "ingreso/conexion.php";

        $user = mysqli_real_escape_string($conection,$_POST['usuario']);
        $pass = md5(mysqli_real_escape_string($conection,$_POST['clave']));

        $query = mysqli_query($conection,"SELECT * FROM usuario WHERE usuario = '$user' AND clave = '$pass'");
        mysqli_close($conection);

        $result = mysqli_num_rows($query);
        if($result > 0){
            $data = mysqli_fetch_array($query);
            $_SESSION['active'] = true;
            $_SESSION['idUser'] = $data['idusuario'];
            $_SESSION['nombre'] = $data['nombre'];
            $_SESSION['email'] = $data['email'];
            $_SESSION['user'] = $data['usuario'];
            $_SESSION['rol'] = $data['rol'];
            header('location: ingreso/');
        }else{
            $alert = 'El usuario o la clave son incorrectos';
            session_destroy();
            
        }
       }
    }
}      
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0" maximun-scale=1.0,
    minimun-scale=1.0>
    <link rel="stylesheet" href="./css1/main.css">
    <link rel="shortcut icon" href="ingreso/img/agua.png">
    <title>Demostracion</title>
</head>
<body>
    <section id="container">
        <form action="" method="POST" class="fuñ-box logInForm">
            <div class="form-group text-center">
                <img src="ingreso/img/iniciar-sesion.png" alt="UserIcion" style="width: 180px; height:180px;">
            </div>
            <p class="text-center text-muted text-uppercase">Iniciar sesion</p>
            <div class="form-group label-floating">
                <lebel>Usuario</lebel>
                <input style="color: white;" class="form-control" type="text" name="usuario">
            </div>
            <div class="form-group label-floating">
                <lebel>Contraseña</lebel>
                <input style="color: white;" class="form-control" type="password" name="clave">
            </div>
            <div class="form-group text-center">
                <div class="form-group label-floating" class="alert"><?php echo isset($alert)? $alert:'';?></div>
                <input class="btn btn-raised btn-danger" style="background:#1d4141;" type="submit" value="INGRESAR">
            </div>
        </form>
    </section>
    <script src="./js1/jquery-3.1.1.min.js"></script>
    <script src="./js1/bootstrap.min.js"></script>
    <script src="./js1/material.min.js"></script>
    <script src="./js1/ripples.min.js"></script>
    <script src="./js1/sweetalert2.min.js"></script>
    <script src="./js1/jquery.mCustomScrollbar.concat.min.js"></script>
    <script src="./js1/main.js"></script>    
</body>
</html>