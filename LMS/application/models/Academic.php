<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Academic extends School 
{
    private $runningYear = '';
    
    function __construct() 
    {
        parent::__construct();
        $this->load->database();
        $this->load->library('excel');
        $this->runningYear = $this->db->get_where('settings' , array('type' => 'running_year'))->row()->description;
    }
    
    function countOnlineExams($class_id,$section_id,$subject_id){
        $running_year = $this->db->get_where('settings' , array('type' => 'running_year'))->row()->description;
        $match = array('running_year' => $running_year, 'class_id' => $class_id, 'section_id' => $section_id,'subject_id' => $subject_id, 'status' => 'published');
        $exams = $this->db->where($match)->get('online_exam')->num_rows();
        return $exams;
    }
    
    public function countHomeworks($class_id,$section_id,$subject_id){
        $homeworks = $this->db->get_where('homework', array('class_id' => $class_id, 'status' => 1, 'section_id' => $section_id, 'subject_id' => $subject_id))->num_rows();
        return $homeworks;
    }

    public function countForums($class_id,$section_id,$subject_id){
        $forums = $this->db->get_where('forum', array('class_id' => $class_id, 'section_id' => $section_id, 'post_status' => 1, 'subject_id' => $subject_id))->num_rows();
        return $forums;
    }
    
    public function countMaterial($class_id,$section_id,$subject_id){
        $study_material = $this->db->get_where('document', array('class_id' => $class_id, 'section_id' => $section_id, 'subject_id' => $subject_id))->num_rows();
        return $study_material;
    }
    
    public function countLive($class_id,$section_id,$subject_id){
        $this->db->where('class_id', $class_id);
        $this->db->where('section_id', $section_id);
        $this->db->where('subject_id', $subject_id);
        $lives = $this->db->get('live')->num_rows();
        return $lives;
    }
    
    //SetRead
    public function setRead($code,$type,$subject_id)
    {
        $year = $this->db->get_where('settings' , array('type' => 'running_year'))->row()->description;
        $userId    = $this->session->userdata('login_user_id');
        $check = $this->db->get_where('activity_read', array('student_id' => $userId, 'subject_activity_id' => $code,'activity_type' => $type, 'subject_id' => $subject_id, 'year' => $year));
        if($check->num_rows() == 0){
            $data['student_id']          = $userId;
            $data['subject_id']          = $subject_id;
            $data['subject_activity_id'] = $code;
            $data['date']                = $this->crud->getDateFormat().' '.date('h:i A');
            $data['year']                = $year;
            $data['activity_type']       = $type;
            $this->db->insert('activity_read',$data);
        }
    }
    
    //GetRead
    public function getRead($code,$type,$subject_id){
        $year = $this->db->get_where('settings' , array('type' => 'running_year'))->row()->description;
        $this->db->limit(5);
        $this->db->order_by('actividy_read_id', 'RANDOM');
        $check = $this->db->get_where('activity_read', array('subject_activity_id' => $code, 'activity_type' => $type, 'subject_id' => $subject_id, 'year' => $year))->result_array();
        return $check;
    }
    
    //Create Live Class.
    public function createLiveClass()
    {
        $data['user_type']      = $this->session->userdata('login_type');
        $data['title']          = $this->input->post('title');
        $data['liveType']       = $this->input->post('livetype');   
        if($this->input->post('livetype') == '2'){
            $data['siteUrl']    = $this->input->post('siteUrl');   
        }
        $data['description']    = $this->input->post('description');
        $data['upload_date']    = $this->crud->getDateFormat().' '.date('H:iA');
        $data['date']           = $this->input->post('start_date');
        $data['time']           = $this->input->post('start_time');
        $data['publish_date']   = date('Y-m-d H:i:s');
        $data['year']           = $this->runningYear;
        $data['room']           =  md5(date('d-m-Y H:i:s')).substr(md5(rand(100000000, 200000000)), 0, 10);
        $data['wall_type']      = 'live';
        $data['class_id']       = $this->input->post('class_id');
        $data['subject_id']     = $this->input->post('subject_id');
        $data['section_id']     = $this->input->post('section_id');
        $data['user_id']        = $this->session->userdata('login_user_id');
        $this->db->insert('live',$data);  
    }
    
    public function updateLiveClass($liveId)
    {
        $data['title']             = $this->input->post('title');
        $data['description']       = $this->input->post('description');
        if($this->input->post('livetype') == '2'){
            $data['siteUrl']       = $this->input->post('siteUrl');   
        }
        $data['date']              = $this->input->post('start_date');
        $data['time']              = $this->input->post('start_time');
        $data['wall_type']         = 'live';
        $this->db->where('live_id', $liveId);
        $this->db->update('live',$data);  
    }
    
    public function deleteLiveClass($liveId)
    {
        $this->db->where('live_id', $liveId);
        $this->db->delete('live');
    }
    
    public function createLevel()
    {
        $data['name']        = $this->input->post('name');
        $data['grade_point'] = $this->input->post('point');
        $data['mark_from']   = $this->input->post('from');
        $data['mark_upto']   = $this->input->post('to');
        $this->db->insert('grade', $data);
    }
    
    public function updateLevel($levelId)
    {
        $data['name']        = $this->input->post('name');
        $data['grade_point'] = $this->input->post('point');
        $data['mark_from']   = $this->input->post('from');
        $data['mark_upto']   = $this->input->post('to');
        $this->db->where('grade_id', $levelId);
        $this->db->update('grade', $data);
    }
    
    public function deleteLevel($levelId)
    {
        $this->db->where('grade_id', $levelId);
        $this->db->delete('grade');
    }
    
    public function deleteDelivery($Id)
    {
        $this->db->where('id',$Id);
        $this->db->delete('deliveries');
    }
    
    public function acceptBook($bookId)
    {
        $data['status'] = 1;
        $this->db->update('book_request', $data, array('book_request_id' => $bookId));
        $book_id        = $this->db->get_where('book_request', array('book_request_id' => $bookId))->row()->book_id;
        $issued_copies  = $this->db->get_where('book', array('book_id' => $book_id))->row()->issued_copies;
        $data2['issued_copies'] = $issued_copies + 1;
        $this->db->update('book', $data2, array('book_id' => $book_id));
    }
    
    public function rejectBook($bookId)
    {
        $data['status'] = 2;
        $this->db->update('book_request', $data, array('book_request_id' => $bookId));
    }
    
    public function deleteOnlineExam($examId)
    {
        $this->db->where('online_exam_id', $examId);
        $this->db->delete('online_exam');
    }
    
    public function createHomework()
    {
        $data['title']          = $this->input->post('title');
        $data['description']    = $this->input->post('description');
        $data['time_end']       = $this->input->post('time_end');
        $data['date_end']       = $this->input->post('date_end');
        $data['type']           = $this->input->post('type');
        $data['wall_type']      = 'homework';
        $data['publish_date']   = date('Y-m-d H:i:s');
        $data['upload_date']    = $this->crud->getDateFormat().' '.date('H:iA');
        $data['year']           = $this->runningYear;
        $data['status']         = $this->input->post('status');
        $data['class_id']       = $this->input->post('class_id');
        $data['file_name']      = $_FILES["file_name"]["name"];
        $data['section_id']     = $this->input->post('section_id');
        $data['user']           = $this->session->userdata('login_type');
        $data['subject_id']     = $this->input->post('subject_id');
        $data['uploader_type']  = $this->session->userdata('login_type');
        $data['uploader_id']    = $this->session->userdata('login_user_id');
        $data['homework_code']  = substr(md5(rand(100000000, 200000000)), 0, 10);
        $this->db->insert('homework', $data);
        move_uploaded_file($_FILES["file_name"]["tmp_name"], "public/uploads/homework/" . $_FILES["file_name"]["name"]);
        $this->crud->send_homework_notify();
        $homework_code = $data['homework_code'];
        $notify['notify'] = "<strong>".$this->crud->get_name($this->session->userdata('login_type'),$this->session->userdata('login_user_id'))."</strong>". " ". getEduAppGTLang('new_homework_notify') ." <b>".$this->input->post('title')."</b>";
        $students = $this->db->get_where('enroll', array('class_id' => $this->input->post('class_id'), 'section_id' => $this->input->post('section_id'), 'year' => $this->runningYear))->result_array();
        foreach($students as $row)
        {
            $notify['user_id']       = $row['student_id'];
            $notify['user_type']     = 'student';
            $notify['url']           = "student/homeworkroom/".$homework_code;
            $notify['date']          = $this->crud->getDateFormat();
            $notify['time']          = date('h:i A');
            $notify['status']        = 0;
            $notify['type']          = 'homework';
            $notify['class_id']      = $this->input->post('class_id');
            $notify['section_id']    = $this->input->post('section_id');
            $notify['year']          = $this->runningYear;
            $notify['subject_id']    = $this->input->post('subject_id');
            $notify['original_id']   = $this->session->userdata('login_user_id');
            $notify['original_type'] = $this->session->userdata('login_type');
            $this->db->insert('notification', $notify);
        }
        return $homework_code;
    }
    
    public function updateHomework($homework_code)
    {
        $data['title']       = $this->input->post('title');
        $data['description'] = $this->input->post('description');
        $data['time_end']    = $this->input->post('time_end');
        $data['date_end']    = $this->input->post('date_end');
        $data['user']        = $this->session->userdata('login_type');
        $data['status']      = $this->input->post('status');
        $data['type']        = $this->input->post('type');
        $this->db->where('homework_code', $homework_code);
        $this->db->update('homework', $data);
    }
    
    public function reviewHomework()
    {
        $id      = $this->input->post('answer_id');
        $mark    = $this->input->post('mark');
        $comment = $this->input->post('comment');
        $entries = sizeof($mark);
        for($i = 0; $i < $entries; $i++) 
        {
            $data['mark']            = $mark[$i];
            $data['teacher_comment'] = $comment[$i];
            $this->db->where_in('id', $id[$i]);
            $this->db->update('deliveries', $data);
        }
    }
    
    public function singleHomework()
    {
        $student_id  = $this->db->get_where('deliveries', array('id' => $this->input->post('id')))->row()->student_id;
        $code        = $this->db->get_where('deliveries', array('id' => $this->input->post('id')))->row()->homework_code;
        $title       = $this->db->get_where('homework', array('homework_code' => $code))->row()->title;

        $data['teacher_comment'] = $this->input->post('comment');
        $data['mark']            = $this->input->post('mark');
        $this->db->where('id', $this->input->post('id'));
        $this->db->update('deliveries', $data);

        $notify['notify']        = "<strong>". $this->crud->get_name($this->session->userdata('login_type'), $this->session->userdata('login_user_id'))."</strong>". " ". getEduAppGTLang('homework_rated') ." <b>".$title.".</b>";
        $notify['user_id']       = $student_id;
        $notify['user_type']     = 'student';
        $notify['date']          = $this->crud->getDateFormat();
        $notify['time']          = date('h:i A');
        $notify['url']           = "student/homeworkroom/".$code;
        $notify['status']        = 0;
        $notify['original_id']   = $this->session->userdata('login_user_id');
        $notify['original_type'] = $this->session->userdata('login_type');
        $this->db->insert('notification', $notify);
    }
    
    public function createForum()
    {
        $data['title']           = $this->input->post('title');
        $data['description']     = $this->input->post('description');
        $data['class_id']        = $this->input->post('class_id');
        $data['type']            = $this->session->userdata('login_type');
        $data['section_id']      = $this->input->post('section_id');
        if($this->input->post('post_status') != "1"){
            $data['post_status'] = 0;
        }else{
            $data['post_status'] = $this->input->post('post_status');   
        }
        $data['publish_date']    = date('Y-m-d H:i:s');
        $data['upload_date']     = $this->crud->getDateFormat().' '.date('H:iA');
        $data['wall_type']       = "forum";
        $data['timestamp']       = $this->crud->getDateFormat().' '.date("H:iA");
        $data['subject_id']      = $this->input->post('subject_id');
        $data['file_name']       = $_FILES["userfile"]["name"];
        $data['teacher_id']      = $this->session->userdata('login_user_id');
        $data['post_code']       = substr(md5(rand(100000000, 200000000)), 0, 10);
        $this->db->insert('forum', $data);
        $this->crud->send_forum_notify();
        move_uploaded_file($_FILES["userfile"]["tmp_name"], "public/uploads/forum/" . $_FILES["userfile"]["name"]);
    }
    
    public function updateForum($code)
    {
        if($this->input->post('post_status') != "1"){
            $data['post_status'] = 0;
        }else{
            $data['post_status'] = $this->input->post('post_status');   
        }
        $data['title']           = $this->input->post('title');
        $data['description']     = $this->input->post('description');
        $data['type']            = $this->session->userdata('login_type');
        $data['timestamp']       = $this->crud->getDateFormat().' '.date("H:iA");
        $data['teacher_id']      = $this->session->userdata('login_user_id');
        $this->db->where('post_code', $code);
        $this->db->update('forum', $data);
    }
    
    public function createMaterial()
    {
        $data['type']              = $this->session->userdata('login_type');
        $data['timestamp']         = strtotime(date("Y-m-d H:i:s"));
        $data['title']             = $this->input->post('title');
        $data['description']       = $this->input->post('description');
        $data['upload_date']       = $this->crud->getDateFormat().' '.date('H:iA');
        $data['publish_date']      = date('Y-m-d H:i:s');
        $data['file_name']         = str_replace(" ", "",$_FILES["file_name"]["name"]);
        $data['filesize']          = $this->crud->formatBytes($_FILES["file_name"]["size"]);
        $data['wall_type']         = 'material';
        $data['file_type']         = $this->input->post('file_type');
        $data['class_id']          = $this->input->post('class_id');
        $data['subject_id']        = $this->input->post('subject_id');
        $data['section_id']        = $this->input->post('section_id');
        $data['teacher_id']        = $this->session->userdata('login_user_id');
        $this->db->insert('document',$data);
        move_uploaded_file($_FILES["file_name"]["tmp_name"], "public/uploads/document/" . str_replace(" ", "",$_FILES["file_name"]["name"]));
        
        $notify['notify'] = "<strong>".$this->crud->get_name($this->session->userdata('login_type'), $this->session->userdata('login_user_id'))."</strong> ". " ".getEduAppGTLang('study_material_notify');
        $students = $this->db->get_where('enroll', array('class_id' => $this->input->post('class_id'),'section_id' => $this->input->post('section_id'), 'year' => $this->runningYear))->result_array();
        foreach($students as $row)
        {
            $notify['user_id']       = $row['student_id'];
            $notify['user_type']     = 'student';
            $notify['url']           = "student/study_material/".base64_encode($this->input->post('class_id').'-'.$this->input->post('section_id').'-'.$this->input->post('subject_id'));
            $notify['date']          = $this->crud->getDateFormat();
            $notify['time']          = date('h:i A');
            $notify['type']          = 'material';
            $notify['status']        = 0;
            $notify['year']          = $this->runningYear;
            $notify['class_id']      = $this->input->post('class_id');
            $notify['section_id']    = $this->input->post('section_id');
            $notify['subject_id']    = $this->input->post('subject_id');
            $notify['original_id']   = $this->session->userdata('login_user_id');
            $notify['original_type'] = $this->session->userdata('login_type');
            $this->db->insert('notification', $notify);
        }
    }
    
    public function update_online_exam()
    {
        $ts  = explode(':',$this->input->post('time_start'));
        $nts = count($ts);
        $te  = explode(':',$this->input->post('time_end'));
        $nte = count($te);
        $data['title']              = html_escape($this->input->post('exam_title'));
        $data['class_id']           = $this->input->post('class_id');
        $data['section_id']         = $this->input->post('section_id');
        $data['results']            = $this->input->post('results');
        $data['show_random']        = $this->input->post('show_random');
        $data['subject_id']         = $this->input->post('subject_id');
        $data['minimum_percentage'] = html_escape($this->input->post('minimum_percentage'));
        $data['instruction']        = $this->input->post('instruction');
        $data['password']           = $this->input->post('password');
        $data['exam_date']          = strtotime(html_escape($this->input->post('exam_date')));
        if($nts == 3){
            $data['time_start']         = $this->input->post('time_start');   
        }else{
            $data['time_start']         = $this->input->post('time_start').':00';
        }
        if($nte == 3){
            $data['time_end']         = $this->input->post('time_end');   
        }else{
            $data['time_end']         = $this->input->post('time_end').':00';
        }
        $data['duration']           = strtotime(date('Y-m-d', $data['exam_date']).' '.$data['time_end']) - strtotime(date('Y-m-d', $data['exam_date']).' '.$data['time_start']);

        $this->db->where('online_exam_id', $this->input->post('online_exam_id'));
        $this->db->update('online_exam', $data);
    }
    
    public function createOnlineExam()
    {
        $data['publish_date']       = date('Y-m-d H:i:s');
        $data['uploader_type']      = $this->session->userdata('login_type');
        $data['wall_type']          = "exam";
        $data['uploader_id']        = $this->session->userdata('login_user_id');
        $data['upload_date']        = $this->crud->getDateFormat().' '.date('H:iA');
        $data['password']           = $this->input->post('password');
        $data['show_random']        = $this->input->post('show_random');
        $data['results']            = $this->input->post('results');
        $data['code']               = substr(md5(uniqid(rand(), true)), 0, 7);
        $data['title']              = html_escape($this->input->post('exam_title'));
        $data['class_id']           = $this->input->post('class_id');
        $data['section_id']         = $this->input->post('section_id');
        $data['subject_id']         = $this->input->post('subject_id');
        $data['minimum_percentage'] = html_escape($this->input->post('minimum_percentage'));
        $data['instruction']        = $this->input->post('instruction');
        $data['exam_date']          = strtotime(html_escape($this->input->post('exam_date')));
        $data['time_start']         = html_escape($this->input->post('time_start').":00");
        $data['time_end']           = html_escape($this->input->post('time_end').":00");
        $data['duration']           = strtotime(date('Y-m-d', $data['exam_date']).' '.$data['time_end']) - strtotime(date('Y-m-d', $data['exam_date']).' '.$data['time_start']);
        $data['running_year']       = $this->runningYear;
        $this->crud->send_exam_notify();
        $this->db->insert('online_exam', $data);
    }
    
    public function promoteStudents()
    {
        $running_year                =   $this->input->post('running_year');  
        $from_class_id               =   $this->input->post('promotion_from_class_id'); 
        $from_section_id             =   $this->input->post('promotion_from_section_id'); 
        $students_of_promotion_class =   $this->db->get_where('enroll' , array('class_id' => $from_class_id, 'section_id' => $from_section_id , 'year' => $running_year))->result_array();
        foreach($students_of_promotion_class as $row) 
        {
            $enroll_data['enroll_code']     =   substr(md5(rand(0, 1000000)), 0, 7);
            $enroll_data['student_id']      =   $row['student_id'];
            $enroll_data['section_id']      =   $this->input->post('promotion_status_section_'.$row['student_id']);
            $enroll_data['class_id']        =   $this->input->post('promotion_status_'.$row['student_id']);
            $enroll_data['year']            =   $this->input->post('promotion_year');
            $enroll_data['date_added']      =   strtotime(date("Y-m-d H:i:s"));
            $this->db->insert('enroll' , $enroll_data);
        } 
    }
    
    public function createCourse()
    {
        $md5 = md5(date('d-m-y H:i:s'));
        $data['name']        = $this->input->post('name');
        $data['about']       = $this->input->post('about');
        $data['class_id']    = $this->input->post('class_id');
        $data['section_id']  = $this->input->post('section_id');
        $data['color']       = $this->input->post('color');
        $data['icon']        = $md5.str_replace(' ', '', $_FILES['userfile']['name']);
        $data['teacher_id']  = $this->input->post('teacher_id');
        $data['year']        = $this->runningYear;
        $this->db->insert('subject', $data);
        move_uploaded_file($_FILES['userfile']['tmp_name'], 'public/uploads/subject_icon/' . $md5.str_replace(' ', '', $_FILES['userfile']['name']));
    }
    
    public function updateCourseActivity($courseId)
    {
        $class_id = $this->db->get_where('subject', array('subject_id' => $courseId))->row()->class_id;
        $data['la1'] = $this->input->post('la1');
        $data['la2'] = $this->input->post('la2');
        $data['la3'] = $this->input->post('la3');
        $data['la4'] = $this->input->post('la4');
        $data['la5'] = $this->input->post('la5');
        $data['la6'] = $this->input->post('la6');
        $data['la7'] = $this->input->post('la7');
        $data['la8'] = $this->input->post('la8');
        $data['la9'] = $this->input->post('la9');
        $data['la10'] = $this->input->post('la10');
        $this->db->where('subject_id', $courseId);
        $this->db->update('subject', $data);
    }
    
    public function updateCourse($courseId)
    {
        $class_id           = $this->db->get_where('subject', array('subject_id' => $courseId))->row()->class_id;
        $md5                =  md5(date('d-m-y H:i:s'));
        $data['color']      = $this->input->post('color');
        if($_FILES['userfile']['size'] > 0){
            $data['icon']   = $md5.str_replace(' ', '', $_FILES['userfile']['name']);
        }
        $data['name']       = $this->input->post('name');
        $data['about']      = $this->input->post('about');
        $data['teacher_id'] = $this->input->post('teacher_id');
        $this->db->where('subject_id', $courseId);
        $this->db->update('subject', $data);
        move_uploaded_file($_FILES['userfile']['tmp_name'], 'public/uploads/subject_icon/' . $md5.str_replace(' ', '', $_FILES['userfile']['name']));
    }
    
    public function deleteCourse($courseId)
    {
        $this->db->where('subject_id', $courseId);
        $this->db->delete('subject');
    }
    
    public function createClass()
    {
        $data['name']         = $this->input->post('name');
        $data['teacher_id']   = $this->input->post('teacher_id');
        $this->db->insert('class', $data);
        $class_id = $this->db->insert_id();
        $data2['class_id']    =   $class_id;
        $data2['name']        =   'A';
        $this->db->insert('section' , $data2);
    }
    
    public function updateClass($classId)
    {
        $data['name']         = $this->input->post('name');
        $data['teacher_id']   = $this->input->post('teacher_id');
        $this->db->where('class_id', $classId);
        $this->db->update('class', $data);
    }
    
    public function deleteClass($classId)
    {
        $this->db->where('class_id', $classId);
        $this->db->delete('class');
    }
    
    public function createSection()
    {
        $data['name']       =   $this->input->post('name');
        $data['class_id']   =   $this->input->post('class_id');
        $data['teacher_id'] =   $this->input->post('teacher_id');
        $this->db->insert('section' , $data);
    }
    
    public function updateSection($sectionId){
        $data['name']       = $this->input->post('name');
        $data['teacher_id'] = $this->input->post('teacher_id');
        $this->db->where('section_id', $sectionId);
        $this->db->update('section', $data);
    }
    
    public function deleteSection($sectionId)
    {
        $this->db->where('section_id' , $sectionId);
        $this->db->delete('section');
    }
    
    public function createSemester()
    {
        $data['name']    = $this->input->post('name');
        $this->db->insert('exam', $data);
    }
    
    public function updateSemester($examId)
    {
        $data['name']    = $this->input->post('name');
        $this->db->where('exam_id', $examId);
        $this->db->update('exam', $data);
    }
    
    public function deleteSemester($examId)
    {
        $this->db->where('exam_id', $examId);
        $this->db->delete('exam');
    }
    
    public function createReport()
    {
        $parent_id           = $this->db->get_where('student', array('student_id' => $this->input->post('student_id')))->row()->parent_id;
        $student_name        = $this->db->get_where('student', array('student_id' => $this->input->post('student_id')))->row()->name;
        $parent_phone        = $this->db->get_where('parent', array('parent_id' => $parent_id))->row()->phone;
        $parent_email        = $this->db->get_where('parent', array('parent_id' => $parent_id))->row()->email;
        $data['student_id']  = $this->input->post('student_id');
        $data['class_id']    = $this->input->post('class_id');
        $data['section_id']  = $this->input->post('section_id');
        $data['user_id']     = $this->session->userdata('login_type')."-".$this->session->userdata('login_user_id');
        $data['title']       = $this->input->post('title');
        $data['description'] = $this->input->post('description');
        $data['file']        = $_FILES["file_name"]["name"];
        $data['date']        = $this->crud->getDateFormat();
        $data['priority']    = $this->input->post('priority');
        $data['status']      = 0;
        $data['code']        = substr(md5(rand(0, 1000000)), 0, 7);
        $this->db->insert('reports', $data);
        $this->crud->students_reports($this->input->post('student_id'),$parent_id);
        move_uploaded_file($_FILES["file_name"]["tmp_name"], 'public/uploads/report_files/'. $_FILES["file_name"]["name"]);
        
        $notify = $this->db->get_where('settings' , array('type' => 'students_reports'))->row()->description;
        if($notify == 1)
        {
            $message = getEduAppGTLang('behavioral_report_has_been_created_for')." " . $student_name;
            $sms_status = $this->db->get_where('settings' , array('type' => 'sms_status'))->row()->description;
            if ($sms_status == 'msg91') 
            {
                $result = $this->crud->send_sms_via_msg91($message, $parent_phone);
            }
            else if ($sms_status == 'twilio') 
            {
                $this->crud->twilio_api($message,"".$parent_phone."");
            }
            else if ($sms_status == 'clickatell') 
            {
                $this->crud->clickatell($message,$parent_phone);
            }
        }
    }
    
    public function reportResponse()
    {
        $data['report_code'] = $this->input->post('report_code');
        $data['message']     = $this->input->post('message');
        $data['date']        = $this->crud->getDateFormat();
        $data['sender_type'] = $this->session->userdata('login_type');
        $data['sender_id']   = $this->session->userdata('login_user_id');
        return $this->db->insert('report_response', $data);
    }
    
    public function updateReport($code)
    {
        $notify['notify'] =  "<b>".$this->db->get_where('reports', array('code' => $code))->row()->title."</b>"." ". getEduAppGTLang('report_solved');
        $user       = $this->db->get_where('reports', array('code' => $code))->row()->user_id;
        $final      = explode("-", $user);
        $user_type  = $final[0];
        $user_id    = $final[1];
        $student_id = $this->db->get_where('reports', array('code' => $code))->row()->student_id;
        $parent_id  = $this->db->get_where('student', array('student_id' => $student_id))->row()->parent_id;

        $notify['user_id']       = $user_id;
        $notify['user_type']     = $user_type;
        $notify['url']           = $user_type."/view_report/".$code;
        $notify['date']          = $this->crud->getDateFormat();
        $notify['time']          = date('h:i A');
        $notify['status']        = 0;
        $notify['original_id']   = $this->session->userdata('login_user_id');
        $notify['original_type'] = $this->session->userdata('login_type');
        $this->db->insert('notification', $notify);

        $notify2['notify']        = $notify['notify'];
        $notify2['user_id']       = $parent_id;
        $notify2['user_type']     = 'parent';
        $notify2['url']           = "parents/view_report/".$code;
        $notify2['date']          = $this->crud->getDateFormat();
        $notify2['time']          = date('h:i A');
        $notify2['status']        = 0;
        $notify2['original_id']   = $this->session->userdata('login_user_id');
        $notify2['original_type'] = $this->session->userdata('login_type');
        $this->db->insert('notification', $notify2);

        $data['status']           = 1;
        $this->db->where('code', $code);
        $this->db->update('reports', $data);
    }
    
    function getInfo($type) {
        $query = $this->db->get_where('academic_settings', array('type' => $type));
        return $query->row()->description;
    }
    
    public function createRoutine()
    {
        $data['class_id']       = $this->input->post('class_id');
        if($this->input->post('section_id') != '') 
        {
            $data['section_id'] = $this->input->post('section_id');
        }
        $subject_id = $this->input->post('subject_id');
        $teacher_id = $this->db->get_where('subject', array('subject_id' => $subject_id))->row()->teacher_id;
        $data['subject_id']     = $this->input->post('subject_id');
        $data['time_start']     = $this->input->post('time_start');
        $data['time_end']       = $this->input->post('time_end');
        $data['classroom_id']       = $this->input->post('classroom_id');
        $data['time_start_min'] = $this->input->post('time_start_min');
        $data['time_end_min']   = $this->input->post('time_end_min');
        $data['day']            = $this->input->post('day');
        $data['amend']          = $this->input->post('ending_ampm');
        $data['amstart']        = $this->input->post('starting_ampm');
        $data['day']            = $this->input->post('day');
        $data['teacher_id']     = $teacher_id;
        $data['year']           = $this->db->get_where('settings' , array('type' => 'running_year'))->row()->description;
        $this->db->insert('class_routine', $data);
    }
    
    public function updateRoutine($routineId)
    {
        $data['time_start']     = $this->input->post('time_start');
        $data['time_end']       = $this->input->post('time_end');
        $data['time_start_min'] = $this->input->post('time_start_min');
        $data['time_end_min']   = $this->input->post('time_end_min');
        $data['amend']          = $this->input->post('ending_ampm');
        $data['amstart']        = $this->input->post('starting_ampm');
        $data['classroom_id']       = $this->input->post('classroom_id');
        $data['day']            = $this->input->post('day');
        $data['year']           = $this->db->get_where('settings' , array('type' => 'running_year'))->row()->description;
        $this->db->where('class_routine_id', $routineId);
        $this->db->update('class_routine', $data);
    }
    
    public function deleteRoutine($routineId)
    {
        $this->db->where('class_routine_id', $routineId);
        $this->db->delete('class_routine');
    }
    
    public function updateMarks($exam_id, $class_id, $section_id, $subject_id)
    {
        $labototal = 0;
        $marks_of_students = $this->db->get_where('mark' , array('exam_id' => $exam_id, 'class_id' => $class_id, 'section_id' => $section_id, 'year' => $this->runningYear,'subject_id' => $subject_id))->result_array();
        foreach($marks_of_students as $row) 
        {
            $obtained_marks = $this->input->post('marks_obtained_'.$row['mark_id']);
            $labouno        = $this->input->post('lab_uno_'.$row['mark_id']);
            $labodos        = $this->input->post('lab_dos_'.$row['mark_id']);
            $labotres       = $this->input->post('lab_tres_'.$row['mark_id']);
            $labocuatro     = $this->input->post('lab_cuatro_'.$row['mark_id']);
            $labocinco      = $this->input->post('lab_cinco_'.$row['mark_id']);
            $laboseis       = $this->input->post('lab_seis_'.$row['mark_id']);
            $labosiete      = $this->input->post('lab_siete_'.$row['mark_id']);
            $laboocho       = $this->input->post('lab_ocho_'.$row['mark_id']);
            $labonueve      = $this->input->post('lab_nueve_'.$row['mark_id']);
            $comment        = $this->input->post('comment_'.$row['mark_id']);
            $labototal      = (int)$obtained_marks + (int)$labouno + (int)$labodos + (int)$labotres + (int)$labocuatro + (int)$labocinco + (int)$laboseis + (int)$labosiete + (int)$laboocho + (int)$labonueve;
            $this->db->where('mark_id' , $row['mark_id']);
            $this->db->update('mark' , array('mark_obtained' => $obtained_marks , 'labuno' => $labouno
            , 'labdos' => $labodos, 'labtres' => $labotres, 'labcuatro' => $labocuatro, 'labcinco' => $labocinco, 'labseis' => $laboseis
                , 'labsiete' => $labosiete, 'labocho' => $laboocho, 'labnueve' => $labonueve, 'labtotal' => $labototal, 'comment' => $comment));
        }
        $info = base64_encode($class_id.'-'.$section_id.'-'.$subject_id);
        return $info;
    }
    
    public function uploadMarks($datainfo,$examId)
    {
        $info = base64_decode($datainfo);
        $ex = explode('-', $info);
        $data['exam_id']    = $examId;
        $data['class_id']   = $ex[0];
        $data['section_id'] = $ex[1];
        $data['subject_id'] = $ex[2];
        $data['year']       = $this->runningYear;
        $students = $this->db->get_where('enroll' , array('class_id' => $data['class_id'] , 'section_id' => $data['section_id'] , 'year' => $data['year']))->result_array();
        foreach($students as $row) 
        {
            $verify_data = array('exam_id' => $data['exam_id'],'class_id' => $data['class_id'],'section_id' => $data['section_id'],
            'student_id' => $row['student_id'],'subject_id' => $data['subject_id'], 'year' => $data['year']);
            $query = $this->db->get_where('mark' , $verify_data);
            if($query->num_rows() < 1) 
            {   
                $data['student_id'] = $row['student_id'];
                $this->db->insert('mark' , $data);
            }
        }
    }
    
    public function submitExam($online_exam_id)
    {
        $answer_script = array();
        $question_bank = $this->db->get_where('question_bank', array('online_exam_id' => $online_exam_id))->result_array();
        foreach ($question_bank as $question) 
        {
          $correct_answers  = $this->crud->get_correct_answer($question['question_bank_id']);
          $container_2 = array();
          if (isset($_POST[$question['question_bank_id']])) 
          {
              foreach ($this->input->post($question['question_bank_id']) as $row) 
              {
                  $submitted_answer = "";
                  if ($question['type'] == 'true_false') {
                      $submitted_answer = $row;
                  }
                  elseif($question['type'] == 'fill_in_the_blanks'){
                    $suitable_words = array();
                    $suitable_words_array = explode(',', $row);
                    foreach ($suitable_words_array as $key) {
                      array_push($suitable_words, strtolower($key));
                    }
                    $submitted_answer = json_encode(array_map('trim',$suitable_words));
                  }
                  else{
                      array_push($container_2, strtolower($row));
                      $submitted_answer = json_encode($container_2);
                  }
                  $container = array(
                      "question_bank_id" => $question['question_bank_id'],
                      "submitted_answer" => $submitted_answer,
                      "correct_answers"  => $correct_answers
                  );
              }
          }
          else {
              $container = array(
                  "question_bank_id" => $question['question_bank_id'],
                  "submitted_answer" => "",
                  "correct_answers"  => $correct_answers
              );
          }
          array_push($answer_script, $container);
        }
        $this->crud->submit_online_exam($online_exam_id, json_encode($answer_script));
    }
    
    function requestStudentBook()
    {
        $data['book_id']            = $this->input->post('book_id');
        $data['student_id']         = $this->session->userdata('login_user_id');
        $data['issue_start_date']   = strtotime($this->input->post('start'));
        $data['issue_end_date']     = strtotime($this->input->post('end'));
        $this->db->insert('book_request', $data);
    }
    
    function sendFileHomework($homeworkCode)
    {
        ini_set( 'memory_limit', '200M' );
        ini_set('upload_max_filesize', '200M');  
        ini_set('post_max_size', '200M');  
        ini_set('max_input_time', 3600);  
        ini_set('max_execution_time', 3600);
        
        $data['homework_code']   = $homeworkCode;
        $name = substr(md5(rand(0, 1000000)), 0, 7).$_FILES["file_name"]["name"];
        $data['student_id']      = $this->session->userdata('login_user_id');
        $data['date']            = $this->crud->getDateFormat().' '.date('H:i');
        $data['class_id']        = $this->input->post('class_id');
        $data['section_id']      = $this->input->post('section_id');
        $data['file_name']       =  $name;
        $data['student_comment'] = $this->input->post('comment');
        $data['subject_id']      = $this->input->post('subject_id');
        $data['status'] = 1;
        $this->db->insert('deliveries', $data);
        $delivery = $this->db->insert_id();
        include 'public/class.fileuploader.php';
        $FileUploader = new FileUploader('files', array(
            'uploadDir' => './public/uploads/homework_delivery/',
            'replace' => true,
        ));
        $datax = $FileUploader->upload();
        for($i = 0; $i < count($datax['files']); $i++)
        {
            $insert_data['file']          = $datax['files'][$i]['name'];
            $insert_data['homework_code'] = $homeworkCode;
            $insert_data['student_id']    = $this->session->userdata('login_user_id');
            $insert_data['delivery_id']   = $delivery;
            $this->db->insert('homework_files', $insert_data);   
        }
    }
    
    public function sendTextHomework($homeworkCode)
    {
        $data['homework_code']    = $homeworkCode;
        $data['student_id']       = $this->session->userdata('login_user_id');
        $data['date']             = $this->crud->getDateFormat().' '.date('H:i');
        $data['class_id']         = $this->input->post('class_id');
        $data['section_id']       = $this->input->post('section_id');
        $data['homework_reply']   = $this->input->post('reply');
        $data['student_comment']  = $this->input->post('comment');
        $data['subject_id']       = $this->input->post('subject_id');
        $data['status']           = 1;
        $this->db->insert('deliveries', $data);
    }
    
    public function updateTextHomework($id)
    {
        $data['date']             = $this->crud->getDateFormat().' '.date('H:i');
        $data['homework_reply']   = $this->input->post('reply');
        $data['student_comment']  = $this->input->post('comment');
        $this->db->where('id', $id);
        $this->db->update('deliveries', $data);
    }
    
    public function deleteFileHomework($fhomework_file_id)
    {
        $file_n = $this->db->get_where('homework_files', array('fhomework_file_id' => $fhomework_file_id))->row()->file;
        unlink("public/uploads/homework_delivery/" . $file_n);
        $this->db->where('fhomework_file_id',$fhomework_file_id);
        $this->db->delete('homework_files');
    }
    
    function updateFileHomework($id,$homeworkCode)
    {
        ini_set( 'memory_limit', '200M' );
        ini_set('upload_max_filesize', '200M');  
        ini_set('post_max_size', '200M');  
        ini_set('max_input_time', 3600);  
        ini_set('max_execution_time', 3600);
        
        $name = substr(md5(rand(0, 1000000)), 0, 7).$_FILES["file_name"]["name"];
        $data['date']            = $this->crud->getDateFormat().' '.date('H:i');
        $data['file_name']       =  $name;
        $data['student_comment'] = $this->input->post('comment');
        $this->db->where('id', $id);
        $this->db->update('deliveries', $data);
        
        include 'public/class.fileuploader.php';
        $FileUploader = new FileUploader('files', array(
            'uploadDir' => './public/uploads/homework_delivery/',
            'replace' => true,
        ));
        $datax = $FileUploader->upload();
        for($i = 0; $i < count($datax['files']); $i++)
        {
            $insert_data['file']          = $datax['files'][$i]['name'];
            $insert_data['homework_code'] = $homeworkCode;
            $insert_data['student_id']    = $this->session->userdata('login_user_id');
            $insert_data['delivery_id']   = $id;
            $this->db->insert('homework_files', $insert_data);   
        }
    }
    
    public function getOtherLiveClasses($liveId,$classId,$sectionId)
    {
        $this->db->order_by('live_id', 'desc');
        $this->db->where('live_id !=', $liveId);
        $this->db->where('class_id', $classId);
        $this->db->where('section_id', $sectionId);
        $info = $this->db->get('live')->result_array();
        return $info;
    }
    
    public function getOtherLiveClassesForTeacher($liveId,$classId,$sectionId,$subjectId)
    {
        $this->db->order_by('live_id', 'desc');
        $this->db->where('live_id !=', $liveId);
        $this->db->where('class_id', $classId);
        $this->db->where('section_id', $sectionId);
        $this->db->where('subject_id',$subjectId);
        $info = $this->db->get('live')->result_array();
        return $info;
    }
    
    
    
    
    
    
    
    
    
    
}