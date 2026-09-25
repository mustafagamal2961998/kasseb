$( document ).ready(function() {
    $('#logo_image').on('change', function() {
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

});