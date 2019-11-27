$(document).ready(function() {
    // $( function() {
    //     $( "#datepicker" ).datepicker({
    //         maxDate: new Date
    //     });
    // });
    $('.js-example-basic-multiple').select2();
    
    $('.edit-project-category').select2();

    $('.edit-project-category').on('select2:unselecting',function(e){
        select_id = e.params.args.data.id;
        select_text = e.params.args.data.text;
        
        formData = {
            'project_id'    : $(".user_id").val(),
            'category_id'   : select_id
        };

        // e.preventDefault();
        // console.log(e);
        // e.preventDefault();
        // swal({
        //     text        : "Are you sure you want to delete this skill?",
        //     buttons     : true,
        //     dangerMode  : true,
        //   })
        // .then((willDelete) => {
        // if (willDelete) {
        //     formData = {
        //         'project_id'    : $(".user_id").val(),
        //         'category_id'   : select_id
        //     };

            $.ajax({
                url         : SITE_URL+"/EditProject/deleteProject" ,
                type        : "POST" ,
                data        : formData ,
                dataType    : "JSON",
                cache       : false ,
                success     : function(response){
                    // if(response.msg != null)
                    // {
                    //     swal(response.msg, {
                    //         icon: "success",
                    //         });
                    // }
                }
    
            })
        //     $(this).select2({
        //         unselect:true
        //         });
        // }
        // else
        // {
        //     var data = {
        //         "id": select_id,
        //         "text": select_text
        //     }; 
        // }
    });
    $(this).data('unselect', true);
        
    });
    
    $('.client-image').on('change',function(){        
        var formData = new FormData(); 
        formData.append('file_name', $(this).prop('files')[0]);
        console.log(formData);
        
        $.ajax({
            url         : SITE_URL+"/ClientProfile/upload",
            type        : "POST",
            contentType : false,
            processData : false,  
            data        : formData,
            dataType    : "JSON",
            cache       : false,
            success     : function(response){
                console.log(response);
            }
        })

    });
    $('.freelancer-image').on('change',function(){        
        var formData = new FormData(); 
        formData.append('file_name', $(this).prop('files')[0]);
        console.log(formData);
        
        $.ajax({
            url         : SITE_URL+"/FreelancerProfile/upload",
            type        : "POST",
            contentType : false,
            processData : false,  
            data        : formData,
            dataType    : "JSON",
            cache       : false,
            success     : function(response){
                console.log(response);
            }
        })

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


    // $('.send').on('click',function(e){
    //    e.preventDefault();
    //     msg = $('input[name=message]').val();
         
    //     data = {msg:msg}; 
    //        $.ajax({
    //            url:SITE_URL+"/Chatbox/insert_messages",
    //            data:data,
    //            success:function(){
    //                $('input[name=message]').val('')
    //            }
    //        })
    // });
   
    //  console.log(SITE_URL)
    // setInterval(function(){
    //    li_length = $('.chatbox-listing > li.chatbox-li').length;
    //    data = {offset:li_length}
    //    $.ajax({
    //        url:SITE_URL+"/chatbox/get_messages",
    //        data:data,
    //        success:function(data){
    //            $('.chatbox-listing').append(data);
    //        }
    //    }) 
    // }, 2000);
