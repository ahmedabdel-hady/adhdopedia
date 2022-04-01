<?php $edit_data = $this->db->get_where('invoice' , array('invoice_id' => $param2) )->result_array();?> 
<?php foreach($edit_data as $row):?>
    <div class="modal-body">
        <div class="modal-header" style="background-color:#00579c">
            <h6 class="title" style="color:white"><?php echo getEduAppGTLang('update_invoice');?></h6>
        </div>
        <div class="ui-block-content">
            <?php echo form_open(base_url() . 'admin/invoice/do_update/'.$row['invoice_id']);?>
                <div class="row">
                    <div class="col col-lg-6 col-md-6 col-sm-12 col-12">
                        <div class="form-group label-floating">
                            <label class="control-label"><?php echo getEduAppGTLang('title');?></label>
                            <input class="form-control" type="text" name="title" required="" value="<?php echo $row['title'];?>">
                        </div>
                    </div>
                    <div class="col col-lg-6 col-md-6 col-sm-12 col-12">
                        <div class="form-group label-floating">
                            <label class="control-label"><?php echo getEduAppGTLang('amount');?></label>
                            <input class="form-control" type="text" required="" name="amount" value="<?php echo $row['amount'];?>">
                        </div>
                    </div>
                    <div class="col col-lg-12 col-md-12 col-sm-12 col-12">
                        <div class="form-group label-floating is-select">
                            <label class="control-label"><?php echo getEduAppGTLang('status');?></label>
                            <div class="select">
                                <select name="status" required>
                                    <option value=""><?php echo getEduAppGTLang('select');?></option>
                                    <option value="completed" <?php if($row['status']=='completed') echo 'selected';?>><?php echo getEduAppGTLang('paid');?></option>
                                    <option value="pending" <?php if($row['status']=='pending') echo 'selected';?>><?php echo getEduAppGTLang('unpaid');?></option>  
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col col-lg-12 col-md-12 col-sm-12 col-12">
		                <div class="form-group label-floating">
		                <label class="control-label"><?php echo getEduAppGTLang('descrition');?>:</label>
		                    <textarea class="form-control" name="description" rows="3" required=""><?php echo $row['description'];?></textarea>
		                    <span class="material-input"></span>
		                </div>
	                </div>
                    <div class="col col-lg-6 col-md-6 col-sm-12 col-12">
                        <button class="btn btn-rounded btn-success btn-lg " type="submit"><?php echo getEduAppGTLang('update');?></button>
                    </div>
                </div>
            <?php echo form_close();?>
        </div>
    </div>
<?php endforeach;?>