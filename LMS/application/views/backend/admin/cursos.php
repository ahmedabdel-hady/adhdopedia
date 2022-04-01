    <div class="content-w">
        <?php $cl_id = base64_decode($class_id);?>
        <script src="<?php echo base_url();?>public/jscolor.js"></script>
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
                                                            <a href="javascript:void(0);" class="h3 author-name"><?php echo getEduAppGTLang('subjects');?> <small>(<?php echo $this->db->get_where('class', array('class_id' => $cl_id))->row()->name;?>)</small></a>
                                                            <div class="country"><?php echo $this->crud->getInfo('system_name');?>  |  <?php echo $this->crud->getInfo('system_title');?></div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="profile-section">
                                                    <div class="container-fluid">
                                                        <div class="row">
                                                            <div class="col col-xl-8 m-auto col-lg-8 col-md-12">
                                                                <div class="os-tabs-w">
                                                                    <div class="os-tabs-controls">
                                                                        <ul class="navs navs-tabs upper">
                                                                        <?php 
                                                                            $active = 0;
                                                                            $query = $this->db->get_where('section' , array('class_id' => $cl_id)); 
                                                                            if ($query->num_rows() > 0):
                                                                            $sections = $query->result_array();
                                                                            foreach ($sections as $rows): $active++;?>
                                                                            <li class="navs-item">
                                                                                <a class="navs-links <?php if($active == 1) echo "active";?>" data-toggle="tab" href="#tab<?php echo $rows['section_id'];?>"><?php echo getEduAppGTLang('section');?> <?php echo $rows['name'];?></a>
                                                                            </li>
                                                                            <?php endforeach;?>
                                                                        <?php endif;?>
                                                                        </ul>
                                                                    </div> 
                                                                </div>                                        
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="aec-full-message-w">
                                                <div class="aec-full-message">
                                                    <div class="container-fluid" style="background-color: #f2f4f8;">
                                                        <div class="tab-content">
                                                        <?php 
                                                            $active2 = 0;
                                                            $query = $this->db->get_where('section' , array('class_id' => $cl_id));
                                                            if ($query->num_rows() > 0):
                                                            $sections = $query->result_array();
                                                            foreach ($sections as $row): $active2++;?>
                                                            <div class="tab-pane <?php if($active2 == 1) echo "active";?>" id="tab<?php echo $row['section_id'];?>">
                                                                <div class="row"> 
                                                                    <div class="col col-xl-3 col-lg-6 col-md-6 col-sm-12 col-12 margintelbot">
                                                                        <div class="friend-item friend-groups create-group" data-mh="friend-groups-item" style="min-height:200px;">
                                                                            <a href="javascript:void(0);" class="full-block" data-toggle="modal" data-target="#create-friend-group-1"></a>
                                                                            <div class="content">      
                                                                                <a data-toggle="modal" data-target="#addsubject" href="javascript:void(0);" class="text-white  btn btn-control bg-blue">
                                                                                    <i class="icon-feather-plus"></i>
                                                                                </a>      
                                                                                <div class="author-content">
                                                                                    <a data-toggle="modal" data-target="#addsubject" href="javascript:void(0);" class="h5 author-name"><?php echo getEduAppGTLang('new_subject');?> </a>
                                                                                    <div class="country"><?php echo getEduAppGTLang('create_new_subject');?></div>
                                                                                </div>      
                                                                            </div>
                                                                        </div>      
                                                                    </div> 
                                                                    <?php 
                                                                        $this->db->order_by('subject_id', 'desc');
                                                                        $subjects = $this->db->get_where('subject', array('class_id' => $cl_id, 'section_id' => $row['section_id']))->result_array();
                                                                        foreach($subjects as $row2):
                                                                    ?>
                                                                    <div class="col col-xl-3 col-lg-6 col-md-6 col-sm-12 col-12">
                                                                        <div class="ui-block" data-mh="friend-groups-item">        
                                                                            <div class="friend-item friend-groups">
                                                                                <div class="friend-item-content">         
                                                                                    <div class="more">
                                                                                        <i class="icon-feather-more-horizontal"></i>
                                                                                        <ul class="more-dropdown">
                                                                                            <li><a href="<?php echo base_url();?>admin/subject_dashboard/<?php echo base64_encode($row2['class_id']."-".$row['section_id']."-".$row2['subject_id']);?>/"><?php echo getEduAppGTLang('dashboard');?></a></li>
                                                                                            <li><a href="javascript:void(0);" onclick="showAjaxModal('<?php echo base_url();?>modal/popup/modal_subject/<?php echo $row2['subject_id'];?>');"><?php echo getEduAppGTLang('edit');?></a></li>
                                                                                            <li><a onClick="return confirm('<?php echo getEduAppGTLang('confirm_delete');?>')" href="<?php echo base_url();?>admin/courses/delete/<?php echo $row2['subject_id'];?>"><?php echo getEduAppGTLang('delete');?></a></li>
                                                                                        </ul>
                                                                                    </div>
                                                                                    <div class="friend-avatar">
                                                                                        <div class="author-thumb">
                                                                                            <img src="<?php echo base_url();?>public/uploads/subject_icon/<?php echo $row2['icon'];?>" width="120px" style="background-color:#<?php echo $row2['color'];?>;padding:30px;border-radius:0px;">
                                                                                        </div>
                                                                                        <div class="author-content">
                                                                                            <a href="<?php echo base_url();?>admin/subject_dashboard/<?php echo base64_encode($row2['class_id']."-".$row['section_id']."-".$row2['subject_id']);?>/" class="h5 author-name"><?php echo $row2['name'];?> - <?php echo $row['name'];?></a><br><br>
                                                                                            <img src="<?php echo $this->crud->get_image_url('teacher', $row2['teacher_id']);?>" style="border-radius:50%;width:20px;"><span>  <?php echo $this->crud->get_name('teacher', $row2['teacher_id']);?></span>
                                                                                        </div>                          
                                                                                    </div>                        
                                                                                </div>
                                                                            </div>        
                                                                        </div>
                                                                    </div>
                                                                <?php endforeach;?>
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
                <div class="display-type"></div>
            </div>
        </div>
    </div>   
    
    <div class="modal fade" id="addsubject" tabindex="-1" role="dialog" aria-labelledby="fav-page-popup" aria-hidden="true">
        <div class="modal-dialog window-popup edit-my-poll-popup" role="document">
            <div class="modal-content">
                <a href="javascript:void(0);" class="close icon-close" data-dismiss="modal" aria-label="Close"></a>
                <div class="modal-header">
                    <h6 class="title"><?php echo getEduAppGTLang('new_subject');?></h6>
                </div>
                <div class="modal-body" style="padding:15px">
                    <?php echo form_open(base_url() . 'admin/courses/create/'.$cl_id, array('enctype' => 'multipart/form-data')); ?>
                        <div class="row">
                            <div class="col col-lg-12 col-md-12 col-sm-12 col-12">
                                <div class="form-group label-floating">
                                    <label class="control-label"><?php echo getEduAppGTLang('name');?></label>
                                    <input class="form-control" placeholder="" name="name" type="text" required>
                                </div>
                            </div>
                            <div class="col col-lg-12 col-md-12 col-sm-12 col-12">
                                <div class="form-group">
                                    <label class="control-label"><?php echo getEduAppGTLang('about_the_subject');?></label>
                                    <textarea class="form-control" name="about" required></textarea>
                                </div>
                            </div>
                            <div class="col col-lg-12 col-md-12 col-sm-12 col-12">
                                <div class="form-group label-floating">
                                    <label class="control-label text-white"><?php echo getEduAppGTLang('color');?></label>
                                    <input class="jscolor" name="color" required value="0084ff">
                                </div>
                            </div>
                            <div class="col col-sm-6">
                                <div class="form-group label-floating is-select">
                                    <label class="control-label"><?php echo getEduAppGTLang('class');?></label>
                                    <div class="select">
                                        <select name="class_id" required="">
                                            <option value=""><?php echo getEduAppGTLang('select');?></option>
                                            <?php 
                                                $class_info = $this->db->get('class')->result_array();
                                                foreach ($class_info as $rowd) { ?>
                                                <option value="<?php echo $rowd['class_id']; ?>" <?php if($cl_id == $rowd['class_id']) echo "selected";?>><?php echo $rowd['name']; ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col col-sm-6">
                                <div class="form-group label-floating is-select">
                                    <label class="control-label"><?php echo getEduAppGTLang('section');?></label>
                                    <div class="select">
                                        <select name="section_id" required="">
                                            <option value=""><?php echo getEduAppGTLang('select');?></option>
                                            <?php 
                                            $class_info = $this->db->get_where('section', array('class_id' => $cl_id))->result_array();
                                            foreach ($class_info as $rowd) { ?>
                                                <option value="<?php echo $rowd['section_id']; ?>"><?php echo $rowd['name']; ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col col-sm-6">
                                <div class="form-group">
                                    <label class="control-label"><?php echo getEduAppGTLang('icon');?></label>
                                    <input class="form-control" name="userfile" type="file" required>
                                </div>
                            </div>
                            <div class="col col-sm-6">
                                <div class="form-group label-floating is-select">
                                    <label class="control-label"><?php echo getEduAppGTLang('teacher');?></label>
                                    <div class="select">
                                        <select name="teacher_id" required="">
                                            <option value=""><?php echo getEduAppGTLang('select');?></option>
                                            <?php $teachers = $this->db->get('teacher')->result_array();
                                                foreach($teachers as $row):
                                            ?>
                                            <option value="<?php echo $row['teacher_id'];?>"><?php echo $row['first_name']." ".$row['last_name'];?></option>
                                        <?php endforeach;?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col col-lg-12 col-md-12 col-sm-12 col-12">
                                <button class="btn btn-success btn-lg full-width" type="submit"><?php echo getEduAppGTLang('save');?></button>
                            </div>
                        </div>
                    </div>
                <?php echo form_close();?>
            </div>
        </div>
    </div>