<?php $running_year = $this->crud->getInfo('running_year');?>
    <div class="content-w">
        <?php include 'fancy.php';?>
        <div class="header-spacer"></div>
        <div class="conty">
            <div class="content-i">
                <div class="content-box">
        	        <div class="os-tabs-w">
			            <div class="os-tabs-controls">
			                <ul class="navs navs-tabs upper">
			  	                <?php 
			  	                    $n = 1;
			  	                    $children_of_parent = $this->db->get_where('student' , array('parent_id' => $this->session->userdata('parent_id')))->result_array();
                                    foreach ($children_of_parent as $row):
                                ?>
                                <li class="navs-item">
                        	        <?php $active = $n++;?>
				  		            <a class="navs-links <?php if($active == 1) echo 'active';?>" data-toggle="tab" href="#<?php echo $row['username'];?>"><img alt="" src="<?php echo $this->crud->get_image_url('student', $row['student_id']);?>" width="25px" style="border-radius: 25px;margin-right:5px;"> <?php echo $this->crud->get_name('student', $row['student_id']);?></a>
					            </li>
                                <?php endforeach; ?>
			                </ul>
			            </div>
		            </div>
                    <div class="tab-content">
                        <?php 
			                $n = 1;
			                $children_of_parent = $this->db->get_where('student' , array('parent_id' => $this->session->userdata('parent_id')))->result_array();
                            foreach ($children_of_parent as $row3):
                            $class_id = $this->db->get_where('enroll' , array('student_id' => $row3['student_id'] , 'year' => $running_year))->row()->class_id;
	    	                $section_id = $this->db->get_where('enroll' , array('student_id' => $row3['student_id'] , 'year' => $running_year))->row()->section_id;
                        ?>
        	            <?php $active = $n++;?>
	 		            <div class="tab-pane <?php if($active == 1) echo 'active';?>" id="<?php echo $row3['username'];?>">
                            <div class="element-wrapper">
                                <h6 class="element-header"><?php echo getEduAppGTLang('invoices');?></h6>
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
                                            <?php 
                                                $invoices = $this->db->get_where('invoice' , array('student_id' => $row3['student_id']))->result_array();
               	                                foreach($invoices as $row2):
                                            ?>
				                                <tr>
					                                <td><img alt="" src="<?php echo $this->crud->get_image_url('student', $row2['student_id']);?>" width="25px" style="border-radius: 10px;margin-right:5px;"> <?php echo $this->crud->get_name('student', $row2['student_id']);?></td>
					                                <td><?php echo $row2['title'];?></td>
					                                <td class="text-center"><strong><?php echo $this->crud->getInfo('currency');?><?php echo $row2['amount'];?></strong></td>
					                                <td class="text-center"><?php if($row2['status'] == 'completed'):?>
						                                <div class="status-pill green" data-title="Pagado" data-toggle="tooltip"></div>
					                                    <?php endif;?>
					                                    <?php if($row2['status'] == 'pending'):?>
						                                <div class="status-pill red" data-title="Sin pagar" data-toggle="tooltip"></div>
					                                    <?php endif;?>
					                                </td>
					                                <td><a class="btn nc btn-rounded btn-sm btn-secondary" style="color:white"><?php echo $row2['creation_timestamp'];?></a></td>
					                                <td><a class="btn btn-rounded btn-primary" style="color:white" href="<?php echo base_url();?>parents/view_invoice/<?php echo $row2['invoice_id'];?>"><i class="picons-thin-icon-thin-0406_money_dollar_euro_currency_exchange_cash"></i> <?php echo getEduAppGTLang('invoice');?></a></td>
					                                <td>
					                                    <?php echo form_open(base_url() . 'parents/invoice/' . $row2['student_id'] . '/make_payment', array('enctype' => 'multipart/form-data'));?>					
                                                            <input type="hidden" name="invoice_id" value="<?php echo $row2['invoice_id'];?>" />
                                                            <button type="submit" class="btn btn-rounded btn-success" <?php if($row2['status'] == 'completed'):?> disabled="disabled"<?php endif;?>>
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
                        <?php endforeach;?>
                    </div>
                </div>
            </div>
        </div>
    </div>