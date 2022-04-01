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
                            <a class="navs-links" href="<?php echo base_url();?>admin/translate/"><i class="os-icon picons-thin-icon-thin-0307_chat_discussion_yes_no_pro_contra_conversation"></i><span><?php echo getEduAppGTLang('translate');?></span></a>
                        </li>
                        <li class="navs-item">
                            <a class="navs-links active" href="<?php echo base_url();?>admin/database/"><i class="picons-thin-icon-thin-0356_database"></i><span><?php echo getEduAppGTLang('database');?></span></a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="content-i">
                <div class="content-box">
                    <div class="element-box lined-purple shadow" style="border-radius:10px;">
                        <h4 class="form-header"><i class="picons-thin-icon-thin-0356_database"></i> <?php echo getEduAppGTLang('backup_restore');?></h4><br>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="ui-block" data-mh="friend-groups-item" style="">
                                    <div class="friend-item friend-groups">
                                        <div class="friend-item-content">
                                            <div class="friend-avatar">
                                                <div class="author-thumb">
                                                    <img src="<?php echo base_url();?>public/uploads/icons/backup.svg" width="110px" style="background-color:#fff;padding:15px; border-radius:0px;">
                                                </div>
                                                <div class="author-content">
                                                    <a href="<?php echo base_url();?>admin/database/create/" class="h5 author-name"><?php echo getEduAppGTLang('generate_backup');?></a>
                                                </div>
                                            </div>
                                            <div class="control-block-button">
                                                <a href="<?php echo base_url();?>admin/database/create/" class="btn btn-control bg-success text-white"><i class="picons-thin-icon-thin-0123_download_cloud_file_sync"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="ui-block" data-mh="friend-groups-item" style="">
                                    <div class="friend-item friend-groups">
                                        <div class="friend-item-content">
                              	            <?php echo form_open(base_url() . 'admin/database/restore', array('enctype' => 'multipart/form-data'));?>
                                                <div class="friend-avatar">
                                                    <div class="author-thumb">
                                                        <img src="<?php echo base_url();?>public/uploads/icons/restore.svg" width="110px" style="background-color:#fff;padding:15px; border-radius:0px;">
                                                    </div>
                                                    <div class="author-content">
                                                        <a href="javascript:void(0);" class="h5 author-name"><?php echo getEduAppGTLang('import_backup');?></a>
                                                    </div>
                                                </div>
                                                <div class="control-block-button">
                                                    <center><input id="upload3" type="file" name="file_name" style="background-color: #99bf2d; width:250px;"></center>
                                                </div>
                                                <div class="control-block-button">
                                                    <button type="submit" class="btn btn-control bg-primary text-white"><i class="picons-thin-icon-thin-0124_upload_cloud_file_sync_backup"></i></button>
                                                </div>
                                            <?php echo form_close();?>
                                        </div>
                                    </div>
                                </div>
                            </div>                          
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>