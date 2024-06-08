 <?php
if(empty($_SESSION['active'])){
    header('location:../');
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport"
    content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">

    <!-- Title -->
    <title>Sistema | Prueba</title>

    <!-- Stylesheet -->
    <?php include "scripts.php"; ?>

</head>

<body>
    <!-- Preloader -->
    <div id="preloader">
        <div>
            <div class="spinner">
                <div class="double-bounce1"></div>
                <div class="double-bounce2"></div>
            </div>
            <span>Espere, Porfavor...</span>
        </div>
    </div>
    <!-- /Preloader -->


    <!-- Social Share Area Start -->
    <div class="razo-social-share-area">
    </div>
    <!-- Social Share Area End -->

    <!-- Header Area Start -->
    <header class="header-area">
        <!-- Main Header Start -->
        <div class="main-header-area">
            <div class="classy-nav-container breakpoint-off">
                <div class="container">
                    <!-- Classy Menu -->
                    <nav class="classy-navbar justify-content-between" id="razoNav">

                    <!-- Logo -->
                    <ul>
                        <li> <a class="nav-brand" href="index.php"><img class="centrado" src="./img/corriendo.png" width="80px" height="20px" style="margin-top: 9px;"></a></li>
                        </ul>

                        <!-- Navbar Toggler -->
                        <div class="classy-navbar-toggler">
                            <span class="navbarToggler"><span></span><span></span><span></span></span>
                        </div>

                        <!-- Menu -->
                        <div class="classy-menu">
                            <!-- Menu Close Button -->
                            <div class="classycloseIcon">
                                <div class="cross-wrap"><span class="top"></span><span class="bottom"></span></div>
                            </div>

                            <!-- Nav Start -->
                        
                            <div class="classynav">
                                <ul id="nav">
                                    
                                    <li><a href="index.php">Inicio</a></li>
                                    
                                    <li><a href="#">Administración</a>
                                        <ul class="dropdown">
                                            <li><a href="registro_usuario.php">- Nuevo usuario</a></li>
                                            <li><a href="lista_usuarios.php">- Lista de usuarios</a></li>
                                        </ul>
                                    </li>

                                    <li><a href="#">Clientes</a>
                                        <ul class="dropdown">
                                            <li><a href="registro_cliente.php">- Nuevo cliente</a></li>
                                            <li><a href="lista_clientes.php">- Lista de clientes</a></li>
                                        </ul>
                                    </li>

                                    <li><a href="#">Proveedores</a>
                                        <ul class="dropdown">
                                            <li><a href="registro_proveedor.php">- Nuevo Proveedor</a></li>
                                            <li><a href="lista_proveedor.php">- Lista de proveedores</a></li>
                                        </ul>
                                    </li>

                                    <li><a href="#">Productos</a>
                                        <ul class="dropdown">
                                            <li><a href="registro_producto.php">- Nuevo Producto</a></li>
                                            <li><a href="lista_producto.php">- Lista de productos</a></li>
                                        </ul>
                                    </li>

                                </ul>

                                

                                <!-- Share Icon -->
                                <div class="social-share-icon">
                                    <ul>
                            <li>Bienvenido : <?php echo $_SESSION['user'].' -'.$_SESSION['rol']; ?></li>
                                    
                    <li><a href="cerra_session.php" style="color: #D24B07;"><img src="img/error1.png"></a></li>

                            </ul>
                                
                                </div>

                                <!-- Search Icon -->
                                <div class="search-icon" data-toggle="modal" data-target="#searchModal">

                                </div>
                            </div>
                            <!-- Nav End -->
                        </div>
                    </nav>
                </div>
            </div>
        </div>
    </header>


    <!-- jQuery -->
    <script src="js/jquery.min.js"></script>
    <!-- Popper -->
    <script src="js/popper.min.js"></script>
    <!-- Bootstrap -->
    <script src="js/bootstrap.min.js"></script>
    <!-- All Plugins -->
    <script src="js/razo.bundle.js"></script>
    <!-- Active -->
    <script src="js/default-assets/active.js"></script>

</body>

</html>