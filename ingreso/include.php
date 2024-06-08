<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <link rel="stylesheet" href="jquery-ui-1.12.1.custom/jquery-ui.min.css">
<script src="js/jquery-1.12.4.js" charset="utf-8"></script>
<title>Prueba Sistema</title>

<link href="css/bootstrap.css" rel="stylesheet"> 

<link href="css/font-awesome.min.css" rel="stylesheet"> 
<style>
.ui-widget{
    font-size: 15px;
    font-style: italic;
}
</style>
<script>

$(function (){
    $.datepicker.regional['es'] = {
closeText: 'Cerrar',
prevText: '<Ant',
nextText: 'Sig>',
currentText: 'Hoy',
monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
monthNamesShort: ['Ene','Feb','Mar','Abr', 'May','Jun','Jul','Ago','Sep', 'Oct','Nov','Dic'],
dayNames: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'],
dayNamesShort: ['Dom','Lun','Mar','Mié','Juv','Vie','Sáb'],
dayNamesMin: ['Do','Lu','Ma','Mi','Ju','Vi','Sá'],
weekHeader: 'Sm',
dateFormat: 'dd/mm/yy',
firstDay: 1,
isRTL: false,
showMonthAfterYear: false,
yearSuffix: ''
};

$.datepicker.setDefaults($.datepicker.regional['es']);
//$.datepicker.setDefaults($.datepicker.regional["es"]);

});

</script>

    </head>
    <body>
    <!-- JAVASCRIPT FILES PLACED AT THE BOTTOM TO REDUCE THE LOADING TIME  -->
    <!-- CORE JQUERY  -->
    <script src="js/jquery-1.11.1.js"></script>
    <!-- BOOTSTRAP SCRIPTS  -->
    <script src="js/bootstrap.js"></script>
    <!-- CUSTOM SCRIPTS  -->
    <script src="js/custom.js"></script>
    <script src="jquery-ui-1.12.1.custom/jquery-ui.min.js" charset="utf-8"></script>
</body>
</html>