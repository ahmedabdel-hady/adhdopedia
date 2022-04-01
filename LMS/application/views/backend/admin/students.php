<?php $running_year = $this->crud->getInfo('running_year');?>
    <div class="content-w">
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
															<img src="<?php echo base_url();?>public/uploads/<?php echo $this->crud->getInfo('logo');?>" style="background-color: #fff; padding:10px;">
														</div>
														<div class="author-content">
															<a href="javascript:void(0);" class="h3 author-name"><?php echo getEduAppGTLang('students');?> <small>(<?php if($class_id > 0) echo $this->db->get_where('class', array('class_id' => $class_id))->row()->name;?>)</small></a>
															<div class="country"><?php echo $this->crud->getInfo('system_name');?>  |  <?php echo $this->crud->getInfo('system_title');?></div>
														</div>
													</div>
												</div>
												<div class="profile-section" style="background-color: #fff;">
													<div class="control-block-button">
                            							<a data-toggle="modal" data-target="#bulkstudents" href="javascript:void(0);" class="btn btn-control bg-purple" style="background:#0084ff; color: #fff;">
                                                            <i class="picons-thin-icon-thin-0089_upload_file" title="<?php echo getEduAppGTLang('upload_from_excel');?>"></i>
                                                        </a>
                                                        <a href="javascript:void(0);" data-toggle="modal" data-target="#student_export" class="btn btn-control bg-purple" style="background:#99bf2d; color: #fff;">
                                                            <i class="picons-thin-icon-thin-0129_download" title="<?php echo getEduAppGTLang('export_students');?>"></i>
                                                        </a>
													</div>
												</div>
											</div>
            								<div class="aec-full-message-w">
                								<div class="aec-full-message">
                    								<div class="container-fluid" style="background-color: #f2f4f8;"><br>
                    									<div class="col-sm-12">  
                    									<?php echo form_open(base_url() . 'admin/students/', array('class' => 'form m-b'));?>
			                                                <div class="row">
			                                                    <div class="col col-lg-6 col-md-6 col-sm-12 col-12">
                		                                            <div class="form-group label-floating" style="background-color: #fff;">
                  			                                            <label class="control-label"><?php echo getEduAppGTLang('search');?></label>
                  			                                            <input class="form-control" id="filter" type="text" required="">
                		                                            </div>
              		                                            </div>
			                                                    <div class="col col-lg-6 col-md-6 col-sm-12 col-12">
              			                                            <div class="form-group label-floating is-select">
                                                                        <label class="control-label"><?php echo getEduAppGTLang('filter_by_class');?></label>
                                                                        <div class="select">
                                                                            <select onchange="submit();" name="class_id" id="slct">
                                                                                <option value=""><?php echo getEduAppGTLang('select');?></option>
					                                                            <?php $cl = $this->db->get('class')->result_array();
                                                                                    foreach($cl as $row):
                  	                                                            ?>
                                                                                    <option value="<?php echo $row['class_id'];?>" <?php if($class_id == $row['class_id']) echo 'selected';?>><?php echo $row['name'];?></option>
                                                                                <?php endforeach;?>
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                </div>
			                                                </div>
	                                                        <?php echo form_close();?>
                    										<div class="ui-block">
                    											<div class="os-tabs-w">
																	<div class="os-tabs-controls">
		  																<ul class="navs navs-tabs upper" style="padding-left:20px; padding-top:20px">
																			<li class="navs-item" style="display:inline;">
			  																	<a class="navs-link active" style="color:#000;" data-toggle="tab" href="#all"><?php echo getEduAppGTLang('all');?></a>
																			</li>
																			<?php $query = $this->db->get_where('section' , array('class_id' => $class_id)); 
               																if ($query->num_rows() > 0):
               																$sections = $query->result_array();
               																foreach ($sections as $rows):?>
																			<li class="navs-item">
			  																	<a class="navs-link" style="color:#000;" data-toggle="tab" href="#tab<?php echo $rows['section_id'];?>"><?php echo getEduAppGTLang('section');?> <?php echo $rows['name'];?></a>
																			</li>
																			<?php endforeach;?>
																			<?php endif;?>
		  																</ul>
																	</div>
	  															</div>
	  														</div>
															<div class="tab-content">
																<div class="tab-pane active" id="all">
         															<div class="row" id="results">
         															    <?php if($students = $this->db->get_where('enroll' , array('class_id' => $class_id , 'year' => $running_year))->num_rows() > 0):?>
																		<?php $students = $this->db->get_where('enroll' , array('class_id' => $class_id , 'year' => $running_year))->result_array();
               																foreach($students as $row):?>
                														  <div class="col-xl-4 col-md-6 results">
                        													   <div class="card-box widget-user ui-block list">
                            													    <div class="more" style="float:right;">
                                    												    <i class="icon-options"></i>    
                                    												    <ul class="more-dropdown">
                                        												    <li><a href="javascript:void(0);" onclick="showAjaxModal('<?php echo base_url();?>modal/popup/modal_estudiante/<?php echo $row['student_id'];?>');"><?php echo getEduAppGTLang('edit');?></a></li>
                                        												    <li><a onClick="return confirm('<?php echo getEduAppGTLang('confirm_delete');?>')" href="<?php echo base_url();?>admin/delete_student/<?php echo $row['student_id'];?>"><?php echo getEduAppGTLang('delete');?></a></li>
                                    											        </ul>
                                												    </div>
                            												        <div>
                             												        <img src="<?php echo $this->crud->get_image_url('student', $row['student_id']);?>" class="img-responsive rounded-circle" alt="user">
                             												        <div class="wid-u-info">
                                 												        <a href="<?php echo base_url();?>admin/student_portal/<?php echo $row['student_id'];?>/" class="h6 author-name"><h5 class="mt-0 m-b-5"> <?php echo $this->crud->get_name('student', $row['student_id']);?></h5></a>
                                 												        <p class="text-muted m-b-5 font-13"><b><i class="picons-thin-icon-thin-0291_phone_mobile_contact"></i></b> <?php echo $this->db->get_where('student' , array('student_id' => $row['student_id']))->row()->phone;?><br>
                                 												            <b><i class="picons-thin-icon-thin-0321_email_mail_post_at"></i></b> <?php echo $this->db->get_where('student' , array('student_id' => $row['student_id']))->row()->email;?><br>
                                     											            <b><i class="picons-thin-icon-thin-0729_student_degree_science_university_school_graduate"></i></b> <span class="badge badge-primary" style="font-size:10px;"><?php echo $this->db->get_where('class', array('class_id' => $row['class_id']))->row()->name;?> - <?php echo $this->db->get_where('section', array('section_id' => $row['section_id']))->row()->name;?></span>
                                 												        </p>
                             												        </div>
                         												        </div>
                     												        </div>
                 												        </div>
                											        <?php endforeach;?>
                											        <?php else:?>
                											            <div class="col-xl-12 col-md-12 bg-white">
                											                <center><img src="<?php echo base_url();?>public/uploads/empty.png"></center>
                											            </div>
                											            <?php endif;?>
    														        </div>
													            </div>
	  												    <?php $query = $this->db->get_where('section' , array('class_id' => $class_id));
           												    if ($query->num_rows() > 0):
           												    $sections = $query->result_array();
        												    foreach ($sections as $row): ?>
														        <div class="tab-pane" id="tab<?php echo $row['section_id'];?>">
	        												        <div class="row">
	        												    <?php if($students = $this->db->get_where('enroll' , array('class_id'=> $class_id , 'section_id' => $row['section_id'] , 'year' => $running_year))->num_rows() > 0):?>
																		<?php $students = $this->db->get_where('enroll' , array('class_id'=> $class_id , 'section_id' => $row['section_id'] , 'year' => $running_year))->result_array();
                															foreach($students as $row2):?>	
                														<div class="col-xl-4 col-md-6">
                        													<div class="card-box widget-user ui-block list">
                            													<div class="more" style="float:right;">
                                    												<i class="icon-options"></i>    
                                    												<ul class="more-dropdown">
                                        												<li><a href="javascript:void(0);" onclick="showAjaxModal('<?php echo base_url();?>modal/popup/modal_estudiante/<?php echo $row2['student_id'];?>');"><?php echo getEduAppGTLang('edit');?></a></li>
                                        												<li><a onClick="return confirm('<?php echo getEduAppGTLang('confirm_delete');?>')" href="<?php echo base_url();?>admin/delete_student/<?php echo $row2['student_id'];?>"><?php echo getEduAppGTLang('delete');?></a></li>
                                    												</ul>
                                												</div>
                            												    <div>
                             												        <img src="<?php echo $this->crud->get_image_url('student',$row2['student_id']);?>" class="img-responsive rounded-circle" alt="user">
                             												        <div class="wid-u-info">
                                 												        <a href="<?php echo base_url();?>admin/student_portal/<?php echo $row2['student_id'];?>/" class="h6 author-name"><h5 class="mt-0 m-b-5"> <?php echo $this->crud->get_name('student', $row2['student_id']);?></h5></a>
                                 												        <p class="text-muted m-b-5 font-13"><b><i class="picons-thin-icon-thin-0291_phone_mobile_contact"></i></b> <?php echo $this->db->get_where('student' , array('student_id' => $row2['student_id']))->row()->phone;?><br>
                                 												        <b><i class="picons-thin-icon-thin-0321_email_mail_post_at"></i></b> <?php echo $this->db->get_where('student' , array('student_id' => $row2['student_id']))->row()->email;?><br>
                                 												        <b><i class="picons-thin-icon-thin-0729_student_degree_science_university_school_graduate"></i></b> <span class="badge badge-primary" style="font-size:10px;"><?php echo $this->db->get_where('class', array('class_id' => $row2['class_id']))->row()->name;?> - <?php echo $this->db->get_where('section', array('section_id' => $row2['section_id']))->row()->name;?></span></p>
                             												        </div>
                         												        </div>
                     												        </div>
                 												        </div>
                											            <?php endforeach;?>
                												        <?php else:?>
                											            <div class="col-xl-12 col-md-12 bg-white">
                											                <center><img src="<?php echo base_url();?>public/uploads/empty.png"></center>
                											            </div>
                											        <?php endif;?>
														            </div>
														        </div>
	 												        <?php endforeach;?>
        											        <?php endif;?>
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
                </div>
                <div class="display-type"></div>
            </div>
        </div>
    </div>


    <div class="modal fade" id="student_export" tabindex="-1" role="dialog" aria-labelledby="student_export" aria-hidden="true" style="margin-top: 150px;">
        <div class="modal-dialog window-popup edit-widget edit-widget-twitter" role="document">
            <div class="modal-content">
                <a href="javascript:void(0);" class="close icon-close" data-dismiss="modal" aria-label="Close"></a>
                <div class="modal-header" style="background-color:#00579c">
                    <h6 class="title" style="color:white"><?php echo getEduAppGTLang('export_students');?></h6>
                </div>
                <div class="modal-body">
                    <?php echo form_open(base_url() . 'admin/student/excel' , array('enctype' => 'multipart/form-data'));?>
                        <div class="form-group label-floating is-select">
                            <label class="control-label"><?php echo getEduAppGTLang('class');?></label>
                            <div class="select">
                                <select name="class_id" required="" onchange="get_class_sections(this.value);">
                                    <option value=""><?php echo getEduAppGTLang('select');?></option>
                                    <?php $classes = $this->db->get('class')->result_array();
                                        foreach($classes as $row):
                                    ?>
                                    <option value="<?php echo $row['class_id'];?>"><?php echo $row['name'];?></option>
                                    <?php endforeach;?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group label-floating is-select">
                            <label class="control-label"><?php echo getEduAppGTLang('section');?></label>
                            <div class="select">
                                <select name="section_id" id="section_selector_holder">
                                    <option value=""><?php echo getEduAppGTLang('select');?></option>
                                </select>
                            </div>
                        </div>
                        <button class="btn btn-rounded btn-purple  btn-icon-left" type="submit"><i class="picons-thin-icon-thin-0129_download"></i> <?php echo getEduAppGTLang('export');?></button></center>
                    <?php echo form_close();?>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="bulkstudents" tabindex="-1" role="dialog" aria-labelledby="bulkstudents" aria-hidden="true">
        <div class="modal-dialog window-popup create-friend-group create-friend-group-1" role="document">
            <div class="modal-content">
                <?php echo form_open(base_url() . 'admin/student/bulk' , array('enctype' => 'multipart/form-data'));?>
                    <a href="javascript:void(0);" class="close icon-close" data-dismiss="modal" aria-label="Close"></a>
                    <div class="modal-header">
                        <h6 class="title"><?php echo getEduAppGTLang('upload_students');?></h6>
                    </div>
                    <div class="modal-body">
                        <div class="form-group label-floating is-select">
                            <label class="control-label"><?php echo getEduAppGTLang('class');?></label>
                            <div class="select">
                                <select name="class_id" required="" onchange="get_class_sections2(this.value);">
                                    <option value=""><?php echo getEduAppGTLang('select');?></option>
                                    <?php $classes = $this->db->get('class')->result_array();
                                        foreach($classes as $row):
                                    ?>
                                    <option value="<?php echo $row['class_id'];?>"><?php echo $row['name'];?></option>
                                    <?php endforeach;?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group label-floating is-select">
                            <label class="control-label"><?php echo getEduAppGTLang('section');?></label>
                            <div class="select">
                                <select name="section_id" id="section_selector_holder2">
                                    <option value=""><?php echo getEduAppGTLang('select');?></option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group with-button">
                            <a href="<?php echo base_url();?>public/uploads/templates/students.xlsx"><input class="form-control " readonly value="<?php echo getEduAppGTLang('download_template');?>" type="text" style="cursor: default; color:#000: font-weight:bold">
                            <button class="bg-primary"><i class="icon-feather-download"></i></button></a>
                        </div>
                        <div class="form-group">
                            <input type="file" class="form-control" name="upload_student" required="">
                        </div>        
                        <button type="submit" class="btn btn-rounded btn-success btn-lg full-width"><?php echo getEduAppGTLang('upload');?></button>
                    </div>
                <?php echo form_close();?>
            </div>
        </div>
    </div>

    <script type="text/javascript">
        window.onload=function(){      
            $("#filter").keyup(function() {
                var filter = $(this).val(),   
                count = 0;
                $('#results div').each(function() {
                    if ($(this).text().search(new RegExp(filter, "i")) < 0) {
                        $(this).hide();
                    } else {
                        $(this).show();
                        count++;
                    }
                });
            });
        }

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

        function get_class_sections2(class_id) 
        {
            $.ajax({
                url: '<?php echo base_url();?>admin/get_class_section/' + class_id ,
                success: function(response)
                {
                    jQuery('#section_selector_holder2').html(response);
                }
            });
        }
    </script>