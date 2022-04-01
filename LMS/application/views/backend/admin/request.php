<?php $running_year = $this->crud->getInfo('running_year'); ?>
    <div class="content-w">
        <?php include 'fancy.php';?>
        <div class="header-spacer"></div>
        <div class="conty">
            <div class="os-tabs-w menu-shad">
	            <div class="os-tabs-controls">
    	            <ul class="navs navs-tabs upper">
		                <li class="navs-item">
    		                <a class="navs-links" href="<?php echo base_url();?>admin/request_student/"><i class="os-icon picons-thin-icon-thin-0389_gavel_hammer_law_judge_court"></i><span><?php echo getEduAppGTLang('reports');?></span></a>
		                </li>
		                <li class="navs-item">
    		                <a class="navs-links active" href="<?php echo base_url();?>admin/request/"><i class="os-icon picons-thin-icon-thin-0015_fountain_pen"></i><span><?php echo getEduAppGTLang('permissions');?></span></a>
		                </li>
	                </ul>
	            </div>
            </div>
            <div class="content-box">
                <div class="os-tabs-w">
    			    <div class="os-tabs-controls">
			            <ul class="navs navs-tabs upper">
				            <li class="navs-item">
				                <a class="navs-links active" data-toggle="tab" href="#students"><?php echo getEduAppGTLang('students');?></a>
				            </li>
				            <li class="navs-item">
				                <a class="navs-links" data-toggle="tab" href="#teachers"><?php echo getEduAppGTLang('teachers');?></a>
				            </li>
			            </ul>
			        </div>
		        </div>
		        <br>
                <div class="tab-content ">
                    <div class="tab-pane active" id="students">
                        <div class="element-wrapper">
                            <h6 class="element-header"><?php echo getEduAppGTLang('student_permissions');?></h6>
                            <div class="element-box-tp">
                                <div class="table-responsive">
                                    <table class="table table-padded">
                                        <thead>
                                            <tr>
                                                <th><?php echo getEduAppGTLang('title');?></th>
                                                <th><?php echo getEduAppGTLang('description');?></th>
                                                <th><?php echo getEduAppGTLang('student');?></th>
                                                <th><?php echo getEduAppGTLang('from');?></th>
                                                <th><?php echo getEduAppGTLang('until');?></th>
                                                <th><?php echo getEduAppGTLang('status');?></th>
                                                <th><?php echo getEduAppGTLang('options');?></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                            		            $count = 1;
            		                            $this->db->order_by('request_id', 'desc');
            		                            $requests = $this->db->get('students_request')->result_array();
            		                            foreach ($requests as $row) { 
            	                            ?> 
                                            <tr>
                                                <td><?php echo $row['title']; ?></td>
                                                <td><?php echo $row['description'];?></td>
                                                <td class="cell-with-media">
                                                    <img alt="" src="<?php echo $this->crud->get_image_url('student', $row['student_id']);?>" style="height: 25px;"><span><?php echo $this->crud->get_name('student', $row['student_id']);?></span>
                                                </td>
                                                <td><a class="badge badge-success" style="color:white"><?php echo $row['start_date']; ?></a></td>
                                                <td><a class="badge badge-primary" style="color:white"><?php echo $row['end_date']; ?></a></td>
                                                <td>
                                                    <?php if($row['status'] == 0): ?>
    						                        <a class="btn nc btn-rounded btn-sm btn-warning" style="color:white"><?php echo getEduAppGTLang('pending');?></a>
    					                            <?php endif;?>
    					                            <?php if($row['status'] == 1): ?>
    						                        <a class="btn nc btn-rounded btn-sm btn-success" style="color:white"><?php echo getEduAppGTLang('approved');?></a>
    					                            <?php endif;?>
    					                            <?php if($row['status'] == 2): ?>
    						                        <a class="btn nc btn-rounded btn-sm btn-danger" style="color:white"><?php echo getEduAppGTLang('rejected');?></a>
    					                            <?php endif;?>
    					                        </td>
                                                <td class="bolder">
                                                <?php if($row['status'] == 0) { ?>
    						                        <a data-toggle="tooltip" data-placement="top" data-original-title="<?php echo getEduAppGTLang('approve');?>" onClick="return confirm('<?php echo getEduAppGTLang('confirm_approval');?>')" href="<?php echo base_url();?>admin/request_student/accept/<?php echo $row['request_id'];?>"><i style="color:gray" class="picons-thin-icon-thin-0154_ok_successful_check"></i></a>
    						                        <a data-toggle="tooltip" data-placement="top" data-original-title="<?php echo getEduAppGTLang('reject');?>" onClick="return confirm('<?php echo getEduAppGTLang('confirm_reject');?>')" href="<?php echo base_url();?>admin/request_student/reject/<?php echo $row['request_id'];?>"><i style="color:gray" class="picons-thin-icon-thin-0153_delete_exit_remove_close"></i></a>
    						                    <?php } ?>    
    						                        <a data-toggle="tooltip" data-placement="top" data-original-title="<?php echo getEduAppGTLang('delete');?>" onClick="return confirm('<?php echo getEduAppGTLang('confirm_delete');?>')" href="<?php echo base_url();?>admin/request_student/delete/<?php echo $row['code'];?>"><i style="color:gray" class="picons-thin-icon-thin-0056_bin_trash_recycle_delete_garbage_empty"></i></a>
                                                </td>
                                            </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane" id="teachers">
		                <div class="element-wrapper">
                            <h6 class="element-header"><?php echo getEduAppGTLang('teachers_permissions');?></h6>
                            <div class="element-box-tp">
		                        <div class="table-responsive">
			                        <table class="table table-padded">
                                        <thead>
                                            <tr>
                                                <th><?php echo getEduAppGTLang('title');?></th>
                                                <th><?php echo getEduAppGTLang('description');?></th>
                                                <th><?php echo getEduAppGTLang('teacher');?></th>
                                                <th><?php echo getEduAppGTLang('from');?></th>
                                                <th><?php echo getEduAppGTLang('until');?></th>
                                                <th><?php echo getEduAppGTLang('options');?></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php
            	                            $count = 1;
            	                            $this->db->order_by('request_id', 'desc');
            	                            $requests = $this->db->get('request')->result_array();
    	                                    foreach ($requests as $row) {
        	                            ?>  
                                            <tr>
                                                <td><?php echo $row['title'];?></td>
                                                <td><?php echo $row['description'];?></td>
                                                <td class="cell-with-media">
                                                    <img alt="" src="<?php echo $this->crud->get_image_url('teacher', $row['teacher_id']);?>" style="height: 25px;"><span><?php echo $this->crud->get_name('teacher', $row['teacher_id']);?></span>
                                                </td>
                                                <td><a class="badge badge-success" style="color:white"><?php echo $row['start_date']; ?></a></td>
                                                <td><a class="badge badge-primary" style="color:white"><?php echo $row['end_date']; ?></a></td>
                                                <td>
                                                    <?php if($row['status'] == 0): ?>
						                            <a class="btn nc btn-rounded btn-sm btn-warning" style="color:white"><?php echo getEduAppGTLang('pending');?></a>
					                                <?php endif;?>
					                                <?php if($row['status'] == 1): ?>
						                            <a class="btn nc btn-rounded btn-sm btn-success" style="color:white"><?php echo getEduAppGTLang('approved');?></a>
					                                <?php endif;?>
					                                <?php if($row['status'] == 2): ?>
						                            <a class="btn nc btn-rounded btn-sm btn-danger" style="color:white"><?php echo getEduAppGTLang('rejected');?></a>
    					                            <?php endif;?>
					                            </td>
                                                <td class="bolder">
                                                <?php if($row['status'] == 0) { ?>
						                            <a data-toggle="tooltip" data-placement="top" data-original-title="<?php echo getEduAppGTLang('approve');?>" onClick="return confirm('<?php echo getEduAppGTLang('confirm_approval');?>')" href="<?php echo base_url();?>admin/request/accept/<?php echo $row['request_id'];?>"><i style="color:gray" class="picons-thin-icon-thin-0154_ok_successful_check"></i></a>
    						                        <a data-toggle="tooltip" data-placement="top" data-original-title="<?php echo getEduAppGTLang('reject');?>" onClick="return confirm('<?php echo getEduAppGTLang('confirm_reject');?>')" href="<?php echo base_url();?>admin/request/reject/<?php echo $row['request_id'];?>"><i style="color:gray" class="picons-thin-icon-thin-0153_delete_exit_remove_close"></i></a>
						                        <?php } ?>    
    						                        <a data-toggle="tooltip" data-placement="top" data-original-title="<?php echo getEduAppGTLang('delete');?>" onClick="return confirm('<?php echo getEduAppGTLang('confirm_delete');?>')" href="<?php echo base_url();?>admin/request_student/delete/<?php echo $row['code'];?>"><i style="color:gray" class="picons-thin-icon-thin-0056_bin_trash_recycle_delete_garbage_empty"></i></a>
                                                </td>
                                            </tr>
                                        <?php } ?>
    			                        </tbody>
			                        </table>
    		                    </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>      
        </div>
        <div class="display-type"></div>
    </div>

    <script type="text/javascript">
        function get_class_sections(class_id) 
        {
            $.ajax({
                url: '<?php echo base_url();?>admin/get_class_section/' + class_id ,
                success: function(response)
                {
                    jQuery('#section_selector_holder').html(response);
                }
            });
        }

        function get_class_students(class_id) {
            $.ajax({
                url: '<?php echo base_url(); ?>admin/get_class_stundets/' + class_id,
                success: function (response)
                {
                    jQuery('#students_holder').html(response);
                }
            });
        }
    </script>