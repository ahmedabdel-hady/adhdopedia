<?php 
    $running_year = $this->crud->getInfo('running_year');
    $info = base64_decode($data);
    $ex = explode('-', $info);
    $sub = $this->db->get_where('subject', array('subject_id' => $ex[2]))->result_array();
    foreach($sub as $row):
?>
    <div class="content-w">
        <div class="conty">
        <?php include 'fancy.php';?>
        <div class="header-spacer"></div>
            <div class="cursos cta-with-media" style="background: #<?php echo $row['color'];?>;">
                <div class="cta-content">
                    <div class="user-avatar">
                        <img alt="" src="<?php echo base_url();?>public/uploads/subject_icon/<?php echo $row['icon'];?>" style="width:60px;">
                    </div>
                    <h3 class="cta-header"><?php echo $row['name'];?> - <small><?php echo getEduAppGTLang('online_exams');?></small></h3>
                    <small style="font-size:0.90rem; color:#fff;"><?php echo $this->db->get_where('class', array('class_id' => $ex[0]))->row()->name;?> "<?php echo $this->db->get_where('section', array('section_id' => $ex[1]))->row()->name;?>"</small>
                </div>
            </div> 
            <div class="os-tabs-w menu-shad">
                <div class="os-tabs-controls">
                    <ul class="navs navs-tabs upper">
                        <li class="navs-item">
                            <a class="navs-links" href="<?php echo base_url();?>student/subject_dashboard/<?php echo $data;?>/"><i class="os-icon picons-thin-icon-thin-0482_gauge_dashboard_empty"></i><span><?php echo getEduAppGTLang('dashboard');?></span></a>
                        </li>
                        <li class="navs-item">
                            <a class="navs-links active" href="<?php echo base_url();?>student/online_exams/<?php echo $data;?>/"><i class="os-icon picons-thin-icon-thin-0207_list_checkbox_todo_done"></i><span><?php echo getEduAppGTLang('online_exams');?></span></a>
                        </li>
                        <li class="navs-item">
                            <a class="navs-links" href="<?php echo base_url();?>student/homework/<?php echo $data;?>/"><i class="os-icon picons-thin-icon-thin-0004_pencil_ruler_drawing"></i><span><?php echo getEduAppGTLang('homework');?></span></a>
                        </li>
                        <li class="navs-item">
                            <a class="navs-links" href="<?php echo base_url();?>student/forum/<?php echo $data;?>/"><i class="os-icon picons-thin-icon-thin-0281_chat_message_discussion_bubble_reply_conversation"></i><span><?php echo getEduAppGTLang('forum');?></span></a>
                        </li>
                        <li class="navs-item">
                            <a class="navs-links" href="<?php echo base_url();?>student/study_material/<?php echo $data;?>/"><i class="os-icon picons-thin-icon-thin-0003_write_pencil_new_edit"></i><span><?php echo getEduAppGTLang('study_material');?></span></a>
                        </li>
                        <li class="navs-item">
                            <a class="navs-links" href="<?php echo base_url();?>student/subject_marks/<?php echo $data;?>/"><i class="os-icon picons-thin-icon-thin-0729_student_degree_science_university_school_graduate"></i><span><?php echo getEduAppGTLang('marks');?></span></a>
                        </li>
                        <li class="navs-item">
                            <a class="navs-links" href="<?php echo base_url();?>student/meet/<?php echo $data;?>/"><i class="os-icon picons-thin-icon-thin-0591_presentation_video_play_beamer"></i><span><?php echo getEduAppGTLang('live');?></span></a>
                        </li>
                        <li class="navs-item">
                            <a class="navs-links" href="<?php echo base_url();?>student/attendance_report/<?php echo $data;?>/"><i class="os-icon picons-thin-icon-thin-0023_calendar_month_day_planner_events"></i><span><?php echo getEduAppGTLang('attendance');?></span></a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="content-i">
                <div class="content-box">
                    <div class="row">
                        <main class="col col-xl-12 order-xl-2 col-lg-12 order-lg-1 col-md-12 col-sm-12 col-12">
                            <div id="newsfeed-items-grid">                
                                <div class="element-wrapper">
                                    <div class="element-box-tp">
                                        <h6 class="element-header"><?php echo getEduAppGTLang('online_exams');?></h6>
                                        <div class="table-responsive">
                                            <table class="table table-padded">
                                                <thead>
                                                    <tr>
                                                        <th><?php echo getEduAppGTLang('title');?></th>
                                                        <th><?php echo getEduAppGTLang('date');?></th>
                                                        <th><?php echo getEduAppGTLang('options');?></th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                <?php
                                                    foreach ($exams as $row):
                                                    if($row['results'] == 3){
                                                        $addMinutes = 15;   
                                                    }elseif($row['results'] == 4){
                                                        $addMinutes = 30;
                                                    }
                    	                            $current_time          = time();
                    	                            $exam_start_time       = strtotime(date('Y-m-d', $row['exam_date']).' '.$row['time_start']);
                    	                            $exam_end_time         = strtotime(date('Y-m-d', $row['exam_date']).' '.$row['time_end']);
                    	                            
                    	                            $startResult           = strtotime($row['time_end']);
                    	                            $endResult             = $addMinutes*60;
                                                    $newResult             = date("H:i",$startResult+$endResult).':00';
                                                    $exam_end_time_results = strtotime(date('Y-m-d', $row['exam_date']).' '.$newResult);
            	                                ?>
                                                    <tr>
                                                        <td><?php echo $row['title'];?></td>
                                                        <td><?php echo '<b>'.getEduAppGTLang('date').':</b> '.date('M d, Y', $row['exam_date']).'<br>'.'<b>'.getEduAppGTLang('hour').':</b> '.$row['time_start'].' - '.$row['time_end'];?></td>
                                                        <td class="bolder">
                                                        <?php if ($this->crud->check_availability_for_student($row['online_exam_id']) != "submitted"): ?>
                            								<?php if ($current_time >= $exam_start_time && $current_time <= $exam_end_time): ?>
                            									<a href="<?php echo base_url();?>student/examroom/<?php echo $row['code'];?>/" class="btn btn-success btn-rounded"><?php echo getEduAppGTLang('take_exam');?></a>
                            								<?php else: ?>
                            									<div class="btn btn-info btn-rounded">
                            										<?php echo getEduAppGTLang('take_exam_message');?>
                            									</div>
                            								<?php endif; ?>
                            							<?php else: ?>
                            								<?php if($row['results'] == 0 || $row['results'] == 1):?>
                            								    <a href="javascript:void(0);" class="btn btn-success btn-rounded"><?php echo getEduAppGTLang('ask_for_results');?></a>
                            								<?php elseif($row['results'] == 2):?>
                                                                <a href="<?php echo base_url();?>student/online_exam_result/<?php echo $row['online_exam_id'];?>/" class="btn btn-success btn-rounded"><?php echo getEduAppGTLang('view_results');?></a>
                            								<?php elseif($current_time > $exam_end_time && $current_time > $exam_end_time_results):?>
                                                                <a href="<?php echo base_url();?>student/online_exam_result/<?php echo $row['online_exam_id'];?>/" class="btn btn-success btn-rounded"><?php echo getEduAppGTLang('view_results');?></a>
                                                            <?php else:?>
                                                                <a href="javascript:void(0);" class="btn btn-warning btn-roundend"><?php echo getEduAppGTLang('waiting_results');?></a>
                                                            <?php endif; ?>
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
                        </main>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php endforeach;?>