$(document).ready(function() {
    $('.js-example-basic-multiple').select2();
    
    $('.edit-project-category').select2();

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
            url         : SITE_URL+"/ClientProfile/upload",
            type        : "POST",
            contentType : false,
            processData : false,  
            data        : formData,
            dataType    : "json",
            cache       : false,
            success     : function(response){
                console.log(response);
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
            url         : SITE_URL+"/FreelancerProfile/upload",
            type        : "POST",
            contentType : false,
            processData : false,  
            data        : formData,
            dataType    : "json",
            cache       : false,
            success     : function(response){
                console.log(response);
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
       e.preventDefault();
        msg = $('input[name=message]').val();
         
        data = {
            msg             : $('.message').val(),
            receiver_id     : $('.receiver_id').val()
        }; 
           $.ajax({
               url:SITE_URL+"/Chatbox/insert_messages",
               data:data,
               success:function(){
                   $('input[name=message]').val('')
               }
           })
    });
   
    recursively_ajax();
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
    
    if ($('.chatbox-form').length) {
        recursively_ajax();
    }
    // //  console.log(SITE_URL)
    //  function recursively_ajax()
    // {
    // // setInterval(function(){
    //    li_length = $('.chatbox-listing > li.chatbox-li').length;
    //    data = {offset:li_length}
    //    $.ajax({
    //        url:SITE_URL+"/Chatbox/get_messages",
    //        data:data,
    //        success:function(data){
    //         recursively_ajax();
    //         $('.chatbox-listing').append(data);

    //        }
    //    }) 
    // // , 2000);
    // }
    // if($('.chatbox-form').length) {
    //     recursively_ajax()
    // }
});