    <?php $running_year = $this->crud->getInfo('running_year'); ?>
    <div class="content-w">
	    <?php include 'fancy.php';?>
        <div class="header-spacer"></div>
        <div class="conty">
            <div class="os-tabs-w menu-shad">
                <div class="os-tabs-controls">
                    <ul class="navs navs-tabs upper">
                        <li class="navs-item">
                            <a class="navs-links" href="<?php echo base_url();?>admin/payments/"><i class="os-icon picons-thin-icon-thin-0482_gauge_dashboard_empty"></i><span><?php echo getEduAppGTLang('home');?></span></a>
                        </li>
                        <li class="navs-item">
                            <a class="navs-links" href="<?php echo base_url();?>admin/students_payments/"><i class="os-icon picons-thin-icon-thin-0426_money_payment_dollars_coins_cash"></i><span><?php echo getEduAppGTLang('payments');?></span></a>
                        </li>
                        <li class="navs-item">
                            <a class="navs-links active" href="<?php echo base_url();?>admin/expense/"><i class="os-icon picons-thin-icon-thin-0420_money_cash_coins_payment_dollars"></i><span><?php echo getEduAppGTLang('expense');?></span></a>
                        </li>
                    </ul>
                </div>
            </div><br>
            <div class="content-i"> 
                <div class="content-box">
	                <div class="element-wrapper">
		                <div class="os-tabs-w">
			                <div class="os-tabs-controls">
			                    <ul class="navs navs-tabs upper">
				                    <li class="navs-item">
				                        <a class="navs-links active" data-toggle="tab" href="#expenses"><?php echo getEduAppGTLang('expenses');?></a>
				                    </li>
				                    <li class="navs-item">
				                        <a class="navs-links" data-toggle="tab" href="#categories"><?php echo getEduAppGTLang('categories');?></a>
                    				</li>   
			                    </ul>
			                </div>
		                </div>
		                <div class="tab-content">
		                    <div class="tab-pane active" id="expenses">
		                        <div style="margin: auto 0;float:right;"><button class="btn btn-success btn-rounded btn-upper" data-target="#new_expense" data-toggle="modal" type="button">+ <?php echo getEduAppGTLang('new_expense');?></button></div><br>
                                    <div class="element-wrapper">
                                        <h6 class="element-header"><?php echo getEduAppGTLang('expenses');?></h6>
                                        <div class="element-box-tp">
                                            <div class="table-responsive">
                                                <table class="table table-padded">
                                                    <thead>
                                                        <tr>
                                                            <th><?php echo getEduAppGTLang('title');?></th>
                                                            <th><?php echo getEduAppGTLang('description');?></th>
                                                            <th><?php echo getEduAppGTLang('category');?></th>
                                                            <th><?php echo getEduAppGTLang('amount');?></th>
                                                            <th><?php echo getEduAppGTLang('method');?></th>
                                                            <th><?php echo getEduAppGTLang('date');?></th>
                                                            <th><?php echo getEduAppGTLang('options');?></th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                    <?php 
            	                                        $count = 1;
            	                                        $this->db->where('payment_type' , 'expense');
                                        	            $this->db->where('year' , $running_year);
                                                    	$this->db->order_by('timestamp' , 'desc');
                                        	            $expenses = $this->db->get('payment')->result_array();
                                        	            foreach ($expenses as $row):
        	                                        ?>
                                                        <tr>
                                                            <td><?php echo $row['title'];?></td>
                                                            <td><?php echo $row['description'];?></td>
                                                            <td><a class="btn btn-sm btn-rounded btn-purple text-white">
                                                            <?php 
                                                                if ($row['expense_category_id'] != 0 || $row['expense_category_id'] != '')
                                                                echo $this->db->get_where('expense_category' , array('expense_category_id' => $row['expense_category_id']))->row()->name;
                                                            ?></a>
                                                            </td>
                                                            <td><?php echo $this->db->get_where('settings' , array('type' =>'currency'))->row()->description;?><?php echo $row['amount'];?></td>
                                                            <td><a class="btn nc btn-rounded btn-sm btn-primary" style="color:white"><?php 
                                                                if ($row['method'] == 1) echo getEduAppGTLang('cash');
                                                                if ($row['method'] == 2) echo getEduAppGTLang('check');
                                                                if ($row['method'] == 3) echo getEduAppGTLang('card');
                                                            ?></a></td>
                                                            <td><span><?php echo $row['timestamp'];?></span></td>
                                                            <td class="bolder">
                                                                <a href="javascript:void(0);" onclick="showAjaxModal('<?php echo base_url();?>modal/popup/modal_edit_expense/<?php echo $row['payment_id'];?>');" style="color:grey;"><i style="font-size:20px;" class="picons-thin-icon-thin-0001_compose_write_pencil_new" data-toggle="tooltip" data-placement="top" data-original-title="<?php echo getEduAppGTLang('edit');?>"></i></a>
                                                                <a  onClick="return confirm('<?php echo getEduAppGTLang('confirm_delete');?>')" href="<?php echo base_url();?>admin/expense/delete/<?php echo $row['payment_id'];?>" style="color:grey;"><i style="font-size:20px;" class="picons-thin-icon-thin-0057_bin_trash_recycle_delete_garbage_full" data-toggle="tooltip" data-placement="top" data-original-title="<?php echo getEduAppGTLang('delete');?>"></i></a>
                                                            </td>
                                                        </tr>
                                                    <?php endforeach;?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
		                        <div class="tab-pane" id="categories">
            		                <div style="margin: auto 0;float:right;"><button class="btn btn-success btn-rounded btn-upper" data-target="#addcategory" data-toggle="modal" type="button">+ <?php echo getEduAppGTLang('new_category');?></button></div><br>
            		                    <div class="element-wrapper">
            		                        <h6 class="element-header"><?php echo getEduAppGTLang('categories');?></h6>
                                            <div class="element-box-tp">
                                                <div class="table-responsive">
                                                    <table class="table table-padded">
                                                        <thead>
                                                            <tr>
                                                                <th><?php echo getEduAppGTLang('category');?></th>
                                                                <th><?php echo getEduAppGTLang('options');?></th>
                                                            </tr>
                                                    </thead>
                                                    <tbody>
                                                    <?php 
                                	                    $expenses = $this->db->get('expense_category')->result_array();
                                            	       foreach ($expenses as $row):
                    	                           ?>
                                                    <tr>
                                                        <td><a class="badge badge-primary" href="javascript:void(0);"><?php echo $row['name']; ?><?php echo $row['amount'];?></a></td>
                                                        <td>
            						                        <a href="javascript:void(0);" style="color:grey" onclick="showAjaxModal('<?php echo base_url();?>modal/popup/modal_expense_category/<?php echo $row['expense_category_id'];?>');"><i class="picons-thin-icon-thin-0001_compose_write_pencil_new"></i></a>
            						                        <a class="danger" style="color:grey" onClick="return confirm('<?php echo getEduAppGTLang('confirm_delete');?>')" href="<?php echo base_url();?>admin/expense_category/delete/<?php echo $row['expense_category_id'];?>"><i class="picons-thin-icon-thin-0056_bin_trash_recycle_delete_garbage_empty"></i></a>
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
            </div>
        </div>
    </div>

    <div class="modal fade" id="addcategory" tabindex="-1" role="dialog" aria-labelledby="addcategory" aria-hidden="true">
        <div class="modal-dialog window-popup create-friend-group create-friend-group-1" role="document">
            <div class="modal-content">
                <?php echo form_open(base_url() . 'admin/expense_category/create/');?>
                    <a href="javascript:void(0);" class="close icon-close" data-dismiss="modal" aria-label="Close"></a>
                    <div class="modal-header">
                        <h6 class="title"><?php echo getEduAppGTLang('add_category');?></h6>
                    </div>
                    <div class="modal-body">
                        <div class="form-group with-button">
                            <input class="form-control" type="text" name="name" required="" placeholder="<?php echo getEduAppGTLang('name');?>">
                        </div>
                        <button type="submit" class="btn btn-rounded btn-success btn-lg full-width"><?php echo getEduAppGTLang('save');?></button>
                    </div>    
                <?php echo form_close();?>
            </div>
        </div>
    </div>

    <div class="modal fade" id="new_expense" tabindex="-1" role="dialog" aria-labelledby="new_expense" aria-hidden="true">
        <div class="modal-dialog window-popup create-friend-group create-friend-group-1" role="document">
            <div class="modal-content">
                <?php echo form_open(base_url() . 'admin/expense/create/');?>
                    <a href="#" class="close icon-close" data-dismiss="modal" aria-label="Close"></a>
                    <div class="modal-header">
                        <h6 class="title"><?php echo getEduAppGTLang('add_expense');?></h6>
                    </div>
                    <div class="modal-body">
                        <div class="form-group with-button">
                            <input type='text' class="datepicker-here" data-position="bottom left" data-language='en' name="timestamp" data-multiple-dates-separator="/" placeholder="<?php echo getEduAppGTLang('date');?>"/>
                        </div>
                        <div class="form-group with-button">
                            <input class="form-control" type="text" name="title" placeholder="<?php echo getEduAppGTLang('title');?>" required="">
                        </div>
                        <div class="form-group label-floating is-select">
                            <label class="control-label"><?php echo getEduAppGTLang('category');?></label>
                            <div class="select">
                                <select name="expense_category_id" required="">
                                    <option value=""><?php echo getEduAppGTLang('select');?></option>
                                    <?php 
						                $categories = $this->db->get('expense_category')->result_array();
                                        foreach ($categories as $row):
                                    ?>
                    	                <option value="<?php echo $row['expense_category_id'];?>"><?php echo $row['name'];?></option>
                                    <?php endforeach;?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group with-button">
                            <textarea class="form-control" name="description" placeholder="<?php echo getEduAppGTLang('description');?>" required=""></textarea>
                        </div>
                        <div class="form-group with-button">
                            <input class="form-control" type="text" name="amount" placeholder="<?php echo getEduAppGTLang('amount');?>" required="">
                        </div>
                        <div class="form-group label-floating is-select">
                            <label class="control-label"><?php echo getEduAppGTLang('method');?></label>
                            <div class="select">
                                <select name="method" required="">
                                    <option value="1"><?php echo getEduAppGTLang('cash');?></option>
                                    <option value="2"><?php echo getEduAppGTLang('check');?></option>
                                    <option value="3"><?php echo getEduAppGTLang('card');?></option>
                                </select>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-rounded btn-success btn-lg full-width"><?php echo getEduAppGTLang('save');?></button>
                    </div>
                <?php echo form_close();?>
            </div>
        </div>
    </div>