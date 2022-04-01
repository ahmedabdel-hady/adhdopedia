    <div class="content-w">
    <?php $running_year = $this->crud->getInfo('running_year');?>
        <?php include 'fancy.php';?>
        <div class="header-spacer"></div>
        <div class="conty">
            <div class="all-wrapper no-padding-content solid-bg-all">
                <div class="layout-w">
                    <div class="content-w">
                        <div class="content-i">
                            <div class="content-box">
                                <div class="app-email-w">
                                    <div class="app-email-i">
                                        <div class="ae-content-w" style="background-color: #f2f4f8;">
                                            <div class="top-header top-header-favorit">
                                                <div class="top-header-thumb">
                                                    <img src="<?php echo base_url();?>public/uploads/bglogin.jpg" style="height:180px; object-fit:cover;">
                                                    <div class="top-header-author">
                                                        <div class="author-thumb">
                                                            <img src="<?php echo base_url();?>public/uploads/<?php echo $this->crud->getInfo('logo');?>" style="background-color: #fff;padding:10px">
                                                        </div>
                                                        <div class="author-content">
                                                            <a href="javascript:void(0);" class="h3 author-name"><?php echo getEduAppGTLang('academic');?></a>
                                                            <div class="country"><?php echo $this->crud->getInfo('system_name');?>  |  <?php echo $this->crud->getInfo('system_title');?></div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="profile-section">
                                                    <div class="container-fluid">
                                                        <div class="row">
                                                            <div class="col col-xl-8 m-auto col-lg-8 col-md-12">
                                                                <div class="os-tabs-w">
                                                                    <div class="os-tabs-controls">
                                                                        <ul class="navs navs-tabs upper">
                                                                        <?php 
                        			  	                                    $n = 1;
                    			  	                                        $children_of_parent = $this->db->get_where('student' , array('parent_id' => $this->session->userdata('parent_id')))->result_array();
                                                                            foreach ($children_of_parent as $row):?>
                                                                            <li class="navs-item">
                                                                        	<?php $active = $n++;?>
                    				  		                                    <a class="navs-links <?php if($active == 1) echo 'active';?>" data-toggle="tab" href="#<?php echo $row['username'];?>"><img alt="" src="<?php echo $this->crud->get_image_url('student', $row['student_id']);?>" width="25px" style="border-radius: 25px;margin-right:5px;"> <?php echo $this->crud->get_name('student', $row['student_id']);?></a>
                    					                                    </li>
                                                                        <?php endforeach; ?>
                                                                        </ul>
                                                                    </div> 
                                                                </div>                                        
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="aec-full-message-w">
                                                <div class="aec-full-message">
                                                    <div class="container-fluid" style="background-color: #f2f4f8;">
                                                        <div class="tab-content">
                                                        <?php 
                                			                $n = 1;
			                                                $children_of_parent = $this->db->get_where('student' , array('parent_id' => $this->session->userdata('parent_id')))->result_array();
                                                            foreach ($children_of_parent as $row3):
                                                            $class_id = $this->db->get_where('enroll' , array('student_id' => $row3['student_id'] , 'year' => $running_year))->row()->class_id;
                                                            $section_id = $this->db->get_where('enroll' , array('student_id' => $row3['student_id'] , 'year' => $running_year))->row()->section_id;
                                                        ?>
        	                                            <?php $active = $n++;?>
	 		                                                <div class="tab-pane <?php if($active == 1) echo 'active';?>" id="<?php echo $row3['username'];?>">
                                                                <div class="row">
                                                                <?php 
                                                                    $this->db->order_by('subject_id', 'desc');
                                                                    $subjects = $this->db->get_where('subject', array('class_id' => $class_id, 'section_id' => $section_id))->result_array();
                                                                    foreach($subjects as $row2):
                                                                ?>
                                                                    <div class="col col-xl-3 col-lg-6 col-md-6 col-sm-12 col-12">
                                                                        <div class="ui-block" data-mh="friend-groups-item">        
                                                                            <div class="friend-item friend-groups">
                                                                                <div class="friend-item-content">         
                                                                                    <div class="more">
                                                                                        <i class="icon-feather-more-horizontal"></i>
                                                                                        <ul class="more-dropdown">
                                                                                            <li><a href="<?php echo base_url();?>parents/subject_dashboard/<?php echo base64_encode($class_id."-".$section_id."-".$row2['subject_id']);?>/"><?php echo getEduAppGTLang('dashoard');?></a></li>
                                                                                        </ul>
                                                                                    </div>
                                                                                    <div class="friend-avatar">
                                                                                        <div class="author-thumb">
                                                                                            <img src="<?php echo base_url();?>public/uploads/subject_icon/<?php echo $row2['icon'];?>" width="120px" style="background-color:#<?php echo $row2['color'];?>;padding:30px;border-radius:0px;">
                                                                                        </div>
                                                                                        <div class="author-content">
                                                                                            <a href="<?php echo base_url();?>parents/subject_dashboard/<?php echo base64_encode($class_id."-".$section_id."-".$row2['subject_id'].'-'.$row3['student_id']);?>/" class="h5 author-name"><?php echo $row2['name'];?></a><br><br>
                                                                                            <img src="<?php echo $this->crud->get_image_url('teacher', $row2['teacher_id']);?>" style="border-radius:50%;width:20px;"><span>  <?php echo $this->crud->get_name('teacher', $row2['teacher_id']);?></span>
                                                                                        </div>                          
                                                                                    </div>                        
                                                                                </div>
                                                                            </div>        
                                                                        </div>
                                                                    </div>
                                                                    <?php endforeach;?>
                                                                </div>
                                                            </div>
                                                        <?php endforeach;?>
                                                        </div>  
                                                    </div>
                                                </div>
                                            </div>    
                                        </div>  
                                    </div>
                                </div>  
                            </div>
                        </div>
                    </div>
                </div>
                <div class="display-type"></div>
            </div>
        </div>
    </div>   