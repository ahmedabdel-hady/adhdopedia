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
                            <a class="navs-links active" href="<?php echo base_url();?>admin/students_payments/"><i class="os-icon picons-thin-icon-thin-0426_money_payment_dollars_coins_cash"></i><span><?php echo getEduAppGTLang('payments');?></span></a>
                        </li>
                        <li class="navs-item">
                            <a class="navs-links" href="<?php echo base_url();?>admin/expense/"><i class="os-icon picons-thin-icon-thin-0420_money_cash_coins_payment_dollars"></i><span><?php echo getEduAppGTLang('expense');?></span></a>
                        </li>
                    </ul>
                </div>
            </div><br>
            <div class="content-i"> 
                <div class="content-box">
	                <div class="element-wrapper">
		                <div class="tab-content">
		                    <div class="tab-pane active" id="invoices">
		                        <a class="btn btn-rounded btn-success text-white" href="<?php echo base_url();?>admin/new_payment/"><?php echo getEduAppGTLang('new_payment');?></a><br><br>
		                        <div class="element-wrapper">
                                    <div class="element-box-tp">
                                        <div class="table-responsive">
                                            <table class="table table-padded">
                                                <thead>
                                                    <tr>
                                                        <th><?php echo getEduAppGTLang('status');?></th>
                                                        <th><?php echo getEduAppGTLang('student');?></th>
                                                        <th><?php echo getEduAppGTLang('class');?></th>
                                                        <th><?php echo getEduAppGTLang('title');?></th>
                                                        <th><?php echo getEduAppGTLang('amount');?></th>
                                                        <th><?php echo getEduAppGTLang('date');?></th>
                                                        <th><?php echo getEduAppGTLang('options');?></th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                <?php
                                                    $count = 1;
                                                    $this->db->where('year' , $running_year);
                                                    $this->db->order_by('invoice_id' , 'desc');
                                                    $invoices = $this->db->get('invoice')->result_array();
                                                    foreach($invoices as $row): ?>
                                                    <tr>
                                                        <td>
                                                          <?php if($row['status'] == 'pending'):?>
                                                            <span class="status-pill yellow"></span><span><?php echo getEduAppGTLang('pending');?></span>
                                                          <?php endif;?>
                                                          <?php if($row['status'] == 'completed'):?>
                                                            <span class="status-pill green"></span><span><?php echo getEduAppGTLang('paid');?></span>
                                                          <?php endif;?>
                                                        </td>
                                                        <td class="cell-with-media">
                                                            <img alt="" src="<?php echo $this->crud->get_image_url('student', $row['student_id']);?>" style="height: 25px;"><span> <?php echo $this->crud->get_name('student', $row['student_id']);?></span>
                                                        </td>
                                                        <td><?php echo $this->crud->get_type_name_by_id('class',$row['class_id']);?></td>
                                                        <td><?php echo $row['title'];?></td>
                                                        <td><a class="badge badge-primary" href="javascript:void(0);"><?php echo $this->db->get_where('settings' , array('type'=>'currency'))->row()->description; ?><?php echo $row['amount'];?></a></td>
                                                        <td><span><?php echo $row['creation_timestamp'];?></span></td>
                                                        <td class="bolder">
                                                            <a href="<?php echo base_url();?>admin/invoice_details/<?php echo $row['invoice_id'];?>/" style="color:grey;"><i style="font-size:20px;" class="picons-thin-icon-thin-0424_money_payment_dollar_cash" data-toggle="tooltip" data-placement="top" data-original-title="<?php echo getEduAppGTLang('view_invoice');?>"></i></a>
                                                            <a href="javascript:void(0);" onclick="showAjaxModal('<?php echo base_url();?>modal/popup/modal_invoice/<?php echo $row['invoice_id'];?>');" style="color:grey;"><i style="font-size:20px;" class="picons-thin-icon-thin-0001_compose_write_pencil_new" data-toggle="tooltip" data-placement="top" data-original-title="<?php echo getEduAppGTLang('edit');?>"></i></a>
                                                            <a  onClick="return confirm('<?php echo getEduAppGTLang('confirm_delete');?>')" href="<?php echo base_url();?>admin/invoice/delete/<?php echo $row['invoice_id'];?>" style="color:grey;"><i style="font-size:20px;" class="picons-thin-icon-thin-0057_bin_trash_recycle_delete_garbage_full" data-toggle="tooltip" data-placement="top" data-original-title="<?php echo getEduAppGTLang('delete');?>"></i></a>
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