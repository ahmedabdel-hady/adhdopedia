    <div class="full-chat-middle">
        <div class="chat-head">
            <a class="back-to-index d-xl-none d-md-none megasize" href="<?php echo base_url();?>parents/message/"><i class="icon-feather-chevron-left"></i></a>          
            <div class="user-info">
                <h4><?php echo $this->db->get_where('group_message_thread', array('group_message_thread_code' => $current_message_thread_code))->row()->group_name; ?></h4>
                <a class="btn btn-success btn-sm" href="#" onclick="showAjaxModal('<?php echo base_url();?>modal/popup/group_info/<?php echo $current_message_thread_code;?>');"><?php echo getEduAppGTLang('group_members');?></a>
            </div>
        </div> 
        <div class="chat-content-w mCustomScrollbar">
            <div class="chat-content">
                <?php
                    $current_user = $this->session->userdata('login_type') . '-' . $this->session->userdata('login_user_id');
                    $messages = $this->db->get_where('group_message', array('group_message_thread_code' => $current_message_thread_code))->result_array();
                    foreach ($messages as $row):
                    $sender = explode('-', $row['sender']);
                    $sender_account_type = $sender[0];
                    $sender_id = $sender[1];
                ?>
                <?php if($row['sender'] != $current_user):?>
                <?php $recievers = $row['sender'];?>
                <div class="chat-message">
                    <div class="chat-message-content-w">
                        <div class="chat-message-content">
                            <?php echo $row['message']; ?>
                            <?php if($row['attached_file_name'] != ""):?><br>
                                 <a class="badge badge-primary" target="_blank" href="<?php echo base_url();?>public/uploads/group_messaging_attached_file/<?php echo $row['attached_file_name'];?>" style="color:white"><i class="picons-thin-icon-thin-0105_download_clipboard_box"></i>&nbsp;&nbsp;<?php echo $row['attached_file_name'];?></a>
                              <?php endif;?>
                        </div>
                    </div>
                    <div class="chat-message-avatar">
                        <img alt="" src="<?php echo $this->crud->get_image_url($sender_account_type, $sender_id); ?>">
                    </div>
                    <div class="chat-message-date">
                        <?php if($sender_account_type == 'admin'):?>
                          <span class="badge badge-primary"><?php echo $this->crud->get_name($sender_account_type, $sender_id);?></span>
                        <?php endif;?>

                        <?php if($sender_account_type == 'teacher'):?>
                          <span class="badge badge-success"><?php echo $this->crud->get_name($sender_account_type, $sender_id);?></span>
                        <?php endif;?>

                        <?php if($sender_account_type == 'student'):?>
                          <span class="badge badge-warning"><?php echo $this->crud->get_name($sender_account_type, $sender_id);?></span>
                        <?php endif;?>

                        <?php if($sender_account_type == 'parent'):?>
                          <span class="badge badge-danger"><?php echo $this->crud->get_name($sender_account_type, $sender_id);?></span>
                        <?php endif;?>

                        <?php if($sender_account_type == 'accountant'):?>
                          <span class="badge badge-purple"><?php echo $this->crud->get_name($sender_account_type, $sender_id);?></span>
                        <?php endif;?>

                        <?php if($sender_account_type == 'librarian'):?>
                          <span class="badge badge-info"><?php echo $this->crud->get_name($sender_account_type, $sender_id);?></span>
                        <?php endif;?>

                        <br>
                        <?php echo $row['timestamp'];?> 
                    </div>
                </div>
                <?php endif;?>
                <?php if($row['sender'] == $current_user):?>
                <div class="chat-message self">
                    <div class="chat-message-content-w">
                        <div class="chat-message-content">
                            <?php echo $row['message']; ?>
                            <?php if($row['attached_file_name'] != ""):?><br>
                            <a class="badge badge-primary" target="_blank" href="<?php echo base_url();?>public/uploads/group_messaging_attached_file/<?php echo $row['attached_file_name'];?>" style="color:white"><i class="picons-thin-icon-thin-0105_download_clipboard_box"></i>&nbsp;&nbsp;<?php echo $row['attached_file_name'];?></a>
                            <?php endif;?>
                        </div>
                    </div>
                    <div class="chat-message-date">
                        <?php if($sender_account_type == 'admin'):?>
                        <span class="badge badge-primary"><?php echo $this->crud->get_name($sender_account_type, $sender_id);?></span>
                        <?php endif;?>
                        <?php if($sender_account_type == 'teacher'):?>
                        <span class="badge badge-success"><?php echo $this->crud->get_name($sender_account_type, $sender_id);?></span>
                        <?php endif;?>
                        <?php if($sender_account_type == 'student'):?>
                        <span class="badge badge-warning"><?php echo $this->crud->get_name($sender_account_type, $sender_id);?></span>
                        <?php endif;?>
                        <?php if($sender_account_type == 'parent'):?>
                        <span class="badge badge-danger"><?php echo $this->crud->get_name($sender_account_type, $sender_id);?></span>
                        <?php endif;?>
                        <?php if($sender_account_type == 'accountant'):?>
                        <span class="badge badge-purple"><?php echo $this->crud->get_name($sender_account_type, $sender_id);?></span>
                        <?php endif;?>
                        <?php if($sender_account_type == 'librarian'):?>
                        <span class="badge badge-info"><?php echo $this->crud->get_name($sender_account_type, $sender_id);?></span>
                        <?php endif;?>
                        <br><?php echo $row['timestamp'];?> 
                    </div>
                    <div class="chat-message-avatar">
                        <img alt="" src="<?php echo $this->crud->get_image_url($sender_account_type, $sender_id); ?>">
                    </div>
                </div>
                    <?php endif;?>
                <?php endforeach;?>
            </div>
        </div>                
        <div class="chat-controls b-b">
            <?php echo form_open(base_url() . 'parents/group/send_reply/' . $current_message_thread_code, array('enctype' => 'multipart/form-data')); ?>
                <input type="hidden" name="reciever" value="<?php echo $recievers;?>">
                <div class="chat-input">
                    <input placeholder="<?php echo getEduAppGTLang('write_message');?>..." required type="text" name="message">
                </div>
                <div class="chat-input-extra">
                    <div class="chat-extra-actions">
                        <input type="file" name="attached_file_on_messaging" id="file-3" class="inputfile inputfile-3" style="display:none"/>
                        <label for="file-3"><i class="os-icon picons-thin-icon-thin-0042_attachment"></i> <span><?php echo getEduAppGTLang('send_file');?>...</span></label>
                        <div class="chat-btn">
                            <button class="btn btn-rounded btn-success" type="submit"><?php echo getEduAppGTLang('send');?></button>
                        </div>
                    </div>
                </div>
            <?php echo form_close();?>
        </div>
    </div>
    <div class="full-chat-right">
        <div class="user-intro">
            <div class="avatar">
                <img alt="" src="<?php echo base_url();?>public/uploads/<?php echo $this->db->getInfo('logo');?>" style="border-radius:0px">
            </div>
            <div class="user-intro-info">
                <h5 class="user-name"><?php echo $this->db->getInfo('system_name');?></h5>
            </div>
        </div>
        <div class="chat-info-section">
            <div class="ci-header">
                <span><?php echo getEduAppGTLang('shared_files');?></span>
            </div>
            <div class="ci-content mCustomScrollbar">
                <div class="ci-file-list">
                <?php
                    $this->db->where('attached_file_name !=', "");
                    $this->db->where('group_message_thread_code',$current_message_thread_code);
                    $files = $this->db->get('group_message');
                    if($files->num_rows() > 0):
                ?>
                    <ul>
                    <?php foreach($files->result_array() as $file):?>
                        <?php if($file['file_type'] != "png" && $file['file_type'] != "jpg" && $file['file_type'] != "JPEG" && $file['file_type'] != "GIF"):?>
                        <li><a target="_blank" href="<?php echo base_url();?>public/uploads/group_messaging_attached_file/<?php echo $file['attached_file_name']; ?>"><?php echo $file['attached_file_name'];?></a></li>
                        <?php endif;?>
                    <?php endforeach;?>
                    </ul>
                    <?php else:?>
                    <span><?php echo getEduAppGTLang('without_shared_files');?></span>
                    <?php endif;?>
                </div>
            </div>
        </div>
        <div class="chat-info-section">
            <div class="ci-header">
                <span><?php echo getEduAppGTLang('shared_photos');?></span>
            </div>
            <div class="ci-content  mCustomScrollbar">
                <div class="ci-edu-list">
                <?php
                    $this->db->where('attached_file_name !=', "");
                    $this->db->where('group_message_thread_code',$current_message_thread_code);
                    $imgs = $this->db->get('group_message');
                    if($imgs->num_rows() > 0):
                ?>
                    <ul class="w-last-photo js-zoom-gallery">
                        <?php foreach($imgs->result_array() as $img):?>
                        <?php if($img['file_type'] == "png" || $img['file_type'] == "jpg" || $img['file_type'] == "JPEG" || $img['file_type'] == "GIF"):?>
                        <li>
                            <a href="<?php echo base_url();?>public/uploads/group_messaging_attached_file/<?php echo $img['attached_file_name']; ?>">
                                <img src="<?php echo base_url();?>public/uploads/group_messaging_attached_file/<?php echo $img['attached_file_name']; ?>" style="min-height: 50px; min-width: 50px; object-fit:cover;">
                            </a>
                        </li>
                    <?php endif;?>
                    <?php endforeach;?>
                    </ul>
                    <?php else:?>
                    <span><?php echo getEduAppGTLang('without_shared_picture');?></span>
                    <?php endif;?>
                </div>
            </div>
        </div>
    </div>