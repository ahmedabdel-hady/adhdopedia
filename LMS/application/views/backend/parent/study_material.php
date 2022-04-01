<?php 
    $running_year = $this->crud->getInfo('running_year');
    $info = base64_decode($data);
    $ex = explode('-', $info);
    $sub = $this->db->get_where('subject', array('subject_id' => $ex[2]))->result_array();
    foreach($sub as $rows):
?>
    <div class="content-w">
        <div class="conty">
        <?php $info = base64_decode($data);?>
        <?php $ids = explode("-",$info);?>
        <?php include 'fancy.php';?>
        <div class="header-spacer"></div>
            <div class="cursos cta-with-media" style="background: #<?php echo $rows['color'];?>;">
                <div class="cta-content">
                    <div class="user-avatar">
                        <img alt="" src="<?php echo base_url();?>public/uploads/subject_icon/<?php echo $rows['icon'];?>" style="width:60px;">
                    </div>
                    <h3 class="cta-header"><?php echo $rows['name'];?> - <small><?php echo getEduAppGTLang('study_material');?></small></h3>
                    <small style="font-size:0.90rem; color:#fff;"><?php echo $this->crud->get_name('student', $ex[3]);?> | <?php echo $this->db->get_where('class', array('class_id' => $ex[0]))->row()->name;?> "<?php echo $this->db->get_where('section', array('section_id' => $ex[1]))->row()->name;?>"</small>
                </div>
            </div> 
            <div class="os-tabs-w menu-shad">
                <div class="os-tabs-controls">
                    <ul class="navs navs-tabs upper">
                        <li class="navs-item">
                            <a class="navs-links" href="<?php echo base_url();?>parents/subject_dashboard/<?php echo $data;?>/"><i class="os-icon picons-thin-icon-thin-0482_gauge_dashboard_empty"></i><span><?php echo getEduAppGTLang('dashboard');?></span></a>
                        </li>
                        <li class="navs-item">
                            <a class="navs-links" href="<?php echo base_url();?>parents/online_exams/<?php echo $data;?>/"><i class="os-icon picons-thin-icon-thin-0207_list_checkbox_todo_done"></i><span><?php echo getEduAppGTLang('online_exams');?></span></a>
                        </li>
                        <li class="navs-item">
                            <a class="navs-links" href="<?php echo base_url();?>parents/homework/<?php echo $data;?>/"><i class="os-icon picons-thin-icon-thin-0004_pencil_ruler_drawing"></i><span><?php echo getEduAppGTLang('homework');?></span></a>
                        </li>
                        <li class="navs-item">
                            <a class="navs-links" href="<?php echo base_url();?>parents/forum/<?php echo $data;?>/"><i class="os-icon picons-thin-icon-thin-0281_chat_message_discussion_bubble_reply_conversation"></i><span><?php echo getEduAppGTLang('forum');?></span></a>
                        </li>
                        <li class="navs-item">
                            <a class="navs-links active" href="<?php echo base_url();?>parents/study_material/<?php echo $data;?>/"><i class="os-icon picons-thin-icon-thin-0003_write_pencil_new_edit"></i><span><?php echo getEduAppGTLang('study_material');?></span></a>
                        </li>
                        <li class="navs-item">
                            <a class="navs-links" href="<?php echo base_url();?>parents/subject_marks/<?php echo $data;?>/"><i class="os-icon picons-thin-icon-thin-0729_student_degree_science_university_school_graduate"></i><span><?php echo getEduAppGTLang('marks');?></span></a>
                        </li>
                        <li class="navs-item">
                            <a class="navs-links" href="<?php echo base_url();?>parents/attendance_report/<?php echo $data;?>/"><i class="os-icon picons-thin-icon-thin-0023_calendar_month_day_planner_events"></i><span><?php echo getEduAppGTLang('attendance');?></span></a>
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
                                        <h6 class="element-header"><?php echo getEduAppGTLang('study_material');?></h6>
                                        <div class="table-responsive">
                                            <table class="table table-padded">
                                                <tbody>
                                                <?php
        		                                    $this->db->order_by('timestamp', 'desc');
        		                                    $study_material_info = $this->db->get_where('document', array('class_id' => $ids[0], 'section_id' => $ids[1], 'subject_id' => $ids[2]))->result_array();
        		                                    foreach ($study_material_info as $row):
        	                                    ?>   
                                                    <tr>
                                                        <td><?php echo $row['description']?></td>
                                                        <td class="text-left cell-with-media ">
                                                            <a href="<?php echo base_url().'public/uploads/document/'.$row['file_name']; ?>" style="color:gray;">
                                                            <?php if($row['file_type'] == 'PDF'):?>
							                                <i class="picons-thin-icon-thin-0077_document_file_pdf_adobe_acrobat" style="font-size:20px; color:gray;"></i>
						                                    <?php endif;?>
						                                    <?php if($row['file_type'] == 'Zip'):?>
							                                <i class="picons-thin-icon-thin-0076_document_file_zip_archive_compressed_rar" style="font-size:20px; color:gray;"></i>
						                                    <?php endif;?>
						                                    <?php if($row['file_type'] == 'RAR'):?>
							                                <i class="picons-thin-icon-thin-0076_document_file_zip_archive_compressed_rar" style="font-size:20px; color:gray;"></i>
						                                    <?php endif;?>
						                                    <?php if($row['file_type'] == 'Doc'):?>
							                                <i class="picons-thin-icon-thin-0078_document_file_word_office_doc_text" style="font-size:20px; color:gray;"></i>
						                                    <?php endif;?>
						                                    <?php if($row['file_type'] == 'Image'):?>
							                                <i class="picons-thin-icon-thin-0082_image_photo_file" style="font-size:20px; color:gray;"></i>
						                                    <?php endif;?>
						                                    <?php if($row['file_type'] == 'Other'):?>
    							                            <i class="picons-thin-icon-thin-0111_folder_files_documents" style="font-size:20px; color:gray;"></i>
						                                    <?php endif;?><span><?php echo $row['file_name'];?></span><span class="smaller">(<?php echo $row['filesize'];?>)</span></a>
                                                        </td>                     
                                                        <td class="text-center bolder">
                                                            <a href="<?php echo base_url().'public/uploads/document/'.$row['file_name']; ?>" style="color:gray;"> <span><i class="picons-thin-icon-thin-0121_download_file"></i></span> </a>
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