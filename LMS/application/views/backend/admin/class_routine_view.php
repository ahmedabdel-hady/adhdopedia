    <?php $running_year = $this->crud->getInfo('running_year'); ?>
    <div class="content-w">
        <?php include 'fancy.php';?>
        <div class="header-spacer"></div>
        <div class="conty">
            <div class="os-tabs-w menu-shad">
                <div class="os-tabs-controls">
                    <ul class="navs navs-tabs upper">
                        <li class="navs-item">
                            <a class="navs-links active" href="<?php echo base_url();?>admin/class_routine_view/"><i class="os-icon picons-thin-icon-thin-0024_calendar_month_day_planner_events"></i><span><?php echo getEduAppGTLang('class_routine');?></span></a>
                        </li>
                        <li class="navs-item">
                            <a class="navs-links" href="<?php echo base_url();?>admin/teacher_routine/"><i class="os-icon picons-thin-icon-thin-0011_reading_glasses"></i><span><?php echo getEduAppGTLang('teacher_routine');?></span></a>
                        </li>
                    </ul>     
                </div>
            </div>
            <div class="content-box">
                <div class="row">
                    <div class="col col-lg-9 col-md-9 col-sm-12 col-12">
                        <?php echo form_open(base_url() . 'admin/class_routine_view/', array('class' => 'form m-b'));?>
                            <div class="form-group label-floating is-select">
                                <label class="control-label"><?php echo getEduAppGTLang('filter_by_class');?></label>
                                <div class="select">
                                    <select onchange="submit();" name="class_id" onchange="submit();">
                                        <option value=""><?php echo getEduAppGTLang('select');?></option>
                                        <?php $cl = $this->db->get('class')->result_array();
                                        foreach($cl as $row):?>
                                        <option value="<?php echo $row['class_id'];?>" <?php if($id == $row['class_id']) echo 'selected';?>><?php echo $row['name'];?></option>
                                        <?php endforeach;?>
                                    </select>
                                </div>
                            </div>
                        <?php echo form_close();?>
                    </div>
                    <div class="col col-lg-3 col-md-3 col-sm-12 col-12">
                        <div class="text-">
                            <button class="btn btn-rounded btn-success btn-upper" data-target="#addroutine" data-toggle="modal" type="button">+ <?php echo getEduAppGTLang('add_schedule');?></button>
                        </div>
                    </div>
                </div>               
                <div class="" style="padding-top:25px; padding-left:18px;">
                    <div class="os-tabs-w">
                        <div class="os-tabs-controls">
                            <ul class="navs navs-tabs upper">
                            <?php $query = $this->db->get_where('section' , array('class_id' => $id)); 
                                if ($query->num_rows() > 0):
                                $sections = $query->result_array();
                                foreach ($sections as $rows):?>
                                <li class="navs-item">
                                    <a class="navs-link <?php if($rows['name'] == 'A') echo 'active';?>" data-toggle="tab" href="#<?php echo $rows['name'];?>"><?php echo getEduAppGTLang('section');?> <?php echo $rows['name'];?></a>
                                </li>   
                                <?php endforeach;?>
                            <?php endif;?>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="tab-content">
                    <?php $query = $this->db->get_where('section' , array('class_id' => $id));
                    if ($query->num_rows() > 0):
                    $sections = $query->result_array();
                    foreach ($sections as $row): ?>
                    <div class="tab-pane <?php if($row['name'] == 'A') echo 'active';?>" id="<?php echo $row['name'];?>">
                        <div class="element-wrapper">
                            <div class="element-box table-responsive lined-primary shadow" id="print_area<?php echo $row['section_id'];?>">
                                <div class="row m-b">
                                    <div style="display:inline-block">
                                        <img style="max-height:80px;margin:0px 10px 20px 20px" src="<?php echo base_url();?>public/uploads/<?php echo $this->crud->getInfo('logo');?>"/>    
                                    </div>
                                    <div style="padding-left:20px;display:inline-block;">
                                        <h5><?php echo getEduAppGTLang('class_routine');?></h5>
                                        <p><?php echo $this->db->get_where('class', array('class_id' => $id))->row()->name;?><br><?php echo getEduAppGTLang('section');?> <?php echo $this->db->get_where('section', array('section_id' => $row['section_id']))->row()->name;?></p>
                                    </div>
                                </div>
                                <table class="table table-bordered table-schedule table-hover" cellpadding="0" cellspacing="0" width="100%">
                                <?php
                                    $days = $this->db->get_where('academic_settings', array('type' => 'routine'))->row()->description; 
                                    if($days == 2) { $nday = 6;}else{$nday = 7;}
                                    for($d=$days; $d <= $nday; $d++):
                                    if($d==1)$day = 'Sunday';
                                    else if($d==2) $day ='Monday';
                                    else if($d==3) $day = 'Tuesday';
                                    else if($d==4) $day ='Wednesday';
                                    else if($d==5) $day ='Thursday';
                                    else if($d==6) $day ='Friday';
                                    else if($d==7) $day ='Saturday';
                                ?>
                                    <tr>
                                        <table class="table table-schedule table-hover" cellpadding="0" cellspacing="0">
                                            <td width="120" class="bg-primary text-white" height="100" style="text-align: center;">
                                                <strong><?php echo getEduAppGTLang($day);?></strong>
                                            </td>
                                            <?php
                                                $this->db->order_by("time_start", "asc");
                                                $this->db->where('day' , $day);
                                                $this->db->where('class_id' , $id);
                                                $this->db->where('section_id' , $row['section_id']);
                                                $this->db->where('year' , $running_year);
                                                $rout  =   $this->db->get('class_routine');
                                                $routines = $rout->result_array();
                                                foreach($routines as $row2):
                                                $teacher_id = $this->db->get_where('subject', array('subject_id' => $row2['subject_id']))->row()->teacher_id;
                                            ?>
                                            <td style="text-align:center">
                                                <div class="pi-controls" style="text-align:right;">
                                                    <div class="pi-settings os-dropdown-trigger">
                                                        <i class="os-icon picons-thin-icon-thin-0069a_menu_hambuger"></i>
                                                        <div class="os-dropdown">
                                                            <div class="icon-w">
                                                                <i class="os-icon picons-thin-icon-thin-0069a_menu_hambuger"></i>
                                                            </div>
                                                            <ul>
                                                                <li>
                                                                    <a onclick="showAjaxModal('<?php echo base_url();?>modal/popup/modal_routine/<?php echo $row2['class_routine_id'];?>');" href="javascript:void(0);"><i class="os-icon  picons-thin-icon-thin-0001_compose_write_pencil_new"></i><span><?php echo getEduAppGTLang('edit');?></span></a> 
                                                                </li>
                                                                <li>
                                                                    <a onClick="return confirm('<?php echo getEduAppGTLang('confirm_delete');?>')" href="<?php echo base_url();?>admin/class_routine/delete/<?php echo $row2['class_routine_id'];?>"><i class="os-icon picons-thin-icon-thin-0056_bin_trash_recycle_delete_garbage_empty"></i><span><?php echo getEduAppGTLang('delete');?></span></a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                                <?php echo '<b>'.getEduAppGTLang('classroom').'</b>: '.$this->db->get_where('dormitory', array('dormitory_id' => $row2['classroom_id']))->row()->name.'.<br>'.$row2['time_start'].":".$row2['time_start_min']." " ."<b>".$row2['amstart']."</b>". ' - ' . $row2['time_end'].":".$row2['time_end_min']." "."<b>".$row2['amend']."</b>";?>
                                                <br><b><?php echo $this->crud->get_subject_name_by_id($row2['subject_id']);?></b><br><small><?php echo $this->crud->get_name('teacher', $teacher_id);?></small> 
                                            </td>
                                        <?php endforeach;?>
                                        </table>
                                    </tr>
                                <?php endfor;?>  
                                </table>
                            </div>
                            <button class="btn btn-rounded btn-primary pull-right" onclick="printDiv('print_area<?php echo $row['section_id'];?>')" ><?php echo getEduAppGTLang('print');?></button><br><br><br>
                        </div>  
                    </div>
                    <?php endforeach;?>
                    <?php endif;?>
                </div>      
            </div>
        </div>
        <div class="display-type"></div>
    </div>

    <div class="modal fade" id="addroutine" tabindex="-1" role="dialog" aria-labelledby="addroutine" aria-hidden="true">
        <div class="modal-dialog window-popup edit-my-poll-popup" role="document">
            <div class="modal-content">
                <a href="javascript:void(0);" class="close icon-close" data-dismiss="modal" aria-label="Close"></a>
                <div class="modal-body">
                    <div class="ui-block-title" style="background-color:#00579c">
                        <h6 class="title" style="color:white"><?php echo getEduAppGTLang('add_schedules');?> </h6>
                    </div>
                    <div class="ui-block-content">
                        <?php echo form_open(base_url() . 'admin/class_routine/create');?>
                            <div class="row">
                                <div class="col col-lg-12 col-md-12 col-sm-12 col-12">
                                    <div class="form-group label-floating is-select">
                                        <label class="control-label"><?php echo getEduAppGTLang('classroom');?></label>
                                        <div class="select">
                                            <select name="classroom_id">
                                                <option value=""><?php echo getEduAppGTLang('select');?></option>
                                                <?php $clsm = $this->db->get('dormitory')->result_array();
                                                foreach($clsm as $row2): ?>
                                                <option value="<?php echo $row2['dormitory_id'];?>"><?php echo $row2['name'];?></option>
                                                <?php endforeach;?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col col-lg-6 col-md-6 col-sm-12 col-12">
                                    <div class="form-group label-floating is-select">
                                        <label class="control-label"><?php echo getEduAppGTLang('class');?></label>
                                        <div class="select">
                                            <select name="class_id" onchange="get_class_sections(this.value);" required="">
                                                <option value=""><?php echo getEduAppGTLang('select');?></option>
                                                <?php $cl = $this->db->get('class')->result_array();
                                                foreach($cl as $row): ?>
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
                                            <select name="section_id" id="section_selector_holder" onchange="get_class_subject(this.value);" required="">
                                                <option value=""><?php echo getEduAppGTLang('select');?></option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col col-lg-6 col-md-6 col-sm-12 col-12">
                                    <div class="form-group label-floating is-select">
                                        <label class="control-label"><?php echo getEduAppGTLang('course');?></label>
                                        <div class="select">
                                            <select name="subject_id" id="subject_selector_holder" required="">
                                                <option value=""><?php echo getEduAppGTLang('select');?></option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col col-lg-6 col-md-6 col-sm-12 col-12">
                                    <div class="form-group label-floating is-select">
                                        <label class="control-label"><?php echo getEduAppGTLang('day');?></label>
                                        <div class="select">
                                            <select name="day" required="">
                                                <option value=""><?php echo getEduAppGTLang('select');?></option>
                                                <?php
                                                $days = $this->db->get_where('academic_settings', array('type' => 'routine'))->row()->description; 
                                                if($days == 1):?>
                                                    <option value="Sunday"><?php echo getEduAppGTLang('sunday');?></option>
                                                <?php endif;?>
                                                <option value="Monday"><?php echo getEduAppGTLang('monday');?></option>
                                                <option value="Tuesday"><?php echo getEduAppGTLang('tuesday');?></option>
                                                <option value="Wednesday"><?php echo getEduAppGTLang('wednesday');?></option>
                                                <option value="Thursday"><?php echo getEduAppGTLang('thursday');?></option>
                                                <option value="Friday"><?php echo getEduAppGTLang('friday');?></option>
                                                <?php if($days == 1):?>
                                                    <option value="Saturday"><?php echo getEduAppGTLang('saturday');?></option>
                                                <?php endif;?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-12"><legend><span style="font-size:15px;"><?php echo getEduAppGTLang('start');?></span></legend></div>
                                <div class="col col-lg-4 col-md-4 col-sm-12 col-12">
                                    <div class="form-group label-floating is-select">
                                        <label class="control-label"><?php echo getEduAppGTLang('hour');?></label>
                                        <div class="select">
                                            <select name="time_start" required="">
                                                <option value=""><?php echo getEduAppGTLang('select');?></option>
                                                <?php for($i = 1; $i <= 24 ; $i++):?>
                                                <option value="<?php if($i < 10) echo '0'.$i; else echo $i;?>"><?php if($i < 10) echo '0'.$i; else echo $i;?></option>
                                                <?php endfor;?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col col-lg-4 col-md-4 col-sm-12 col-12">
                                    <div class="form-group label-floating is-select">
                                        <label class="control-label"><?php echo getEduAppGTLang('minutes');?></label>
                                        <div class="select">
                                            <select name="time_start_min" required="">
                                                <option value=""><?php echo getEduAppGTLang('select');?></option>
                                                <?php for($i = 0; $i <= 11 ; $i++):?>
                                                    <option value="<?php $n = $i * 5; if($n < 10) echo '0'.$n; else echo $n;?>"><?php $n = $i * 5; if($n < 10) echo '0'.$n; else echo $n;?></option>
                                                <?php endfor;?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col col-lg-4 col-md-4 col-sm-12 col-12">
                                    <div class="form-group label-floating is-select">
                                        <label class="control-label"><?php echo getEduAppGTLang('minutes');?></label>
                                        <div class="select">
                                            <select name="starting_ampm" required="">
                                                <option value="AM">AM</option>
                                                <option value="PM">PM</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-12"><legend><span style="font-size:15px;"><?php echo getEduAppGTLang('end');?></span></legend></div>
                                <div class="col col-lg-4 col-md-4 col-sm-12 col-12">
                                    <div class="form-group label-floating is-select">
                                        <label class="control-label"><?php echo getEduAppGTLang('hour');?></label>
                                        <div class="select">
                                            <select name="time_end" required="">
                                                <option value=""><?php echo getEduAppGTLang('select');?></option>
                                                <?php for($i = 1; $i <= 24 ; $i++):?>
                                                <option value="<?php if($i < 10) echo '0'.$i; else echo $i;?>"><?php if($i < 10) echo '0'.$i; else echo $i;?></option>
                                            <?php endfor;?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col col-lg-4 col-md-4 col-sm-12 col-12">
                                    <div class="form-group label-floating is-select">
                                        <label class="control-label"><?php echo getEduAppGTLang('minutes');?></label>
                                        <div class="select">
                                            <select name="time_end_min" required="">
                                                <option value=""><?php echo getEduAppGTLang('select');?></option>
                                                <?php for($i = 0; $i <= 11 ; $i++):?>
                                                    <option value="<?php $n = $i * 5; if($n < 10) echo '0'.$n; else echo $n;?>"><?php $n = $i * 5; if($n < 10) echo '0'.$n; else echo $n;?></option>
                                                <?php endfor;?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col col-lg-4 col-md-4 col-sm-12 col-12">
                                    <div class="form-group label-floating is-select">
                                        <label class="control-label"><?php echo getEduAppGTLang('minutes');?></label>
                                        <div class="select">
                                            <select name="ending_ampm" required="">
                                                <option value="AM">AM</option>
                                                <option value="PM">PM</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-buttons-w text-right">
                                <center><button class="btn btn-rounded btn-success btn-lg" type="submit"><?php echo getEduAppGTLang('add');?></button></center>
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
        function get_class_subject(section_id) {
            $.ajax({
                url: '<?php echo base_url(); ?>admin/get_class_subject/' + section_id,
                success: function (response)
                {
                    jQuery('#subject_selector_holder').html(response);
                }
            });
        }
    </script>
    <script>
        function printDiv(nombreDiv) 
        {
            var contenido= document.getElementById(nombreDiv).innerHTML;
            var contenidoOriginal= document.body.innerHTML;
            document.body.innerHTML = contenido;
            window.print();
            document.body.innerHTML = contenidoOriginal;
        }
    </script> 