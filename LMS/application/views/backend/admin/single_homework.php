    <?php 
        $info = $this->db->get_where('deliveries', array('id' => $answer_id))->result_array();
	  	foreach($info as $row): 
	  	$time1 = $this->db->get_where('homework', array('homework_code' => $row['homework_code']))->row()->date_end; 
	  	$time2 = $this->db->get_where('homework', array('homework_code' => $row['homework_code']))->row()->time_end; 
		$time = $time1. " ".$time2;	
	?>
	<div class="content-w">
	    <div class="conty">
        <?php include 'fancy.php';?>
        <div class="header-spacer"></div>
	        <div class="os-tabs-w menu-shad">
		        <div class="os-tabs-controls">
            	    <ul class="navs navs-tabs upper">
    			        <li class="navs-item">
			                <a class="navs-links" href="<?php echo base_url();?>admin/homeworkroom/<?php echo $row['homework_code'];?>/"><i class="os-icon picons-thin-icon-thin-0014_notebook_paper_todo"></i><span><?php echo getEduAppGTLang('homework_details');?></span></a>
			            </li>
			            <li class="navs-item">
			                <a class="navs-links active" href="<?php echo base_url();?>admin/homework_details/<?php echo $row['homework_code'];?>/"><i class="os-icon picons-thin-icon-thin-0100_to_do_list_reminder_done"></i><span><?php echo getEduAppGTLang('deliveries');?></span></a>
			            </li>
			            <li class="navs-item">
			                <a class="navs-links" href="<?php echo base_url();?>admin/homework_edit/<?php echo $row['homework_code'];?>/"><i class="os-icon picons-thin-icon-thin-0001_compose_write_pencil_new"></i><span><?php echo getEduAppGTLang('edit');?></span></a>
			            </li>
		            </ul>
		        </div>
	        </div>
            <div class="content-i">
                <div class="content-box">
	                <div class="row">
	                    <div class="col-sm-8">
			                <div class="pipeline white lined-primary">
		                        <div class="pipeline-header">
			                        <div class="users-list-w">
			                            <div class="user-w" style="border-bottom:none">
			                                <div class="user-avatar-w">
				                                <div class="user-avatar">
				                                    <img alt="" src="<?php echo $this->crud->get_image_url('student', $row['student_id']); ?>">
				                                </div>
			                                </div>
			                                <div class="user-name">
				                                <h6 class="user-title"><?php echo $this->crud->get_name('student',$row['student_id']);?></h6>
			                                </div>
			                            </div>
			                        </div>
		                        </div>
			                    <p><?php echo $row['homework_reply'];?></p>
		                    </div>
	                    </div>
	                    <div class="col-sm-4">
		                    <div class="pipeline white lined-secondary">
		                        <div class="pipeline-header">
			                        <h5 class="pipeline-name"><?php echo getEduAppGTLang('information');?></h5>
		                        </div>
		                        <?php echo form_open(base_url() . 'admin/homework/single/' . $row['homework_code'], array('enctype' => 'multipart/form-data')); ?>
		                            <div class="table-responsive">
		                                <table class="table table-lightbor table-lightfont">
    			                            <div>
    				                            <b><?php echo getEduAppGTLang('student_comment');?>:</b>
    				                            <p><?php echo $row['student_comment'];?></p>
    			                            </div>
    			                            <tr>
    				                            <b><?php echo getEduAppGTLang('delivery_status');?>:</b>
    				                            <p>
    				                                <?php if($row['date'] > $time):?>
    					                            <a class="btn nc btn-rounded btn-sm btn-danger" style="color:white"><?php echo getEduAppGTLang('delayed_delivery');?></a>
    				                                <?php endif;?>
    				                                <?php if($row['date'] <= $time):?>
    					                            <a class="btn nc btn-rounded btn-sm btn-success" style="color:white"><?php echo getEduAppGTLang('on_time');?></a>
    				                                <?php endif;?>
    				                            </p>
    			                            </tr>
    			                            <tr>
    				                            <b><?php echo getEduAppGTLang('comment');?>:</b>
    				                            <p><textarea class="form-control" rows="4" name="comment"><?php echo $row['teacher_comment'];?></textarea></p>
    			                            </tr>
    			                            <tr>          
    				                            <b><?php echo getEduAppGTLang('mark');?>:</b>
    				                            <p><input class="form-control" placeholder="" name="mark" type="text" value="<?php echo $row['mark'];?>"><input type="hidden" name="id" value="<?php echo $row['id'];?>"></p>
    			                            </tr>
		                                </table>
		                                <div class="form-buttons-w">
		                                    <button class="btn btn-rounded btn-success" type="submit"> <?php echo getEduAppGTLang('apply');?></button>
		                                </div>
		                            </div>
		                        <?php echo form_close();?>
		                    </div>
	                    </div>
			        </div>
                </div>
            </div>
        </div>
    </div>
<?php endforeach;?>