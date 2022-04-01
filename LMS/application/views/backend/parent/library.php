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
                        <img src="<?php echo base_url();?>public/uploads/bglogin.jpg" style="height:180px; object-fit:cover;">
                        <div class="top-header-author">
                            <div class="author-thumb">
                                <img src="<?php echo base_url();?>public/uploads/<?php echo $this->crud->getInfo('logo');?>" style="background-color: #fff;padding:10px;">
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
                <div class="os-tabs-w">
                    <div class="os-tabs-controls">
                        <ul class="navs navs-tabs upper">
                        <?php 
                            $n = 1;
                            $children_of_parent = $this->db->get_where('student' , array('parent_id' => $this->session->userdata('parent_id')))->result_array();
                            foreach ($children_of_parent as $row): ?>
                            <li class="navs-item">
                                <?php $active = $n++;?>
                                <a class="navs-links <?php if($active == 1) echo 'active';?>" data-toggle="tab" href="#<?php echo $row['username'];?>"><img alt="" src="<?php echo $this->crud->get_image_url('student', $row['student_id']);?>" width="25px" style="border-radius: 25px;margin-right:5px;"> <?php echo $this->crud->get_name('student', $row['student_id']);?></a>
                            </li>
                        <?php endforeach; ?>
                        </ul>
                    </div>
                </div>
                <br>
                <div class="tab-content">
                <?php 
                    $n = 1;
                    $children_of_parent = $this->db->get_where('student' , array('parent_id' => $this->session->userdata('parent_id')))->result_array();
                    foreach ($children_of_parent as $row2):
                    $class_id = $this->db->get_where('enroll' , array('student_id' => $row2['student_id'] , 'year' => $running_year))->row()->class_id;
                    $section_id = $this->db->get_where('enroll' , array('student_id' => $row2['student_id'] , 'year' => $running_year))->row()->section_id;
                ?>
                <?php $active = $n++;?>
                    <div class="tab-pane <?php if($active == 1) echo 'active';?>" id="<?php echo $row2['username'];?>">
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
                                        <?php $count = 1; 
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
                <?php endforeach;?>
                </div>      
            </div>
        </div>
        <div class="display-type"></div>
    </div>