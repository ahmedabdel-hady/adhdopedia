<?php 
    $running_year = $this->crud->getInfo('running_year');
    $user = $this->session->userdata('login_type')."-".$this->session->userdata('login_user_id');
?>
    <div class="content-w">
        <?php include 'fancy.php';?>
        <div class="header-spacer"></div>
        <div class="conty">
            <div class="os-tabs-w menu-shad">
    	        <div class="os-tabs-controls">
	                <ul class="navs navs-tabs upper">
    		            <li class="navs-item">
		                    <a class="navs-links active" href="<?php echo base_url();?>techer/student_report/"><i class="os-icon picons-thin-icon-thin-0389_gavel_hammer_law_judge_court"></i><span><?php echo getEduAppGTLang('reports');?></span></a>
		                </li>
	                </ul>
	            </div>
            </div>
            <div class="content-box">
		    <br>
                <div class="tab-content ">
                    <div class="tab-pane active" id="students">
                        <div class="element-wrapper">
                            <h6 class="element-header">
                                <?php echo getEduAppGTLang('behavior');?>
                                <div style="margin-top:auto;text-align:right;"><a href="#" data-target="#addroutine" data-toggle="modal" class="btn btn-control btn-grey-lighter btn-purple"><i class="picons-thin-icon-thin-0001_compose_write_pencil_new"></i><div class="ripple-container"></div></a></div>
                            </h6>
                            <div class="element-box-tp">
                                <div class="table-responsive">
                                    <table class="table table-padded">
                                        <thead>
                                            <tr>
                                                <th><?php echo getEduAppGTLang('priority');?></th>
                                                <th><?php echo getEduAppGTLang('date');?></th>
                                                <th><?php echo getEduAppGTLang('created_by');?></th>
                                                <th><?php echo getEduAppGTLang('student');?></th>
                                                <th><?php echo getEduAppGTLang('class');?></th>
                                                <th><?php echo getEduAppGTLang('section');?></th>
                                                <th><?php echo getEduAppGTLang('title');?></th>
                                                <th><?php echo getEduAppGTLang('options');?></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php $reports = $this->db->get_where('reports', array('user_id' => $user))->result_array();
        					                foreach($reports as $row):
        				                    $users = $row['user_id'];
                                            $re = explode('-', $users);
                                        ?>
                                            <tr>
                                                <td>
                                                    <?php if($row['priority'] == 'alta'):?>
                                                    <span class="status-pill red"></span><span><?php echo getEduAppGTLang('high');?></span>
                                                    <?php endif;?>
                                                    <?php if($row['priority'] == 'media'):?>
                                                    <span class="status-pill yellow"></span><span><?php echo getEduAppGTLang('medium');?></span>
                                                    <?php endif;?>
                                                    <?php if($row['priority'] == 'baja'):?>
                                                    <span class="status-pill green"></span><span><?php echo getEduAppGTLang('low');?></span>
                                                    <?php endif;?>
                                                </td>
                                                <td><span><?php echo $row['date'];?></span></td>
                                                <td class="cell-with-media">
                                                    <img alt="" src="<?php echo $this->crud->get_image_url($re[0], $re[1]);?>" style="height: 25px;"><span><?php echo $this->crud->get_name($re[0], $re[1]);?></span>
                                                </td>
                                                <td class="cell-with-media">
                                                    <img alt="" src="<?php echo $this->crud->get_image_url('student', $row['student_id']);?>" style="height: 25px;"><span> <?php echo $this->crud->get_name('student', $row['student_id']);?></span>
                                                </td>
                                                <td><a class="badge badge-primary" href="javascript:void(0);"><?php echo $this->db->get_where('class', array('class_id' => $row['class_id']))->row()->name;?></a></td>
                                                <td><a class="badge badge-success" href="javascript:void(0);"><?php echo $this->db->get_where('section', array('section_id' => $row['section_id']))->row()->name;?></a></td>
                                                <td><?php echo $row['title'];?></td>
                                                <td class="bolder">
                                                    <a href="<?php echo base_url();?>teacher/view_report/<?php echo $row['code'];?>/" style="color:grey;"><i style="font-size:20px;" class="picons-thin-icon-thin-0012_notebook_paper_certificate" data-toggle="tooltip" data-placement="top" data-original-title="<?php echo getEduAppGTLang('view_details');?>"></i></a>
                                                </td>
                                            </tr>
                                            <?php endforeach;?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>      
        </div>
        <div class="display-type"></div>
    </div>

    <div class="modal fade" id="addroutine" tabindex="-1" role="dialog" aria-labelledby="addroutine" aria-hidden="true">
        <div class="modal-dialog window-popup edit-my-poll-popup" role="document">
            <div class="modal-content">
                <a href="#" class="close icon-close" data-dismiss="modal" aria-label="Close"></a>
                <div class="modal-body">
                    <div class="ui-block-title" style="background-color:#00579c">
                        <h6 class="title" style="color:white"><?php echo getEduAppGTLang('add_report');?></h6>
                    </div>
                    <div class="ui-block-content">
                        <?php echo form_open(base_url() . 'teacher/student_report/send/', array('enctype' => 'multipart/form-data')); ?>
                            <div class="row">
                                <div class="col col-lg-12 col-md-12 col-sm-12 col-12">
                                    <div class="form-group label-floating is-empty">
                  	                    <label class="control-label"><?php echo getEduAppGTLang('title');?></label>
                  		                <input class="form-control" placeholder="" type="text" name="title">
                		                <span class="material-input"></span>
                	                </div>
                                </div>
                                <div class="col col-lg-6 col-md-6 col-sm-12 col-12">
                                    <div class="form-group label-floating is-select">
                                        <label class="control-label"><?php echo getEduAppGTLang('class');?></label>
                                        <div class="select">
                                            <select name="class_id" onchange="get_class_sections(this.value); get_class_subject(this.value);">
                                                <option value=""><?php echo getEduAppGTLang('select');?></option>
                                                <?php $cl = $this->db->get('class')->result_array();
                                                foreach($cl as $row):
                                                ?>
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
                                            <select name="section_id" id="section_selector_holder" onchange="get_class_students(this.value);">
                                                <option value=""><?php echo getEduAppGTLang('select');?></option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col col-lg-12 col-md-12 col-sm-12 col-12">
                                    <div class="form-group label-floating is-select">
                                        <label class="control-label"><?php echo getEduAppGTLang('student');?></label>
                                        <div class="select">
                                            <select name="student_id" id="students_holder">
                                                <option value=""><?php echo getEduAppGTLang('select');?></option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col col-lg-12 col-md-12 col-sm-12 col-12">
                                    <div class="form-group label-floating is-select">
                                        <label class="control-label"><?php echo getEduAppGTLang('priority');?></label>
                                        <div class="select">
                                            <select name="priority" id="slct" required="">
                                                <option value=""><?php echo getEduAppGTLang('select');?></option>
    						                    <option value="baja"><?php echo getEduAppGTLang('low');?></option>
    						                    <option value="media"><?php echo getEduAppGTLang('medium');?></option>
    						                    <option value="alta"><?php echo getEduAppGTLang('high');?></option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col col-lg-12 col-md-12 col-sm-12 col-12">
                                    <div class="form-group">
                      	                <label class="control-label"><?php echo getEduAppGTLang('file');?></label>
                  		                <input class="form-control" placeholder="" type="file" name="file">
                		                <span class="material-input"></span>
                	                </div>
                                </div>
                                <div class="col col-lg-12 col-md-12 col-sm-12 col-12">
                                    <div class="form-group">
                                        <textarea class="form-control" rows="6" placeholder="<?php echo getEduAppGTLang('description');?>..." name="description" required=""></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="form-buttons-w text-right">
                                <center><button class="btn btn-rounded btn-success" type="submit"><?php echo getEduAppGTLang('save');?></button></center>
                            </div>
                        <?php echo form_close();?>        
                    </div>
                </div>
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