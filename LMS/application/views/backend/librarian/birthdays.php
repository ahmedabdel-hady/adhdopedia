    <div class="content-w">
        <?php include 'fancy.php';?>
        <div class="header-spacer"></div>
        <div class="conty">
            <div class="all-wrapper no-padding-content solid-bg-all">
                <div class="layout-w">
                    <div class="content-w">
                        <div class="content-i">
                            <div class="content-box">
                                <div class="app-email-w">
                                    <div class="app-email-i">
                                        <div class="ae-content-w">
                                            <div class="top-header top-header-favorit">
                                                <div class="top-header-thumb">
                                                    <img src="<?php echo base_url();?>public/uploads/bglogin.jpg" style="height:180px; object-fit:cover;">
                                                    <div class="top-header-author">
                                                        <div class="author-thumb">
                                                            <img src="<?php echo base_url();?>public/uploads/<?php echo $this->crud->getInfo('logo');?>" style="background-color: #fff; padding:10px;">
                                                        </div>
                                                        <div class="author-content">
                                                            <a href="javascript:void(0);" class="h3 author-name"><?php echo getEduAppGTLang('birthdays');?></a>
                                                            <div class="country"><?php echo $this->crud->getInfo('system_name');?>  |  <?php echo $this->crud->getInfo('system_title');?></div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="profile-section bg-white">
                                                    <div class="control-block-button"></div>
                                                </div>
                                            </div>
                                            <div class="aec-full-message-w">
                                                <div class="aec-full-message">
                                                    <div class="container-fluid" style="background-color: #f2f4f8;"><br>
                                                        <div class="col-sm-12">                           
                                                            <div class="row">
                                                                <?php
                                                                    $ma = '00';
                                                                    for ($i = 1; $i <= 12; $i++):
                                                                    if ($i == 1) {$m = getEduAppGTLang('january'); $ma = '01';}
                                                                    if ($i == 2) {$m = getEduAppGTLang('february'); $ma = '02';}
                                                                    if ($i == 3) {$m = getEduAppGTLang('march'); $ma = '03';}
                                                                    if ($i == 4) {$m = getEduAppGTLang('april'); $ma = '04';}
                                                                    if ($i == 5) {$m = getEduAppGTLang('may'); $ma = '05';}
                                                                    if ($i == 6) {$m = getEduAppGTLang('june'); $ma = '06';}
                                                                    if ($i == 7) {$m = getEduAppGTLang('july'); $ma = '07';}
                                                                    if ($i == 8) {$m = getEduAppGTLang('august'); $ma = '08';}
                                                                    if ($i == 9) {$m = getEduAppGTLang('september'); $ma = '09';}
                                                                    if ($i == 10) {$m = getEduAppGTLang('october'); $ma = '10';}
                                                                    if ($i == 11) {$m = getEduAppGTLang('november'); $ma = '11';}
                                                                    if ($i == 12) {$m = getEduAppGTLang('december');  $ma = '12';}
                                                                ?>
                                                                <div class="col col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                                                    <div class="ui-block" style="background:#99bf2d;">
                                                                        <div class="ui-block-title">
                                                                            <h6 class="title text-white"><?php echo $m; ?></h6>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <?php 
                                                                    $data = $this->crud->get_birthdays_by_month($i);
                                                                    foreach($data as $day):
                                                                ?>
                                                                <div class="col col-xl-4 col-lg-6 col-md-12 col-sm-12 col-12">
                                                                    <div class="ui-block">
                                                                        <div class="birthday-item inline-items">
                                                                            <div class="author-thumb">
                                                                                <img width="35px" src="<?php echo $this->crud->get_image_url($day['type'], $day['user_id']);?>">
                                                                            </div>
                                                                            <div class="birthday-author-name">
                                                                                <a href="javascript:void(0);" class="h6 author-name"><?php echo $this->crud->get_name($day['type'], $day['user_id']);?></a>
                                                                                <div class="birthday-date"><?php echo getEduAppGTLang('birthday');?>: <?php echo $day['birthday'];?></div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <?php endforeach;?>
                                                                <?php endfor; ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>      
                                        </div>    
                                    </div>
                                </div>  
                            </div>
                        </div>
                    </div>
                </div>
               <div class="display-type"></div>
            </div>
        </div>
    </div>