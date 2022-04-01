<?php $title = $this->crud->getInfo('system_title'); ?>
<style>
    body{
        font-family: 'Poppins', sans-serif;
        font-weight: 800;
        -webkit-font-smoothing: antialiased;
        text-rendering: optimizeLegibility; 
    }
</style>
<!DOCTYPE html>
<html>
  <head>
    <title><?php echo getEduAppGTLang('create_account');?> | <?php echo $title;?></title>
    <meta charset="utf-8">
    <meta content="ie=edge" http-equiv="x-ua-compatible">
    <meta content="width=device-width, initial-scale=1" name="viewport">
    <link href="https://fonts.googleapis.com/css?family=Rubik:300,400,500" rel="stylesheet" type="text/css">
    <link href="<?php echo base_url();?>public/style/cms/bower_components/perfect-scrollbar/css/perfect-scrollbar.min.css" rel="stylesheet">
    <link href="<?php echo base_url();?>public/style/cms/icon_fonts_assets/simple-line-icons/css/simple-line-icons.css" rel="stylesheet">
    <link href="<?php echo base_url();?>public/style/cms/icon_fonts_assets/picons-thin/style.css" rel="stylesheet">
    <link href="<?php echo base_url();?>public/uploads/<?php echo $this->crud->getInfo('favicon');?>" rel="icon">
    <link href="<?php echo base_url();?>public/style/cms/css/main.css?version=3.1" rel="stylesheet">
    <script src="<?php echo base_url();?>public/style/js/sweetalert2.all.min.js"></script> 
    <link href="<?php echo base_url();?>public/style/picker.css" rel="stylesheet" type="text/css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  </head>
<body class="auth-wrapper login" style="background: url('<?php echo base_url();?>public/uploads/bglogin.jpg');background-size: cover;background-repeat: no-repeat;">
    <div class="auth-box-w register" style="margin-bottom:2rem;">
        <div class="logo-wy">
            <a href="<?php echo base_url();?>"><img alt="" src="<?php echo base_url();?>public/uploads/<?php echo $this->crud->getInfo('logo');?>" width="30%"></a>
        </div>
        <div class="content-i">
            <div class="content-box" style="padding-bottom:0px">
                <div class="tab-content">
                    <div class="os-tabs-w">
                        <div class="os-tabs-controls">
                            <ul class="navs navs-tabs upper centered">
                                <li class="navs-item">
                                    <a class="navs-links active text-center" style="" data-toggle="tab" href="#teachers"><i class="picons-thin-icon-thin-0704_users_profile_group_couple_man_woman"></i><span><?php echo getEduAppGTLang('teacher');?></span></a>
                                </li>
                                <li class="navs-item">
                                    <a class="navs-links text-center" data-toggle="tab" href="#students"><i class="picons-thin-icon-thin-0729_student_degree_science_university_school_graduate"></i><span><?php echo getEduAppGTLang('student');?></span></a>
                                </li>
                                <li class="navs-item">
                                    <a class="navs-links text-center" data-toggle="tab" href="#parents"><i class="picons-thin-icon-thin-0703_users_profile_group_two"></i><span><?php echo getEduAppGTLang('parent');?></span></a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="tab-pane active" id="teachers">
                        <div class="col-lg-12">
                            <div class="element-wrapper">
                                <?php echo form_open(base_url() . 'register/create_account/teacher/' , array('enctype' => 'multipart/form-data'));?>
                                    <div class="form-group row">
                                        <div class="col-sm-12">
                                            <div class="input-group">
                                                <div class="input-group-addon">
                                                    <i class="picons-thin-icon-thin-0701_user_profile_avatar_man_male"></i>
                                                </div>
                                                <input class="form-control" placeholder="<?php echo getEduAppGTLang('first_name');?>" name="first_name" required="" type="text">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-12">
                                            <div class="input-group">
                                                <div class="input-group-addon">
                                                    <i class="picons-thin-icon-thin-0701_user_profile_avatar_man_male"></i>
                                                </div>
                                                <input class="form-control" placeholder="<?php echo getEduAppGTLang('last_name');?>" name="last_name" required="" type="text">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-12">
                                            <div class="input-group">
                                                <div class="input-group-addon">
                                                    <i class="picons-thin-icon-thin-0313_email_at_sign"></i> 
                                                </div>
                                                <input class="form-control" placeholder="<?php echo getEduAppGTLang('username');?>" required=""  id="username" name="username" type="text">
                                            </div>
                                            <small><span id="result2"></span></small>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-12">
                                            <div class="input-group">
                                                <div class="input-group-addon">
                                                    <i class="picons-thin-icon-thin-0319_email_mail_post_card"></i>
                                                </div>
                                                <input class="form-control" placeholder="user@school.edu" name="email" required=""e type="email">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-12">
                                            <div class="input-group">
                                                <div class="input-group-addon">
                                                    <i class="picons-thin-icon-thin-0289_mobile_phone_call_ringing_nfc"></i>
                                                </div>
                                                <input class="form-control" placeholder="<?php echo getEduAppGTLang('phone');?>" required="" name="phone" type="number">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-12">
                                            <div class="input-group">
                                                <div class="input-group-addon">
                                                    <i class="picons-thin-icon-thin-0447_gift_wrapping"></i>
                                                </div>
                                                <input type='text' class="datepicker-here form-control" name="birthday" placeholder="birthday" data-position="top left" data-language='en' data-multiple-dates-separator="/"/>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-12">
                                            <div class="form-check">
                                                <label class="form-check-label"><input checked="" class="form-check-input" name="sex" type="radio" value="M"><?php echo getEduAppGTLang('male');?></label>
                                                <label class="form-check-label"><input class="form-check-input" name="sex" type="radio" value="F" style="margin-left:5px;"><?php echo getEduAppGTLang('female');?></label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-12">
                                            <div class="input-group">
                                                <div class="input-group-addon">
                                                    <i class="picons-thin-icon-thin-0136_rotation_lock"></i>
                                                </div>   
                                                <input class="form-control" placeholder="<?php echo getEduAppGTLang('password');?>" name="password" type="password">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="buttons-w">
                                        <input class="btn btn-rounded btn-primary" id="sub_teacher" type="submit" value="<?php echo getEduAppGTLang('create_account');?>">
                                    </div>
                                <?php echo form_close();?>
                            </div>
                        </div>
                    </div>
            
                    <div class="tab-pane" id="students">
                        <div class="col-lg-12">
                            <div class="element-wrapper">
                                <?php echo form_open(base_url() . 'register/create_account/student/' , array('enctype' => 'multipart/form-data'));?>
                                    <div class="form-group row">
                                        <div class="col-sm-12">
                                            <div class="input-group">
                                                <div class="input-group-addon">
                                                    <i class="picons-thin-icon-thin-0701_user_profile_avatar_man_male"></i>
                                                </div>
                                                <input class="form-control" placeholder="<?php echo getEduAppGTLang('fist_name');?>" name="first_name" type="text">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-12">
                                            <div class="input-group">
                                                <div class="input-group-addon">
                                                    <i class="picons-thin-icon-thin-0701_user_profile_avatar_man_male"></i>
                                                </div>
                                                <input class="form-control" placeholder="<?php echo getEduAppGTLang('last_name');?>" name="last_name" type="text">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-12">
                                            <div class="input-group">
                                                <div class="input-group-addon">
                                                    <i class="picons-thin-icon-thin-0313_email_at_sign"></i> 
                                                </div>
                                                <input class="form-control" placeholder="<?php echo getEduAppGTLang('username');?>" id="user2" name="username" type="text">
                                            </div>
                                            <small><span id="result4"></span></small>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-12">
                                            <div class="input-group">
                                                <div class="input-group-addon">
                                                    <i class="picons-thin-icon-thin-0319_email_mail_post_card"></i>
                                                </div>
                                                <input class="form-control" placeholder="user@school.edu" name="email" required=""e type="email">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-12">
                                            <div class="input-group">
                                                <div class="input-group-addon">
                                                    <i class="picons-thin-icon-thin-0003_write_pencil_new_edit"></i>
                                                </div>
                                                <select class="form-control" name="class_id" onchange="get_sections(this.value);">
                                                    <option value=""><?php echo getEduAppGTLang('select');?></option>
                                                    <?php $classes = $this->db->get('class')->result_array();
                                                        foreach($classes as $class):
                                                    ?>
                                                    <option value="<?php echo $class['class_id'];?>"><?php echo $class['name'];?></option>
                                                    <?php endforeach;?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-12">
                                            <div class="input-group">
                                                <div class="input-group-addon">
                                                    <i class="picons-thin-icon-thin-0002_write_pencil_new_edit"></i>
                                                </div>
                                                <select class="form-control" id="section_holder" name="section_id">
                                                    <option value=""><?php echo getEduAppGTLang('select');?></option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-12">
                                            <div class="input-group">
                                                <div class="input-group-addon">
                                                    <i class="picons-thin-icon-thin-0714_identity_card_photo_user_profile"></i>
                                                </div>
                                                <input class="form-control" placeholder="<?php echo getEduAppGTLang('roll');?>" name="roll" type="text" required="">
                                            </div>
                                        </div>
                                   </div>
                                   <div class="form-group row">
                                        <div class="col-sm-12">
                                            <div class="input-group">
                                                <div class="input-group-addon">
                                                    <i class="picons-thin-icon-thin-0289_mobile_phone_call_ringing_nfc"></i>
                                                </div>
                                                <input class="form-control" placeholder="<?php echo getEduAppGTLang('phone');?>" name="phone" type="number">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-12">
                                            <div class="input-group">
                                                <div class="input-group-addon">
                                                    <i class="picons-thin-icon-thin-0447_gift_wrapping"></i>
                                                </div>
                                                <input type='text' class="datepicker-here form-control" name="birthday" placeholder="birthday" data-position="top left" data-language='en' data-multiple-dates-separator="/"/>
                                            </div>
                                        </div>
                                    </div>            
                                    <div class="form-group row">
                                        <div class="col-sm-12">
                                            <div class="form-check">
                                                <label class="form-check-label"><input checked="" class="form-check-input" name="sex" type="radio" value="M"><?php echo getEduAppGTLang('male');?></label>
                                                <label class="form-check-label"><input class="form-check-input" name="sex" type="radio" value="F" style="margin-left:5px;"><?php echo getEduAppGTLang('female');?></label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-12">
                                            <div class="input-group">
                                                <div class="input-group-addon">
                                                    <i class="picons-thin-icon-thin-0136_rotation_lock"></i>
                                                </div>   
                                                <input class="form-control" placeholder="<?php echo getEduAppGTLang('password');?>" name="password" required type="password">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="buttons-w">
                                        <input class="btn btn-rounded btn-primary" id="sub_student" type="submit" value="<?php echo getEduAppGTLang('create_account');?>">
                                    </div>
                                <?php echo form_close();?>
                            </div>
                        </div>
                    </div>
                        
                    <div class="tab-pane" id="parents">
                        <div class="col-lg-12">
                            <div class="element-wrapper">
                                <?php echo form_open(base_url() . 'register/create_account/parent/' , array('enctype' => 'multipart/form-data'));?>
                                    <div class="form-group row">
                                        <div class="col-sm-12">
                                            <div class="input-group">
                                                <div class="input-group-addon">
                                                    <i class="picons-thin-icon-thin-0701_user_profile_avatar_man_male"></i>
                                                </div>
                                                <input class="form-control" placeholder="<?php echo getEduAppGTLang('first_name');?>" required name="first_name" type="text">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-12">
                                            <div class="input-group">
                                                <div class="input-group-addon">
                                                    <i class="picons-thin-icon-thin-0701_user_profile_avatar_man_male"></i>
                                                </div>
                                                <input class="form-control" placeholder="<?php echo getEduAppGTLang('last_name');?>" required name="last_name" type="text">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-12">
                                            <div class="input-group">
                                                <div class="input-group-addon">
                                                    <i class="picons-thin-icon-thin-0313_email_at_sign"></i> 
                                                </div>
                                                <input class="form-control" placeholder="<?php echo getEduAppGTLang('username');?>" id="user5" required="" name="username" type="text">
                                            </div>
                                            <small><span id="result5"></span></small>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-12">
                                            <div class="input-group">
                                                <div class="input-group-addon">
                                                    <i class="picons-thin-icon-thin-0319_email_mail_post_card"></i>
                                                </div>
                                                <input class="form-control" placeholder="user@school.edu" name="email" required=""e type="email">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-12">
                                            <div class="input-group">
                                               <div class="input-group-addon">
                                                    <i class="picons-thin-icon-thin-0289_mobile_phone_call_ringing_nfc"></i>
                                                </div>
                                                <input class="form-control" placeholder="<?php echo getEduAppGTLang('phone');?>" name="phone" type="phone">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-12">
                                            <div class="input-group">
                                                <div class="input-group-addon">
                                                    <i class="picons-thin-icon-thin-0379_business_suitcase"></i>
                                                </div>
                                                <input class="form-control" placeholder="<?php echo getEduAppGTLang('profession');?>" name="profession" type="text">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-12">
                                            <div class="input-group">
                                                <div class="input-group-addon">
                                                    <i class="picons-thin-icon-thin-0136_rotation_lock"></i>
                                                </div>
                                                <input class="form-control" placeholder="<?php echo getEduAppGTLang('password');?>" name="password" required="" type="password">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="buttons-w">
                                        <input class="btn btn-rounded btn-primary" id="sub_parent" type="submit" value="<?php echo getEduAppGTLang('create_account');?>">
                                    </div>
                                <?php echo form_close();?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript">
       function get_sections(class_id) 
       {
          $.ajax({
                url: '<?php echo base_url();?>admin/get_class_section/' + class_id ,
                success: function(response)
                {
                    jQuery('#section_holder').html(response);
                }
            });
       }
    </script>
    <script src="<?php echo base_url();?>public/style/cms/bower_components/jquery/dist/jquery.min.js"></script>
    <script src="<?php echo base_url();?>public/style/cms/bower_components/moment/moment.js"></script>
    <script src="<?php echo base_url();?>public/style/cms/bower_components/tether/dist/js/tether.min.js"></script>
    <script src="<?php echo base_url();?>public/style/cms/bower_components/bootstrap-validator/dist/validator.min.js"></script>
    <script src="<?php echo base_url();?>public/style/cms/bower_components/perfect-scrollbar/js/perfect-scrollbar.jquery.min.js"></script>
    <script src="<?php echo base_url();?>public/style/cms/bower_components/bootstrap/js/dist/util.js"></script>
    <script src="<?php echo base_url();?>public/style/cms/bower_components/bootstrap/js/dist/tab.js"></script>
    <script src="<?php echo base_url();?>public/style/cms/js/main.js?version=3.2.1"></script>
    <script src="<?php echo base_url();?>public/style/js/picker.js"></script>
    <script src="<?php echo base_url();?>public/style/js/picker.en.js"></script>
    <script src="<?php echo base_url();?>public/style/cms/bower_components/dragula.js/dist/dragula.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    
    <?php if ($this->session->flashdata('flash_message') != ""):?>
        <script>
            const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 8000
            }); 
            Toast.fire({
            type: 'success',
            title: '<?php echo $this->session->flashdata("flash_message");?>'
            })
        </script>
    <?php endif;?>

    <script type="text/javascript">
        $(document).ready(function(){         
              var query;          
              $("#username").keyup(function(e){
                     query = $("#username").val();
                     $("#result2").queue(function(n) {                     
                                $.ajax({
                                      type: "POST",
                                      url: '<?php echo base_url();?>register/search_user',
                                      data: "c="+query,
                                      dataType: "html",
                                      error: function(){
                                            alert("¡Error!");
                                      },
                                      success: function(data)
                                      { 
                                        if (data == "success") 
                                        {            
                                            texto = "<b style='color:#ff214f'><?php echo getEduAppGTLang('already_exist');?></b>"; 
                                            $("#result2").html(texto);
                                            $('#sub_teacher').attr('disabled','disabled');
                                        }
                                        else { 
                                            texto = ""; 
                                            $("#result2").html(texto);
                                            $('#sub_teacher').removeAttr('disabled');
                                        }
                                        n();
                                      }
                          });                           
                     });                       
              });                       
        });

        $(document).ready(function(){         
              var query;          
              $("#user2").keyup(function(e){
                     query = $("#user2").val();
                     $("#result4").queue(function(n) 
                     {                     
                                $.ajax({
                                      type: "POST",
                                      url: '<?php echo base_url();?>register/search_user',
                                      data: "c="+query,
                                      dataType: "html",
                                      error: function(){
                                            alert("¡Error!");
                                      },
                                      success: function(data)
                                      { 
                                        if (data == "success") 
                                        {            
                                            texto = "<b style='color:#ff214f'><?php echo getEduAppGTLang('already_exist');?></b>"; 
                                            $("#result4").html(texto);
                                            $('#sub_student').attr('disabled','disabled');
                                        }
                                        else { 
                                            texto = ""; 
                                            $("#result4").html(texto);
                                            $('#sub_student').removeAttr('disabled');
                                        }
                                        n();
                                      }
                          });                           
                     });                       
              });                       
        });

        $(document).ready(function(){         
              var query;          
              $("#user5").keyup(function(e){
                     query = $("#user5").val();
                     $("#result5").queue(function(n) {                     
                                $.ajax({
                                      type: "POST",
                                      url: '<?php echo base_url();?>register/search_user',
                                      data: "c="+query,
                                      dataType: "html",
                                      error: function(){
                                            alert("¡Error!");
                                      },
                                      success: function(data)
                                      { 
                                        if (data == "success") 
                                        {            
                                            texto = "<b style='color:#ff214f'><?php echo getEduAppGTLang('already_exist');?></b>"; 
                                            $("#result5").html(texto);
                                            $('#sub_parent').attr('disabled','disabled');
                                        }
                                        else { 
                                            texto = ""; 
                                            $("#result5").html(texto);
                                            $('#sub_parent').removeAttr('disabled');
                                        }
                                        n();
                                      }
                          });                           
                     });                       
              });                       
        });
    </script>
  </body>
</html>