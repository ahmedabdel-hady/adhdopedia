<?php $running_year = $this->crud->getInfo('running_year'); ?>
<?php
    $online_exam_details = $this->db->get_where('online_exam', array('online_exam_id' => $online_exam_id))->row_array();
    $students_array = $this->db->get_where('enroll', array('class_id' => $online_exam_details['class_id'], 'section_id' => $online_exam_details['section_id'], 'year' => $online_exam_details['running_year']))->result_array();
    $subject_info = $this->crud->get_subject_info($online_exam_details['subject_id']);
    $total_mark = $this->crud->get_total_mark($online_exam_id);
?>
    <div class="content-w">
        <div class="conty">
            <?php include 'fancy.php';?>
            <div class="header-spacer"></div>
            <div class="os-tabs-w menu-shad">
                <div class="os-tabs-controls">
                    <ul class="navs navs-tabs upper">
                        <li class="navs-item">
                            <a class="navs-links" href="<?php echo base_url();?>admin/examroom/<?php echo $online_exam_id;?>/"><i class="os-icon picons-thin-icon-thin-0016_bookmarks_reading_book"></i><span><?php echo getEduAppGTLang('exam_details');?></span></a>
                        </li>
                        <li class="navs-item">
                            <a class="navs-links active" href="<?php echo base_url();?>admin/exam_results/<?php echo $online_exam_id;?>/"><i class="os-icon picons-thin-icon-thin-0100_to_do_list_reminder_done"></i><span><?php echo getEduAppGTLang('results');?></span></a>
                        </li>
                        <li class="navs-item">
                            <a class="navs-links" href="<?php echo base_url();?>admin/exam_edit/<?php echo $online_exam_id;?>/"><i class="os-icon picons-thin-icon-thin-0001_compose_write_pencil_new"></i><span><?php echo getEduAppGTLang('edit');?></span></a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="content-i">
                <div class="content-box">
                    <div class="row">     
                        <div class="col-sm-8">
                            <div class="pipeline white lined-primary">
                                <div class="pipeline-header">
                                    <h5 class="pipeline-name"><?php echo getEduAppGTLang('results_for');?> <?php echo $online_exam_details['title']; ?></h5>
                                </div>
                                <div class="table-responsive">
                                    <table class="table table-lightborder">
                                        <thead>
                                            <tr>
                                                <th><?php echo getEduAppGTLang('student');?></th>
                                                <th><?php echo getEduAppGTLang('mark_obtained');?></th>
                                                <th><?php echo getEduAppGTLang('result');?></th>
                                                <th><?php echo getEduAppGTLang('answers');?></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php foreach ($students_array as $row):?>
                                            <tr>
                                                <td><?php $student_details = $this->crud->get_student_info_by_id($row['student_id']); echo $student_details['first_name']." ".$student_details['last_name']; ?></td>
                                                <td>
                                                    <?php $query = $this->db->get_where('online_exam_result', array('online_exam_id' => $online_exam_id, 'student_id' => $row['student_id']));
                                                        if ($query->num_rows() > 0){
                                                        $query_result = $query->row_array();
                                                        echo $query_result['obtained_mark'];
                                                    }
                                                    else {
                                                        echo 0;
                                                    }?>
                                                </td>
                                                <td><?php $query = $this->db->get_where('online_exam_result', array('online_exam_id' => $online_exam_id, 'student_id' => $row['student_id']));
                                                    if ($query->num_rows() > 0){
                                                        $query_result = $query->row_array();
                                                        echo getEduAppGTLang($query_result['result']);
                                                    }
                                                    else {
                                                        echo "<span class='badge badge-danger'>". getEduAppGTLang('fail')."</span>";
                                                    }
                                                    ?>
                                                </td>
                                                <td><?php  if ($query->num_rows() > 0){?><a href="<?php echo base_url();?>admin/online_exam_result/<?php echo $online_exam_id;?>/<?php echo $row['student_id'];?>/" class="btn btn-success btn-sm btn-rounded"><?php echo getEduAppGTLang('view_results');?></a><?php } else echo getEduAppGTLang('no_actions');?></td>
                                            </tr>
                                        <?php endforeach; ?>    
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="pipeline white lined-secondary">
                                <div class="pipeline-header">
                                    <h5 class="pipeline-name"><?php echo getEduAppGTLang('information');?></h5>
                                </div>
                                <div class="table-responsive">
                                    <table class="table table-lightbor table-lightfont">
                                        <tr>
                                            <th><?php echo getEduAppGTLang('date');?>:</th>
                                            <td><?php echo date('d M, Y', $online_exam_details['exam_date']);?>.</td>
                                        </tr>
                                        <tr>
                                            <th><?php echo getEduAppGTLang('start');?>:</th>
                                            <td><?php echo $online_exam_details['time_start'];?></td>
                                        </tr>
                                        <tr>
                                            <th><?php echo getEduAppGTLang('end');?>: </th>
                                            <td><?php echo $online_exam_details['time_end'];?></td>
                                        </tr>
                                        <tr>
                                            <th><?php echo getEduAppGTLang('percentage_required');?>:</th>
                                            <td><a class="btn btn-rounded btn-sm btn-primary" style="color:white"><?php echo $online_exam_details['minimum_percentage'];?>%</a></td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                            <div class="pipeline white lined-warning">
                                <div class="pipeline-header">
                                    <h5 class="pipeline-name"><?php echo getEduAppGTLang('students');?></h5>
                                </div>
                                <div class="users-list-w">
                                    <?php 
                                        $students = $this->db->get_where('enroll' , array('class_id' => $online_exam_details['class_id'], 'section_id' => $online_exam_details['section_id'] , 'year' => $running_year))->result_array();
                                        foreach($students as $row2):
                                    ?>
                                    <div class="user-w">
                                        <div class="user-avatar-w">
                                            <div class="user-avatar">
                                                <img alt="" src="<?php echo $this->crud->get_image_url('student', $row2['student_id']); ?>">
                                            </div>
                                        </div>
                                        <div class="user-name">
                                            <h6 class="user-title"><?php echo $this->db->get_where('student' , array('student_id' => $row2['student_id']))->row()->first_name." ".$this->db->get_where('student' , array('student_id' => $row2['student_id']))->row()->last_name; ?></h6>
                                            <div class="user-role">
                                                <?php echo getEduAppGTLang('roll');?>: <strong><?php echo $this->db->get_where('enroll' , array('student_id' => $row2['student_id']))->row()->roll; ?></strong>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach;?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>