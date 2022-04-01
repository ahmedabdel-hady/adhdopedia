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
                            <a class="navs-links" href="<?php echo base_url();?>teacher/subject_dashboard/<?php echo $data;?>/"><i class="os-icon picons-thin-icon-thin-0482_gauge_dashboard_empty"></i><span><?php echo getEduAppGTLang('dashboard');?></span></a>
                        </li>
                        <li class="navs-item">
                            <a class="navs-links active" href="<?php echo base_url();?>teacher/online_exams/<?php echo $data;?>/"><i class="os-icon picons-thin-icon-thin-0207_list_checkbox_todo_done"></i><span><?php echo getEduAppGTLang('online_exams');?></span></a>
                        </li>
                        <li class="navs-item">
                            <a class="navs-links" href="<?php echo base_url();?>teacher/homework/<?php echo $data;?>/"><i class="os-icon picons-thin-icon-thin-0004_pencil_ruler_drawing"></i><span><?php echo getEduAppGTLang('homework');?></span></a>
                        </li>
                        <li class="navs-item">
                            <a class="navs-links" href="<?php echo base_url();?>teacher/forum/<?php echo $data;?>/"><i class="os-icon picons-thin-icon-thin-0281_chat_message_discussion_bubble_reply_conversation"></i><span><?php echo getEduAppGTLang('forum');?></span></a>
                        </li>
                        <li class="navs-item">
                            <a class="navs-links" href="<?php echo base_url();?>teacher/study_material/<?php echo $data;?>/"><i class="os-icon picons-thin-icon-thin-0003_write_pencil_new_edit"></i><span><?php echo getEduAppGTLang('study_material');?></span></a>
                        </li>
                        <li class="navs-item">
                            <a class="navs-links" href="<?php echo base_url();?>teacher/upload_marks/<?php echo $data;?>/"><i class="os-icon picons-thin-icon-thin-0729_student_degree_science_university_school_graduate"></i><span><?php echo getEduAppGTLang('marks');?></span></a>
                        </li>
                        <li class="navs-item">
                            <a class="navs-links" href="<?php echo base_url();?>teacher/meet/<?php echo $data;?>/"><i class="os-icon picons-thin-icon-thin-0591_presentation_video_play_beamer"></i><span><?php echo getEduAppGTLang('live');?></span></a>
                        </li>
                        <li class="navs-item">
                            <a class="navs-links" href="<?php echo base_url();?>teacher/attendance/<?php echo $data;?>/"><i class="os-icon picons-thin-icon-thin-0023_calendar_month_day_planner_events"></i><span><?php echo getEduAppGTLang('attendance');?></span></a>
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
                                        <h6 class="element-header">
                                            <?php echo getEduAppGTLang('online_exams');?>
                                            <div style="margin-top:auto;float:right;"><a href="<?php echo base_url();?>teacher/new_exam/<?php echo $data;?>/" class="text-white btn btn-control btn-grey-lighter btn-success"><i class="picons-thin-icon-thin-0001_compose_write_pencil_new"></i><div class="ripple-container"></div></a></div>
                                        </h6>
                                        <div class="table-responsive">
                                            <table class="table table-padded">
                                                <thead>
                                                    <tr>
                                                        <th><?php echo getEduAppGTLang('status');?></th>
                                                        <th><?php echo getEduAppGTLang('title');?></th>
                                                        <th><?php echo getEduAppGTLang('date');?></th>
                                                        <th><?php echo getEduAppGTLang('options');?></th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                <?php
                                                    $this->db->order_by('online_exam_id', 'desc');
                                                    $online_exams = $this->db->where(array('running_year' => $running_year, 'subject_id' => $row['subject_id'], 'class_id' => $row['class_id'],'section_id' => $ex[1]))->get('online_exam')->result_array();
                                                    foreach($online_exams as $row):
                                                ?>
                                                    <tr>
                                                        <td><button class="btn btn-<?php echo $row['status'] == 'published' ? 'success' : 'warning'; ?> btn-sm"><?php if($row['status'] == "published") echo getEduAppGTLang('published'); else if($row['status'] == "pending") echo getEduAppGTLang('pending'); else echo getEduAppGTLang('expired');?></button></td>
                                                        <td><span><?php echo $row['title'];?></span></td>
                                                        <td><span><?php echo '<b>'.getEduAppGTLang('date').':</b> '.date('M d, Y', $row['exam_date']).'<br>'.'<b>'.getEduAppGTLang('hour').':</b> '.$row['time_start'].' - '.$row['time_end'];?></span></td>
                                                        <td class="bolder">
                                                            <a href="<?php echo base_url();?>teacher/examroom/<?php echo $row['online_exam_id'];?>" class="btn btn-success btn-sm"> <?php echo getEduAppGTLang('details');?></a><br>
                                                            <?php if ($row['status'] == 'pending'): ?>
                                                            <a href="<?php echo base_url();?>teacher/manage_online_exam_status/<?php echo $row['online_exam_id'];?>/published/<?php echo $data;?>/" onclick="return confirm('<?php echo getEduAppGTLang('confirm_publish');?>')" class="btn btn-info btn-sm"><?php echo getEduAppGTLang('publish');?></a><br>
                                                            <?php elseif ($row['status'] == 'published'): ?>
                                                            <a href="<?php echo base_url();?>teacher/manage_online_exam_status/<?php echo $row['online_exam_id'];?>/expired/<?php echo $data;?>/" onclick="return confirm('Esta seguro que desea marcar como expirado el examen?')" class="btn btn-primary btn-sm"> <?php echo getEduAppGTLang('mark_as_expired');?></a><br>
                                                            <?php elseif($row['status'] == 'expired'): ?>
                                                            <a href="#" class="btn btn-warning btn-sm"> <?php echo getEduAppGTLang('expired');?></a><br>
                                                            <?php endif; ?>
                                                            <a class="btn btn-danger btn-sm" onClick="return confirm('<?php echo getEduAppGTLang('confirm_delete');?>')" href="<?php echo base_url();?>teacher/manage_exams/delete/<?php echo $row['online_exam_id'];?>/<?php echo $data;?>/"><?php echo getEduAppGTLang('delete');?></a>
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