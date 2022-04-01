    <div class="modal-body">
        <div class="modal-header" style="background-color:#00579c">
            <h6 class="title" style="color:white"><?php echo getEduAppGTLang('send_marks_by_email');?></h6>
        </div>
        <div class="ui-block-content">
            <?php echo form_open(base_url() . 'admin/send_marks/email/', array('enctype' => 'multipart/form-data'));?>
                <div class="row">
                    <input type="hidden" name="class_id" value="<?php echo $param2;?>">
                    <div class="col col-lg-6 col-md-6 col-sm-12 col-12">							
    				    <div class="form-group label-floating is-select">
                            <label class="control-label"><?php echo getEduAppGTLang('class');?></label>
                            <div class="select">
                                <select disabled>
                                    <option value=""><?php echo getEduAppGTLang('select');?></option>
                                    <?php
                                        $classes = $this->db->get('class')->result_array();
                                        foreach($classes as $cls):
                                    ?>
                                    <option value="<?php echo $cls['class_id'];?>" <?php if($param2 == $cls['class_id']) echo 'selected';?>><?php echo $cls['name'];?></option>
                                    <?php endforeach;?>
                                </select>
	                        </div>
                        </div>	
                    </div>
                    <div class="col col-lg-6 col-md-6 col-sm-12 col-12">							
    				    <div class="form-group label-floating is-select">
                            <label class="control-label"><?php echo getEduAppGTLang('section');?></label>
                            <div class="select">
                                <select name="section_id" required="">
                                    <option value=""><?php echo getEduAppGTLang('select');?></option>
                                    <?php
                                        $sections = $this->db->get_where('section', array('class_id' => $param2))->result_array();
                                        foreach($sections as $sec):
                                    ?>
                                    <option value="<?php echo $sec['section_id'];?>"><?php echo $sec['name'];?></option>
                                <?php endforeach;?>
                                </select>
	                        </div>
                        </div>	
                    </div>
                    <div class="col col-lg-6 col-md-6 col-sm-12 col-12">							
    				    <div class="form-group label-floating is-select">
                            <label class="control-label"><?php echo getEduAppGTLang('exam');?></label>
                            <div class="select">
                                <select name="exam_id" required="">
                                    <option value=""><?php echo getEduAppGTLang('select');?></option>
                                    <?php
                                        $exam = $this->db->get('exam')->result_array();
                                        foreach($exam as $ex):
                                    ?>
                                    <option value="<?php echo $ex['exam_id'];?>"><?php echo $ex['name'];?></option>
                                    <?php endforeach;?>
                                </select>
	                        </div>
                        </div>	
                    </div>	
                    <div class="col col-lg-6 col-md-6 col-sm-12 col-12">							
    				    <div class="form-group label-floating is-select">
                            <label class="control-label"><?php echo getEduAppGTLang('receiver');?></label>
                            <div class="select">
                                <select name="receiver" required="">
                                    <option value=""><?php echo getEduAppGTLang('select');?></option>
                                    <option value="student"><?php echo getEduAppGTLang('students');?></option>
                                    <option value="parent"><?php echo getEduAppGTLang('parents');?></option>
                                </select>
	                        </div>
                        </div>	
                    </div>
                    <div class="col col-lg-12 col-md-12 col-sm-12 col-12">
                        <button class="btn btn-purple" style="width:100%;" type="submit"><?php echo getEduAppGTLang('send');?></button>
                    </div>
                </div>
            <?php echo form_close();?>
        </div>
    </div>