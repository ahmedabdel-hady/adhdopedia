<?php 
    $running_year = $this->crud->getInfo('running_year'); 
    $class_id = $this->db->get_where('enroll', array('student_id' => $this->session->userdata('login_user_id'), 'year' => $running_year))->row()->class_id;
    $section_id = $this->db->get_where('enroll' , array('student_id' => $this->session->userdata('login_user_id'),'class_id' => $class_id,'year' => $running_year))->row()->section_id;
?>
    <div class="content-w">
        <?php include 'fancy.php';?>
        <div class="header-spacer"></div>
        <div class="conty">
            <div class="ae-content-w" style="background-color: #f2f4f8;">
                <div class="top-header top-header-favorit">
                    <div class="top-header-thumb">
                        <img src="<?php echo base_url();?>public/uploads/bglogin.jpg" alt="nature" style="height:180px; object-fit:cover;">
                        <div class="top-header-author">
                            <div class="author-thumb">
                                <img src="<?php echo base_url();?>public/uploads/<?php echo $this->crud->getInfo('logo');?>" alt="author" style="background-color: #fff; padding:10px">
                            </div>
                            <div class="author-content">
                                <a href="javascript:void(0);" class="h3 author-name"><?php echo getEduAppGTLang('library');?></a>
                                <div class="country"><?php echo $this->crud->getInfo('system_name');?>  |  <?php echo $this->crud->getInfo('system_title');?></div>
                            </div>
                        </div>
                    </div>
                    <div class="profile-section" style="background-color: #fff;">
                         <div class="control-block-button"></div>
                    </div>
                </div>
            </div>
            <div class="content-box">
                <br>
                <div class="os-tabs-w">
                    <div class="os-tabs-controls">
                        <ul class="navs navs-tabs upper" style="padding-left:20px; padding-top:20px">
                            <li class="navs-item" style="display:inline;">
                                <a class="navs-link active" style="color:#000;" data-toggle="tab" href="#all"><?php echo getEduAppGTLang('library');?></a>
                            </li>
                            <li class="navs-item">
                                <a class="navs-link" style="color:#000;" data-toggle="tab" href="#request"><?php echo getEduAppGTLang('book_request');?></a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="tab-content">
                    <div class="tab-pane active" id="all">
                        <div class="element-wrapper">
                            <div class="element-box-tp">
                                <div class="table-responsive">
                                    <table class="table table-padded">
                                        <thead>
                                            <tr>
                                                <th><?php echo getEduAppGTLang('type');?></th>
                                                <th><?php echo getEduAppGTLang('name');?></th>
                                                <th><?php echo getEduAppGTLang('author');?></th>
                                                <th><?php echo getEduAppGTLang('description');?></th>
                                                <th><?php echo getEduAppGTLang('status');?></th>
                                                <th><?php echo getEduAppGTLang('price');?></th>
                                                <th><?php echo getEduAppGTLang('download');?></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php 
                                            $count = 1; 
                                            $book = $this->db->get_where('book', array('class_id' => $class_id))->result_array();
                                            foreach($book as $row):?>
                                            <tr>
                                                <td>
                                                <?php if($row['type'] == 'virtual'):?>
                                                    <a class="btn btn-rounded btn-sm btn-purple" style="color:white"><?php echo getEduAppGTLang('virtual');?></a>
                                                <?php else:?>
                                                    <a class="btn btn-rounded btn-sm btn-info" style="color:white"><?php echo getEduAppGTLang('normal');?></a>
                                                <?php endif;?>
                                                </td>
                                                <td><?php echo $row['name'];?></td>
                                                <td><?php echo $row['author'];?></td>
                                                <td><?php echo $row['description'];?></td>
                                                <td>
                                                <?php if($row['status'] == 2):?>
                                                    <div class="status-pill red" data-title="<?php echo getEduAppGTLang('unavailable');?>" data-toggle="tooltip"></div>
                                                <?php endif;?>
                                                <?php if($row['status'] == 1):?>
                                                    <div class="status-pill green" data-title="<?php echo getEduAppGTLang('available');?>" data-toggle="tooltip"></div>
                                                <?php endif;?>
                                                </td>
                                                <td><a class="btn btn-rounded btn-sm btn-success" style="color:white"><?php echo $this->db->get_where('settings', array('type' => 'currency'))->row()->description;?><?php echo $row['price'];?></a></td>
                                                <td style="color:grey">
                                                <?php if($row['type'] == 'virtual' && $row['file_name'] != ""):?>
                                                    <a class="btn btn-rounded btn-sm btn-primary" style="color:white" href="<?php echo base_url();?>public/uploads/library/<?php echo $row['file_name'];?>"><i class="picons-thin-icon-thin-0042_attachment"></i> <?php echo getEduAppGTLang('download');?></a>
                                                <?php else:?>
                                                    <?php echo getEduAppGTLang('no_downloaded');?>
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
                    <div class="tab-pane" id="request">
                        <div class="element-wrapper">
                            <div style="margin-top:auto;float:right;"><a href="javascript:void(0);" data-target="#new_request" data-toggle="modal" class="text-white btn btn-control btn-grey-lighter btn-success"><i class="picons-thin-icon-thin-0001_compose_write_pencil_new"></i><div class="ripple-container"></div></a></div>
                            <div class="element-box-tp">
                                <div class="table-responsive">
                                    <table class="table table-padded">
                                        <thead>
                                            <tr>
                                                <th style="width: 60px;">#</th>
                                                <th><?php echo getEduAppGTLang('book');?></th>
                                                <th><?php echo getEduAppGTLang('requested_by');?></th>
                                                <th><?php echo getEduAppGTLang('starting_date');?></th>
                                                <th><?php echo getEduAppGTLang('ending_date');?></th>
                                                <th><?php echo getEduAppGTLang('status');?></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                            $count = 1;
                                            $this->db->order_by('book_request_id', 'desc');
                                            $book_requests = $this->db->get_where('book_request', array('student_id' => $this->session->userdata('login_user_id')))->result_array();
                                            foreach ($book_requests as $row) { ?>   
                                            <tr>
                                                <td><?php echo $count++; ?></td>
                                                <td><?php echo $this->db->get_where('book', array('book_id' => $row['book_id']))->row()->name; ?></td>
                                                <td><?php echo $this->crud->get_name('student', $row['student_id']);?></td>
                                                <td><?php echo date('d/m/Y', $row['issue_start_date']); ?></td>
                                                <td><?php echo date('d/m/Y', $row['issue_end_date']); ?></td>
                                                <td>
                                                    <?php
                                                        if($row['status'] == 0)
                                                            $status = '<div class="status-pill yellow" data-title="'. getEduAppGTLang('pending').'" data-toggle="tooltip"></div>';
                                                        else if($row['status'] == 1)
                                                            $status = '<div class="status-pill green" data-title="'. getEduAppGTLang('approved').'" data-toggle="tooltip"></div>';
                                                        else
                                                            $status = '<div class="status-pill red" data-title="'. getEduAppGTLang('rejected').'" data-toggle="tooltip"></div>';
                                                        echo $status;
                                                    ?>
                                                </td>
                                            </tr>
                                        <?php } ?>
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

    <div class="modal fade" id="new_request" tabindex="-1" role="dialog" aria-labelledby="new_request" aria-hidden="true">
        <div class="modal-dialog window-popup edit-my-poll-popup" role="document">
            <div class="modal-content">
                <a href="javascript:void(0);" class="close icon-close" data-dismiss="modal" aria-label="Close"></a>
                <div class="modal-body">
                    <div class="ui-block-title" style="background-color:#00579c">
                        <h6 class="title" style="color:white"><?php echo getEduAppGTLang('new_request');?></h6>
                    </div>
                    <div class="ui-block-content">
        	            <?php echo form_open(base_url() . 'student/library/request/', array('enctype' => 'multipart/form-data')); ?>
	                        <div class="row">
                                <div class="col col-lg-12 col-md-12 col-sm-12 col-12">
                                    <div class="form-group label-floating is-select">
                                        <label class="control-label"><?php echo getEduAppGTLang('book');?></label>
                                        <div class="select">
                                            <select name="book_id" required onchange="select_section(this.value)">
                                                <option value=""><?php echo getEduAppGTLang('select');?></option>
                                                <?php  
                                                    $books = $this->db->get_where('book', array('class_id' => $class_id))->result_array();
                                                    foreach ($books as $row):?>
                                                    <option value="<?php echo $row['book_id']; ?>"><?php echo $row['name']; ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                    </div>
            		            </div>
            		            <div class="col col-lg-12 col-md-12 col-sm-12 col-12">
	                	            <div class="form-group label-floating">
                  			            <label class="control-label"><?php echo getEduAppGTLang('starting_date');?></label>
                  			            <input type='text' name="start" class="datepicker-here" data-position="bottom left" data-language='en'  data-multiple-dates-separator="/"/>
	                	            </div>
            		            </div>
            		            <div class="col col-lg-12 col-md-12 col-sm-12 col-12">
	                	            <div class="form-group label-floating">
                  			            <label class="control-label"><?php echo getEduAppGTLang('ending_date');?></label>
                  			            <input type='text' name="end" class="datepicker-here" data-position="top left" data-language='en'  data-multiple-dates-separator="/"/>
	                	            </div>
            		            </div>
            	            </div>
          		            <div class="form-buttons-w text-right">
	             	            <center><button class="btn btn-rounded btn-success" type="submit"><?php echo getEduAppGTLang('request');?></button></center>
          		            </div>
          	            <?php echo form_close();?>        
                    </div>
                </div>
            </div>
        </div>
    </div>