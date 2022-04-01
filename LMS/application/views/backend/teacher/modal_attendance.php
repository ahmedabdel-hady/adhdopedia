<?php 
    $students = $this->db->get_where('attendance_live' , array('live_id' => $param2))->result_array();
?>
    <div class="modal-body">
        <div class="modal-header" style="background-color:#00579c">
            <h6 class="title" style="color:white"><?php echo getEduAppGTLang('student_live_attendance');?></h6>
        </div>
        <div class="ui-block-content">
            <div class="row">
                <div class="table-responsive">
                    <table id="dataTable1" width="100%" class="table table-striped table-lightfont">
                        <thead>
                            <tr>
                                <td>#</td>
                                <td><?php echo getEduAppGTLang('student');?></td>
                                <td><?php echo getEduAppGTLang('date');?></td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                                $count = 1;
                                foreach($students as $row):
                            ?>
                            <tr>
                                <td><?php echo $count++;?></td>
                                <td><?php echo $this->crud->get_name('student',$row['student_id']);?></td>
                                <td><?php echo $row['date'];?></td>
                            </tr>
                        <?php endforeach;?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>