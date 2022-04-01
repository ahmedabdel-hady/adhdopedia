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
													<img src="<?php echo base_url();?>public/uploads/bglogin.jpg" alt="nature" style="height:180px; object-fit:cover;">
													<div class="top-header-author">
														<div class="author-thumb">
															<img src="<?php echo base_url();?>public/uploads/<?php echo $this->crud->getInfo('logo');?>" style="background-color: #fff; padding:10px;">
														</div>
														<div class="author-content">
															<a href="javascript:void(0);" class="h3 author-name"><?php echo getEduAppGTLang('calassrooms');?></a>
															<div class="country"><?php echo $this->crud->getInfo('system_name');?>  |  <?php echo $this->crud->getInfo('system_title');?></div>
														</div>
													</div>
												</div>
												<div class="profile-section" style="background-color: #fff;">
													<div class="control-block-button">
                            							 <a href="javascript:void(0);" class="btn btn-control bg-purple" style="background:#99bf2d; color: #fff;" data-toggle="modal" data-target="#crearadmin">
															<i class="picons-thin-icon-thin-0001_compose_write_pencil_new" style="font-size:25px;" title="<?php echo getEduAppGTLang('add');?>"></i>
														<div class="ripple-container"></div></a>
													</div>
												</div>
											</div>
            								<div class="aec-full-message-w">
                								<div class="aec-full-message">
                    								<div class="container-fluid" style="background-color: #f2f4f8;"><br>
                    									<div class="col-sm-12">     
															<div class="row">
																<?php 
																    $this->db->order_by('dormitory_id', 'desc');
																    $rooms = $this->db->get('dormitory')->result_array();
					                                                foreach($rooms as $room):
				                                                ?>
                                  								<div class="col-sm-6">
			                                                        <div class="ui-block list">
			                                                            <div class="more" style="float:right; margin-right:15px; ">
                                                                            <i class="icon-options"></i>                                
                                                                            <ul class="more-dropdown" style="z-index:999">
                                                                                <li><a href="javascript:void(0);" onclick="showAjaxModal('<?php echo base_url();?>modal/popup/modal_classrooms/<?php echo $room['dormitory_id'];?>');"><?php echo getEduAppGTLang('students');?></a></li>
                                                                                <li><a href="javascript:void(0);" onclick="showAjaxModal('<?php echo base_url();?>modal/popup/modal_classroom/<?php echo $room['dormitory_id'];?>');"><?php echo getEduAppGTLang('edit');?></a></li>
                                                                                <li><a onClick="return confirm('<?php echo getEduAppGTLang('confirm_delete');?>')" href="<?php echo base_url();?>admin/classrooms/delete/<?php echo $room['dormitory_id'];?>"><?php echo getEduAppGTLang('delete');?></a></li>
                                                                            </ul>
                                                                        </div>
				                                                        <div class="birthday-item inline-items">
                                                                            <div class="circle blue"><?php echo $room['name'][0];?></div>&nbsp;
					                                                        <div class="birthday-author-name">
					                                                            <a href="javascript:void(0);" class="h6 author-name"><?php echo $room['name'];?></a>
						                                                        <div><b><?php echo getEduAppGTLang('students');?>:</b> <?php $this->db->where('dormitory_id', $room['dormitory_id']); echo $this->db->count_all_results('student');?>.</div>
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

 
    <div class="modal fade" id="crearadmin" tabindex="-1" role="dialog" aria-labelledby="crearadmin" aria-hidden="true" style="top:10%;">
        <div class="modal-dialog window-popup edit-my-poll-popup" role="document">
            <div class="modal-content">
                <a href="javascript:void(0);" class="close icon-close" data-dismiss="modal" aria-label="Close"></a>
                <div class="modal-body">
                    <div class="modal-header" style="background-color:#00579c">
                        <h6 class="title" style="color:white"><?php echo getEduAppGTLang('add');?></h6>
                    </div>
                    <div class="ui-block-content">
                        <?php echo form_open(base_url() . 'admin/classrooms/create/' , array('enctype' => 'multipart/form-data'));?>
                            <div class="row">
                                <div class="col col-lg-12 col-md-12 col-sm-12 col-12">
                                    <div class="form-group label-floating">
                                        <label class="control-label"><?php echo getEduAppGTLang('name');?></label>
                                        <input class="form-control" type="text" name="name" required="">
                                    </div>
                                </div>
                                <div class="col col-lg-6 col-md-6 col-sm-12 col-12">
                                    <button class="btn btn-rounded btn-success" type="submit"><?php echo getEduAppGTLang('save');?></button>
                                </div>
                            </div>
                        <?php echo form_close();?>
                    </div>
                </div>
            </div>
        </div>
    </div>

