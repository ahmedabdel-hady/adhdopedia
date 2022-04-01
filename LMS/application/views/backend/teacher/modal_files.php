<?php  $edit_data = $this->db->get_where('homework_files' , array('delivery_id' => $param2) )->result_array();?>    
    <div class="modal-body">
        <div class="modal-header" style="background-color:#00579c">
            <h6 class="title" style="color:white"><?php echo getEduAppGTLang('files');?></h6>
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
                                <td><?php echo getEduAppGTLang('file');?></td>
                            </tr>
                        </thead>
                        <tbody>
                        <?php 
                            $count = 1;
                            foreach($edit_data as $row):
                        ?>
                            <?php $class_id = $this->db->get_where('enroll', array('student_id' => $row['student_id']))->row()->class_id;?>
                            <tr>
                                <td><?php echo $count++;?></td>
                                <td><?php echo $this->crud->get_name('student', $row['student_id']);?></td>
                                <td><?php echo $this->db->get_where('deliveries', array('id' => $row['delivery_id']))->row()->date;?></td>
                                <td><a href="<?php echo base_url();?>public/uploads/homework_delivery/<?php echo $row['file'];?>" target="_blank"><?php echo getEduAppGTLang('download');?></a></td>
                            </tr>
                        <?php endforeach;?>
                        </tbody>
                    </table>    
                </div>
            </div>
        </div>
    </div>