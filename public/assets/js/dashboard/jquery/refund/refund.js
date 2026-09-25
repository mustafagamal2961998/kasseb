
// $( document ).ready(function() {
//     $('.coupon-info').on('click', function() {
//         var id = $(this).data('id');
//         $('.coupon-info-container[data-id='+id+']').toggle();
//     });
    
    
//     $('.coupon-info-close').on('click', function() {
//         var id = $(this).data('id');
//         $('.coupon-info-container[data-id='+id+']').toggle();
//     });

// });




$(document).ready(function() {
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
            url: "/dashboard/refunds",
            method: 'GET',
            data: { query: query, page: page },
            success: function (response) {
                $('#refunds-container').html(response.html);
                const event = new Event('ajaxUpdate');
                document.dispatchEvent(event);
            },
            error: function (xhr) {
                console.error(xhr.responseText);
            },
        });
    }
});