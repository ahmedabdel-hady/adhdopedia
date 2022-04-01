    <div class="fixed-sidebar">
        <div class="fixed-sidebar-left sidebar--small" id="sidebar-left">
            <a href="<?php echo base_url();?>teacher/panel/" class="logo">
                <div class="img-wrap">
                    <img src="<?php echo base_url();?>public/uploads/<?php echo $this->crud->getInfo('icon_white');?>">
                </div>
            </a>
            <div class="mCustomScrollbar" data-mcs-theme="dark">
                <ul class="left-menu">
                    <li>
                        <a href="#" class="js-sidebar-open">
                            <i class="left-menu-icon picons-thin-icon-thin-0069a_menu_hambuger"></i>
                        </a>
                    </li>
                    <li <?php if($page_name == 'panel'):?>class="currentItem"<?php endif;?>>
                        <a href="<?php echo base_url();?>teacher/panel/" data-toggle="tooltip" data-placement="right" data-original-title="<?php echo getEduAppGTLang('dashboard');?>">
                            <div class="left-menu-icon">
                                <i class="picons-thin-icon-thin-0045_home_house"></i>
                            </div>
                        </a>
                    </li>
                    <li <?php if($page_name == 'message' || $page_name == 'group'):?>class="currentItem"<?php endif;?>>
                        <a href="<?php echo base_url();?>teacher/message/" data-toggle="tooltip" data-placement="right" data-original-title="<?php echo getEduAppGTLang('messages');?>">
                            <div class="left-menu-icon">
                                <i class="picons-thin-icon-thin-0322_mail_post_box"></i>
                            </div>
                        </a>
                    </li>       
                    <li <?php if($page_name == 'teachers'):?>class="currentItem"<?php endif;?>>
                        <a href="<?php echo base_url();?>teacher/teacher_list/" data-toggle="tooltip" data-placement="right" data-original-title="<?php echo getEduAppGTLang('teachers');?>">
                            <div class="left-menu-icon">        
                                <i class="picons-thin-icon-thin-0704_users_profile_group_couple_man_woman"></i>
                            </div>
                        </a>
                    </li>
                    <li <?php if($page_name == 'students_area' || $page_name == 'view_marks' || $page_name == 'subject_marks'):?>class="currentItem"<?php endif;?>>
                        <a href="<?php echo base_url();?>teacher/students_area/" data-toggle="tooltip" data-placement="right" data-original-title="<?php echo getEduAppGTLang('students');?>">
                            <div class="left-menu-icon">
                                <i class="picons-thin-icon-thin-0729_student_degree_science_university_school_graduate"></i>
                            </div>
                        </a>
                    </li>
                    <li <?php if($page_name == 'my_routine'):?>class="currentItem"<?php endif;?>>
                        <a href="<?php echo base_url();?>teacher/my_routine/" data-toggle="tooltip" data-placement="right" data-original-title="<?php echo getEduAppGTLang('class_routine');?>">
                            <div class="left-menu-icon">
                                <i class="picons-thin-icon-thin-0029_time_watch_clock_wall"></i>
                            </div>
                        </a>
                    </li>
                    <li <?php if($page_name == 'single_homework' || $page_name == 'forum' || $page_name == 'meet' || $page_name == 'study_material' || $page_name == 'upload_marks' || $page_name == 'edit_forum' || $page_name == 'forum_room' || $page_name == 'grados' || $page_name == 'homework_details' || $page_name == 'homework_edit' || $page_name == 'homework_room' || $page_name == 'homework' || $page_name == 'cursos' || $page_name == 'exam_edit' || $page_name == 'subject_dashboard' || $page_name == 'online_exams' || $page_name == 'exam_room' || $page_name == 'exam_results'):?>class="currentItem"<?php endif;?>>
                        <a href="<?php echo base_url();?>teacher/grados/" data-toggle="tooltip" data-placement="right" data-original-title="<?php echo getEduAppGTLang('academic');?>">
                            <div class="left-menu-icon">
                                <i class="picons-thin-icon-thin-0680_pencil_ruller_drawing"></i>
                            </div>
                        </a>
                    </li>       
                    <li <?php if($page_name == 'student_report' || $page_name == 'view_report'):?>class="currentItem"<?php endif;?>>
                        <a href="<?php echo base_url();?>teacher/student_report/" data-toggle="tooltip" data-placement="right" data-original-title="<?php echo getEduAppGTLang('behavior');?>">
                            <div class="left-menu-icon">
                                <i class="picons-thin-icon-thin-0389_gavel_hammer_law_judge_court"></i>
                            </div>
                        </a>
                    </li>
                    <li <?php if($page_name == 'news'):?>class="currentItem"<?php endif;?>>
                        <a href="<?php echo base_url();?>teacher/news/" data-toggle="tooltip" data-placement="right" data-original-title="<?php echo getEduAppGTLang('news');?>">
                            <div class="left-menu-icon">
                                <i class="os-icon picons-thin-icon-thin-0010_newspaper_reading_news"></i>
                            </div>
                        </a>
                    </li>
                    <li <?php if($page_name == 'library'):?>class="currentItem"<?php endif;?>>
                        <a href="<?php echo base_url();?>teacher/library/" data-toggle="tooltip" data-placement="right" data-original-title="<?php echo getEduAppGTLang('library');?>">
                            <div class="left-menu-icon">
                                <i class="os-icon picons-thin-icon-thin-0017_office_archive"></i>
                            </div>
                        </a>
                    </li>
                    <li <?php if($page_name == 'request'):?>class="currentItem"<?php endif;?>>
                        <a href="<?php echo base_url();?>teacher/request/" data-toggle="tooltip" data-placement="right" data-original-title="<?php echo getEduAppGTLang('permissions');?>">
                            <div class="left-menu-icon">
                                <i class="os-icon os-icon picons-thin-icon-thin-0015_fountain_pen"></i>
                            </div>
                        </a>
                    </li>
                    <li <?php if($page_name == 'calendar'):?>class="currentItem"<?php endif;?>>
                        <a href="<?php echo base_url();?>teacher/calendar/" data-toggle="tooltip" data-placement="right" data-original-title="<?php echo getEduAppGTLang('calendar');?>">
                            <div class="left-menu-icon">
                                <i class="picons-thin-icon-thin-0021_calendar_month_day_planner"></i>
                            </div>
                        </a>
                    </li>
                    <li <?php if($page_name == 'notify'):?>class="currentItem"<?php endif;?>>
                        <a href="<?php echo base_url();?>teacher/notify/" data-toggle="tooltip" data-placement="right" data-original-title="<?php echo getEduAppGTLang('notifications');?>">
                            <div class="left-menu-icon">
                                <i class="picons-thin-icon-thin-0286_mobile_message_sms"></i>
                            </div>
                        </a>
                    </li>
                </ul>
            </div>
        </div>

        <div class="fixed-sidebar-left sidebar--large" id="sidebar-left-1">
            <a href="<?php echo base_url();?>teacher/panel/" class="logo">
                <div class="img-wrap">
                    <img src="<?php echo base_url();?>public/uploads/<?php echo $this->crud->getInfo('icon_white');?>">
                </div>
                <div class="title-block">
                    <h6 class="logo-title"><?php echo $this->crud->getInfo('system_name');?></h6>
                </div>
            </a>
            <div class="mCustomScrollbar" data-mcs-theme="dark">
                <ul class="left-menu">
                    <li>
                        <a href="#" class="js-sidebar-open">
                            <i class="left-menu-icon picons-thin-icon-thin-0069a_menu_hambuger"></i>
                            <span class="left-menu-title"><?php echo getEduAppGTLang('minimize_menu');?></span>
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo base_url();?>teacher/panel/">
                            <div class="left-menu-icon">
                                <i class="picons-thin-icon-thin-0045_home_house"></i>
                            </div>
                            <span class="left-menu-title"><?php echo getEduAppGTLang('dashboard');?></span>
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo base_url();?>teacher/message/">
                            <div class="left-menu-icon">
                                <i class="picons-thin-icon-thin-0322_mail_post_box"></i>
                            </div>
                            <span class="left-menu-title"><?php echo getEduAppGTLang('messages');?></span>
                        </a>
                    </li>       
                    <li>
                        <a href="<?php echo base_url();?>teacher/teacher_list/">
                            <div class="left-menu-icon">        
                                <i class="picons-thin-icon-thin-0704_users_profile_group_couple_man_woman"></i>
                            </div>
                            <span class="left-menu-title"><?php echo getEduAppGTLang('teachers');?></span>
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo base_url();?>teacher/students_area/">
                            <div class="left-menu-icon">
                                <i class="picons-thin-icon-thin-0729_student_degree_science_university_school_graduate"></i>
                            </div>
                            <span class="left-menu-title"><?php echo getEduAppGTLang('students');?></span>
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo base_url();?>teacher/my_routine/">
                            <div class="left-menu-icon">
                                <i class="picons-thin-icon-thin-0029_time_watch_clock_wall"></i>
                            </div>
                            <span class="left-menu-title"><?php echo getEduAppGTLang('class_routine');?></span>
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo base_url();?>teacher/grados/">
                            <div class="left-menu-icon">
                                <i class="picons-thin-icon-thin-0680_pencil_ruller_drawing"></i>
                            </div>
                            <span class="left-menu-title"><?php echo getEduAppGTLang('academic');?></span>
                        </a>
                    </li>       
                    <li>
                        <a href="<?php echo base_url();?>teacher/student_report/">
                            <div class="left-menu-icon">
                                <i class="picons-thin-icon-thin-0389_gavel_hammer_law_judge_court"></i>
                            </div>
                            <span class="left-menu-title"><?php echo getEduAppGTLang('behavior');?></span>
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo base_url();?>teacher/news/">
                            <div class="left-menu-icon">
                                <i class="os-icon picons-thin-icon-thin-0010_newspaper_reading_news"></i>
                            </div>
                            <span class="left-menu-title"><?php echo getEduAppGTLang('news');?></span>
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo base_url();?>teacher/library/">
                            <div class="left-menu-icon">
                                <i class="os-icon picons-thin-icon-thin-0017_office_archive"></i>
                            </div>
                            <span class="left-menu-title"><?php echo getEduAppGTLang('library');?></span>
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo base_url();?>teacher/request/">
                            <div class="left-menu-icon">
                                <i class="os-icon os-icon picons-thin-icon-thin-0015_fountain_pen"></i>
                            </div>
                            <span class="left-menu-title"><?php echo getEduAppGTLang('permissions');?></span>
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo base_url();?>teacher/calendar/">
                            <div class="left-menu-icon">
                                <i class="picons-thin-icon-thin-0021_calendar_month_day_planner"></i>
                            </div>
                            <span class="left-menu-title"><?php echo getEduAppGTLang('calendar');?></span>
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo base_url();?>teacher/notify/">
                            <div class="left-menu-icon">
                                <i class="picons-thin-icon-thin-0286_mobile_message_sms"></i>
                            </div>
                            <span class="left-menu-title"><?php echo getEduAppGTLang('notifications');?></span>
                        </a>
                    </li>
                    <br><br>
                    <li></li>
                </ul>
            </div>
        </div>
    </div>

    <div class="fixed-sidebar fixed-sidebar-responsive">
        <div class="fixed-sidebar-left sidebar--small" id="sidebar-left-responsive">
            <a href="<?php echo base_url();?>teacher/panel/" class="logo js-sidebar-open">
                <img src="<?php echo base_url();?>public/uploads/<?php echo $this->crud->getInfo('icon_white');?>">
            </a>
        </div>
        <div class="fixed-sidebar-left sidebar--large" id="sidebar-left-1-responsive">
            <a href="<?php echo base_url();?>teacher/panel/" class="logo">
                <div class="img-wrap">
                    <img src="<?php echo base_url();?>public/uploads/<?php echo $this->crud->getInfo('icon_white');?>">
                </div>
                <div class="title-block">
                    <h6 class="logo-title"><?php echo $this->crud->getInfo('system_name');?></h6>
                </div>
            </a>
            <div class="mCustomScrollbar" data-mcs-theme="dark">
                <ul class="left-menu">
                    <li>
                        <a href="#" class="js-sidebar-open">
                            <i class="left-menu-icon picons-thin-icon-thin-0069a_menu_hambuger"></i>
                            <span class="left-menu-title"><?php echo getEduAppGTLang('minimize_menu');?></span>
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo base_url();?>teacher/panel/">
                            <div class="left-menu-icon">
                                <i class="picons-thin-icon-thin-0045_home_house"></i>
                            </div>
                            <span class="left-menu-title"><?php echo getEduAppGTLang('dashboard');?></span>
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo base_url();?>teacher/message/">
                            <div class="left-menu-icon">
                                <i class="picons-thin-icon-thin-0322_mail_post_box"></i>
                            </div>
                            <span class="left-menu-title"><?php echo getEduAppGTLang('messages');?></span>
                        </a>
                    </li>       
                    <li>
                        <a href="<?php echo base_url();?>teacher/teacher_list/">
                            <div class="left-menu-icon">        
                                <i class="picons-thin-icon-thin-0704_users_profile_group_couple_man_woman"></i>
                            </div>
                            <span class="left-menu-title"><?php echo getEduAppGTLang('teachers');?></span>
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo base_url();?>teacher/students_area/">
                            <div class="left-menu-icon">
                                <i class="picons-thin-icon-thin-0729_student_degree_science_university_school_graduate"></i>
                            </div>
                            <span class="left-menu-title"><?php echo getEduAppGTLang('students');?></span>
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo base_url();?>teacher/my_routine/">
                            <div class="left-menu-icon">
                                <i class="picons-thin-icon-thin-0029_time_watch_clock_wall"></i>
                            </div>
                            <span class="left-menu-title"><?php echo getEduAppGTLang('class_routine');?></span>
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo base_url();?>teacher/grados/">
                            <div class="left-menu-icon">
                                <i class="picons-thin-icon-thin-0680_pencil_ruller_drawing"></i>
                            </div>
                            <span class="left-menu-title"><?php echo getEduAppGTLang('academic');?></span>
                        </a>
                    </li>       
                    <li>
                        <a href="<?php echo base_url();?>teacher/student_report/">
                            <div class="left-menu-icon">
                                <i class="picons-thin-icon-thin-0389_gavel_hammer_law_judge_court"></i>
                            </div>
                            <span class="left-menu-title"><?php echo getEduAppGTLang('behavior');?></span>
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo base_url();?>teacher/news/">
                            <div class="left-menu-icon">
                                <i class="os-icon picons-thin-icon-thin-0010_newspaper_reading_news"></i>
                            </div>
                            <span class="left-menu-title"><?php echo getEduAppGTLang('news');?></span>
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo base_url();?>teacher/library/">
                            <div class="left-menu-icon">
                                <i class="os-icon picons-thin-icon-thin-0017_office_archive"></i>
                            </div>
                            <span class="left-menu-title"><?php echo getEduAppGTLang('library');?></span>
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo base_url();?>teacher/request/">
                            <div class="left-menu-icon">
                                <i class="os-icon os-icon picons-thin-icon-thin-0015_fountain_pen"></i>
                            </div>
                            <span class="left-menu-title"><?php echo getEduAppGTLang('permissions');?></span>
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo base_url();?>teacher/calendar/">
                            <div class="left-menu-icon">
                                <i class="picons-thin-icon-thin-0021_calendar_month_day_planner"></i>
                            </div>
                            <span class="left-menu-title"><?php echo getEduAppGTLang('calendar');?></span>
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo base_url();?>teacher/notify/">
                            <div class="left-menu-icon">
                                <i class="picons-thin-icon-thin-0286_mobile_message_sms"></i>
                            </div>
                            <span class="left-menu-title"><?php echo getEduAppGTLang('notifications');?></span>
                        </a>
                    </li><br><br>
                    <li></li>
                </ul>
            </div>
        </div>
    </div>