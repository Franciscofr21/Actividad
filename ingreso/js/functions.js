$(document).ready(function () {

    //--------------------- SELECCIONAR FOTO PRODUCTO ---------------------
    $("#foto").on("change", function () {
        var uploadFoto = document.getElementById("foto").value;
        var foto = document.getElementById("foto").files;
        var nav = window.URL || window.webkitURL;
        var contactAlert = document.getElementById('form_alert');

        if (uploadFoto != '') {
            var type = foto[0].type;
            var name = foto[0].name;
            if (type != 'image/jpeg' && type != 'image/jpg' && type != 'image/png') {
                contactAlert.innerHTML = '<p class="errorArchivo">El archivo no es válido.</p>';
                $("#img").remove();
                $(".delPhoto").addClass('notBlock');
                $('#foto').val('');
                return false;
            } else {
                contactAlert.innerHTML = '';
                $("#img").remove();
                $(".delPhoto").removeClass('notBlock');
                var objeto_url = nav.createObjectURL(this.files[0]);
                $(".prevPhoto").append("<img id='img' src=" + objeto_url + ">");
                $(".upimg label").remove();

            }
        } else {
            alert("No selecciono foto");
            $("#img").remove();
        }
    });

    $('.delPhoto').click(function () {
        $('#foto').val('');
        $(".delPhoto").addClass('notBlock');
        $("#img").remove();


        if ($("#fot_actual") && $("#foto_remove")) {
            $("#foto_remove").val('img_producto.png');
        }

    });




    // Modal form

    $('.add_product').click(function (e) {

        e.preventDefault();
        var producto = $(this).attr('product');
        var action = 'infoProducto';

        $.ajax({
            url: 'ajax.php',
            type: 'POST',
            async: true,
            data: { action: action, producto: producto },


            success: function (response) {

                if (response != 'error') {
                    var info = JSON.parse(response);
                    //$('#producto_id').val(info.codproducto);
                    //$('.nameProducto').html(info.descripcion);
                    $('.bodyModal').html('<form action="" method="post" name="form_add_product" id="form_add_product" onsubmit="event.preventDefault(); sendDataProduct();">' +
                        '<h2>Agregar Producto</h2>' +
                        '<h2 class="nameProducto">' + info.descripcion + '</h2><br>' +
                        '<input type="number" name="cantidad" id="txtCantidad" class="form-control" placeholder="Cantidad del producto" required><br>' +
                        '<input type="text" name="precio" id="txtPrecio" class="form-control"  placeholder="Precio del producto" required>' +
                        '<input type="hidden" name="producto_id" id="producto_id"  value="' + info.codproducto + '"required> <br>' +
                        '<input type="hidden" name="action" value="addProduct"  required>' +
                        '<div class="mensaje alertAddProduct"></div>' +
                        '<button type="submit" class="btn btn-info"><i class="fa fa-plus"></i>Agregar</button>&nbsp;&nbsp;&nbsp;&nbsp;' +
                        '<a href="#" class=" btn btn-danger closeModal" onclick="closeModal();">Cerrar</a>' +
                        '</form>');
                }
            },

            error: function (error) {
                console.log(error);
            }

        });

        $('.modal').fadeIn();
    });


    // modal de eliminacion de productos

    $('.del_product').click(function (e) {

        e.preventDefault();
        var producto = $(this).attr('product');
        var action = 'infoProducto';


        $.ajax({
            url: 'ajax.php',
            type: 'POST',
            async: true,
            data: { action: action, producto: producto },


            success: function (response) {

                if (response != 'error') {
                    var info = JSON.parse(response);
                    //$('#producto_id').val(info.codproducto);
                    //$('.nameProducto').html(info.descripcion);
                    $('.bodyModal').html('<form action="" method="post" name="form_del_product" id="form_del_product" onsubmit="event.preventDefault(); delProduct();">' +
                        '<h2>Eliminar Producto</h2><br>' +
                        '<p>¿Esta seguro de eliminar el siguiente registro?</p><br>' +
                        '<h2 class="nameProducto">' + info.descripcion + '</h2><br>' +
                        '<input type="hidden" name="producto_id" id="producto_id"  value="' + info.codproducto + '"required> <br>' +
                        '<input type="hidden" name="action" value="delProduct"  required>' +
                        '<div class="mensaje alertAddProduct"></div>' +
                        '<a href="#" class="btn btn-default" onclick="closeModal();">Cerrar</a>&nbsp;&nbsp;&nbsp;&nbsp;' +
                        '<button type="submit" class="btn btn-danger"><i class="fa fa-trash"></i> Eliminar</button>' +
                        '</form>');
                }
            },

            error: function (error) {
                console.log(error);
            }

        });

        $('.modal').fadeIn();
    });

    /// buscar producto
    $('#txt_cod_producto').keyup(function (e) {
        e.preventDefault();

        var producto = $(this).val();
        var action = 'infoProducto';

        if (producto != '') {
            $.ajax({
                url: 'ajax.php',
                type: "POST",
                async: true,
                data: { action: action, producto: producto },

                success: function (response) {
                    if (response != 'error') {
                        var info = JSON.parse(response);
                        $('#txt_descripcion').html(info.descripcion);
                        $('#txt_existencia').html(info.existencia);
                        $('#txt_cant_producto').val('1');


                        //activar cantidad
                        $('#txt_cant_producto').removeAttr('disabled');

                        //mostrar boton agregar
                        $('#add_product_venta').slideDown();
                    } else {
                        $('#txt_descripcion').html('-');
                        $('#txt_existencia').html('-');
                        $('#txt_cant_producto').val('0');

                        //bloquear cantidad
                        $('#txt_cant_producto').attr('disabled', 'disabled');

                        //ocultar producto

                        $('#add_product_venta').slideUp();

                    }
                },
                error: function (error) {
                }
            });
        }
    });

    //validar cantidad

    $('#txt_cant_producto').keyup(function (e) {
        e.preventDefault();
        var existencia = parseInt($('#txt_existencia').html());
        if (($(this).val() < 1 || isNaN($(this).val())) || ($(this).val() > existencia)) {
            $('#add_product_venta').slideUp();
        } else {
            $('#add_product_venta').slideDown();
        }
    });

    //Agregar productos detalle

    $('#add_product_venta').click(function (e) {
        e.preventDefault();

        if ($('#txt_cant_producto').val() > 0) {

            var codproducto = $('#txt_cod_producto').val();
            var cantidad = $('#txt_cant_producto').val();
            var action = 'addProductoDetalle';

            $.ajax({

                url: 'ajax.php',
                type: "POST",
                async: true,
                data: { action: action, producto: codproducto, cantidad: cantidad },

                success: function (response) {
                    if (response != 'error') {
                        var info = JSON.parse(response);
                        $('#detalle_venta').html(info.detalle);



                        $('#txt_cod_producto').val('');
                        $('#txt_descripcion').html('-');
                        $('#txt_existencia').html('-');
                        $('#txt_cant_producto').val('0');

                        //bloquear cantidad
                        $('#txt_cant_producto').attr('disabled', 'disabled');

                        //ocultar agregar
                        $('#add_product_venta').slideUp();






                    } else {
                        console.log('no data');
                    }
                    viewProcesar();

                },

                error: function (error) {

                }
            });

        }

    });


    //anular detalle venta
    $('#btn_anular_venta').click(function (e) {

        e.preventDefault();

        var rows = $('#detalle_venta tr').length;
        if (rows > 0) {
            var action = 'anularVenta';

            $.ajax({
                url: 'ajax.php',
                type: "POST",
                async: true,
                data: { action: action },

                success: function (response) {

                    if (response != 'error') {
                        location.reload();
                    }
                },
                error: function (error) {

                }
            });
        }
    });

    //facturar venta
    $('#btn_facturar_venta').click(function (e) {
        e.preventDefault();

        var rows = $('#detalle_venta tr').length;
        if (rows > 0) {
            var action = 'procesarVenta';

            $.ajax({
                url: 'ajax.php',
                type: "POST",
                async: true,
                data: { action: action },

                success: function (response) {

                    if (response != 'error') {

                        //var info = JSON.parse(response);
                        //console.log(info);

                        location.reload();
                    } else {
                        console.log('no data');
                    }
                },
                error: function (error) {

                }
            });
        }
    });

    // modal de anular ventas

    $('.anular_factura').click(function (e) {
        e.preventDefault();
        var nofactura = $(this).attr('fac');
        var action = 'infoFactura';


        $.ajax({
            url: 'ajax.php',
            type: 'POST',
            async: true,
            data: { action: action, nofactura: nofactura },


            success: function (response) {

                if (response != 'error') {
                    var info = JSON.parse(response);





                    $('.bodyModal').html('<form action="" method="post" name="form_anular_factura" id="form_anular_factura" onsubmit="event.preventDefault(); anularFactura();">' +
                        '<h2>Anular salida de Materiales</h2><br>' +
                        '<p>¿Realmente desea anular la salida de materiales?</p><br>' +

                        '<p><strong>No. ' + info.nofactura + '</strong></p>' +
                        '<p><strong>Fecha. ' + info.fecha + '</strong></p>' +
                        '<input type="hidden" name="action" value="anularFactura">' +
                        '<input type="hidden" name="no_factura"  id="no_factura" value="' + info.nofactura + '" required>' +

                        '<div class="alert alertAddProduct"></div>' +
                        '<button type="submit" class="btn btn-danger">Anular</button>&nbsp;&nbsp;&nbsp;&nbsp;' +
                        '<a href="#" class="btn btn-default" onclick="closeModal(); location.reload();">Cerrar</a>' +
                        '</form>');
                }

            },

            error: function (error) {
                console.log(error);
            }

        });

        $('.modal').fadeIn();
    });

    //activa campos para registrar cliente
    $('.btn_new_cliente').click(function (e) {
        e.preventDefault();
        $('#nom_cliente').removeAttr('disabled');
        $('#tel_cliente').removeAttr('disabled');
        $('#dir_cliente').removeAttr('disabled');

        $('#div_registro_cliente').slideDown();
    });

    //buscar cliente 
    $('#nit_cliente').keyup(function (e) {
        e.preventDefault();
        var cl = $(this).val();
        var action = 'searchCliente';
        $.ajax({
            url: 'ajax.php',
            type: "POST",
            async: true,
            data: { action: action, cliente: cl },
            success: function (response) {

                if (response == 0) {
                    $('#idcliente').val('');
                    $('#nom_cliente').val('');
                    $('#tel_cliente').val('');
                    $('#dir_cliente').val('');
                    //mostrar boton agregar
                    $('.btn_new_cliente').slideDown();
                } else {
                    var data = $.parseJSON(response);
                    $('#idcliente').val(data.idcliente);
                    $('#nom_cliente').val(data.nombre);
                    $('#tel_cliente').val(data.telefono);
                    $('#dir_cliente').val(data.direccion);
                    //ocultar boton agregar
                    $('.btn_new_cliente').slideUp();

                    //bloquee campos
                    $('#nom_cliente').attr('disabled', 'disabled');
                    $('#tel_cliente').attr('disabled', 'disabled');
                    $('#dir_cliente').attr('disabled', 'disabled');

                    //ocultar boton guardar
                    $('#div_registro_cliente').slideUp();

                }

            },
            error: function (error) {

            }
        });
    });
    //Crear cliente ventas
    $('#form_new_cliente_venta').submit(function (e) {
        e.preventDefault();
        $.ajax({
            url: 'ajax.php',
            type: "POST",
            async: true,
            data: $('#form_new_cliente_venta').serialize(),
            success: function (response) {

                if (response != 'error') {
                    //agregar id a input hidden
                    $('#idcliente').val(response);
                    //bloquea campos
                    $('#nom_cliente').attr('disabled', 'disabled');
                    $('#tel_cliente').attr('disabled', 'disabled');
                    $('#dir_cliente').attr('disabled', 'disabled');


                    // oculta boton agregar
                    $('.btn_new_cliente').slideUp();
                    //coultar boton guardar
                    $('#div_registro_cliente').slideUp();
                }

            },
            error: function (error) {

            }
        });
    });



}); //end ready




//anular factura
function anularFactura() {
    var noFactura = $('#no_factura').val();
    var action = 'anularFactura';

    $.ajax({
        url: 'ajax.php',
        type: "POST",
        async: true,
        data: { action: action, noFactura: noFactura },

        success: function (response) {

            if (response == 'error') {
                $('.alertAddProduct').html('<p style="color:red;">Error al anular la salida.</p>');
            } else {
                $('#row_' + noFactura + ' .estado').html('<span class="anulada">Anulada</span>');
                $('#form_anular_factura .btn_ok').remove();
                $('#row_' + noFactura + ' .div_factura').html('<button type="button" class=" btn_anular inactive"></button>');
                $('.alertAddProduct').html('<p>Salida de Materiales Anulada.</p>');



            }

        },
        error: function (error) {

        }
    });
}


function del_product_detalle(correlativo) {
    var action = 'delProductoDetalle';
    var id_detalle = correlativo;

    $.ajax({

        url: 'ajax.php',
        type: "POST",
        async: true,
        data: { action: action, id_detalle: id_detalle },

        success: function (response) {
            if (response != 'error') {
                var info = JSON.parse(response);
                $('#detalle_venta').html(info.detalle);



                $('#txt_cod_producto').val('');
                $('#txt_descripcion').html('-');
                $('#txt_existencia').html('-');
                $('#txt_cant_producto').val('0');

                //bloquear cantidad
                $('#txt_cant_producto').attr('disabled', 'disabled');

                //ocultar agregar
                $('#add_product_venta').slideUp();





            } else {
                $('#detalle_venta').html('');
            }
            viewProcesar();
        },

        error: function (error) {

        }
    });
}

//mostrar_ocultar boton procesar
function viewProcesar() {
    if ($('#detalle_venta tr').length > 0) {

        $('#btn_facturar_venta').show();
    } else {
        $('#btn_facturar_venta').hide();
    }
}





function serchForDetalle(id) {
    var action = 'serchForDetalle';
    var user = id;

    $.ajax({
        url: 'ajax.php',
        type: "POST",
        async: true,
        data: { action: action, user: user },

        success: function (response) {
            if (response != 'error') {
                var info = JSON.parse(response);
                $('#detalle_venta').html(info.detalle);

            } else {
                console.log('no data');
            }
            viewProcesar();
        },

        error: function (error) {

        }
    });
}

function sendDataProduct() {

    $('.alertAddProduct').html('');

    $.ajax({
        url: 'ajax.php',
        type: 'POST',
        async: true,
        data: $('#form_add_product').serialize(),


        success: function (response) {
            if (response == 'error') {

                $('.alertAddProduct').html('<p style="color:red;">Error al agregar el producto.</p>');
            } else {

                var info = JSON.parse(response);
                $('.row' + info.producto_id + ' .celPrecio').html(info.nuevo_precio);
                $('.row' + info.producto_id + ' .celExistencia').html(info.nueva_existencia);
                $('#txtCantidad').val('');
                $('#txtPrecio').val('');
                $('.alertAddProduct').html('<p>Producto guardado correctamente.</p>');
            }

        },

        error: function (error) {
            console.log(error);
        }

    });



}


// eliminar 

function delProduct() {

    var pr = $('#producto_id').val();
    $('.alertAddProduct').html('');

    $.ajax({
        url: 'ajax.php',
        type: 'POST',
        async: true,
        data: $('#form_del_product').serialize(),


        success: function (response) {

            console.log(response);

            if (response == 'error') {

                $('.alertAddProduct').html('<p style="color:red;">Error al eliminar el producto.</p>');
            } else {

                $('.row' + pr).remove();
                $('#form_del_product .btn_ok').remove();
                $('.alertAddProduct').html('<p>Producto eliminado correctamente.</p>');
            }


        },

        error: function (error) {
            console.log(error);
        }

    });



}




function closeModal() {

    $('.alertAddProduct').html('');
    $('#txtCantidad').val('');
    $('#txtPrecio').val('');
    $('.modal').fadeOut();
}

function ocultar() {

    document.getElementById('mostrarOcultar').style.display = "none";
}