$(document).ready(function() {
    $('.js-example-basic-multiple').select2();
    
    $('.edit-project-category').select2();
    $('.edit-project-category').on('select2:unselect',function(){
        console.log('testing')
    });
    
    $('.custom-file-input').on('change',function(){
        
        console.log('testing')
    });
    // $(document).on('click', '#hide' , function () {
    //     $( ".project" ).hide(3000);
    //   }); 


});