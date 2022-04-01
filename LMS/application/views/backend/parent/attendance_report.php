<?php 
    $running_year = $this->crud->getInfo('running_year');
    $info = base64_decode($data);
    $ex = explode('-', $info);
    $sub = $this->db->get_where('subject', array('subject_id' => $ex[2]))->result_array();
    foreach($sub as $rows):
    $class_id = $this->db->get_where('enroll' , array('student_id' => $student_id , 'year' => $running_year))->row()->class_id;
	$section_id = $this->db->get_where('enroll' , array('student_id' => $student_id , 'year' => $running_year))->row()->section_id; 
	$student_id = $ex[3];
?>
    <div class="content-w">
        <div class="conty">
        <?php $info = base64_decode($data);?>
        <?php $ids = explode("-",$info);?>
        <?php include 'fancy.php';?> 
        <div class="header-spacer"></div>
            <div class="cursos cta-with-media" style="background: #<?php echo $rows['color'];?>;">
                <div class="cta-content">
                    <div class="user-avatar">
                        <img alt="" src="<?php echo base_url();?>public/uploads/subject_icon/<?php echo $rows['icon'];?>" style="width:60px;">
                    </div>
                    <h3 class="cta-header"><?php echo $rows['name'];?> - <small><?php echo getEduAppGTLang('forum');?></small></h3>
                    <small style="font-size:0.90rem; color:#fff;"><?php echo $this->crud->get_name('student', $ex[3]);?> | <?php echo $this->db->get_where('class', array('class_id' => $ex[0]))->row()->name;?> "<?php echo $this->db->get_where('section', array('section_id' => $ex[1]))->row()->name;?>"</small>
                </div>
            </div> 
            <div class="os-tabs-w menu-shad">
                <div class="os-tabs-controls">
                    <ul class="navs navs-tabs upper">
                        <li class="navs-item">
                            <a class="navs-links" href="<?php echo base_url();?>parents/subject_dashboard/<?php echo $data;?>/"><i class="os-icon picons-thin-icon-thin-0482_gauge_dashboard_empty"></i><span><?php echo getEduAppGTLang('dashboard');?></span></a>
                        </li>
                        <li class="navs-item">
                            <a class="navs-links" href="<?php echo base_url();?>parents/online_exams/<?php echo $data;?>/"><i class="os-icon picons-thin-icon-thin-0207_list_checkbox_todo_done"></i><span><?php echo getEduAppGTLang('online_exams');?></span></a>
                        </li>
                        <li class="navs-item">
                            <a class="navs-links" href="<?php echo base_url();?>parents/homework/<?php echo $data;?>/"><i class="os-icon picons-thin-icon-thin-0004_pencil_ruler_drawing"></i><span><?php echo getEduAppGTLang('homework');?></span></a>
                        </li>
                        <li class="navs-item">
                            <a class="navs-links" href="<?php echo base_url();?>parents/forum/<?php echo $data;?>/"><i class="os-icon picons-thin-icon-thin-0281_chat_message_discussion_bubble_reply_conversation"></i><span><?php echo getEduAppGTLang('forum');?></span></a>
                        </li>
                        <li class="navs-item">
                            <a class="navs-links" href="<?php echo base_url();?>parents/study_material/<?php echo $data;?>/"><i class="os-icon picons-thin-icon-thin-0003_write_pencil_new_edit"></i><span><?php echo getEduAppGTLang('study_material');?></span></a>
                        </li>
                        <li class="navs-item">
                            <a class="navs-links" href="<?php echo base_url();?>parents/subject_marks/<?php echo $data;?>/"><i class="os-icon picons-thin-icon-thin-0729_student_degree_science_university_school_graduate"></i><span><?php echo getEduAppGTLang('marks');?></span></a>
                        </li>
                        <li class="navs-item">
                            <a class="navs-links active" href="<?php echo base_url();?>parents/attendance_report/<?php echo $data;?>/"><i class="os-icon picons-thin-icon-thin-0023_calendar_month_day_planner_events"></i><span><?php echo getEduAppGTLang('attendance');?></span></a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="content-i">
                <div class="content-box">
                    <div class="row">
                        <main class="col col-xl-12 order-xl-2 col-lg-12 order-lg-1 col-md-12 col-sm-12 col-12">
                            <div class="element-wrapper">         
			                    <?php echo form_open(base_url() . 'parents/attendance_report_selector/', array('class' => 'form m-b')); ?>   
					                <div class="row">                
    							        <input type="hidden" name="data" value="<?php echo $data; ?>">
    						            <input type="hidden" name="operation" value="selection">
						                <div class="col-sm-4">    
						                    <div class="form-group label-floating is-select">
                                                <label class="control-label"><?php echo getEduAppGTLang('month');?></label>
                                                <div class="select">
                                                    <select name="month" required="" onchange="show_year()">
                                                        <option value=""><?php echo getEduAppGTLang('select');?></option>
                                                        <?php
            						                        for ($i = 1; $i <= 12; $i++):
                                                            if ($i == 1) $m = getEduAppGTLang('january');
                                                            else if ($i == 2) $m = getEduAppGTLang('february');
                                                            else if ($i == 3) $m = getEduAppGTLang('march');
                                                            else if ($i == 4) $m = getEduAppGTLang('april');
                                                            else if ($i == 5) $m = getEduAppGTLang('may');
                                                            else if ($i == 6) $m = getEduAppGTLang('june');
                                                            else if ($i == 7) $m = getEduAppGTLang('july');
                                                            else if ($i == 8) $m = getEduAppGTLang('august');
                                                            else if ($i == 9) $m = getEduAppGTLang('september');
                                                            else if ($i == 10) $m = getEduAppGTLang('october');
                                                            else if ($i == 11) $m = getEduAppGTLang('november');
                                                            else if ($i == 12) $m = getEduAppGTLang('december');
                				                        ?>
                					                    <option value="<?php echo $i; ?>"<?php if($month == $i) echo 'selected'; ?>  ><?php echo $m; ?></option>
                				                        <?php endfor;?>
                                                    </select>
                                                </div>
                                            </div>
						                </div>       
						                <input type="hidden" name="year" value="<?php echo $running_year;?>">
						                <div class="col-sm-2">                 
							                <div class="form-group"> 
								                <button class="btn btn-rounded btn-success btn-upper" style="margin-top:20px"><span><?php echo getEduAppGTLang('generate');?></span></button>
							                </div>                
						                </div>             
					                </div>            
				                <?php echo form_close();?>       
		                    </div> 
		                    <?php if($month != ''):?>
                            <div id="newsfeed-items-grid">      
                                <div class="element-box lined-primary shadow">              
                                    <div class="element-wrapper">
                                        <div class="element-box-tp">
                                            <h6 class="element-header"><?php echo getEduAppGTLang('attendance_report');?> <?php echo getEduAppGTLang('of');?> [<?php echo $this->db->get_where('subject', array('subject_id' => $ex[2]))->row()->name;?>]</h6>
                                            <div class="table-responsive">
                                                <table class="table table-sm table-lightborder">
                                                    <thead>                    
                                                        <tr class="text-center" height="50px">
                                                            <th class="text-left"> <?php echo getEduAppGTLang('student');?></th>  
                                                            <?php
                                                                $days = cal_days_in_month(CAL_GREGORIAN, $month, $year);
                                                                for ($i = 1; $i <= $days; $i++) {
                                                            ?>                    
                                                            <th class="text-center"> <?php echo $i; ?> </th>                    
                                                            <?php } ?>
                                                        </tr> 
                                                    </thead>                  
                                                    <tbody>                    
                                                        <tr>                      
                                                            <td><img alt="" src="<?php echo $this->crud->get_image_url('student', $student_id);?>" width="20px" style="border-radius:20px;margin-right:5px;"> <?php echo $this->crud->get_name('student', $student_id); ?> </td>    
                                                        <?php
                                                            $status = 0;
                                                            for ($i = 1; $i <= $days; $i++) {
                                                            $timestamp = strtotime($i . '-' . $month . '-' . $year);
                                                            $this->db->group_by('timestamp');
                                                            $attendance = $this->db->get_where('attendance', array('section_id' => $ex[1], 'class_id' => $ex[0], 'subject_id' => $ex[2], 'year' => $year, 'timestamp' => $timestamp, 'student_id' => $student_id))->result_array();
                                                            foreach ($attendance as $row1): $month_dummy = date('d', $row1['timestamp']);
                                                            if ($i == $month_dummy) $status = $row1['status'];
                                                            endforeach; ?>
                                                            <td class="text-center">
                                                            <?php if ($status == 1) { ?>
                                                                <div class="status-pilli green" data-title="<?php echo getEduAppGTLang('present');?>" data-toggle="tooltip"></div>
                                                            <?php  } if($status == 2)  { ?>
                                                                <div class="status-pilli red" data-title="<?php echo getEduAppGTLang('absent');?>" data-toggle="tooltip"></div>
                                                            <?php  } if($status == 3)  { ?>
                                                                <div class="status-pilli yellow" data-title="<?php echo getEduAppGTLang('late');?>" data-toggle="tooltip"></div>
                                                            <?php  } $status =0;?>
                                                            </td>                      
                                                            <?php } ?>
                                                        </tr>                                      
                                                    </tbody>                
                                                </table>    
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php endif;?>
                        </main>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php endforeach;?>