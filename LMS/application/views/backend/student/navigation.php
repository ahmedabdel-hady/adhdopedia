    <div class="fixed-sidebar">
        <div class="fixed-sidebar-left sidebar--small" id="sidebar-left">
            <a href="<?php echo base_url();?>student/panel/" class="logo">
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
                        <a href="<?php echo base_url();?>student/panel/" data-toggle="tooltip" data-placement="right" data-original-title="<?php echo getEduAppGTLang('dashboard');?>">
                            <div class="left-menu-icon">
                                <i class="picons-thin-icon-thin-0045_home_house"></i>
                            </div>
                        </a>
                    </li>
                    <li <?php if($page_name == 'message' || $page_name == 'group'):?>class="currentItem"<?php endif;?>>
                        <a href="<?php echo base_url();?>student/message/" data-toggle="tooltip" data-placement="right" data-original-title="<?php echo getEduAppGTLang('messages');?>">
                            <div class="left-menu-icon">
                                <i class="picons-thin-icon-thin-0322_mail_post_box"></i>
                            </div>
                        </a>
                    </li>     
                    <li <?php if($page_name == 'teachers'):?>class="currentItem"<?php endif;?>>
                        <a href="<?php echo base_url();?>student/teachers/" data-toggle="tooltip" data-placement="right" data-original-title="<?php echo getEduAppGTLang('teachers');?>">
                            <div class="left-menu-icon">
                                <i class="picons-thin-icon-thin-0704_users_profile_group_couple_man_woman"></i>
                            </div>
                        </a>
                    </li>
                    <li <?php if($page_name == 'attendance_report' || $page_name == 'online_exam_result' || $page_name == 'study_material' || $page_name == 'live' || $page_name == 'meet' || $page_name == 'homework_edit' || $page_name == 'subject_marks' || $page_name == 'forum' || $page_name == 'forum_room' || $page_name == 'subject' || $page_name == 'subject_dashboard' || $page_name == 'homework_room' || $page_name == 'homework' || $page_name == 'online_exams'):?>class="currentItem"<?php endif;?>>
                        <a href="<?php echo base_url();?>student/subject/" data-toggle="tooltip" data-placement="right" data-original-title="<?php echo getEduAppGTLang('academic');?>">
                            <div class="left-menu-icon">
                                <i class="picons-thin-icon-thin-0680_pencil_ruller_drawing"></i>
                            </div>
                        </a>
                    </li>  
                    <li <?php if($page_name == 'my_marks'):?>class="currentItem"<?php endif;?>>
                        <a href="<?php echo base_url();?>student/my_marks/" data-toggle="tooltip" data-placement="right" data-original-title="<?php echo getEduAppGTLang('marks');?>">
                            <div class="left-menu-icon">
                                <i class="picons-thin-icon-thin-0729_student_degree_science_university_school_graduate"></i>
                            </div>
                        </a>
                    </li> 
                    <li <?php if($page_name == 'class_routine'):?>class="currentItem"<?php endif;?>>
                        <a href="<?php echo base_url();?>student/class_routine/" data-toggle="tooltip" data-placement="right" data-original-title="<?php echo getEduAppGTLang('class_routine');?>">
                            <div class="left-menu-icon">
                                <i class="picons-thin-icon-thin-0029_time_watch_clock_wall"></i>
                            </div>
                        </a>
                    </li>
                    <li <?php if($page_name == 'library'):?>class="currentItem"<?php endif;?>>
                        <a href="<?php echo base_url();?>student/library/" data-toggle="tooltip" data-placement="right" data-original-title="<?php echo getEduAppGTLang('library');?>">
                            <div class="left-menu-icon">
                                <i class="os-icon picons-thin-icon-thin-0017_office_archive"></i>
                            </div>
                        </a>
                    </li>
                    <li <?php if($page_name == 'noticeboard'):?>class="currentItem"<?php endif;?>>
                        <a href="<?php echo base_url();?>student/noticeboard/" data-toggle="tooltip" data-placement="right" data-original-title="<?php echo getEduAppGTLang('news');?>">
                            <div class="left-menu-icon">
                                <i class="os-icon picons-thin-icon-thin-0010_newspaper_reading_news"></i>
                            </div>
                        </a>
                    </li>
                    <li <?php if($page_name == 'request'):?>class="currentItem"<?php endif;?>>
                        <a href="<?php echo base_url();?>student/request/" data-toggle="tooltip" data-placement="right" data-original-title="<?php echo getEduAppGTLang('permissions');?>">
                            <div class="left-menu-icon">
                                <i class="os-icon picons-thin-icon-thin-0015_fountain_pen"></i>
                            </div>
                        </a>
                    </li>
                    <?php if($this->crud->getInfo('students_reports') == 1):?>
                    <li <?php if($page_name == 'send_report' || $page_name == 'view_report'):?>class="currentItem"<?php endif;?>>
                        <a href="<?php echo base_url();?>student/send_report/" data-toggle="tooltip" data-placement="right" data-original-title="<?php echo getEduAppGTLang('teacher_reports');?>">
                            <div class="left-menu-icon">
                                <i class="os-icon picons-thin-icon-thin-0389_gavel_hammer_law_judge_court"></i>
                            </div>
                        </a>
                    </li>
                    <?php endif;?>
                    <li <?php if($page_name == 'calendar'):?>class="currentItem"<?php endif;?>>
                        <a href="<?php echo base_url();?>student/calendar/" data-toggle="tooltip" data-placement="right" data-original-title="<?php echo getEduAppGTLang('calendar');?>">
                            <div class="left-menu-icon">
                                <i class="picons-thin-icon-thin-0021_calendar_month_day_planner"></i>
                            </div>
                        </a>
                    </li>
                    <li <?php if($page_name == 'invoice' || $page_name == 'view_invoice'):?>class="currentItem"<?php endif;?>>
                        <a href="<?php echo base_url();?>student/invoice/" data-toggle="tooltip" data-placement="right" data-original-title="<?php echo getEduAppGTLang('payments');?>">
                            <div class="left-menu-icon">
                                <i class="picons-thin-icon-thin-0426_money_payment_dollars_coins_cash"></i>
                            </div>
                        </a>
                    </li>
                </ul>
            </div>
        </div>

        <div class="fixed-sidebar-left sidebar--large" id="sidebar-left-1">
            <a href="<?php echo base_url();?>student/panel/" class="logo">
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
                        <a href="<?php echo base_url();?>student/panel/">
                            <div class="left-menu-icon">
                                <i class="picons-thin-icon-thin-0045_home_house"></i>
                            </div>
                            <span class="left-menu-title"><?php echo getEduAppGTLang('dashboard');?></span>
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo base_url();?>student/message/">
                            <div class="left-menu-icon">
                                <i class="picons-thin-icon-thin-0322_mail_post_box"></i>
                            </div>
                            <span class="left-menu-title"><?php echo getEduAppGTLang('messages');?></span>
                        </a>
                    </li>    
                    <li>
                        <a href="<?php echo base_url();?>student/teachers/" data-toggle="tooltip" data-placement="right" data-original-title="<?php echo getEduAppGTLang('teachers');?>">
                            <div class="left-menu-icon">
                                <i class="picons-thin-icon-thin-0704_users_profile_group_couple_man_woman"></i>
                            </div>
                            <span class="left-menu-title"><?php echo getEduAppGTLang('teachers');?></span>
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo base_url();?>student/subject/">
                            <div class="left-menu-icon">
                                <i class="picons-thin-icon-thin-0680_pencil_ruller_drawing"></i>
                            </div>
                            <span class="left-menu-title"><?php echo getEduAppGTLang('academic');?></span>
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo base_url();?>student/my_marks/">
                            <div class="left-menu-icon">
                                <i class="picons-thin-icon-thin-0729_student_degree_science_university_school_graduate"></i>
                            </div>
                            <span class="left-menu-title"><?php echo getEduAppGTLang('marks');?></span>
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo base_url();?>student/class_routine/">
                            <div class="left-menu-icon">
                                <i class="picons-thin-icon-thin-0029_time_watch_clock_wall"></i>
                            </div>
                            <span class="left-menu-title"><?php echo getEduAppGTLang('class_routine');?></span>
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo base_url();?>student/library/">
                            <div class="left-menu-icon">
                                <i class="os-icon picons-thin-icon-thin-0017_office_archive"></i>
                            </div>
                            <span class="left-menu-title"><?php echo getEduAppGTLang('library');?></span>
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo base_url();?>student/noticeboard/">
                            <div class="left-menu-icon">
                                <i class="os-icon picons-thin-icon-thin-0010_newspaper_reading_news"></i>
                            </div>
                            <span class="left-menu-title"><?php echo getEduAppGTLang('news');?></span>
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo base_url();?>student/request/">
                            <div class="left-menu-icon">
                                <i class="os-icon picons-thin-icon-thin-0015_fountain_pen"></i>
                            </div>
                            <span class="left-menu-title"><?php echo getEduAppGTLang('permissions');?></span>
                        </a>
                    </li>
                    <?php if($this->crud->getInfo('students_reports') == 1):?>
                    <li>
                        <a href="<?php echo base_url();?>student/send_report/">
                            <div class="left-menu-icon">
                                <i class="os-icon picons-thin-icon-thin-0389_gavel_hammer_law_judge_court"></i>
                            </div>
                            <span class="left-menu-title"><?php echo getEduAppGTLang('teacher_reports');?></span>
                        </a>
                    </li>
                    <?php endif;?>
                    <li>
                        <a href="<?php echo base_url();?>student/calendar/">
                            <div class="left-menu-icon">
                                <i class="picons-thin-icon-thin-0021_calendar_month_day_planner"></i>
                            </div>
                            <span class="left-menu-title"><?php echo getEduAppGTLang('calendar');?></span>
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo base_url();?>student/invoice/">
                            <div class="left-menu-icon">
                                <i class="picons-thin-icon-thin-0426_money_payment_dollars_coins_cash"></i>
                            </div>
                            <span class="left-menu-title"><?php echo getEduAppGTLang('payments');?></span>
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
            <a href="<?php echo base_url();?>student/panel/" class="logo js-sidebar-open">
                <img src="<?php echo base_url();?>public/uploads/<?php echo $this->crud->getInfo('icon_white');?>">
            </a>
        </div>
        <div class="fixed-sidebar-left sidebar--large" id="sidebar-left-1-responsive">
            <a href="<?php echo base_url();?>student/panel/" class="logo">
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
                        <a href="<?php echo base_url();?>student/panel/">
                            <div class="left-menu-icon">
                                <i class="picons-thin-icon-thin-0045_home_house"></i>
                            </div>
                            <span class="left-menu-title"><?php echo getEduAppGTLang('dashboard');?></span>
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo base_url();?>student/message/">
                            <div class="left-menu-icon">
                                <i class="picons-thin-icon-thin-0322_mail_post_box"></i>
                            </div>
                            <span class="left-menu-title"><?php echo getEduAppGTLang('messages');?></span>
                        </a>
                    </li> 
                    <li>
                        <a href="<?php echo base_url();?>student/teachers/" data-toggle="tooltip" data-placement="right" data-original-title="<?php echo getEduAppGTLang('teachers');?>">
                            <div class="left-menu-icon">
                                <i class="picons-thin-icon-thin-0704_users_profile_group_couple_man_woman"></i>
                            </div>
                            <span class="left-menu-title"><?php echo getEduAppGTLang('teachers');?></span>
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo base_url();?>student/subject/">
                            <div class="left-menu-icon">
                                <i class="picons-thin-icon-thin-0680_pencil_ruller_drawing"></i>
                            </div>
                            <span class="left-menu-title"><?php echo getEduAppGTLang('academic');?></span>
                        </a>
                    </li>  
                    <li>
                        <a href="<?php echo base_url();?>student/my_marks/">
                            <div class="left-menu-icon">
                                <i class="picons-thin-icon-thin-0729_student_degree_science_university_school_graduate"></i>
                            </div>
                            <span class="left-menu-title"><?php echo getEduAppGTLang('marks');?></span>
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo base_url();?>student/class_routine/">
                            <div class="left-menu-icon">
                                <i class="picons-thin-icon-thin-0029_time_watch_clock_wall"></i>
                            </div>
                            <span class="left-menu-title"><?php echo getEduAppGTLang('class_routine');?></span>
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo base_url();?>student/library/">
                            <div class="left-menu-icon">
                                <i class="picons-thin-icon-thin-0017_office_archive"></i>
                            </div>
                            <span class="left-menu-title"><?php echo getEduAppGTLang('library');?></span>
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo base_url();?>student/noticeboard/">
                            <div class="left-menu-icon">
                                <i class="picons-thin-icon-thin-0010_newspaper_reading_news"></i>
                            </div>
                            <span class="left-menu-title"><?php echo getEduAppGTLang('news');?></span>
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo base_url();?>student/request/">
                            <div class="left-menu-icon">
                                <i class="picons-thin-icon-thin-0015_fountain_pen"></i>
                            </div>
                            <span class="left-menu-title"><?php echo getEduAppGTLang('permissions');?></span>
                        </a>
                    </li>
                    <?php if($this->crud->getInfo('students_reports') == 1):?>
                    <li>
                        <a href="<?php echo base_url();?>student/send_report/">
                            <div class="left-menu-icon">
                                <i class="os-icon picons-thin-icon-thin-0389_gavel_hammer_law_judge_court"></i>
                            </div>
                            <span class="left-menu-title"><?php echo getEduAppGTLang('teacher_reports');?></span>
                        </a>
                    </li>
                    <?php endif;?>
                    <li>
                        <a href="<?php echo base_url();?>student/calendar/">
                            <div class="left-menu-icon">
                                <i class="picons-thin-icon-thin-0021_calendar_month_day_planner"></i>
                            </div>
                            <span class="left-menu-title"><?php echo getEduAppGTLang('calendar');?></span>
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo base_url();?>student/invoice/">
                            <div class="left-menu-icon">
                                <i class="picons-thin-icon-thin-0426_money_payment_dollars_coins_cash"></i>
                            </div>
                            <span class="left-menu-title"><?php echo getEduAppGTLang('payments');?></span>
                        </a>
                    </li><br><br>
                    <li></li>
                </ul>
            </div>
        </div>
    </div>