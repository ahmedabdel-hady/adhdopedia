<?php $running_year = $this->crud->getInfo('running_year'); ?>
    <div class="content-w">
        <?php include 'fancy.php';?>
        <div class="header-spacer"></div>
        <div class="conty">
            <div class="ae-content-w" style="background-color: #f2f4f8;">
                <div class="top-header top-header-favorit">
                    <div class="top-header-thumb">
                        <img src="<?php echo base_url();?>public/uploads/bglogin.jpg" style="height:180px; object-fit:cover;">
                        <div class="top-header-author">
                            <div class="author-thumb">
                                <img src="<?php echo base_url();?>public/uploads/<?php echo $this->crud->getInfo('logo');?>" style="background-color: #fff; padding:10px;">
                            </div>
                            <div class="author-content">
                                <a href="javascript:void(0);" class="h3 author-name"><?php echo getEduAppGTLang('library');?></a>
                                <div class="country"><?php echo $this->crud->getInfo('system_name');?>  |  <?php echo $this->crud->getInfo('system_title');?></div>
                            </div>
                        </div>
                    </div>
                    <div class="profile-section" style="background-color: #fff;">
                        <div class="control-block-button"></div>
                    </div>
                </div>
            </div>
            <div class="content-box">
                <br>
                <?php echo form_open(base_url() . 'teacher/library/', array('class' => 'form m-b'));?>
		            <div class="row">
		                <div class="col col-lg-6 col-md-6 col-sm-12 col-12">
                            <div class="form-group label-floating is-select">
                                <label class="control-label"><?php echo getEduAppGTLang('filter_by_class');?></label>
                                <div class="select">
                                    <select onchange="submit();" name="class_id" onchange="submit();">
                                        <option value=""><?php echo getEduAppGTLang('select');?></option>
                                        <?php $cl = $this->db->get('class')->result_array();
                                            foreach($cl as $row):
                  	                    ?>      
                                        <option value="<?php echo $row['class_id'];?>" <?php if($id == $row['class_id']) echo 'selected';?>><?php echo $row['name'];?></option>
                                        <?php endforeach;?>
                                    </select>
                                </div>
                            </div>
                        </div>
		            </div>
		        <?php echo form_close();?>
                <div class="tab-content ">
                    <div class="tab-pane active" id="students">
                        <div class="element-wrapper">
                            <h6 class="element-header"><?php echo getEduAppGTLang('library');?></h6>
                            <div class="element-box-tp">
                                <div class="table-responsive">
                                    <table class="table table-padded">
                                        <thead>
                                            <tr>
				                                <th><?php echo getEduAppGTLang('type');?></th>
                    				            <th><?php echo getEduAppGTLang('name');?></th>
                    				            <th><?php echo getEduAppGTLang('author');?></th>
                    				            <th><?php echo getEduAppGTLang('description');?></th>
                    				            <th><?php echo getEduAppGTLang('status');?></th>
                    				            <th><?php echo getEduAppGTLang('price');?></th>
                    				            <th><?php echo getEduAppGTLang('download');?></th>
			                                </tr>
                                        </thead>
                                        <tbody>
                                        <?php 
                                            $count = 1; 
				                            $book = $this->db->get_where('book', array('class_id' => $id))->result_array();
			                                foreach($book as $row):
			                            ?>
			                                <tr>
				                                <td>
                                				<?php if($row['type'] == 'virtual'):?>
                                					<a class="btn btn-rounded btn-sm btn-purple" style="color:white"><?php echo getEduAppGTLang('virtual');?></a>
                                				<?php else:?>
                                					<a class="btn btn-rounded btn-sm btn-info" style="color:white"><?php echo getEduAppGTLang('normal');?></a>
                                				<?php endif;?>
                                				</td>
                                				<td><?php echo $row['name'];?></td>
                                				<td><?php echo $row['author'];?></td>
                                				<td><?php echo $row['description'];?></td>
                                				<td>
                                				<?php if($row['status'] == 2):?>
                                					<div class="status-pill red" data-title="<?php echo getEduAppGTLang('unavailable');?>" data-toggle="tooltip"></div>
                                				<?php endif;?>
                                				<?php if($row['status'] == 1):?>
                                					<div class="status-pill green" data-title="<?php echo getEduAppGTLang('available');?>" data-toggle="tooltip"></div>
                                				<?php endif;?>
                                				</td>
                                				<td><a class="btn btn-rounded btn-sm btn-success" style="color:white"><?php echo $this->db->get_where('settings', array('type' => 'currency'))->row()->description;?><?php echo $row['price'];?></a></td>
                                				<td style="color:grey">
                                				<?php if($row['type'] == 'virtual' && $row['file_name'] != ""):?>
                                					<a class="btn btn-rounded btn-sm btn-primary" style="color:white" href="<?php echo base_url();?>public/uploads/library/<?php echo $row['file_name'];?>"><i class="picons-thin-icon-thin-0042_attachment"></i> <?php echo getEduAppGTLang('download');?></a>
                                				<?php else:?>
                                					<?php echo getEduAppGTLang('no_downloaded');?>
                                				<?php endif;?>
				                                </td>
			                                </tr>
			                            <?php endforeach;?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>      
        </div>
        <div class="display-type"></div>
    </div>