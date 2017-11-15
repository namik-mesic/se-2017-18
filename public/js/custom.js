$(document).ready(function () {

    var quantitiy = 0;
    $('.quantity-right-plus').click(function (e) {

        e.preventDefault();
        var quantityElement = $(this).parent().parent().find('input[name="quantity[]"]');

        var quantity = parseInt(quantityElement.val());
        quantityElement.val(quantity + 1);


    });

    $('.quantity-left-minus').click(function (e) {
        //if(quantitiy = 0) brake;
        e.preventDefault();
        var quantityElement = $(this).parent().parent().find('input[name="quantity[]"]');

        var quantity = parseInt(quantityElement.val());

        if (quantity > 1)
            quantityElement.val(quantity - 1);
    });

});