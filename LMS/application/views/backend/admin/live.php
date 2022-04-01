<?php   
    $running_year = $this->crud->getInfo('running_year');
    $posts = $this->db->get_where('live' , array('live_id' => base64_decode($live_id)))->result_array();
    foreach ($posts as $row):
?>
    <div class="content-w">
        <?php include 'fancy.php';?>
        <div class="header-spacer"></div>
        <div class="conty">
            <div class="content-i">
                <div class="content-box">
                    <div class="back">
                        <a href="<?php echo base_url();?>admin/meet/<?php echo base64_encode($row['class_id']."-".$row['section_id']."-".$row['subject_id']);?>/"><i class="picons-thin-icon-thin-0131_arrow_back_undo"></i></a>
                    </div>          
                    <div class="row">
                        <div class="col col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                            <div class="ui-block features-video">
                                <div class="video-player">
                                    <div id="container" style="width:100%;height:83vh"></div>
                                </div>
                                <div class="features-video-content">
                                    <article class="hentry post">
                                        <div class="post__author author vcard inline-items">
                                            <img src="<?php echo $this->crud->get_image_url($row['user_type'], $row['user_id']);?>" width="36" height="36" alt="author">
                                            <div class="author-date">
                                                <a class="h6 post__author-name fn" href="javascript:void(0);"><?php echo $this->crud->get_name($row['user_type'], $row['user_id']);?></a>
                                                <div class="post__date">
                                                    <time class="published" datetime="2017-03-24T18:18"><?php echo $row['publish_date'];?></time>
                                                </div>
                                            </div>
                                        </div>
                                        <h2><?php echo $row['title'];?>.</h2><br>
                                        <h5>
                                            <span class="badge badge-warning">
                                                <?php echo $this->db->get_where('subject' , array('subject_id' => $row['subject_id']))->row()->name;?> - 
                                                <?php echo $this->db->get_where('class' , array('class_id' => $row['class_id']))->row()->name;?> 
                                                (<?php echo $this->db->get_where('section' , array('section_id' => $row['section_id']))->row()->name;?>).
                                            </span>
                                        </h5>
                                        <br>
                                        <p><?php echo $row['description'];?></p>
                                        <hr>
                                        <b><?php echo getEduAppGTLang('participants');?>:</b>
                                        <ul class="friends-harmonic">
                                            <?php 
                                                $students   =   $this->db->get_where('enroll' , array('class_id' => $row['class_id'], 'section_id' => $row['section_id'] , 'year' => $running_year))->result_array();
                                                foreach($students as $row2):
                                            ?>
                                            <li>
                                                <a href="javascript:void(0);" style="margin-left:0px">
                                                    <img title="<?php echo $this->crud->get_name('student', $row2['student_id']);?>" src="<?php echo $this->crud->get_image_url('student', $row2['student_id']);?>" alt="<?php echo $this->crud->get_name('student', $row2['student_id']);?>" width="28" height="28">
                                                </a>
                                            </li>
                                            <?php endforeach;?>
                                        </ul>
                                        <hr>
                                        <div style="max-height:400px;overflow-y:auto;">
                                        <b><?php echo getEduAppGTLang('your_other_live_classes');?>:</b><br><br>
                                        <?php
                    		                $info = $this->academic->getOtherLiveClasses($row['live_id'], $row['class_id'], $row['section_id']);
                    		                if(count($info) > 0):
                        		            foreach ($info as $rowx):
                    	                ?>  
                                        <div class="ui-block">
                                            <div class="birthday-item inline-items badges">
                                                <div class="birthday-author-name">
                                                    <a href="<?php echo base_url();?>admin/live/<?php echo base64_encode($rowx['live_id']);?>" class="h6 author-name"><?php echo $rowx['title'];?> - <span class="badge badge-success"><?php echo $this->db->get_where('subject', array('subject_id' => $rowx['subject_id']))->row()->name;?></span> <small>[<?php echo $row['date'];?>].</small></a>
                                                    <div class="birthday-date"><?php echo $rowx['description'];?></div>
                                                </div>
                                            </div>
                                        </div>
                                        <?php endforeach; endif;?>
                                        </div>
                                    </article>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://meet.jit.si/external_api.js"></script>
    <script>
        var domain = "meet.jit.si";
        var options = {
            userInfo : { 
                email : '<?php echo $this->db->get_where('admin', array('admin_id' => $this->session->userdata('login_user_id')))->row()->email;?>' , 
                displayName : '<?php echo $this->crud->get_name('admin', $this->session->userdata('login_user_id'));?>',
                moderator: true,
            },
            roomName: "<?php echo $row['room'];?>",
            width: "100%",
            height: "100%",
            parentNode: document.querySelector('#container'),
            configOverwrite: {},
            interfaceConfigOverwrite: {
                DEFAULT_BACKGROUND: '#782c43',
            },
        }
        var api = new JitsiMeetExternalAPI(domain, options);
        api.executeCommand('subject', '<?php echo $row['title'];?>');
    </script>
<?php endforeach;?>