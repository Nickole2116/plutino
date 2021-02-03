<?php
echo"<div class='input_form'>";
//////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////// add admin
        $attributes = array('id' => 'add_admin_form',
                            'class' => 'admin_form create hidden_form'
                            );
        echo form_open(ADMINPATH.'/admin/p_create', $attributes);

            echo"<a href='' class='glyphicon glyphicon-remove cross'></a>";
            $attributes = array('class' => 'col-md-12 create_fieldset fieldset');
            echo form_fieldset(lang('add_admin'), $attributes);

              echo"<div class='form-group'>";
                echo"<div class='input-group input-group-sm'>";
                    echo '<span class="input-group-addon lable">'.lang('name').'</span>';
                    $data = array('name' => 'admin_name',
                                  'id' => 'admin_name',
                                  'class' => 'admin_name form-control',
                                  'value' => set_value('admin_name')
                                );
                    echo form_input($data);
                echo"</div>";
                echo form_error('admin_name','<div class="error_message error_message_hidden">','</div>');
              echo"</div>";

              echo"<div class='form-group'>";
                  echo"<div class='input-group input-group-sm'>";
                    echo '<span class="input-group-addon lable">'.lang('email').'</span>';
                    $data = array('name' => 'admin_email',
                                  'id' => 'admin_email',
                                  'class' => 'admin_email form-control',
                                  'value' => set_value('admin_email')
                                );
                    echo form_input($data);
                echo"</div>";
                echo form_error('admin_email','<div class="error_message error_message_hidden">','</div>');
              echo"</div>";

              echo"<div class='form-group'>";
                echo "<div class='input-group input-group-sm'>";
                  echo  "<span class='input-group-addon lable'>".lang('admin_role')."</span>";
                  $js = 'class="form-control" onChange="some_function();"';
                  echo form_dropdown('admin_role', $admin_role, set_value('admin_role'), $js);
                echo "</div>";
                echo form_error('admin_role','<div class="error_message error_message_hidden">','</div>');
              echo"</div>";

              echo"<div class='form-group'>";
                echo"<div class='input-group input-group-sm'>";
                  echo '<span class="input-group-addon lable">'.lang('password').'</span>';
                  $data = array('name' => 'admin_password',
                                'id' => 'admin_password',
                                'class' => 'admin_password form-control',
                                'type' =>'password',
                                'value' => set_value('admin_password')
                              );
                  echo form_input($data);
                echo"</div>";
                echo form_error('admin_password','<div class="error_message error_message_hidden">','</div>');
              echo"</div>";

              echo"<div class='form-group'>";
                echo"<div class='input-group input-group-sm'>";
                  echo '<span class="input-group-addon lable">'.lang('confirm_password').'</span>';
                  $data = array('name' => 'admin_confirm_password',
                                'id' => 'admin_confirm_password',
                                'class' => 'admin_confirm_password form-control',
                                'type' =>'password',
                                'value' => set_value('admin_confirm_password')
                              );
                  echo form_input($data);
                echo"</div>";
                echo form_error('admin_confirm_password','<div class="error_message error_message_hidden">','</div>');
              echo"</div>";

            echo"<div class='form_container col-md-12'>";
              echo"<div class='form-group'>";
                $data = array('name' => 'submit_form',
                              'class' => 'btn btn-primary btn-sm col',
                              'value' => lang('submit')
                            );
                echo form_submit($data);
              echo"</div>";
            echo"</div>";

            echo form_fieldset_close();
        echo form_close();
/////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////// modify admin
        $attributes = array('id' => 'add_modify_form',
                            'class' => 'admin_form modify hidden_form'
                            );
       echo form_open(ADMINPATH.'/admin/p_update', $attributes);

         echo"<a href='' class='glyphicon glyphicon-remove cross'></a>";
            $attributes = array('class' => 'col-md-12 modify_fieldset fieldset');
            echo form_fieldset(lang('modify_admin'), $attributes);

                $data = array('name' => 'admin_id',
                              'id' => 'admin_id',
                              'class' => 'form-control',
                              'readonly' => 'readonly',
                              'type' => 'hidden',
                              'value' => $this->input->post('admin_id')
                            );
                echo form_input($data);

            echo"<div class='form-group'>";
              echo"<div class='input-group input-group-sm'>";
                    echo '<span class="input-group-addon lable">'.lang('admin_name').'</span>';
                    $data = array('name' => 'change_admin_name',
                                  'id' => 'change_admin_name',
                                  'class' => 'form-control',
                                  'value' =>set_value('change_admin_name')
                                );
                    echo form_input($data);
                echo"</div>";
                echo form_error('change_admin_name','<div class="error_message error_message_hidden">','</div>');
              echo"</div>";

              echo"<div class='form-group'>";
                echo"<div class='input-group input-group-sm'>";
                    echo '<span class="input-group-addon lable">'.lang('email').'</span>';
                    $data = array('name' => 'change_admin_email',
                                  'id' => 'change_admin_email',
                                  'class' => 'form-control',
                                  'value' => set_value('change_admin_email')
                                  
                                );
                    echo form_input($data);
                echo"</div>";
              echo form_error('change_admin_email','<div class="error_message error_message_hidden">','</div>');
              echo"</div>";
              echo"<div class='form-group'>";
                echo "<div class='input-group input-group-sm'>";
                  echo  "<span class='input-group-addon lable'>".lang('role')."</span>";
                  $js = 'id="change_admin_role" class="form-control"';
                  echo form_dropdown('change_admin_role', $admin_role, set_value('admin_role'), $js);
                echo "</div>";
                echo form_error('change_admin_role','<div class="error_message error_message_hidden">','</div>');
              echo"</div>";

             
              echo"<div class='form_container col-md-12'>";
                echo"<div class='form-group'>";
                echo"<a class='submit_form btn btn-primary btn-sm col'>".lang('modify')."</a>";
                  // $data = array('name' => 'submit_form',
                  //               'class' => 'btn btn-primary btn-sm col',
                  //               'value' => 'Modify'
                  //             );
                  // echo form_submit($data);
                echo"</div>";
              echo"</div>";
   
            echo form_fieldset_close();
        echo form_close();

//////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////// change password

        $attributes = array('id' => 'admin_change_password_form',
                            'class' => 'admin_form change hidden_form input_form'
                            );
      
       echo form_open(ADMINPATH.'/admin/p_update_password', $attributes);

         echo"<a href='' class='glyphicon glyphicon-remove cross'></a>";
            $attributes = array('class' => 'col-md-12 change_fieldset fieldset');
            echo form_fieldset(lang('change_admin_password'), $attributes);

                $data = array('name' => 'admin_id',
                              'id' => 'admin_id',
                              'class' => 'form-control',
                              'readonly' => 'readonly',
                              'type' => 'hidden',
                              'value' => $this->input->post('admin_id')
                            );
                echo form_input($data);


            echo"<div class='form-group'>";
              echo"<div class='input-group input-group-sm'>";
                  echo '<span class="input-group-addon lable">'.lang('current_passowrd').'</span>';
                  $data = array('name' => 'old_password',
                                'id' => 'old_password',
                                'class' => 'form-control',
                                'type' => 'password', 
                                'value' => set_value('old_password')
                              );
                  echo form_input($data);
              echo"</div>";
              echo form_error('old_password','<div class="error_message error_message_hidden">','</div>');
            echo"</div>";
                 
            echo"<div class='form-group'>";
              echo"<div class='input-group input-group-sm'>";
                  echo '<span class="input-group-addon lable">'.lang('new_passowrd').'</span>';
                  $data = array('name' => 'change_admin_password',
                                'id' => 'change_admin_password',
                                'class' => 'form-control',
                                'type' => 'password',
                                'value' => set_value('change_admin_password') 
                              );
                  echo form_input($data);
              echo"</div>";
              echo form_error('change_admin_password','<div class="error_message error_message_hidden">','</div>');
            echo"</div>";

            echo"<div class='form-group'>";
              echo"<div class='input-group input-group-sm'>";
                  echo '<span class="input-group-addon lable">'.lang('confirm_new_passowrd').'</span>';
                  $data = array('name' => 'change_admin_confirm_password',
                                'id' => 'change_admin_confirm_password',
                                'class' => 'form-control',
                                'type' =>'password' ,
                                'value' => set_value('change_admin_confirm_password')
                              );
                  echo form_input($data);
              echo"</div>";
              echo form_error('change_admin_confirm_password','<div class="error_message error_message_hidden">','</div>');
            echo"</div>";

              echo"<div class='form_container col-md-12'>";
                echo"<div class='form-group'>";
                  $data = array('name' => 'submit_form',
                                'class' => 'btn btn-primary btn-sm col',
                                'value' => lang('change')
                              );
                  echo form_submit($data);
                echo"</div>";
              echo"</div>";
   
            echo form_fieldset_close();
        echo form_close();

////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////// deactiave admin

         $attributes = array('id' => 'add_delete_form',
                            'class' => 'admin_form delete'
                            );

        $hidden = array('admin_id' => "");
        echo form_open(ADMINPATH.'/admin/p_update_status', $attributes, $hidden);

         echo"<a href='' class='glyphicon glyphicon-remove cross'></a>";
            $attributes = array('class' => 'col-md-12 delete_fieldset');
            echo form_fieldset(lang('deactive_admin'), $attributes);


            echo"<p><b>".lang('are_you_sure_you_want_deactive')."</b></p>";
            
            echo"<div class='form_container col-md-12'>";
              echo"<div class='form-group'>";
              $data = array('name' => 'submit',
                            'class' => 'btn btn-primary btn-sm col',
                            'value' => lang('delete')
                          );
              echo form_submit($data);
              echo"<button type='button' class='btn btn-primary btn-sm col cancel_delete'>".lang('cancel')."</button>";
              echo"</div>";
            echo"</div>";
   
            echo form_fieldset_close();
        echo form_close();
echo"</div>";
    ?>
<div class="confirm_con">
  <div class="content">
      <a href='' class='glyphicon glyphicon-remove cross'></a>
      <p><?=lang('are_you_sure')?></p>
      <input name="form_name" type="hidden">
      <a href="#" class="yes_btn btn btn-primary btn-sm col"><?=lang('yes')?></a>
      <a href="#" class="no_btn btn btn-primary btn-sm col"><?=lang('no')?></a>
  </div>
</div>
<script type="text/javascript">
  $(document).ready(function() {
     //back end error message
$(".hidden_form").each(function() {
  var error_message=$(this).find(".error_message_hidden").text();
  if(error_message!=""){
    var fieldset_height=$(this).find(".fieldset").height();
    var this_form=$(this).attr("id");
     $("#"+this_form).css("margin-top", -fieldset_height/2).animate({height: fieldset_height+10+"px"}, 500);
       $(".page_blank").animate({opacity: 1}, 500).css("pointer-events","all");
  }
});

$(".form-control").focus(function(){
  $(this).parents(".form-group").find(".error_message").text("");
});

  $('#add_admin_form')
      .bootstrapValidator({
          message: 'This value is not valid',
          feedbackIcons: {
              valid: 'glyphicon glyphicon-ok',
              invalid: 'glyphicon glyphicon-remove',
              validating: 'glyphicon glyphicon-refresh'
          },
          fields: {
              admin_name: {
                  validators: {
                      notEmpty: {
                          message: 'Please enter the admin name'
                      }
                  }
              },
              admin_email: {
                  validators: {
                      notEmpty: {
                          message: 'Please enter the admin email'
                      }
                  }
              },
              admin_role: {
                  validators: {
                      notEmpty: {
                          message: 'Please select the admin role'
                      }
                  }
              },
              admin_password: {
                  validators: {
                      notEmpty: {
                          message: 'Please enter the password'
                      },
                      stringLength: {
                        min: 6,
                         message: 'Password must be at least 6 characters in length'
                      },
                  }
              },
              admin_confirm_password: {
                  validators: {
                      notEmpty: {
                          message: 'Please enter the confirm password'
                      },
                      identical: {
                        field: 'admin_password',
                         message: 'The password and its confirm are not the same'
                      },
                  }
              },
              
          }
      })
      .on('error.field.bv', function(e, data) {
          console.log('error.field.bv -->', data);
      })
      .on('success.field.bv', function(e, data) {
          console.log('status.field.bv -->', data);

          var $form = $(e.target);
          // I don't want to add has-success class to valid field container
          data.element.parents('.form-group').removeClass('has-success');

          // I want to enable the submit button all the time
          //$form.data('bootstrapValidator').disableSubmitButtons(false);
      });

});


</script>