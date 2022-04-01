    <div class="content-w">
        <?php include 'fancy.php';?>
        <div class="header-spacer"></div>
        <div class="conte nt-i">
            <div class="ui-block">
		        <div class="top-header top-header-favorit">
					<div class="top-header-thumb">
						<img src="<?php echo base_url();?>public/uploads/bglogin.jpg" style="height:180px; object-fit:cover;">
						<div class="top-header-author">
							<div class="author-thumb">
								<img src="<?php echo base_url();?>public/uploads/<?php echo $this->crud->getInfo('logo');?>" style="background-color: #fff; padding:10px;">
							</div>
							<div class="author-content">
								<a href="javascript:void(0);" class="h3 author-name"><?php echo getEduAppGTLang('notifications_center');?></a>
								<div class="country"><?php echo $this->crud->getInfo('system_name');?>  |  <?php echo $this->crud->getInfo('system_title');?></div>
							</div>
						</div>
					</div>
					<div class="profile-section">
						<div class="control-block-button">
						</div>
					</div>
				</div>
			</div>
            <div class="content-box">
                <div class="conty">
                    <div class="row">
                        <div class="col col-sm-6">
                            <div class="ui-block" data-mh="friend-groups-item">
                                <div class="friend-item friend-groups">
                                    <div class="friend-item-content">
                                        <div class="friend-avatar">
                                            <div class="author-thumb">
                                                <img src="<?php echo base_url();?>public/uploads/icons/sms.svg" width="110px" style="background-color:#fff;padding:15px; border-radius:0px;">
                                            </div>
                                            <div class="author-content">
                                                <a href="javascript:void(0);" class="h5 author-name"><?php echo getEduAppGTLang('send_sms');?></a>
                                                <div class="country"><?php echo getEduAppGTLang('available_for_students');?></div>
                                            </div>
                                        </div>
                                        <div class="control-block-button">
                                            <a data-toggle="modal" data-target="#sendsms" href="#" class="btn btn-control bg-success text-white"><i class="picons-thin-icon-thin-0287_mobile_message_sms"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col col-sm-6">
                            <div class="ui-block" data-mh="friend-groups-item">
                                <div class="friend-item friend-groups">
                                    <div class="friend-item-content">
                                        <div class="friend-avatar">
                                            <div class="author-thumb">
                                                <img src="<?php echo base_url();?>public/uploads/icons/emails.svg" width="110px" style="background-color:#fff;padding:15px; border-radius:0px;">
                                            </div>
                                            <div class="author-content">
                                                <a href="javascript:void(0);" class="h5 author-name"><?php echo getEduAppGTLang('send_emails');?></a>
                                                <div class="country"><?php echo getEduAppGTLang('available_for_students');?></div>
                                            </div>
                                        </div>
                                        <div class="control-block-button">
                                            <a data-toggle="modal" data-target="#sendemails" href="#" class="btn btn-control bg-success text-white"><i class="picons-thin-icon-thin-0315_email_mail_post_send"></i></a>
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

    <div class="modal fade" id="sendemails" tabindex="-1" role="dialog" aria-labelledby="sendemails" aria-hidden="true">
        <div class="modal-dialog window-popup edit-my-poll-popup" role="document">
            <div class="modal-content">
                <a href="#" class="close icon-close" data-dismiss="modal" aria-label="Close"></a>
                <div class="modal-body">
                    <div class="ui-block-title" style="background-color:#00579c">
                        <h6 class="title" style="color:white"><?php echo getEduAppGTLang('send_emails');?></h6>
                    </div>
                    <div class="ui-block-content">
    	                <?php echo form_open(base_url() . 'teacher/notify/send_emails' , array('enctype' => 'multipart/form-data'));?>
                            <div class="row">
                                <div class="col col-lg-6 col-md-6 col-sm-12 col-12">
                                    <div class="form-group label-floating is-select">
                                        <label class="control-label"><?php echo getEduAppGTLang('class');?></label>
                                        <div class="select">
                                            <select name="class_id" onchange="get_class_sections(this.value);">
                                                <option value=""><?php echo getEduAppGTLang('select');?></option>
                                                <?php $cl = $this->db->get('class')->result_array();
                                                    foreach($cl as $row):?>
                                                <option value="<?php echo $row['class_id'];?>"><?php echo $row['name'];?></option>
                                            <?php endforeach;?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col col-lg-6 col-md-6 col-sm-12 col-12">
                                    <div class="form-group label-floating is-select">
                                        <label class="control-label"><?php echo getEduAppGTLang('section');?></label>
                                        <div class="select">
                                            <select name="section_id" id="section_selector_holder">
                                                <option value=""><?php echo getEduAppGTLang('select');?></option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col col-lg-12 col-md-12 col-sm-12 col-12">
                                    <div class="form-group label-floating is-select">
                                        <label class="control-label"><?php echo getEduAppGTLang('receiver');?></label>
                                        <div class="select">
                                            <select required name="receiver">
					                            <option value=""><?php echo getEduAppGTLang('select');?></option>
				                                <option value="student"><?php echo getEduAppGTLang('students');?></option>
					                            <option value="parent"><?php echo getEduAppGTLang('parents');?></option>
	   		                                </select>
                                        </div>
                                    </div>
                                </div>
                          		<div class="col col-lg-12 col-md-12 col-sm-12 col-12">
            	                	<div class="form-group label-floating">
                              			<label class="control-label"><?php echo getEduAppGTLang('email_subject');?></label>
                              			<input class="form-control" name="subject" type="text" required="">
            	                	</div>
                        		</div>
                          		<div class="col col-lg-12 col-md-12 col-sm-12 col-12">          
                            		<div class="form-group">
                              			<label class="control-label"><?php echo getEduAppGTLang('message');?></label>
                              			<textarea id="ckeditor1" name="content" required=""></textarea>
                            		</div>        
                          		</div>                
            	            </div>
          		            <div class="form-buttons-w text-right">
	             	            <center><button class="btn btn-rounded btn-success btn-lg" type="submit"><?php echo getEduAppGTLang('send');?></button></center>
          		            </div>
          	            <?php echo form_close();?>        
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="modal fade" id="sendsms" tabindex="-1" role="dialog" aria-labelledby="sendsms" aria-hidden="true">
        <div class="modal-dialog window-popup create-friend-group create-friend-group-1" role="document">
            <div class="modal-content">
                <?php echo form_open(base_url() . 'teacher/notify/sms' , array('enctype' => 'multipart/form-data'));?>
                    <a href="#" class="close icon-close" data-dismiss="modal" aria-label="Close"></a>
                    <div class="modal-header">
                        <h6 class="title"><?php echo getEduAppGTLang('send_sms');?></h6>
                    </div>
                    <div class="modal-body">
                        <div class="form-group label-floating is-select">
                            <label class="control-label"><?php echo getEduAppGTLang('class');?></label>
                            <div class="select">
                                <select name="class_id" onchange="get_class_sections2(this.value);" required="">
                                    <option value=""><?php echo getEduAppGTLang('select');?></option>
                                    <?php $cl = $this->db->get('class')->result_array();
                                        foreach($cl as $row):?>
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
                        <div class="form-group label-floating is-select">
                            <label class="control-label"><?php echo getEduAppGTLang('receiver');?></label>
                            <div class="select">
                                <select required name="receiver">
    						        <option value=""><?php echo getEduAppGTLang('select');?></option>
    					            <option value="student"><?php echo getEduAppGTLang('students');?></option>
    						        <option value="parent"><?php echo getEduAppGTLang('parents');?></option>
    		   		            </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <textarea rows="3" class="form-control" name="msg" required placeholder="<?php echo getEduAppGTLang('message');?>..."></textarea>
                        </div>        
                        <button type="submit" class="btn btn-rounded btn-success btn-lg full-width"><?php echo getEduAppGTLang('send');?></button>
                    </div>
                <?php echo form_close();?>
            </div>
        </div>
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
    </script>
    <script type="text/javascript">
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
    
    <script type="text/javascript">
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