$(document).ready(function() {
    $('.js-example-basic-multiple').select2();
    
    $('.edit-project-category').select2();
    $('.edit-project-category').on('select2:unselect',function(){
        formData = {
            'project_id' : $(".user_id").val()
        };

    $(function () {
 
        $("#rateYo").rateYo({
       
          onSet: function (rating, rateYoInstance) {
       
           $(".rating").val(rating);
          }
        });
      });

        $.ajax({
            url         : SITE_URL+"/EditProject/deleteProject" ,
            type        : "POST" ,
            data        : formData ,
            dataType    : "JSON",
            cache       : false ,
            success : function(response){
                console.log(response);
            }

        })
    });
    
    $('.custom-file-input').on('change',function(){
        
        console.log('testing')
    });
});
