$(document).ready(function () {

    $('body').on('click', '.addToCart', function (e) {
        e.preventDefault();

        var url = $(this).data('url');

        $.ajax({
            type: "get",
            url: url,
            success: function (response) {

                // if same product is added
                if (response.quantity) {

                    $('tr#' + response.product_id).find('.quantity').val(response.quantity);

                } else {


                    // remove "there is not products" paragraph
                    $('#cart-products-table').find('.no-product').remove();

                    // add the coming row to the cart
                    $('#cart-products-table').append(response);
                }
                
                // show notification added successfully
                $('.message').html('added successfully');
                
                calculating_total();
            }
        });
    });


    // on change product quantity
    $('body').on('keyup change', '.quantity', function () {

        var quantity = Number($(this).val());
        var this_quantity_input = $(this);

        // var productPrice = parseFloat($(this).data('price'));
        // var totalPrice = $.number(productPrice * quantity, 2);
        // $(this).closest('tr').find('.subtotal').html(totalPrice);

        var url = $(this).data('url');

        $.ajax({
            url: url,
            data: {
                quantity: quantity,
            },
            success: function (response) {

               // calculating subtatal
                var subtotal = 0;

                var price = this_quantity_input.closest('tr').find('.product-price').html().replace('$', '')
            
                subtotal = price * quantity;
               
                this_quantity_input.closest('tr').find('.subtotal').html('$'+ subtotal );

             
                calculating_total()
            }
        });


       

    })//end of product-quentity


});


function calculating_total() {
    var total_price = 0;
    var total_items = 0;

    $('#cart-products-table tr .product-price').each(function (index) {

        total_price += parseFloat($(this).html().replace('$', '')) * Number($(this).closest('tr').find('.quantity').val());
        total_items += Number($(this).closest('tr').find('.quantity').val());
    });

    $('.total-price').html(total_price);
    $('.total_items').html(total_items + ' items');
}