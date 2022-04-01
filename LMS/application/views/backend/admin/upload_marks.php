<?php 
    $running_year = $this->crud->getInfo('running_year');
    $info = base64_decode($data);
    $ex = explode('-', $info);
    $sub = $this->db->get_where('subject', array('subject_id' => $ex[2]))->result_array();
    foreach($sub as $subs):
?>
    <div class="content-w">
        <div class="conty">
        <?php include 'fancy.php';?>
        <div class="header-spacer"></div>
            <div class="cursos cta-with-media" style="background: #<?php echo $subs['color'];?>;">
                <div class="cta-content">
                    <div class="user-avatar">
                        <img alt="" src="<?php echo base_url();?>public/uploads/subject_icon/<?php echo $subs['icon'];?>" style="width:60px;">
                    </div>
                    <h3 class="cta-header"><?php echo $subs['name'];?> - <small><?php echo getEduAppGTLang('marks');?></small></h3>
                    <small style="font-size:0.90rem; color:#fff;"><?php echo $this->db->get_where('class', array('class_id' => $ex[0]))->row()->name;?> "<?php echo $this->db->get_where('section', array('section_id' => $ex[1]))->row()->name;?>"</small>
                </div>
            </div> 
            <div class="os-tabs-w menu-shad">
                <div class="os-tabs-controls">
                    <ul class="navs navs-tabs upper">
                        <li class="navs-item">
                            <a class="navs-links" href="<?php echo base_url();?>admin/subject_dashboard/<?php echo $data;?>/"><i class="os-icon picons-thin-icon-thin-0482_gauge_dashboard_empty"></i><span><?php echo getEduAppGTLang('dashboard');?></span></a>
                        </li>
                        <li class="navs-item">
                            <a class="navs-links" href="<?php echo base_url();?>admin/online_exams/<?php echo $data;?>/"><i class="os-icon picons-thin-icon-thin-0207_list_checkbox_todo_done"></i><span><?php echo getEduAppGTLang('online_exams');?></span></a>
                        </li>
                        <li class="navs-item">
                            <a class="navs-links" href="<?php echo base_url();?>admin/homework/<?php echo $data;?>/"><i class="os-icon picons-thin-icon-thin-0004_pencil_ruler_drawing"></i><span><?php echo getEduAppGTLang('homework');?></span></a>
                        </li>
                        <li class="navs-item">
                            <a class="navs-links" href="<?php echo base_url();?>admin/forum/<?php echo $data;?>/"><i class="os-icon picons-thin-icon-thin-0281_chat_message_discussion_bubble_reply_conversation"></i><span><?php echo getEduAppGTLang('forum');?></span></a>
                        </li>
                        <li class="navs-item">
                            <a class="navs-links" href="<?php echo base_url();?>admin/study_material/<?php echo $data;?>/"><i class="os-icon picons-thin-icon-thin-0003_write_pencil_new_edit"></i><span><?php echo getEduAppGTLang('study_material');?></span></a>
                        </li>
                        <li class="navs-item">
                            <a class="navs-links active" href="<?php echo base_url();?>admin/upload_marks/<?php echo $data;?>/"><i class="os-icon picons-thin-icon-thin-0729_student_degree_science_university_school_graduate"></i><span><?php echo getEduAppGTLang('marks');?></span></a>
                        </li>
                        <li class="navs-item">
                            <a class="navs-links" href="<?php echo base_url();?>admin/meet/<?php echo $data;?>/"><i class="os-icon picons-thin-icon-thin-0591_presentation_video_play_beamer"></i><span><?php echo getEduAppGTLang('live');?></span></a>
                        </li>
                        <li class="navs-item">
                            <a class="navs-links" href="<?php echo base_url();?>admin/attendance/<?php echo $data;?>/"><i class="os-icon picons-thin-icon-thin-0023_calendar_month_day_planner_events"></i><span><?php echo getEduAppGTLang('attendance');?></span></a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="content-i">
                <div class="content-box">
                    <div class="row">
                        <main class="col col-xl-12 order-xl-2 col-lg-12 order-lg-1 col-md-12 col-sm-12 col-12">
                            <div class="ui-block">
                                <article class="hentry post thumb-full-width">                
                                    <div class="post__author author vcard inline-items">
                                        <img src="<?php echo base_url();?>public/uploads/<?php echo $this->crud->getInfo('logo');?>" style="border-radius:0px">                
                                        <div class="author-date">
                                            <a class="h6 post__author-name fn" href="javascript:void(0);"><?php echo getEduAppGTLang('upload_marks');?> <small>(<?php echo $this->db->get_where('exam', array('exam_id' => $exam_id))->row()->name;?>)</small>.</a>
                                        </div>                
                                    </div>                
                                    <div class="edu-posts cta-with-media">
			                            <div style="padding:0% 0%">
				                            <div id='cssmenu'>
				                                <ul>
				                                    <?php  
                            				            $var = 0;
                            				            $examss = $this->db->get('exam')->result_array();
                            				            foreach($examss as $exam):
                            				            $var++;
                            				        ?>
                            				        <li class='<?php if($exam['exam_id'] == $exam_id) echo "act";?>'><a href="<?php echo base_url();?>admin/upload_marks/<?php echo $data.'/'.$exam['exam_id'];?>/"><i class="os-icon picons-thin-icon-thin-0023_calendar_month_day_planner_events"></i><?php echo $exam['name'];?></a></li>
                            				        <?php endforeach;?>
				                                </ul>
				                            </div>
			                            </div>
                                        <?php echo form_open(base_url() . 'admin/marks_update/'.$exam_id.'/'.$ex[0].'/'.$ex[1].'/'.$ex[2]);?>
                                            <div class="table-responsive">
                                                <table class="table table-bordered">
                                                    <thead>
                                                        <tr style="background:#f2f4f8;">
                                                            <th style="text-align: center;"><?php echo getEduAppGTLang('student');?></th>
                                                            <th style="text-align: center;"><?php echo $this->db->get_where('subject' , array('subject_id' => $ex[2]))->row()->la1;?></th>
                                                            <th style="text-align: center;"><?php echo $this->db->get_where('subject' , array('subject_id' => $ex[2]))->row()->la2;?></th>
                                                            <th style="text-align: center;"><?php echo $this->db->get_where('subject' , array('subject_id' => $ex[2]))->row()->la3;?></th>
                                                            <th style="text-align: center;"><?php echo $this->db->get_where('subject' , array('subject_id' => $ex[2]))->row()->la4;?></th>
                                                            <th style="text-align: center;"><?php echo $this->db->get_where('subject' , array('subject_id' => $ex[2]))->row()->la5;?></th>
                                                            <th style="text-align: center;"><?php echo $this->db->get_where('subject' , array('subject_id' => $ex[2]))->row()->la6;?></th>
                                                            <th style="text-align: center;"><?php echo $this->db->get_where('subject' , array('subject_id' => $ex[2]))->row()->la7;?></th>
                                                            <th><?php echo $this->db->get_where('subject' , array('subject_id' => $ex[2]))->row()->la8;?></th>
                                                            <th style="text-align: center;"><?php echo $this->db->get_where('subject' , array('subject_id' => $ex[2]))->row()->la9;?></th>
                                                            <th style="text-align: center;"><?php echo $this->db->get_where('subject' , array('subject_id' => $ex[2]))->row()->la10;?></th>
                                                            <th style="text-align: center;"><?php echo getEduAppGTLang('comment');?></th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                            $count = 1;
                                                            $marks_of_students = $this->db->get_where('mark' , array('class_id' => $ex[0], 'section_id' => $ex[1] ,'year' => $running_year,'subject_id' => $ex[2],'exam_id' => $exam_id))->result_array();
                                                            foreach($marks_of_students as $row):
                                                        ?>
                                                        <tr style="height:25px;">                    
                                                            <td style="min-width:190px">
                                                                <img alt="" src="<?php echo $this->crud->get_image_url('student', $row['student_id']);?>" width="25px" style="border-radius: 10px;margin-right:5px;"> <?php echo $this->crud->get_name('student', $row['student_id']);?>
                                                            </td>
                                                            <td class="text-center">
                                                                <center><input type="text" name="marks_obtained_<?php echo $row['mark_id'];?>" placeholder="0" style="width:55px; border: 1; text-align: center;" value="<?php echo $row['mark_obtained'];?>">  </center>
                                                            </td>
                                                            <td>
                                                                <center><input type="text" name="lab_uno_<?php echo $row['mark_id'];?>" placeholder="0" style="width:55px; border: 1; text-align: center;" value="<?php echo $row['labuno'];?>">  </center>
                                                            </td>
                                                            <td>
                                                                <center><input type="text" name="lab_dos_<?php echo $row['mark_id'];?>" placeholder="0" style="width:55px; border: 1; text-align: center;" value="<?php echo $row['labdos'];?>"></center>
                                                            </td>
                                                            <td>  
                                                                <center><input type="text" name="lab_tres_<?php echo $row['mark_id'];?>" placeholder="0" style="width:55px; border: 1; text-align: center;" value="<?php echo $row['labtres'];?>"></center>
                                                            </td>
                                                            <td>
                                                                <center><input type="text" name="lab_cuatro_<?php echo $row['mark_id'];?>" placeholder="0" placeholder="0" style="width:55px; border: 1; text-align: center;" value="<?php echo $row['labcuatro'];?>">  </center>
                                                            </td>
                                                            <td>
                                                                <center><input type="text" name="lab_cinco_<?php echo $row['mark_id'];?>" placeholder="0" style="width:55px; border: 1; text-align: center;" value="<?php echo $row['labcinco'];?>"> </center>
                                                            </td>
                                                            <td>
                                                                <center><input type="text" name="lab_seis_<?php echo $row['mark_id'];?>" placeholder="0" style="width:55px; border: 1; text-align: center;" value="<?php echo $row['labseis'];?>" >  </center>
                                                            </td>
                                                            <td>
                                                                <center> <input type="text" name="lab_siete_<?php echo $row['mark_id'];?>" placeholder="0" style="width:55px; border: 1; text-align: center;" value="<?php echo $row['labsiete'];?>">  </center>
                                                            </td>
                                                            <td>
                                                                <center><input type="text" name="lab_ocho_<?php echo $row['mark_id'];?>" placeholder="0" style="width:55px;  border: 1; text-align: center;" value="<?php echo $row['labocho'];?>">  </center>
                                                            </td>
                                                            <td>
                                                                <center><input type="text" name="lab_nueve_<?php echo $row['mark_id'];?>" placeholder="0" style="width:55px; border: 1; text-align: center;" value="<?php echo $row['labnueve'];?>"></center>
                                                            </td>
                                                            <td>
                                                                <center><input type="text" class="form-control" name="comment_<?php echo $row['mark_id'];?>" value="<?php echo $row['comment'];?>"></center>
                                                            </td>
                                                        </tr>
                                                    <?php endforeach;?>
                                                    </tbody>
                                                </table>
                                                <div class="form-buttons-w text-center">
                                                    <button class="btn btn-success btn-rounded" type="submit"><?php echo getEduAppGTLang('update');?></button>
                                                </div>
                                            <?php echo form_close();?>
                                        </div>
                                    </div>
                                    <div class="control-block-button post-control-button">
                                        <a href="javascript:void(0);" onclick="showAjaxModal('<?php echo base_url();?>modal/popup/modal_mark/<?php echo $ex[2];?>/<?php echo $ex[1];?>');" class="btn btn-control featured-post" style="background-color: #99bf2d; color: #fff;" data-toggle="tooltip" data-placement="top" data-original-title="<?php echo getEduAppGTLang('update_activities');?>">
                                            <i class="picons-thin-icon-thin-0102_notebook_to_do_bullets_list"></i>
                                        </a>
                                    </div>                
                                </article>
                            </div>
                        </main>
                    </div>
                </div>
                <a class="back-to-top" href="javascript:void(0);">
                    <img src="<?php echo base_url();?>public/style/olapp/svg-icons/back-to-top.svg" alt="arrow" class="back-icon">
                </a>
            </div>
        </div>
    </div>
      <?php endforeach;?>