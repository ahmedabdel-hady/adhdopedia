<?php $fancy_count = $this->db->get_where('notification', array('user_id' => $this->session->userdata('login_user_id'), 'user_type' => $this->session->userdata('login_type'), 'status' => '0'));?>
<?php $fancy_number = $this->crud->count_unread_messages();?>
<?php $fc_info = base64_decode($data); $fc_ex = explode('-', $fc_info); ?>
<?php $fancy_cl_id = $this->db->get_where('enroll', array('student_id' => $fc_ex[3]))->row()->class_id;
$fancy_sec_id = $this->db->get_where('enroll', array('student_id' => $fc_ex[3]))->row()->section_id;?>
<?php $fancy_section_id = $this->db->get_where('enroll', array('student_id' => $fc_ex[3]))->row()->section_id;?>
    <header class="header" id="site-header">
    <?php if($page_name == 'subject_dashboard' || $page_name == 'online_exams' || $page_name == 'homework' || $page_name == 'forum' || $page_name == 'study_material' || $page_name == 'subject_marks'):?>
        <div class="page-title">
            <div class="fancy-selector-w">
                <div class="fancy-selector-current">
                    <div class="fs-img">
                        <img alt="" src="<?php echo base_url();?>public/uploads/subject_icon/<?php echo $this->db->get_where('subject', array('subject_id' => $fc_ex[2]))->row()->icon;?>">
                    </div>
                    <div class="fs-main-info">
                        <div class="fs-name"><?php echo $this->db->get_where('subject', array('subject_id' => $fc_ex[2]))->row()->name;?></div>
                    </div>
                    <div class="fs-selector-trigger">
                        <i class="ti-angle-down"></i>
                    </div>  
                </div>
                <div class="fancy-selector-options active">
                <?php 
                    $fancy_subjects = $this->db->get_where('subject', array('class_id' => $fancy_cl_id, 'section_id' => $fancy_sec_id))->result_array();
                    foreach($fancy_subjects as $fancy_row2):
                ?>
                    <a href="<?php echo base_url();?>parents/subject_dashboard/<?php echo base64_encode($fancy_cl_id.'-'.$fancy_section_id.'-'.$fancy_row2['subject_id'].'-'.$fc_ex[3]);?>/">
                        <div class="fancy-selector-option">
                            <div class="fs-img">
                                <img alt="" src="<?php echo base_url();?>public/uploads/subject_icon/<?php echo $fancy_row2['icon'];?>">
                            </div>
                            <div class="fs-main-info">
                                <div class="fs-name">
                                    <?php echo $fancy_row2['name'];?>
                                </div>
                            </div>
                        </div>
                    </a>
                    <?php endforeach;?>
                </div>
            </div>
        </div>
        <?php endif;?>
        <div class="header-content-wrapper">
            <div class="control-block">
                <div class="control-icon more has-items">
                    <i class="picons-thin-icon-thin-0275_chat_message_comment_bubble_typing"></i>
                    <?php if($fancy_number > 0):?><div class="label-avatar bg-success"><?php echo $fancy_number;?></div><?php endif;?>
                    <div class="more-dropdown more-with-triangle triangle-top-center">
                        <div class="mCustomScrollbar" data-mcs-theme="dark">
                            <ul class="notification-list chat-message">
                            <?php 
                                $fancy_current_user = $this->session->userdata('login_type') . '-' . $this->session->userdata('login_user_id');
                                $fancy_message_threads = $this->crud->getFancyChat();
                                foreach ($fancy_message_threads as $fancy_rows):
                                if ($fancy_rows['sender'] == $fancy_current_user)
                                {
                                    $fancy_user_to_show = explode('-', $fancy_rows['reciever']);
                                }
                                if ($fancy_rows['reciever'] == $fancy_current_user)
                                {
                                    $fancy_user_to_show = explode('-', $fancy_rows['sender']);
                                }
                                $fancy_user_to_show_type = $fancy_user_to_show[0];
                                $fancy_user_to_show_id = $fancy_user_to_show[1];
                                $unread_message_number = $this->crud->count_unread_message_of_thread($fancy_rows['message_thread_code']);
                            ?>
                                <?php $this->db->where('message_thread_code',$fancy_rows['message_thread_code']); $rw= $this->db->get('message')->last_row();?>
                                <?php $dbinfos = explode('-',$rw->sender);?>
                                <li class="message-unread">
                                    <div class="author-thumb">
                                        <img src="<?php echo $this->crud->get_image_url($fancy_user_to_show_type, $fancy_user_to_show_id);?>" width="35px">
                                    </div>
                                    <div class="notification-event">
                                        <a href="<?php echo base_url();?>parents/message/message_read/<?php echo $fancy_rows['message_thread_code'];?>/" class="h6 notification-friend"><?php echo $this->crud->get_name($fancy_user_to_show_type, $fancy_user_to_show_id);?></a>
                                        <span class="chat-message-item" style="text-align: justify;"><?php if($rw->sender == $fancy_current_user) echo getEduAppGTLang('you').": " .substr($rw->message, 0, 90).'...'; else echo substr($rw->message, 0, 90);?>...</span>
                                        <span class="notification-date"><time class="entry-date updated"><?php echo $rw->timestamp;?></time></span>
                                    </div>
                                </li>
                            <?php endforeach;?>
                            </ul>
                        </div>
                        <a href="<?php echo base_url();?>parents/message/" class="view-all bg-info"><?php echo getEduAppGTLang('view_all_messages');?></a>
                    </div>
                </div>
                <div class="control-icon more has-items">
                    <i class="picons-thin-icon-thin-0543_world_earth_worldwide_location_travel"></i>
                    <?php if($fancy_count->num_rows() > 0):?><div class="label-avatar bg-success"> <?php echo $fancy_count->num_rows();?> </div><?php endif;?>
                    <div class="more-dropdown more-with-triangle triangle-top-center">
                        <div class="mCustomScrollbar" data-mcs-theme="dark">
                            <ul class="notification-list">
                                <?php 
                                    $n = $this->crud->fetchNotifications();
                                    foreach($n as $fancy_notify):
                                ?>
                                <li>
                                    <div class="author-thumb">
                                        <img alt="" src="<?php echo base_url();?>public/uploads/notify.svg" width="35px">
                                    </div>
                                    <div class="notification-event">
                                        <div>
                                            <a href="<?php echo base_url();?><?php echo $fancy_notify['url'];?><?php if($fancy_notify['status'] == 0) {echo "?id=".$fancy_notify['id'];}?>" class="h6 notification-friend"> <?php echo $fancy_notify['notify'];?></a>
                                        </div>
                                        <span class="notification-date"><time class="entry-date updated"><?php echo $fancy_notify['date'];?> <?php echo getEduAppGTLang('at');?> <?php echo $fancy_notify['time'];?></time></span>
                                    </div>
                                </li>
                            <?php endforeach;?>
                            </ul>
                        </div>
                        <a href="<?php echo base_url();?>parents/notifications/" class="view-all bg-info"><?php echo getEduAppGTLang('view_all_notifications');?></a>
                    </div>
                </div>
                <div class="author-page author vcard inline-items more">
                    <div class="author-thumb">
                        <img alt="author" src="<?php echo $this->crud->get_image_url('parent', $this->session->userdata('login_user_id'));?>" class="avatar bg-white" width="32px">
                        <div class="more-dropdown more-with-triangle">
                            <div class="mCustomScrollbar" data-mcs-theme="dark">
                                <ul class="account-settings">
                                    <li>
                                        <a href="<?php echo base_url();?>parents/my_profile/">
                                            <i class="picons-thin-icon-thin-0699_user_profile_avatar_man_male"></i>
                                            <span><?php echo getEduAppGTLang('my_account');?></span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="<?php echo base_url();?>login/logout/">
                                            <i class="picons-thin-icon-thin-0040_exit_logout_door_emergency_outside"></i>
                                            <span><?php echo getEduAppGTLang('logout');?></span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <a href="#" class="author-name fn">
                        <div class="author-title">
                            <?php echo $this->crud->get_name('parent', $this->session->userdata('login_user_id'));?> <svg class="olymp-dropdown-arrow-icon"><use xlink:href="<?php echo base_url();?>public/style/olapp/svg-icons/sprites/icons.svg#olymp-dropdown-arrow-icon"></use></svg>
                        </div>
                        <span class="author-subtitle"><?php echo ucwords($this->session->userdata('login_type'));?></span>
                    </a>
                </div>
            </div>
        </div>
    </header>
    <header class="header header-responsive" id="site-header-responsive">
        <div class="header-content-wrapper">
            <ul class="nav nav-tabs mobile-app-tabs" role="tablist">
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#chat" role="tab">
                        <div class="control-icon has-items">
                            <i class="picons-thin-icon-thin-0275_chat_message_comment_bubble_typing"></i>
                            <?php if($fancy_number > 0):?><div class="label-avatar bg-success"><?php echo $fancy_number;?></div><?php endif;?>
                        </div>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#notification" role="tab">
                        <div class="control-icon has-items">
                            <i class="picons-thin-icon-thin-0543_world_earth_worldwide_location_travel"></i>
                            <div class="label-avatar bg-success"><?php if($fancy_count->num_rows() > 0):?> <?php echo $fancy_count->num_rows();?> <?php endif;?></div>
                        </div>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#autor" role="tab">
                        <div class="author-page author vcard inline-items more " style="margin-top:-16px">
                            <div class="author-thumb imgs">
                                <img alt="author" src="<?php echo $this->crud->get_image_url($this->session->userdata('login_type'), $this->session->userdata('login_user_id'));?>" class="avatar bg-white" width="35px">
                            </div>  
                        </div>
                    </a>
                </li>
            </ul>
        </div>
        <div class="tab-content tab-content-responsive">
            <div class="tab-pane " id="chat" role="tabpanel">
                <div class="mCustomScrollbar" data-mcs-theme="dark">
                    <ul class="notification-list chat-message">
                    <?php 
                        $fancy_current_user = $this->session->userdata('login_type') . '-' . $this->session->userdata('login_user_id');
                        $fancy_message_threads = $this->crud->getFancyChat();
                        foreach ($fancy_message_threads as $row1):
                        if ($row1['sender'] == $fancy_current_user)
                        {
                            $fancy_user_to_show = explode('-', $row1['reciever']);
                        }
                        if ($row1['reciever'] == $fancy_current_user)
                        {
                            $fancy_user_to_show = explode('-', $row1['sender']);
                        }
                        $fancy_user_to_show_type = $fancy_user_to_show[0];
                        $fancy_user_to_show_id = $fancy_user_to_show[1];
                        $unread_message_number = $this->crud->count_unread_message_of_thread($row1['message_thread_code']);
                    ?>
                        <?php $this->db->where('message_thread_code',$row1['message_thread_code']); $rw= $this->db->get('message')->last_row();?>
                        <?php $dbinf = explode('-',$rw->sender);?>
                        <li class="message-unread">
                            <div class="author-thumb">
                                <img src="<?php echo $this->crud->get_image_url($fancy_user_to_show_type, $fancy_user_to_show_id);?>" width="35px">
                            </div>
                            <div class="notification-event">
                                <a href="<?php echo base_url();?>parents/message/message_read/<?php echo $row1['message_thread_code'];?>/" class="h6 notification-friend"><?php echo $this->crud->get_name($fancy_user_to_show_type, $fancy_user_to_show_id);?></a>
                                <span class="chat-message-item" style="text-align: justify;"><?php if($rw->sender == $fancy_current_user) echo getEduAppGTLang('you').": ". substr($rw->message, 0, 90).'...'; else echo substr($rw->message, 0, 90);?>...</span>
                                <span class="notification-date"><time class="entry-date updated"><?php echo $rw->timestamp;?></time></span>
                            </div>
                        </li>
                    <?php endforeach;?>
                    </ul>
                    <a href="<?php echo base_url();?>parents/message/" class="view-all bg-info"><?php echo getEduAppGTLang('view_all_messages');?></a>
                </div>
            </div>
            <div class="tab-pane " id="notification" role="tabpanel">
                <div class="mCustomScrollbar" data-mcs-theme="dark">
                    <ul class="notification-list">
                    <?php 
                        $n = $this->crud->fetchNotifications();
                        foreach($n as $fancy_notify):
                    ?>
                        <li>
                            <div class="author-thumb">
                                <img alt="" src="<?php echo base_url();?>public/uploads/notify.svg" width="35px">
                            </div>
                            <div class="notification-event">
                                <div>
                                    <a href="<?php echo base_url();?><?php echo $fancy_notify['url'];?><?php if($fancy_notify['status'] == 0) {echo "?id=".$fancy_notify['id'];}?>" class="h6 notification-friend"> <?php echo $fancy_notify['notify'];?></a>
                                </div>
                                <span class="notification-date"><time class="entry-date updated"><?php echo $fancy_notify['date'];?> <?php echo getEduAppGTLang('at');?> <?php echo $fancy_notify['time'];?></time></span>
                            </div>
                        </li>
                    <?php endforeach;?>
                    </ul>
                    <a href="<?php echo base_url();?>parents/notifications/" class="view-all bg-info"><?php echo getEduAppGTLang('view_all_notifications');?></a>
                </div>
            </div>
            <div class="tab-pane " id="autor" role="tabpanel">
                <div class="mCustomScrollbar" data-mcs-theme="dark">
                    <ul class="account-settings">
                        <li>
                            <a href="<?php echo base_url();?>parents/my_profile/">
                                <i class="picons-thin-icon-thin-0699_user_profile_avatar_man_male"></i>
                                <span><?php echo getEduAppGTLang('my_account');?></span>
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo base_url();?>login/logout/">
                                <i class="picons-thin-icon-thin-0040_exit_logout_door_emergency_outside"></i>
                                <span><?php echo getEduAppGTLang('logout');?></span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </header>