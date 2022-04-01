<?php if (!defined('BASEPATH')) { exit('No direct script access allowed'); }

class Teacher extends EduAppGT
{
    /*
        Software: EduAppGT PRO - School Management System
        Author: GuateApps - Software, Web and Mobile developer.
        Author URI: https://guateapps.app.
        PHP: 5.6+
        Created: 27 September 16.
    */
    private $runningYear = '';
    
    function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->library('session');
        $this->output->set_header('Last-Modified: ' . gmdate("D, d M Y H:i:s") . ' GMT');
        $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
        $this->output->set_header('Pragma: no-cache');
        $this->output->set_header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
        $this->runningYear = $this->db->get_where('settings' , array('type' => 'running_year'))->row()->description;
    }

    //Live class function.
    function live($param1 = '', $param2 = '')
    {
        $this->isTeacher();
        $page_data['live_id']  = $param1;
        $page_data['page_name']  = 'live';
        $page_data['page_title'] = getEduAppGTLang('live');
        $this->load->view('backend/index', $page_data);
    }
    
    //Delete student delivey
    function delete_delivery($param1 = '', $param2 = '')
    {
        $this->isTeacher();
        if($param1 != ''){
            $this->academic->deleteDelivery($param1);
            $this->session->set_flashdata('flash_message' , getEduAppGTLang('successfully_deleted'));
            redirect(base_url() . 'teacher/homework_details/'.$param2.'/', 'refresh');
        }
    }

    //Live classes function.
    function meet($param1 = '', $param2 = '', $param3 = '')
    {
        $this->isTeacher();
        if($param1 == 'create')
        {
            $this->academic->createLiveClass();
            $this->session->set_flashdata('flash_message' , getEduAppGTLang('successfully_added'));
            redirect(base_url() . 'teacher/meet/'.$param2, 'refresh');
        }
        if($param1 == 'update')
        {
            $this->academic->updateLiveClass($param2);
            $this->session->set_flashdata('flash_message' , getEduAppGTLang('successfully_updated'));
            redirect(base_url() . 'teacher/meet/'.$param3, 'refresh');
        }
        if($param1 == 'delete')
        {
            $this->academic->deleteLiveClass($param2);
            $this->session->set_flashdata('flash_message' , getEduAppGTLang('successfully_deleted'));
            redirect(base_url() . 'teacher/meet/'.$param3, 'refresh');
        }
        $page_data['data'] = $param1;
        $page_data['page_name']  = 'meet';
        $page_data['page_title'] = getEduAppGTLang('meet');
        $this->load->view('backend/index', $page_data);
    }

    //Online exam result function.
    function online_exam_result($param1 = '', $param2 = '') 
    {
        $this->isTeacher();
        $page_data['page_name'] = 'online_exam_result';
        $page_data['param2'] = $param1;
        $page_data['student_id'] = $param2;
        $page_data['page_title'] = getEduAppGTLang('online_exam_results');
        $this->load->view('backend/index', $page_data);
    }

    //Index function.
    public function index()
    {
        if($this->session->userdata('teacher_login') != 1) 
        {
            redirect(base_url(), 'refresh');
        }else{
            redirect(base_url().'teacher/panel/', 'refresh');
        }
    }
    
    //Manage online exam status function.
    function manage_online_exam_status($online_exam_id = "", $status = "", $data = '')
    {
        $this->crud->manage_online_exam_status($online_exam_id, $status);
        redirect(base_url() . 'teacher/online_exams/'.$data."/", 'refresh');
    }
    
    //Create exam function.
    function new_exam($data = '')
    {
        $this->isTeacher();
        $page_data['data'] = $data;
        $page_data['page_name']  = 'new_exam';
        $page_data['page_title'] = getEduAppGTLang('homework_details');
        $this->load->view('backend/index', $page_data);
    }
    
    //Teacher dashboard function.
    function panel()
    {
        $this->isTeacher();
        parse_str(substr(strrchr($_SERVER['REQUEST_URI'], "?"), 1), $_GET);
        if($_GET['id'] != "")
        {
            $notify['status'] = 1;
            $this->db->where('id', $_GET['id']);
            $this->db->update('notification', $notify);
        }
        $page_data['page_name']  = 'panel';
        $page_data['page_title'] = getEduAppGTLang('dashboard');
        $this->load->view('backend/index', $page_data);
    }

    //Classes function.
    function grados($param1 = '', $param2 = '' , $param3 = '')
    {
        $this->isTeacher();
        $page_data['class_id']   = $class_id;
        $page_data['page_name']  = 'grados';
        $page_data['page_title'] = getEduAppGTLang('classes');
        $this->load->view('backend/index', $page_data);
    }

    //Group chat function.
    function group($param1 = "group_message_home", $param2 = "")
    {
        $this->isTeacher();
        if ($param1 == "create_group") 
        {
            $this->crud->create_group();
            $this->session->set_flashdata('flash_message' , getEduAppGTLang('successfully_added'));
            redirect(base_url() . 'teacher/group/', 'refresh');
        }
        else if ($param1 == 'group_message_read') 
        {
            $page_data['current_message_thread_code'] = $param2;
        }
        elseif ($param1 == "edit_group") 
        {
            $this->crud->update_group($param2);
            $this->session->set_flashdata('flash_message' , getEduAppGTLang('successfully_updated'));
            redirect(base_url() . 'teacher/group/', 'refresh');
        }
        elseif($param1 == "delete_group")
        {
            $this->crud->deleteGroup($param2);
            $this->session->set_flashdata('flash_message' , getEduAppGTLang('successfully_deleted'));
            redirect(base_url() . 'teacher/group/', 'refresh');
        }
        else if($param1 == 'send_reply')
        {
            $this->crud->send_reply_group_message($param2);
            $this->session->set_flashdata('flash_message', getEduAppGTLang('message_sent'));
            redirect(base_url() . 'teacher/group/group_message_read/'.$param2, 'refresh');
        }
        else if ($param1 == 'update_group') 
        {
            $page_data['current_message_thread_code'] = $param2;
        }
        $page_data['message_inner_page_name']   = $param1;
        $page_data['page_name']                 = 'group';
        $page_data['page_title']                = getEduAppGTLang('message_group');
        $this->load->view('backend/index', $page_data);
    }

    //Marks print function.
    function marks_print_view($student_id  = '', $exam_id = '') 
    {
        $this->isTeacher();
        $class_id     = $this->db->get_where('enroll' , array('student_id' => $student_id , 'year' => $this->runningYear))->row()->class_id;
        $page_data['student_id'] =   $student_id;
        $page_data['class_id']   =   $class_id;
        $page_data['exam_id']    =   $exam_id;
        $this->load->view('backend/teacher/marks_print_view', $page_data);
    }
    
    //View marks function.
    function view_marks($student_id = '')
    {
        $this->isTeacher();
        $class_id                 = $this->db->get_where('enroll' , array('student_id' => $student_id , 'year' => $this->runningYear))->row()->class_id;
        $page_data['class_id']    =   $class_id;
        $page_data['page_name']   = 'view_marks';
        $page_data['page_title']  = getEduAppGTLang('view_marks');
        $page_data['student_id']  = $student_id;
        $this->load->view('backend/index', $page_data);    
    }

    //Poll response function.
    function polls($param1 = '', $param2 = '')
    {
        $this->isTeacher();
        if($param1 == 'response')
        {
            $this->crud->pollReponse();
        }
    }

    //My routine function.
    function my_routine()
    {
        $this->isTeacher();
        $page_data['page_name']  = 'my_routine';
        $page_data['page_title'] = getEduAppGTLang('teacher_routine');
        $this->load->view('backend/index', $page_data);
    }

    //Behavior report function.
    function student_report($param1 = '', $param2 = '')
    {
        $this->isTeacher();
        if($param1 == 'send')
        {
            $this->academic->createReport();
            $this->session->set_flashdata('flash_message' , getEduAppGTLang('successfully_added'));
            redirect(base_url() . 'teacher/student_report/', 'refresh');
        }
        if($param1 == 'response')
        {
            $this->academic->reportResponse();
        }
        $page_data['page_name']  = 'student_report';
        $page_data['page_title'] = getEduAppGTLang('reports');
        $this->load->view('backend/index', $page_data);
    }

    //View behavior report function.
    function view_report($report_code = '') 
    {
        $this->isTeacher();
        parse_str(substr(strrchr($_SERVER['REQUEST_URI'], "?"), 1), $_GET);
        if($_GET['id'] != "")
        {
            $notify['status'] = 1;
            $this->db->where('id', $_GET['id']);
            $this->db->update('notification', $notify);
        }
        $page_data['code'] = $report_code;
        $page_data['page_name'] = 'view_report';
        $page_data['page_title'] = getEduAppGTLang('report_details');
        $this->load->view('backend/index', $page_data);
    }
    
    //Birthdays function
    function birthdays()
    {
        $this->isTeacher();
        $page_data['page_name']  = 'birthdays';
        $page_data['page_title'] = getEduAppGTLang('birthdays');
        $this->load->view('backend/index', $page_data);
    }
    
    //Calendar function.
    function calendar($param1 = '', $param2 = '')
    {
        $this->isTeacher();
        $page_data['page_name']  = 'calendar';
        $page_data['page_title'] = getEduAppGTLang('calendar');
        $this->load->view('backend/index', $page_data); 
    }

    //Manage news function.
    function news()
    {
        $this->isTeacher();
        $page_data['page_name']  = 'news';
        $page_data['page_title'] = getEduAppGTLang('news');
        $this->load->view('backend/index', $page_data);
    }

    //Update Subject Activity function
    function courses($param1 = '', $param2 = '' , $param3 = '')
    {
        $this->isTeacher();
        if ($param1 == 'update_labs') 
        {
            $class_id = $this->db->get_where('subject', array('subject_id' => $param2))->row()->class_id;
            $this->academic->updateCourseActivity($param2);
            $this->session->set_flashdata('flash_message' , getEduAppGTLang('successfully_updated'));
            redirect(base_url() . 'teacher/upload_marks/'.base64_encode($class_id."-".$this->input->post('section_id')."-".$param2).'/', 'refresh');
        }
    }

    //Tabulation sheet function.
    function tab_sheet($class_id = '' , $exam_id = '', $section_id = '') 
    {
        $this->isTeacher();
        if ($this->input->post('operation') == 'selection') 
        {
            $page_data['exam_id']    = $this->input->post('exam_id');
            $page_data['section_id'] = $this->input->post('section_id');
            $page_data['class_id']   = $this->input->post('class_id');
            if ($page_data['exam_id'] > 0 && $page_data['class_id'] > 0) 
            {
                redirect(base_url() . 'teacher/tab_sheet/' . $page_data['class_id'] . '/' . $page_data['exam_id'] . '/' . $page_data['section_id'] , 'refresh');
            } else {
                redirect(base_url() . 'teacher/tab_sheet/', 'refresh');
            }
        }
        $page_data['exam_id']    = $exam_id;
        $page_data['section_id'] = $section_id;
        $page_data['class_id']   = $class_id;
        $page_data['page_name']  = 'tab_sheet';
        $page_data['page_title'] = getEduAppGTLang('tabulation_sheet');
        $this->load->view('backend/index', $page_data);
    }

    //Print tabulation sheet function.
    function tab_sheet_print($class_id  = '', $exam_id = '', $section_id = '') 
    {
        $this->isTeacher();
        $page_data['class_id']    = $class_id;
        $page_data['exam_id']     = $exam_id;
        $page_data['section_id']  = $section_id;
        $this->load->view('backend/teacher/tab_sheet_print' , $page_data);
    }

    //Get sections by ClassId function.
    function get_class_section($class_id = '')
    {
        $sections = $this->db->get_where('section' , array('class_id' => $class_id))->result_array();
        foreach ($sections as $row) 
        {
            echo '<option value="' . $row['section_id'].'">' . $row['name'] . '</option>';
        }
    }
    
    //Get Subjects by classId function.
    function get_class_subject($class_id = '') 
    {
        $subject = $this->db->get_where('subject' , array('class_id' => $class_id))->result_array();
        foreach ($subject as $row) 
        {
            if ($this->session->userdata('login_user_id') == $row['teacher_id'])
            {
            echo '<option value="' . $row['subject_id'] . '">' . $row['name'] . '</option>';
            }
        }
    }

    //Teachers function.
    function teacher_list($param1 = '', $param2 = '')
    {
        $this->isTeacher();
        $page_data['page_name']  = 'teachers';
        $page_data['page_title'] = getEduAppGTLang('teachers');
        $this->load->view('backend/index', $page_data);
    }

    //Student list function.
    function students_area($id = '')
    {
        $this->isTeacher();
        $id = $this->input->post('class_id');
        if ($id == '')
        {
            $id = $this->db->get('class')->first_row()->class_id;
        }
        $page_data['page_name']   = 'students_area';
        $page_data['page_title']  = getEduAppGTLang('students');
        $page_data['class_id']    = $id;
        $this->load->view('backend/index', $page_data);
    }
    
    //Upload marks function.
    function upload_marks($datainfo = '', $param2 = '')
    {
        $this->isTeacher();
        if($param2 != ""){
            $page = $param2;
        }else{
            $page = $this->db->get('exam')->first_row()->exam_id;
        }
        $this->academic->uploadMarks($datainfo,$page);
        $page_data['exam_id'] = $page;
        $page_data['data'] = $datainfo;
        $page_data['page_name']  =   'upload_marks';
        $page_data['page_title'] = getEduAppGTLang('upload_marks');
        $this->load->view('backend/index', $page_data);
    }
    
    //Update teacher profile.
    function teacher_update()
    {
        $this->isTeacher();
        $page_data['page_name']  = 'teacher_update';
        $page_data['page_title'] =  getEduAppGTLang('profile');
        $page_data['output']     = $this->crud->getGoogleURL();
        $this->load->view('backend/index', $page_data);
    }
    
    //Marks update function.
    function marks_update($exam_id = '' , $class_id = '' , $section_id = '' , $subject_id = '')
    {
        $this->isTeacher();
        $info = $this->academic->updateMarks($exam_id, $class_id, $section_id, $subject_id);
        $this->session->set_flashdata('flash_message' , getEduAppGTLang('successfully_updated'));
        redirect(base_url().'teacher/upload_marks/'.$info.'/'.$exam_id.'/' , 'refresh');
    }
    
    //Subject marks function.
    function subject_marks($data = '') 
    {
        $this->isTeacher();
        $page_data['data'] = $data;
        $page_data['page_name']    = 'subject_marks';
        $page_data['page_title']   = getEduAppGTLang('subject_marks');
        $this->load->view('backend/index',$page_data);
    }
    
    //Manage homeworks function.
    function homework($param1 = '', $param2 = '', $param3 = '') 
    {
        $this->isTeacher();
        if ($param1 == 'create') 
        {
            $homework_code = $this->academic->createHomework();
            $this->session->set_flashdata('flash_message' , getEduAppGTLang('successfully_added'));
            redirect(base_url() . 'teacher/homeworkroom/' . $homework_code , 'refresh');
        }
        if($param1 == 'update')
        {
            $this->academic->updateHomework($param2);
            $this->session->set_flashdata('flash_message' , getEduAppGTLang('successfully_updated'));
            redirect(base_url() . 'teacher/homework_edit/' . $param2 , 'refresh');
        }
        if($param1 == 'review')
        {
            $this->academic->reviewHomework();
            $this->session->set_flashdata('flash_message' , getEduAppGTLang('successfully_updated'));
            redirect(base_url() . 'teacher/homework_details/' . $param2 , 'refresh');
        }
        if($param1 == 'single')
        {
            $this->academic->singleHomework();
            $this->session->set_flashdata('flash_message' , getEduAppGTLang('successfully_updated'));
            redirect(base_url() . 'teacher/single_homework/' . $this->input->post('id') , 'refresh');
        }
        if ($param1 == 'edit') 
        {
            $this->crud->update_homework($param2);
            $this->session->set_flashdata('flash_message' , getEduAppGTLang('successfully_updated'));
            redirect(base_url() . 'teacher/homeworkroom/edit/' . $param2 , 'refresh');
        }
        if ($param1 == 'delete')
        {
            $this->crud->delete_homework($param2);
            $this->session->set_flashdata('flash_message' , getEduAppGTLang('successfully_deleted'));
            redirect(base_url() . 'teacher/homework/'.$param3."/", 'refresh');
        }
        $page_data['data'] = $param1;
        $page_data['page_name'] = 'homework';
        $page_data['page_title'] = getEduAppGTLang('homework');
        $this->load->view('backend/index', $page_data);
    }
    
    //Send notify function.
    function notify($param1 = '', $param2 = '')
    {
        $this->isTeacher();
        if($param1 == 'send_emails')
        {
            $this->mail->teacherSendEmail();
            $this->session->set_flashdata('flash_message' , getEduAppGTLang('sent_successfully'));
            redirect(base_url() . 'teacher/notify/', 'refresh');
        }
        if($param1 == 'sms')
        {       
            $this->crud->teacherSendSMS();
            $this->session->set_flashdata('flash_message' , getEduAppGTLang('sent_successfully'));
            redirect(base_url() . 'teacher/notify/', 'refresh');
        }
        $page_data['page_name']  = 'notify';
        $page_data['page_title'] = getEduAppGTLang('notifications');
        $this->load->view('backend/index', $page_data);
    }
    
    //Subject dashboard function.
    function subject_dashboard($data = '') 
     {
         $this->isTeacher();
         $page_data['data'] = $data;
         $page_data['page_name']    = 'subject_dashboard';
         $page_data['page_title']   = getEduAppGTLang('subject_marks');
         $this->load->view('backend/index',$page_data);
     }
    
    //Subjects function.
    function cursos($class_id = '')
    {
        $this->isTeacher();
        $page_data['class_id']  = $class_id;
        $page_data['page_name']  = 'cursos';
        $page_data['page_title'] = getEduAppGTLang('subjects');
        $this->load->view('backend/index', $page_data);
    }
    
    //Class Routine function.
    function class_routine($class_id = '')
    {
        $this->isTeacher();
        $page_data['page_name']  = 'class_routine';
        $page_data['class_id']  =   $class_id;
        $page_data['page_title'] = getEduAppGTLang('Class-Routine');
        $this->load->view('backend/index', $page_data);
    }

    //My account function.
    function my_account($param1 = "", $page_id = "")
    {
        $this->isTeacher();
        if($param1 == 'remove_facebook')
        {
            $this->user->removeFacebook();
            $this->session->set_flashdata('flash_message' , getEduAppGTLang('facebook_delete'));
            redirect(base_url() . 'teacher/my_account/', 'refresh');
        }
        if($param1 == '1')
        {
            $this->session->set_flashdata('error_message' , getEduAppGTLang('google_err'));
            redirect(base_url() . 'teacher/my_account/', 'refresh');
        }
        if($param1 == '3')
        {
            $this->session->set_flashdata('error_message' , getEduAppGTLang('facebook_err'));
            redirect(base_url() . 'teacher/my_account/', 'refresh');
        }
        if($param1 == '2')
        {
            $this->session->set_flashdata('flash_message' , getEduAppGTLang('google_true'));
            redirect(base_url() . 'teacher/my_account/', 'refresh');
        }
        if($param1 == '4')
        {
            $this->session->set_flashdata('flash_message' , getEduAppGTLang('facebook_true'));
            redirect(base_url() . 'teacher/my_account/', 'refresh');
        }  
        if($param1 == 'remove_google')
        {
            $this->user->removeGoogle();
            $this->session->set_flashdata('flash_message' , getEduAppGTLang('google_delete'));
            redirect(base_url() . 'teacher/my_account/', 'refresh');
        }
        if ($param1 == 'update_profile') 
        {
            $this->user->updateCurrentTeacher();
            $this->session->set_flashdata('flash_message' , getEduAppGTLang('successfully_updated'));
            redirect(base_url() . 'teacher/teacher_update/', 'refresh');
        }
        $data['page_name']          = 'my_account';
        $data['output']             = $this->crud->getGoogleURL();
        $data['page_title']         = getEduAppGTLang('profile');
        $this->load->view('backend/index', $data);
    }

    //Manage attendance function.
    function attendance($data = '', $timestamp = '')
    {
        $this->isTeacher();
        $page_data['page_name']    =  'manage_attendance';
        $page_data['data']         =  $data;
        $page_data['timestamp']    =  $timestamp;
        $page_data['page_title']   =  getEduAppGTLang('attendance');
        $this->load->view('backend/index', $page_data);
    }

    //Attendance selector function.
    function attendance_selector()
    {
        $this->isTeacher();
        $timestamp = $this->crud->attendanceSelector();
        redirect(base_url().'teacher/attendance/'.$this->input->post('data').'/'.$timestamp,'refresh');
    }
    
    //Attendance update function.
    function attendance_update($class_id = '' , $section_id = '', $subject_id = '' , $timestamp = '')
    {
        $this->isTeacher();
        $this->crud->attendanceUpdate($class_id, $section_id,$subject_id, $timestamp);
        $this->session->set_flashdata('flash_message' , getEduAppGTLang('successfully_updated'));
        redirect(base_url().'teacher/attendance/'.base64_encode($class_id.'-'.$section_id.'-'.$subject_id).'/'.$timestamp , 'refresh');
    }
    
    //Manage Study material function.
    function study_material($task = "", $document_id = "", $data = '')
    {
        $this->isTeacher();
        if ($task == "create")
        {
            $this->academic->createMaterial();
            $this->session->set_flashdata('flash_message' , getEduAppGTLang('successfully_uploaded'));
            redirect(base_url() . 'teacher/study_material/'.$document_id."/" , 'refresh');
        }
        if ($task == "delete")
        {
            $this->crud->delete_study_material_info($document_id);
            $this->session->set_flashdata('flash_message' , getEduAppGTLang('successfully_deleted'));
            redirect(base_url() . 'teacher/study_material/'.$data."/");
        }
        $page_data['data'] = $task;
        $page_data['page_name']              = 'study_material';
        $page_data['page_title']             = getEduAppGTLang('study_material');
        $this->load->view('backend/index', $page_data);
    }

    //Library function
    function library($param1 = '', $param2 = '', $param3 = '')
    {
        $this->isTeacher();
        $id = $this->input->post('class_id');
        if ($id == '')
        {
            $id = $this->db->get('class')->first_row()->class_id;
        }
        $page_data['id']  = $id;
        $page_data['page_name']  = 'library';
        $page_data['page_title'] = getEduAppGTLang('library');
        $this->load->view('backend/index', $page_data);
    }
    
    //Query for search function.
    function query($search_key = '') 
    {        
        if ($_POST)
        {
            redirect(base_url() . 'teacher/search_results?query=' . base64_encode($this->input->post('search_key')), 'refresh');
        }
    }

    //Search results function.
    function search_results()
    {
        $this->isTeacher();
        parse_str(substr(strrchr($_SERVER['REQUEST_URI'], "?"), 1), $_GET);
        if ($_GET['query'] == "")
        {
            redirect(base_url(), 'refresh');
        }
        $page_data['search_key'] =  $_GET['query'];
        $page_data['page_name']  =  'search_results';
        $page_data['page_title'] =  getEduAppGTLang('search_results');
        $this->load->view('backend/index', $page_data);
    }

    //Notifications function.
    function notifications()
    {
        $this->isTeacher();
        $page_data['page_name']  =  'notifications';
        $page_data['page_title'] =  getEduAppGTLang('your_notifications');
        $this->load->view('backend/index', $page_data);
    }

    //Chat messages function.
    function message($param1 = 'message_home', $param2 = '', $param3 = '') 
    {
        $this->isTeacher();
        parse_str(substr(strrchr($_SERVER['REQUEST_URI'], "?"), 1), $_GET);
        if($_GET['id'] != "")
        {
            $notify['status'] = 1;
            $this->db->where('id', $_GET['id']);
            $this->db->update('notification', $notify);
        }
        if ($param1 == 'send_new') 
        {
            $message_thread_code = $this->crud->send_new_private_message();
            $this->session->set_flashdata('flash_message' , getEduAppGTLang('message_sent'));
            redirect(base_url() . 'teacher/message/message_read/' . $message_thread_code, 'refresh');
        }
        if ($param1 == 'send_reply') 
        {
            $this->crud->send_reply_message($param2);
            $this->session->set_flashdata('flash_message' , getEduAppGTLang('reply_sent'));
            redirect(base_url() . 'teacher/message/message_read/' . $param2, 'refresh');
        }
        if ($param1 == 'message_read') 
        {
            $page_data['current_message_thread_code'] = $param2; 
            $this->crud->mark_thread_messages_read($param2);
        }
        $page_data['infouser'] = $param2;
        $page_data['message_inner_page_name']   = $param1;
        $page_data['page_name']                 = 'message';
        $page_data['page_title']                = getEduAppGTLang('private_messages');
        $this->load->view('backend/index', $page_data);
    }

    //Manage permissions function.
    function request($param1 = "", $param2 = "")
    {
        $this->isTeacher();
        parse_str(substr(strrchr($_SERVER['REQUEST_URI'], "?"), 1), $_GET);
        if($_GET['id'] != "")
        {
            $notify['status'] = 1;
            $this->db->where('id', $_GET['id']);
            $this->db->update('notification', $notify);
        }
        if ($param1 == "create")
        {
            $this->crud->permission_request();
            $this->session->set_flashdata('flash_message' , getEduAppGTLang('successfully_added'));
            redirect(base_url() . 'teacher/request', 'refresh');
        }
        $data['page_name']  = 'request';
        $data['page_title'] = getEduAppGTLang('permissions');
        $this->load->view('backend/index', $data);
    }

    //Homework details function.
    function homeworkroom($param1 = '' , $param2 = '')
    {
        $this->isTeacher();
        if ($param1 == 'file') 
        {
            $page_data['room_page']    = 'homework_file';
            $page_data['homework_code'] = $param2;
        }  
        else if ($param1 == 'details') 
        {
            $page_data['room_page'] = 'homework_details';
            $page_data['homework_code'] = $param2;
        }
        else if ($param1 == 'edit') 
        {
            $page_data['room_page'] = 'homework_edit';
            $page_data['homework_code'] = $param2;
        }
        $page_data['homework_code'] =   $param1;
        $page_data['page_name']   = 'homework_room'; 
        $page_data['page_title']  = getEduAppGTLang('homework');
        $this->load->view('backend/index', $page_data);
    }

    //Homework file function.
    function homework_file($param1 = '', $param2 = '', $param3 = '') 
    {
        $this->isTeacher();
        $homework_code = $this->db->get_where('homework', array('homework_id'))->row()->homework_code;
        if ($param1 == 'upload')
        {
            $this->crud->upload_homework_file($param2);
        }
        else if ($param1 == 'download')
        {
            $this->crud->download_homework_file($param2);
        }
        else if ($param1 == 'delete')
        {
            $this->crud->delete_homework_file($param2);
            redirect(base_url() . 'teacher/homeworkroom/details/' . $homework_code , 'refresh');
        }
    }

    //Manage forums function.
    function forum($param1 = '', $param2 = '', $param3 = '') 
    {
        $this->isTeacher();
        if ($param1 == 'create') 
        {
            $this->academic->createForum();
            $this->session->set_flashdata('flash_message' , getEduAppGTLang('successfully_added'));
            redirect(base_url() . 'teacher/forum/' . $param2."/" , 'refresh');
        }
        if ($param1 == 'update') 
        {
            $this->academic->updateForum($param2);
            $this->session->set_flashdata('flash_message' , getEduAppGTLang('successfully_updated'));
            redirect(base_url() . 'teacher/edit_forum/' . $param2 , 'refresh');
        }
        if ($param1 == 'delete')
        {
            $this->crud->delete_post($param2);
            $this->session->set_flashdata('flash_message' , getEduAppGTLang('successfully_deleted'));
            redirect(base_url() . 'teacher/forum/'.$param3."/" , 'refresh');
        }
        $page_data['data'] = $param1;
        $page_data['page_name'] = 'forum';
        $page_data['page_title'] = getEduAppGTLang('forum');
        $this->load->view('backend/index', $page_data);
    }

    //Single homework function.
    function single_homework($param1 = '', $param2 = '') 
    {
       $this->isTeacher();
       $page_data['answer_id'] = $param1;
       $page_data['page_name'] = 'single_homework';
       $page_data['page_title'] = getEduAppGTLang('homework');
       $this->load->view('backend/index', $page_data);
    }
    
    //Create online exam function.
    function create_online_exam($info = '') 
    {
        $this->isTeacher();
        $this->academic->createOnlineExam();
        $this->session->set_flashdata('flash_message' , getEduAppGTLang('successfully_added'));
        redirect(base_url().'teacher/online_exams/'.$info."/", 'refresh');
    }

    //Delete exams function.
    function manage_exams($param1 = '', $param2 = '', $param3 = '')
    {
        $this->isTeacher();
        if($param1 == 'delete')
        {
            $this->crud->deleteExam($param2);
            $this->session->set_flashdata('flash_message' , getEduAppGTLang('successfully_added'));
            redirect(base_url() . 'teacher/online_exams/'.$param3."/", 'refresh');
        }
    }

    //Homework details function.
    function homework_details($param1 = '', $param2 = '', $param3 = '')
    {
        $this->isTeacher();
        $page_data['homework_code'] = $param1;
        $page_data['page_name']  = 'homework_details';
        $page_data['page_title'] = getEduAppGTLang('homework_details');
        $this->load->view('backend/index', $page_data);
    }

    //Online exams function.
    function online_exams($param1 = '', $param2 = '', $param3 ='') 
    {
        $this->isTeacher();
        if ($param1 == 'edit') 
        {
            if ($this->input->post('class_id') > 0 && $this->input->post('section_id') > 0 && $this->input->post('subject_id') > 0) {
                $this->crud->update_online_exam();
                $this->session->set_flashdata('flash_message' , getEduAppGTLang('successfully_updated'));
                redirect(base_url() . 'teacher/exam_edit/' . $this->input->post('online_exam_id'), 'refresh');
            }
            else{
                $this->session->set_flashdata('error_message' , getEduAppGTLang('error'));
                redirect(base_url() . 'teacher/exam_edit/' . $this->input->post('online_exam_id'), 'refresh');
            }
        }
        if ($param1 == 'questions') 
        {
            $this->crud->add_questions();
            $this->session->set_flashdata('flash_message' , getEduAppGTLang('successfully_added'));
            redirect(base_url() . 'teacher/exam_questions/' . $param2 , 'refresh');
        }
        if ($param1 == 'delete_questions') 
        {
            $this->db->where('question_id', $param2);
            $this->db->delete('questions');
            $this->session->set_flashdata('flash_message' , getEduAppGTLang('successfully_deleted'));
            redirect(base_url() . 'teacher/exam_questions/'.$param3, 'refresh');
        }
        if ($param1 == 'delete'){
            $this->crud->delete_exam($param2);
            $this->session->set_flashdata('flash_message' , getEduAppGTLang('successfully_deleted'));
            redirect(base_url() . 'teacher/online_exams/', 'refresh');
        }
        $page_data['data'] = $param1;
        $page_data['page_name'] = 'online_exams';
        $page_data['page_title'] = getEduAppGTLang('online_exams');
        $this->load->view('backend/index', $page_data);
    }

    //Online exam details function.
    function examroom($param1 = '' , $param2 = '')
    {
        $this->isTeacher();
        $page_data['page_name']   = 'exam_room'; 
        $page_data['online_exam_id']  = $param1;
        $page_data['page_title']  = getEduAppGTLang('online_exams');
        $this->load->view('backend/index', $page_data);
    }

    //Exam question function.
    function exam_questions($exam_code = '') 
    {    
        $this->isTeacher();
        $page_data['exam_code'] = $exam_code;
        $page_data['page_name'] = 'exam_questions';
        $page_data['page_title'] = getEduAppGTLang('exam_questions');
        $this->load->view('backend/index', $page_data);
    }
    
    //Delete online exam question function.
    function delete_question_from_online_exam($question_id = '')
    {
        $this->isTeacher();
        $online_exam_id = $this->db->get_where('question_bank', array('question_bank_id' => $question_id))->row()->online_exam_id;
        $this->crud->delete_question_from_online_exam($question_id);
        $this->session->set_flashdata('flash_message' , getEduAppGTLang('successfully_deleted'));
        redirect(base_url() . 'teacher/examroom/'.$online_exam_id, 'refresh');
    }

    //Update online exam question function.
    function update_online_exam_question($question_id = "", $task = "", $online_exam_id = "") 
    {
        $this->isTeacher();
        $online_exam_id = $this->db->get_where('question_bank', array('question_bank_id' => $question_id))->row()->online_exam_id;
        $type = $this->db->get_where('question_bank', array('question_bank_id' => $question_id))->row()->type;
        if ($task == "update") {
            if ($type == 'multiple_choice') {
                $this->crud->update_multiple_choice_question($question_id);
            }
            elseif($type == 'true_false'){
                $this->crud->update_true_false_question($question_id);
            }
            elseif($type == 'image'){
                $this->crud->update_image_question($question_id);
            }
            elseif($type == 'fill_in_the_blanks'){
                $this->crud->update_fill_in_the_blanks_question($question_id);
            }
            redirect(base_url() . 'teacher/examroom/'.$online_exam_id, 'refresh');
        }
        $page_data['question_id'] = $question_id;
        $page_data['page_name'] = 'update_online_exam_question';
        $page_data['page_title'] = getEduAppGTLang('update_questions');
        $this->load->view('backend/index', $page_data);
    }
    
    //Manage online exam questions function.
    function manage_online_exam_question($online_exam_id = "", $task = "", $type = "")
    {
        $this->isTeacher();
        if ($task == 'add') {
            if ($type == 'multiple_choice') {
                $this->crud->add_multiple_choice_question_to_online_exam($online_exam_id);
            }
            elseif ($type == 'true_false') {
                $this->crud->add_true_false_question_to_online_exam($online_exam_id);
            }
            elseif ($type == 'image') {
                $this->crud->add_image_question_to_online_exam($online_exam_id);
            }
            elseif ($type == 'fill_in_the_blanks') {
                $this->crud->add_fill_in_the_blanks_question_to_online_exam($online_exam_id);
            }
            redirect(base_url() . 'teacher/examroom/'.$online_exam_id, 'refresh');
        }
    }
    
    //Manage image questions function.
    function manage_image_options() 
    {
        $page_data['number_of_options'] = $this->input->post('number_of_options');
        $this->load->view('backend/teacher/manage_image_options', $page_data);
    }
    
    //Manage multiple choice questions function.
    function manage_multiple_choices_options() 
    {
        $page_data['number_of_options'] = $this->input->post('number_of_options');
        $this->load->view('backend/teacher/manage_multiple_choices_options', $page_data);
    }
    
    //Load question by type function.
    function load_question_type($type = '', $online_exam_id = '') 
    {
        $page_data['question_type'] = $type;
        $page_data['online_exam_id'] = $online_exam_id;
        $this->load->view('backend/teacher/online_exam_add_'.$type, $page_data);
    }

    //See exam results function.
    function exam_results($exam_code = '') 
    { 
        $this->isTeacher();
        parse_str(substr(strrchr($_SERVER['REQUEST_URI'], "?"), 1), $_GET);
        if($_GET['id'] != "")
        {
            $notify['status'] = 1;
            $this->db->where('id', $_GET['id']);
            $this->db->update('notification', $notify);
        }
        $page_data['online_exam_id'] = $exam_code;
        $page_data['page_name'] = 'exam_results';
        $page_data['page_title'] = getEduAppGTLang('exams_results');
        $this->load->view('backend/index', $page_data);
    }

    //Edit exam function.
    function exam_edit($exam_code= '') 
    { 
        $this->isTeacher();
        $page_data['online_exam_id'] = $exam_code;
        $page_data['page_name'] = 'exam_edit';
        $page_data['page_title'] = getEduAppGTLang('update_exam');
        $this->load->view('backend/index', $page_data);
    }

    //Edit homework function.
    function homework_edit($homework_code = '') 
    {   
        $this->isTeacher();
        $page_data['homework_code'] = $homework_code;
        $page_data['page_name'] = 'homework_edit';
        $page_data['page_title'] = getEduAppGTLang('homework');
        $this->load->view('backend/index', $page_data);
    }

    //Forum details function.
    function forumroom($param1 = '' , $param2 = '')
    {
        $this->isTeacher();
        parse_str(substr(strrchr($_SERVER['REQUEST_URI'], "?"), 1), $_GET);
        if($_GET['id'] != "")
        {
            $notify['status'] = 1;
            $this->db->where('id', $_GET['id']);
            $this->db->update('notification', $notify);
        }
        if ($param1 == 'comment') 
        {
            $page_data['room_page']    = 'comments';
            $page_data['post_code'] = $param2; 
        }
        else if ($param1 == 'posts') 
        {
            $page_data['room_page'] = 'post';
            $page_data['post_code'] = $param2; 
        }
        else if ($param1 == 'edit') 
        {
            $page_data['room_page'] = 'post_edit';
            $page_data['post_code'] = $param2;
        }
        $page_data['page_name']   = 'forum_room'; 
        $page_data['post_code']   = $param1;
        $page_data['page_title']  = getEduAppGTLang('forum');
        $this->load->view('backend/index', $page_data);
    }

    //Delete notification function.
    function notification($param1 ='', $param2 = '')
    {
        $this->isTeacher();
        if($param1 == 'delete')
        {
            $this->crud->deleteNotification($param2);
            $this->session->set_flashdata('flash_message' , getEduAppGTLang('successfully_deleted'));
            redirect(base_url() . 'teacher/notifications/', 'refresh');
        }
    }

    //Edit forum function.
    function edit_forum($code = '')
    {
        $this->isTeacher();
        $page_data['page_name']  = 'edit_forum';
        $page_data['page_title'] = getEduAppGTLang('update_forum');
        $page_data['code']   = $code;
        $this->load->view('backend/index', $page_data);    
    }

    //Create forum message function.
    function forum_message($param1 = '', $param2 = '', $param3 = '') 
    {
        $this->isTeacher();
        if ($param1 == 'add') 
        {
            $this->crud->create_post_message($this->input->post('post_code'));
        }
    }
    
    //Check teacher session function.
    function isTeacher()
    {
        if ($this->session->userdata('teacher_login') != 1) 
        {
            redirect(base_url(), 'refresh');
        }
    }
    
    //End of Teacher.php
}