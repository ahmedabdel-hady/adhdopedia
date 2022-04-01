<?php 
    $datas = $this->db->get_where('live', array('live_id' => $param2))->result_array();
    foreach($datas as $row):
    $data = base64_encode($row['class_id']."-". $row['section_id']."-". $row['subject_id']);
?>
    <script src="<?php echo base_url();?>style/cms/bower_components/bootstrap-clockpicker/bootstrap-clockpicker.min.js"></script>
    <div class="modal-content">
        <a href="#" class="close icon-close" data-dismiss="modal" aria-label="Close"></a>
        <div class="modal-body">
            <div class="ui-block-title" style="background-color:#00579c">
                <h6 class="title" style="color:white"><?php echo getEduAppGTLang('update_live');?></h6>
            </div>
            <div class="ui-block-content">
            	<?php echo form_open(base_url() . 'teacher/meet/update/'.$param2.'/'.$data, array('enctype' => 'multipart/form-data')); ?>
	                <div class="row">
                        <div class="col col-lg-12 col-md-12 col-sm-12 col-12">
                		    <div class="form-group">
                      			<label class="control-label"><?php echo getEduAppGTLang('title');?></label>
                  			    <input class="form-control" name="title" type="text" required="" value="<?php echo $row['title'];?>">
	                	    </div>
              		    </div>
              		    <div class="col col-lg-12 col-md-12 col-sm-12 col-12">
                            <div class="form-group">
                                <label class="col-form-label" for=""><?php echo getEduAppGTLang('date');?></label>
                                <div class="input-group">
                                    <input type='text' class="datepicker-here" data-position="top left" data-language='en' value="<?php echo $row['date'];?>" name="start_date" data-multiple-dates-separator="/"/>
                                </div>
                            </div>
                        </div>
                        <?php if($row['liveType'] == 2):?>
                        <input type="hidden" name="livetype" value="2">
                        <div class="col col-lg-12 col-md-12 col-sm-12 col-12">
                		    <div class="form-group">
                  			    <label class="control-label"><?php echo getEduAppGTLang('site_url');?></label>
                  			    <input class="form-control" name="siteUrl" type="text" required="" value="<?php echo $row['siteUrl'];?>">
    	                	</div>
              		    </div>                  		
                        <?php endif;?>
              		    <div class="col col-lg-12 col-md-12 col-sm-12 col-12">
                            <div class="form-group">
                                <label class="col-form-label" for=""><?php echo getEduAppGTLang('start_time');?></label>
                                <div class="input-group clockpicker" data-align="top" data-autoclose="true">
                                    <input type="text" required="" name="start_time" class="form-control" value="<?php echo $row['time'];?>">
                                </div>
                            </div>
                        </div>
                        <div class="col col-lg-12 col-md-12 col-sm-12 col-12">
                    		<div class="form-group">
                  			    <label class="control-label"><?php echo getEduAppGTLang('description');?></label>
                  			    <textarea class="form-control" rows="5" name="description"><?php echo $row['description'];?></textarea>
                		    </div>
              		    </div> 
            	    </div>
          		    <div class="form-buttons-w text-right">
    	             	<center><button class="btn btn-rounded btn-success btn-lg" type="submit"><?php echo getEduAppGTLang('save');?></button></center>
          		    </div>
          	    <?php echo form_close();?>        
            </div>
        </div>
    </div>
    <script type="text/javascript">
        $('.clockpicker').clockpicker({
            placement: 'top',
            align: 'left',
            donetext: 'Done'
        });
    </script>
<?php endforeach;?>