$( document ).ready(function() {
    let timer;
    $('#search').on('keyup', function () {
        clearTimeout(timer);
        const query = $(this).val();

        timer = setTimeout(() => {
            fetchUsers(query, 1);
        }, 200);
    });

    $(document).on('click', '.pagination a', function (e) {
        e.preventDefault();
        const query = $('#search').val();
        const page = $(this).attr('href').split('page=')[1];
        fetchUsers(query, page);
    });

    function fetchUsers(query, page) {
        $.ajax({
            url: "/dashboard/users",
            method: 'GET',
            data: { query: query, page: page },
            success: function (response) {
                $('#users-container').html(response.html);
            },
            error: function (xhr) {
                console.error(xhr.responseText);
            },
        });
    }
});


$( document ).ready(function() {
   
    $('#user_avatar').change(function(event){
       var file = event.target.files[0];
       if(file){
           var reader = new FileReader();
           reader.onload = function(e){
               $('.user-image-preview').attr('src', e.target.result).show();
           }
           reader.readAsDataURL(file);
       }
   });
});


$(document).ready(function () {
    $('#typeFilterForm').on('change', function (e) {
        e.preventDefault();

        const formData = $(this).serialize(); // Serialize the form data

        $.ajax({
            url: "/dashboard/users", // Make sure this points to your orders route
            method: 'GET',
            data: formData,
            success: function (response) {
                $('#users-container').html(response.html); // Update the orders container with the filtered orders
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
            $('#deliveries, #users').prop('checked', false);
        }
    });

    // When either 'traders' or 'users' is checked
    $('#deliveries, #users').on('change', function () {
        if ($(this).is(':checked')) {
            // Uncheck 'all'
            $('#all').prop('checked', false);
        }
    });
});



    $(document).on('change', '.user-switch-status', function (e) {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        var user_id = $(this).data('id');
        var checkbox = $(this);
        $.ajax({
            url: '/dashboard/users/switch/status/' + user_id,
            method: 'PUT',
            success: function (response) {
                if (checkbox.is(':checked')) { // ✅ استخدم المتغير المحفوظ
                    $('.user-status[data-id=' + user_id + ']').html(`
                        <span class="badge badge-sm bg-gradient-success">
                            مفعل
                        </span>
                    `);
                } else {
                    $('.user-status[data-id=' + user_id + ']').html(`
                        <span class="badge badge-sm bg-gradient-danger">
                            محظور
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