    <div class="content-w">
        <div class="conty">
        <?php include 'fancy.php';?>
        <div class="header-spacer"></div>
            <div class="content-i">
                <div class="content-box">
	                <div class="col-sm-8" style="margin: 0 auto;">
                    <?php
                        $result_details = $this->db->get_where('online_exam_result', array('online_exam_id' => $param2, 'student_id' => $this->session->userdata('login_user_id')))->row_array();
                        $answer_script_array = json_decode($result_details['answer_script'], true);
                        include 'answer_script_with_submitted_answers.php';
                    ?>				
	                </div>
                </div>
            </div>
        </div>
    </div>