$(document).ready(function() {
    $('.js-example-basic-multiple').select2();
    
    $('.edit-project-category').select2();
    

    // --
    // --
    // DONT REMOVE THIS COMMENT //
    // --
    // --


    $('.edit-project-category').on('select2:unselecting',function(e){
        select_id = e.params.args.data.id;
        select_text = e.params.args.data.text;
        // e.preventDefault();
        console.log(e);
        e.preventDefault();
        swal({
            text        : "Are you sure you want to delete this skill?",
            buttons     : true,
            dangerMode  : true,
          })
        .then((willDelete) => {
        if (willDelete) {
            formData = {
                'project_id'    : $(".user_id").val(),
                'category_id'   : select_id
            };

            $.ajax({
                url         : SITE_URL+"/EditProject/deleteProject" ,
                type        : "POST" ,
                data        : formData ,
                dataType    : "JSON",
                cache       : false ,
                success     : function(response){
                    if(response.msg != null)
                    {
                        swal(response.msg, {
                            icon: "success",
                            });
                    }
                }
    
            })
            $(this).select2({
                unselect:true
                });
        }
        else
        {
            var data = {
                "id": select_id,
                "text": select_text
            }; 
        }
    });
    $(this).data('unselect', true);
        
    });
    
    $('.custom-file-input').on('change',function(){
        path = $('.custom-file-input').prop('files')[0];

        console.log(path);
        // formData = {
        //     'file_name' : path.replace(/^.*\\/, "")
        // }
        // $.ajax({
        //     url         : SITE_URL+"/ClientProfile/upload_file",
        //     type        : "POST",
        //     data        : formData,
        //     dataType    : "JSON",
        //     cache       : false,
        //     success     : function(response){
        //         console.log(response);
        //     }
        // })

    });
    $('.fetch-rating').each(function(){
      identity = $(this).attr('id');
      shading  = $(this).attr('data-rating');
      console.log(identity);
      $('#'+identity).rateYo({
          rating : shading,
          readOnly: true,
          starWidth: "25px"
      })
    })
    $(function () {
 
        $("#rateYo").rateYo({
       
          onSet: function (rating, rateYoInstance) {
       
           $(".rating").val(rating);
          }
        });
      });
    // $(function () {
 
    //     $("#rateYoReadOnly").rateYo({
       
    //       onSet: function (rating, rateYoInstance) {
       
    //        $(".rating").val(rating);
    //       }
    //     });
    //   });


});
