<?php $running_year = $this->crud->getInfo('running_year');?>
    <div class="content-w">
        <div class="conty">
            <?php include 'fancy.php';?>
            <div class="header-spacer"></div>
            <div class="os-tabs-w menu-shad">
		        <div class="os-tabs-controls">
		            <ul class="navs navs-tabs upper">
			            <li class="navs-item">
			                <a class="navs-links active" href="<?php echo base_url();?>admin/teacher_attendance/"><i class="os-icon picons-thin-icon-thin-0704_users_profile_group_couple_man_woman"></i><span><?php echo getEduAppGTLang('teacher_attendance');?></span></a>
			            </li>
			            <li class="navs-item">
			                <a class="navs-links" href="<?php echo base_url();?>admin/teacher_attendance_report/"><i class="os-icon os-icon picons-thin-icon-thin-0386_graph_line_chart_statistics"></i><span><?php echo getEduAppGTLang('teacher_attendance_report');?></span></a>
			            </li>
		            </ul>
		        </div>
	        </div>
            <div class="content-i">
                <div class="content-box">
                    <?php echo form_open(base_url() . 'admin/attendance_teacher/', array('class' => 'form m-b'));?>
                        <div class="row">
                            <div class="col-sm-4">
                                <div class="form-group label-floating" style="background:#fff;">
                                    <label class="control-label"><?php echo getEduAppGTLang('date');?></label>
                                    <input type='text' class="datepicker-here" data-position="bottom left" data-language='en' name="timestamp" data-multiple-dates-separator="/" value="<?php echo date("m/d/Y", $timestamp);?>"/>
                                    <span class="material-input"></span>
                                </div>
                            </div>
                            <input type="hidden" name="year" value="<?php echo $running_year;?>">
                            <div class="col-sm-2">
                                <div class="form-group"> <button class="btn btn-rounded btn-primary btn-upper" style="margin-top:20px" type="submit"><span><?php echo getEduAppGTLang('view');?></span></button></div>
                            </div>
                        </div>
                    <?php echo form_close();?>
                    <div class="ui-block">
                        <article class="hentry post thumb-full-width">                
                            <div class="post__author author vcard inline-items">
                                <img src="<?php echo base_url();?>public/uploads/<?php echo $this->db->get_where('settings', array('type' => 'logo'))->row()->description;?>" style="border-radius:0px;">                
                                <div class="author-date">
                                    <a class="h6 post__author-name fn" href="javascript:void(0);"><?php echo getEduAppGTLang('teachers_attendance');?> <small>(<?php echo date("m/d/Y", $timestamp);?>)</small>.</a>
                                </div>                
                            </div>                
                            <div class="edu-posts cta-with-media">
                                <div class="table-responsive">
                                    <?php echo form_open(base_url() . 'admin/attendance_update2/' . $timestamp); ?>
                                        <table class="table table-lightborder">
                                            <thead>
                                                <tr class="bg-primary">
                                                    <th class="text-white"><?php echo getEduAppGTLang('teacher');?></th>
                                                    <th class="text-white" style="text-align: center;"><?php echo getEduAppGTLang('status');?></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            <?php
                                                $count = 1;
                                                $select_id = 0;
                                                $attendance = $this->db->get_where('teacher_attendance', array('year' => $running_year, 'timestamp' => $timestamp))->result_array();
                                                foreach ($attendance as $row):
                                            ?>
                                                <tr>
                                                    <td style="min-width:170px">
                                                        <img alt="" src="<?php echo $this->crud->get_image_url('teacher', $row['teacher_id']);?>" width="25px" style="border-radius: 10px;margin-right:5px;"><?php echo $this->crud->get_name('teacher', $row['teacher_id']);?>
                                                    </td>
                                                    <td style="text-align: center;" nowrap>
                                                        <span class="radio">
                                                            <h6 data-toggle="tooltip" data-placement="top" data-original-title="<?php echo getEduAppGTLang('present');?>">
                                                                <label><input type="radio" <?php if ($row['status'] == 1) echo 'checked'; ?> value="1" name="status_<?php echo $row['attendance_id']; ?>"><span class="circle"></span><span class="check"></span></label>
                                                            </h6>
                                                        </span>
                                                        <span class="radio">
                                                            <h6 data-toggle="tooltip" data-placement="top" data-original-title="<?php echo getEduAppGTLang('late');?>">
                                                                <label><input type="radio" <?php if ($row['status'] == 3) echo 'checked'; ?> value="3" name="status_<?php echo $row['attendance_id']; ?>"><span class="circle"></span><span class="check"></span></label>
                                                            </h6>
                                                        </span>
                                                        <span class="radio">
                                                            <h6 data-toggle="tooltip" data-placement="top" data-original-title="<?php echo getEduAppGTLang('absent');?>">
                                                                <label><input type="radio" value="2" <?php if ($row['status'] == 2) echo 'checked'; ?> name="status_<?php echo $row['attendance_id']; ?>"><span class="circle"></span><span class="check"></span></label>
                                                            </h6>
                                                        </span>
                                                    </td>
                                                </tr>
                                                <?php endforeach;?>
                                            </tbody>
                                        </table>
                                        <div class="form-buttons-w">
                                            <button class="btn btn-success btn-rounded" type="submit"> <?php echo getEduAppGTLang('update');?></button>
                                        </div>
                                    <?php echo form_close();?>
                                </div>
                            </div>
                        </article>
                    </div>
                </div>
            </div>
        </div>
    </div>