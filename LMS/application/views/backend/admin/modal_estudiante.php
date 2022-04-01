<?php  $edit_data = $this->db->get_where('student' , array('student_id' => $param2) )->result_array();
        foreach($edit_data as $row):
?>    
    <div class="modal-body">
        <div class="modal-header" style="background-color:#00579c">
            <h6 class="title" style="color:white"><?php echo getEduAppGTLang('update_information');?></h6>
        </div>
        <div class="ui-block-content">
            <?php echo form_open(base_url() . 'admin/student/do_updates/'.$row['student_id'], array('enctype' => 'multipart/form-data')); ?>
                <div class="row">
                    <div class="col col-lg-12 col-md-12 col-sm-12 col-12">
                        <div class="form-group">
                            <label class="control-label"><?php echo getEduAppGTLang('photo');?></label>
                            <input name="userfile" accept="image/x-png,image/gif,image/jpeg" id="imgpre" type="file"/>
                        </div>
                    </div>
                    <div class="col col-lg-6 col-md-6 col-sm-12 col-12">
                        <div class="form-group label-floating">
                            <label class="control-label"><?php echo getEduAppGTLang('first_name');?></label>
                            <input class="form-control" type="text" name="first_name" required="" value="<?php echo $row['first_name'];?>">
                        </div>
                    </div>
                    <div class="col col-lg-6 col-md-6 col-sm-12 col-12">
                        <div class="form-group label-floating">
                            <label class="control-label"><?php echo getEduAppGTLang('last_name');?></label>
                            <input class="form-control" type="text" required="" name="last_name" value="<?php echo $row['last_name'];?>">
                        </div>
                    </div>
                    <div class="col col-lg-6 col-md-6 col-sm-12 col-12">
                        <div class="form-group label-floating">
                            <label class="control-label"><?php echo getEduAppGTLang('username');?></label>
                            <input class="form-control" type="text" name="username" required="" value="<?php echo $row['username'];?>">
                        </div>
                    </div>
                    <div class="col col-lg-6 col-md-6 col-sm-12 col-12">
                        <div class="form-group label-floating">
                            <label class="control-label"><?php echo getEduAppGTLang('password');?></label>
                            <input class="form-control" type="password" name="password">
                        </div>
                    </div>
                    <div class="col col-lg-6 col-md-6 col-sm-12 col-12">
                        <div class="form-group label-floating">
                            <label class="control-label"><?php echo getEduAppGTLang('email');?></label>
                            <input class="form-control" type="email" name="email" id="emailx" value="<?php echo $row['email'];?>">
                            <small><span id="result_emailx"></span></small>
                            <span class="input-group-addon">
                            <i class="icon-feather-mail"></i>
                            </span>
                        </div>
                    </div>
                    <div class="col col-lg-6 col-md-6 col-sm-12 col-12">
                        <div class="form-group label-floating">
                            <label class="control-label"><?php echo getEduAppGTLang('phone');?></label>
                            <input class="form-control" placeholder="" name="phone" type="text" value="<?php echo $row['phone'];?>">
                            <span class="input-group-addon">
                                <i class="icon-feather-phone"></i>
                            </span>
                        </div>
                    </div>
                    <div class="col col-lg-6 col-md-6 col-sm-12 col-12">
                        <div class="form-group label-floating is-select">
                            <label class="control-label"><?php echo getEduAppGTLang('parent');?></label>
                            <div class="select">
                                <select name="parent_id">
                                    <option value=""><?php echo getEduAppGTLang('select');?></option>
                                    <?php $parents = $this->db->get('parent')->result_array();
                                        foreach($parents as $rows):
                                    ?>
                                        <option value="<?php echo $rows['parent_id'];?>" <?php if($rows['parent_id'] == $row['parent_id']) echo 'selected';?>><?php echo $rows['first_name'];?> <?php echo $rows['last_name'];?></option>
                                    <?php endforeach;?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col col-lg-6 col-md-6 col-sm-12 col-12">
                        <div class="form-group label-floating is-select">
                            <label class="control-label"><?php echo getEduAppGTLang('status');?></label>
                            <div class="select">
                                <select name="student_session">
                                    <option value=""><?php echo getEduAppGTLang('select');?></option>
                                    <option value="1" <?php if($row['student_session'] == 1) echo 'selected';?>><?php echo getEduAppGTLang('active');?></option>
                                    <option value="2" <?php if($row['student_session'] != 1) echo 'selected';?>><?php echo getEduAppGTLang('inactive');?></option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col col-lg-12 col-md-12 col-sm-12 col-12">
                        <div class="form-group label-floating">
                            <label class="control-label"><?php echo getEduAppGTLang('address');?></label>
                            <input class="form-control" placeholder="" name="address" type="text" value="<?php echo $row['address'];?>">
                            <span class="input-group-addon">
                                <i class="icon-feather-map-pin"></i>
                            </span>
                        </div>
                    </div>
                    <div class="col col-lg-6 col-md-6 col-sm-12 col-12">
                        <button class="btn btn-rounded btn-success btn-lg " id="sub_form" type="submit"><?php echo getEduAppGTLang('update');?></button>
                    </div>
                </div>
            <?php echo form_close();?>
        </div>
    </div>
<?php endforeach;?>

    <script type="text/javascript">
        $(document).ready(function(){         
            var query;          
            $("#emailx").keyup(function(e){
                query = $("#emailx").val();
                $("#result_emailx").queue(function(n) {                     
                    $.ajax({
                        type: "POST",
                        url: '<?php echo base_url();?>register/search_email',
                        data: "c="+query,
                        dataType: "html",
                        error: function(){
                            alert("¡Error!");
                        },
                        success: function(data)
                        { 
                            if (data == "success") 
                            {            
                                texto = "<b style='color:#ff214f'><?php echo getEduAppGTLang('email_already_exist');?></b>"; 
                                $("#result_emailx").html(texto);
                                $('#sub_form').attr('disabled','disabled');
                            }
                            else { 
                                texto = ""; 
                                $("#result_emailx").html(texto);
                                $('#sub_form').removeAttr('disabled');
                            }
                            n();
                        }
                    });                           
                });                       
            });                       
        });
    </script>