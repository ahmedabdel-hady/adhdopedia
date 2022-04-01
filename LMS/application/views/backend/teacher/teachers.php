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
															<img src="<?php echo base_url();?>public/uploads/<?php echo $this->crud->getInfo('logo');?>" style="background-color: #fff; padding:10px">
														</div>
														<div class="author-content">
															<a href="javascript:void(0);" class="h3 author-name"><?php echo getEduAppGTLang('teachers');?></a>
															<div class="country"><?php echo $this->crud->getInfo('system_name');?>  |  <?php echo $this->crud->getInfo('system_title');?></div>
														</div>
													</div>
												</div>
												<div class="profile-section" style="background-color: #fff;">
													<div class="control-block-button">
													</div>
												</div>
											</div>
            								<div class="aec-full-message-w">
                								<div class="aec-full-message">
                    								<div class="container-fluid" style="background-color: #f2f4f8;"><br>
                    									<div class="col-sm-12">                           
															<div class="row">
																<?php $teacher = $this->db->get('teacher')->result_array();
                                                                    foreach($teacher as $row):
                                                                ?>
                                                                <div class="col-sm-6 col-md-6 col-lg-4">
                                                                    <div class="ui-block list">
                                                                        <div class="birthday-item inline-items">
                                                                            <div class="author-thumb">
                                                                                <img src="<?php echo $this->crud->get_image_url('teacher', $row['teacher_id']);?>" class="avatars">
                                                                            </div>
                                                                            <div class="birthday-author-name">
                                                                                <a href="javascript:void(0);" class="h6 author-name"><?php echo $this->crud->get_name('teacher', $row['teacher_id']);?></a>
                                                                                <div class="birthday-date"><b><i class="picons-thin-icon-thin-0291_phone_mobile_contact"></i></b> <?php  echo $row['phone'];?></div>
                                                                                <div class="birthday-date"><b><i class="picons-thin-icon-thin-0321_email_mail_post_at"></i></b> <?php echo $row['email'];?></div>
                                                                            </div>                
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