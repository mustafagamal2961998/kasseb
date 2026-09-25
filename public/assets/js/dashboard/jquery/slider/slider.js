$( document ).ready(function() {
   
    $('#slider_image').change(function(event){
       var file = event.target.files[0];
       if(file){
           var reader = new FileReader();
           reader.onload = function(e){
               $('.slider-image-preview').attr('src', e.target.result).show();
           }
           reader.readAsDataURL(file);
       }
   });
});