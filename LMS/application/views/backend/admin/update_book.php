<?php 
    $details = $book = $this->db->get_where('book', array('book_id' => $book_id))->result_array();
	foreach($details as $row):
 ?>
    <div class="content-w">
        <?php include 'fancy.php';?>
        <div class="header-spacer"></div>
        <div class="conty">
	        <div class="os-tabs-w menu-shad">
		        <div class="os-tabs-controls">
		            <ul class="navs navs-tabs upper">
			            <li class="navs-item">
			                <a class="navs-links active" href="<?php echo base_url();?>admin/library/"><i class="os-icon picons-thin-icon-thin-0017_office_archive"></i><span><?php echo getEduAppGTLang('library');?></span></a>
			            </li>
			            <li class="navs-item">
			                <a class="navs-links" href="<?php echo base_url();?>admin/book_request/"><i class="os-icon picons-thin-icon-thin-0086_import_file_load"></i><span><?php echo getEduAppGTLang('book_request');?></span></a>
			            </li>
		            </ul>
		        </div>
	        </div>
            <div class="content-i">
	            <div class="content-box">
	                <div class="back" style="margin-top:-20px;margin-bottom:10px">		
	                    <a href="<?php echo base_url();?>admin/library/"><i class="picons-thin-icon-thin-0131_arrow_back_undo"></i></a>	
	                </div>
	                <div class="tab-content">
	                    <div class="col-lg-12">
	                        <div class="element-wrapper">
	                            <div class="element-box lined-primary shadow">
		                            <?php echo form_open(base_url() . 'admin/library/update/'.$row['book_id'] , array('enctype' => 'multipart/form-data'));?>
		                                <h5 class="form-header"><?php echo getEduAppGTLang('update_book');?></h5><br>
		                                <div class="row">
		                                    <div class="col col-lg-12 col-md-12 col-sm-12 col-12">
                                                <div class="form-group label-floating">
                                                    <label class="control-label"><?php echo getEduAppGTLang('book');?></label>
                                                    <input class="form-control" placeholder="" value="<?php echo $row['name'];?>" required="" type="text" name="name">
                                                    <span class="material-input"></span>
                                                </div>
                                            </div>
                                            <div class="col col-lg-12 col-md-12 col-sm-12 col-12">
                                                <div class="form-group label-floating">
                                                    <label class="control-label"><?php echo getEduAppGTLang('author');?></label>
                                                    <input class="form-control" placeholder="" value="<?php echo $row['author'];?>" required="" type="text" name="author">
                                                    <span class="material-input"></span>
                                                </div>
                                            </div>
                                            <div class="col col-lg-12 col-md-12 col-sm-12 col-12">
                                                <div class="form-group label-floating">
                                                    <label class="control-label"><?php echo getEduAppGTLang('price');?></label>
                                                    <input class="form-control" placeholder="" type="text" name="price" value="<?php echo $row['price'];?>" required>
                                                    <span class="material-input"></span>
                                                </div>
                                            </div>
                                            <div class="col col-lg-12 col-md-12 col-sm-12 col-12">
                                                <div class="form-group label-floating">
                                                    <label class="control-label"><?php echo getEduAppGTLang('total_copies');?></label>
                                                    <input class="form-control" placeholder="" type="text" name="total_copies" value="<?php echo $row['total_copies'];?>">
                                                    <span class="material-input"></span>
                                                </div>
                                            </div>
                                            <div class="col col-lg-12 col-md-12 col-sm-12 col-12">
                                                <div class="form-group label-floating">
                                                    <label class="control-label"><?php echo getEduAppGTLang('description');?></label>
                                                    <textarea class="form-control" placeholder="" name="description"><?php echo $row['description'];?></textarea>
                                                    <span class="material-input"></span>
                                                </div>
                                            </div>
                                            <div class="col col-lg-12 col-md-12 col-sm-12 col-12">
                                                <div class="form-group label-floating is-select">
                                                    <label class="control-label"><?php echo getEduAppGTLang('class');?></label>
                                                    <div class="select">
                                                        <select name="class_id" required="">
                                                            <option value=""><?php echo getEduAppGTLang('select');?></option>
                                                                <?php $cl = $this->db->get('class')->result_array();
                                                                foreach($cl as $row2):
                  	                                        ?>
                                                            <option value="<?php echo $row2['class_id'];?>" <?php if($row2['class_id'] == $row['class_id']) echo 'selected';?>><?php echo $row2['name'];?></option>
                                                            <?php endforeach;?>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col col-lg-6 col-md-6 col-sm-12 col-12">
                                                <div class="description-toggle">
                                                    <div class="description-toggle-content">
                                                        <div class="h6"><?php echo getEduAppGTLang('available');?></div>
                                                        <p><?php echo getEduAppGTLang('available_message');?></p>
                                                    </div>          
                                                    <div class="togglebutton">
                                                        <label><input name="status" value="1" <?php if($row['status'] == 1) echo 'checked';?> type="checkbox"></label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col col-lg-6 col-md-6 col-sm-12 col-12">
                                                <div class="description-toggle">
                                                    <div class="description-toggle-content">
                                                        <div class="h6"><?php echo getEduAppGTLang('virtual');?></div>
                                                        <p><?php echo getEduAppGTLang('virtual_message');?></p>
                                                    </div>          
                                                    <div class="togglebutton">
                                                        <label><input name="type" value="virtual" <?php if($row['type'] == 'virtual') echo 'checked';?> type="checkbox"></label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col col-lg-12 col-md-12 col-sm-12 col-12">
                                                <div class="form-group">
                                                    <label class="control-label"><?php echo getEduAppGTLang('upload_book');?></label>
                                                    <input class="form-control" placeholder="" type="file" name="file_name">
                                                    <span class="material-input"></span>
                                                </div>
                                            </div>
			                            </div>
		  		                        <div class="form-buttons-w">    
					                        <button class="btn btn-primary btn-rounded" type="submit"> <?php echo getEduAppGTLang('update');?></button>
		  		                        </div>	
		                            <?php echo form_close();?>
	                            </div>
	                        </div>
	                    </div>
	                </div>
                </div>
            </div>
        </div>
    </div>
<?php endforeach;?>