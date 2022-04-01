<?php
    $question_details = $this->db->get_where('question_bank', array('question_bank_id' => $param2))->row_array();
    if ($question_details['options'] != "" || $question_details['options'] != null) {
        $options = json_decode($question_details['options']);
    } else {
        $options = array();
    }
    if ($question_details['correct_answers'] != "" || $question_details['correct_answers'] != null) {
        $correct_answers= json_decode($question_details['correct_answers']);
    } else {
        $correct_answers = array();
    }

    $online_exam_details = $this->db->get_where('online_exam', array('online_exam_id' => $question_details['online_exam_id']))->row_array();

    $added_question_info = $this->db->get_where('question_bank', array('online_exam_id' => $online_exam_details['online_exam_id']))->result_array();
    if($question_details['type'] == 'fill_in_the_blanks') {
        $suitable_words = implode(',', json_decode($question_details['correct_answers']));
    }
?>
    <div class="modal-body">
        <div class="modal-header" style="background-color:#00579c">
            <h6 class="title" style="color:white"><?php echo getEduAppGTLang('update_question');?></h6>
        </div>
        <div class="ui-block-content">
            <div class="row">
                <div class="col-md-12">
                    <?php echo form_open(base_url() . 'teacher/update_online_exam_question/'.$param2.'/update'.'/'.$question_details['online_exam_id'] , array('enctype' => 'multipart/form-data'));?>
                        <div class="form-group">
                            <label class="col-sm-3 control-label"><?php echo getEduAppGTLang('mark');?></label>
                            <div class="col-sm-12">
                                <input type="number" class="form-control" name="mark" required min="0" value="<?php echo $question_details['mark']; ?>"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label"><?php echo getEduAppGTLang('question');?></label>
                            <div class="col-sm-12">
                                <textarea name="question_title" class = "form-control" id = "question_title" rows="5" cols="80" required <?php if($question_details['type'] == 'fill_in_the_blanks') echo "onkeyup='changeTheBlankColor()'"; ?>><?php echo $question_details['question_title']; ?></textarea>
                            </div>
                        </div>
                        <?php if ($question_details['type'] == 'multiple_choice'): ?>
                        <div class="form-group" id = 'multiple_choice_question'>
                            <label class="col-sm-6 control-label"><?php echo getEduAppGTLang('options_number');?></label>
                            <div class="col-sm-12">
                                <div class="form-group with-icon label-floating">
						            <label class="control-label"><?php echo getEduAppGTLang('options_number');?></label>
						            <input class="form-control" type="number"  name="number_of_options" id = "number_of_options" required="" min="0" value="<?php echo $question_details['number_of_options']; ?>">
					                <button type="button" class = 'btn btn-sm' name="button" onclick="showOptions(jQuery('#number_of_options').val())" style="border-radius: 0px; background-color: #fff; margin-top:-10px;"><i class="picons-thin-icon-thin-0154_ok_successful_check" style="margin-top:-35px;"></i></button>
					            </div>
                            </div>
                        </div>
                        <?php for ($i = 0; $i < $question_details['number_of_options']; $i++):?>
                        <div class="col-sm-12">
                            <div class="form-group with-icon">
                                <label class="control-label"><?php echo getEduAppGTLang('option_').($i+1);?></label>
                                <input type="text" class="form-control" name = "options[]" id="option_<?php echo $i+1; ?>" required value="<?php echo $options[$i]; ?>">
                                <div class="custom-control custom-checkbox" style="margin-top:-40px;left:15px;    width: 10px;">
                                    <input type="checkbox" name="correct_answers[]" id="<?php echo $i; ?>" value="<?php echo ($i+1); ?>" class="custom-control-input" <?php if(in_array(($i+1), $correct_answers)) echo 'checked'; ?>> <label for="<?php echo $i; ?>" class="custom-control-label"></label>
                                </div>
                            </div>
                        </div>
                        <?php endfor;?>
                        <?php endif; ?>
                        <?php if ($question_details['type'] == 'true_false'): ?>
                        <div class="row"  style="margin-top: 10px; text-align: left;">
                            <div class="col-sm-8 col-sm-offset-3">
                                <p>
                                    <input type="radio" id="true" name="true_false_answer" value="true" <?php if($question_details['correct_answers'] == 'true') echo 'checked';  ?>>
                                    <label for="true"><?php echo getEduAppGTLang('true');?></label>
                                </p>
                            </div>
                            <div class="col-sm-8 col-sm-offset-3">
                                <p>
                                    <input type="radio" id="false" name="true_false_answer" value="false" <?php if($question_details['correct_answers'] == 'false') echo 'checked';  ?>>
                                    <label for="false"><?php echo getEduAppGTLang('false');?></label>
                                </p>
                            </div>
                        </div>
                        <?php endif; ?>
                        <?php if ($question_details['type'] == 'fill_in_the_blanks'): ?>
                        <div class="form-group">
                            <label class="col-sm-3 control-label"><?php echo getEduAppGTLang('preview');?>:</label>
                            <div class="col-sm-12">
                                <div class="" id = "preview"></div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label"><?php echo getEduAppGTLang('correct_words');?></label>
                            <div class="col-sm-12">
                                <textarea name="suitable_words" class = "form-control" rows="5" cols="80" placeholder="<?php echo getEduAppGTLang('correct_words_message');?>" ><?php echo $suitable_words; ?></textarea>
                            </div>
                        </div>
                        <?php endif; ?>
                        <div class="form-group">
                            <div class="col-sm-12">
                                <button type="submit" class="btn btn-success btn-block"><?php echo getEduAppGTLang('update');?></button>
                            </div>
                        </div>
                    <?php echo form_close();?>
                </div>
            </div>
        </div>
    </div>
    <style media="screen">
        [type="radio"]:checked,
        [type="radio"]:not(:checked) {
            position: absolute;
            left: -9999px;
        }
        [type="radio"]:checked + label,
        [type="radio"]:not(:checked) + label
        {
            position: relative;
            padding-left: 28px;
            cursor: pointer;
            line-height: 20px;
            display: inline-block;
            color: #666;
        }
        [type="radio"]:checked + label:before,
        [type="radio"]:not(:checked) + label:before {
            content: '';
            position: absolute;
            left: 0;
            top: 0;
            width: 18px;
            height: 18px;
            border: 1px solid #ddd;
            border-radius: 100%;
            background: #fff;
        }
        [type="radio"]:checked + label:after,
        [type="radio"]:not(:checked) + label:after {
            content: '';
            width: 12px;
            height: 12px;
            background: #2aa1c0;
            position: absolute;
            top: 3px;
            left: 3px;
            border-radius: 100%;
            -webkit-transition: all 0.2s ease;
            transition: all 0.2s ease;
        }
        [type="radio"]:not(:checked) + label:after {
            opacity: 0;
            -webkit-transform: scale(0);
            transform: scale(0);
        }
        [type="radio"]:checked + label:after {
            opacity: 1;
            -webkit-transform: scale(1);
            transform: scale(1);
        }
        .red {
            color: #f44336;
        }
    </style>
    
    <script type="text/javascript">
    
        jQuery(document).ready(function($) {
            changeTheBlankColor();
        });
    
        function showOptions(number_of_options){
            $.ajax({
                type: "POST",
                url: "<?php echo base_url();?>admin/manage_multiple_choices_options",
                data: {number_of_options : number_of_options},
                success: function(response){
                    console.log(response);
                    jQuery('.options').remove();
                    jQuery('#multiple_choice_question').after(response);
                }
            });
        }
    
        function changeTheBlankColor(){
            var alpha = ["^"];
            var res = "", cls = "";
            var t = jQuery("#question_title").val();
    
            for (i=0; i<t.length; i++) {
                for (j=0; j<alpha.length; j++) {
                    if (t[i] == alpha[j])
                    {
                        cls = "red";
                    }
                }
                if (t[i] === "^") {
                    res += "<span class='"+cls+"'>"+'__'+"</span>";
                }
                else{
                    res += "<span class='"+cls+"'>"+t[i]+"</span>";
                }
                cls="";
            }
            jQuery("#preview").html(res);
        }
    </script>