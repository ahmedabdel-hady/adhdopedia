    <div class="content-w">
        <?php include 'fancy.php';?>
        <div class="header-spacer"></div>
        <div class="conty">
            <div class="content-i">
                <div class="content-box">
                    <div class="element-wrapper">
                        <h6 class="element-header"><?php echo getEduAppGTLang('payments');?></h6>
                        <div class="element-box-tp">
                            <div class="table-responsive">
                                <table class="table table-padded">
                                    <thead>
                                        <tr>
				                            <th><?php echo getEduAppGTLang('student');?></th>
				                            <th><?php echo getEduAppGTLang('title');?></th>
				                            <th class="text-center"><?php echo getEduAppGTLang('amount');?></th>
				                            <th class="text-center"><?php echo getEduAppGTLang('status');?></th>
				                            <th><?php echo getEduAppGTLang('date');?></th>
				                            <th><?php echo getEduAppGTLang('invoice');?></th>
				                            <th><?php echo getEduAppGTLang('make_payment');?></th>
			                            </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach($invoices as $row):?>
				                        <tr>
					                        <td><img alt="" src="<?php echo $this->crud->get_image_url('student', $this->session->userdata('login_user_id'));?>" width="25px" style="border-radius: 10px;margin-right:5px;"> <?php echo $this->crud->get_name('student', $row['student_id']);?></td>
					                        <td><?php echo $row['title'];?></td>
					                        <td class="text-center"><strong><?php echo $this->db->get_where('settings' , array('type' =>'currency'))->row()->description;?><?php echo $row['amount'];?></strong></td>
					                        <td class="text-center"><?php if($row['status'] == 'completed'):?>
						                        <div class="status-pill green" data-title="<?php echo getEduAppGTLang('paid');?>" data-toggle="tooltip"></div>
					                            <?php endif;?>
					                            <?php if($row['status'] == 'pending'):?>
						                        <div class="status-pill red" data-title="<?php echo getEduAppGTLang('pending');?>" data-toggle="tooltip"></div>
					                            <?php endif;?>
					                        </td> 
					                        <td><a class="btn nc btn-rounded btn-sm btn-secondary" style="color:white"><?php echo $row['creation_timestamp'];?></a></td>
					                        <td><a class="btn btn-rounded btn-primary" style="color:white" href="<?php echo base_url();?>student/view_invoice/<?php echo $row['invoice_id'];?>"><i class="picons-thin-icon-thin-0406_money_dollar_euro_currency_exchange_cash"></i> <?php echo getEduAppGTLang('invoice');?></a></td>
					                        <td>
					                            <?php echo form_open(base_url() . 'student/invoice/make_payment', array('enctype' => 'multipart/form-data'));?>					
                                                    <input type="hidden" name="invoice_id" value="<?php echo $row['invoice_id'];?>" />
                                                    <button type="submit" class="btn btn-rounded btn-success" <?php if($row['status'] == 'completed'):?> disabled="disabled"<?php endif;?>>
                                                        <i class="picons-thin-icon-thin-0424_money_payment_dollar_cash"></i> <?php echo getEduAppGTLang('pay_with_paypal');?>
                                                    </button>
                                                <?php echo form_close();?>
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