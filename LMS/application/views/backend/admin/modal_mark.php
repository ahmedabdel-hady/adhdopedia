<?php   
    $edit_data = $this->db->get_where('subject' , array('subject_id' => $param2) )->result_array();
    foreach($edit_data as $row):
?>    
    <div class="modal-body">
        <div class="modal-header" style="background-color:#00579c">
            <h6 class="title" style="color:white"><?php echo getEduAppGTLang('update_activities');?></h6>
        </div>
        <div class="ui-block-content">
            <?php echo form_open(base_url() . 'admin/courses/update_labs/'.$param2, array('enctype' => 'multipart/form-data')); ?>
                <div class="row">
                    <input type="hidden" name="section_id" value="<?php echo $param3;?>">
                    <div class="col col-lg-12 col-md-12 col-sm-12 col-12">
                        <div class="form-group label-floating">
                            <label class="control-label"><?php echo getEduAppGTLang('activity');?> 1</label>
                            <input class="form-control" type="text" value="<?php echo $row['la1'];?>" name="la1">
                        </div>
                    </div>
                    <div class="col col-lg-12 col-md-12 col-sm-12 col-12">
                        <div class="form-group label-floating">
                            <label class="control-label"><?php echo getEduAppGTLang('activity');?> 2</label>
                            <input class="form-control" type="text" value="<?php echo $row['la2'];?>" name="la2">
                        </div>
                    </div>
                    <div class="col col-lg-12 col-md-12 col-sm-12 col-12">
                        <div class="form-group label-floating">
                            <label class="control-label"><?php echo getEduAppGTLang('activity');?> 3</label>
                            <input class="form-control" type="text" value="<?php echo $row['la3'];?>" name="la3">
                        </div>
                    </div>
                    <div class="col col-lg-12 col-md-12 col-sm-12 col-12">
                        <div class="form-group label-floating">
                            <label class="control-label"><?php echo getEduAppGTLang('activity');?> 4</label>
                            <input class="form-control" type="text" value="<?php echo $row['la4'];?>" name="la4">
                        </div>
                    </div>
                    <div class="col col-lg-12 col-md-12 col-sm-12 col-12">
                        <div class="form-group label-floating">
                            <label class="control-label"><?php echo getEduAppGTLang('activity');?> 5</label>
                            <input class="form-control" type="text" value="<?php echo $row['la5'];?>" name="la5">
                        </div>
                    </div>
                    <div class="col col-lg-12 col-md-12 col-sm-12 col-12">
                        <div class="form-group label-floating">
                            <label class="control-label"><?php echo getEduAppGTLang('activity');?> 6</label>
                            <input class="form-control" type="text" value="<?php echo $row['la6'];?>" name="la6">
                        </div>
                    </div>
                    <div class="col col-lg-12 col-md-12 col-sm-12 col-12">
                        <div class="form-group label-floating">
                            <label class="control-label"><?php echo getEduAppGTLang('activity');?> 7</label>
                            <input class="form-control" type="text" value="<?php echo $row['la7'];?>" name="la7">
                        </div>
                    </div>
                    <div class="col col-lg-12 col-md-12 col-sm-12 col-12">
                        <div class="form-group label-floating">
                            <label class="control-label"><?php echo getEduAppGTLang('activity');?> 8</label>
                            <input class="form-control" type="text" value="<?php echo $row['la8'];?>" name="la8">
                        </div>
                    </div>
                    <div class="col col-lg-12 col-md-12 col-sm-12 col-12">
                        <div class="form-group label-floating">
                            <label class="control-label"><?php echo getEduAppGTLang('activity');?> 9</label>
                            <input class="form-control" type="text" value="<?php echo $row['la9'];?>" name="la9">
                        </div>
                    </div>
                    <div class="col col-lg-12 col-md-12 col-sm-12 col-12">
                        <div class="form-group label-floating">
                            <label class="control-label"><?php echo getEduAppGTLang('activity');?> 10</label>
                            <input class="form-control" type="text" value="<?php echo $row['la10'];?>" name="la10">
                        </div>
                    </div>
                    <div class="col col-lg-6 col-md-6 col-sm-12 col-12">
                        <button class="btn btn-rounded btn-success btn-lg " type="submit"><?php echo getEduAppGTLang('update');?></button>
                    </div>
                </div>
            <?php echo form_close();?>
        </div>
    </div>
    <?php endforeach;?>