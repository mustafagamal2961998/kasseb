    let timer;
    $('#search').on('keyup', function () {
        clearTimeout(timer);
        const query = $(this).val();

        timer = setTimeout(() => {
            fetchsubcategories(query, 1);
        }, 200);
    });

    $(document).on('click', '.pagination a', function (e) {
        e.preventDefault();
        const query = $('#search').val();
        const page = $(this).attr('href').split('page=')[1];
        fetchsubcategories(query, page);
    });

    function fetchsubcategories(query, page) {
        $.ajax({
            url: "/dashboard/subcategories",
            method: 'GET',
            data: { query: query, page: page },
            success: function (response) {
                $('#subcategories-container').html(response.html);
                const event = new Event('ajaxUpdate');
                document.dispatchEvent(event);
            },
            error: function (xhr) {
                console.error(xhr.responseText);
            },
        });
    }