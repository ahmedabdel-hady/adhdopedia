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
                            <a class="navs-links active" href="<?php echo base_url();?>admin/email/"><i class="os-icon picons-thin-icon-thin-0315_email_mail_post_send"></i><span><?php echo getEduAppGTLang('email_settings');?></span></a>
                        </li>
                        <li class="navs-item">
                            <a class="navs-links" href="<?php echo base_url();?>admin/translate/"><i class="os-icon picons-thin-icon-thin-0307_chat_discussion_yes_no_pro_contra_conversation"></i><span><?php echo getEduAppGTLang('translate');?></span></a>
                        </li>
                        <li class="navs-item">
                            <a class="navs-links" href="<?php echo base_url();?>admin/database/"><i class="picons-thin-icon-thin-0356_database"></i><span><?php echo getEduAppGTLang('database');?></span></a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="content-i">
                <div class="content-box">
                    <div class="element-box shadow lined-success">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="os-tabs-w">
                                    <div class="os-tabs-controls">
                                        <ul class="navs navs-tabs">
                                        <?php 
                                            $email_templates  = $this->db->get('email_template')->result_array();
                                            foreach ($email_templates as $row):
                                        ?>
                                            <li class="navs-item">
                                                <a class="navs-link <?php if ($row['email_template_id'] == $current_email_template_id) echo 'active';?>" data-toggle="tab" href="#email<?php echo $row['email_template_id'];?>"> <b>[</b><?php echo getEduAppGTLang($row['task']);?><b>]</b></a>
                                            </li>
                                        <?php endforeach;?>
                                        </ul>
                                    </div>
                                </div>
                                <div class="tab-content">
                                    <?php foreach ($email_templates as $row): ?>
                                    <div class="tab-pane <?php if ($row['email_template_id'] == $current_email_template_id) echo 'active';?>" id="email<?php echo $row['email_template_id'];?>">
                                        <?php echo form_open(base_url() . 'admin/email/template/' . $row['email_template_id']);?>
                                            <h5 class="form-header"><?php echo getEduAppGTLang($row['task']);?></h5>
                                            <div class="form-group">
                                                <label for=""> <?php echo getEduAppGTLang('email_subject');?></label>
                                                <input class="form-control" name="subject" placeholder="" value="<?php echo $row['subject'];?>" type="text">
                                            </div>
                                            <div class="form-group">
                                                <label for=""> <?php echo getEduAppGTLang('email_body');?></label> 
                                                <textarea id="mymce" name="body" cols="100%" rows="10"><?php echo $row['body'];?></textarea>
                                            </div>
                                            <div class="form-buttons-w text-right">
                                                <button class="btn btn-rounded btn-success" type="submit"> <?php echo getEduAppGTLang('save');?></button>
                                            </div>
                                        <?php echo form_close();?>    
                                    </div>
                                <?php endforeach;?>  
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>