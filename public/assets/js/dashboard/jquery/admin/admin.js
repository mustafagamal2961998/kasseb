$( document ).ready(function() {
   
    $('#admin_avatar').change(function(event){
       var file = event.target.files[0];
       if(file){
           var reader = new FileReader();
           reader.onload = function(e){
               $('.admin-image-preview').attr('src', e.target.result).show();
           }
           reader.readAsDataURL(file);
       }
   });
});
