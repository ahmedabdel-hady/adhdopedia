<?php for($i = 1; $i <= $number_of_options; $i++): ?>
	<div class="col-sm-12">
	    <div class="form-group with-icon">
			<label class="control-label"><?php echo getEduAppGTLang('option_').$i;?></label>
			<input type="file" class="form-control" name="options[]" id="option_<?php echo $i; ?>" required>
			<div class="custom-control custom-radio" style="margin-top:-40px;left:15px;    width: 10px;">
	             <input type="radio" name="correct_answers[]" id="<?php echo $i; ?>" value="<?php echo $i; ?>" class="custom-control-input"> <label for="<?php echo $i; ?>" class="custom-control-label"></label>
	        </div>
		</div>
	</div>
<?php endfor; ?>