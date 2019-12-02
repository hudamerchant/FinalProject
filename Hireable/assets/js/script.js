$(document).ready(function() {
    $('.js-example-basic-multiple').select2();
    
    $('.edit-project-category').select2();

    // $('#preloader').bind('ajaxStart', function(){
    //     $(this).show();
    // }).bind('ajaxStop', function(){
    //     $(this).fadeOut("slow");
    // });

    $(document).ajaxStart(function(){
        // Show image container
        $("#preloader").show();
      });
      $(document).ajaxComplete(function(){
        // Hide image container
        $("#preloader").fadeOut("slow");
      });

    $('.edit-project-category').on('select2:unselecting',function(e){
        e.preventDefault(); 

        select_id = e.params.args.data.id;
        select_text = e.params.args.data.text;
        
        formData = {
            'project_id'    : $(".user_id").val(),
            'category_id'   : select_id
        };

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
                url         : SITE_URL+"/Edit_project/deleteProject" ,
                type        : "POST" ,
                data        : formData ,
                dataType    : "JSON",
                cache       : false ,
                beforeSend: function() {
                    $("#preloader").show();
                 },
                 complete: function(){
                    $("#preloader").fadeOut("slow");
                },
                success     : function(response){
                    if(response.msg != null)
                    {
                        swal(response.msg, {
                            icon: "success",
                            }).then(() => {
                                $('.edit-project-category').find('option[value="'+select_id+'"]').remove();
                               $('.edit-project-category').select2();
                            });
                    }
                }
    
            }) 
        } 
    });
    });
         
    
    
    $('.client-image').on('change',function(){        
        var formData = new FormData(); 
        formData.append('file_name', $(this).prop('files')[0]);
        console.log(formData);
        
        $.ajax({
            url         : SITE_URL+"/Client_profile/upload",
            type        : "POST",
            contentType : false,
            processData : false,  
            data        : formData,
            dataType    : "json",
            cache       : false,
            beforeSend: function() {
                $("#preloader").show();
             },
             complete: function(){
                $("#preloader").fadeOut("slow");
            },
            success     : function(response){
                
                swal("", response.message, response.status)
                .then(function(e){
                    window.location.reload();
                });
            }
        })

    });
    $('.freelancer-image').on('change',function(){        
        var formData = new FormData(); 
        formData.append('file_name', $(this).prop('files')[0]);
        console.log(formData);
        
        $.ajax({
            url         : SITE_URL+"/Freelancer_profile/upload",
            type        : "POST",
            contentType : false,
            processData : false,  
            data        : formData,
            dataType    : "json",
            cache       : false,
            beforeSend: function() {
                $("#preloader").show();
             },
             complete: function(){
                $("#preloader").fadeOut("slow");
            },
            success     : function(response){
                
                swal("", response.message, response.status)
                .then(function(e){
                    window.location.reload();
                });
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


    $('.send').on('click',function(e){
      
    //    if($('.message').val().length != 0){
            
    //         $('.send').attr("disabled", false);
    //    }
    //    else{
    //         $(".send").attr("disabled", true);
    //    }

        msg = $('input[name=message]').val();
         if(msg != ''){
            e.preventDefault();
            $(".send").attr("disabled", true);
     
             
             data = {
                 msg             : $('.message').val(),
                 receiver_id     : $('.receiver_id').val()
             }; 
                $.ajax({
                    url:SITE_URL+"/Chatbox/insert_messages",
                    data:data,
                    type: 'POST',
                    beforeSend: function() {
                     // $(".send").attr("disabled", true);
                     // $("#preloader").show();
                     $( ".send" ).addClass("disabledClass");
                     
                         $(".send").attr("disabled", true);
                     
                     },
                    success:function(){
                        
                        $('input[name=message]').val('')
                        $( ".send" ).removeClass("disabledClass");
                     $(".send").attr("disabled", false);
                        
                        
                    },
                    complete: function(){
                     //$(".send").attr("disabled", false);
                     // $("#preloader").fadeOut("slow");
                     
                     }
                })
         }
    });
    
    function recursively_ajax()
    { 
            li_length = $('.chatbox-listing > li').length;
            
            data = { 
                    offset          : li_length ,
                    receiver_id     : $('.receiver_id').val()
                }
                
            $.ajax({
                url: SITE_URL + "/Chatbox/get_messages",
                data: data,
                
                success: function (data) {
                    $('.chatbox-listing').append(data); 
                    recursively_ajax();
                }
            })
    }
    $('.message').on('keyup',function(e){
        if(e.keyCode == 13){
            $('.send').trigger('click');
        } 
    });
    
    if ($('.chatbox-form').length) {
        recursively_ajax();
    }
    
    


});