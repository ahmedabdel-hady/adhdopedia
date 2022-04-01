<?php 
    $edit_data		=	$this->db->get_where('grade' , array('grade_id' => $param2) )->result_array();
    foreach ( $edit_data as $row):
?>
    <div class="modal-body">
        <div class="modal-header" style="background-color:#00579c">
            <h6 class="title" style="color:white"><?php echo getEduAppGTLang('update_grade_level');?></h6>
        </div>
        <div class="ui-block-content">
            <?php echo form_open(base_url() . 'admin/grade/update/'.$row['grade_id'] , array('enctype' => 'multipart/form-data'));?>
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label" for=""> <?php echo getEduAppGTLang('name');?></label>
                    <div class="col-sm-9">
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="picons-thin-icon-thin-0003_write_pencil_new_edit"></i>
                            </div>
                            <input class="form-control" name="name" value="<?php echo $row['name'];?>" required="" type="text">
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label" for=""> <?php echo getEduAppGTLang('point');?></label>
                    <div class="col-sm-9">
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="picons-thin-icon-thin-0003_write_pencil_new_edit"></i>
                            </div>
                            <input class="form-control" name="point" value="<?php echo $row['grade_point'];?>" required="" type="text">
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label" for=""> <?php echo getEduAppGTLang('mark_from');?></label>
                    <div class="col-sm-9">
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="picons-thin-icon-thin-0003_write_pencil_new_edit"></i>
                            </div>
                            <input class="form-control" name="from" value="<?php echo $row['mark_from'];?>" required="" type="text">
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label" for=""> <?php echo getEduAppGTLang('mark_to');?></label>
                    <div class="col-sm-9">
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="picons-thin-icon-thin-0003_write_pencil_new_edit"></i>
                            </div>
                            <input class="form-control" name="to" value="<?php echo $row['mark_upto'];?>" required="" type="text">
                        </div>
                    </div>
                </div>
                <div class="form-buttons-w">
                    <button class="btn btn-rounded btn-success" style="float: right;" type="submit"> <?php echo getEduAppGTLang('update');?></button><br>
                </div>
            </div>
        </div>
    <?php echo form_close();?>
<?php endforeach; ?>