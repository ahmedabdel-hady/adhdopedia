    <div class="full-chat-middle">
        <?php echo form_open(base_url() . 'admin/message/send_new/', array('class' => 'form', 'enctype' => 'multipart/form-data')); ?>
            <div class="chat -head">
    		    <div class="row">
    		        <div class="col-sm-12">
                        <div class="form-group label-floating is-select">
                            <label class="control-label"><?php echo getEduAppGTLang('receiver');?></label>
                            <div class="select">
                                <select name="reciever" id="slct" required="">
                                    <option value=""><?php echo getEduAppGTLang('select');?></option>
                                    <optgroup label="<?php echo getEduAppGTLang('admins');?>">
                                    <?php
                                        $admins = $this->db->get('admin')->result_array();
                                        foreach ($admins as $row):
                                    ?>
                                        <?php if($this->session->userdata('login_user_id') != $row['admin_id']):?>
                                            <option value="admin-<?php echo $row['admin_id']; ?>">
                                            <?php echo $this->crud->get_name('admin',$row['admin_id']);?></option>
                                        <?php endif;?>
                                    <?php endforeach; ?>
                                    </optgroup>
                                     <optgroup label="<?php echo getEduAppGTLang('teachers');?>">
                                    <?php
                                        $teachers = $this->db->get('teacher')->result_array();
                                        foreach ($teachers as $row):
                                    ?>
                                        <option value="teacher-<?php echo $row['teacher_id']; ?>">
                                            <?php echo $this->crud->get_name('teacher',$row['teacher_id']);?></option>
                                        <?php endforeach; ?>
                                    </optgroup>
                                    <optgroup label="<?php echo getEduAppGTLang('parents');?>">
                                    <?php
                                        $parents = $this->db->get('parent')->result_array();
                                        foreach ($parents as $row):
                                    ?>
                                        <option value="parent-<?php echo $row['parent_id']; ?>">
                                        <?php echo $this->crud->get_name('parent',$row['parent_id']);?></option>
                                    <?php endforeach; ?>
                                    </optgroup>
                                    <optgroup label="<?php echo getEduAppGTLang('students');?>">
                                    <?php
                                        $students = $this->db->get('student')->result_array();
                                        foreach ($students as $row):
                                    ?>
                                        <option value="student-<?php echo $row['student_id']; ?>">
                                            <?php echo $this->crud->get_name('student',$row['student_id']);?></option>
                                        <?php endforeach; ?>
                                    </optgroup>
                                    <optgroup label="<?php echo getEduAppGTLang('librarians');?>">
                                    <?php
                                        $librarian = $this->db->get('librarian')->result_array();
                                        foreach ($librarian as $row):
                                    ?>
                                        <option value="librarian-<?php echo $row['librarian_id']; ?>">
                                            <?php echo $this->crud->get_name('librarian',$row['librarian_id']);?></option>
                                        <?php endforeach; ?>
                                    </optgroup>
                                    <optgroup label="<?php echo getEduAppGTLang('accountants');?>">
                                    <?php
                                        $accountant = $this->db->get('accountant')->result_array();
                                        foreach ($accountant as $row):
                                    ?>
                                        <option value="accountant-<?php echo $row['accountant_id']; ?>">
                                            <?php echo $this->crud->get_name('accountant',$row['accountant_id']);?></option>
                                        <?php endforeach; ?>
                                    </optgroup>
                                </select>
                            </div>
                        </div>
                    </div>
    		    </div>
    	    </div>
            <div class="chat-content-w">
                <div class="chat-content">
                </div>
            </div>
            <div class="chat-controls b-b">
                <div class="chat-input">
                    <input placeholder="<?php echo getEduAppGTLang('write_message');?>..." type="text" name="message" required="">
                </div>
                <div class="chat-input-extra">
        	        <div class="chat-extra-actions">
        		        <input type="file" name="file_name" id="file-3" class="inputfile inputfile-3" style="display:none"/>
        		        <label for="file-3"><i class="os-icon picons-thin-icon-thin-0042_attachment"></i> <span><?php echo getEduAppGTLang('send_file');?>...</span></label>
        		    </div>
        		    <div class="chat-btn">
        		        <button class="btn btn-rounded btn-primary" type="submit"><?php echo getEduAppGTLang('send');?></button>
        		    </div>
        	    </div>
            </div>
        <?php echo form_close();?>
    </div>