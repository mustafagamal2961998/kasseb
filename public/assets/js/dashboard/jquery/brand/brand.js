$( document ).ready(function() {
   
    $('#brand_image').change(function(event){
       var file = event.target.files[0];
       if(file){
           var reader = new FileReader();
           reader.onload = function(e){
               $('.brand-image-preview').attr('src', e.target.result).show();
           }
           reader.readAsDataURL(file);
       }
   });

    let timer;
    $('#search').on('keyup', function () {
        clearTimeout(timer);
        const query = $(this).val();

        timer = setTimeout(() => {
            fetchBrands(query, 1);
        }, 200);
    });

    $(document).on('click', '.pagination a', function (e) {
        e.preventDefault();
        const query = $('#search').val();
        const page = $(this).attr('href').split('page=')[1];
        fetchBrands(query, page);
    });

    function fetchBrands(query, page) {
        $.ajax({
            url: "/dashboard/brands",
            method: 'GET',
            data: { query: query, page: page },
            success: function (response) {
                $('#brands-container').html(response.html);
                const event = new Event('ajaxUpdate');
                document.dispatchEvent(event);
            },
            error: function (xhr) {
                console.error(xhr.responseText);
            },
        });
    }


});



