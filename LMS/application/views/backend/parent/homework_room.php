<?php 
    $running_year = $this->crud->getInfo('running_year');
    $current_homework = $this->db->get_where('homework' , array('homework_code' => $homework_code))->result_array();
    foreach ($current_homework as $row):
    $query = $this->db->get_where('deliveries', array('homework_code' => $homework_code, 'student_id' => $student_id));
?>
    <div class="content-w">
        <div class="conty">
        <?php include 'fancy.php';?>
        <div class="header-spacer"></div>
	        <div class="os-tabs-w menu-shad">
		        <div class="os-tabs-controls">
		            <ul class="navs navs-tabs upper">
    			        <li class="navs-item">
			                <a class="navs-links active" href="#"><i class="os-icon picons-thin-icon-thin-0014_notebook_paper_todo"></i><span><?php echo getEduAppGTLang('homework_details');?></span></a>
			            </li>
		            </ul>
		        </div>
	        </div>
            <div class="content-i">
                <div class="content-box">
	                <div class="back" style="margin-top:-20px;margin-bottom:10px">		
	                    <a href="<?php echo base_url();?>parents/homework/<?php echo base64_encode($row['class_id'].'-'.$row['section_id'].'-'.$row['subject_id'].'-'.$student_id);?>/"><i class="picons-thin-icon-thin-0131_arrow_back_undo"></i></a>	
	                </div>
	                <div class="row">
	                    <div class="col-sm-8">
		                    <div class="pipeline white lined-primary shadow">
		                        <div class="pipeline-header">
			                        <h5 class="pipeline-name"><?php echo $row['title'];?></h5>
			                        <div class="pipeline-header-numbers">
			                            <div class="pipeline-count">
				                            <i class="os-icon picons-thin-icon-thin-0024_calendar_month_day_planner_events"></i> <?php echo $row['date_end'];?> <br>
				                            <i class="os-icon picons-thin-icon-thin-0025_alarm_clock_ringer_time_morning"></i> <?php echo $row['time_end'];?>
			                            </div>
			                        </div>
		                        </div>
			                    <p><?php echo $row['description'];?></p>
			                    <?php if($row['file_name'] != ""):?>
			                    <div class="b-t padded-v-big">
				                    <?php echo getEduAppGTLang('file');?>: <a class="btn btn-rounded btn-sm btn-primary" href="<?php echo base_url() . 'public/uploads/homework/' . $row['file_name']; ?>" style="color:white"><i class="os-icon picons-thin-icon-thin-0042_attachment"></i> <?php echo $row['file_name'];?></a>
			                    </div>
			                    <?php endif;?>
			                    <?php if($query->num_rows() > 0):?>
				                <div class="alert alert-success" role="alert"><strong><?php echo getEduAppGTLang('success');?>. </strong><?php echo getEduAppGTLang('success_delivery');?>.</div>
			                    <?php else:?>
			                    <div class="alert alert-danger" role="alert"><strong><?php echo getEduAppGTLang('fail');?>. </strong><?php echo getEduAppGTLang('no_delivered');?></div>
			                    <?php endif;?>
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
				                            <th><b><?php echo getEduAppGTLang('subject');?></b>:</th>
				                            <td><?php echo $this->crud->get_type_name_by_id('subject',$row['subject_id']);?></td>
			                            </tr>
			                            <tr>
				                            <th><b><?php echo getEduAppGTLang('class');?></b>:</th>
				                            <td><?php echo $this->crud->get_type_name_by_id('class',$row['class_id']);?></td>
			                            </tr>
			                            <tr>
				                            <th><b><?php echo getEduAppGTLang('section');?></b>:</th>
				                            <td><?php echo $this->crud->get_type_name_by_id('section',$row['section_id']);?></td>
			                            </tr>
			                            <tr>
				                            <th><b><?php echo getEduAppGTLang('limit_date');?></b>:</th>
				                            <td><?php echo getEduAppGTLang('allowed_deliveries');?> <?php echo $row['date_end'];?> <?php echo $row['time_end'];?>.</td>
			                            </tr>
			                            <tr>
				                            <th><b><?php echo getEduAppGTLang('status');?></b>:</th>
				                            <td>
				                                <?php if($query->num_rows() <= 0):?>
				  		                        <a class="btn nc btn-rounded btn-sm btn-danger" style="color:white"><?php echo getEduAppGTLang('no_delivered');?></a>
					                            <?php endif;?>
					                            <?php if($query->num_rows() > 0):?>
				  		                        <a class="btn nc btn-rounded btn-sm btn-success" style="color:white"><?php echo getEduAppGTLang('submitted_for_review');?></a>
					                            <?php endif;?>  
				                            </td>
			                            </tr>
			                            <tr>
				                            <th><b><?php echo getEduAppGTLang('mark');?></b>:</th>
				                            <td>
				                                <?php if($query->num_rows() <= 0):?>
				                                <a class="btn btn-rounded btn-sm btn-danger" style="color:white"><?php echo getEduAppGTLang('unrated');?></a>
				                                <?php endif;?>
				                                <?php if($query->num_rows() > 0):?>
				                                <a class="btn btn-rounded btn-sm btn-primary" style="color:white"><?php $mark =$this->db->get_where('deliveries', array('homework_code' => $homework_code, 'student_id' => $student_id))->row()->mark; if($mark > 0) echo $mark; else echo getEduAppGTLang('waiting_mark');?></a>
				                                <?php endif;?>
				                            </td>
			                            </tr>
			                            <tr>
				                            <th><b><?php echo getEduAppGTLang('teacher_comment');?></b>:</th>
				                            <td>
				                                <?php if($query->num_rows() > 0):?>
				                                    <?php echo $this->db->get_where('deliveries', array('homework_code' => $homework_code, 'student_id' => $student_id))->row()->teacher_comment;?>
				                                <?php endif;?>
				                            </td>
			                            </tr>
		                            </table>
		                        </div>
		                    </div>
	                    </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php endforeach;?>