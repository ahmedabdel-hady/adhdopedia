    <hr/>
    <div class="row" style="text-align: center;">
    	<div class="col-sm-4"></div>
    	<div class="col-sm-4"></div>
    </div>
    <div class="element-box">
        <h5 class="form-header"><?php echo getEduAppGTLang('student_promotion');?></h5>
	    <div class="table-responsive">
            <table class="table table-lightborder table-bordered">
			    <thead>
    				<tr style="background:#22b9ff;">
					    <td class="text-white"><strong><?php echo getEduAppGTLang('name');?></strong></td>
					    <td align="center" class="text-white"><strong><?php echo getEduAppGTLang('current_section');?></strong></td>
					    <td align="center" class="text-white"><strong><?php echo getEduAppGTLang('roll');?></strong></td>
					    <td align="center" class="text-white"><strong><?php echo getEduAppGTLang('to_section');?></strong></td>
					    <td align="center" class="text-white"><strong><?php echo getEduAppGTLang('options');?></strong></td>
				    </tr>
			    </thead>
			    <tbody>
			    <?php 
    				$students = $this->db->get_where('enroll' , array('class_id' => $class_id_from,'section_id' => $section_id_from , 'year' => $running_year))->result_array();
				    foreach($students as $row):
					$query = $this->db->get_where('enroll' , array('student_id' => $row['student_id'],'year' => $promotion_year));?>
				    <tr>
					    <td><?php echo $this->db->get_where('student' , array('student_id' => $row['student_id']))->row()->first_name." ".$this->db->get_where('student' , array('student_id' => $row['student_id']))->row()->last_name;?></td>
					    <td align="center">
    						<?php if($row['section_id'] != '' && $row['section_id'] != 0) echo $this->db->get_where('section' , array('section_id' => $row['section_id']))->row()->name;?>
					    </td>
					    <td align="center"><?php echo $row['roll'];?></td>
					    <td>
    					    <div class="form-group is-select">
					            <div class="select">
                                    <select name="promotion_status_section_<?php echo $row['student_id'];?>" required="">
                                    <?php 
                                        $sections = $this->db->get_where('section', array('class_id' => $class_id_to))->result_array();
    	                  				foreach($sections as $class):
               						?>
    	                  				<option value="<?php echo $class['section_id'];?>"><?php echo $class['name'];?></option>
               						<?php endforeach;?>
                                    </select>
                                </div>
                            </div>
					    </td>
					    <td>
    						<?php if($query->num_rows() < 1):?>
                            <div class="form-group is-select">
                                <div class="select">
                                    <select name="promotion_status_<?php echo $row['student_id'];?>" required="" id="promotion_status">
    								    <option value="<?php echo $class_id_to;?>">
    									    <?php echo getEduAppGTLang('promote_to') ." - ". $this->crud->get_class_name($class_id_to);?>
								        </option>
							        </select>
							    </div>
                            </div>
						    <?php endif;?>
						    <?php if($query->num_rows() > 0):?>
    						<center><button class="btn btn-primary" type="button"><i class="picons-thin-icon-thin-0154_ok_successful_check"></i> <?php echo getEduAppGTLang('promoted');?></button></center>
						    <?php endif;?>
					    </td>
				    </tr>
			    <?php endforeach;?>
			    </tbody>
		    </table>
	    </div>
	</div>
    <br>
	<center><button class="btn btn-success" type="submit"><i class="icon-paper-plane"></i>  <?php echo getEduAppGTLang('promote');?></button></center>

    <script type="text/javascript">
	    $(document).ready(function() {
            if($.isFunction($.fn.selectBoxIt))
		    {
    			$("select.selectboxit").each(function(i, el)
			    {
    				var $this = $(el),
					opts = {
						showFirstOption: attrDefault($this, 'first-option', true),
						'native': attrDefault($this, 'native', false),
						defaultText: attrDefault($this, 'text', ''),
					};
				    $this.addClass('visible');
				    $this.selectBoxIt(opts);
			    });
		    }
        });
    </script>