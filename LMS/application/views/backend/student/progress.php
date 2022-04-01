    <?php $running_year = $this->crud->getInfo('running_year'); ?>
    <style>
        .popover-header{
            font-weight:bold;
            background:#a01a7a;
            color:#ffffff!important;
        }
        .popover-body{
            color:#000!important;
        }
        .todo-app-w .todo-content .tasks-list li.draggable-task.complete:before{
            background-color:#24b314!important;
        }
        .todo-app-w .todo-content .tasks-list li.draggable-task.warning:before{
            background-color:#f4af08!important;
        }
    </style>
    <div class="content-w">
        <div class="conty">
            <?php include 'fancy.php';?>
	        <div class="content-i">
                <div class="con tent-box" style="margin-top: 50px;width: 100%;">
			        <div class="todo-app-w">
                        <div class="todo-content">
                            <h4 class="todo-content-header">
                                <i class="picons-thin-icon-thin-0729_student_degree_science_university_school_graduate"></i><span style='font-weight:bold;font-size:19px'><?php echo getEduAppGTLang('school_timeline');?> (<?php echo getEduAppGTLang('this_week');?>).</span>
                            </h4>
                            <div class="all-tasks-w">
                            <?php
                                $week_days  = $this->crud->date_week(date('Y-m-d'));
                                $week_name_days  = $this->crud->panelDate();
                            ?>
                             <?php 
                                for($i = 0; $i < count($week_days); $i++):
                                $arrs = $this->crud->get_timeline($week_days[$i],$this->session->userdata('login_user_id'));
                             ?>
                                <div class="tasks-section">
                                    <div class="tasks-header-w" <?php $var_day = explode('-',$week_days[$i]); if($var_day[2] == date('d')):?>style="background: #a01a7a; border-radius: 12px; padding: 10px;"<?php endif;?>>
                                        <a class="tasks-header-toggler" href="#"><i class="picons-thin-icon-thin-0152_minus_delete_remove"></i></a>
                                        <h5 class="tasks-header" style="<?php $var_day = explode('-',$week_days[$i]); if($var_day[2] == date('d')):?>color: #ffffff; <?php endif;?>"><?php echo $week_name_days[$i];?></h5>
                                        <span class="tasks-sub-header" style="color:<?php $var_day = explode('-',$week_days[$i]); if($var_day[2] == date('d')):?> #ffffff; <?php else:?>rgba(0, 0, 0, 0.7);<?php endif;?>font-size: 0.95rem;">-  &nbsp;&nbsp;<?php $var_day = explode('-',$week_days[$i]);
                                        $originalDate = $var_day[1].'/'. $var_day[2].'/'.date('Y');
                                        $newDate = date($this->db->get_where('settings', array('type' => 'date_format'))->row()->description, strtotime($originalDate));
                                        echo $newDate; ?>.</span>
                                    </div>
                                    <?php if(count($arrs) > 0):?>
                                    <div class="tasks-list-w">
                                        <ul class="tasks-list">
                                        <?php 
                                            //success, favorite, complete, warning
                                            foreach($arrs as $row):
                                        ?>
                                            <li class="draggable-task <?php echo $this->crud->check_li_status($row['wall_type'],$row['homework_id'],$this->session->userdata('login_user_id'));?>">
                                                <div class="todo-task">
                                                    <?php if($row['wall_type'] == 'exam'):?>
                                                        <?php 
                                                            $subject_id = $this->db->get_where('online_exam', array('online_exam_id' => $row['homework_id']))->row()->subject_id;
                                                            $class_id = $this->db->get_where('online_exam', array('online_exam_id' => $row['homework_id']))->row()->class_id;
                                                            $section_id = $this->db->get_where('online_exam', array('online_exam_id' => $row['homework_id']))->row()->section_id;
                                                            $redirect = base64_encode($class_id.'-'.$section_id.'-'.$subject_id);
                                                            $subject_name = $this->db->get_where('subject', array('subject_id' => $subject_id))->row()->name;
                                                        ?>
                                                        <span data-container="body" data-content="<i class='picons-thin-icon-thin-0021_calendar_month_day_planner'></i> <?php echo date('d/m/Y', $row['date_end']);?>. <br><i class='picons-thin-icon-thin-0025_alarm_clock_ringer_time_morning'></i> <?php echo $row['time_end'];?>.<br><a style='margin-top:10px;color:#fff' class='badge badge-primary' href='<?php echo base_url();?>student/online_exams/<?php echo $redirect;?>/' target='_blank'><?php echo getEduAppGTLang('go_to_details');?></a>" data-placement="top" data-toggle="popover" title="" data-html="true" data-original-title="<?php echo $row['title'];?>"><i class="os-icon picons-thin-icon-thin-0207_list_checkbox_todo_done" title="<?php echo getEduAppGTLang('online_exam');?>"></i>  <?php echo $row['title'];?>. (<b><?php echo $subject_name;?></b>)</span>
                                                    <?php elseif($row['wall_type'] == 'homework'):?>
                                                        <?php 
                                                            $subject_id = $this->db->get_where('homework', array('homework_id' => $row['homework_id']))->row()->subject_id;
                                                            $redirect = $this->db->get_where('homework', array('homework_id' => $row['homework_id']))->row()->homework_code;
                                                            $subject_name = $this->db->get_where('subject', array('subject_id' => $subject_id))->row()->name;
                                                        ?>
                                                        <span data-container="body" data-content="<i class='picons-thin-icon-thin-0021_calendar_month_day_planner'></i> <?php echo $row['date_end'];?>.<br><i class='picons-thin-icon-thin-0025_alarm_clock_ringer_time_morning'></i> <?php echo $row['time_end'];?>.<br><a style='margin-top:10px;color:#fff' class='badge badge-primary' href='<?php echo base_url();?>student/homeworkroom/<?php echo $redirect;?>/' target='_blank'><?php echo getEduAppGTLang('go_to_details');?></a>" data-placement="top" data-toggle="popover" title="" data-html="true" data-original-title="<?php echo $row['title'];?>"><i class="os-icon picons-thin-icon-thin-0004_pencil_ruler_drawing" title="<?php echo getEduAppGTLang('homework');?>"></i>  <?php echo $row['title'];?>. (<b><?php echo $subject_name;?></b>)</span>
                                                    <?php elseif($row['wall_type'] == 'forum'):?>
                                                        <?php 
                                                            $subject_id = $this->db->get_where('forum', array('post_id' => $row['homework_id']))->row()->subject_id;
                                                            $redirect = $this->db->get_where('forum', array('post_id' => $row['homework_id']))->row()->post_code;
                                                            $subject_name = $this->db->get_where('subject', array('subject_id' => $subject_id))->row()->name;
                                                        ?>
                                                        <span data-container="body" data-content="<i class='picons-thin-icon-thin-0021_calendar_month_day_planner'></i> <?php echo $row['time_end'];?>.<br><a style='margin-top:10px;color:#fff' class='badge badge-primary' href='<?php echo base_url();?>student/forumroom/<?php echo $redirect;?>/' target='_blank'><?php echo getEduAppGTLang('go_to_details');?></a>" data-placement="top" data-toggle="popover" title="" data-html="true" data-original-title="<?php echo $row['title'];?>"><i class="os-icon picons-thin-icon-thin-0281_chat_message_discussion_bubble_reply_conversation" title="<?php echo getEduAppGTLang('forum');?>"></i>  <?php echo $row['title'];?>. (<b><?php echo $subject_name;?></b>)</span>
                                                    <?php elseif($row['wall_type'] == 'live'):?>
                                                        <?php 
                                                            $subject_id = $this->db->get_where('live', array('live_id' => $row['homework_id']))->row()->subject_id;
                                                            $class_id = $this->db->get_where('live', array('live_id' => $row['homework_id']))->row()->class_id;
                                                            $section_id = $this->db->get_where('live', array('live_id' => $row['homework_id']))->row()->section_id;
                                                            $redirect = base64_encode($class_id.'-'.$section_id.'-'.$subject_id);
                                                            $subject_name = $this->db->get_where('subject', array('subject_id' => $subject_id))->row()->name;
                                                        ?>
                                                        <span data-container="body" data-content="<i class='picons-thin-icon-thin-0021_calendar_month_day_planner'></i> <?php echo $row['time_end'];?>.<br><i class='picons-thin-icon-thin-0025_alarm_clock_ringer_time_morning'></i> <?php echo $row['date_end'];?>.<br><a style='margin-top:10px;color:#fff' class='badge badge-primary' href='<?php echo base_url();?>student/meet/<?php echo $redirect;?>/' target='_blank'><?php echo getEduAppGTLang('go_to_details');?></a>" data-placement="top" data-toggle="popover" title="" data-html="true" data-original-title="<?php echo $row['title'];?>"><i class="os-icon picons-thin-icon-thin-0591_presentation_video_play_beamer" title="<?php echo getEduAppGTLang('live');?>"></i>  <?php echo $row['title'];?>. (<b><?php echo $subject_name;?></b>)</span>
                                                    <?php endif;?>
                                                </div> 
                                            </li>
                                        <?php endforeach;?>
                                        </ul>
                                    </div>
                                    <?php else:?>
                                    <center><i class="picons-thin-icon-thin-0044_eye_visibility_hide_invisible" style="font-size:70px;color:#dadada;"></i></center>
                                    <?php endif;?>
                                </div>
                            <?php endfor;?>
                            </div>
                        </div>
                    </div>
        		</div>
        	</div>
    	</div>
    </div>
    <script>
        $("html").on("mouseup", function (e) {
            var l = $(e.target);
            if (l[0].className.indexOf("popover") == -1) {
                $(".popover").each(function () {
                    $(this).popover("hide");
                });
            }
        });
    </script>