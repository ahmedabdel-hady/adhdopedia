<?php $running_year = $this->crud->getInfo('running_year'); ?>
    <div class="content-w">
        <?php include 'fancy.php';?>
        <div class="header-spacer"></div>
        <div class="conty">
            <div class="os-tabs-w menu-shad">
                <div class="os-tabs-controls">
                    <ul class="navs navs-tabs upper">
                        <li class="navs-item">
                            <a class="navs-links" href="<?php echo base_url();?>admin/class_routine_view/"><i class="os-icon picons-thin-icon-thin-0024_calendar_month_day_planner_events"></i><span><?php echo getEduAppGTLang('class_routine');?></span></a>
                        </li>
                        <li class="navs-item">
                            <a class="navs-links active" href="<?php echo base_url();?>admin/teacher_routine/"><i class="os-icon picons-thin-icon-thin-0011_reading_glasses"></i><span><?php echo getEduAppGTLang('teacher_routine');?></span></a>
                        </li>
                    </ul>     
                </div>
            </div>
            <div class="content-box">
                <div class="row">
                    <div class="col col-lg-9 col-md-9 col-sm-12 col-12">
                        <?php echo form_open(base_url() . 'admin/teacher_routine/', array('class' => 'form m-b'));?>
                            <div class="form-group label-floating is-select">
                                <label class="control-label"><?php echo getEduAppGTLang('teacher');?></label>
                                <div class="select">
                                    <select onchange="submit();" name="teacher_id" id="slct">
                                        <option value=""><?php echo getEduAppGTLang('select');?></option>
                                        <?php $teachers = $this->db->get('teacher')->result_array();
                                        foreach($teachers as $row):?>
                                        <option  value="<?php echo $row['teacher_id'];?>" <?php if($teacher_id == $row['teacher_id']) echo 'selected';?>><?php echo $row['first_name']." ".$row['last_name'];?></option>
                                        <?php endforeach;?>
                                    </select>
                                </div>
                            </div>
                        <?php echo form_close();?>
                    </div>
                </div>               
                <div class="tab-content">
                <?php if($teacher_id > 0):?>
                    <div class="element-wrapper">
                        <div class="element-box table-responsive lined-primary shadow" id="print_area">
                            <div>
                                <center> 
                                    <h5><?php echo getEduAppGTLang('teacher_routine');?></h5>
                                    <img style="max-height:40px;" src="<?php echo $this->crud->get_image_url('teacher', $teacher_id);?>" alt=""/>   
                                    <p><?php echo $this->db->get_where('teacher', array('teacher_id' => $teacher_id))->row()->first_name." ".$this->db->get_where('teacher', array('teacher_id' => $teacher_id))->row()->last_name;?></p>
                                </center>
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
                                        <td width="120" class="bg-primary text-white" height="90" style="text-align: center;"><strong><?php echo ucwords(getEduAppGTLang($day));?></strong></td>
                                        <?php
                                            $this->db->order_by("time_start", "asc");
                                            $this->db->where('day' , $day);
                                            $this->db->where('year' , $running_year);
                                            $this->db->where('teacher_id' , $teacher_id);
                                            $routines   =   $this->db->get('class_routine')->result_array();
                                            foreach($routines as $row2):
                                        ?>
                                        <td style="text-align:center"><?php echo $row2['time_start'].':'.$row2['time_start_min']." <b>".$row2['amstart']."</b>".' - '.$row2['time_end'].':'.$row2['time_end_min']." <b>".$row2['amend']."</b>";?>
                                        <br><b><?php echo $this->crud->get_subject_name_by_id($row2['subject_id']);?></b><br><small><?php echo $this->db->get_where('class', array('class_id' => $row2['class_id']))->row()->name;?> - <strong><?php echo $this->db->get_where('section', array('section_id' => $row2['section_id']))->row()->name;?></strong></small></td>
                                    <?php endforeach;?>
                                    </table>
                                </tr>
                                <?php endfor;?>       
                            </table>
                        </div>
                        <button class="btn btn-rounded btn-primary pull-right" onclick="printDiv('print_area')" ><?php echo getEduAppGTLang('print');?></button><br><br><br>
                    </div>  
                <?php endif;?>
                </div>      
            </div>
        </div>
        <div class="display-type"></div>
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