<?php $min = $this->db->get_where('academic_settings' , array('type' =>'minium_mark'))->row()->description;?>
<?php $running_year = $this->crud->getInfo('running_year'); ?>
    <div class="content-w">
        <div class="conty">
            <?php include 'fancy.php';?>
            <div class="header-spacer"></div>
	        <div class="content-i">
                <div class="content-box">
			        <div class="row">	
				    <?php 
        				$student_info = $this->db->get_where('enroll' , array('student_id' => $this->session->userdata('login_user_id') , 'year' => $running_year))->result_array();
    				    $exams = $this->db->get('exam')->result_array();
    				    foreach ($student_info as $row1):
    				    foreach ($exams as $row2):
				    ?>
				        <div class="col-sm-12">
					        <div class="element-box lined-primary shadow">
    					        <h5 class="form-header"><?php echo getEduAppGTLang('your_marks');?><br>
	  						        <small><?php echo $row2['name'];?></small>
    					        </h5>
    					        <div class="table-responsive">
      						        <table class="table table-lightborder">
        						        <thead>
          							        <tr>
            							        <th><?php echo getEduAppGTLang('subject');?></th>
										        <th><?php echo getEduAppGTLang('teacher');?></th>
										        <th><?php echo getEduAppGTLang('mark');?></th>
                                                <th><?php echo getEduAppGTLang('grade');?></th>
										        <th><?php echo getEduAppGTLang('comment');?></th>
										        <th><?php echo getEduAppGTLang('view_all');?></th>
          							        </tr>
        						        </thead>
        						        <tbody>
        							    <?php 
                                			$subjects = $this->db->get_where('subject' , array('class_id' => $row1['class_id'], 'section_id' => $row1['section_id']))->result_array();
                            			    foreach ($subjects as $row3): 
                                 		    $obtained_mark_query = $this->db->get_where('mark' , array(
                                    	    'subject_id' => $row3['subject_id'], 'exam_id' => $row2['exam_id'],'class_id' => $row1['class_id'], 'student_id' => $this->session->userdata('login_user_id'),'year' => $running_year));
                             			    if($obtained_mark_query->num_rows() > 0) 
                                		    {
                                        		$marks = $obtained_mark_query->result_array();
                                        		foreach ($marks as $row4):
                            		    ?>
          							        <tr> 
            							        <td><?php echo $row3['name'];?></td>
            							        <td><img alt="" src="<?php echo $this->crud->get_image_url('teacher',$row3['teacher_id']);?>" width="25px" style="border-radius: 10px;margin-right:5px;"> <?php echo $this->crud->get_name('teacher', $row3['teacher_id']); ?></td>
										        <td>
										            <?php $mark = $this->db->get_where('mark' , array('subject_id' => $row3['subject_id'], 'exam_id' => $row2['exam_id'], 'student_id' => $this->session->userdata('login_user_id'), 'year' => $running_year))->row()->labtotal;?>
                                                    <?php if($mark < $min || $mark == 0):?>
                                                    <a class="btn btn-rounded btn-sm btn-danger" style="color:white"><?php if($this->db->get_where('mark' , array('subject_id' => $row3['subject_id'], 'exam_id' => $row2['exam_id'], 'student_id' => $this->session->userdata('login_user_id'), 'year' => $running_year))->row()->labtotal == 0) echo '0'; else echo $mark;?></a>
                                                    <?php endif;?>
                                                    <?php if($mark >= $min):?>
                                                    <a class="btn btn-rounded btn-sm btn-info" style="color:white"><?php echo $this->db->get_where('mark' , array('subject_id' => $row3['subject_id'], 'exam_id' => $row2['exam_id'], 'student_id' => $this->session->userdata('login_user_id'), 'year' => $running_year))->row()->labtotal;?></a>
                                                    <?php endif;?>
                                                </td>
                                                <td><?php echo $grade = $this->crud->get_grade($this->db->get_where('mark' , array('subject_id' => $row3['subject_id'], 'exam_id' => $row2['exam_id'], 'student_id' => $this->session->userdata('login_user_id'), 'year' => $running_year))->row()->labtotal);?></td>
              							        <td><?php echo $this->db->get_where('mark' , array('subject_id' => $row3['subject_id'], 'exam_id' => $row2['exam_id'], 'student_id' => $this->session->userdata('login_user_id'), 'year' => $running_year))->row()->comment; ?></td>
										            <?php $data = base64_encode($row1['class_id']."-".$row1['section_id']."-".$row3['subject_id']); ?>
                                                <td><a class="btn btn-rounded btn-sm btn-primary" style="color:white" href="<?php echo base_url();?>student/subject_marks/<?php echo $data;?>/"><?php echo getEduAppGTLang('view_all');?></a></td>
          							        </tr>
          							        <?php endforeach; }endforeach;?>
        						        </tbody>	
      						        </table>
      						        <div class="form-buttons-w text-right">
                                        <a target="_blank" href="<?php echo base_url();?>student/marks_print_view/<?php echo base64_encode($this->session->userdata('login_user_id').'-'. $row2['exam_id']);?>/"><button class="btn btn-rounded btn-success" type="submit"><i class="picons-thin-icon-thin-0333_printer"></i>  <?php echo getEduAppGTLang('print');?></button></a>
                                    </div>
    					        </div>
  					        </div>
				        </div>	
				        <?php endforeach; endforeach; ?>
			        </div>
		        </div>
	        </div>
	    </div>
    </div>