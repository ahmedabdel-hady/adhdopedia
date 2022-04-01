<?php 
    $info = $this->db->get_where('admin', array('admin_id' => $admin_id))->result_array();
    foreach($info as $row):
?>
    <div class="content-w"> 
    	<?php include 'fancy.php';?>
    	<div class="header-spacer"></div>
    	<div class="content-i">
		    <div class="content-box">
    			<div class="conty">
			        <div class="back" style="margin-top:-20px;margin-bottom:10px">		
    	                <a title="<?php echo getEduAppGTLang('return');?>" href="<?php echo base_url();?>admin/admins/"><i class="picons-thin-icon-thin-0131_arrow_back_undo"></i></a>	
	                </div>
    			    <div class="row">
            			<main class="col col-xl-9 order-xl-2 col-lg-12 order-lg-1 col-md-12 col-sm-12 col-12">                
            			    <div id="newsfeed-items-grid">
        						<div class="ui-block paddingtel">
          						    <div class="user-profile">
              							<div class="up-head-w" style="background-image:url(<?php echo base_url();?>public/uploads/bglogin.jpg)">
          								    <div class="up-main-info">
              								   	<div class="user-avatar-w">
          								            <div class="user-avatar">
          								                <img alt="" src="<?php echo $this->crud->get_image_url('admin', $row['admin_id']);?>" class="bg-white">
          								            </div>
          								        </div>
          								        <h3 class="text-white"><?php echo $this->crud->get_name('admin', $row['admin_id']);?></h3>
          								        <h5 class="up-sub-header">@<?php echo $row['username'];?></h5>
          								    </div>
          								    <svg class="decor" width="842px" height="219px" viewBox="0 0 842 219" preserveAspectRatio="xMaxYMax meet" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"><g transform="translate(-381.000000, -362.000000)" fill="#FFFFFF"><path class="decor-path" d="M1223,362 L1223,581 L381,581 C868.912802,575.666667 1149.57947,502.666667 1223,362 Z"></path></g></svg>
          							    </div>
          							    <div class="up-controls">
              								<div class="row">
          								        <div class="col-lg-6">
              								        <div class="value-pair">
          								                <div><?php echo getEduAppGTLang('account_type');?>:</div>
          								                <?php if($row['owner_status'] == 1):?>
              								                <div class="value badge badge-pill badge-success"><?php echo getEduAppGTLang('super_admin');?></div>
          								                <?php else:?>
              								                <div class="value badge badge-pill badge-primary"><?php echo getEduAppGTLang('admin');?></div>
          								                <?php endif;?>
          								            </div>
          								            <div class="value-pair">
              								            <div><?php echo getEduAppGTLang('member_since');?>:</div>
          								                <div class="value"><?php echo $row['since'];?>.</div>
          								            </div>
          								        </div>
          								    </div>
          							    </div>
          							    <div class="ui-block">
										    <div class="ui-block-title">		
    											<h6 class="title"><?php echo getEduAppGTLang('update_information');?></h6>
										    </div>
										    <div class="ui-block-content">
    										    <?php echo form_open(base_url() . 'admin/admins/update_profile/'.$row['admin_id'] , array('enctype' => 'multipart/form-data'));?>
                                    			    <div class="row">   
                                				        <div class="col-sm-6">
                                    				        <div class="form-group label-floating">
                                        				        <label class="control-label"><?php echo getEduAppGTLang('first_name');?></label>
                                        				        <input class="form-control" type="text" name="first_name" value="<?php echo $row['first_name'];?>" required="">
                                        				        <span class="material-input"></span>
                                    					        <span class="material-input"></span>
                                    				        </div>
                                				        </div>
                                        				<div class="col-sm-6"> 
                                            				<div class="form-group label-floating">
                                                				<label class="control-label"><?php echo getEduAppGTLang('last_name');?></label>
                                                				<input class="form-control"  type="text" name="last_name" value="<?php echo $row['last_name'];?>" required="">
                                                				<span class="material-input"></span>
                                            					<span class="material-input"></span>
                                            				</div>
                                        				</div>
                                        				<div class="col-sm-6"> 
                                            				<div class="form-group label-floating">
                                                				<label class="control-label"><?php echo getEduAppGTLang('username');?></label>
                                                				<input class="form-control"  type="text" name="username" value="<?php echo $row['username'];?>" required="">
                                                				<span class="material-input"></span>
                                            					<span class="material-input"></span>
                                            				</div>
                                        				</div>
                                        				<div class="col-sm-6"> 
                                            				<div class="form-group label-floating">
                                                				<label class="control-label"><?php echo getEduAppGTLang('email');?></label>
                                                				<input class="form-control"  type="text" name="email" value="<?php echo $row['email'];?>">
                                                				<span class="material-input"></span>
                                            					<span class="material-input"></span>
                                            				</div>
                                        				</div>
                                        				<div class="col-sm-6"> 
                                            				<div class="form-group label-floating">
                                                				<label class="control-label"><?php echo getEduAppGTLang('phone');?></label>
                                                				<input class="form-control"  type="text" name="phone" value="<?php echo $row['phone'];?>">
                                                				<span class="material-input"></span>
                                            					<span class="material-input"></span>
                                            				</div>
                                        				</div>
                                        				<div class="col-sm-6"> 
                                            				<div class="form-group label-floating">
                                                				<label class="control-label"><?php echo getEduAppGTLang('profession');?></label>
                                                				<input class="form-control"  type="text" name="profession" value="<?php echo $row['profession'];?>">
                                                				<span class="material-input"></span>
                                            					<span class="material-input"></span>
                                            				</div>
                                        				</div>
                                        				<div class="col-sm-12"> 
                                            				<div class="form-group label-floating">
                                                				<label class="control-label"><?php echo getEduAppGTLang('update_password');?></label>
                                                				<input class="form-control"  type="password" name="password">
                                                				<span class="material-input"></span>
                                            					<span class="material-input"></span>
                                            				</div>
                                        				</div>
                                        				<div class="col-sm-6"> 
                                            				<div class="form-group label-floating">
                                                				<label class="control-label"><?php echo getEduAppGTLang('identification');?></label>
                                                				<input class="form-control"  type="text" name="idcard" value="<?php echo $row['idcard'];?>">
                                                				<span class="material-input"></span>
                                            					<span class="material-input"></span>
                                            				</div>
                                        				</div>
                                        				<div class="col-sm-6"> 
                                        					<div class="form-group date-time-picker label-floating is-focused">
                                								<label class="control-label"><?php echo getEduAppGTLang('birthday');?></label>
                                								<input type='text' class="datepicker-here" data-position="top left" value="<?php echo $row['birthday'];?>" data-language='en' name="datetimepicker" data-multiple-dates-separator="/"/>
                                								<span class="input-group-addon">
                                    							<i class="icon-feather-calendar"></i>
                                								</span>
                            								</div>
                            							</div>
                            							<div class="col-sm-6">
                            								<div class="form-group label-floating is-select">
                                								<label class="control-label"><?php echo getEduAppGTLang('account_type');?></label>
                                								<div class="select">
                                    								<select name="owner_status">
                                        								<option value=""><?php echo getEduAppGTLang('select');?></option>
                                        								<option value="1" <?php if($row['owner_status'] == 1) echo "selected";?>><?php echo getEduAppGTLang('super_admin');?></option>
                                        								<option value="0" <?php if($row['owner_status'] == 0) echo "selected";?>><?php echo getEduAppGTLang('admin');?></option>
                                    								</select>
                                								</div>
                            								</div>
                        								</div>
                        								<div class="col-sm-6">
                                            				<div class="form-group">
                                                				<label class="control-label"><?php echo getEduAppGTLang('photo');?></label>
                                                				<input class="form-control" type="file" name="userfile">
                                                				<span class="material-input"></span>
                                            					<span class="material-input"></span>
                                            				</div>
                                        				</div>
                                        				<div class="col-sm-12">
                                            				<div class="form-group label-floating">
        	                      								<label class="control-label"><?php echo getEduAppGTLang('address');?></label>
                              									<textarea class="form-control" name="address" rows="3"><?php echo $row['address'];?></textarea>
                                								<span class="material-input"></span>
        	                    								<span class="material-input"></span>
                            								</div>
                        								</div>
                                        				<div class="col-sm-12">
        	                                    			<div style="float:right;">
                                                				<button class="btn btn-success btn-rounded pull-right" type="submit"> <?php echo getEduAppGTLang('update');?></button>
                                            				</div>
                                        				</div>
	                        				        </div>
	                        				    <?php echo form_close();?>
        								    </div>
          							    </div>
                				    </div>
            				    </div>
        			        </main>
                			<div class="col col-xl-3 order-xl-1 col-lg-6 order-lg-2 col-md-6 col-sm-12 col-12">
                    			<div class="eduappgt-sticky-sidebar">
                        			<div class="sidebar__inner">
                        				<div class="ui-block paddingtel">
                        					<div class="ui-block-content">
                            					<div class="widget w-about">
                                					<a href="javascript:void(0);" class="logo"><img src="<?php echo base_url();?>public/uploads/<?php echo $this->crud->getInfo('logo');?>"></a>
                                					<ul class="socials">
                                    					<li><a class="socialDash fb" href="<?php echo $this->crud->getInfo('facebook');?>"><i class="fab fa-facebook-square" aria-hidden="true"></i></a></li>
                                                        <li><a class="socialDash tw" href="<?php echo $this->crud->getInfo('twitter');?>"><i class="fab fa-twitter" aria-hidden="true"></i></a></li>
                                                        <li><a class="socialDash yt" href="<?php echo $this->crud->getInfo('youtube');?>"><i class="fab fa-youtube" aria-hidden="true"></i></a></li>
                                                        <li><a class="socialDash ig" href="<?php echo $this->crud->getInfo('instagram');?>"><i class="fab fa-instagram" aria-hidden="true"></i></a></li>
                                					</ul>
                            					</div>
                        					</div>
                    					</div>
                        				<div class="ui-block paddingtel">
                        					<div class="ui-block-content">
                        						<div class="help-support-block">
        											<h3 class="title"><?php echo getEduAppGTLang('quick_links');?></h3>
        											<ul class="help-support-list">
        												<li>
        													<i class="picons-thin-icon-thin-0133_arrow_right_next" style="font-size:20px"></i> &nbsp;&nbsp;&nbsp;
        													<a href="<?php echo base_url();?>admin/admin_profile/<?php echo $admin_id;?>/"><?php echo getEduAppGTLang('personal_information');?></a>
        												</li>
        												<li>
        													<i class="picons-thin-icon-thin-0133_arrow_right_next" style="font-size:20px"></i> &nbsp;&nbsp;&nbsp;
        													<a href="<?php echo base_url();?>admin/admin_update/<?php echo $admin_id;?>/"><?php echo getEduAppGTLang('update_information');?></a>
        												</li>
        											</ul>
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
<?php endforeach;?>