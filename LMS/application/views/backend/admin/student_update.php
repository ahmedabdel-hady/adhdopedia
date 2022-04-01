<?php 
    $student_info = $this->db->get_where('student' , array('student_id' => $student_id))->result_array(); 
    foreach($student_info as $row): 
?>
    <div class="content-w"> 
        <?php include 'fancy.php';?>
        <div class="header-spacer"></div>
        <div class="content-i">
            <div class="content-box">
                <div class="conty">
                    <div class="back" style="margin-top:-20px;margin-bottom:10px">		
    	                <a title="<?php echo getEduAppGTLang('return');?>" href="<?php echo base_url();?>admin/students/"><i class="picons-thin-icon-thin-0131_arrow_back_undo"></i></a>	
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
                                                        <img alt="" src="<?php echo $this->crud->get_image_url('student', $row['student_id']);?>" style="background-color:#fff;">
                                                    </div>
                                                </div>
                                                <h3 class="text-white"><?php echo $row['first_name'];?> <?php echo $row['last_name'];?></h3>
                                                <h5 class="up-sub-header">@<?php echo $row['username'];?></h5>
                                            </div>
                                            <svg class="decor" width="842px" height="219px" viewBox="0 0 842 219" preserveAspectRatio="xMaxYMax meet" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"><g transform="translate(-381.000000, -362.000000)" fill="#FFFFFF"><path class="decor-path" d="M1223,362 L1223,581 L381,581 C868.912802,575.666667 1149.57947,502.666667 1223,362 Z"></path></g></svg>
                                        </div>
                                        <div class="up-controls">
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <div class="value-pair">
                                                        <div><?php echo getEduAppGTLang('account_type');?>:</div>
                                                        <div class="value badge badge-pill badge-primary"><?php echo getEduAppGTLang('student');?></div>
                                                    </div>
                                                    <div class="value-pair">
                                                        <div><?php echo getEduAppGTLang('member_since');?>:</div>
                                                        <div class="value"><?php echo $row['since'];?>.</div>
                                                    </div>
                                                    <div class="value-pair">
                                                        <div><?php echo getEduAppGTLang('roll');?>:</div>
                                                        <div class="value"><?php echo $this->db->get_where('enroll', array('student_id' => $row['student_id']))->row()->roll;?>.</div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="ui-block">
                                    <div class="ui-block-title">    
                                        <h6 class="title"><?php echo getEduAppGTLang('update_information');?></h6>
                                    </div>
                                    <?php echo form_open(base_url() . 'admin/student/do_update/'.$row['student_id'] , array('enctype' => 'multipart/form-data'));?>
                                        <div class="ui-block-content">
                                            <div class="row">                 
                                                <div class="col col-lg-6 col-md-6 col-sm-12 col-12">
                                                    <div class="form-group label-floating">
                                                        <label class="control-label"><?php echo getEduAppGTLang('first_name');?></label>
                                                        <input class="form-control" name="first_name" value="<?php echo $row['first_name'];?>" type="text" required="">
                                                    </div>
                                                </div>              
                                                <div class="col col-lg-6 col-md-6 col-sm-12 col-12">
                                                    <div class="form-group label-floating">
                                                        <label class="control-label"><?php echo getEduAppGTLang('last_name');?></label>
                                                        <input class="form-control" name="last_name" value="<?php echo $row['last_name'];?>" type="text" required="">
                                                    </div>                
                                                </div>                
                                                <div class="col col-lg-6 col-md-6 col-sm-12 col-12">                
                                                    <div class="form-group date-time-picker label-floating">
                                                        <label class="control-label"><?php echo getEduAppGTLang('birthday');?></label>
                                                        <input type='text' class="datepicker-here" data-position="top left" data-language='en' name="datetimepicker" data-multiple-dates-separator="/" value="<?php echo $row['birthday'];?>"/>
                                                    </div>
                                                </div>
                                                <div class="col col-lg-6 col-md-6 col-sm-12 col-12">                
                                                    <div class="form-group label-floating">
                                                        <label class="control-label"><?php echo getEduAppGTLang('email');?></label>
                                                        <input class="form-control" name="email" value="<?php echo $row['email'];?>" type="email">
                                                    </div>
                                                </div>              
                                                <div class="col col-lg-6 col-md-6 col-sm-12 col-12">                
                                                    <div class="form-group label-floating">
                                                        <label class="control-label"><?php echo getEduAppGTLang('phone');?></label>
                                                        <input class="form-control" name="phone" value="<?php echo $row['phone'];?>" type="text">
                                                    </div>
                                                </div>  
                                                <div class="col col-lg-6 col-md-6 col-sm-12 col-12">              
                                                    <div class="form-group label-floating is-select">
                                                        <label class="control-label"><?php echo getEduAppGTLang('gender');?></label>
                                                        <div class="select">
                                                            <select name="gender" required="">
                                                                <option value="">Seleccionar</option>
                                                                <option value="M" <?php if($row['sex'] == 'M') echo "selected";?>><?php echo getEduAppGTLang('male');?></option>
                                                                <option value="F" <?php if($row['sex'] == 'F') echo "selected";?>><?php echo getEduAppGTLang('female');?></option>
                                                            </select>
                                                        </div>
                                                    </div>  
                                                </div> 
                                                <div class="col col-lg-6 col-md-6 col-sm-12 col-12">              
                                                    <div class="form-group label-floating is-select">
                                                        <label class="control-label"><?php echo getEduAppGTLang('status');?></label>
                                                        <div class="select">
                                                            <select name="student_session" required="">
                                                                <option value=""><?php echo getEduAppGTLang('select');?></option>
                                                                <option value="1" <?php if($row['student_session'] == 1) echo "selected";?>><?php echo getEduAppGTLang('active');?></option>
                                                                <option value="0" <?php if($row['student_session'] == 0) echo "selected";?>><?php echo getEduAppGTLang('inactive');?></option>
                                                            </select>
                                                        </div>
                                                    </div>  
                                                </div>             
                                                <div class="col col-lg-6 col-md-6 col-sm-12 col-12">                
                                                    <div class="form-group label-floating">
                                                        <label class="control-label"><?php echo getEduAppGTLang('username');?></label>
                                                        <input class="form-control" name="username" value="<?php echo $row['username'];?>" autocomplete="false" required="" type="text">
                                                    </div>
                                                </div>                   
                                                <div class="col col-lg-6 col-md-6 col-sm-12 col-12">                
                                                    <div class="form-group label-floating">
                                                        <label class="control-label"><?php echo getEduAppGTLang('update_password');?></label>
                                                        <input class="form-control" name="password" type="password">
                                                    </div>
                                                </div>    
                                                <div class="col col-lg-6 col-md-6 col-sm-12 col-12">                
                                                    <div class="form-group label-floating">
                                                        <label class="control-label"><?php echo getEduAppGTLang('address');?></label>
                                                        <input class="form-control" name="address" value="<?php echo $row['address'];?>" type="text">
                                                    </div>
                                                </div>              
                                                <div class="col col-lg-6 col-md-6 col-sm-12 col-12">
                                                    <div class="form-group label-floating">
                                                        <label class="control-label"><?php echo getEduAppGTLang('roll');?></label>
                                                        <input class="form-control" name="roll" value="<?php echo $this->db->get_where('enroll', array('student_id' => $row['student_id']))->row()->roll;?>" type="text">
                                                    </div>
                                                </div>                
                                                <div class="col col-lg-6 col-md-6 col-sm-12 col-12">                
                                                    <div class="form-group label-floating is-select">
                                                        <label class="control-label"><?php echo getEduAppGTLang('class');?></label>
                                                        <div class="select">
                                                            <select name="class_id">
                                                                <option value=""><?php echo getEduAppGTLang('select');?></option>
                                                                <?php $classes = $this->db->get('class')->result_array();
                                                                    foreach($classes as $class):
                                                                ?>
                                                                <option value="<?php echo $class['class_id'];?>" <?php if($class['class_id'] == $this->db->get_where('enroll', array('student_id' => $row['student_id']))->row()->class_id) echo "selected";?>><?php echo $class['name'];?></option>
                                                            <?php endforeach;?>
                                                            </select>
                                                        </div>
                                                    </div>                
                                                </div>
                                                <div class="col col-lg-6 col-md-6 col-sm-12 col-12">              
                                                    <div class="form-group label-floating is-select">
                                                        <label class="control-label"><?php echo getEduAppGTLang('section');?></label>
                                                        <div class="select">
                                                        <?php $class_id = $this->db->get_where('enroll', array('student_id' => $row['student_id']))->row()->class_id;?>
                                                            <select name="section_id">
                                                                <option value=""><?php echo getEduAppGTLang('select');?></option>
                                                                <?php $sections = $this->db->get_where('section', array('class_id' => $class_id))->result_array();
                                                                foreach($sections as $section):
                                                                ?>
                                                                <option value="<?php echo $section['section_id'];?>" <?php if($section['section_id'] == $this->db->get_where('enroll', array('student_id' => $row['student_id']))->row()->section_id) echo "selected";?>><?php echo $section['name'];?></option>
                                                                <?php endforeach;?>
                                                            </select>
                                                        </div>
                                                    </div>  
                                                </div>
                                                <div class="col col-lg-6 col-md-6 col-sm-12 col-12">                
                                                    <div class="form-group label-floating is-select">
                                                        <label class="control-label"><?php echo getEduAppGTLang('parent');?></label>
                                                        <div class="select">
                                                            <select name="parent_id">
                                                                <option value=""><?php echo getEduAppGTLang('select');?></option>
                                                                <?php 
                                                                    $parents = $this->db->get('parent')->result_array();
                                                                    foreach($parents as $parent):
                                                                ?>
                                                                <option value="<?php echo $parent['parent_id'];?>" <?php if($parent['parent_id'] == $row['parent_id']) echo "selected";?>><?php echo $this->crud->get_name('parent', $parent['parent_id']);?></option>
                                                                <?php endforeach;?>
                                                            </select>
                                                        </div>
                                                    </div>                
                                                </div>    
                                                <div class="col col-lg-6 col-md-6 col-sm-12 col-12">                
                                                    <div class="form-group label-floating is-select">
                                                        <label class="control-label"><?php echo getEduAppGTLang('transport');?></label>
                                                        <div class="select">
                                                            <select name="transport_id">
                                                                <option value=""><?php echo getEduAppGTLang('select');?></option>
                                                                <?php 
                                                                    $bus = $this->db->get('transport')->result_array();
                                                                    foreach($bus as $trans):
                                                                ?>
                                                                <option value="<?php echo $trans['transport_id'];?>" <?php if($row['transport_id'] == $trans['transport_id']) echo "selected";?>><?php echo $trans['route_name'];?></option>
                                                                <?php endforeach;?>
                                                            </select>
                                                        </div>
                                                    </div>              
                                                </div>
                                                <div class="col col-lg-6 col-md-6 col-sm-12 col-12">              
                                                    <div class="form-group label-floating is-select">
                                                        <label class="control-label"><?php echo getEduAppGTLang('classroom');?></label>
                                                        <div class="select">
                                                            <select name="dormitory_id">
                                                                <option value=""><?php echo getEduAppGTLang('select');?></option>
                                                                <?php 
                                                                    $classroom = $this->db->get('dormitory')->result_array();
                                                                    foreach($classroom as $room):
                                                                ?>
                                                                <option value="<?php echo $room['dormitory_id'];?>" <?php if($row['dormitory_id'] == $room['dormitory_id']) echo "selected";?>><?php echo $room['name'];?></option>
                                                            <?php endforeach;?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col col-lg-6 col-md-6 col-sm-12 col-12">
                                                    <div class="form-group label-floating">
                                                        <label class="control-label"><?php echo getEduAppGTLang('conditions_or_diseases');?></label>
                                                        <input class="form-control" name="diseases" type="text" value="<?php echo $row['diseases'];?>">
                                                    </div>
                                                </div>
                                                <div class="col col-lg-6 col-md-6 col-sm-12 col-12">
                                                    <div class="form-group label-floating">
                                                        <label class="control-label"><?php echo getEduAppGTLang('allergies');?></label>
                                                        <input class="form-control" name="allergies" type="text" value="<?php echo $row['allergies'];?>">
                                                    </div>
                                                </div>               
                                                <div class="col col-lg-6 col-md-6 col-sm-12 col-12">          
                                                    <div class="form-group label-floating">
                                                        <label class="control-label"><?php echo getEduAppGTLang('personal_doctor');?></label>
                                                        <input class="form-control" name="doctor" type="text" value="<?php echo $row['doctor'];?>">
                                                    </div>
                                                </div>
                                                <div class="col col-lg-6 col-md-6 col-sm-12 col-12">
                                                    <div class="form-group label-floating">
                                                        <label class="control-label"><?php echo getEduAppGTLang('doctor_phone');?>.</label>
                                                        <input class="form-control" name="doctor_phone" type="text" value="<?php echo $row['doctor_phone'];?>">
                                                    </div>
                                                </div>
                                                <div class="col col-lg-6 col-md-6 col-sm-12 col-12">          
                                                    <div class="form-group label-floating">
                                                        <label class="control-label"><?php echo getEduAppGTLang('authorized_person');?></label>
                                                        <input class="form-control" name="auth_person" type="text" value="<?php echo $row['authorized_person'];?>">
                                                    </div>
                                                </div>               
                                                <div class="col col-lg-6 col-md-6 col-sm-12 col-12">
                                                    <div class="form-group label-floating">
                                                        <label class="control-label"><?php echo getEduAppGTLang('authorized_person_phone');?></label>
                                                        <input class="form-control" name="auth_phone" type="text" value="<?php echo $row['authorized_phone'];?>">
                                                    </div>
                                                </div>               
                                                <div class="col col-lg-12 col-md-12 col-sm-12 col-12">
                                                    <div class="form-group label-floating">
                                                        <label class="control-label"><?php echo getEduAppGTLang('notes');?>:</label>
                                                        <textarea class="form-control" name="note"><?php echo $row['note'];?></textarea>
                                                    </div>
                                                </div>  
                                                <div class="col col-lg-12 col-md-12 col-sm-12 col-12">                
                                                    <div class="form-group">
                                                        <label class="control-label"><?php echo getEduAppGTLang('photo');?></label>
                                                        <input class="form-control" placeholder="" name="userfile" type="file">
                                                    </div>
                                                </div>
                                                <div class="col col-lg-12 col-md-12 col-sm-12 col-12">                
                                                    <div class="form-buttons-w">
                                                        <button class="btn btn-rounded btn-success" type="submit"> <?php echo getEduAppGTLang('update');?></button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php echo form_close();?>
                                </div>
                            </div>
                        </main>
                        <div class="col col-xl-3 order-xl-1 col-lg-12 order-lg-2 col-md-12 col-sm-12 col-12 ">
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
                                                        <a href="<?php echo base_url();?>admin/student_portal/<?php echo $student_id;?>/"><?php echo getEduAppGTLang('personal_information');?></a>
                                                    </li>
                                                    <li>
                                                        <i class="picons-thin-icon-thin-0133_arrow_right_next" style="font-size:20px"></i> &nbsp;&nbsp;&nbsp;
                                                        <a href="<?php echo base_url();?>admin/student_update/<?php echo $student_id;?>/"><?php echo getEduAppGTLang('update_information');?></a>
                                                    </li>
                                                    <li>
                                                        <i class="picons-thin-icon-thin-0133_arrow_right_next" style="font-size:20px"></i> &nbsp;&nbsp;&nbsp;
                                                        <a href="<?php echo base_url();?>admin/student_invoices/<?php echo $student_id;?>/"><?php echo getEduAppGTLang('payments_history');?></a>
                                                    </li>
                                                    <li>
                                                        <i class="picons-thin-icon-thin-0133_arrow_right_next" style="font-size:20px"></i> &nbsp;&nbsp;&nbsp;
                                                        <a href="<?php echo base_url();?>admin/student_marks/<?php echo $student_id;?>/"><?php echo getEduAppGTLang('marks');?></a>
                                                    </li>
                                                    <li>
                                                        <i class="picons-thin-icon-thin-0133_arrow_right_next" style="font-size:20px"></i> &nbsp;&nbsp;&nbsp;
                                                        <a href="<?php echo base_url();?>admin/student_profile_attendance/<?php echo $student_id;?>/"><?php echo getEduAppGTLang('attendance');?></a>
                                                    </li>
                                                    <li>
                                                        <i class="picons-thin-icon-thin-0133_arrow_right_next" style="font-size:20px"></i> &nbsp;&nbsp;&nbsp;
                                                        <a href="<?php echo base_url();?>admin/student_profile_report/<?php echo $student_id;?>/"><?php echo getEduAppGTLang('behavior');?></a>
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
<?php endforeach;?>