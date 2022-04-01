    <div class="content-w">
        <?php include 'fancy.php';?>
        <div class="header-spacer"></div>
        <div class="conty">
            <div class="os-tabs-w menu-shad">
                <div class="os-tabs-controls">
                    <ul class="navs navs-tabs upper">
                        <li class="navs-item">
                            <a class="navs-links" href="<?php echo base_url();?>admin/system_settings/"><i class="os-icon picons-thin-icon-thin-0050_settings_panel_equalizer_preferences"></i><span><?php echo getEduAppGTLang('system_settings');?></span></a>
                        </li>
                        <li class="navs-item">
                            <a class="navs-links" href="<?php echo base_url();?>admin/sms/"><i class="os-icon picons-thin-icon-thin-0287_mobile_message_sms"></i><span><?php echo getEduAppGTLang('sms');?></span></a>
                        </li>
                        <li class="navs-item">
                            <a class="navs-links " href="<?php echo base_url();?>admin/email/"><i class="os-icon picons-thin-icon-thin-0315_email_mail_post_send"></i><span><?php echo getEduAppGTLang('email_settings');?></span></a>
                        </li>
                        <li class="navs-item">
                            <a class="navs-links active" href="<?php echo base_url();?>admin/translate/"><i class="os-icon picons-thin-icon-thin-0307_chat_discussion_yes_no_pro_contra_conversation"></i><span><?php echo getEduAppGTLang('translate');?></span></a>
                        </li>
                        <li class="navs-item">
                            <a class="navs-links" href="<?php echo base_url();?>admin/database/"><i class="picons-thin-icon-thin-0356_database"></i><span><?php echo getEduAppGTLang('database');?></span></a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="content-i">
                <div class="content-box">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="element-box shadow shadow lined-primary" style="border-radius:10px;">
                                <button class="btn btn-rounded btn-success" data-toggle="modal" data-target="#addlang"><?php echo getEduAppGTLang('add_language');?></button><hr>
                                <?php if (isset($edit_profile)):?>
                                <?php $current_editing_language = $edit_profile;?>
                                <div class="row" >
                                    <input type="hidden" name="current" value="<?php echo $current_editing_language;?>" id="current">
                                    <?php 
                                        $count = 1;
                                        $language_phrases = $this->db->query("SELECT `phrase_id` , `phrase` , `$current_editing_language` FROM `language`")->result_array();
                                        foreach($language_phrases as $row)
                                        {
                                          $count++;
                                          $phrase_id      = $row['phrase_id'];          
                                          $phrase       = $row['phrase'];           
                                          $phrase_language  = $row[$current_editing_language];  
                                        ?>
                                    <div class="col-sm-3">
                                        <div class="element-box infodash centered padded" style="background: #a01a7a; border-radius:15px;">
                                            <div class="bg-icon">
                                                <i class="icon-ghost"></i>
                                            </div>
                                            <div><h4 style="color: #FFF;"><?php echo $row['phrase'];?></h4></div>
                                            <input class="form-control" id="phrase-<?php echo $row['phrase'];?>" value="<?php echo $phrase_language;?>" type="text" name="phrase<?php echo $row['phrase_id'];?>" style="border-radius:5px; background-color:#fff;">
                                            <button class="btn btn-success" onclick="updateLang('<?php echo $row['phrase'];?>')" id="btn-<?php echo $row['phrase'];?>"><i class="picons-thin-icon-thin-0154_ok_successful_check"></i></button>
                                        </div>
                                    </div>
                                <?php } ?>
                                </div>
                            <?php endif;?>

                            <?php if (!isset($edit_profile)):?>
                                <div class="col-md-12">
                                    <div class="full-chat-middle">
                                        <div class="chat-content-w min">
                                            <div class="chat-content min">
                                                <div class="users-list-w">
                                                <?php $number = count($this->db->list_fields('language'))-1;
                                                    $data = $this->db->list_fields('language');
                                                    for($i = 2; $i <= $number; $i++):
                                                ?>
                                                    <div class="user-w">
                                                        <div class="user-avatar-w">
                                                            <div class="user-avatar">
                                                                <img alt="" src="<?php echo base_url();?>public/style/flags/<?php echo $data[$i];?>.png">
                                                            </div>
                                                        </div>
                                                        <div class="user-name">
                                                            <h6 class="user-title"><?php echo ucwords($data[$i]);?></h6>
                                                        </div>        
                                                        <a class="btn btn-rounded  btn-primary" href="<?php echo base_url();?>admin/translate/update/<?php echo $data[$i];?>"><i class="picons-thin-icon-thin-0307_chat_discussion_yes_no_pro_contra_conversation"></i> <?php echo getEduAppGTLang('update');?></a>
                                                    </div>
                                                <?php endfor;?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endif;?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="addlang" tabindex="-1" role="dialog" aria-labelledby="addlang" aria-hidden="true" style="margin-top: 150px;">
        <div class="modal-dialog window-popup edit-widget edit-widget-twitter" role="document">
            <div class="modal-content">
                <div class="modal-header" style="background-color:#00579c">
                    <h6 class="title" style="color:white"><?php echo getEduAppGTLang('add_language');?></h6>
                    <a href="javascript:void(0);" class="more" aria-label="Close" class="close" data-dismiss="modal"><i class="icon-feather-x"></i></a>
                </div>
                <div class="modal-body">
                    <?php echo form_open(base_url() . 'admin/translate/add/', array('enctype' => 'multipart/form-data')); ?>
                        <div class="form-group label-floating is-empty">
                            <label class="control-label"><?php echo getEduAppGTLang('name');?></label>
                            <input class="form-control" name="language" type="text">
                        </div>   
                        <div class="form-group">
                            <label class="control-label"><?php echo getEduAppGTLang('flag');?></label>
                            <input class="form-control" name="file_name" type="file">
                        </div>
                        <button class="btn btn-rounded btn-purple  btn-icon-left" type="submit"><?php echo getEduAppGTLang('save');?></button></center>
                    <?php echo form_close();?>
                </div>
            </div>
        </div>
    </div>

    <script>
       function updateLang(id) 
       {
            var language    = $('#current').val();
            var phrase_key  = id;
            var phrase      = $('#phrase-'+id).val();
            $.ajax({
                type:'post',
                url:'<?php echo base_url();?>admin/translate/update_language/'+language,
                data:{phrase_key:phrase_key,phrase:phrase},
                success:function(msg){
                    const Toast = Swal.mixin({
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 8000
                    }); 
                    Toast.fire({
                        type: 'success',
                        title: 'Update'
                    })
                }
            })
        }
    </script>