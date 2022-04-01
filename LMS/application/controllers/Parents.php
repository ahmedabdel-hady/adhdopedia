<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
    
class Parents extends EduAppGT
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
    
    //Subject dashbaord function.
    function subject_dashboard($data = '') 
    {
        $this->isParent();
        $page_data['data'] = $data;
        $page_data['page_name']    = 'subject_dashboard';
        $page_data['page_title']   = getEduAppGTLang('subject_marks');
        $this->load->view('backend/index',$page_data);
    }
     
    //View student progress function
    function progress()
    {
        $this->isParent();
        $page_data['page_name']  = 'progress';
        $page_data['page_title'] = getEduAppGTLang('progress');
        $this->load->view('backend/index', $page_data);
    }
    
    //View subjects function
    function subjects()
    {
        $this->isParent();
        $page_data['page_name']  = 'subjects';
        $page_data['page_title'] = getEduAppGTLang('manage_class');
        $this->load->view('backend/index', $page_data);
    }
    
    //Birthdays function.
    function birthdays()
    {
        $this->isParent();
        $page_data['page_name']  = 'birthdays';
        $page_data['page_title'] = getEduAppGTLang('birthdays');
        $this->load->view('backend/index', $page_data);
    }

    //Manage notifications function.
    function notifications() 
    {
        $this->isParent();
        $page_data['page_name']  =  'notifications';
        $page_data['page_title'] =  getEduAppGTLang('your_notifications');
        $this->load->view('backend/index', $page_data);
    }
    
    //Calendar events function.
    function calendar($param1 = '', $param2 = '')
    {
        $this->isParent();
        parse_str(substr(strrchr($_SERVER['REQUEST_URI'], "?"), 1), $_GET);
        if($_GET['id'] != "")
        {
            $notify['status'] = 1;
            $this->db->where('id', $_GET['id']);
            $this->db->update('notification', $notify);
        }
        $page_data['page_name']  = 'calendar';
        $page_data['page_title'] = getEduAppGTLang('calendar_events');
        $this->load->view('backend/index', $page_data); 
    }
    
    //Index function.
    public function index()
    {
        if ($this->session->userdata('parent_login') != 1)
        { 
            redirect(base_url(), 'refresh');
        }else{
            redirect(base_url().'parents/panel/', 'refresh');
        }
    }

    //Delete notifications function.
    function notification($param1 ='', $param2 = '')
    {
        $this->isParent();
        if($param1 == 'delete')
        {
            $this->crud->deleteNotification($param2);
            $this->session->set_flashdata('flash_message' , getEduAppGTLang('successfully_deleted'));
            redirect(base_url() . 'parents/notifications/', 'refresh');
        }
    }

    //Group chat function.
    function group($param1 = "group_message_home", $param2 = "")
    {
        $this->isParent();
        if ($param1 == 'group_message_read') 
        {
            $page_data['current_message_thread_code'] = $param2;
        }
        else if($param1 == 'send_reply')
        {
            $this->crud->send_reply_group_message($param2); 
            $this->session->set_flashdata('flash_message', getEduAppGTLang('message_sent'));
            redirect(base_url() . 'parents/group/group_message_read/'.$param2, 'refresh');
        }
        $page_data['message_inner_page_name']   = $param1;
        $page_data['page_name']                 = 'group';
        $page_data['page_title']                = getEduAppGTLang('message_group');
        $this->load->view('backend/index', $page_data);
    }

    //View behavior report function.
    function view_report($report_code = '') 
    {
        $this->isParent();
        $page_data['code'] = $report_code;
        $page_data['page_name'] = 'view_report';
        $page_data['page_title'] = getEduAppGTLang('report_details');
        $this->load->view('backend/index', $page_data);
    }

    //Student reports function.
    function student_report($param1 = '', $param2 = '')
    {
        $this->isParent();
        if($param1 == 'response')
        {
            $this->academic->reportResponse();
        }
        $page_data['page_name']  = 'student_report';
        $page_data['page_title'] = getEduAppGTLang('reports');
        $this->load->view('backend/index', $page_data);
    }

    //My profile function.
    function my_profile($param1 = "", $page_id = "")
    {
        $this->isParent();
        if($param1 == 'remove_facebook')
        {
            $this->user->removeFacebook();
            $this->session->set_flashdata('flash_message' , getEduAppGTLang('facebook_delete'));
            redirect(base_url() . 'parents/my_profile/', 'refresh');
        }
        if($param1 == '1')
        {
            $this->session->set_flashdata('error_message' , getEduAppGTLang('google_err'));
            redirect(base_url() . 'parents/my_profile/', 'refresh');
        }
        if($param1 == '3')
        {
            $this->session->set_flashdata('error_message' , getEduAppGTLang('facebook_err'));
            redirect(base_url() . 'parents/my_profile/', 'refresh');
        }
        if($param1 == '2')
        {
            $this->session->set_flashdata('flash_message' , getEduAppGTLang('google_true'));
            redirect(base_url() . 'parents/my_profile/', 'refresh');
        }
        if($param1 == '4')
        {
            $this->session->set_flashdata('flash_message' , getEduAppGTLang('facebook_true'));
            redirect(base_url() . 'parents/my_profile/', 'refresh');
        }  
        if($param1 == 'remove_google')
        {
            $this->user->removeGoogle();
            $this->session->set_flashdata('flash_message' , getEduAppGTLang('google_delete'));
            redirect(base_url() . 'parents/my_profile/', 'refresh');
        }       
        if($param1 == 'update')
        {
            $this->user->updateParent($this->session->userdata('login_user_id'));
            $this->session->set_flashdata('flash_message' , getEduAppGTLang('successfully_updated'));
            redirect(base_url() . 'parents/parent_update/', 'refresh');
        }
        $data['output']                 = $this->crud->getGoogleURL();
        $data['page_name']              = 'my_profile';
        $data['page_title']             =  getEduAppGTLang('profile');
        $this->load->view('backend/index', $data);
    }

    //Parent update profile function.
    function parent_update($parent_id = '')
    {
        $this->isParent();
        $page_data['output']  = $this->crud->getGoogleURL();
        $page_data['page_name']  = 'parent_update';
        $page_data['page_title'] = getEduAppGTLang('profile');
        $this->load->view('backend/index', $page_data);
    }
    
    //Subject marks function.
    function subject_marks($data = '', $param2 = '') 
    {
        $this->isParent();
        if($param2 != ""){
            $page = $param2;
        }else{
            $page = $this->db->get('exam')->first_row()->exam_id;
        }
        $page_data['exam_id'] = $page;
        $page_data['data'] = $data;
        $page_data['page_name']    = 'subject_marks';
        $page_data['page_title']   = getEduAppGTLang('marks');
        $this->load->view('backend/index',$page_data);
    }

    //Online exams results function.
    function online_exam_result($param1 = '', $param2 = '') 
    {
        $this->isParent();
        $page_data['page_name'] = 'online_exam_result';
        $page_data['param2'] = $param1;
        $page_data['student_id'] = $param2;
        $page_data['page_title'] = getEduAppGTLang('online_exam_results');
        $this->load->view('backend/index', $page_data);
    }
    
    //View online exams function.
    function online_exams($student_id = '')
    {
        $this->isParent();
        $info = base64_decode($student_id);
        $ex = explode('-', $info);
        
        $page_data['exams'] = $this->crud->parent_available_exams($ex[0],$ex[1],$ex[2]);
        $page_data['page_name']  = 'online_exams';
        $page_data['data'] = $student_id;
        $page_data['page_title'] = getEduAppGTLang('online_exams');
        $this->load->view('backend/index', $page_data);
    }

    //Poll response function.
    function polls($param1 = '', $param2 = '')
    {
        $this->isParent();
        if($param1 == 'response')
        {
            $this->crud->pollReponse();
        }
    }

    //Homework function.
    function homework($student_id = '')
    {
        $this->isParent();
        $page_data['page_name']  = 'homework';
        $page_data['data']   = $student_id;
        $page_data['page_title'] = getEduAppGTLang('homework');
        $this->load->view('backend/index', $page_data);
    }

    //Study material function.
    function study_material($task = '')
    {
        $this->isParent();
        $page_data['data']              = $task;
        $page_data['page_name']  = 'study_material';
        $page_data['page_title'] =  getEduAppGTLang('study_material');
        $this->load->view('backend/index', $page_data);
    }
    
    //Forum view function.
    function forumroom($param1 = '' , $param2 = '')
    {
        $this->isParent();
        $page_data['post_code'] = $param1;
        $page_data['student_id'] = $param2;
        $page_data['page_name']   = 'forum_room'; 
        $page_data['page_title']  = getEduAppGTLang('forum');
        $this->load->view('backend/index', $page_data);
    }
    
    //Forum function.
    function forum($param1 = '', $param2 = '', $student_id = '') 
    {
        $this->isParent();
        $page_data['page_name'] = 'forum';
        $page_data['page_title'] = getEduAppGTLang('forum');
        $page_data['data']   = $param1;
        $this->load->view('backend/index', $page_data);
    }
    
    //Homework function.
    function homeworkroom($param1 = '' , $param2 = '')
    {
        $this->isParent();
        $page_data['homework_code'] = $param1;
        $page_data['student_id'] = $param2;
        $page_data['page_name']   = 'homework_room'; 
        $page_data['page_title']  = getEduAppGTLang('homework');
        $this->load->view('backend/index', $page_data);
    }

    //View invoice function.
    function view_invoice($id = '')
    {
        $this->isParent();
        $page_data['invoice_id'] = $id;
        $page_data['page_name']  = 'view_invoice';
        $page_data['page_title'] = getEduAppGTLang('view_invoice');
        $this->load->view('backend/index', $page_data);
    }

    //Parent dashboard function.
    function panel()
    {
        $this->isParent();
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

    //Teachers function.
    function teachers()
    {
        $this->isParent();
        $page_data['page_name']  = 'teachers';
        $page_data['page_title'] = getEduAppGTLang('teachers');
        $this->load->view('backend/index', $page_data);
    }

    //Pint marks function.
    function marks_print_view($student_id , $exam_id = '') 
    {
        $this->isParent();
        $ex = explode('-', base64_decode($student_id));
        $class_id     = $this->db->get_where('enroll' , array('student_id' => $ex[0] , 'year' => $this->db->get_where('settings' , array('type' => 'running_year'))->row()->description))->row()->class_id;
        $page_data['student_id'] =   $student_id;
        $page_data['class_id']   =   $class_id;
        $page_data['exam_id']    =   $exam_id;
        $this->load->view('backend/parent/marks_print_view', $page_data);
    }

    //Noticeboard function.
    function noticeboard($param1 = '', $param2 = '') 
    {
        $this->isParent();
        $page_data['page_name'] = 'noticeboard';
        $page_data['page_title'] = getEduAppGTLang('news');
        $this->load->view('backend/index', $page_data);
    }

    //View marks function.
    function marks($param1 = '', $param2 ='')
    {
        $this->isParent();
        $this->crud->checkChildrens($param1);
        $page_data['page_name']  = 'marks';
        $page_data['page_title'] = getEduAppGTLang('marks');
        $this->load->view('backend/index', $page_data);
    }

    //Library function.
    function library($param1 = '', $param2 = '', $param3 = '')
    {
        $this->isParent();
        $page_data['page_name']  = 'library';
        $page_data['page_title'] = getEduAppGTLang('library');
        $this->load->view('backend/index', $page_data);
    }
    
    //View class routine function.
    function class_routine($param1 = '', $param2 = '', $param3 = '')
    {
        $this->isParent();
        $page_data['student_id'] = $param1;
        $page_data['page_name']  = 'class_routine';
        $page_data['page_title'] = getEduAppGTLang('class_routine');
        $this->load->view('backend/index', $page_data);
    }

    //Attendance report function.
    function attendance_report($data = '',$month = '', $year = '') 
    {
        $this->isParent();
        $page_data['month']        = $month;
        $page_data['data']         = $data;
        $page_data['year']         = $year;
        $page_data['page_name']    = 'attendance_report';
        $page_data['page_title']   = getEduAppGTLang('attendance_report');
        $this->load->view('backend/index',$page_data);
    }

    //Attendance selector fuction.
    function attendance_report_selector()
    {
        $this->isParent();
        $data['year']       = $this->input->post('year');
        $data['month']      = $this->input->post('month');
        $data['data']       = $this->input->post('data');
        redirect(base_url().'parents/attendance_report/'.$data['data'].'/'.$data['month'].'/'.$data['year'],'refresh');
    }
    
    //Manage invoices function.
    function invoice($student_id = '' , $param1 = '', $param2 = '', $param3 = '')
    {
        $this->isParent();
        if ($param1 == 'make_payment') 
        {
            $this->payment->makePayPal();
        }
        if ($param1 == 'paypal_cancel') 
        {
            $this->session->set_flashdata('error_message' , getEduAppGTLang('payment_cancelled_by_user'));
            redirect(base_url() . 'parents/invoice/' . $student_id, 'refresh');
        }
        if ($param1 == 'paypal_success') 
        {
            $this->payment->paypalSuccess();
            $this->session->set_flashdata('error_message' , getEduAppGTLang('thanks_for_your_payment'));
            redirect(base_url() . 'parents/invoice/'.$student_id, 'refresh');
        }
        if ($student_id == 'student') 
        {
            redirect(base_url() . 'parents/invoice/' . $this->input->post('student_id'), 'refresh');
        }
        $page_data['student_id'] = $student_id;
        $page_data['page_name']  = 'invoice';
        $page_data['page_title'] = getEduAppGTLang('payments');
        $this->load->view('backend/index', $page_data);
    }

    //Send news message.
    function news_message($param1 = '', $param2 = '', $param3 = '')
    {
        $this->isParent();
        if ($param1 == 'add') 
        {
            $this->crud->create_news_message($this->input->post('news_code'));
        }
    }
    
    //View exam results function.
    function exam_results($code = '') 
    {
        $this->isParent();
        $page_data['exam_code']     = $code;
        $page_data['page_name']     = 'exam_results';
        $page_data['page_title']    = getEduAppGTLang('exam_results');
        $this->load->view('backend/index', $page_data);
    }

    //Request permission function.
    function request($param1 = "", $param2 = "")
    {
        $this->isParent();
        parse_str(substr(strrchr($_SERVER['REQUEST_URI'], "?"), 1), $_GET);
        if($_GET['id'] != "")
        {
            $notify['status'] = 1;
            $this->db->where('id', $_GET['id']);
            $this->db->update('notification', $notify);
        }
        if ($param1 == "create")
        {
            $this->crud->parentRequestPermission();
            $this->session->set_flashdata('flash_message', getEduAppGTLang('successfully_added'));
            redirect(base_url() . 'parents/request', 'refresh');
        }
        $data['page_name']  = 'request';
        $data['page_title'] = getEduAppGTLang('permissions');
        $this->load->view('backend/index', $data);
    }
    
    //Chat message function.
    function message($param1 = 'message_home', $param2 = '', $param3 = '') 
    {
        $this->isParent();
        parse_str(substr(strrchr($_SERVER['REQUEST_URI'], "?"), 1), $_GET);
        if($_GET['id'] != "")
        {
            $notify['status'] = 1;
            $this->db->where('id', $_GET['id']);
            $this->db->update('notification', $notify);
        }
        if ($param1 == 'send_new') 
        {
            $this->session->set_flashdata('flash_message' , getEduAppGTLang('message_sent'));
            $message_thread_code = $this->crud->send_new_private_message();
            $this->session->set_flashdata('flash_message' , getEduAppGTLang('message_sent'));
            redirect(base_url() . 'parents/message/message_read/' . $message_thread_code, 'refresh');
        }
        if ($param1 == 'send_reply') 
        {
            $this->crud->send_reply_message($param2);
            $this->session->set_flashdata('flash_message' , getEduAppGTLang('reply_sent'));
            redirect(base_url() . 'parents/message/message_read/' . $param2, 'refresh');
        }
        if ($param1 == 'message_read') 
        {
            $page_data['current_message_thread_code'] = $param2; 
            $this->crud->mark_thread_messages_read($param2);
        }
        $page_data['infouser']                  = $param2;
        $page_data['message_inner_page_name']   = $param1;
        $page_data['page_name']                 = 'message';
        $page_data['page_title']                = getEduAppGTLang('private_messages');
        $this->load->view('backend/index', $page_data);
    }
    
    //Check parent session function.
    function isParent()
    {
        if ($this->session->userdata('parent_login') != 1)
        { 
            redirect(base_url(), 'refresh');
        }   
    }
    
    //End of Parents.php
}