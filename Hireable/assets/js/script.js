$(document).ready(function() {
    $('.js-example-basic-multiple').select2();
    
    $('.edit-project-category').select2();
    

    // --
    // --
    // DONT REMOVE THIS COMMENT //
    // --
    // --


    // $('.edit-project-category').on('select2:unselecting',function(e){
    //     swal({
    //         text        : "Are you sure you want to delete this skill?",
    //         buttons     : true,
    //         dangerMode  : true,
    //       })
    //     .then((willDelete) => {
    //     if (willDelete) {
    //         formData = {
    //             'project_id'    : $(".user_id").val(),
    //             'category_id'   : e.params.args.data.id
    //         };

    //         $.ajax({
    //             url         : SITE_URL+"/EditProject/deleteProject" ,
    //             type        : "POST" ,
    //             data        : formData ,
    //             dataType    : "JSON",
    //             cache       : false ,
    //             success     : function(response){
    //                 if(response.msg != null)
    //                 {
    //                     swal(response.msg, {
    //                         icon: "success",
    //                         });
    //                 }
    //             }
    
    //         })
    //         $(this).select2({
    //             unselect:true
    //             });
    //     }
    //     else
    //     {
    //         return false;
    //     }
    //     });
        
    // });
    
    $('.custom-file-input').on('change',function(){
        
        console.log('testing')
    });

    $(function () {
 
        $("#rateYo").rateYo({
       
          onSet: function (rating, rateYoInstance) {
       
           $(".rating").val(rating);
          }
        });
      });


});
