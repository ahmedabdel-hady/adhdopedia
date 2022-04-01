<?php $running_year = $this->crud->getInfo('running_year'); ?>
    <div class="content-w">
        <div class="conty">
        <?php include 'fancy.php';?>
        <div class="header-spacer"></div>
	        <div class="os-tabs-w menu-shad">
		        <div class="os-tabs-controls">
		            <ul class="navs navs-tabs upper">
			            <li class="navs-item">
			                <a class="navs-links" href="<?php echo base_url();?>teacher/homeworkroom/<?php echo $homework_code;?>/"><i class="os-icon picons-thin-icon-thin-0014_notebook_paper_todo"></i><span><?php echo getEduAppGTLang('homework_details');?></span></a>
			            </li>
			            <li class="navs-item">
			                <a class="navs-links" href="<?php echo base_url();?>teacher/homework_details/<?php echo $homework_code;?>/"><i class="os-icon picons-thin-icon-thin-0100_to_do_list_reminder_done"></i><span><?php echo getEduAppGTLang('deliveries');?></span></a>
			            </li>
			            <li class="navs-item">
			                <a class="navs-links active" href="<?php echo base_url();?>teacher/homework_edit/<?php echo $homework_code;?>/"><i class="os-icon picons-thin-icon-thin-0001_compose_write_pencil_new"></i><span><?php echo getEduAppGTLang('edit');?></span></a>
			            </li>
		            </ul>
		        </div>
	        </div>
	        <?php 
	            $info = $this->db->get_where('homework', array('homework_code' => $homework_code))->result_array();
	  	        foreach($info as $row):
	        ?>
            <div class="content-i">
                <div class="content-box">
	                <div class="row">	
	                    <div class="col-sm-8">
		                    <div class="pipeline white lined-primary">
		                        <div class="pipeline-header">
			                        <h5 class="pipeline-name"><?php echo getEduAppGTLang('update_homework');?></h5>
		                        </div>
			                    <?php echo form_open(base_url() . 'teacher/homework/update/' . $homework_code, array('enctype' => 'multipart/form-data')); ?>
			                        <div class="form-group">
				                        <label for=""> <?php echo getEduAppGTLang('title');?></label><input class="form-control" required="" name="title" value="<?php echo $row['title'];?>" type="text">
			                        </div>
			                        <div class="form-group">
				                        <label> <?php echo getEduAppGTLang('description');?></label><textarea cols="80" id="ckeditor1" name="description" required rows="2"><?php echo $row['description'];?></textarea>
				                    </div>
				                    <div class="form-group">
				                        <label for=""> <?php echo getEduAppGTLang('delivery_date');?></label>
				                        <input type='text' class="datepicker-here" data-position="top left" data-language='en' name="date_end" data-multiple-dates-separator="/" value="<?php echo $row['date_end'];?>"/>
				                    </div>
				                    <div class="form-group">
                        				<label for=""> <?php echo getEduAppGTLang('limit_hour');?></label>
				                        <div class="input-group clockpicker" data-align="top" data-autoclose="true">
					                        <input type="text" required="" name="time_end" class="form-control" value="<?php echo $row['time_end'];?>">
					                        <span class="input-group-addon">
						                        <span class="picons-thin-icon-thin-0029_time_watch_clock_wall"></span>
					                        </span>
				                        </div>
				                    </div>
				                    <div class="col col-lg-12 col-md-12 col-sm-12 col-12">
            		                    <div class="description-toggle">
                                            <div class="description-toggle-content">
                                                <div class="h6"><?php echo getEduAppGTLang('show_students');?></div>
                                                <p><?php echo getEduAppGTLang('show_message');?>.</p>
                                            </div>          
                                            <div class="togglebutton">
                                                <label><input name="status" value="1" <?php if($row['status'] == 1) echo "checked"?> type="checkbox"></label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col col-lg-12 col-md-12 col-sm-12 col-12">
            		                        <center><label class="control-label"><?php echo getEduAppGTLang('type');?></label></center>
            		                    </div>
            		                    <div class="col col-lg-6 col-md-6 col-sm-6 col-6">
            		                        <div class="custom-control custom-radio" style="float: right">
                                                <input  type="radio" <?php if($row['type'] == 1) echo 'checked';?> name="type" id="1" value="1" class="custom-control-input"> <label for="1" class="custom-control-label"><?php echo getEduAppGTLang('online_text');?></label>
                                            </div>
                                        </div>
                                        <div class="col col-lg-6 col-md-6 col-sm-6 col-6">
                                            <div class="custom-control custom-radio">
                                                <input  type="radio" <?php if($row['type'] == 2) echo 'checked';?> name="type" id="2" value="2" class="custom-control-input"> <label for="2" class="custom-control-label"><?php echo getEduAppGTLang('files');?></label>
                                            </div>
                            		    </div>
            		                </div>
			                        <div class="form-buttons-w text-right">
			                            <button class="btn btn-rounded btn-success" type="submit"><?php echo getEduAppGTLang('update');?></button>
			                        </div>
			                    <?php echo form_close();?>
		                    </div>
		                </div>
	                    <div class="col-sm-4">
		                    <div class="pipeline white lined-secondary">
		                        <div class="pipeline-header">
			                        <h5 class="pipeline-name"><?php echo getEduAppGTLang('information');?></h5>
                		        </div>
		                        <div class="table-responsive">
		                            <table class="table table-lightbor table-lightfont">
			                            <tr>
				                            <th><?php echo getEduAppGTLang('subject');?>:</th>
				                            <td><?php echo $this->crud->get_type_name_by_id('subject',$row['subject_id']);?></td>
			                            </tr>
			                            <tr>
				                            <th><?php echo getEduAppGTLang('class');?>:</th>
				                            <td><?php echo $this->crud->get_type_name_by_id('class',$row['class_id']);?></td>
			                            </tr>
			                            <tr>
				                            <th><?php echo getEduAppGTLang('section');?>:</th>
				                            <td><?php echo $this->crud->get_type_name_by_id('section',$row['section_id']);?></td>
			                            </tr>
			                            <tr>
				                            <th><?php echo getEduAppGTLang('total_students');?>:</th>
				                            <td><a class="btn nc btn-rounded btn-sm btn-secondary" style="color:white"><?php $this->db->where('class_id', $row['class_id']); $this->db->where('section_id', $row['section_id']); echo $this->db->count_all_results('enroll');?></a></td>
			                            </tr>
			                            <tr>
				                            <th><?php echo getEduAppGTLang('delivered');?>:</th>
        				                    <td><a class="btn nc btn-rounded btn-sm btn-success" style="color:white"><?php $this->db->where('class_id', $row['class_id']); $this->db->where('section_id', $row['section_id']); $this->db->where('homework_code', $homework_code); echo $this->db->count_all_results('deliveries');?></a></td>
			                            </tr>
			                            <tr>
				                            <th><?php echo getEduAppGTLang('undeliverable');?>:</th>
				                            <td>
                    					        <?php $this->db->where('class_id', $row['class_id']); $this->db->where('section_id', $row['section_id']); $all = $this->db->count_all_results('enroll');?>
					                            <?php $this->db->where('class_id', $row['class_id']); $this->db->where('section_id', $row['section_id']); $this->db->where('homework_code', $homework_code); $deliveries = $this->db->count_all_results('deliveries');?>
				                                <a class="btn nc btn-rounded btn-sm btn-danger" style="color:white"><?php echo $all - $deliveries; ?></a>
				                            </td>
			                            </tr>
		                            </table>
		                        </div>
		                    </div>
		                    <div class="pipeline white lined-warning">
		                        <div class="pipeline-header"><h5 class="pipeline-name"><?php echo getEduAppGTLang('students');?></h5></div>
		                        <div class="users-list-w">
		                        <?php 
		                            $students = $this->db->get_where('enroll' , array('class_id' => $row['class_id'], 'section_id' => $row['section_id'] , 'year' => $running_year))->result_array();
                                    foreach($students as $row2):?>
			                        <div class="user-w">
                                        <div class="user-avatar-w">
                                            <div class="user-avatar">
                                                <img alt="" src="<?php echo $this->crud->get_image_url('student', $row2['student_id']); ?>">
                                            </div>
                                        </div>
                                        <div class="user-name">
                                            <h6 class="user-title"><?php echo $this->crud->get_name('student', $row2['student_id']);?></h6>
                                            <div class="user-role">
                                                <?php echo getEduAppGTLang('roll');?>: <strong><?php echo $this->db->get_where('enroll' , array('student_id' => $row2['student_id']))->row()->roll; ?></strong>
                                            </div>
                                        </div>
                                    </div>
			                        <?php endforeach;?>
		                        </div>
		                    </div>
	                    </div>
                    </div>
                </div>
            </div>
        <?php endforeach;?>
        </div>
    </div>