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
                    <h3 class="cta-header"><?php echo $row['name'];?> - <small><?php echo getEduAppGTLang('dashboard');?></small></h3>
                    <small style="font-size:0.90rem; color:#fff;"><?php echo $this->db->get_where('class', array('class_id' => $ex[0]))->row()->name;?> "<?php echo $this->db->get_where('section', array('section_id' => $ex[1]))->row()->name;?>"</small>
                </div>
            </div> 
            <div class="os-tabs-w menu-shad">
                <div class="os-tabs-controls">
                    <ul class="navs navs-tabs upper">
                        <li class="navs-item">
                            <a class="navs-links active" href="<?php echo base_url();?>student/subject_dashboard/<?php echo $data;?>/"><i class="os-icon picons-thin-icon-thin-0482_gauge_dashboard_empty"></i><span><?php echo getEduAppGTLang('dashboard');?></span></a>
                        </li>
                        <li class="navs-item">
                            <a class="navs-links" href="<?php echo base_url();?>student/online_exams/<?php echo $data;?>/"><i class="os-icon picons-thin-icon-thin-0207_list_checkbox_todo_done"></i><span><?php echo getEduAppGTLang('online_exams');?></span></a>
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
                        <main class="col col-xl-6 order-xl-2 col-lg-12 order-lg-1 col-md-12 col-sm-12 col-12">
                            <div id="newsfeed-items-grid">     
                            <?php 
                                $db = $this->db->query("SELECT homework_id, wall_type,publish_date FROM homework WHERE class_id = $ex[0] AND subject_id = $ex[2] AND section_id = $ex[1] UNION SELECT document_id,wall_type,publish_date FROM document WHERE class_id = $ex[0] AND subject_id = $ex[2] AND section_id = $ex[1] UNION SELECT online_exam_id,wall_type,publish_date FROM online_exam WHERE class_id = $ex[0] AND subject_id = $ex[2] AND section_id = $ex[1] UNION SELECT post_id,wall_type,publish_date FROM forum WHERE class_id = $ex[0] AND subject_id = $ex[2] AND section_id = $ex[1] ORDER BY publish_date DESC LIMIT 10");
                                if($db->num_rows() > 0):
                                foreach($db->result_array() as $wall):
                            ?>           
                            <?php if($wall['wall_type'] == 'homework' && $this->db->get_where('homework', array('homework_id' => $wall['homework_id']))->row()->status == 1):?>
                            <?php $this->academic->setRead($wall['homework_id'],'homework',$ex[2]);?>
                                <div class="ui-block">
                                    <article class="hentry post thumb-full-width">                
                                        <div class="post__author author vcard inline-items">
                                            <img src="<?php echo $this->crud->get_image_url($this->db->get_where('homework', array('homework_id' => $wall['homework_id']))->row()->uploader_type, $this->db->get_where('homework', array('homework_id' => $wall['homework_id']))->row()->uploader_id);?>">                
                                            <div class="author-date">
                                                <a class="h6 post__author-name fn" href="javascript:void(0);"><?php echo $this->crud->get_name($this->db->get_where('homework', array('homework_id' => $wall['homework_id']))->row()->uploader_type, $this->db->get_where('homework', array('homework_id' => $wall['homework_id']))->row()->uploader_id);?></a>
                                                <div class="post__date">
                                                    <time class="published"><?php echo $this->db->get_where('homework', array('homework_id' => $wall['homework_id']))->row()->upload_date;?></time>
                                                </div>
                                            </div>                
                                        </div>                
                                        <div class="edu-posts cta-with-media verde">
                                            <div class="cta-content">
                                                <div class="highlight-header morado"><?php echo $row['name'];?></div>            
                                                <div class="grado">
                                                    <?php echo $this->db->get_where('class', array('class_id' => $ex[0]))->row()->name;?> "<?php echo $this->db->get_where('section', array('section_id' => $ex[1]))->row()->name;?>"
                                                </div>
                                                <h3 class="cta-header"><?php echo $this->db->get_where('homework', array('homework_id' => $wall['homework_id']))->row()->title;?></h3>           
                                                <div class="descripcion">
                                                    <?php echo strip_tags($this->db->get_where('homework', array('homework_id' => $wall['homework_id']))->row()->description);?>
                                                </div>
                                                <?php if($this->db->get_where('homework', array('homework_id' => $wall['homework_id']))->row()->file_name != ""):?>
                                                <div class="table-responsive">
                                                    <table class="table table-down">
                                                        <tbody>
                                                            <tr style="background:#a11a7a">
                                                                <td class="text-left cell-with-media" >
                                                                    <a href="<?php echo base_url().'public/uploads/homework/' . $this->db->get_where('homework', array('homework_id' => $wall['homework_id']))->row()->file_name;?>"><i class="picons-thin-icon-thin-0111_folder_files_documents" style="font-size:16px; color:#fff;"></i> <span><?php echo $this->db->get_where('homework', array('homework_id' => $wall['homework_id']))->row()->file_name;?></span><span class="smaller">(<?php echo $this->db->get_where('homework', array('homework_id' => $wall['homework_id']))->row()->filesize;?>)</span></a>
                                                                </td>             
                                                                <td class="text-center bolder">
                                                                    <a href="<?php echo base_url().'public/uploads/homework/' . $this->db->get_where('homework', array('homework_id' => $wall['homework_id']))->row()->file_name;?>"> <span><i class="picons-thin-icon-thin-0121_download_file"></i></span> </a>
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                                <?php endif;?>
                                                <div class="deadtime">
                                                    <span><?php echo getEduAppGTLang('date');?>:</span><i class="picons-thin-icon-thin-0027_stopwatch_timer_running_time"></i><?php echo $this->db->get_where('homework', array('homework_id' => $wall['homework_id']))->row()->date_end;?> @ <?php echo $this->db->get_where('homework', array('homework_id' => $wall['homework_id']))->row()->time_end;?>
                                                </div>
                                                <a href="<?php echo base_url();?>student/homeworkroom/<?php echo $this->db->get_where('homework', array('homework_id' => $wall['homework_id']))->row()->homework_code;?>/"><button class="btn btn-rounded btn-posts"><i class="picons-thin-icon-thin-0100_to_do_list_reminder_done"></i> <?php echo getEduAppGTLang('view_homework');?></button></a>
                                            </div>
                                        </div>
                                        <div class="control-block-button post-control-button">
                                            <a href="javascript:void(0);" class="btn btn-control featured-post" style="background-color: #99bf2d; color: #fff;" data-toggle="tooltip" data-placement="top" data-original-title="<?php echo getEduAppGTLang('homework');?>">
                                                <i class="picons-thin-icon-thin-0004_pencil_ruler_drawing"></i>
                                            </a>
                                        </div>     
                                        <br><br><br>
                                    </article>
                                </div>
                                <?php endif;?>
                                <?php if($wall['wall_type'] == 'exam' && $this->db->get_where('online_exam', array('online_exam_id' => $wall['homework_id']))->row()->status != 'pending'):?>
                                <?php $this->academic->setRead($wall['homework_id'],'exam',$ex[2]);?>
                                <div class="ui-block">
                                    <article class="hentry post thumb-full-width">                
                                        <div class="post__author author vcard inline-items">
                                            <img src="<?php echo $this->crud->get_image_url($this->db->get_where('online_exam', array('online_exam_id' => $wall['homework_id']))->row()->uploader_type, $this->db->get_where('online_exam', array('online_exam_id' => $wall['homework_id']))->row()->uploader_id);?>">                
                                            <div class="author-date">
                                                <a class="h6 post__author-name fn" href="javascript:void(0);"><?php echo $this->crud->get_name($this->db->get_where('online_exam', array('online_exam_id' => $wall['homework_id']))->row()->uploader_type, $this->db->get_where('online_exam', array('online_exam_id' => $wall['homework_id']))->row()->uploader_id);?></a>
                                                <div class="post__date">
                                                    <time class="published"><?php echo $this->db->get_where('online_exam', array('online_exam_id' => $wall['homework_id']))->row()->upload_date;?></time>
                                                </div>
                                            </div>                
                                        </div>                
                                        <div class="edu-posts cta-with-media verde">
                                            <div class="cta-content">
                                                <div class="highlight-header celeste">
                                                    <?php echo $row['name'];?>
                                                </div>            
                                                <div class="grado">
                                                    <?php echo $this->db->get_where('class', array('class_id' => $ex[0]))->row()->name;?> "<?php echo $this->db->get_where('section', array('section_id' => $ex[1]))->row()->name;?>"
                                                </div>
                                                <h3 class="cta-header"><?php echo $this->db->get_where('online_exam', array('online_exam_id' => $wall['homework_id']))->row()->title;?></h3>           
                                                <div class="descripcion"> 
                                                    <?php echo strip_tags($this->db->get_where('online_exam', array('online_exam_id' => $wall['homework_id']))->row()->instruction);?>
                                                </div>
                                                <div class="deadtime">
                                                    <span><?php echo getEduAppGTLang('date');?>:</span><i class="picons-thin-icon-thin-0027_stopwatch_timer_running_time"></i><?php echo date('M d, Y', $this->db->get_where('online_exam', array('online_exam_id' => $wall['homework_id']))->row()->exam_date);?>
                                                </div>
                                                <div class="deadtime">
                                                    <span><?php echo getEduAppGTLang('hour');?>:</span><i class="picons-thin-icon-thin-0027_stopwatch_timer_running_time"></i><?php echo $this->db->get_where('online_exam', array('online_exam_id' => $wall['homework_id']))->row()->time_start. " - ".$this->db->get_where('online_exam', array('online_exam_id' => $wall['homework_id']))->row()->time_end;?>
                                                </div>
                                                <div class="deadtime">
                                                    <span><?php echo getEduAppGTLang('duration');?>:</span><i class="picons-thin-icon-thin-0026_time_watch_clock"></i><?php $minutes = number_format($this->db->get_where('online_exam', array('online_exam_id' => $wall['homework_id']))->row()->duration/60,0); echo $minutes;?> mins.
                                                </div>
                                                <a href="<?php echo base_url();?>student/online_exams/<?php echo $data;?>/"><button class="btn btn-rounded btn-posts verde"><i class="picons-thin-icon-thin-0014_notebook_paper_todo"></i> <?php echo getEduAppGTLang('go_to_exams');?></button></a>
                                            </div>
                                        </div>              
                                        <div class="control-block-button post-control-button">                
                                            <a href="javascript:void(0);" class="btn btn-control" style="background-color: #a01a7a; color: #fff;" data-toggle="tooltip" data-placement="top" data-original-title="<?php echo getEduAppGTLang('online_exams');?>">
                                                <i class="picons-thin-icon-thin-0207_list_checkbox_todo_done"></i>
                                            </a>                
                                        </div>    
                                        <br><br><br>
                                    </article>
                                </div>
                            <?php endif;?>
                            <?php if($wall['wall_type'] == 'material'):?>
                                <?php $this->academic->setRead($wall['homework_id'],'material',$ex[2]);?>
                                <div class="ui-block">                    
                                    <article class="hentry post thumb-full-width">
                                        <div class="post__author author vcard inline-items">
                                            <img src="<?php echo $this->crud->get_image_url($this->db->get_where('document', array('document_id' => $wall['homework_id']))->row()->type, $this->db->get_where('document', array('document_id' => $wall['homework_id']))->row()->teacher_id);?>">                
                                            <div class="author-date">
                                                <a class="h6 post__author-name fn" href="javascript:void(0);"><?php echo $this->crud->get_name($this->db->get_where('document', array('document_id' => $wall['homework_id']))->row()->type, $this->db->get_where('document', array('document_id' => $wall['homework_id']))->row()->teacher_id);?></a>
                                                <div class="post__date">
                                                    <time class="published"><?php echo $this->db->get_where('document', array('document_id' => $wall['homework_id']))->row()->upload_date;?></time>
                                                </div>
                                            </div>                
                                        </div>                
                                        <div class="edu-posts cta-with-media verde">
                                            <div class="cta-content">
                                                <div class="highlight-header morado">
                                                    <?php echo $row['name'];?>
                                                </div>            
                                                <div class="grado">
                                                    <?php echo $this->db->get_where('class', array('class_id' => $ex[0]))->row()->name;?> "<?php echo $this->db->get_where('section', array('section_id' => $ex[1]))->row()->name;?>"
                                                </div>
                                                <h3 class="cta-header"><?php echo getEduAppGTLang('study_material');?></h3>   
                                                <div class="descripcion">
                                                    <?php echo strip_tags($this->db->get_where('document', array('document_id' => $wall['homework_id']))->row()->description);?>
                                                </div>    
                                                <div class="table-responsive">
                                                    <table class="table table-down">
                                                        <tbody>
                                                            <tr style="background:#a11a7a">
                                                                <td class="text-left cell-with-media" >
                                                                    <a href="<?php echo base_url().'public/uploads/document/'.$this->db->get_where('document', array('document_id' => $wall['homework_id']))->row()->file_name; ?>"><i class="picons-thin-icon-thin-0111_folder_files_documents" style="font-size:16px; color:#fff;"></i> <span><?php echo $this->db->get_where('document', array('document_id' => $wall['homework_id']))->row()->file_name;?></span><span class="smaller">(<?php echo $this->db->get_where('document', array('document_id' => $wall['homework_id']))->row()->filesize;?>)</span></a>
                                                                </td>             
                                                                <td class="text-center bolder">
                                                                    <a href="<?php echo base_url().'public/uploads/document/'.$this->db->get_where('document', array('document_id' => $wall['homework_id']))->row()->file_name; ?>"> <span><i class="picons-thin-icon-thin-0121_download_file"></i></span> </a>
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>  
                                            </div>
                                        </div>
                                        <div class="control-block-button post-control-button">                
                                            <a href="javascript:void(0);" class="btn btn-control" style="background-color: #00579c; color: #fff;" data-toggle="tooltip" data-placement="top" data-original-title="<?php echo getEduAppGTLang('study_material');?>">
                                                <i class="picons-thin-icon-thin-0003_write_pencil_new_edit"></i>
                                            </a>                
                                        </div>   
                                        <br><br><br>
                                    </article>
                                </div>        
                            <?php endif;?>
                            <?php if($wall['wall_type'] == 'forum' && $this->db->get_where('forum', array('post_id' => $wall['homework_id']))->row()->post_status == 1):?>
                            <?php $this->academic->setRead($wall['homework_id'],'forum',$ex[2]);?>
                                <div class="ui-block">
                                    <article class="hentry post thumb-full-width">                
                                        <div class="post__author author vcard inline-items">
                                            <img src="<?php echo $this->crud->get_image_url($this->db->get_where('forum', array('post_id' => $wall['homework_id']))->row()->type, $this->db->get_where('forum', array('post_id' => $wall['homework_id']))->row()->teacher_id);?>">                
                                            <div class="author-date">
                                                <a class="h6 post__author-name fn" href="javascript:void(0);"><?php echo $this->crud->get_name($this->db->get_where('forum', array('post_id' => $wall['homework_id']))->row()->type, $this->db->get_where('forum', array('post_id' => $wall['homework_id']))->row()->teacher_id);?></a>
                                                <div class="post__date">
                                                    <time class="published"><?php echo $this->db->get_where('forum', array('post_id' => $wall['homework_id']))->row()->upload_date;?></time>
                                                </div>
                                            </div>                
                                        </div>                
                                        <div class="edu-posts cta-with-media verde">
                                            <div class="cta-content">
                                                <div class="highlight-header yellow">
                                                    <?php echo $row['name'];?>
                                                </div>            
                                                <div class="grado">
                                                    <?php echo $this->db->get_where('class', array('class_id' => $ex[0]))->row()->name;?> "<?php echo $this->db->get_where('section', array('section_id' => $ex[1]))->row()->name;?>"
                                                </div>
                                                <h3 class="cta-header"><?php echo $this->db->get_where('forum', array('post_id' => $wall['homework_id']))->row()->title;?></h3>           
                                                <div class="descripcion">
                                                    <?php echo strip_tags($this->db->get_where('forum', array('post_id' => $wall['homework_id']))->row()->description);?>
                                                </div>
                                                <a href="<?php echo base_url();?>student/forumroom/<?php echo $this->db->get_where('forum', array('post_id' => $wall['homework_id']))->row()->post_code;?>/"><button class="btn btn-rounded btn-posts"><i class="picons-thin-icon-thin-0014_notebook_paper_todo"></i> <?php echo getEduAppGTLang('view_forum');?></button></a>
                                            </div>
                                        </div>              
                                        <div class="control-block-button post-control-button">                
                                            <a href="javascript:void(0);" class="btn btn-control" style="background-color: #f4af08; color: #fff;" data-toggle="tooltip" data-placement="top" data-original-title="<?php echo getEduAppGTLang('forum');?>">
                                                <i class="picons-thin-icon-thin-0281_chat_message_discussion_bubble_reply_conversation"></i>
                                            </a>                
                                        </div>
                                        <br><br><br>
                                    </article>
                                </div>
                            <?php endif;?>
                            <?php endforeach;?>
                            <?php elseif($db->num_rows() == 0):?>
                                <div class="ui-block">
                                    <article class="hentry post thumb-full-width">                                
                                        <div class="edu-posts cta-with-media">
                                            <br><br>
                                            <center><h3><?php echo getEduAppGTLang('no_recent_activity');?></h3></center><br>
                                            <center><img src="<?php echo base_url();?>public/uploads/icons/norecent.svg" width="55%"></center>
                                            <br><br>
                                        </div>              
                                    </article>
                                </div>
                                <?php endif;?>
                            </div>
                        </main>
                        <div class="col col-xl-3 order-xl-1 col-lg-6 order-lg-2 col-md-6 col-sm-12 col-12">
                            <div class="eduappgt-sticky-sidebar">
                                <div class="sidebar__inner">
                                    <div class="ui-block paddingtel lined-danger">
                                        <div class="ui-block-title">
                                            <h6 class="title"><?php echo getEduAppGTLang('teacher_of_the_subject');?></h6>
                                        </div>
                                        <div class="ui-block-content">
                                            <div class="widget w-about" style="text-align:center">
                                            <?php $tch= $this->db->get_where('subject', array('subject_id' => $ex[2]))->row()->teacher_id;?>
                                                <a href="javascript:void(0);" class="logo"><img src="<?php echo $this->crud->get_image_url('teacher', $tch);?>" alt="Educaby" style="width:90px;"></a>
                                                <h5><?php echo $this->crud->get_name('teacher', $tch)?><br> <small><?php echo $this->db->get_where('teacher', array('teacher_id' => $tch))->row()->email;?></small></h5>
                                                <h6><a class="badge badge-primary" href="javascript:void(0);"> <?php echo getEduAppGTLang('teacher');?></a></h6>
                                                <br>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="ui-block">
                                        <div class="ui-block-title">
                                            <h6 class="title"><?php echo getEduAppGTLang('subject_activity');?></h6>                      
                                        </div>
                                        <?php 
                                            $this->db->order_by('id', 'desc');
                                            $this->db->group_by('type');
                                            $notifications = $this->db->get_where('notification', array('class_id' => $ex[0], 'subject_id' => $ex[2], 'year' => $running_year));
                                            if($notifications->num_rows() > 0):
                                        ?>
                                        <ul class="widget w-activity-feed notification-list">
                                            <?php foreach($notifications->result_array() as $notify):?>
                                            <li>
                                                <div class="author-thumb">
                                                    <img src="<?php echo base_url();?>public/uploads/notify.svg">
                                                </div>
                                                <div class="notification-event">
                                                    <a href="javascript:void(0);" class="notification-friend"><?php echo $notify['notify'];?>.</a>
                                                    <span class="notification-date"><time class="entry-date updated"><?php echo $notify['date'];?> <?php echo getEduAppGTLang('at');?> <?php echo $notify['time'];?></time></span>
                                                </div>
                                            </li>
                                            <?php endforeach;?>
                                        </ul>
                                        <?php else:?>
                                            <br><br><br>
                                            <center><h6><?php echo getEduAppGTLang('no_subject_activity');?></h6></center>
                                            <br><br><br>
                                        <?php endif;?>
                                    </div>
                                    <div class="ui-block">
                                        <div class="ui-block-title">
                                            <h6 class="title"><?php echo getEduAppGTLang('latest_news');?></h6>
                                        </div>
                                        <div class="ui-block-content">          
                                            <ul class="widget w-personal-info item-block">
                                            <?php 
                                                $this->db->limit(5);
                                                $this->db->order_by('news_id', 'desc');
                                                $news = $this->db->get('news')->result_array();
                                                foreach($news as $row5):
                                            ?>
                                                <li><span class="text"><?php echo $row5['description'];?></span></li>
                                                <hr>
                                            <?php endforeach;?>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col col-xl-3 order-xl-3 col-lg-6 order-lg-3 col-md-6 col-sm-12 col-12">
                            <div class="eduappgt-sticky-sidebar">
                                <div class="sidebar__inner">
                                    <div class="ui-block paddingtel">
                                        <div class="ui-block-title">
                                            <h6 class="title"><?php echo getEduAppGTLang('about_the_subject');?></h6>
                                        </div>
                                        <div class="ui-block-content">
                                            <ul class="widget item-block">
                                                <li>
                                                    <span class="text"><?php echo $row['about'];?></span>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="ui-block paddingtel">
                                        <div class="ui-block-title">
                                            <h6 class="title"><?php echo getEduAppGTLang('subject_stats');?></h6>
                                        </div>
                                        <div class="ui-block-content">
                                            <div style="margin-bottom:10px">
                                                <span class="subjectCounter"><?php echo $this->academic->countOnlineExams($ex[0],$ex[1],$ex[2]);?></span>
                                                <span class="counterText"><?php echo getEduAppGTLang('online_exams');?>.</span>
                                            </div>
                                            <div style="margin-bottom:10px">
                                                <span class="subjectCounter"><?php echo $this->academic->countHomeworks($ex[0],$ex[1],$ex[2]);?></span>
                                                <span class="counterText"><?php echo getEduAppGTLang('homeworks');?>.</span>
                                            </div>
                                            <div style="margin-bottom:10px">
                                                <span class="subjectCounter"><?php echo $this->academic->countForums($ex[0],$ex[1],$ex[2]);?></span>
                                                <span class="counterText"><?php echo getEduAppGTLang('forums');?>.</span>
                                            </div>
                                            <div style="margin-bottom:10px">
                                                <span class="subjectCounter"><?php echo $this->academic->countMaterial($ex[0],$ex[1],$ex[2]);?></span>
                                                <span class="counterText"><?php echo getEduAppGTLang('study_material');?>.</span>
                                            </div>
                                            <div style="margin-bottom:10px">
                                                <span class="subjectCounter"><?php echo $this->academic->countLive($ex[0],$ex[1],$ex[2]);?></span>
                                                <span class="counterText"><?php echo getEduAppGTLang('live_classes');?>.</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="ui-block paddingtel">
                                        <div class="ui-block-title">
                                            <h6 class="title"><?php echo getEduAppGTLang('students');?></h6>
                                        </div>
                                        <ul class="widget w-friend-pages-added notification-list friend-requests">
                                        <?php $students   =   $this->db->get_where('enroll' , array('class_id' => $ex[0], 'section_id' => $ex[1] , 'year' => $running_year))->result_array();
                                            foreach($students as $row2):?>
                                            <li class="inline-items">
                                                <div class="author-thumb">
                                                    <img src="<?php echo $this->crud->get_image_url('student', $row2['student_id']);?>" width="35px">
                                                </div>
                                                <div class="notification-event">
                                                    <a href="javascript:void(0);" class="h6 notification-friend"><?php echo $this->crud->get_name('student', $row2['student_id'])?></a>
                                                    <span class="chat-message-item"><?php echo getEduAppGTLang('roll');?>: <?php echo $this->db->get_where('enroll' , array('student_id' => $row2['student_id']))->row()->roll; ?></span>
                                                </div>
                                            </li>
                                        <?php endforeach;?>
                                        </ul>
                                    </div> 
                                </div>
                            </div>
                        </div> 
                    </div>
                </div>
                <a class="back-to-top" href="javascript:void(0);">
                    <img src="<?php echo base_url();?>public/style/olapp/svg-icons/back-to-top.svg" alt="arrow" class="back-icon">
                </a>
            </div>
        </div>
    </div>
<?php endforeach;?>