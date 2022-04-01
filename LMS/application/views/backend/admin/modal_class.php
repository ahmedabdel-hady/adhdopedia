<?php  
    $edit_data = $this->db->get_where('class' , array('class_id' => $param2) )->result_array();
    foreach($edit_data as $row):
?>    
    <?php echo form_open(base_url() . 'admin/manage_classes/update/'.$row['class_id'], array('enctype' => 'multipart/form-data')); ?>
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="title"><?php echo getEduAppGTLang('update');?></h6>
            </div>
            <div class="modal-body">
                <div class="ui-block-content">
                    <div class="row">
                        <div class="col col-lg-12 col-md-12 col-sm-12 col-12">
                            <div class="form-group label-floating">
                                <label class="control-label"><?php echo getEduAppGTLang('name');?></label>
                                <input class="form-control" placeholder="" name="name" value="<?php echo $row['name'];?>" type="text" required>
                            </div>
                        </div>
                        <div class="col col-lg-12 col-md-12 col-sm-12 col-12">
                            <div class="form-group label-floating is-select">
                                <label class="control-label"><?php echo getEduAppGTLang('teacher');?></label>
                                <div class="select">
                                    <select name="teacher_id">
                                        <option value=""><?php echo getEduAppGTLang('select');?></option>
                                        <?php 
                                            $teachers = $this->db->get('teacher')->result_array(); 
                                            foreach($teachers as $teacher):
                                        ?>
                                        <option value="<?php echo $teacher['teacher_id'];?>" <?php if($row['teacher_id'] == $teacher['teacher_id']) echo 'selected';?>><?php echo $teacher['first_name']." ".$teacher['last_name'];?></option>
                                        <?php endforeach;?>         
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col col-lg-12 col-md-12 col-sm-12 col-12">
                            <button class="btn btn-success btn-lg full-width" type="submit"><?php echo getEduAppGTLang('update');?></button>
                        </div>
                    </div>
                </div>
            </div>
        <?php echo form_close();?>
    </div>
<?php endforeach; ?>