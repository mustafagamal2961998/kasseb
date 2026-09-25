$( document ).ready(function() {
   
    $('#banner_image').change(function(event){
       var file = event.target.files[0];
       if(file){
           var reader = new FileReader();
           reader.onload = function(e){
               $('.banner-image-preview').attr('src', e.target.result).show();
           }
           reader.readAsDataURL(file);
       }
   });
});