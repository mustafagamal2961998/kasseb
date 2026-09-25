$( document ).ready(function() {
    $('.coupon-info').on('click', function() {
        var id = $(this).data('id');
        $('.coupon-info-container[data-id='+id+']').toggle();
    });


    $('.coupon-info-close').on('click', function() {
        var id = $(this).data('id');
        $('.coupon-info-container[data-id='+id+']').toggle();
    });
});

$( document ).ready(function() {

    let timer;
    $('#search').on('keyup', function () {
        clearTimeout(timer);
        const query = $(this).val();

        timer = setTimeout(() => {
            fetchOrders(query, 1);
        }, 200);
    });

    $(document).on('click', '.pagination a', function (e) {
        e.preventDefault();
        const query = $('#search').val();
        const page = $(this).attr('href').split('page=')[1];
        fetchOrders(query, page);
    });

    function fetchOrders(query, page) {
        $.ajax({
            url: "/dashboard/orders",
            method: 'GET',
            data: { query: query, page: page },
            success: function (response) {
                $('#orders-container').html(response.html);
                const event = new Event('ajaxUpdate');
                document.dispatchEvent(event);
            },
            error: function (xhr) {
                console.error(xhr.responseText);
            },
        });
    }
});

$(document).ready(function () {
    $('#statusFilterForm').on('change', function (e) {
        e.preventDefault();

        const formData = $(this).serialize(); // Serialize the form data

        $.ajax({
            url: "/dashboard/orders", // Make sure this points to your orders route
            method: 'GET',
            data: formData,
            success: function (response) {
                $('#orders-container').html(response.html); // Update the orders container with the filtered orders
                const event = new Event('ajaxUpdate');
                document.dispatchEvent(event);
            },
            error: function (xhr) {
                console.error(xhr.responseText); // Handle errors
            }
        });
    });
});


$(document).ready(function () {
    // When the checkbox with id 'all' is checked
    $('#all').on('change', function () {
        if ($(this).is(':checked')) {
            // Uncheck 'traders' and 'users'
            $('#pending, #packed, #shipped, #in_delivery, #received, #cancelled, #refunded, #completed').prop('checked', false);
        }
    });

    // When either 'traders' or 'users' is checked
    $('#pending, #packed, #shipped, #in_delivery, #received, #cancelled, #refunded, #completed').on('change', function () {
        if ($(this).is(':checked')) {
            // Uncheck 'all'
            $('#all').prop('checked', false);
        }
    });
});