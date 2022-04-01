<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
    
class Mail extends School 
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
        $this->runningYear = $this->db->get_where('settings' , array('type' => 'running_year'))->row()->description;
    }
    
    //Submit email for behavior report.
    function students_reports($student_name,$parent_email)
    {
        $parent_id = $this->db->get_where('student', array('student_id' => $this->input->post('student_id')))->row()->parent_id;
        $s_name = $this->crud->get_name('student', $this->input->post('student_id'));
        $email_sub  = $this->db->get_where('email_template' , array('task' => 'student_reports'))->row()->subject;
        $email_msg  = $this->db->get_where('email_template' , array('task' => 'student_reports'))->row()->body;
        $PARENT_NAME =   $this->crud->get_name('parent', $parent_id);
        $email_msg   =   str_replace('[PARENT]' , $PARENT_NAME, $email_msg);
        $email_msg   =   str_replace('[STUDENT]' , $s_name , $email_msg);
        $email_to    =   $this->db->get_where('parent' , array('parent_id' => $parent_id))->row()->email;
        $email_data = array(
            'email_msg' => $email_msg
        );
        if($email_to != ''){
            $this->submit($email_to,$email_sub,$email_data,'notify');
        }
    }
    
    //Send attendance notification.
    function attendance($student_id,$parent_id)
    {
        $email_sub      = $this->db->get_where('email_template' , array('task' => 'student_absences'))->row()->subject;
        $email_msg      = $this->db->get_where('email_template' , array('task' => 'student_absences'))->row()->body;
        $STUDENT_NAME   = $this->crud->get_name('student', $student_id);
        $PARENT_NAME    = $this->crud->get_name('parent', $parent_id);
        $email_msg      = str_replace('[PARENT]' , $PARENT_NAME, $email_msg);
        $email_msg      = str_replace('[STUDENT]' , $STUDENT_NAME , $email_msg);
        $email_to       = $this->db->get_where('parent', array('parent_id' => $parent_id))->row()->email;
        
        $data = array(
            'email_msg' => $email_msg
        );
        if($email_to != '')
        {
            $this->submit($email_to,$email_sub,$data,'notify');
        }
    }
    
    //Send notifify to parents for new invoice.
    function parent_new_invoice($student_name,$parent_email)
    {
        $email_sub       = $this->db->get_where('email_template' , array('task' => 'parent_new_invoice'))->row()->subject;
        $email_msg       = $this->db->get_where('email_template' , array('task' => 'parent_new_invoice'))->row()->body;
        $parentId        = $this->db->get_where('parent' , array('email' => $parent_email))->row()->parent_id;
        $STUDENT_NAME    = $student_name;
        $PARENT_NAME     = $this->crud->get_name('parent' , $parentId);
        $email_msg       = str_replace('[PARENT]' , $PARENT_NAME, $email_msg);
        $email_msg       = str_replace('[STUDENT]' , $STUDENT_NAME , $email_msg);
        $email_to        = $parent_email;
        $data = array(
            'email_msg' => $email_msg
        );
        if($email_to != '')
        {
            $this->submit($email_to,$email_sub,$data,'notify');
        }
    }
    
    //Send notifify to students for new invoice.
    function student_new_invoice($student_name,$student_email)
    {
        $email_sub      = $this->db->get_where('email_template' , array('task' => 'student_new_invoice'))->row()->subject;
        $email_msg      = $this->db->get_where('email_template' , array('task' => 'student_new_invoice'))->row()->body;
        $STUDENT_NAME   = $student_name;
        $email_msg      = str_replace('[STUDENT]' , $STUDENT_NAME , $email_msg);
        $email_to       = $student_email;
        $data = array(
            'email_msg' => $email_msg
        );
        if($email_to != '')
        {
            $this->submit($email_to,$email_sub,$data,'notify');
        }
    }
    
    //Submit notification to students.
    function send_homework_notify()
    {
        $subj       = $this->db->get_where('subject', array('subject_id' => $this->input->post('subject_id')))->row()->name;
        $email_sub  = $this->db->get_where('email_template' , array('task' => 'new_homework'))->row()->subject;
        $email_msg  = $this->db->get_where('email_template' , array('task' => 'new_homework'))->row()->body;
        $email_msg  =  str_replace('[DESCRIPTION]' , $this->input->post('description'), $email_msg);
        $email_msg  =  str_replace('[TITLE]' , $this->input->post('title'), $email_msg);
        $email_msg  =  str_replace('[SUBJECT]' , $subj, $email_msg);

        $st = $this->db->get_where('enroll', array('class_id' => $this->input->post('class_id'), 'section_id' => $this->input->post('section_id'), 'year' => $this->runningYear))->result_array();
        foreach($st as $r)
        {
            $email_data = array(
                'email_msg' => $email_msg
            );
            if($this->db->get_where('student' , array('student_id' => $r['student_id']))->row()->email != '')
            {
                $this->submit($this->db->get_where('student' , array('student_id' => $r['student_id']))->row()->email,$email_sub,$email_data,'notify');
            }
        }
    }
    
    //Send new password to user function.
    function submitPassword($email,$password)
    {
        $email_sub  = getEduAppGTLang('recover_your_password');
        $email_msg  = getEduAppGTLang('success_password')."<br>";
        $email_msg  .= getEduAppGTLang('new_password').": <b>". $password ."<b/><br>.";
        $data = array(
            'email_msg' => $email_msg
        );
        $this->submit($email,$email_sub,$data,'password');
    }
    
    //Send Marks to Students.
    function sendStudentMarks()
    {
        $users = $this->db->get_where('enroll' , array('class_id' => $this->input->post('class_id'), 'section_id' => $this->input->post('section_id'), 'year' => $this->runningYear))->result_array();
        if(count($users) > 0)
        {
            foreach($users as $row)
            {
                $student_email = $this->db->get_where('student', array('student_id' => $row['student_id']))->row()->email;
                $subject = getEduAppGTLang('student_marksheet')." [".$this->db->get_where('exam', array('exam_id' => $this->input->post('exam_id')))->row()->name."]";
                $data = array(
                    'class_id' => $row['class_id'],
                    'student_name' => $this->crud->get_name('student', $row['student_id']),
                    'type' => 'student',
                    'student_id' => $row['student_id'],
                    'section_id' => $row['section_id'],
                    'exam_id' => $this->input->post('exam_id')
                );
                if($student_email != ''){
                    $this->submit($student_email,$subject,$data,'marks');
                }
            }   
        }
    }
    
    //Send marks to Parents.
    function sendParentsMarks()
    {
        $st = $this->db->get_where('enroll' , array('class_id' => $this->input->post('class_id'), 'section_id' => $this->input->post('section_id'), 'year' => $this->runningYear))->result_array();
        if(count($st) > 0)
        {
            foreach($st as $row)
            {
                $parent_id = $this->db->get_where('student', array('student_id' => $row['student_id']))->row()->parent_id;
                $parent_email = $this->db->get_where('parent', array('parent_id' => $parent_id))->row()->email;
                $subject = getEduAppGTLang('student_marksheet')." [".$this->db->get_where('exam', array('exam_id' => $this->input->post('exam_id')))->row()->name."]";
                $data = array(
                    'class_id' => $this->input->post('class_id'),
                    'type' => 'parent',
                    'student_name' => $this->crud->get_name('student', $row['student_id']),
                    'student_id' => $row['student_id'],
                    'section_id' => $this->input->post('section_id'),
                    'exam_id' => $this->input->post('exam_id')
                );
                if($parent_email != ''){
                    $this->submit($parent_email,$subject,$data,'marks');
                }
            }   
        }
    }
    
    //Send email confirmation for pending users.
    function accountConfirm($type = '', $id = '')
    {
        $user_email = $this->db->get_where($type, array($type.'_id' => $id))->row()->email;
        $user_name  = $this->db->get_where($type, array($type.'_id' => $id))->row()->first_name." ".$this->db->get_where($type, array($type.'_id' => $id))->row()->last_name;
        $username   = $this->db->get_where($type, array($type.'_id' => $id))->row()->username;
        
        $email_sub    =  getEduAppGTLang('congratulations');
        $email_msg   .=  getEduAppGTLang('hi')." <strong>".$user_name.",</strong><br><br>";
        $email_msg   .=  getEduAppGTLang('your_account_has_been_approved_now_you_can_login')." <br><br>";
        $email_msg   .=  getEduAppGTLang('your_data_are_as_follows').":<br><br>";
        $email_msg   .=  "<strong>".getEduAppGTLang('name').":</strong> ".$user_name."<br/>";
        $email_msg   .=  "<strong>".getEduAppGTLang('email').":</strong> ".$user_email."<br/>";
        $email_msg   .=  "<strong>".getEduAppGTLang('username').":</strong> ".$username."<br/>";
        $email_msg   .=  "<strong>".getEduAppGTLang('password').":</strong> ********<br/><br/>";
        $data = array(
            'email_msg' => $email_msg
        );
        if($user_email != '')
        {
            $this->submit($user_email,$email_sub,$data,'accept');
        }
    }
	
	//Send mails to all users.
	function sendEmailNotify()
	{
	    $subject = $this->input->post('subject');
        $data    = array(
            'email_msg' => $this->input->post('content')
        );
        $users = $this->db->get(''.$this->input->post('type').'')->result_array();
        foreach($users as $row)
        {
            if($row['email'] != ''){
                $this->submit($row['email'],$subject,$data,'notify');
            }
        }    
	}
	
	//Sent notify to student or parent as teacher account.
	function teacherSendEmail()
    {
        $subject = $this->input->post('subject');
        $data = array(
            'email_msg' => $this->input->post('content')
        );
        $users = $this->db->get_where('enroll', array('year' => $this->runningYear, 'class_id' => $this->input->post('class_id'), 'section_id' => $this->input->post('section_id')))->result_array();
        foreach($users as $row)
        {
            if($this->input->post('receiver') == 'student'){
                if($this->db->get_where('student' , array('student_id' => $row['student_id']))->row()->email != '')
                {
                    $this->submit($this->db->get_where('student' , array('student_id' => $row['student_id']))->row()->email,$subject,$data,'notify');
                }
            }else if($this->input->post('receiver') == 'parent'){
                $this->db->group_by('parent_id');
                $this->db->where('student_id', $row['student_id']);
                $parent_id = $this->db->get('student')->row()->parent_id;
                if($this->db->get_where('parent' , array('parent_id' => $parent_id))->row()->email != '')
                {
                    $this->submit($this->db->get_where('parent' , array('parent_id' => $parent_id))->row()->email,$subject,$data,'notify');
                }
            }
        }
    }

	
	//Sent welcome email to users.
	function welcomeUser($id)
	{
	    $user_email   = $this->db->get_where('pending_users', array('user_id' => $id))->row()->email;
        $user_name    = $this->db->get_where('pending_users', array('user_id' => $id))->row()->first_name." ".$this->db->get_where('pending_users', array('user_id' => $id))->row()->last_name;
        $username     = $this->db->get_where('pending_users', array('user_id' => $id))->row()->username;
        $type         = $this->db->get_where('pending_users', array('user_id' => $id))->row()->type;
        $email_sub    = getEduAppGTLang('welcome')." ". $user_name;
        $email_msg   .= getEduAppGTLang('hi')." <strong>".$user_name.",</strong><br><br>";
        $email_msg   .= getEduAppGTLang('new_account_has_been_created_with_your_email_address_in')." ".base_url()."<br><br>";
        $email_msg   .= getEduAppGTLang('your_data_are_as_follows').":<br><br>";
        $email_msg   .=  "<strong>".getEduAppGTLang('name').":</strong> ".$user_name."<br>";
        $email_msg   .=  "<strong>".getEduAppGTLang('email').":</strong> ".$user_email."<br>";
        $email_msg   .=  "<strong>".getEduAppGTLang('username').":</strong> ".$username."<br>";
        $email_msg   .=  "<strong>".getEduAppGTLang('account_type').":</strong> ".ucwords($type)."<br>";
        $email_msg   .=  "<strong>".getEduAppGTLang('password').":</strong> ********<br/><br/>";
        $email_msg   .=  "<strong>".getEduAppGTLang('note').":</strong> ".getEduAppGTLang('your_account_require_approval').".<br><br>";
        $data = array(
            'email_msg' => $email_msg
        );
        $this->submit($user_email,$email_sub,$data,'welcome');  
	}
	
	//Submit email by SMTP function.
	function submit($to, $subject, $message, $type)
	{
	    $config = Array(
            'protocol' => $this->db->get_where('settings', array('type' => 'protocol'))->row()->description,
            'smtp_host' => $this->db->get_where('settings', array('type' => 'smtp_host'))->row()->description,
            'smtp_port' => $this->db->get_where('settings', array('type' => 'smtp_port'))->row()->description,
            'smtp_user' => $this->db->get_where('settings', array('type' => 'smtp_user'))->row()->description,
            'smtp_pass' => $this->db->get_where('settings', array('type' => 'smtp_pass'))->row()->description,
            'mailtype'  => 'html', 
            'charset'   => $this->db->get_where('settings', array('type' => 'charset'))->row()->description,
            'wordwrap' => true
        );
        $this->load->library('email', $config);
        $this->email->initialize($config);
        $this->email->set_newline("\r\n");
        $this->email->from($this->db->get_where('settings', array('type' => 'system_email'))->row()->description, $this->db->get_where('settings', array('type' => 'system_name'))->row()->description);
        $this->email->to($to);
        $this->email->subject($subject);
        if($type == 'marks'){
            $mesg = $this->load->view('backend/mails/marks.php',$message,TRUE);
            $this->email->message($mesg);
        }elseif($type == 'accept'){
            $mesg = $this->load->view('backend/mails/accept.php',$message,TRUE);
            $this->email->message($mesg);
        }else{
            $mesg = $this->load->view('backend/mails/notify.php',$message,true);   
            $this->email->message($mesg);
        }
        if (!$this->email->send()) {
            show_error($this->email->print_debugger());
        }
	}
    
    //End of Mail.php
}