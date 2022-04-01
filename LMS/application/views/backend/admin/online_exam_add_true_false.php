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
    </style>

    <?php echo form_open(base_url() . 'admin/manage_online_exam_question/'.$online_exam_id.'/add/true_false' , array('enctype' => 'multipart/form-data'));?>
        <input type="hidden" name="type" value="<?php echo $question_type;?>">
        <div class="form-group">
            <label class="col-sm-3 control-label"><?php echo getEduAppGTLang('mark');?></label>
            <div class="col-sm-12">
                <input type="number" class="form-control" name="mark" data-validate="required" data-message-required="<?php echo getEduAppGTLang('value_required');?>" min="0"/>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-3 control-label"><?php echo getEduAppGTLang('question');?></label>
            <div class="col-sm-12">
                <textarea onkeyup="changeTheBlankColor()" name="question_title" class="form-control" id="question_title" rows="8" cols="80" required></textarea>
            </div>
        </div>
        <div class="row"  style="margin-top: 10px; text-align: left;">
            <div class="col-sm-12 col-sm-offset-3">
                <p>
                    <input type="radio" id="true" name="true_false_answer" value="true" checked>
                    <label for="true"><?php echo getEduAppGTLang('true');?></label>
                </p>
            </div>
            <div class="col-sm-12 col-sm-offset-3">
                <p>
                    <input type="radio" id="false" name="true_false_answer" value="false">
                    <label for="false"><?php echo getEduAppGTLang('false');?></label>
                </p>
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-12">
                <button type="submit" class="btn btn-success btn-block"><?php echo getEduAppGTLang('save');?></button>
            </div>
        </div>
    <?php echo form_close();?>