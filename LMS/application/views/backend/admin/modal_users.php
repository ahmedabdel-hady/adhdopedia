<?php  $check = $this->db->get_where('readed', array('activity_code' => $param2))->result_array(); ?>
    <div class="modal-body">
        <div class="modal-header" style="background-color:#00579c">
            <h6 class="title" style="color:white"><?php echo getEduAppGTLang('users_seen_this_post');?></h6>
        </div>
        <div class="ui-block-content">
            <div class="row">
                <div class="table-responsive">
                    <table id="dataTable1" width="100%" class="table table-striped table-lightfont">
                        <thead>
                            <tr>
                                <td>#</td>
                                <td><?php echo getEduAppGTLang('user');?></td>
                                <td><?php echo getEduAppGTLang('user_type');?></td>
                                <td><?php echo getEduAppGTLang('date');?></td>
                            </tr>
                        </thead>
                        <tbody>
                        <?php 
                            $count = 1; foreach($check as $row):?>
                            <tr>
                                <td><?php echo $count++;?></td>
                                <td><?php echo $this->crud->get_name($row['user_type'],$row['user_id']);?></td>
                                <td><span class="badge badge-info"><?php echo $row['user_type'];?></span></td>
                                <td><?php echo $row['date'];?></td>
                            </tr>
                        <?php endforeach;?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>