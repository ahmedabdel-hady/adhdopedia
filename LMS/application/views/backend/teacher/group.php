    <div class="content-w">
        <?php include 'fancy.php';?>
        <div class="header-spacer"></div>
        <div class="conty"  style="background-color:#fff;">
            <div class="full-chat-w">
                <div class="full-chat-i">
                    <div class="full-chat-left support-tickets">          
    				    <div class="tab-content">
                            <div class="os-tabs-w bg-white">
                                <ul class="navs navs-tabs upper centered">
                                    <li class="navs-item">
                                        <a class="navs-links <?php if($page_name == 'message' && $message_inner_page_name != 'message_new');?>" href="<?php echo base_url();?>teacher/message/" style="color:#000"><i class="os-icon picons-thin-icon-thin-0306_chat_message_discussion_bubble_conversation" style="color:#047bf8"></i><span><?php echo getEduAppGTLang('chats');?></span></a>
                                    </li>
                                    <li class="navs-item">
                                        <a class="navs-links <?php if($message_inner_page_name == 'message_new') echo "active";?>" href="<?php echo base_url();?>teacher/message/message_new/" style="color:#000"><i class="os-icon picons-thin-icon-thin-0001_compose_write_pencil_new" style="color:#047bf8"></i><span><?php echo getEduAppGTLang('write');?></span></a>
                                    </li>
                                    <li class="navs-item">
                                        <a class="navs-links <?php if($page_name == 'group') echo "active";?>" href="<?php echo base_url();?>teacher/group/" style="color:#000"><i class="os-icon picons-thin-icon-thin-0719_group_users_circle" style="color:#047bf8"></i><span><?php echo getEduAppGTLang('groups');?></span></a>
                                    </li>
                                </ul>
                            </div>
          				    <div class="tab-pane active" id="chats">
              				    <br>
          				        <center><a href="<?php echo base_url();?>teacher/group/create_message_group/" class="btn btn-purple btn-sm">
                                    <?php echo getEduAppGTLang('create_group');?></a></center><br>
                    		    <div class="user-list">
                    		    <?php
                                    $flag = 0;
                                    $group_messages = $this->db->get('group_message_thread')->result_array();
                                    foreach ($group_messages as $row):
                                    $members = json_decode($row['members']);
                                    if (in_array($this->session->userdata('login_type').'_'.$this->session->userdata('login_user_id'), $members)):
                                    $flag++;
                                ?>
                        			<a href="<?php echo base_url('teacher/group/group_message_read/'.$row['group_message_thread_code']); ?>">
                      				    <div class="user-w box <?php if (isset($current_message_thread_code) && $current_message_thread_code == $row['group_message_thread_code']) echo 'active'; ?>">
                            				<div class="avatar with-status status-green">
	                          				    <div class="circle purple"><?php echo strtoupper($row['group_name'][0]); ?></div>
                        				    </div>
                        				    <div class="user-info">
                              					<div class="user-name" title="<?php echo $row['group_name'] ?>">
                            				        <?php echo $row['group_name'] ?>
                          					    </div>
                          					    <div class="last-message">
                                					<a href="<?php echo base_url();?>teacher/group/update_group/<?php echo $row['group_message_thread_code'];?>/"><i class="picons-thin-icon-thin-0001_compose_write_pencil_new" style="color:black; font-size:15px;"></i></a>
                                                    <a onClick="return confirm('<?php echo getEduAppGTLang('confirm_delete');?>')" href="<?php echo base_url();?>teacher/group/delete_group/<?php echo $row['group_message_thread_code'];?>"><i class="picons-thin-icon-thin-0057_bin_trash_recycle_delete_garbage_full" style="color:black;font-size:15px"></i>
                          					    </div>
                        				    </div>
                      				    </div>
                      			    </a>
                      	            <?php endif; ?>
                    			<?php endforeach;?>
          					    </div>
          				    </div>
                  	    </div>
          		    </div>
          		    <?php include $message_inner_page_name . '.php'; ?>
                </div>
            </div>
        </div>
    </div>