    <div class="content-w">
        <?php include 'fancy.php';?>
        <div class="header-spacer"></div>
        <div class="content-i">
            <div class="content-box">
                <div class="conty">
                    <div class="row">
                    <?php 
                        $this->db->group_by('class_id');
                        $classes = $this->db->get_where('subject', array('teacher_id' => $this->session->userdata('login_user_id')))->result_array();
                        foreach($classes as $cl):
                    ?>
                    <div class="col col-xl-3 col-lg-6 col-md-6 col-sm-12 col-12">
                        <div class="ui-block" data-mh="friend-groups-item">        
                            <div class="friend-item friend-groups">
                                <div class="friend-item-content">
                                    <div class="more">
                                        <i class="icon-feather-more-horizontal"></i>
                                        <ul class="more-dropdown">
                                            <li><a href="<?php echo base_url();?>teacher/cursos/<?php echo base64_encode($cl['class_id']);?>/"><?php echo getEduAppGTLang('my_subjects');?></a></li>
                                        </ul>
                                    </div>
                                    <div class="friend-avatar">
                                        <div class="author-thumb">
                                            <img src="<?php echo base_url();?>public/uploads/<?php echo $this->db->get_where('settings', array('type' => 'logo'))->row()->description;?>" width="120px" style="background-color:#fff;padding:15px; border-radius:0px">
                                        </div>
                                        <div class="author-content">
                                            <a href="<?php echo base_url();?>teacher/cursos/<?php echo base64_encode($cl['class_id']);?>/" class="h5 author-name"><?php echo $this->db->get_where('class', array('class_id' => $cl['class_id']))->row()->name;?></a>
                                            <div class="country"><b><?php echo getEduAppGTLang('sections');?>:</b> <?php $sections = $this->db->get_where('section', array('class_id' => $cl['class_id']))->result_array(); foreach($sections as $sec):?> <?php echo $sec['name']." "."|";?><?php endforeach;?></div>
                                        </div>
                                    </div>        
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach;?>
                </div>
            </div>
            </div>
        </div>
    </div>