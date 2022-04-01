<?php $running_year = $this->crud->getInfo('running_year');?>
    <div class="content-w">
        <div class="conty">
        <?php include 'fancy.php';?>
        <div class="header-spacer"></div>
            <div class="os-tabs-w menu-shad">
                <div class="os-tabs-controls">
                    <ul class="navs navs-tabs upper">
                        <li class="navs-item">
                            <a class="navs-links active" href="<?php echo base_url();?>parents/class_routine/"><i class="os-icon picons-thin-icon-thin-0024_calendar_month_day_planner_events"></i><span><?php echo getEduAppGTLang('class_routine');?></span></a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="content-i">
                <div class="content-box">
                    <div class="os-tabs-w">
                        <div class="os-tabs-controls">
                            <ul class="navs navs-tabs upper">
                            <?php 
                                $n = 1;
                                $children_of_parent = $this->db->get_where('student' , array('parent_id' => $this->session->userdata('parent_id')))->result_array();
                                foreach ($children_of_parent as $row):
                            ?>
                                <li class="navs-item">
                                    <?php $active = $n++;?>
                                    <a class="navs-links <?php if($active == 1) echo 'active';?>" data-toggle="tab" href="#<?php echo $row['username'];?>"><img alt="" src="<?php echo $this->crud->get_image_url('student', $row['student_id']);?>" width="25px" style="border-radius: 25px;margin-right:5px;"> <?php echo $this->crud->get_name('student', $row['student_id']);?></a>
                                </li>
                            <?php endforeach; ?>
                            </ul>
                        </div>
                    </div>
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
                                <div class="element-box table-responsive lined-primary shadow" id="print_area<?php echo $row2['student_id'];?>">
                                    <div class="row m-b">
                                        <div style="display:inline-block">
                                            <img style="max-height:80px;margin:0px 10px 20px 20px" src="<?php echo base_url();?>public/uploads/<?php echo $this->crud->getInfo('logo');?>" alt=""/>    
                                        </div>
                                        <div style="padding-left:20px;display:inline-block;">
                                            <h5><?php echo $this->crud->get_name('student', $row2['student_id']);?></h5>
                                            <p><?php echo getEduAppGTLang('class_routine');?></p>
                                        </div>    
                                    </div>
                                    <table class="table table-bordered table-schedule table-hover" cellpadding="0" cellspacing="0" width="100%">
                                    <?php
                                        $days = $this->db->get_where('academic_settings', array('type' => 'routine'))->row()->description; 
                                        if($days == 2) { $nday = 6;}else{$nday = 7;}
                                        for($d=$days; $d <= $nday; $d++):
                                        if($d==1)$day = 'Sunday';
                                        else if($d==2) $day = 'Monday';
                                        else if($d==3) $day = 'Tuesday';
                                        else if($d==4) $day = 'Wednesday';
                                        else if($d==5) $day = 'Thursday';
                                        else if($d==6) $day = 'Friday'; 
                                        else if($d==7) $day = 'Saturday';
                                    ?>
                                        <tr>
                                            <table class="table table-schedule table-hover" cellpadding="0" cellspacing="0">
                                                <td width="120" class="bg-primary text-white" height="100"><?php echo getEduAppGTLang($day);?></td>
                                                <?php
                                                    $this->db->order_by("time_start", "asc");
                                                    $this->db->where('day' , $day);
                                                    $this->db->where('class_id' , $class_id);
                                                    $this->db->where('section_id' , $section_id);
                                                    $this->db->where('year' , $running_year);
                                                    $rout  =   $this->db->get('class_routine'); 
                                                    $routines = $rout->result_array();
                                                    foreach($routines as $row5):
                                                    $teacher_id = $this->db->get_where('subject', array('subject_id' => $row5['subject_id']))->row()->teacher_id;
                                                ?>
                                                <td style="text-align:center">
                                                    <?php echo '<b>'.getEduAppGTLang('classroom').'</b>: '.$this->db->get_where('dormitory', array('dormitory_id' => $row5['classroom_id']))->row()->name.'.<br>'.$row5['time_start'].":".$row5['time_start_min']." " ."<b>".$row5['amstart']."</b>". ' - ' . $row5['time_end'].":".$row5['time_end_min']." "."<b>".$row5['amend']."</b>";?>
                                            <br><b><?php echo $this->crud->get_subject_name_by_id($row5['subject_id']);?></b><br><small><?php echo $this->crud->get_name('teacher',$teacher_id);?></small>
                                                </td>
                                                <?php endforeach;?>
                                            </table>
                                        </tr>
                                    <?php endfor;?>  
                                    </table>
                                </div>
                                <button class="btn btn-rounded btn-success pull-right" onclick="printDiv('print_area<?php echo $row2['student_id'];?>')" ><?php echo getEduAppGTLang('print');?></button><br><br><br>
                            </div>
                        </div>  
                    <?php endforeach;?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
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