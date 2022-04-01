    <div class="content-w" > 
        <?php include 'fancy.php';?>
        <div class="header-spacer"></div>
        <div class="conty">
            <div class="header-spacer"></div>      
            <div class="container">
	            <div class="row">
		            <div class="col  col-sm-12 col-12">
			            <div class="ui-block">
				            <div class="ui-block-title">
					            <h6 class="title"><?php echo getEduAppGTLang('search_results');?></h6>
				            </div>
				            <?php 
				                $query = base64_decode($search_key);
				                $this->db->like('first_name' , str_replace("%20", " ", $query));
				                $this->db->or_like('last_name' , str_replace("%20", " ", $query));
					            $student_query = $this->db->get('student');
					            if($student_query->num_rows() > 0):
					            $students = $student_query->result_array();
                            ?>
				            <ul class="notification-list">
				               <?php  foreach($students as $row):?>
					           <li>
						            <div class="author-thumb">
							            <img src="<?php echo $this->crud->get_image_url('student', $row['student_id']);?>" width="35px">
						            </div>
						            <div class="notification-event">
							            <a href="<?php echo base_url();?>admin/student_portal/<?php echo $row['student_id'];?>/" class="h6 notification-friend"><?php echo $this->crud->get_name('student', $row['student_id']) ;?></a>.
							            <span class="notification-date"><span class="badge badge-success"><?php $class_id = $this->db->get_where('enroll', array('student_id' => $row['student_id']))->row()->class_id; echo $this->db->get_where('class', array('class_id' => $class_id))->row()->name;?></span></span>
						            </div>
					            </li>
				            <?php endforeach;?>
				            </ul>
				            <?php else:?>
				            <div class="bg-danger">
				                <div class="container">
				                    <div class="col-sm-12"><br><br>
    				                    <h3 class="text-white"> <?php echo getEduAppGTLang('no_results_found');?></h3><br><br>
				                    </div>
				                </div>
				            </div>
                            <?php endif;?>
			            </div>
		            </div>
	            </div>
            </div>
	    </div>
    </div>