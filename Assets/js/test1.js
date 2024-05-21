var table;

function init() {
    listar();

    $("#formulario").on("submit", function (e) {
        guardaryeditar(e);
    });

}

function cancelarform() {
    limpiar();
    limpiarTablaProductos();
}

function limpiarTablaProductos() {
    $('#tblarticulos tbody').html('');
}

function limpiar() {
    $("#clienteSelect").val("");
    $("#comprobanteSelect").val("Boleta");
    $("#pagoInput").val("");
    $("#cambioInput").val("");
    $("#subtotalDisplay").html("0");
    $("#totalDisplay").html("Q 0");
}


$(document).ready(function () {
    $.ajax({
        url: base_url + "/Clientes/getClientes",
        type: "GET",
        dataType: "json",
        success: function (data) {
            $('#idcliente').empty();
            $.each(data, function (index, cliente) {
                var optionsHtml = cliente.options ? cliente.options.replace(/\\/g, '') : '';
                
                $('#idcliente').append('<option value="' + cliente.idpersona + '">' + cliente.nombres + ' ' + cliente.apellidos + '</option>');
            });
            $('#idcliente').selectpicker('refresh');
        },
        error: function (jqXHR, textStatus, errorThrown) {
            console.error("Error al cargar clientes: " + textStatus, errorThrown);
        }
    });

    $('#idcliente').on('change', function() {
        var clienteSeleccionado = $(this).val();
        console.log("ID del cliente seleccionado:", clienteSeleccionado);
    });
});





tableProductos = $('#tableProductos').dataTable({
    "aProcessing": true,
    "aServerSide": true,
    "language": {
        "url": "//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json"
    },
    "ajax": {
        "url": " " + base_url + "/Ventas/getProductosVenta",
        "dataSrc": ""
    },
    "columns": [
        { "data": "idproducto" },
        { "data": "codigo" },
        { "data": "nombre" },
        { "data": "categoria" },
        { "data": "stock" },
        { "data": "precio" },
        { "data": "status" },
        { "data": "options" }
    ],
    "columnDefs": [
        { 'className': "textcenter", "targets": [3] },
        { 'className': "textright", "targets": [4] },
        { 'className': "textcenter", "targets": [5] }
    ],
    'dom': 'lBfrtip',
    'buttons': [
    ],
    "resonsieve": "true",
    "bDestroy": true,
    "iDisplayLength": 10,
    "order": [[0, "desc"]]
});


var selectedProducts = [];

function fntSelectProduct(idProducto) {

    var existingProduct = selectedProducts.find(function (product) {
        return product.idproducto === idProducto;
    });

    if (existingProduct) {

        existingProduct.cantidad += 1;

        updateTable();
    } else {

        $.ajax({
            url: base_url + "/Ventas/getProductoPorId/" + idProducto,
            type: "GET",
            dataType: "json",
            success: function (data) {
                if (data) {
                    data.cantidad = 1;
                    selectedProducts.push(data);
                    updateTable();
                }
            },
            error: function (xhr, status, error) {
                console.error(xhr.responseText);
            }
        });
    }
}


function fntRemoveProduct(idProducto) {

    var idProductoStr = idProducto.toString();

    var index = selectedProducts.findIndex(function (product) {

        return product.idproducto === idProductoStr;
    });

    if (index !== -1) {
        selectedProducts.splice(index, 1);
        updateTable();
    }
}


var cantidades = {};

function updateTable() {
    $('#tblarticulos tbody').html('');
    var addedProductIds = new Set();
    var productosAgrupados = {};
    var subtotal = 0;

    selectedProducts.forEach(function (product) {
        if (!addedProductIds.has(product.idproducto)) {
            addedProductIds.add(product.idproducto);

            cantidades[product.idproducto] = 0;

            if (!(product.idproducto in productosAgrupados)) {
                productosAgrupados[product.idproducto] = product;
                productosAgrupados[product.idproducto].cantidad = 0;
            }

            productosAgrupados[product.idproducto].cantidad++;

            cantidades[product.idproducto]++;
        }
    });

    for (var productId in productosAgrupados) {
        var product = productosAgrupados[productId];
        var subtotalProducto = product.precio * product.cantidad; 
        subtotal += subtotalProducto;
    
        // Agregar campos ocultos para almacenar los detalles del producto
        $('#tblarticulos tbody').append(
            '<tr>' +
            '<td>' + product.idproducto + '</td>' +
            '<td>' + product.codigo + '</td>' +
            '<td>' + product.nombre + '</td>' +
            '<td>Q ' + product.precio + '</td>' +
            '<td>' +
            '<input type="number" id="cantidad_' + product.idproducto + '" value="1" min="1" oninput="updateQuantity(' + product.idproducto + ', this.value)">' + 
            '</td>' +
            '<td id="subtotalId_' + product.idproducto + '">Q ' + subtotalProducto + '</td>' + 
            '<td>' + product.options + '</td>' +
            // Campos ocultos para almacenar detalles del producto
            '<input type="hidden" name="idProducto[]" value="' + product.idproducto + '">' +
            '<input type="hidden" name="cantidad[]" value="1">' +
            '<input type="hidden" name="subtotal[]" value="' + subtotalProducto + '">' +
            '</tr>'
        );
    }
    

    $('#subtotalId').text('Q ' + subtotal);
    var total = subtotal;
    $('#totalDisplay').text('Q ' + total);
}


function capturarValor(idProducto, valor) {
    console.log("Cantidad del producto " + idProducto + ": " + valor);
}




function updateQuantity(productId, quantity) {

    cantidades[productId] = 1;
    cantidades[productId] = parseInt(quantity);
    console.log("Cantidad actualizada para el producto " + productId + ": " + cantidades[productId]);

    updateSubtotal();
    updateTotals();
}

function updateSubtotal() {
    var subtotal = 0;

    for (var productId in selectedProducts) {
        var product = selectedProducts[productId];
        var cantidad = cantidades[product.idproducto];
        subtotal += product.precio * cantidad;
        $('#subtotalId_' + product.idproducto).text('Q ' + (product.precio * cantidad)); 
    }

    $('#subtotalId').text('Q ' + subtotal);
}

function updateTotals() {
    var subtotal = 0;

    for (var productId in selectedProducts) {
        var product = selectedProducts[productId];
        var cantidad = cantidades[product.idproducto];
        subtotal += product.precio * cantidad;
    }

    var total = subtotal;
    $('#totalDisplay').text('Q ' + total);
}








function openModal() {
    $('#modalVenta').modal('show');

}
