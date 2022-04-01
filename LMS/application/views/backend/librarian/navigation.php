    <div class="fixed-sidebar">
        <div class="fixed-sidebar-left sidebar--small" id="sidebar-left">
            <a href="<?php echo base_url();?>librarian/panel/" class="logo">
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
                        <a href="<?php echo base_url();?>librarian/panel/" data-toggle="tooltip" data-placement="right" data-original-title="<?php echo getEduAppGTLang('dashboard');?>">
                            <div class="left-menu-icon">
                                <i class="picons-thin-icon-thin-0045_home_house"></i>
                            </div>
                        </a>
                    </li>
                    <li <?php if($page_name == 'message' || $page_name == 'group'):?>class="currentItem"<?php endif;?>>
                        <a href="<?php echo base_url();?>librarian/message/" data-toggle="tooltip" data-placement="right" data-original-title="<?php echo getEduAppGTLang('messages');?>">
                            <div class="left-menu-icon">
                                <i class="picons-thin-icon-thin-0322_mail_post_box"></i>
                            </div>
                        </a>
                    </li>       
                    <li <?php if($page_name == 'news'):?>class="currentItem"<?php endif;?>>
                        <a href="<?php echo base_url();?>librarian/news/" data-toggle="tooltip" data-placement="right" data-original-title="<?php echo getEduAppGTLang('news');?>">
                            <div class="left-menu-icon">
                                <i class="os-icon picons-thin-icon-thin-0010_newspaper_reading_news"></i>
                            </div>
                        </a>
                    </li>
                    <li <?php if($page_name == 'library' || $page_name == 'book_request'):?>class="currentItem"<?php endif;?>>
                        <a href="<?php echo base_url();?>librarian/library/" data-toggle="tooltip" data-placement="right" data-original-title="<?php echo getEduAppGTLang('library');?>">
                            <div class="left-menu-icon">
                                <i class="os-icon picons-thin-icon-thin-0017_office_archive"></i>
                            </div>
                        </a>
                    </li>
                    <li <?php if($page_name == 'calendar'):?>class="currentItem"<?php endif;?>>
                        <a href="<?php echo base_url();?>librarian/calendar/" data-toggle="tooltip" data-placement="right" data-original-title="<?php echo getEduAppGTLang('calendar');?>">
                            <div class="left-menu-icon">
                                <i class="picons-thin-icon-thin-0021_calendar_month_day_planner"></i>
                            </div>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="fixed-sidebar-left sidebar--large" id="sidebar-left-1">
            <a href="<?php echo base_url();?>librarian/panel/" class="logo">
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
                        <a href="<?php echo base_url();?>librarian/panel/">
                            <div class="left-menu-icon">
                                <i class="picons-thin-icon-thin-0045_home_house"></i>
                            </div>
                            <span class="left-menu-title"><?php echo getEduAppGTLang('dashboard');?></span>
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo base_url();?>librarian/message/">
                            <div class="left-menu-icon">
                                <i class="picons-thin-icon-thin-0322_mail_post_box"></i>
                            </div>
                            <span class="left-menu-title"><?php echo getEduAppGTLang('messages');?></span>
                        </a>
                    </li>       
                    <li>
                        <a href="<?php echo base_url();?>librarian/news/">
                            <div class="left-menu-icon">
                                <i class="os-icon picons-thin-icon-thin-0010_newspaper_reading_news"></i>
                            </div>  
                            <span class="left-menu-title"><?php echo getEduAppGTLang('news');?></span>
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo base_url();?>librarian/library/">
                            <div class="left-menu-icon">
                                <i class="os-icon picons-thin-icon-thin-0017_office_archive"></i>
                            </div>
                            <span class="left-menu-title"><?php echo getEduAppGTLang('library');?></span>
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo base_url();?>librarian/calendar/">
                            <div class="left-menu-icon">
                                <i class="picons-thin-icon-thin-0021_calendar_month_day_planner"></i>
                            </div>
                            <span class="left-menu-title"><?php echo getEduAppGTLang('calendar');?></span>
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
            <a href="<?php echo base_url();?>librarian/panel/" class="logo js-sidebar-open">
                <img src="<?php echo base_url();?>public/uploads/<?php echo $this->crud->getInfo('icon_white');?>">
            </a>
        </div>
        <div class="fixed-sidebar-left sidebar--large" id="sidebar-left-1-responsive">
            <a href="<?php echo base_url();?>librarian/panel/" class="logo">
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
                        <a href="<?php echo base_url();?>librarian/panel/">
                            <div class="left-menu-icon">
                                <i class="picons-thin-icon-thin-0045_home_house"></i>
                            </div>
                            <span class="left-menu-title"><?php echo getEduAppGTLang('dashboard');?></span>
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo base_url();?>librarian/message/">
                            <div class="left-menu-icon">
                                <i class="picons-thin-icon-thin-0322_mail_post_box"></i>
                            </div>
                            <span class="left-menu-title"><?php echo getEduAppGTLang('messages');?></span>
                        </a>
                    </li>       
                    <li>
                        <a href="<?php echo base_url();?>librarian/news/">
                            <div class="left-menu-icon">
                                <i class="os-icon picons-thin-icon-thin-0010_newspaper_reading_news"></i>
                            </div>
                            <span class="left-menu-title"><?php echo getEduAppGTLang('news');?></span>
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo base_url();?>librarian/library/">
                            <div class="left-menu-icon">
                                <i class="os-icon picons-thin-icon-thin-0017_office_archive"></i>
                            </div>
                            <span class="left-menu-title"><?php echo getEduAppGTLang('library');?></span>
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo base_url();?>librarian/calendar/">
                            <div class="left-menu-icon">
                                <i class="picons-thin-icon-thin-0021_calendar_month_day_planner"></i>
                            </div>
                            <span class="left-menu-title"><?php echo getEduAppGTLang('calendar');?></span>
                        </a>
                    </li>
                    <br><br>
                    <li></li>
                </ul>
            </div>
        </div>
    </div>