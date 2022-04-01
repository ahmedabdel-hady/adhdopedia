<?php 
    $running_year = $this->crud->getInfo('running_year'); 
    $class_id = $this->db->get_where('enroll', array('student_id' => $this->session->userdata('login_user_id'), 'year' => $running_year))->row()->class_id;
    $section_id = $this->db->get_where('enroll' , array('student_id' => $this->session->userdata('login_user_id'),'class_id' => $class_id,'year' => $running_year))->row()->section_id;
?>
    <div class="content-w">
        <?php include 'fancy.php';?>
        <div class="header-spacer"></div>
        <div class="conty">
            <div class="os-tabs-w menu-shad">
                <div class="os-tabs-controls">
                    <ul class="navs navs-tabs upper">
                        <li class="navs-item">
                            <a class="navs-links active" href="<?php echo base_url();?>student/class_routine/"><i class="os-icon picons-thin-icon-thin-0024_calendar_month_day_planner_events"></i><span><?php echo getEduAppGTLang('class_routine');?></span></a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="content-i">
                <div class="content-box">
                    <div class="element-wrapper">
                        <div class="element-box table-responsive lined-primary shadow" id="print_area">
                            <div class="row m-b">
                                <div style="display:inline-block">
                                    <img style="max-height:80px;margin:0px 10px 20px 20px" src="<?php echo base_url();?>public/uploads/<?php echo $this->crud->getInfo('logo');?>" alt=""/>    
                                </div>
                                <div style="padding-left:20px;display:inline-block;">
                                    <h5><?php echo getEduAppGTLang('class_routine');?></h5>
                                    <p><?php echo $this->db->get_where('class' , array('class_id' => $class_id))->row()->name;?><br><?php echo $this->db->get_where('section' , array('section_id' => $section_id))->row()->name;?></p>
                                </div>
                            </div>
                            <table class="table table-schedule table-hover" cellpadding="0" cellspacing="0">
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
                                        <td width="120" height="90" style="text-align: center;" class="bg-primary text-white"><strong> <?php echo ucwords(getEduAppGTLang($day));?></strong></td>
                                        <?php
                                            $this->db->order_by("time_start", "asc");
                                            $this->db->where('day' , $day);
                                            $this->db->where('class_id' , $class_id);
                                            $this->db->where('section_id' , $section_id);
                                            $this->db->where('year' , $running_year);
                                            $rout  =   $this->db->get('class_routine');
                                            $routines = $rout->result_array();
                                            foreach($routines as $row2):
                                            $teacher_id = $this->db->get_where('subject', array('subject_id' => $row2['subject_id']))->row()->teacher_id;
                                        ?>
                                        <td style="text-align:center">
                                            <?php echo '<b>'.getEduAppGTLang('classroom').'</b>: '.$this->db->get_where('dormitory', array('dormitory_id' => $row2['classroom_id']))->row()->name.'.<br>'.$row2['time_start'].":".$row2['time_start_min']." " ."<b>".$row2['amstart']."</b>". ' - ' . $row2['time_end'].":".$row2['time_end_min']." "."<b>".$row2['amend']."</b>";?>
                                            <br><b><?php echo $this->crud->get_subject_name_by_id($row2['subject_id']);?></b><br><small><?php echo $this->crud->get_name('teacher',$teacher_id);?></small>
                                        </td>
                                        <?php endforeach;?>
                                    </table>
                                </tr>
                            <?php endfor;?>  
                            </table>
                        </div>
                        <button class="btn btn-rounded btn-primary pull-right" onclick="printDiv('print_area')" ><?php echo getEduAppGTLang('print');?></button><br><br><br>
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