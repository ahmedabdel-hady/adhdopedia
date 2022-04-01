    <?php 
        $details = $this->db->get_where('forum', array('post_code' => $code))->result_array();
        foreach($details as $row2):
    ?>
    <div class="content-w">
        <?php include 'fancy.php';?>
        <div class="header-spacer"></div>
        <div class="conty">
	        <div class="os-tabs-w menu-shad">
                <div class="os-tabs-controls">
                    <ul class="navs navs-tabs upper">
                        <li class="navs-item">
                            <a class="navs-links" href="<?php echo base_url();?>admin/subject_dashboard/<?php echo base64_encode($row2['class_id']."-".$row2['section_id']."-".$row2['subject_id']);?>/"><i class="os-icon picons-thin-icon-thin-0482_gauge_dashboard_empty"></i><span><?php echo getEduAppGTLang('dashboard');?></span></a>
                        </li>
                        <li class="navs-item">
                            <a class="navs-links" href="<?php echo base_url();?>admin/online_exams/<?php echo base64_encode($row2['class_id']."-".$row2['section_id']."-".$row2['subject_id']);?>/"><i class="os-icon picons-thin-icon-thin-0207_list_checkbox_todo_done"></i><span><?php echo getEduAppGTLang('online_exams');?></span></a>
                        </li>
                        <li class="navs-item">
                            <a class="navs-links" href="<?php echo base_url();?>admin/homework/<?php echo base64_encode($row2['class_id']."-".$row2['section_id']."-".$row2['subject_id']);?>/"><i class="os-icon picons-thin-icon-thin-0004_pencil_ruler_drawing"></i><span><?php echo getEduAppGTLang('homework');?></span></a>
                        </li>
                        <li class="navs-item">
                            <a class="navs-links active" href="<?php echo base_url();?>admin/forum/<?php echo base64_encode($row2['class_id']."-".$row2['section_id']."-".$row2['subject_id']);?>/"><i class="os-icon picons-thin-icon-thin-0281_chat_message_discussion_bubble_reply_conversation"></i><span><?php echo getEduAppGTLang('forum');?></span></a>
                        </li>
                        <li class="navs-item">
                            <a class="navs-links" href="<?php echo base_url();?>admin/study_material/<?php echo base64_encode($row2['class_id']."-".$row2['section_id']."-".$row2['subject_id']);?>/"><i class="os-icon picons-thin-icon-thin-0003_write_pencil_new_edit"></i><span><?php echo getEduAppGTLang('study_material');?></span></a>
                        </li>
                        <li class="navs-item">
                            <a class="navs-links" href="<?php echo base_url();?>admin/upload_marks/<?php echo base64_encode($row2['class_id']."-".$row2['section_id']."-".$row2['subject_id']);?>"><i class="os-icon picons-thin-icon-thin-0729_student_degree_science_university_school_graduate"></i><span><?php echo getEduAppGTLang('marks');?></span></a>
                        </li>
                        <li class="navs-item">
                            <a class="navs-links" href="<?php echo base_url();?>admin/attendance/<?php echo base64_encode($row2['class_id']."-".$row2['section_id']."-".$row2['subject_id']);?>/"><i class="os-icon picons-thin-icon-thin-0023_calendar_month_day_planner_events"></i><span><?php echo getEduAppGTLang('attendance');?></span></a>
                        </li>
                    </ul>
                </div>
            </div>
	        <div class="content-i">
	            <div class="content-box">
	                <div class="col-lg-12">		
	                    <div class="back hidden-sm-down" style="margin-top:-20px;margin-bottom:10px">		
	                        <a href="<?php echo base_url();?>admin/forum/<?php echo base64_encode($row2['class_id']."-".$row2['section_id']."-".$row2['subject_id']);?>/"><i class="picons-thin-icon-thin-0131_arrow_back_undo"></i></a>	
	                    </div>	
	                    <div class="element-wrapper">	
		                    <div class="element-box lined-primary shadow">
          	                    <div class="modal-header">
	                                <h5 class="modal-title"><?php echo getEduAppGTLang('update_forum');?></h5>
          	                    </div><br>
                                <?php echo form_open(base_url() . 'admin/forum/update/'.$code, array('enctype' => 'multipart/form-data')); ?>
			                        <div class="form-group">
				                        <label for=""> <?php echo getEduAppGTLang('title');?></label>
				                        <input class="form-control" name="title" required="" value="<?php echo $row2['title'];?>" type="text">
			                        </div>
			                        <input type="hidden" value="<?php echo $row['class_id'];?>" name="class_id">
			                        <input type="hidden" value="<?php echo $row['subject_id'];?>" name="subject_id">
			                        <input type="hidden" value="<?php echo $row['subject_id'];?>" name="subject_id">
			                        <div class="col col-lg-12 col-md-12 col-sm-12 col-12">
            		                    <div class="description-toggle">
                                            <div class="description-toggle-content">
                                                <div class="h6"><?php echo getEduAppGTLang('show_students');?></div>
                                                <p><?php echo getEduAppGTLang('show_message');?></p>
                                            </div>          
                                            <div class="togglebutton">
                                                <label><input name="post_status" value="1" <?php if($row2['post_status'] == 1) echo "checked";?> type="checkbox"></label>
                                            </div>
                                        </div>
                                    </div>
			                        <div class="form-group">
				                        <label> <?php echo getEduAppGTLang('description');?></label>
				                        <textarea cols="80" id="ckeditor1" name="description" required="" rows="2"><?php echo $row2['description'];?></textarea>
				                    </div>          
          		                    <div class="modal-footer">
	            	                    <button class="btn btn-rounded btn-success" type="submit"> <?php echo getEduAppGTLang('update');?></button>
          		                    </div>
          	                    <?php echo form_close();?>
		                    </div>
	                    </div>
	                </div>
                </div>  
            </div>
        </div>
    </div>
<?php endforeach;?>