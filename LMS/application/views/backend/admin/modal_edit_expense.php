 <?php 
    $edit_data = $this->db->get_where('payment', array('payment_id' => $param2))->result_array();
	foreach ($edit_data as $row):
?>   
    <div class="modal-body">
        <div class="modal-header" style="background-color:#00579c">
            <h6 class="title" style="color:white"><?php echo getEduAppGTLang('update_expense');?></h6>
        </div>
        <div class="ui-block-content">
            <?php echo form_open(base_url() . 'admin/expense/edit/'.$row['payment_id'] , array('enctype' => 'multipart/form-data'));?>
                <div class="row">
                    <div class="col col-lg-6 col-md-6 col-sm-12 col-12">
                        <div class="form-group label-floating">
                            <label class="control-label"><?php echo getEduAppGTLang('title');?></label>
                            <input class="form-control" type="text" name="title" required="" value="<?php echo $row['title'];?>">
                        </div>
                    </div>
                    <div class="col col-lg-6 col-md-6 col-sm-12 col-12">
                        <div class="form-group label-floating">
                            <label class="control-label"><?php echo getEduAppGTLang('total');?></label>
                            <input class="form-control" type="text" required="" name="amount" value="<?php echo $row['amount'];?>">
                        </div>
                    </div>
                    <div class="col col-lg-12 col-md-12 col-sm-12 col-12">
                        <div class="form-group label-floating is-select">
                            <label class="control-label"><?php echo getEduAppGTLang('category');?></label>
                            <div class="select">
                                <select name="expense_category_id" required>
                                    <option value=""><?php echo getEduAppGTLang('select');?></option>
                                    <?php 
                                        $categories = $this->db->get('expense_category')->result_array();
                                        foreach ($categories as $row2):
                                    ?>
                                    <option value="<?php echo $row2['expense_category_id'];?>" <?php if ($row['expense_category_id'] == $row2['expense_category_id']) echo 'selected';?>><?php echo $row2['name'];?></option>
                                <?php endforeach;?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col col-lg-12 col-md-12 col-sm-12 col-12">
                        <div class="form-group label-floating is-select">
                            <label class="control-label"><?php echo getEduAppGTLang('method');?></label>
                            <div class="select">
                                <select name="method" required>
                                    <option value=""><?php echo getEduAppGTLang('select');?></option>
                                    <option value="1" <?php if ($row['method'] == 1) echo 'selected';?>><?php echo getEduAppGTLang('cash');?></option>
                                    <option value="2" <?php if ($row['method'] == 2) echo 'selected';?>><?php echo getEduAppGTLang('check');?></option>
                                    <option value="3" <?php if ($row['method'] == 3) echo 'selected';?>><?php echo getEduAppGTLang('card');?></option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col col-lg-12 col-md-12 col-sm-12 col-12">
			            <div class="form-group label-floating">
			            <label class="control-label"><?php echo getEduAppGTLang('description');?>:</label>
		                    <textarea class="form-control" name="description" rows="3" required=""><?php echo $row['description'];?></textarea>
		                    <span class="material-input"></span>
		                </div>
	                </div>
                    <div class="col col-lg-6 col-md-6 col-sm-12 col-12">
                        <button class="btn btn-rounded btn-success btn-lg" type="submit"><?php echo getEduAppGTLang('update');?></button>
                    </div>
                </div>
            <?php echo form_close();?>
        </div>
    </div>
    <?php endforeach;?>