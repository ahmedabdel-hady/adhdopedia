<?php  
    $edit_data = $this->db->get_where('section' , array('section_id' => $param2) )->result_array();
    foreach($edit_data as $row):
?>    
    <div class="modal-body">
        <div class="modal-header" style="background-color:#00579c">
            <h6 class="title" style="color:white"><?php echo getEduAppGTLang('update_section');?></h6>
        </div>
        <div class="ui-block-content">
            <?php echo form_open(base_url() . 'admin/section/update/'.$row['section_id'], array('enctype' => 'multipart/form-data')); ?>
                <div class="row">
                    <div class="col col-lg-12 col-md-12 col-sm-12 col-12">
                        <div class="form-group label-floating">
                            <label class="control-label"><?php echo getEduAppGTLang('name');?></label>
                            <input class="form-control" type="text" name="name" required="" value="<?php echo $row['name'];?>">
                        </div>
                    </div>
                    <div class="col col-lg-12 col-md-12 col-sm-12 col-12">
                        <div class="form-group label-floating is-select">
                            <label class="control-label"><?php echo getEduAppGTLang('teacher');?></label>
                            <div class="select">
                                <select name="teacher_id">
                                    <option value=""><?php echo getEduAppGTLang('select');?></option>
                                    <?php $teachers = $this->db->get('teacher')->result_array(); 
                                        foreach($teachers as $teacher):
                                    ?>
                                        <option value="<?php echo $teacher['teacher_id'];?>" <?php if($row['teacher_id'] == $teacher['teacher_id']) echo 'selected';?>><?php echo $this->crud->get_name('teacher', $teacher['teacher_id']);?></option>
                                    <?php endforeach;?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col col-lg-12 col-md-12 col-sm-12 col-12">
                        <div class="form-group label-floating is-select">
                            <label class="control-label"><?php echo getEduAppGTLang('class');?></label>
                            <div class="select">
                                <select id="slct" disabled="">
                                    <option value=""><?php echo getEduAppGTLang('select');?></option>
                                   <?php $teachers = $this->db->get('class')->result_array(); 
                                        foreach($teachers as $teacher):
                                    ?>
                                        <option value="<?php echo $teacher['class_id'];?>" <?php if($row['class_id'] == $teacher['class_id']) echo 'selected';?>><?php echo $teacher['name'];?></option>
                                    <?php endforeach;?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col col-lg-6 col-md-6 col-sm-12 col-12">
                        <button class="btn btn-rounded btn-success" type="submit"><?php echo getEduAppGTLang('update');?></button>
                    </div>
                </div>
            <?php echo form_close();?>
        </div>
    </div>
<?php endforeach; ?>