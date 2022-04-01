    <div class="content-w"> 
        <?php include 'fancy.php';?>
        <div class="header-spacer"></div>
        <div class="content-i">
            <div class="content-box">
                <div class="conty">
                    <div class="row">        
                        <main class="col col-xl-6 order-xl-2 col-lg-12 order-lg-1 col-md-12 col-sm-12 col-12">
                            <div id="panel">
                            <?php 
                                $db = $this->db->query('SELECT description, publish_date, type,news_id FROM news UNION SELECT question,publish_date,type,id FROM polls ORDER BY publish_date DESC')->result_array();
                                foreach($db as $wall):
                                $this->crud->setRead($wall['news_id']);
                            ?>
                            <?php if($wall['type'] == 'news'):?>
                                <div class="ui-block paddingtel">    
                                <?php 
                                    $news_code = $this->db->get_where('news', array('news_id' => $wall['news_id']))->row()->news_code;
                                    $admin_id = $this->db->get_where('news', array('news_id' => $wall['news_id']))->row()->admin_id;
                                ?>    
                                    <article class="hentry post has-post-thumbnail thumb-full-width">
                                        <div class="post__author author vcard inline-items">
                                            <img src="<?php echo $this->crud->get_image_url('admin', $admin_id);?>">                
                                            <div class="author-date">
                                                <a class="h6 post__author-name fn" href="javascript:void(0);"><?php echo $this->crud->get_name('admin', $admin_id);?></a>
                                                <div class="post__date">
                                                    <time class="published" style="color: #0084ff;"><?php echo $this->db->get_where('news', array('news_id' => $wall['news_id']))->row()->date." ".$this->db->get_where('news', array('news_id' => $wall['news_id']))->row()->date2;?></time>
                                                </div>
                                            </div>                
                                        </div>
                                        <?php if (file_exists('public/uploads/news_images/'.$news_code.'.jpg')):?>
                                        <p><?php echo $this->crud->check_text($wall['description']);?></p>
                                        <div class="post-thumb">
                                            <img src="<?php echo base_url();?>public/uploads/news_images/<?php echo $news_code;?>.jpg">
                                        </div>
                                        <?php else:?>
                                        <div class="wall-content">
                                            <p><?php echo $this->crud->check_text($wall['description']);?></p>
                                        </div>
                                        <br><br><br>
                                        <?php endif;?>
                                        <div class="control-block-button post-control-button">
                                            <a href="javascript:void(0);" class="btn btn-control" style="background-color:#001b3d; color:#fff;" data-toggle="tooltip" data-placement="top" data-original-title="<?php echo getEduAppGTLang('news');?>">
                                                <i class="picons-thin-icon-thin-0032_flag"></i>
                                            </a>
                                        </div>
                                    </article>
                                </div>
                                <?php endif;?>
                                <?php if($wall['type'] == 'video'):?>
                                <div class="ui-block paddingtel">    
                                <?php 
                                    $news_code = $this->db->get_where('news', array('news_id' => $wall['news_id']))->row()->news_code;
                                    $news_embed = $this->db->get_where('news', array('news_id' => $wall['news_id']))->row()->embed;
                                    $admin_id = $this->db->get_where('news', array('news_id' => $wall['news_id']))->row()->admin_id;?>    
                                    <article class="hentry post has-post-thumbnail thumb-full-width">
                                        <div class="post__author author vcard inline-items">
                                            <img src="<?php echo $this->crud->get_image_url('admin', $admin_id);?>">                
                                            <div class="author-date">
                                                <a class="h6 post__author-name fn" href="javascript:void(0);"><?php echo $this->crud->get_name('admin', $admin_id);?></a>
                                                <div class="post__date">
                                                    <time class="published" style="color: #0084ff;"><?php echo $this->db->get_where('news', array('news_id' => $wall['news_id']))->row()->date." ".$this->db->get_where('news', array('news_id' => $wall['news_id']))->row()->date2;?></time>
                                                </div>
                                            </div>                
                                        </div><hr>
                                        <p><?php echo $this->crud->check_text($wall['description']);?></p>
                                        <div class="post-thumb">
                                            <iframe src="<?php echo $news_embed;?>" height="360" width="100%" frameborder="0" allowfullscreen=""></iframe>
                                        </div>
                                        <div class="control-block-button post-control-button">
                                            <a href="javascript:void(0);" class="btn btn-control" style="background-color:#001b3d; color:#fff;" data-toggle="tooltip" data-placement="top" data-original-title="<?php echo getEduAppGTLang('news');?>">
                                                <i class="picons-thin-icon-thin-0032_flag"></i>
                                            </a>
                                        </div>
                                    </article>
                                </div>
                            <?php endif;?>
                            <?php if($wall['type'] == 'polls'):?>
                                <?php echo form_open(base_url() . 'teacher/polls/response/' , array('enctype' => 'multipart/form-data'));?>
                                <?php 
                                    $usrdb = $this->db->get_where('polls', array('id' => $wall['news_id']))->row()->user;
                                    $poll_code = $this->db->get_where('polls', array('id' => $wall['news_id']))->row()->poll_code;
                                    $admin_id = $this->db->get_where('polls', array('id' => $wall['news_id']))->row()->admin_id;
                                    $options = $this->db->get_where('polls', array('id' => $wall['news_id']))->row()->options;
                                ?>  
                                <?php if($usrdb == 'teacher' || $usrdb == 'all'):?>
                                <?php 
                                    $type = 'teacher';
                                    $id = $this->session->userdata('login_user_id');
                                    $user = $type. "-".$id;
                                    $query = $this->db->get_where('poll_response', array('poll_code' => $poll_code, 'user' => $user));
                                ?>
                                <?php if($query->num_rows() <= 0):?>
                                    <div class="ui-block paddingtel">
                                    <input type="hidden" name="poll_code" id="poll_code" value="<?php echo $poll_code;?>">
                                        <article class="hentry post">
                                            <div class="post__author author vcard inline-items">
                                                <img src="<?php echo $this->crud->get_image_url('admin', $admin_id);?>" alt="author">
                                                <div class="author-date">
                                                    <a class="h6 post__author-name fn" href="javascript:void(0);"><?php echo $this->crud->get_name('admin', $admin_id);?></a>
                                                    <div class="post__date">
                                                        <time class="published" style="color: #0084ff;"><?php echo $this->db->get_where('polls', array('id' => $wall['news_id']))->row()->date." ".$this->db->get_where('polls', array('id' => $wall['news_id']))->row()->date2;?></time>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="control-block-button post-control-button">
                                                <a href="javascript:void(0);" class="btn btn-control" style="background-color:#99bf2d; color:#fff;" data-toggle="tooltip" data-placement="top" data-original-title="<?php echo getEduAppGTLang('polls');?>">
                                                    <i class="picons-thin-icon-thin-0385_graph_pie_chart_statistics"></i>
                                                </a>
                                            </div> 
                                            <div class="wall-content">
                                                <div>
                                                    <ul class="widget w-pool">
                                                        <li>
                                                            <h4><?php echo $wall['description'];?></h4>
                                                        </li><br>
                                                        <?php 
                                                            $array = ( explode(',' , $options));
                                                            for($i = 0 ; $i<count($array)-1; $i++):
                                                        ?>
                                                        <li>
                                                            <div class="skills-item">
                                                                <div class="skills-item-info">
                                                                    <span class="skills-item-title">
                                                                        <span class="radio">
                                                                            <h6>
                                                                                <label>
                                                                                    <input type="radio" id="answer" name="answer<?php echo $poll_code;?>" value="<?php echo $array[$i];?>"><span class="circle" style="border: 3px solid #ffffff;"></span><span class="check"></span>
                                                                                    <?php echo $array[$i];?>
                                                                                </label>
                                                                            </h6>
                                                                        </span>
                                                                    </span>
                                                                </div>
                                                            </div>  
                                                        </li>
                                                        <?php endfor;?>
                                                    </ul>
                                                </div>
                                                <a href="javascript:void(0);" class="btn btn-md-2 btn-border-think custom-color c-grey text-white btn-vote" onClick="vote('<?php echo $poll_code;?>')"><?php echo getEduAppGTLang('vote');?><div class="ripple-container"></div></a>
                                            </div>
                                            <br><br><br>
                                        </article>
                                    </div>
                                <?php endif;?>
                                <?php if($query->num_rows() > 0):?>
                                    <div class="ui-block paddingtel">
                                        <article class="hentry post">
                                            <div class="post__author author vcard inline-items">
                                                <img src="<?php echo $this->crud->get_image_url('admin', $admin_id);?>" alt="author">
                                                <div class="author-date">
                                                    <a class="h6 post__author-name fn" href="javascript:void(0);"><?php echo $this->crud->get_name('admin', $admin_id);?></a>
                                                    <div class="post__date">
                                                        <time class="published" style="color: #0084ff;"><?php echo $this->db->get_where('polls', array('id' => $wall['news_id']))->row()->date." ".$this->db->get_where('polls', array('id' => $wall['news_id']))->row()->date2;?></time>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="control-block-button post-control-button">
                                                <a href="javascript:void(0);" class="btn btn-control" style="background-color:#99bf2d; color:#fff;" data-toggle="tooltip" data-placement="top" data-original-title="<?php echo getEduAppGTLang('polls');?>">
                                                    <i class="picons-thin-icon-thin-0385_graph_pie_chart_statistics"></i>
                                                </a>
                                            </div>
                                            <div class="wall-content">
                                                <div>
                                                    <ul class="widget w-pool">
                                                        <li>
                                                            <h4><?php echo $wall['description'];?></h4>
                                                        </li><br>
                                                        <?php 
                                                            $this->db->where('poll_code', $poll_code);
                                                            $polls = $this->db->count_all_results('poll_response');
                                                            $array = ( explode(',' , $options));
                                                            $questions = count($array)-1;
                                                            $op = 0;
                                                            for($i = 0 ; $i<count($array)-1; $i++):
                                                            $this->db->group_by('poll_code');
                                                            $po = $this->db->get_where('poll_response', array('poll_code' => $poll_code))->result_array();
                                                            foreach($po as $p):
                                                        ?>
                                                        <li>
                                                            <div class="skills-item">
                                                                <div class="skills-item-info">
                                                                    <span class="skills-item-title">
                                                                    <?php 
                                                                        $this->db->where('answer', $array[$i]);
                                                                        $this->db->where('poll_code', $poll_code);
                                                                        $res = $this->db->count_all_results('poll_response');
                                                                    ?>
                                                                        <h6><label><?php echo $array[$i];?></label></h6>
                                                                    </span>
                                                                    <?php 
                                                                        $response = $res/$polls;
                                                                        $response2 = $response*100;
                                                                    ?>
                                                                    <span class="skills-item-count">
                                                                        <span class="count-animate" data-speed="1000" data-refresh-interval="50" data-to="62" data-from="0"></span>
                                                                        <span class="units"><?php echo round($response2);?>/100%</span>
                                                                    </span>
                                                                </div>
                                                                <div class="skills-item-meter">
                                                                    <span class="skills-item-meter-active bg-primary skills-animate" style="width: <?php echo $response2;?>%; opacity: 1;"></span>
                                                                </div>
                                                            </div>
                                                        </li>
                                                    <?php endforeach;?>
                                                    <?php endfor;?>
                                                    </ul>
                                                </div>
                                            </div>
                                            <br><br><br>
                                        </article>
                                    </div>
                                    <?php endif;?>
                                    <?php endif;?>
                                <?php echo form_close();?>
                                <?php endif;?>
                                <?php endforeach;?>
                            </div>
                        </main>
                        <div class="col col-xl-3 order-xl-1 col-lg-6 order-lg-2 col-md-6 col-sm-12 col-12">
                            <div class="eduappgt-sticky-sidebar">
                                <div class="sidebar__inner">
                                    <div class="ui-block paddingtel">
                                        <div class="ui-block-content">
                                            <div class="widget w-about">
                                                <a href="javascript:void(0);" class="logo"><img src="<?php echo base_url();?>public/uploads/<?php echo $this->crud->getInfo('logo');?>" title="<?php echo $this->crud->getInfo('system_name');?>"></a>
                                                <ul class="socials">
                                                    <li><a class="socialDash fb" href="<?php echo $this->crud->getInfo('facebook');?>"><i class="fab fa-facebook-square" aria-hidden="true"></i></a></li>
                                                    <li><a class="socialDash tw" href="<?php echo $this->crud->getInfo('twitter');?>"><i class="fab fa-twitter" aria-hidden="true"></i></a></li>
                                                    <li><a class="socialDash yt" href="<?php echo $this->crud->getInfo('youtube');?>"><i class="fab fa-youtube" aria-hidden="true"></i></a></li>
                                                    <li><a class="socialDash ig" href="<?php echo $this->crud->getInfo('instagram');?>"><i class="fab fa-instagram" aria-hidden="true"></i></a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="ui-block paddingtel">
				                        <div class="widget w-create-fav-page">
        					                <div class="icons-block" style="margin-bottom: 10px;">
						                        <i class="picons-thin-icon-thin-0729_student_degree_science_university_school_graduate text-white" style="font-size:25px;"></i>
					                        </div>
					                        <div class="content">
						                        <h3 class="title"><?php echo getEduAppGTLang('welcome_teacher_dashboard');?></h3>
						                        <a href="<?php echo base_url();?>teacher/grados/" class="btn btn-warning btn-sm"><?php echo getEduAppGTLang('go_to_my_classes');?></a>
					                        </div>
				                        </div>
			                        </div>
			                        <div class="ui-block paddingtel">
                                        <div class="ui-block-title"><h6 class="title"><?php echo getEduAppGTLang('chat_groups');?></h6></div>
                                            <ul class="widget w-friend-pages-added notification-list friend-requests">
                                            <?php  
                                                $this->db->limit(5);
                                                $group_messages = $this->db->get('group_message_thread')->result_array();
                                                foreach ($group_messages as $row):
                                                $members = json_decode($row['members']);
                                                if (in_array($this->session->userdata('login_type').'_'.$this->session->userdata('login_user_id'), $members)):
                                            ?>
                                            <li class="inline-items">
                                                <div class="author-thumb">
                                                    <div class="avatar with-status status-green">
                          		                        <div class="circle purple"><?php echo strtoupper($row['group_name'][0]);?></div>
                        		                    </div>
                                                </div>
                                                <div class="notification-event">
                                                    <a href="<?php echo base_url();?>teacher/group/group_message_read/<?php echo $row['group_message_thread_code'];?>/" class="h6 notification-friend"><?php echo $row['group_name'];?></a>
                                                    <span class="chat-message-item"><?php echo count(json_decode($row['members']));?> <?php echo getEduAppGTLang('members_on_this_group');?>.</span>
                                                </div>
                                            </li>
                                            <?php endif;?>
                                            <?php endforeach;?>
                                        </ul>
                                    </div>
                                    <div class="ui-block paddingtel" >
                                        <div class="pipeline white lined-success">
                                            <div class="element-wrapper" >
                                                <h6 class="element-header"><?php echo getEduAppGTLang('online_users');?></h6>
                                                <?php $this->crud->saveUser();?>          
                                                <div class="full-ch at-w">
                                                    <div class="chat-content-w min">
                                                        <div class="chat-content min">  
                                                            <div class="users-list-w">
                                                            <?php  
                                                                $this->db->group_by('gp');
                                                                $usuarios = $this->db->get('online_users')->result_array();
                                                                foreach($usuarios as $row):
                                                            ?>
                                                                <div class="user-w with-status min status-green">
                                                                    <div class="user-avatar-w min">
                                                                        <div class="user-avatar" >
                                                                            <img alt="" src="<?php echo $this->crud->get_image_url($row['type'], $row['id_usuario']);?>">
                                                                        </div>
                                                                    </div>
                                                                    <div class="user-name">
                                                                        <h6 class="user-title min"><?php echo $this->crud->get_name($row['type'],$row['id_usuario']);?></h6>
                                                                        <div class="user-role min">
                                                                        <?php if($row['type'] == 'student'):?>
                                                                            <span class="badge badge-warning"><?php echo getEduAppGTLang('student');?></span>
                                                                        <?php endif;?>
                                                                        <?php if($row['type'] == 'parent'):?>
                                                                            <span class="badge badge-purple"><?php echo getEduAppGTLang('parent');?></span>
                                                                        <?php endif;?>
                                                                        <?php if($row['type'] == 'accountant'):?>
                                                                            <span class="badge badge-info"><?php echo getEduAppGTLang('accountant');?></span>
                                                                        <?php endif;?>
                                                                        <?php if($row['type'] == 'librarian'):?>
                                                                            <span class="badge badge-info"><?php echo getEduAppGTLang('librarian');?></span>
                                                                        <?php endif;?>
                                                                        <?php if($row['type'] == 'admin'):?>
                                                                            <span class="badge badge-primary"><?php echo getEduAppGTLang('admin');?></span> 
                                                                        <?php endif;?>
                                                                        <?php if($row['type'] == 'teacher'):?>
                                                                            <span class="badge badge-success"><?php echo getEduAppGTLang('teacher');?></span>
                                                                        <?php endif;?>
                                                                        </div>
                                                                    </div>            
                                                                </div>
                                                            <?php endforeach;?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="header-spacer"></div>
                                </div>
                            </div>
                        </div>
                        <div class="col col-xl-3 order-xl-3 col-lg-6 order-lg-3 col-md-6 col-sm-12 col-12">
                            <div class="eduappgt-sticky-sidebar">
                                <div class="sidebar__inner">
                                    <div class="ui-block paddingtel">
                                        <div class="today-events calendar ">
                                            <div class="today-events-thumb">
                                                <div class="date">
                                                    <div class="day-number"><?php echo date('d');?></div>
                                                    <div class="day-week"><?php echo getEduAppGTLang(date('l'));?></div>
                                                    <div class="month-year" style="color:#FFF"><?php echo getEduAppGTLang(date('F'));?>, <?php echo date('Y');?>.</div>
                                                </div>
                                            </div>
                                            <div class="list">
                                                <?php $date = date('Y-m-d');
                                                $events = $this->db->get_where('events', array('start > ' => $date.' '.'00:00:00', 'start <' => $date.' '.'23:59:59')); ?>
                                                <div id="accordion-1" role="tablist" aria-multiselectable="true" class="day-event" data-month="12" data-day="2">
                                                    <?php  if($events->num_rows() > 0):?>
                                                    <?php
                                                        foreach($events->result_array() as $event):
                                                    ?>
                                                    <div class="card">
                                                        <div class="card-header" role="tab" id="headingOne-1">
                                                            <div class="event-time">
                                                                <h5 class="mb-0 title">
                                                                    <a href="<?php echo base_url();?>teacher/calendar/">
                                                                        <?php echo $event['title'];?>
                                                                    </a>
                                                                </h5>
                                                            </div>
                                                        </div>  
                                                    </div>
                                                    <?php endforeach;?>
                                                    <?php else:?>
                                                    <center>
                                                        <div style="padding-bottom : 75px;padding-top :75px;">
                                                            <p><?php echo getEduAppGTLang('no_today_events');?></p>
                                                            <img src="<?php echo base_url();?>public/uploads/calendar.png" width="20%"/>
                                                        </div>
                                                    </center>
                                                <?php endif;?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="ui-block paddingtel">
                                        <div class="ui-block-title"><h6 class="title"><?php echo getEduAppGTLang('birthdays');?></h6></div>
                                        <br><br>
                                        <center>
                                            <img src="<?php echo base_url();?>public/uploads/icons/cake.svg" width="85px"><br><br>
                                            <h4><?php echo getEduAppGTLang('birthdays');?></h4>
                                            <p><?php echo $this->crud->get_birthdays();?> <?php echo getEduAppGTLang('users_have_a_birthday_this_month');?>.</p>
                                            <a href="<?php echo base_url();?>teacher/birthdays/" style="background-color: #615dfa;line-height: 28px; font-size: .875rem; font-weight: 700;display: inline-block; text-align: center;width: 60%; height: 48px;box-shadow: 4px 7px 12px 0 rgb(97 93 250 / 20%);color:#fff;padding:10px;border-radius:10px;transition: background-color .2s ease-in-out, color .2s ease-in-out, border-color .2s ease-in-out, box-shadow .2s ease-in-out;"><?php echo getEduAppGTLang('view_all_birthdays');?></a>
                                        </center>
                                        <div class="header-spacer"></div>
                                    </div><br>
                                    <br>
                                </div>
                            </div> 
                        </div>
                    </div>
                </div>
                <a class="back-to-top" href="#">
                    <img src="<?php echo base_url();?>public/style/olapp/svg-icons/back-to-top.svg" alt="arrow" class="back-icon">
                </a>
            </div>
        </div>
    </div>
      
     
    <script>
        var post_message        =   '<?php echo getEduAppGTLang('thank_you_polls');?>';
        function vote(poll_code)
        {
          answer = $('input[name=answer'+poll_code+']:checked').val();
          if(answer!="" && poll_code!="")
          {
            $.ajax({url:"<?php echo base_url();?>teacher/polls/response/",type:'POST',data:{answer:answer,poll_code:poll_code},success:function(result)
            {
              $('#panel').load(document.URL + ' #panel');
              const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 8000
                }); 
                Toast.fire({
                type: 'success',
                title: post_message
                })
            }});
          }else{
            alert('<?php echo getEduAppGTLang('select_an_option');?>');
          }
        }
    </script>