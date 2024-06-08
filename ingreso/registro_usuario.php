<?php

use LDAP\Result;

use function PHPSTORM_META\type;

session_start();
include "conexion.php";
if(!empty($_POST))
{
    $alert='';
    if(empty($_POST['nombre']) || empty($_POST['correo']) || empty($_POST['usuario']) || empty($_POST['clave']) || empty($_POST['rol']))
    {
       $alert = '<p class="msg_error">Todos los campos obligatorios</p>'; 
    }else{
        $nombre = $_POST['nombre'];
        $email = $_POST['correo'];
        $user = $_POST['usuario'];
        $clave = md5($_POST['clave']);
        $rol = $_POST['rol'];
        $query = mysqli_query($conection,"SELECT * FROM usuario WHERE usuario = '$user' OR correo = '$email'");
        $result = mysqli_fetch_array($query);
        if($result > 0 ){
            $alert ='<p class="msg_error"> El correo o el usuario ya existe</p>';
        }else{
           $query_insert =  mysqli_query($conection,"INSERT INTO usuario(nombre,correo,usuario,clave,rol)
           values('$nombre','$email','$clave','$r0l')");
           if($query_insert){
             $alert= '<p class="msg_save">Usuario crado correctamente</p>';
           }else{
              $alert = '<P class="msg_error">Error al crear el usuario</P>';
           } 
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
    <title>Document</title>
</head>
<body>
    <?php include("nav.php");?>
    <?php include("include.php");?>

    <div class="content-wrapper">
        <center>
          <div class="container-portada">
              <div class="capa=gradient"></div>
              <div class="containber-details">
                  <div class="details">
                     <br><br>
                     <div class="form_register">
                        <h1>Registro Usuario</h1>
                        <hr>
                        <div class="alert"><?php echo isset($alert) ? $alert : ''; ?></div>
                        <form action="" method="POST">
                            <label for="nombre">Nombre:</label>
                            <input type="text" name="nombre" id="nombre" placeholder="Nombre completo">
                            <label for="correo">Correo:</label>
                            <input type="email" name="correo" id="correo" placeholder="Correo electronico">
                            <label for="usuario">Usuario:</label>
                            <input type="text" name="usuario" id="usuario" placeholder="Usuario">
                            <label for="clave">Clave:</label>
                            <input type="password" name="clave" id="clave" placeholder="Clave de acceso">
                            <label for="rol">Tipo de usuario:</label>
                            <?php
                            $query_rol = mysqli_query ($conection, "SELECT * FROM rol");
                            $result_rol = mysqli_num_rows($query_rol);
                            ?>
                            <select name="rol" id="rol">
                                <?php
                                if($result_rol > 0){
                                    while ($rol = mysqli_fetch_array($query_rol)){
                                        ?>
                                      <option value="<?php echo $rol["idrol"];?>"><?php echo $rol["rol"]?></option>
                                      <?php

                                    }
                                }
                                ?>
                            </select> 
                            <input type="submit" value="Crear usuario" class="btn_SAVE">                           
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
