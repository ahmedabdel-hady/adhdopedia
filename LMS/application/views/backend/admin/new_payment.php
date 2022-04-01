<?php $running_year = $this->db->get_where('settings' , array('type' => 'running_year'))->row()->description; ?>
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
		                <div class="os-tabs-w">
			                <div class="os-tabs-controls">
			                    <ul class="navs navs-tabs upper">
				                    <li class="navs-item">
				                        <a class="navs-links active" data-toggle="tab" href="#single"><?php echo getEduAppGTLang('single_invoice');?></a>
				                    </li>
				                    <li class="navs-item">
				                        <a class="navs-links" data-toggle="tab" href="#bulk"><?php echo getEduAppGTLang('bulk_invoice');?></a>
				                    </li>
			                    </ul>
			                </div>
		                </div>
		                <div class="tab-content">
			                <div class="tab-pane active" id="single">
			                    <div class="row">
			                        <div class="col-sm-6">
		                                <?php echo form_open(base_url() . 'admin/invoice/create');?>
                                            <div class="element-box lined-primary shadow">
		                                        <h5 class="form-header"><?php echo getEduAppGTLang('invoice_details');?></h5><br>
		                                        <div class="row">
		                                            <div class="col col-lg-12 col-md-12 col-sm-12 col-12">
                                                        <div class="form-group label-floating is-select">
                                                            <label class="control-label"><?php echo getEduAppGTLang('class');?></label>
                                                            <div class="select">
                                                                <select name="class_id" required="" onchange="get_class_sections(this.value)">
                                                                    <option value=""><?php echo getEduAppGTLang('select');?></option>
                                                                <?php 
                                                                    $classes = $this->db->get('class')->result_array();
                                                                    foreach ($classes as $row):
                                                                ?>
                                                                    <option value="<?php echo $row['class_id'];?>"><?php echo $row['name'];?></option>
                                                                <?php endforeach;?>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col col-lg-12 col-md-12 col-sm-12 col-12">
            							                <div class="form-group label-floating is-select">
                                                            <label class="control-label"><?php echo getEduAppGTLang('section');?></label>
                                                            <div class="select">
            		  								            <select name="section_id" required id="section_holder" onchange="return get_class_students(this.value)">
                        								            <option value=""><?php echo getEduAppGTLang('select');?></option>
            										            </select>
                                                            </div>
                                                        </div>
            							            </div>
                                                    <div class="col col-lg-12 col-md-12 col-sm-12 col-12">
                                                        <div class="form-group label-floating is-select">
                                                            <label class="control-label"><?php echo getEduAppGTLang('student');?></label>
                                                            <div class="select">
                                                                <select name="student_id" required="" id="student_selection_holder">
                                                                    <option value=""><?php echo getEduAppGTLang('select');?></option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
		                                            <div class="col col-lg-12 col-md-12 col-sm-12 col-12">
                                                        <div class="form-group label-floating">
                                                          	<label class="control-label"><?php echo getEduAppGTLang('title');?></label>
                                                          	<input class="form-control" name="title" type="text" required="">
                                                        </div>
                                                    </div>
		                                            <div class="col col-lg-12 col-md-12 col-sm-12 col-12">
				                                        <div class="form-group label-floating is-empty">
				                                            <label class="control-label"><?php echo getEduAppGTLang('description');?>:</label>
				                                            <textarea class="form-control" name="description" rows="3" required=""></textarea>
				                                            <span class="material-input"></span>
				                                        </div>
			                                        </div>
		                                        </div>
		                                    </div>
		                                </div>
		                                <div class="col-sm-6">
                                            <div class="element-box lined-success shadow">
		                                        <h5 class="form-header"><?php echo getEduAppGTLang('payment_details');?></h5><br>
    		                                    <div class="row">
		                                            <div class="col col-lg-12 col-md-12 col-sm-12 col-12">
                                                        <div class="form-group label-floating">
                                                          	<label class="control-label"><?php echo getEduAppGTLang('amount');?></label>
                                                      	    <input class="form-control" name="amount" type="text" required="">
                                                        </div>
                                                    </div>
		                                            <div class="col col-lg-12 col-md-12 col-sm-12 col-12">
                                                        <div class="form-group label-floating is-select">
                                                            <label class="control-label"><?php echo getEduAppGTLang('status');?></label>
                                                            <div class="select">
                                                                <select name="status" required="">
                                                                    <option value=""><?php echo getEduAppGTLang('select');?></option>
                                                                    <option value="completed"><?php echo getEduAppGTLang('completed');?></option>
					                                                <option value="pending"><?php echo getEduAppGTLang('pending');?></option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col col-lg-12 col-md-12 col-sm-12 col-12">
                                                        <div class="form-group label-floating is-select">
                                                            <label class="control-label"><?php echo getEduAppGTLang('method');?></label>
                                                            <div class="select">
                                                                <select name="method" required="">
                                                                    <option value=""><?php echo getEduAppGTLang('select');?></option>
                                                                    <option value="3"><?php echo getEduAppGTLang('card');?></option>
                                        					        <option value="1"><?php echo getEduAppGTLang('cash');?></option>
                                        					        <option value="2"><?php echo getEduAppGTLang('check');?></option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div><br>
		                                            <div class="col col-lg-12 col-md-12 col-sm-12 col-12">
                                                        <button class="btn btn-success btn-rounded" type="submit"><?php echo getEduAppGTLang('create_invoice');?></button>
                                                    </div>
                                                </div>
		                                    </div>
		                                <?php echo form_close();?>
		                            </div>
	                            </div>
          	                </div>
		  	                <div class="tab-pane" id="bulk">
		  		                <?php echo form_open(base_url() . 'admin/invoice/bulk', array('class' => 'form-horizontal form-groups-bordered validate', 'id'=> 'mass' ,'target'=>'_top'));?>
		  	                        <div class="row">
			                            <div class="col-sm-6">
                                            <div class="element-box lined-primary shadow">
		                                        <h5 class="form-header"><?php echo getEduAppGTLang('payment_details');?></h5><br>
		                                        <div class="row">
                                        		    <div class="col col-lg-12 col-md-12 col-sm-12 col-12">
                                                        <div class="form-group label-floating is-select">
                                                            <label class="control-label"><?php echo getEduAppGTLang('class');?></label>
                                                            <div class="select">
                                                                <select name="class_id" required="" class="class_id" onchange="return get_class_students_mass(this.value)">
                                                                    <option value=""><?php echo getEduAppGTLang('select');?></option>
                                                                    <?php 
                                                                        $classes = $this->db->get('class')->result_array();
                                                                        foreach ($classes as $row):
                                                                    ?>
                                                                        <option value="<?php echo $row['class_id'];?>"><?php echo $row['name'];?></option>
                                                                    <?php endforeach;?>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col col-lg-12 col-md-12 col-sm-12 col-12">
                                                        <div class="form-group label-floating">
                                                            <label class="control-label"><?php echo getEduAppGTLang('amount');?></label>
                                                          	<input class="form-control" name="amount" type="text" required="">
                                                        </div>
                                                    </div>
                                        		    <div class="col col-lg-12 col-md-12 col-sm-12 col-12">
                                                        <div class="form-group label-floating">
                                                          	<label class="control-label"><?php echo getEduAppGTLang('title');?></label>
                                                          	<input class="form-control" name="title" type="text" required="">
                                                        </div>
                                                    </div>
                                        		    <div class="col col-lg-12 col-md-12 col-sm-12 col-12">
                                        				<div class="form-group label-floating is-empty">
                                        				    <label class="control-label"><?php echo getEduAppGTLang('description');?>:</label>
                                        				    <textarea class="form-control" name="description" rows="3" required=""></textarea>
                                        				    <span class="material-input"></span>
                                        				</div>
                                        			</div>
                                        			<div class="col col-lg-12 col-md-12 col-sm-12 col-12">
                                                        <div class="form-group label-floating is-select">
                                                            <label class="control-label"><?php echo getEduAppGTLang('method');?></label>
                                                            <div class="select">
                                                                <select name="method" required="">
                                                                    <option value=""><?php echo getEduAppGTLang('select');?></option>
                                                                    <option value="3"><?php echo getEduAppGTLang('card');?></option>
                                        					        <option value="1"><?php echo getEduAppGTLang('cash');?></option>
                                        					        <option value="2"><?php echo getEduAppGTLang('check');?></option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div><br>
		                                        </div>
		                                    </div>
		                                </div>
		                                <div class="col-sm-6">
                                            <div class="element-box lined-success shadow">
                                    		    <h5 class="form-header"><?php echo getEduAppGTLang('students');?></h5><br>
		                                        <div class="row">
		                                            <div class="col col-lg-12 col-md-12 col-sm-12 col-12">
                                                        <div class="form-group label-floating is-select">
                                                            <label class="control-label"><?php echo getEduAppGTLang('status');?></label>
                                                            <div class="select">
                                                                <select name="status" required="">
                                                                    <option value=""><?php echo getEduAppGTLang('select');?></option>
                                                                    <option value="completed"><?php echo getEduAppGTLang('completed');?></option>
					                                                <option value="pending"><?php echo getEduAppGTLang('pending');?></option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
    	                                        <div id="student_selection_holder_mass"></div>
    	                                        <hr>
    	                                        <div class="col col-lg-12 col-md-12 col-sm-12 col-12">
                                                    <button class="btn btn-success btn-rounded" type="submit"><?php echo getEduAppGTLang('create_invoice');?></button>
                                                </div>
                                            </div>
		                                </div>
		                            </div>
		                        <?php echo form_close();?>
	                        </div>
          	            </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <script type="text/javascript">
        function get_class_sections(class_id) 
        {
            $.ajax({
                url: '<?php echo base_url();?>admin/get_class_section/' + class_id ,
                success: function(response)
                {
                    jQuery('#section_holder').html(response);
                }
            });
        }
    </script>
    <script type="text/javascript">
    	function select() 
        {
    		var chk = $('.check');
    		for (i = 0; i < chk.length; i++) 
            {
    			chk[i].checked = true ;
    		}
    	}
    	function unselect() 
        {
    		var chk = $('.check');
    		for (i = 0; i < chk.length; i++) {
    			chk[i].checked = false ;
    		}
    	}
    
        var class_id = '';
        function get_class_students_mass(class_id) {
        	if (class_id !== '') {
            $.ajax({
                url: '<?php echo base_url();?>admin/get_class_students_mass/' + class_id ,
                success: function(response)
                {
                    jQuery('#student_selection_holder_mass').html(response);
                }
            });
          }
        }
        function check_validation(){
            if (class_id !== '') {
                $('.submit').removeAttr('disabled');
            }
            else{
                $('.submit').attr('disabled', 'disabled');
            }
        }
        $('.class_id').change(function(){
            class_id = $('.class_id').val();
            check_validation();
        });
    
        function get_class_students(section_id) {
            $.ajax({
                url: '<?php echo base_url();?>admin/get_class_studentss/' + section_id ,
                success: function(response)
                {
                    jQuery('#student_selection_holder').html(response);
                }
            });
        }
    </script>