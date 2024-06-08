<?php
session_start();
include "conexion.php";
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
    <title>Lista de Clientes</title>
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
                     <section class="container">
                        <h1>Lista de Clientes</h1>
                        <a href="registro_cliente.php" class="btn_new">Crear cliente</a>
                        <table>
                            <tr>
                                <th>ID</th>
                                <th>NIT</th>
                                <th>Nombre</th>
                                <th>Teléfono</th>
                                <th>Dirección</th>
                                <th>Fecha</th>
                                <th>Acciones</th>
                            </tr>
                            <?php
                            $query = mysqli_query($conection, "SELECT * FROM cliente WHERE estatus = 1");
                            $result = mysqli_num_rows($query);
                            if ($result > 0) {
                                while ($data = mysqli_fetch_array($query)) {
                                    ?>
                                    <tr>
                                        <td><?php echo $data['idcliente']; ?></td>
                                        <td><?php echo $data['nit']; ?></td>
                                        <td><?php echo $data['nombre']; ?></td>
                                        <td><?php echo $data['telefono']; ?></td>
                                        <td><?php echo $data['direccion']; ?></td>
                                        <td><?php echo $data['dateadd']; ?></td>
                                        <td>
                                            <a class="link_edit" href="editar_cliente.php?id=<?php echo $data['idcliente']; ?>">Editar</a>
                                            <?php if ($data['idcliente'] != 1) { ?>
                                                <a class="link_delete" href="eliminar_cliente.php?id=<?php echo $data['idcliente']; ?>">Eliminar</a>
                                            <?php } ?>
                                        </td>
                                    </tr>
                                    <?php
                                }
                            }
                            ?>
                        </table>
                     </section>
                  </div>
              </div>
          </div>
        </center>
        <div class="container"></div>
        <div class="row pad-botm"></div>
    </div>
</body>
</html>
