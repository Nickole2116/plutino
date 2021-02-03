$(document).ready(function() {
    $(".uploadBtn").change(function (){
       var fileName = $(this).val();
       $(".attachment_filename").html(fileName);
    });
//default element
$(".success").animate({opacity:1},2000);
$('body').find('input, a, button').prop('disabled', false);
//$( ".datepicker" ).datepicker({ dateFormat: 'dd M yy' });
        
    $('.datepicker').datetimepicker({format:'d M Y', timepicker:false,});
    $(".datepicker").attr("autocomplete", "off");
    $('.datetimepicker').datetimepicker({format:'d M Y H:i'});
    $(".datetimepicker").attr("autocomplete", "off");
    $('.datetimesecpicker').datetimepicker({format:'d M Y H:i:s'});
    $(".datetimesecpicker").attr("autocomplete", "off");


 var ajax_url=$("input[name=ajax_url]").val();


       //side bar
    $("#menu-toggle").click(function(e) {
        e.preventDefault();
        $("#wrapper").toggleClass("toggled");
    });
$(".form-control").focus(function(){
    $(this).parents(".form-group").find(".error_message").text("");
});


    //admin form create
    $(".create_button").click(function(){
        var form_height=$(".create_fieldset").height();
        $(".create").css("margin-top", -form_height/2).animate({height: form_height+10+"px"}, 500);
        $(".page_blank").animate({opacity: 1}, 500).css("pointer-events","all");
    });

    //game form create
    $(".create_game_button").click(function(){
        var form_height=$(".create_game_fieldset").height();
        $(".create_game").css("margin-top", -form_height/2).animate({height: form_height+10+"px"}, 500);
        $(".page_blank").animate({opacity: 1}, 500).css("pointer-events","all");
    });

    //admin form modify
     $(".admin_modify").click(function(e){
        //admin modify
        e.preventDefault();
        var item_id=$(this).parents(".admin_row").find(".admin_id").text();
        $.ajax({
            type: 'POST',
            url: $("input[name=ajax_url]").val()+adminpath+'/admin/ajax_process',
            async: false, 
            data:{
                item_id:item_id,
            },
            success: function(data){
                //alert(data);
                var result_row = data.split("||");
                $(".modify").find("#admin_id").val(item_id);
                $(".modify").find("#change_admin_name").val(result_row[0]);
                $(".modify").find("#change_admin_email").val(result_row[1]);
                $(".modify").find("#change_admin_role").val(result_row[2]);
                
            },
            error: function(XMLHttpRequest, textStatus, errorThrown){
                alert(errorThrown);
            }
        });

        var form_height=$(".modify_fieldset").height();
        $(".modify").css("margin-top", -form_height/2).animate({height: form_height+10+"px"}, 500);
        $(".page_blank").animate({opacity: 1}, 500).css("pointer-events","all");

 
    });
     $(".change_password_button_admin").click(function(e){

        //admin change pass
        e.preventDefault();
        var item_id=$(this).parents(".admin_row").find(".admin_id").text();
        $(".change").find("#admin_id").val(item_id);

        var form_height=$(".change_fieldset").height();
        $(".change").css("margin-top", -form_height/2).animate({height: form_height+10+"px"}, 500);
        $(".page_blank").animate({opacity: 1}, 500).css("pointer-events","all");
    });
     //member form modify
     
     $('.member_modify').click(function(e){
        // console.log( $(this) )
        e.preventDefault();
        var item_id=$(this).parents(".member_row").find(".member_id").text();
        var ranking_id=$(this).parents(".member_row").find(".ranking_id").text();
        var package_id=$(this).parents(".member_row").find(".package_id").text();
        
        // console.log('ranking id is: '+ranking_id+' and package id is: '+package_id)
        $.ajax({
            type: 'POST',
            url: $("input[name=ajax_url]").val()+adminpath+'/member/admim_member_get_ajax_result',
            async: false, 
            data:{
                item_id:item_id,
                package_id:package_id,
            },
            success: function(data){
               // alert(data);
                var result_row = data.split("||");
                $(".modify").find("#member_id").val(item_id);
                $(".modify").find("#member_username").val(result_row[0]);
                $(".modify").find("#member_detail_fullname").val(result_row[1]);
                $(".modify").find("#member_detail_ic_pas").val(result_row[2]);
                $(".modify").find("#member_email").val(result_row[3]);
                $(".modify").find("#member_detail_address").val(result_row[4]);
                $(".modify").find("#member_detail_country").val(result_row[5]);
                $(".modify").find("#old_ranking_id").val(ranking_id);
                $(".modify").find("#old_package_id").val(package_id);
                
                // package_detail=result_row[6].split("///");
                // for ($i=0; $i <=package_detail.length-2; $i++){
                //     package_detail_spilt=package_detail[$i].split("/");
                //     //alert(package_detail_spilt[0]);
                //     $("<option class='package_detail' value='"+package_detail_spilt[1]+"'>"+package_detail_spilt[0]+"</option>").appendTo(".select_package");
                //     //alert(package_detail[$i]);
                // }
                $(".modify").find(".select_ranking").val(ranking_id);
                $(".modify").find(".select_package").val(package_id);

                

            },
            error: function(XMLHttpRequest, textStatus, errorThrown){
                alert(errorThrown);
            }
        });

        var form_height=$(".modify_fieldset").height();
        $(".modify").css("margin-top", -form_height/2).animate({height: form_height+10+"px"}, 500);
        $(".page_blank").animate({opacity: 1}, 500).css("pointer-events","all");

 
    });
    //reject withdrawal
    $(".wallet_exchange_reject_button").click(function(e){
        e.preventDefault();

        var trx_request_id=$(this).parents(".exchange_row").find(".trx_request_id").text();
        var form_height=$(".wallet_exchange_reject_fieldset").height();
        $(".wallet_exchange_reject").css("margin-top", -form_height/2).animate({height: form_height+10+"px"}, 500);
        $(".page_blank").animate({opacity: 1}, 500).css("pointer-events","all");

        $(".wallet_exchange_reject").find("input[name=exchange_id]").val(trx_request_id);
      
    });
     //bot winner form modify
     $(".bot_modify").click(function(e){
        //admin modify
        e.preventDefault();
        var bot_id=$(this).parents(".bot_row").find(".bot_id").text();
        $.ajax({
            type: 'POST',
            url: $("input[name=ajax_url]").val()+adminpath+'/bot/get_detail_by_id',
            async: false, 
            data:{
                bot_id:bot_id,
            },
            success: function(data){
                
                var result_row = JSON.parse(data);
                $(".modify").find("#bot_id").val(bot_id);
                $(".modify").find("#change_game_winner_ratio_group_type").val(result_row['group_active_type']);
                $(".modify").find("#change_game_winner_ratio_type").val(result_row['game_winning_ratio_type']);
                $(".modify").find("#change_game_winner_date").val(result_row['game_winning_ratio_date']);
                
            },
            error: function(XMLHttpRequest, textStatus, errorThrown){
                alert(errorThrown);
            }
        });

        var form_height=$(".modify_fieldset").height();
        $(".modify").css("margin-top", -form_height/2).animate({height: form_height+10+"px"}, 500);
        $(".page_blank").animate({opacity: 1}, 500).css("pointer-events","all");

 
    });
    //bot form modify
     $(".bot_game_modify").click(function(e){
        //admin modify
        e.preventDefault();
        var bot_id=$(this).parents(".bot_row").find(".bot_id").text();
        $.ajax({
            type: 'POST',
            url: $("input[name=ajax_url]").val()+adminpath+'/bot/get_game_detail_by_id',
            async: false, 
            data:{
                bot_id:bot_id,
            },
            success: function(data){
                
                var result_row = JSON.parse(data);
                var startDate = result_row['game_start_time'];
                var endDate = result_row['game_end_time'];

                $(".modify_game").find("#game_id").val(bot_id);
                $(".modify_game").find("#change_game_group_type").val(result_row['game_group_type']);
            
                $(".modify_game").find("#change_game_start_date").data("DateTimePicker").date(startDate);
                $(".modify_game").find("#change_game_end_date").data("DateTimePicker").date(endDate);

               

                
            },
            error: function(XMLHttpRequest, textStatus, errorThrown){
                alert(errorThrown);
            }
        });

        var form_height=$(".modify_game_fieldset").height();
        $(".modify_game").css("margin-top", -form_height/2).animate({height: form_height+10+"px"}, 500);
        $(".page_blank").animate({opacity: 1}, 500).css("pointer-events","all");

 
    });
    //bot form modify
    $(".bot_game_status_modify").click(function(e){
        //admin modify
        e.preventDefault();
        var bot_id=$(this).parents(".bot_row").find(".bot_id").text();
        $.ajax({
            type: 'POST',
            url: $("input[name=ajax_url]").val()+adminpath+'/bot/get_game_detail_by_id',
            async: false, 
            data:{
                bot_id:bot_id,
            },
            success: function(data){
                
                var result_row = JSON.parse(data);
                $(".modify_game_status").find("#game_id").val(bot_id);
                $(".modify_game_status").find("#change_game_status").val(result_row['game_status'])
            },
            error: function(XMLHttpRequest, textStatus, errorThrown){
                alert(errorThrown);
            }
        });

        var form_height=$(".modify_game_status_fieldset").height();
        $(".modify_game_status").css("margin-top", -form_height/2).animate({height: form_height+10+"px"}, 500);
        $(".page_blank").animate({opacity: 1}, 500).css("pointer-events","all");

 
    });
    /*
     $(".change_password_button").click(function(e){
        //member change pass\
        alert("old one");
        e.preventDefault();
        if($(this).hasClass("change_password_button")){
            var item_id=$(this).parents(".member_row").find(".member_id").text();
            $(".change").find("#member_id").val(item_id);
            var form_height=$(".modify_pass_fieldset").height();
            $(".change").css("margin-top", -form_height/2).animate({height: form_height+10+"px"}, 500);
            $(".page_blank").animate({opacity: 1}, 500).css("pointer-events","all");
            }
    });
    
     $(".change_security_pin_button").click(function(e){
        //member change security_pass
        e.preventDefault();
        var item_id=$(this).parents(".member_row").find(".member_id").text();
        $(".change_security").find("#member_id").val(item_id);
        var form_height=$(".modify_security_fieldset").height();
        $(".change_security").css("margin-top", -form_height/2).animate({height: form_height+10+"px"}, 500);
        $(".page_blank").animate({opacity: 1}, 500).css("pointer-events","all");
    });
    */
    $(".package_modify").click(function(e){
        //package modify
        e.preventDefault();
        var item_id=$(this).parents(".package_row").find(".package_id").text();
        var item_type="package";
        $.ajax({
            type: 'POST',
            url: $("input[name=ajax_url]").val()+adminpath+'/package/ajax_process',
            async: false, 
            data:{
                item_id:item_id,
                item_type:item_type,
            },
            success: function(data){
                // alert(data);
                var result_row = JSON.parse(data);
                $(".modify").find("#package_id").val(item_id);
                $(".modify").find("#change_package_name").val(result_row['package_name']);
                $(".modify").find("#change_package_price").val(result_row['package_price']);
                $(".modify").find("#change_package_share_percent").val(result_row['package_share_percent']);
            },
            error: function(XMLHttpRequest, textStatus, errorThrown){
                alert(errorThrown);
            }
            
        });

    
        var form_height=$(".modify_fieldset").height();
        $(".modify").css("margin-top", -form_height/2).animate({height: form_height+10+"px"}, 500);
        $(".page_blank").animate({opacity: 1}, 500).css("pointer-events","all");

 
    });
     $(".product_modify").click(function(e){
        e.preventDefault();
        //product
        e.preventDefault();
        var item_id=$(this).parents(".product_row").find(".product_id").text();
        var item_type="product";
       
        $.ajax({
            type: 'POST',
            url: $("input[name=ajax_url]").val()+adminpath+'/product/ajax_process',
            async: false, 
            data:{
                item_id:item_id,
                item_type:item_type,
            },
            success: function(data){
                var result_row = data.split("||");
                $(".modify").find("#change_product_id").val(item_id);
                $(".modify").find("#change_product_name").val(result_row[0]);
                $(".modify").find("#change_product_description").val(result_row[1]);
                $(".modify").find("#change_product_bv").val(result_row[2]);
                $(".modify").find("#change_product_price").val(result_row[3]);
                $(".modify").find("#change_product_quantity").val(result_row[4]);
                $(".modify").find("#change_product_weight").val(result_row[5]);
                $(".modify").find("#change_product_tax").val(result_row[6]);
                $(".modify").find("#change_product_promotion_start_date").val(result_row[7]);
                $(".modify").find("#change_product_promotion_end_date").val(result_row[8]);
                $(".modify").find("#change_product_for_sell").val(result_row[9]);

            },
            error: function(XMLHttpRequest, textStatus, errorThrown){
                alert(errorThrown);
            }
        });
       
        var form_height=$(".modify_fieldset").height();
        $(".modify").css("margin-top", -form_height/2).animate({height: form_height+10+"px"}, 500);
        $(".page_blank").animate({opacity: 1}, 500).css("pointer-events","all");
    });

	//share_split form modify
     $(".share_split_modify").click(function(e){
        //interest modify
        e.preventDefault();
        var share_split_id=$(this).parents(".share_split_row").find(".share_split_id").text();
        $.ajax({
            type: 'POST',
            url: $("input[name=ajax_url]").val()+adminpath+'/share_split/update',
            async: false, 
            data:{
                share_split_id:share_split_id,
            },
            success: function(data){
                //alert(data);
                var result_row = data.split("||");
                $(".modify").find("#share_split_id").val(share_split_id);
                $(".modify").find("#change_share_date").val(result_row[0]);
                $(".modify").find("#change_share_split_monthly").val(result_row[1]);
                $(".modify").find("#change_share_split_unitx").val(result_row[2]);
                $(".modify").find("#change_share_split_unity").val(result_row[3]);
            },
            error: function(XMLHttpRequest, textStatus, errorThrown){
                alert(errorThrown);
            }
        });

        var form_height=$(".modify_fieldset").height();
        $(".modify").css("margin-top", -form_height/2).animate({height: form_height+10+"px"}, 500);
        $(".page_blank").animate({opacity: 1}, 500).css("pointer-events","all");

 
    });

    $(".wallet_topup").click(function(e){
        //wallet modify
        e.preventDefault();
        var item_id=$(this).parents(".wallet_row").find(".member_wallet_memberid").text();
        var item_type=$(this).parents(".wallet_row").find(".member_wallet_type_hidden").text();
      
        $.ajax({
            type: 'POST',
            url: $("input[name=ajax_url]").val()+adminpath+'/wallet/get_detail',
            async: false, 
            data:{
                item_id:item_id,
                item_type:item_type,
            },
            success: function(data){
               //alert(data);
                 var result_row = data.split("||");
                
                $(".modify").find("#member_wallet_memberid").val(item_id);
                var wallet_type;
                wallet_type = $("#htxt_wallet_" + result_row[0].trim()).val();
                $(".modify").find("#member_wallet_type").val(wallet_type);
                $(".modify").find("#member_wallet_type_id").val(result_row[0]);
                $(".modify").find("#member_wallet_balance").val(result_row[1]);

                
            },
            error: function(XMLHttpRequest, textStatus, errorThrown){
                alert(errorThrown);
            }
            
        });
        var form_height=$(".modify_fieldset").height();
        $(".modify").css("margin-top", -form_height/2).animate({height: form_height+10+"px"}, 500);
        $(".page_blank").animate({opacity: 1}, 500).css("pointer-events","all");

 
    });
 $(".an_modify").click(function(e){
        //announcement modify
        e.preventDefault();
        var item_id=$(this).parents(".an_row").find(".an_id").text();
        $.ajax({
            type: 'POST',
            url: $("input[name=ajax_url]").val()+adminpath+'/announcement/ajax_process',
            async: false, 
            data:{
                item_id:item_id,
            },
            success: function(data){
                var result_row = data.split("|||");
                var x=1;
                $(".modify").find("#an_id").val(item_id);
                //alert(result_row.length);
                for( var i = 0; i <=result_row.length-1; i++ ) {
                      
                    var result_row_split = result_row[i].split("||");
                    $(".modify").find(".title_"+x).val(result_row_split[0]);
                    $(".modify").find(".message_"+x).val(result_row_split[1]);
                    x++;
                }
            },
            error: function(XMLHttpRequest, textStatus, errorThrown){
                alert(errorThrown);
            }
        });

        var form_height=$(".modify_fieldset").height();
        $(".modify").css("margin-top", -form_height/2).animate({height: form_height+10+"px"}, 500);
        $(".page_blank").animate({opacity: 1}, 500).css("pointer-events","all");

 
    });
    //approve withdrawal
    $(".withdrawal_approve_button").click(function(e){
        e.preventDefault();

        var trx_request_id=$(this).parents(".withdrawal_row").find(".trx_request_id").text();
        var form_height=$(".withdrawal_approve_fieldset").height();
        $(".withdrawal_approve").css("margin-top", -form_height/2).animate({height: form_height+10+"px"}, 500);
        $(".page_blank").animate({opacity: 1}, 500).css("pointer-events","all");

        $(".withdrawal_approve").find("input[name=trx_request_id]").val(trx_request_id);
      
    });
    //reject withdrawal
    $(".withdrawal_reject_button").click(function(e){
        e.preventDefault();

        var trx_request_id=$(this).parents(".withdrawal_row").find(".trx_request_id").text();
        var form_height=$(".withdrawal_reject_fieldset").height();
        $(".withdrawal_reject").css("margin-top", -form_height/2).animate({height: form_height+10+"px"}, 500);
        $(".page_blank").animate({opacity: 1}, 500).css("pointer-events","all");

        $(".withdrawal_reject").find("input[name=trx_request_id]").val(trx_request_id);
      
    });
    //approve transfer wallet
    $(".transfer_wallet_approve_button").click(function(e){
        e.preventDefault();

        var trx_request_id=$(this).parents(".transfer_wallet_row").find(".trx_request_id").text();
        var form_height=$(".withdrawal_approve_fieldset").height();
        $(".withdrawal_approve").css("margin-top", -form_height/2).animate({height: form_height+10+"px"}, 500);
        $(".page_blank").animate({opacity: 1}, 500).css("pointer-events","all");

        $(".withdrawal_approve").find("input[name=transfer_wallet_id]").val(trx_request_id);
      
    });
    //reject transfer wallet
    $(".transfer_wallet_reject_button").click(function(e){
        e.preventDefault();

        var trx_request_id=$(this).parents(".transfer_wallet_row").find(".trx_request_id").text();
        var form_height=$(".withdrawal_reject_fieldset").height();
        $(".withdrawal_reject").css("margin-top", -form_height/2).animate({height: form_height+10+"px"}, 500);
        $(".page_blank").animate({opacity: 1}, 500).css("pointer-events","all");

        $(".withdrawal_reject").find("input[name=transfer_wallet_id]").val(trx_request_id);
      
    });

    $(".country_modify").click(function(e){
        //country modify
        e.preventDefault();
        var item_id=$(this).parents(".country_row").find(".an_id").text();
        $.ajax({
            type: 'POST',
            url: $("input[name=ajax_url]").val()+adminpath+'/country/ajax_process',
            async: false, 
            data:{
                item_id:item_id,
            },
            success: function(data){
                
                var result_row = data.split("|");
                // console.log(result_row);
                $(".modify").find("input[name=country_id]").val(item_id);
                $(".modify").find("#txt_country_name").val(result_row[0]);
                $(".modify").find("#txt_country_symbol").val(result_row[1]);
                $(".modify").find("#txt_country_selling_currency").val(result_row[2]);
                $(".modify").find("#txt_country_buying_currency").val(result_row[3]);
            },
            error: function(XMLHttpRequest, textStatus, errorThrown){
                alert(errorThrown);
            }
        });

        var form_height=$(".modify_fieldset").height();
        $(".modify").css("margin-top", -form_height/2).animate({height: form_height+10+"px"}, 500);
        $(".page_blank").animate({opacity: 1}, 500).css("pointer-events","all");

 
    });

    //admin form delete
    //country
    $(".delete_bot_button").click(function(e){
        e.preventDefault();
        var bot_id=$(this).parents(".bot_row").find(".bot_id").text();
        var form_height=$(".delete_fieldset").height();
        $(".delete").css("margin-top", -form_height/2).animate({height: form_height+10+"px"}, 500);
        $(".page_blank").animate({opacity: 1}, 500).css("pointer-events","all");
        $(".delete").find("input[name=bot_id]").val(bot_id);
      
    });
    //admin form delete
    //country
    $(".delete_button").click(function(e){
        e.preventDefault();
        var country_id=$(this).parents(".country_row").find(".an_id").text();
        var form_height=$(".delete_fieldset").height();
        $(".delete").css("margin-top", -form_height/2).animate({height: form_height+10+"px"}, 500);
        $(".page_blank").animate({opacity: 1}, 500).css("pointer-events","all");
        $(".delete").find("input[name=country_id]").val(country_id);
      
    });

    //package
    $(".delete_button").click(function(e){
        e.preventDefault();
        var package_id=$(this).parents(".package_row").find(".package_id").text();

        var form_height=$(".delete_fieldset").height();
        $(".delete").css("margin-top", -form_height/2).animate({height: form_height+10+"px"}, 500);
        $(".page_blank").animate({opacity: 1}, 500).css("pointer-events","all");

        $(".delete").find("input[name=package_id]").val(package_id);
      
    });

    //member
    // $(".delete_button_member").click(function(e){
    //     e.preventDefault();

    //     var member_id=$(this).parents(".member_row").find(".member_id").text();
    //     var form_height=$(".delete_fieldset").height();
    //     $(".delete").css("margin-top", -form_height/2).animate({height: form_height+10+"px"}, 500);
    //     $(".page_blank").animate({opacity: 1}, 500).css("pointer-events","all");

    //     $(".delete").find("input[name=member_id]").val(member_id);
      
    // });

     //announcement
    $(".delete_button").click(function(e){
        e.preventDefault();
        var an_id=$(this).parents(".an_row").find(".an_id").text();
      
        var form_height=$(".delete_fieldset").height();
        $(".delete").css("margin-top", -form_height/2).animate({height: form_height+10+"px"}, 500);
        $(".page_blank").animate({opacity: 1}, 500).css("pointer-events","all");

        $(".delete").find("input[name=an_id]").val(an_id);
      
    });
    //product
    $(".delete_button").click(function(e){
        e.preventDefault();
        var product_id=$(this).parents(".product_row").find(".product_id").text();

        var form_height=$(".delete_fieldset").height();
        $(".delete").css("margin-top", -form_height/2).animate({height: form_height+10+"px"}, 500);
        $(".page_blank").animate({opacity: 1}, 500).css("pointer-events","all");

        $(".delete").find("input[name=product_id]").val(product_id);
      
    });
    //admin deactive
    $(".delete_button").click(function(e){
        e.preventDefault();
        var an_id=$(this).parents(".admin_row").find(".admin_id").text();

        var form_height=$(".delete_fieldset").height();
        $(".delete").css("margin-top", -form_height/2).animate({height: form_height+10+"px"}, 500);
        $(".page_blank").animate({opacity: 1}, 500).css("pointer-events","all");

        $(".delete").find("input[name=admin_id]").val(an_id);
    });

    //hide admin form
    $(".page_blank, .cross, .cancel_delete, .no_btn").click(function(e){
        e.preventDefault();
        var form_height=$(".create_fieldset").height();
        $(".admin_form, .confirm_con").animate({height: "0px"}, 500);
        $(".page_blank").animate({opacity: 0}, 500).css("pointer-events","none");
        $(".form-group").find(".error_message").text("");
        $("input[name=form_name]").val("");
        $(' .admin_form ').css('padding', '0px')
    });

    //set form height
     
    
});


$(".select_active").change(function(e){

    var member_id = $(this).parent().find('#active_member_id').val()
    var active_txt = $(this).find(':selected').text()
    $('td:contains("'+member_id+'")').parent().find('.txt_status').text(active_txt)
    $("#new_xy_form").submit();
    
    
});

$(".select_active2").change(function(e){

    var member_id = $(this).parent().find('#active_member_id2').val()
    var active_txt = $(this).find(':selected').text()
    $('td:contains("'+member_id+'")').parent().find('.txt_status2').text(active_txt)
    $("#new_xy2_form").submit();
    
    
});

$('#new_xy_form').submit(function(e){
    e.preventDefault()
    var data = $(this).serialize()

    $.ajax({
        url: 'member/ajax_p_update_xy_point',
        type: 'post',
        data: data,
        success: function(response)
        {
            $(".page_blank").animate({opacity: 0}, 500).css("pointer-events","none");
            $(".xy_active").animate({height: "0px"}, 500);
            $(".xy_active").css("padding", '0px')  
        }
    })
});



$('#new_xy2_form').submit(function(e){
    e.preventDefault()
    var data = $(this).serialize()

    $.ajax({
        url: 'member/ajax_p_update_xy2_point',
        type: 'post',
        data: data,
        success: function(response)
        {
            $(".page_blank").animate({opacity: 0}, 500).css("pointer-events","none");
            $(".xy2_active").animate({height: "0px"}, 500);
            $(".xy2_active").css("padding", '0px')  
        }
    })
});

$(".view_message, .reply_message").click(function(e){
        e.preventDefault();
        $(".message_reply_row, .message_attachment_display").remove();
        $(".message_reply, .close_subject").css({"opacity": 1, "pointer-events": "all"});
        var message_id = $(this).parents(".message_row").find(".message_id").text();
        var message_reply_subject = $(this).parents(".message_row").find(".message_subject").text();
        var message_status = $(this).parents(".message_row").find(".message_status").text();
        var message_attachment = $(this).parents(".message_row").find(".message_attachment").text();
        var message_first_content = $(this).parents(".message_row").find(".message_content").text();
        if(message_status=="Open"){
            var message_status_reply = 1;
        }
        else{
            var message_status_reply = 0;
        }
        $("#message_status_reply").val(message_status_reply);
        $.ajax({
            type: 'POST',
            url: $("input[name=ajax_url]").val()+adminpath+'/message/ajax_message_view',
            async: false, 
            data:{
                message_id:message_id,
            },
            success: function(data){
                //alert(data);
                $(".message_reply_subject").text(message_reply_subject);
                $('#message_id').val(message_id);
                var result_row = $.trim(data).split("///");
                var message_attachment_row = $.trim(result_row[0]).split("|");
                for ($i=0; $i <=message_attachment_row.length-2; $i++){
                    $('<div class="message_attachment_display">'+
                    '<div class="img_contanier">'+
                    '<img class="img-responsive" src="'+$("input[name=aws_file_url]").val()+message_attachment_row[$i]+'"'+
                    'width="" height=""'+       
                    '</div>'+
                    '</div>').insertBefore('.message_list');
                }
                var message_first_content_split = $.trim(message_first_content).split("|");
                if(message_first_content_split[0]!='')
                {
                     $('<div class="message_reply_row">'+
                    '<div class="message_reply_content message_type_0">'+
                    '<div class="message_i message_color_0">'+message_first_content_split[0]+'</div>'+
                    '<div class="message_time">'+message_first_content_split[1]+'</div>'+
                    '</div>'+
                    '</div>').insertBefore('.message_list');
                }
               
                var message_reply_row =  $.trim(result_row[1]).split("||");
                for ($i=0; $i <=message_reply_row.length-2; $i++){
                    var message_reply_row_split = message_reply_row[$i].split("|");
                    var reply_img = "";
                    if(message_reply_row_split[3]!="-"){
                        reply_img ='<div class="message_attachment_display">'+
                        '<div class="img_contanier">'+
                        '<img class="img-responsive zoom" src="'+$("input[name=aws_file_url]").val()+message_reply_row_split[3]+'"'+
                        'width="" height=""'+       
                        '</div>';
                    }
                    var reply_message = "";
                    if(message_reply_row_split[1]!="-"){
                        reply_message = '<div class="message_'+$i+' message_color_'+message_reply_row_split[0]+'">'+message_reply_row_split[1]+'</div>';
                    }
                    $('<div class="message_reply_row">'+
                    '<div class="message_reply_content message_type_'+message_reply_row_split[0]+'">'+
                    reply_img+
                    reply_message+
                    '<div class="message_time">'+message_reply_row_split[2]+'</div>'+
                    '</div>'+
                    '</div>').insertBefore('.message_list');
                    $(".message_"+$i).text(message_reply_row_split[1]);
                }
                $(".message_contanier").animate({height: "600px"}, 500);
                $(".page_blank").animate({opacity: 1}, 500).css("pointer-events","all");
            },
                error: function(XMLHttpRequest, textStatus, errorThrown){
                alert(errorThrown);
            }
        });
    });


//back end error message
$(".hidden_form").each(function() {
  var error_message_hidden=$(this).find(".error_message_hidden").text();
  if(error_message_hidden!=""){
    var fieldset_height=$(this).find(".fieldset").height();
    var this_form=$(this).attr("id");
     $("#"+this_form).css("margin-top", -fieldset_height/2).animate({height: fieldset_height+10+"px"}, 500);
       $(".page_blank").animate({opacity: 1}, 500).css("pointer-events","all");
  }

});

$(".submit_form").click(function(){
  var this_form = $(this).closest("form").attr('id');
  $("#"+this_form).animate({height: 0+"px"}, 500);
  $(".confirm_con").animate({height: 100+"px"}, 500).delay( 800 );
  $("input[name=form_name]").val("#"+this_form);
});
$(".yes_btn").click(function(e){
  e.preventDefault();
  var form_name = $("input[name=form_name]").val();
  $(form_name).submit();
});

var keyup_search = false;
var timer;
var milisecond = 0; // Immediately run ajax with 0 timer
var searching = false
var the_class = '';

$('.ajax_search').keyup(function()
{
    keyup_search = true;
    milisecond = 1000; // Run ajax only after 1 seconds
    the_class = '.ajax_search'
    traverse()
})

$('.small_ajax_search').keyup(function(){
    
    keyup_search = true;
    milisecond = 1000; // Run ajax only after 1 seconds
    the_class = '.small_ajax_search'
    traverse()
})

$('.big_ajax_username').focus(function(){
    $('#search_title').val('');
})

$('#search_title').focus(function(){
    $('.big_ajax_username').val('');
})

$('#search_form').submit(function(e)
{
    e.preventDefault()
    searching = true
    if( $(window).width() < 768 )
    {
        the_class = '.small_ajax_search'
    }
    traverse()
})

$(document).ready(function()
{
    var table = $('tbody').html()
    var total_rows = $('#total_rows').html()
    var pagination = $('#pagination').html()
    var table_total_rows_pagination = [table, total_rows, pagination]
    history.replaceState( table_total_rows_pagination , null, null)
})

window.addEventListener('popstate', function(e) 
{
    $('tbody').html( e.state[0] )
    $('#total_rows').html( e.state[1] )
    $('#pagination').html( e.state[2] )
});

function traverse(page)
{
    var ajax_url = $("input[name=ajax_url]").val()
    var search_start_date = change_null( $('#search_start_date').val() )
    var search_end_date = change_null( $('#search_end_date').val() )
    var search_title = change_null( $('#search_title').val() )
    var search_status = change_null( $('#search_status').val() )
    var page = change_null( page )

    if( $(window).width() >= 768 )
    {
        var xy_active = $('#xy_active').is(':checked') // return true or false
        var xy_deactive = $('#xy_deactive').is(':checked')
        var xy2_active = $('#xy2_active').is(':checked') // return true or false
        var xy2_deactive = $('#xy2_deactive').is(':checked')
        var free_active = $('#free_active').is(':checked') // return true or false
        var free_deactive = $('#free_deactive').is(':checked')
        $('html,body').animate(
        {
            scrollTop: $('#no-more-tables').offset().top
        });
    }
    else
    {
        var xy_active = $('#small_xy_active').is(':checked') // return true or false
        var xy_deactive = $('#small_xy_deactive').is(':checked')
        var xy2_active = $('#small_xy2_active').is(':checked') // return true or false
        var xy2_deactive = $('#small_xy2_deactive').is(':checked')
        var free_active = $('#small_free_acc').is(':checked') // return true or false
        var free_deactive = $('#small_free_deactive').is(':checked')
    }
    
    if(free_active)
    {
        free_active = 'ticked'
    }
    else
    {
        free_active = 'not_ticked'
    }
    if(free_deactive)
    {
        free_deactive = 'ticked'
    }
    else
    {
        free_deactive = 'not_ticked'
    }    

    if(xy_active)
    {
        xy_active = 'ticked'
    }
    else
    {
        xy_active = 'not_ticked'
    }
    if(xy_deactive)
    {
        xy_deactive = 'ticked'
    }
    else
    {
        xy_deactive = 'not_ticked'
    }

    if(xy2_active)
    {
        xy2_active = 'ticked'
    }
    else
    {
        xy2_active = 'not_ticked'
    }
    if(xy2_deactive)
    {
        xy2_deactive = 'ticked'
    }
    else
    {
        xy2_deactive = 'not_ticked'
    }

    $('tbody').html('<tr><td colspan="13" style="height:200px"></td></tr>');
    $('#blueload').removeClass()
    $('#txt_no_record').addClass('hidden')

    var data = 'search_start_date='+search_start_date+'&search_end_date='+search_end_date+'&search_title='+search_title+'&search_status='+search_status+'&page='+page;
    data += '&free_active='+free_active+'&free_deactive='+free_deactive;
    data += '&xy_active='+xy_active+'&xy_deactive='+xy_deactive;
    data += '&xy2_active='+xy2_active+'&xy2_deactive='+xy2_deactive;


    if(keyup_search)
    {
        data += '&ajax_keyup_search=1';

        $(window.the_class).each(function()
        {
            data += '&' + $(this).attr('id') + '=' + $(this).val()
        })
        searching = true
    }
    clearTimeout(timer)
    timer = setTimeout(function(){
        $.ajax({
            url: $("input[name=ajax_url]").val()+adminpath+'/member/ajax_search',
            type: 'post',
            data: data,
            dataType: 'json',
            success: function(response)
            {   
                console.log(response);
                $('#blueload').addClass('hidden')
                $('tbody').html('');
                var count = 1;
                count = count + response.offset

                $('.total_rows').html('total entries: '+response.total_rows)

                $('#pagination').html(response.pagination_in_html)

                if( response.member.length == 0 )
                {
                    if( $(window).width() >= 768 )
                    {
                        $('tbody').html('<tr class="member_row"><td style="line-height:150px; position:absolute; background:#f9f9f9;" id="txt_no_record"><span style="width:200px">No records found</span></td></tr>')
                        var x_panel_width = $('.x_content').width() - 20
                        $('#txt_no_record').width(x_panel_width)
                        $('#txt_no_record span').css('position', 'relative')
                        $('#txt_no_record span').css('left', '50%')
                        $('#txt_no_record span').css('margin-left', '-80px')
                    }
                    else
                    {

                        $('tbody').html('<tr class="member_row"><td style="line-height:150px; background:#f9f9f9; padding-left:0px; text-align:center;">No records found</td></tr>')
                    }
                }
                
                $.each(response.member, function(key, value)
                {
                    var active_or_not;

                    if( value.member_xy_point_status == 1 )
                    {
                        active_or_not = 'Active'
                    }
                    else
                    {
                        active_or_not = 'Deactive'
                    }

                    if( value.member_xy2_point_status == 1 )
                    {
                        active_or_not2 = 'Active'
                    }
                    else
                    {
                        active_or_not2 = 'Deactive'
                    }

                    var d = new Date().toISOString()

                    var todays_date = d.split('T')

                    var member_register_date = value.member_register_date.split(' ')

                    var delete_button_member = '';
                    if( member_register_date[0] == todays_date[0] && value.member_status==1)
                    {
                        if(response.admin_role!=2){
                            delete_button_member = '<a  class="btn btn-danger" style="margin-right:5px" href="#" onclick="undo_register_member(this); return false">取消新注册</a>' 
                        }
                    }
                  
                    var member_status = "";
                    if(value.member_status==1){
                        member_status = '<span style="color:green">激活</span>';
                        if(response.admin_role!=2){
                            delete_button_member = delete_button_member + '<a  class="btn btn-danger" style="margin-right:5px" href="#" onclick="delete_member(this); return false">冻结</a>';
                        } 
                    }else   if(value.member_status==9){
                        member_status = '<span style="color:red">悬疑</span>';
                    }else   if(value.member_status==10){
                        member_status = '<span style="color:red">关闭</span>';
                    }
                    var reactive_status = '';
                    if( value.member_status==10 )
                    {
                        if(response.admin_role!=2){
                            reactive_status = '<a  class="btn btn-danger" style="margin-right:5px" href="#" onclick="reactive_member(this); return false">激活</a> ';
                        }
                    }
                    var change_ai_status='';
                    if( value.member_group_active!='' )
                    {
                        if(response.admin_role!=2){
                            change_ai_status = '<a href="#" style="margin-right:5px" class="btn btn-success" onclick="change_member_group_type(this); return false">更改AiBot组别</a>';
                        }
                    }
                    var change_to_free_acc_status='';
                    if(response.admin_role!=2){
                        change_to_free_acc_status = '<a href="#" style="margin-right:5px" class="btn btn-dark" onclick="convert_to_free_acc_status(this); return false">更换空单</a>';
                    }
                    var change_privilege='';
                    if(response.admin_role!=2){
                        // change_privilege = '<a href="#" class="btn btn-warning" onclick="change_privilege(this,\'LOCK_WALLET_WITHDRAWAL\',\'Set Withdrawal Privilege\'); return false">Withdrawal Privilege</a>'+
                        // '<a href="#" class="btn btn-light" onclick="change_privilege(this,\'LOCK_WALLET_TRANSFER\',\'Set Transfer Privilege\'); return false">Transfer Privilege</a>'+
                        // '<a href="#" class="btn btn-primary" onclick="change_privilege(this,\'SPECIAL_MEMBER_GROUP\',\'Special Group\'); return false">Special Group</a>';
                        // '<a href="#" onclick="change_privilege(this,\'LOCK_BONUS\',\'Special Group\'); return false">Lock Bonus Privilege</a>';
                    }
                    
                    $('tbody').append(
                    '<tr class="member_row">'+
                        '<td data-title="No">'+count+'</td>'+
                        '<td class="member_id">'+value.member_id+'</td>'+
                        '<td class="input_hidden member_packageid">'+value.member_packageid+'</td>'+
                        '<td class="input_hidden member_ranking">'+value.member_ranking+'</td>'+
                        '<td data-title="Username" class="member_username">'+value.member_username+'<br/>'+member_status+'</td>'+
                        '<td data-title="Sponsor" class="sponsor_name">'+value.sponsor_name+'</td>'+
                        '<td data-title="Country" class="country_name">'+value.country_name+'</td>'+
                        '<td data-title="Register Date" class="member_register_date">'+value.member_register_date+'</td>'+
                        '<td data-title="Capital" class="member_capital">'+parseFloat(value.member_capital).toFixed(2)+'</td>'+
                        '<td data-title="Email" class="member_email">'+value.member_email+'</td>'+
                        // '<td data-title="Password" class="member_password_plain">'+value.member_password_plain+'</td>'+
                        // '<td data-title="Security Pin" class="member_security_pin_plain">'+value.member_security_pin_plain+'</td>'+
                        '<td data-title="Free Acc" class="member_is_empty_acc">'+value.member_is_empty_acc+'</td>'+
                        '<td data-title="Ht Acc" class="member_is_free_acc">'+value.member_is_free_acc+'</td>'+
                        '<td data-title="Ranking" class="package_name">'+value.ranking_name+'</td>'+
                        // '<td data-title="XY Point"><a class="txt_status" onclick="change_xy(this); return false" href="#">'+active_or_not+'</a></td>'+
                        // '<td data-title="XY2 Point"><a class="txt_status2" onclick="change_xy2(this); return false" href="#">'+active_or_not2+'</a></td>'+
                        '<td data-title="Action" class="display_block_a">'+
                        '<a class="btn btn-primary" style="margin-right:5px" href="'+response.url+'/member/modify?member_id='+value.member_id+'">修改</a>'+
                        '<a class="btn btn-info" style="margin-right:5px" href="#" onclick="view_statement(this); return false">查看报表</a>'+
                        // '<a href="#" onclick="view_pairing(this); return false">Pairing</a>'+
                       
                        '<a class="btn btn-warning" style="margin-right:5px" target="_black" href="'+response.url+'/member/member_login?id='+value.member_id+'" target="_black">会员登录</a>'+
                         delete_button_member + reactive_status + change_ai_status+
                        change_to_free_acc_status + change_privilege + 
                                          
                        
                        // '<a href="#" onclick="convert_gv_wallet_status(this); return false">BP Wallet Exchange Privilege</a>'+
                        // '<a href="#" onclick="change_privilege(this,\'LOCK_WALLET_WITHDRAWAL\',\'Set Withdrawal Privilege\'); return false">Withdrawal Privilege</a>'+
                        // '<a href="#" onclick="change_privilege(this,\'LOCK_WALLET_TRANSFER\',\'Set Transfer Privilege\'); return false">Transfer Privilege</a>'+
                        // '<a href="#" onclick="change_privilege(this,\'SPECIAL_MEMBER_GROUP\',\'Special Group\'); return false">Special Group</a>'+
                        // '<a href="#" onclick="change_privilege(this,\'LOCK_SHARE_WITHDRAWAL\',\'Set BITTAC Withdrawal Privilege\'); return false">BITTAC Withdrawal Privilege</a>'+
                        // '<a href="#" onclick="change_privilege(this,\'LOCK_TRANSFER_BP\',\'Set BP Transfer Privilege\'); return false">BP Transfer Privilege</a>'+
                        // '<a href="#" onclick="change_privilege(this,\'LOCK_P2P_BUY\',\'Set P2P Buy Privilege\'); return false">P2P Buy Privilege</a>'+
                        // '<a href="#" onclick="change_privilege(this,\'LOCK_INTEREST_1\',\'Set SLA ROI Privilege\'); return false">SLA ROI Privilege</a>'+
                        // '<a href="#" onclick="change_privilege(this,\'LOCK_INTEREST_2\',\'Set DLA ROI Privilege\'); return false">DLA ROI Privilege</a>'+
                        // '<a href="#" onclick="change_privilege(this,\'LOCK_INTEREST_3\',\'Set Sponsor Bonus Privilege\'); return false">Sponsor Bonus Privilege</a>'+   
                        // '<a href="#" onclick="change_privilege(this,\'LOCK_INTEREST_4\',\'Set Group Bonus Privilege\'); return false">Group Bonus Privilege</a>'+   
                        // '<a href="#" onclick="change_privilege(this,\'LOCK_INTEREST_5\',\'Set Leadership Bonus Privilege\'); return false">Leadership Bonus Privilege</a>'+  
                        '</td>'+
                    '</tr>'
                    )
                    count++;
                })
                
            },
            complete: function()
            {
                var table = $('tbody').html()
                var total_rows = $('#total_rows').html()    
                var pagination = $('#pagination').html()
                var table_total_rows_pagination = [table, total_rows, pagination]

                if(searching && page != '')
                {
                    history.replaceState( table_total_rows_pagination , null, '#search#'+page) 
                }
                else if(searching)
                {
                    history.pushState( table_total_rows_pagination , null, '#search') 
                }
                else
                {
                    history.replaceState( table_total_rows_pagination , null, '#'+page)
                }
                searching = false
            }
        })
    }, milisecond) 
}

function change_null(value)
{
    if(value == null)
    {
        return '';
    }
    else
    {
        return value;
    }
}

function check_the_box(obj)
{
    if( $(obj).attr('id') == 'xy_active' )
    {
        $('#xy_deactive').removeAttr('checked')
    }
    if( $(obj).attr('id') == 'xy_deactive' )
    {
        $('#xy_active').removeAttr('checked')
    }
    if( $(obj).attr('id') == 'small_xy_active' )
    {
        $('#small_xy_deactive').removeAttr('checked')
    }
    if( $(obj).attr('id') == 'small_xy_deactive' )
    {
        $('#small_xy_active').removeAttr('checked')
    }
    if( $(obj).attr('checked') ) 
    {
        $(obj).removeAttr('checked')
    } 
    else 
    {
        $(obj).attr('checked', 'checked')
    }
    traverse()
}

function check_the_box2(obj)
{
    if( $(obj).attr('id') == 'xy2_active' )
    {
        $('#xy2_deactive').removeAttr('checked')
    }
    if( $(obj).attr('id') == 'xy2_deactive' )
    {
        $('#xy2_active').removeAttr('checked')
    }
    if( $(obj).attr('id') == 'small_xy2_active' )
    {
        $('#small_xy2_deactive').removeAttr('checked')
    }
    if( $(obj).attr('id') == 'small_xy2_deactive' )
    {
        $('#small_xy2_active').removeAttr('checked')
    }
    if( $(obj).attr('checked') ) 
    {
        $(obj).removeAttr('checked')
    } 
    else 
    {
        $(obj).attr('checked', 'checked')
    }
    traverse()
}

function change_xy(obj)
{
    var select_value = 0;

    if( $(obj).text() == 'Active' )
    {
        select_value = 1;
    }

    $('#new_xy_form select').val( select_value )

    var member_id=$(obj).parents('.member_row').find(".member_id").text();
    $("#active_member_id").val(member_id);

    var form_height=$(".xy_fieldset").height();

    $(".xy_active").css("padding", '0px 20px 20px 20px')
    $(".xy_active").css("margin-top", -form_height/2).animate({height: form_height+50+"px"}, 500);
    $(".page_blank").animate({opacity: 1}, 500).css("pointer-events","all");
}

function change_xy2(obj)
{
    var select_value = 0;

    if( $(obj).text() == 'Active' )
    {
        select_value = 1;
    }

    $('#new_xy2_form select').val( select_value )

    var member_id=$(obj).parents('.member_row').find(".member_id").text();
    $("#active_member_id2").val(member_id);

    var form_height=$(".xy2_fieldset").height();

    $(".xy2_active").css("padding", '0px 20px 20px 20px')
    $(".xy2_active").css("margin-top", -form_height/2).animate({height: form_height+50+"px"}, 500);
    $(".page_blank").animate({opacity: 1}, 500).css("pointer-events","all");
}

function change_password(obj)
{
    var item_id=$(obj).parents(".member_row").find(".member_id").text();
    $(".change").find("#member_id").val(item_id);
    var form_height=$(".modify_pass_fieldset").height();
    $(".change").css("margin-top", -form_height/2).animate({height: form_height+10+"px"}, 500);
    $(".page_blank").animate({opacity: 1}, 500).css("pointer-events","all");
}


function modify(obj)
{
    var member_id = $(obj).parents(".member_row").find(".member_id").text();
    var member_ranking = $(obj).parents(".member_row").find(".member_ranking").text();
    var member_packageid = $(obj).parents(".member_row").find(".member_packageid").text();
    var member_username = $(obj).parents(".member_row").find(".member_username").text();
    var member_detail_fullname = $(obj).parents(".member_row").find(".member_detail_fullname").text();
    var member_detail_ic_pas = $(obj).parents(".member_row").find(".member_detail_ic_pas").text();
    var member_email = $(obj).parents(".member_row").find(".member_email").text();
    var member_detail_address = $(obj).parents(".member_row").find(".member_detail_address").text();
    var country_name = $(obj).parents(".member_row").find(".country_name").text();

    $(".modify_fieldset").find("#member_id").val(member_id);
    $(".modify_fieldset ").find("#member_username").val( member_username );
    $(".modify_fieldset").find("#member_detail_fullname").val( member_detail_fullname );
    $(".modify_fieldset").find("#member_detail_ic_pas").val( member_detail_ic_pas );
    $(".modify_fieldset").find("#member_email").val( member_email );
    $(".modify_fieldset").find("#member_detail_address").val( member_detail_address );
    $(".modify_fieldset").find("#country_name").val( country_name );
    $(".modify_fieldset").find(".select_ranking").val(member_ranking);
    $(".modify_fieldset").find(".select_package").val(member_packageid);

    var form_height=$(".modify_fieldset").height();
    $(".modify").css("margin-top", -form_height/2).animate({height: form_height+20+"px"}, 500);
    $(".page_blank").animate({opacity: 1}, 500).css("pointer-events","all");
}

function change_pin(obj)
{
    var item_id=$(obj).parents(".member_row").find(".member_id").text();
    $(".change_security").find("#member_id").val(item_id);
    var form_height=$(".modify_security_fieldset").height();
    $(".change_security").css("margin-top", -form_height/2).animate({height: form_height+10+"px"}, 500);
    $(".page_blank").animate({opacity: 1}, 500).css("pointer-events","all");
}

function view_statement(obj)
{
    var member_id=$(obj).parents(".member_row").find(".member_id").text();
    var member_name=$(obj).parents(".member_row").find(".member_username").text();
    var member_detail_fullname=$(obj).parents(".member_row").find(".member_detail_fullname").text();
    $("input[name=member_wallet_trx_memberid]").val(member_id);
    $("input[name=member_name]").val(member_name);
    $("input[name=member_detail_fullname]").val(member_detail_fullname);
    $("#view_statement_form").submit();
}

function view_pairing(obj)
{
    var member_id=$(obj).parents(".member_row").find(".member_id").text();
    var member_name=$(obj).parents(".member_row").find(".member_username").text();
    var member_detail_fullname=$(obj).parents(".member_row").find(".member_detail_fullname").text();
    $("input[name=member_bv_memberid]").val(member_id);
    $("input[name=member_name]").val(member_name);
    $("input[name=member_detail_fullname]").val(member_detail_fullname);
    $("#view_paring_form").submit();   
}

function delete_member(obj)
{
    var member_id=$(obj).parents(".member_row").find(".member_id").text();
    var form_height=$(".delete_fieldset").height();
    $(".delete").css("margin-top", -form_height/2).animate({height: form_height+10+"px"}, 500);
    $(".page_blank").animate({opacity: 1}, 500).css("pointer-events","all");
    $(".delete").find("input[name=member_id]").val(member_id);    
}
function undo_register_member(obj)
{
    var member_id=$(obj).parents(".member_row").find(".member_id").text();
    var form_height=$(".undo_register_fieldset").height();
    $(".undo_register").css("margin-top", -form_height/2).animate({height: form_height+10+"px"}, 500);
    $(".page_blank").animate({opacity: 1}, 500).css("pointer-events","all");
    $(".undo_register").find("input[name=member_id]").val(member_id);    
}      
function reactive_member(obj)
{
    var member_id=$(obj).parents(".member_row").find(".member_id").text();
    var form_height=$(".reactive_fieldset").height();
    $(".reactive").css("margin-top", -form_height/2).animate({height: form_height+10+"px"}, 500);
    $(".page_blank").animate({opacity: 1}, 500).css("pointer-events","all");
    $(".reactive").find("input[name=member_id]").val(member_id);
}   
$('.edit_bank').click(function()
{
    if( $('.edit_bank').is(':checked') )
    {
        $('.hider').removeClass('hidden')
    }
    else
    {
        $('.hider').addClass('hidden')
    }
})

$(".page_blank").click(function(e){
e.preventDefault();
$('#message_id').val("");
$(".message_contanier").animate({height: "0px"}, 500);
$(".page_blank").animate({opacity: 0}, 500).css("pointer-events","none");
});




