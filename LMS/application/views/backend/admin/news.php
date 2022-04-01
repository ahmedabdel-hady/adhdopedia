    <div class="content-w"> 
        <?php include 'fancy.php';?>
        <div class="header-spacer"></div>
        <div class="content-box">
            <div class="conty">
                <div class="conta iner">
                    <h3><?php echo getEduAppGTLang('news');?></h3>
                    <div class="row">
                    <?php
                        $this->db->order_by('news_id', 'desc');
                        $news = $this->db->get('news')->result_array();
                        foreach($news as $wall):
                    ?>
                        <div class="col col-xl-6 col-lg-12 col-md-12 col-sm-12 col-12">
                            <div class="ui-block paddingtel">    
                                <article class="hentry post has-post-thumbnail thumb-full-width">
                                    <div class="post__author author vcard inline-items">
                                        <img src="<?php echo $this->crud->get_image_url('admin', $wall['admin_id']);?>">                
                                        <div class="author-date">
                                            <a class="h6 post__author-name fn" href="javascript:void(0);"><?php echo $this->crud->get_name('admin', $wall['admin_id']);?></a>
                                            <div class="post__date">
                                                <time class="published" style="color: #0084ff;"><?php echo $this->db->get_where('news', array('news_id' => $wall['news_id']))->row()->date." ".$this->db->get_where('news', array('news_id' => $wall['news_id']))->row()->date2;?></time>
                                            </div>
                                        </div>                
                                        <div class="more">
                                            <i class="icon-options"></i>                                
                                            <ul class="more-dropdown">
                                                <li><a href="javascript:void(0);" onclick="showAjaxModal('<?php echo base_url();?>modal/popup/modal_news/<?php echo $wall['news_code'];?>');"><?php echo getEduAppGTLang('edit');?></a></li>
                                                <li><a onClick="return confirm('<?php echo getEduAppGTLang('confirm_delete');?>')"  href="<?php echo base_url();?>admin/news/delete2/<?php echo $wall['news_code'];?>"><?php echo getEduAppGTLang('delete');?></a></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <?php if($wall['type'] == 'video'):?><hr>
                                    <p><?php echo $this->crud->check_text($wall['description']);?></p>
                                    <div class="post-thumb">
                                        <iframe src="<?php echo $wall['embed'];?>" height="360" width="100%" frameborder="0" allowfullscreen=""></iframe>
                                    </div>
                                    <?php else:?>
                                    <?php if (file_exists('public/uploads/news_images/'.$wall['news_code'].'.jpg')):?><hr>
                                    <p><?php echo $this->crud->check_text($wall['description']);?></p>
                                    <div class="post-thumb">
                                        <img src="<?php echo base_url();?>public/uploads/news_images/<?php echo $wall['news_code'];?>.jpg">
                                    </div>
                                    <?php else:?>
                                    <div class="wall-content">
                                        <p><?php echo $this->crud->check_text($wall['description']);?></p>
                                    </div>
                                    <?php endif;?>
                                    <?php endif;?>
                                    <div class="control-block-button post-control-button">
                                        <a href="javascript:void(0);" class="btn btn-control" style="background-color:#001b3d; color:#fff;" data-toggle="tooltip" data-placement="top" data-original-title="<?php echo getEduAppGTLang('news');?>">
                                            <i class="picons-thin-icon-thin-0032_flag"></i>
                                        </a>
                                    </div>
                                    <?php
                                        $checkData = $this->crud->getRead($wall['news_id']);
                                        if(count($checkData) > 0):
                                    ?>
                                    <div class="post-additional-info inline-items">
                                        <ul class="friends-harmonic">
                                            <?php foreach($checkData as $readed):?>
                                            <li>
                                                <a href="javascript:void(0);">
                                                    <img loading="lazy" onclick="showAjaxModal('<?php echo base_url();?>modal/popup/modal_users/<?php echo $wall['news_id'];?>');" title="<?php echo $this->crud->get_name($readed['user_type'], $readed['user_id']);?>" src="<?php echo $this->crud->get_image_url($readed['user_type'], $readed['user_id']);?>" alt="<?php echo $this->crud->get_name($readed['user_type'], $readed['user_id']);?>" width="28" height="28">
                                                </a>
                                            </li>
                                            <?php endforeach;?>
                                        </ul>
                                        <div class="names-people-likes">
                                            <?php if(count($checkData) > 5):?>
                                                <?php echo getEduAppGTLang('and');?> <?php echo count($checkData)-5;?> <?php echo getEduAppGTLang('other_people_viewed_this_post');?>.
                                            <?php else:?>
                                                <?php echo getEduAppGTLang('have_seen_this_post');?>
                                            <?php endif;?>
                                        </div>
                                        <div class="comments-shared">
                                            <a href="javascript:void(0);" class="post-add-icon inline-items"></a>
                                            <a href="javascript:void(0);" class="post-add-icon inline-items"></a>
                                        </div>
                                    </div>
                                    <?php endif;?>
                                </article>
                            </div>
                        </div>
                        <?php endforeach;?>
                    </div>
                </div>
            </div>
        </div>
    </div>