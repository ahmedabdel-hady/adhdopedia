    <div class="content-w">
        <?php include 'fancy.php';?>
	    <div class="header-spacer"></div>
	    <div class="conty">
	        <div class="os-tabs-w menu-shad">
		        <div class="os-tabs-controls">
		            <ul class="navs navs-tabs upper">
			            <li class="navs-item">
			                <a class="navs-links" href="<?php echo base_url();?>admin/academic_settings/"><i class="os-icon picons-thin-icon-thin-0006_book_writing_reading_read_manual"></i><span><?php echo getEduAppGTLang('academic_settings');?></span></a>
			            </li>
			            <li class="navs-item">
			                <a class="navs-links" href="<?php echo base_url();?>admin/section/"><i class="os-icon picons-thin-icon-thin-0002_write_pencil_new_edit"></i><span><?php echo getEduAppGTLang('sections');?></span></a>
			            </li>
                        <li class="navs-item">
                            <a class="navs-links" href="<?php echo base_url();?>admin/grade/"><i class="os-icon picons-thin-icon-thin-0729_student_degree_science_university_school_graduate"></i><span><?php echo getEduAppGTLang('grades'); ?></span></a>
                        </li>
			            <li class="navs-item">
			                <a class="navs-links active" href="<?php echo base_url();?>admin/semesters/"><i class="os-icon picons-thin-icon-thin-0007_book_reading_read_bookmark"></i><span><?php echo getEduAppGTLang('semesters');?></span></a>
			            </li>
			            <li class="navs-item">
			                <a class="navs-links" href="<?php echo base_url();?>admin/student_promotion/"><i class="os-icon picons-thin-icon-thin-0729_student_degree_science_university_school_graduate"></i><span><?php echo getEduAppGTLang('student_promotion');?></span></a>
			            </li>
		            </ul>
		        </div>
	        </div>
            <div class="content-i">
                <div class="content-box">
                    <div style="margin: auto 0;float:right;"><button class="btn btn-success btn-rounded btn-upper" data-target="#new_semester" data-toggle="modal" type="button">+ <?php echo getEduAppGTLang('new_semester');?></button></div><br>
                    <div class="element-wrapper">
                        <h6 class="element-header"><?php echo getEduAppGTLang('semesters');?></h6>
                        <div class="element-box-tp">
                            <div class="table-responsive">
                                <table class="table table-padded">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th><?php echo getEduAppGTLang('name');?></th>
                                            <th><?php echo getEduAppGTLang('options');?></th>
                                        </tr> 
                                    </thead>
                                    <tbody>
                           	            <?php $n = 1; $semesters = $this->db->get('exam')->result_array(); foreach($semesters as $row):?>
                                        <tr>
                                            <td><?php echo $n++;?></td>
                                            <td><span><?php echo $row['name'];?></span></td>
                                            <td class="bolder">
                                                <a onclick="showAjaxModal('<?php echo base_url();?>modal/popup/modal_semester/<?php echo $row['exam_id'];?>');" style="color:grey;" href="javascript:void(0);" data-toggle="tooltip" data-placement="top" data-original-title="<?php echo getEduAppGTLang('edit');?>"><i class="os-icon picons-thin-icon-thin-0001_compose_write_pencil_new"></i></a>
                                                <a style="color:grey;" data-toggle="tooltip" data-placement="top" data-original-title="<?php echo getEduAppGTLang('delete');?>" class="danger" onClick="return confirm('<?php echo getEduAppGTLang('confirm_delete');?>')" href="<?php echo base_url();?>admin/semesters/delete/<?php echo $row['exam_id'];?>"><i class="picons-thin-icon-thin-0056_bin_trash_recycle_delete_garbage_empty"></i></a>
                                            </td>
                                        </tr>
                                        <?php endforeach;?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    
                    <div class="modal fade" id="new_semester" tabindex="-1" role="dialog" aria-labelledby="new_semester" aria-hidden="true" style="top:10%;">
                        <div class="modal-dialog window-popup edit-my-poll-popup" role="document">
                            <div class="modal-content">
                                <a href="javascript:void(0);" class="close icon-close" data-dismiss="modal" aria-label="Close"></a>
                                <div class="modal-body">
                                    <div class="modal-header" style="background-color:#00579c">
                                        <h6 class="title" style="color:white"><?php echo getEduAppGTLang('new_semester');?></h6>
                                    </div>
                                    <div class="ui-block-content">
                                        <form action="<?php echo base_url();?>admin/semesters/create" enctype="multipart/form-data" method="post" accept-charset="utf-8">
                                            <div class="row">
                                                <div class="col col-lg-12 col-md-12 col-sm-12 col-12">
                                                    <div class="form-group label-floating">
                                                        <label class="control-label"><?php echo getEduAppGTLang('name');?></label>
                                                        <input class="form-control" type="text" name="name" required="">
                                                    </div>
                                                </div>
                                                <div class="col col-lg-6 col-md-6 col-sm-12 col-12">
                                                    <button class="btn btn-rounded btn-success" type="submit"><?php echo getEduAppGTLang('save');?></button>
                                                </div>
                                            </div>
                                        </form>          
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>