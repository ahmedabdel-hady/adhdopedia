    <div class="content-w">
        <?php include 'fancy.php';?>
        <div class="header-spacer"></div>
        <div class="conty">
        <div class="os-tabs-w menu-shad">
            <div class="os-tabs-controls">
                <ul class="navs navs-tabs upper">
                    <li class="navs-item">
                        <a class="navs-links active" data-toggle="tab" href="#permissions"><i class="os-icon picons-thin-icon-thin-0015_fountain_pen"></i><span><?php echo getEduAppGTLang('permissions');?></span></a>
                    </li>
                    <li class="navs-item">
                        <a class="navs-links" data-toggle="tab" href="#apply"><i class="os-icon picons-thin-icon-thin-0389_gavel_hammer_law_judge_court"></i><span><?php echo getEduAppGTLang('apply');?></span></a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="content-i">
            <div class="content-box">
                <div class="tab-content">
		            <div class="tab-pane active" id="permissions">
                        <div class="element-wrapper">
                            <h6 class="element-header">
                                <?php echo getEduAppGTLang('permissions');?>
                            </h6>
                            <div class="element-box-tp">
                                <div class="table-responsive">
                                    <table class="table table-padded">
                                        <thead>
                                            <tr>
                                                <th><?php echo getEduAppGTLang('status');?></th>
                                                <th><?php echo getEduAppGTLang('reason');?></th>
				                                <th><?php echo getEduAppGTLang('description');?></th>
    				                            <th><?php echo getEduAppGTLang('user');?></th>
				                                <th><?php echo getEduAppGTLang('from');?></th>
				                                <th><?php echo getEduAppGTLang('until');?></th>
				                                <th><?php echo getEduAppGTLang('file');?></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
            	                                $count = 1;
            	                                $this->db->order_by('request_id', 'desc');
            	                                $requests = $this->db->get_where('request', array('teacher_id' => $this->session->userdata('login_user_id')))->result_array();
                	                            foreach ($requests as $row):
        	                                ?>   
				                            <tr>
				    	                        <td>
					                            <?php if($row['status'] == 2):?>
                                                    <span class="status-pill red"></span><span><?php echo getEduAppGTLang('rejected');?></span>
                                                <?php endif;?>
                                                <?php if($row['status'] == 0):?>
                                                    <span class="status-pill yellow"></span><span><?php echo getEduAppGTLang('pending');?></span>
                                                <?php endif;?>
                                                <?php if($row['status'] == 1):?>
                                                    <span class="status-pill green"></span><span><?php echo getEduAppGTLang('approved');?></span>
                                                <?php endif;?>
					                            </td>
					                            <td><a class="btn nc btn-rounded btn-sm btn-purple" style="color:white"><?php echo $row['title']; ?></a></td>
					                            <td><?php echo $row['description']; ?></td>
					                            <td><img alt="" src="<?php echo $this->crud->get_image_url('teacher', $this->session->userdata('login_user_id'));?>" width="25px" style="border-radius: 10px;margin-right:5px;"> <?php echo $this->crud->get_name('teacher', $row['teacher_id']);?></td>
					                            <td><a class="btn nc btn-rounded btn-sm btn-primary" style="color:white"><?php echo $row['start_date']; ?></a></td>
					                            <td><a class="btn nc btn-rounded btn-sm btn-secondary" style="color:white"><?php echo $row['end_date']; ?></a></td>
					                            <td>
					                                <?php if($row['file'] == ""):?>
						                            <p><?php echo getEduAppGTLang('no_file');?></p>
					                                <?php endif;?>
    					                            <?php if($row['file'] != ""):?>
						                            <a href="<?php echo base_url();?>public/uploads/request/<?php echo $row['file'];?>" class="btn btn-rounded btn-sm btn-primary" style="color:white"><i class="os-icon picons-thin-icon-thin-0042_attachment"></i> <?php echo getEduAppGTLang('download');?></a>
					                                <?php endif;?>
					                            </td>
				                            </tr>
			                            <?php endforeach;?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane" id="apply">
                        <div class="element-wrapper">
                            <div class="element-box lined-primary">
			                    <?php echo form_open(base_url() . 'teacher/request/create', array('enctype' => 'multipart/form-data'));?>
			                        <h5 class="form-header"><?php echo getEduAppGTLang('apply');?></h5><br>
			                        <div class="form-group">
				                        <label for=""> <?php echo getEduAppGTLang('reason');?></label><input class="form-control" name="title" placeholder="" required type="text">
			                        </div>
			                        <div class="form-group">
				                        <label> <?php echo getEduAppGTLang('description');?></label><textarea name="description" class="form-control" required="" rows="4"></textarea>
				                    </div>
			                        <div class="row">
				                        <div class="col-sm-6">
					                        <div class="form-group">
					                            <label for=""> <?php echo getEduAppGTLang('from');?></label>
					                            <input type='text' class="datepicker-here" data-position="top left" data-language='en' name="start_date" data-multiple-dates-separator="/"/>
					                        </div>
				                        </div>
				                        <div class="col-sm-6">
					                        <div class="form-group">
					                            <label for=""> <?php echo getEduAppGTLang('until');?></label>
					                            <input type='text' class="datepicker-here" data-position="top left" data-language='en' name="end_date" data-multiple-dates-separator="/"/>
					                        </div>
				                        </div>
				                    </div>
				                    <div class="form-group">
				                        <label for=""> <?php echo getEduAppGTLang('send_file');?></label>
				                        <div class="input-group form-control">
				                            <input type="file" name="file_name" id="file-3" class="inputfile inputfile-3" style="display:none"/>
					                        <label for="file-3"><i class="os-icon picons-thin-icon-thin-0042_attachment"></i> <span><?php echo getEduAppGTLang('send_file');?>...</span></label>
					                    </div>  
				                    </div>
			                        <div class="form-buttons-w text-right">
				                        <button class="btn btn-primary btn-rounded" type="submit"> <?php echo getEduAppGTLang('apply');?></button>
			                        </div>
			                        <?php echo form_close();?>
			                    </div>
			                </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>