<?php $running_year = $this->crud->getInfo('running_year'); ?>
    <div class="content-w">
        <?php include 'fancy.php';?>
        <div class="header-spacer"></div>
        <div class="conty">
            <div class="os-tabs-w menu-shad">		
		        <div class="os-tabs-controls">		  
        			<ul class="navs navs-tabs upper">			
        				<li class="navs-item">			  
        					<a class="navs-links active" href="<?php echo base_url();?>admin/library/"><i class="os-icon picons-thin-icon-thin-0017_office_archive"></i>
        					<span><?php echo getEduAppGTLang('library');?></span></a>
        				</li>
        				<li class="navs-item">			  
        					<a class="navs-links" href="<?php echo base_url();?>admin/book_request/"><i class="os-icon picons-thin-icon-thin-0086_import_file_load"></i>
        					<span><?php echo getEduAppGTLang('book_request');?></span></a>
        				</li>
        			</ul>		
		        </div>
	        </div>  
            <div class="content-box">
                <div class="row">
                    <div class="col col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12">
		                <div class="ui-block list" data-mh="friend-groups-item" style="">
				            <div class="friend-item friend-groups">
            					<div class="friend-item-content">
            						<div class="friend-avatar">
            						    <br><br>
            						    <i class="picons-thin-icon-thin-0017_office_archive" style="font-size:45px; color: #99bf2d;"></i>
            							<h1 style="font-weight:bold;"><?php echo $this->db->count_all_results('book');?></h1>
            							<div class="author-content">
            								<div class="country"><b> <?php echo getEduAppGTLang('total_books');?></b></div>
            							</div>
            						</div>
            					</div>
				            </div>
			            </div>
		            </div>
		            <div class="col col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12">
			            <div class="ui-block list" data-mh="friend-groups-item">
				            <div class="friend-item friend-groups">
					            <div class="friend-item-content">
						            <div class="friend-avatar">
						            <br><br>
						                <i class="picons-thin-icon-thin-0073_documents_files_paper_text_archive_copy" style="font-size:45px; color: #dd2979;"></i>
							            <h1 style="font-weight:bold;"><?php $t = 0; $total_copies = $this->db->get('book')->result_array(); foreach($total_copies as $r) {$t += $r['total_copies'];} echo $t;?></h1>
							            <div class="author-content">
								            <div class="country"><b><?php echo getEduAppGTLang('total_copies');?></b></div>
							            </div>
						            </div>
					            </div>
				            </div>
			            </div>
		            </div>
		            <div class="col col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12">
			            <div class="ui-block list" data-mh="friend-groups-item" style="">
				            <div class="friend-item friend-groups">
					            <div class="friend-item-content">
						            <div class="friend-avatar">
						                <br><br>
						                <i class="picons-thin-icon-thin-0086_import_file_load" style="font-size:45px; color: #f4af08 ;"></i>
							            <h1 style="font-weight:bold;"><?php $to = 0; $copies =  $this->db->get('book')->result_array(); foreach($copies as $row){$to += $row['issued_copies'];} echo $to;?></h1>
							            <div class="author-content">
								            <div class="country"><b> <?php echo getEduAppGTLang('delivered_copies');?></b></div>
							            </div>
						            </div>
					            </div>
				            </div>
		            	</div>
		            </div>
		        </div>
                <br>
                <div class="tab-content ">
                    <div class="tab-pane active" id="students">
                        <div class="element-wrapper">
                            <h6 class="element-header">
                                <?php echo getEduAppGTLang('library');?>
                                <div style="margin-top:auto;float:right;"><a href="#" data-target="#addroutine" data-toggle="modal" class="btn btn-control btn-grey-lighter btn-success"><i class="picons-thin-icon-thin-0001_compose_write_pencil_new"></i><div class="ripple-container"></div></a></div>
                            </h6>
                            <div class="element-box-tp">
                                <div class="table-responsive">
                                    <table class="table table-padded">
                                        <thead>
                                            <tr>
                                                <th><?php echo getEduAppGTLang('class');?></th>
                    				            <th><?php echo getEduAppGTLang('type');?></th>
                                				<th><?php echo getEduAppGTLang('name');?></th>
                    				            <th><?php echo getEduAppGTLang('author');?></th>
                    				            <th><?php echo getEduAppGTLang('description');?></th>
                    				            <th><?php echo getEduAppGTLang('status');?></th>
                    				            <th><?php echo getEduAppGTLang('price');?></th>
                        				        <th><?php echo getEduAppGTLang('download');?></th>
                    				            <th class="text-center"><?php echo getEduAppGTLang('options');?></th>
			                                </tr>
                                        </thead>
                                        <tbody>
                                        <?php 
                                            $count = 1; 
                                            $this->db->order_by('book_id', 'desc');
        				                    $book = $this->db->get_where('book')->result_array();
			                                foreach($book as $row):?>
			                                <tr>
			                                    <td><a class="btn btn-rounded btn-sm btn-warning" style="color:white"><?php echo $this->db->get_where('class', array('class_id' => $row['class_id']))->row()->name; ?></a></td>
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
                            				    <td class="row-actions">
                                					<a style="color:grey" href="<?php echo base_url();?>admin/update_book/<?php echo $row['book_id'];?>"><i class="picons-thin-icon-thin-0001_compose_write_pencil_new"></i></a>
                            					    <a class="danger" onClick="return confirm('<?php echo getEduAppGTLang('confirm_delete');?>')" href="<?php echo base_url();?>admin/library/delete/<?php echo $row['book_id'];?>"><i class="picons-thin-icon-thin-0056_bin_trash_recycle_delete_garbage_empty"></i></a>
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

    <div class="modal fade" id="addroutine" tabindex="-1" role="dialog" aria-labelledby="addroutine" aria-hidden="true">
        <div class="modal-dialog window-popup edit-my-poll-popup" role="document">
            <div class="modal-content">
                <a href="javascript:void(0);" class="close icon-close" data-dismiss="modal" aria-label="Close"></a>
                <div class="modal-body">
                    <div class="ui-block-title" style="background-color:#00579c">
                        <h6 class="title" style="color:white"><?php echo getEduAppGTLang('add_book');?></h6>
                    </div>
                    <div class="ui-block-content">
                        <?php echo form_open(base_url() . 'admin/library/create' , array('enctype' => 'multipart/form-data'));?>
                            <div class="row">
                                <div class="col col-lg-6 col-md-6 col-sm-12 col-12">
                                    <div class="form-group label-floating is-empty">
                                        <label class="control-label"><?php echo getEduAppGTLang('book');?></label>
                                        <input class="form-control" placeholder="" type="text" name="name">
                                        <span class="material-input"></span>
                                    </div>
                                </div>
                                <div class="col col-lg-6 col-md-6 col-sm-12 col-12">
                                    <div class="form-group label-floating is-empty">
                                        <label class="control-label"><?php echo getEduAppGTLang('author');?></label>
                                        <input class="form-control" type="text" name="author">
                                        <span class="material-input"></span>
                                    </div>
                                </div>
                                <div class="col col-lg-6 col-md-6 col-sm-12 col-12">
                                    <div class="form-group label-floating is-empty">
                                        <label class="control-label"><?php echo getEduAppGTLang('price');?></label>
                                        <input class="form-control" placeholder="" type="text" name="price" required>
                                        <span class="material-input"></span>
                                    </div>
                                </div>
                                <div class="col col-lg-6 col-md-6 col-sm-12 col-12">
                                    <div class="form-group label-floating is-select">
                                        <label class="control-label"><?php echo getEduAppGTLang('class');?></label>
                                        <div class="select">
                                            <select name="class_id" required="">
                                                <option value=""><?php echo getEduAppGTLang('select');?></option>
                                                <?php 
                                                    $cl = $this->db->get('class')->result_array();
                                                    foreach($cl as $row):
                  	                            ?>
                                                    <option value="<?php echo $row['class_id'];?>"><?php echo $row['name'];?></option>
                                                <?php endforeach;?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col col-lg-12 col-md-12 col-sm-12 col-12">
                                    <div class="form-group label-floating is-empty">
                                        <label class="control-label"><?php echo getEduAppGTLang('total_copies');?></label>
                                        <input class="form-control" placeholder="" type="text" name="total_copies">
                                        <span class="material-input"></span>
                                    </div>
                                </div>
                                <div class="col col-lg-12 col-md-12 col-sm-12 col-12">
                                    <div class="form-group label-floating is-empty">
                                        <label class="control-label"><?php echo getEduAppGTLang('description');?></label>
                                        <textarea class="form-control" placeholder="" name="description"></textarea>
                                        <span class="material-input"></span>
                                    </div>
                                </div>
                                <div class="col col-lg-6 col-md-6 col-sm-12 col-12">
                                    <div class="description-toggle">
                                        <div class="description-toggle-content">
                                            <div class="h6"><?php echo getEduAppGTLang('available');?></div>
                                            <p><?php echo getEduAppGTLang('available_message');?></p>
                                        </div>          
                                        <div class="togglebutton">
                                            <label><input name="status" value="1" type="checkbox" checked=""></label>
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
                                            <label><input name="type" value="virtual" type="checkbox"></label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col col-lg-12 col-md-12 col-sm-12 col-12">
                                    <div class="form-group">
                                        <label class="control-label"><?php echo getEduAppGTLang('book');?></label>
                                        <input class="form-control" placeholder="" type="file" name="file_name">
                                        <span class="material-input"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="form-buttons-w text-right">
                                <center><button class="btn btn-rounded btn-success" type="submit"><?php echo getEduAppGTLang('save');?></button></center>
                            </div>
                        <?php echo form_close();?>        
                    </div>
                </div>
            </div>
        </div>
    </div>