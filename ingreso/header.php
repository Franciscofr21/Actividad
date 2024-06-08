<?php
include "conexion.php";

if(empty($_SESSION[ 'active' ])){
    header('location: ../');
}
?>

<link rel="shortcut icon" href="./img/agua.png">
<link rel="stylesheet" type="text/css" href="style.css">
<meta name="viewport" content="width=divice-width, user-scalable=no, initial-scale=1.0" maximun-scale=1.0,
    minimun-scale=1.0>
<link rel="stylesheet" href="jquery-ui-1.12.1.custom/jquery-ui.min.css">

<div class="modal">
    <div class="bodyModal">

    </div>
</div>