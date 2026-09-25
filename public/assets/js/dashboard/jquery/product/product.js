$( document ).ready(function() {
    $('#product_image').on('change', function() {
        $('#imagePreview').html(''); // Clear any previous images
        var files = this.files;

        if (files.length > 0) {
            $.each(files, function(i, file) {
                var reader = new FileReader();
                
                reader.onload = function(e) {
                    // Create a new image element
                    var img = $('<img />', {
                        src: e.target.result,
                        width: 100, // You can set width or any other styling here
                        height: 100
                    });
                    // Append the image to the preview container
                    $('#imagePreview').append(img);
                }

                // Read the image file as a Data URL
                reader.readAsDataURL(file);
            });
        }
    });



    let timer;
    $('#search').on('keyup', function () {
        clearTimeout(timer);
        const query = $(this).val();

        timer = setTimeout(() => {
            fetchOrders(query, 1);
        }, 200);
    });

    // $(document).on('click', '.pagination a', function (e) {
    //     e.preventDefault();
    //     const query = $('#search').val();
    //     const page = $(this).attr('href').split('page=')[1];
    //     fetchOrders(query, page);
    // });

    function fetchOrders(query, page) {
        $.ajax({
            url: "/dashboard/products",
            method: 'GET',
            data: { query: query, page: page },
            success: function (response) {
                $('#products-container').html(response.html);
                const event = new Event('ajaxUpdate');
                document.dispatchEvent(event);
            },
            error: function (xhr) {
                console.error(xhr.responseText);
            },
        });
    }

        $(document).on('change', '.product-switch-status', function (e) {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        var product_id = $(this).data('id');
        var checkbox = $(this);
        $.ajax({
            url: '/dashboard/products/switch/status/' + product_id,
            method: 'PUT',
            success: function (response) {
                if (checkbox.is(':checked')) { // ✅ استخدم المتغير المحفوظ
                    $('.product-status[data-id=' + product_id + ']').html(`
                        <span class="badge badge-sm bg-gradient-success">
                            مفعل
                        </span>
                    `);
                } else {
                    $('.product-status[data-id=' + product_id + ']').html(`
                        <span class="badge badge-sm bg-gradient-danger">
                            مؤرشف
                        </span>
                    `);
                }
                $('.globle-action-alert-container').css('display', 'block');
                $('.globle-alert-content').addClass('btn btn-success');
                $('.globle-alert-content').text(response);

                setTimeout(function () {
                    $('.globle-action-alert-container').css('display', 'none');
                }, 1500);
            },
            error: function (xhr) {
                console.error(xhr.responseText);
            },
        });
    });


});