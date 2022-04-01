<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Accountant extends EduAppGT
{
    /*
        Software: EduAppGT PRO - School Management System
        Author: GuateApps - Software, Web and Mobile developer.
        Author URI: https://guateapps.app.
        PHP: 5.6+
        Created: 27 September 16.
    */
    
	function __construct()
	{
		parent::__construct();
		$this->load->database();
        $this->load->library('session');
		$this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
		$this->output->set_header('Pragma: no-cache');
    }
    
    //Index function.
    public function index()
    {
        $this->isAccountant();
    }

    //Delete notifications function.
    function notification($param1 ='', $param2 = '')
    {
        $this->isAccountant();
        if($param1 == 'delete')
        {
            $this->crud->deleteNotification($param2);   
            $this->session->set_flashdata('flash_message', getEduAppGTLang('successfully_deleted'));
            redirect(base_url() . 'accountant/notifications/', 'refresh');
        }
    }
    
    //Chat group function.
    function group($param1 = "group_message_home", $param2 = "")
    {
        $this->isAccountant();
        if ($param1 == 'group_message_read') 
        {
            $page_data['current_message_thread_code'] = $param2;
        }
        else if($param1 == 'send_reply')
        {
            $this->crud->send_reply_group_message($param2);
            $this->session->set_flashdata('flash_message', getEduAppGTLang('message_sent'));
            redirect(base_url() . 'accountant/group/group_message_read/'.$param2, 'refresh');
        } 
        $page_data['message_inner_page_name']   = $param1;
        $page_data['page_name']                 = 'group';
        $page_data['page_title']                = getEduAppGTLang('message_group');
        $this->load->view('backend/index', $page_data);
    }
    
    //Private Message function.
    function message($param1 = 'message_home', $param2 = '', $param3 = '') 
    {
        parse_str(substr(strrchr($_SERVER['REQUEST_URI'], "?"), 1), $_GET);
        $this->isAccountant();
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
            redirect(base_url() . 'accountant/message/message_read/' . $message_thread_code, 'refresh');
        }
        if ($param1 == 'send_reply') 
        {
            $this->session->set_flashdata('flash_message' , getEduAppGTLang('reply_sent'));
            $this->crud->send_reply_message($param2);
            redirect(base_url() . 'accountant/message/message_read/' . $param2, 'refresh');
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
    
    //Birthdays function.
    function birthdays()
    {
        $this->isAccountant();
        $page_data['page_name']  = 'birthdays';
        $page_data['page_title'] = getEduAppGTLang('birthdays');
        $this->load->view('backend/index', $page_data);
    }
    
    //Save poll response function.
    function polls($param1 = '', $param2 = '')
    {
        $this->isAccountant();
        if($param1 == 'response')
        {
            $this->crud->pollReponse();
        }
    }
    
    //Manage notifications function.
    function notifications()
    {
        $this->isAccountant();
        $page_data['page_name']  =  'notifications';
        $page_data['page_title'] =  getEduAppGTLang('your_notifications');
        $this->load->view('backend/index', $page_data);
    }
    
    //Manage news function.
    function news($param1 = '', $param2 = '', $param3 = '') 
    {
        $this->isAccountant();
        $page_data['page_name'] = 'news';
        $page_data['page_title'] = getEduAppGTLang('news');
        $this->load->view('backend/index', $page_data);
    }
    
    //Manage calendar function.
    function calendar($param1 = '', $param2 = '', $param3 = '') 
    {
        $this->isAccountant();
        parse_str(substr(strrchr($_SERVER['REQUEST_URI'], "?"), 1), $_GET);
        if($_GET['id'] != "")
        {
            $notify['status'] = 1;
            $this->db->where('id', $_GET['id']);
            $this->db->update('notification', $notify);
        }
        $page_data['page_name'] = 'calendar';
        $page_data['page_title'] = getEduAppGTLang('calendar_events');
        $this->load->view('backend/index', $page_data);
    }
    
    //My Profile function.
    function my_profile($param1 = '' , $param2 = '')
    {
        $this->isAccountant();
        if($param1 == 'remove_facebook')
        {
            $this->user->removeFacebook();
            $this->session->set_flashdata('flash_message' , getEduAppGTLang('facebook_delete'));
            redirect(base_url() . 'accountant/my_profile/', 'refresh');
        }
        if($param1 == '1')
        {
            $this->session->set_flashdata('error_message' , getEduAppGTLang('google_err'));
            redirect(base_url() . 'accountant/my_profile/', 'refresh');
        }
        if($param1 == '3')
        {
            $this->session->set_flashdata('error_message' , getEduAppGTLang('facebook_err'));
            redirect(base_url() . 'accountant/my_profile/', 'refresh');
        }
        if($param1 == '2')
        {
            $this->session->set_flashdata('flash_message' , getEduAppGTLang('google_true'));
            redirect(base_url() . 'accountant/my_profile/', 'refresh');
        }
        if($param1 == '4')
        {
            $this->session->set_flashdata('flash_message' , getEduAppGTLang('facebook_true'));
            redirect(base_url() . 'accountant/my_profile/', 'refresh');
        }  
        if($param1 == 'remove_google')
        {
            $this->user->removeGoogle();
            $this->session->set_flashdata('flash_message' , getEduAppGTLang('google_delete'));
            redirect(base_url() . 'accountant/my_profile/', 'refresh');
        }
        if ($param1 == 'update_profile') 
        {
            $this->user->updateCurrentAccountant();
            $this->session->set_flashdata('flash_message' , getEduAppGTLang('successfully_updated'));
            redirect(base_url() . 'accountant/accountant_update/', 'refresh');
        }
        $page_data['page_name']  = 'my_profile';
        $page_data['page_title'] = getEduAppGTLang('my_profile');
        $page_data['output']     = $this->crud->getGoogleURL();
        $this->load->view('backend/index', $page_data); 
    }
    
    //Accountant update profile function.
    function accountant_update($param1 = '' , $param2 = '')
    {
        $this->isAccountant();
        $page_data['page_name']  = 'accountant_update';
        $page_data['info']       = $this->user->getAccountantInfo();
        $page_data['page_title'] = getEduAppGTLang('update_information');
        $page_data['output']     = $this->crud->getGoogleURL();
        $this->load->view('backend/index', $page_data); 
    }
    
    //Manage student payments function.
    function students_payments($param1 = '' , $param2 = '')
    {
        $this->isAccountant();
        $page_data['page_name']  = 'students_payments';
        $page_data['page_title'] = getEduAppGTLang('student_payments');
        $this->load->view('backend/index', $page_data); 
    }
    
    //Manage expenses function.
    function expense($param1 = '' , $param2 = '')
    {
        $this->isAccountant();
        if ($param1 == 'create') 
        {
            $this->crud->createExpense();
            $this->session->set_flashdata('flash_message' , getEduAppGTLang('successfully_added'));
            redirect(base_url() . 'accountant/expense', 'refresh');
        }
        if ($param1 == 'edit') 
        {
            $this->crud->updateExpense($param2);
            $this->session->set_flashdata('flash_message' , getEduAppGTLang('successfully_updated'));
            redirect(base_url() . 'accountant/expense', 'refresh');
        }
        if ($param1 == 'delete') 
        {
            $tihs->crud->deleteExpense($param2);
            $this->session->set_flashdata('flash_message' , getEduAppGTLang('successfully_deleted'));
            redirect(base_url() . 'accountant/expense/', 'refresh');
        }
        $page_data['page_name']  = 'expense';
        $page_data['page_title'] = getEduAppGTLang('expense');
        $this->load->view('backend/index', $page_data); 
    }

    //Manage expense categories function.
    function expense_category($param1 = '' , $param2 = '')
    {
        $this->isAccountant();
        if ($param1 == 'create') 
        {
            $this->crud->createCategory();
            $this->session->set_flashdata('flash_message' , getEduAppGTLang('successfully_added'));
            redirect(base_url() . 'accountant/expense');
        }
        if ($param1 == 'update') 
        {
            $this->crud->updateCategory($param2);
            $this->session->set_flashdata('flash_message' , getEduAppGTLang('successfully_updated'));
            redirect(base_url() . 'accountant/expense');
        }
        if ($param1 == 'delete') 
        {
            $this->crud->deleteCategory($param);
            $this->session->set_flashdata('flash_message' , getEduAppGTLang('successfully_deleted'));
            redirect(base_url() . 'accountant/expense');
        }
        $page_data['page_name']  = 'expense';
        $page_data['page_title'] = getEduAppGTLang('expense');
        $this->load->view('backend/index', $page_data);
    }
    
    //Manage invoices function.
    function invoice($param1 = '', $param2 = '', $param3 = '')
    {
        $this->isAccountant();
        if ($param1 == 'bulk') 
        {
            $this->payment->createBulkInvoice();
            $this->session->set_flashdata('flash_message' , getEduAppGTLang('successfully_added'));
            redirect(base_url() . 'accountant/students_payments/', 'refresh');
        }
        if ($param1 == 'create') 
        {
            $this->payment->singleInvoice();
            $this->session->set_flashdata('flash_message' , getEduAppGTLang('successfully_added'));
            redirect(base_url() . 'accountant/students_payments/', 'refresh');
        }
        if ($param1 == 'do_update') 
        {
            $this->payment->updateInvoice($param2);
            $this->session->set_flashdata('flash_message' , getEduAppGTLang('successfully_updated'));
            redirect(base_url() . 'accountant/students_payments/', 'refresh');
        }
        if ($param1 == 'delete') 
        {
            $this->payment->deleteInvoice($param2);
            $this->session->set_flashdata('flash_message' , getEduAppGTLang('successfully_deleted'));
            redirect(base_url() . 'accountant/students_payments/', 'refresh');
        }
    }
    
    //Invoice details function.
    function invoice_details($id)
    {
        $this->isAccountant();
        $page_data['invoice_id'] = $id;
        $page_data['page_title'] = getEduAppGTLang('invoice_details');
        $page_data['page_name']  = 'invoice_details';
        $this->load->view('backend/index', $page_data);
    }
    
    //New payment function.
    function new_payment($param1 = '', $param2 = '')
    {
        $this->isAccountant();
        $page_data['page_name']  = 'new_payment';
        $page_data['page_title'] = getEduAppGTLang('new_payment');
        $this->load->view('backend/index', $page_data);
    }
    
    //Manage payments function.
    function payments($param1 = '' , $param2 = '' , $param3 = '') 
    {
        $this->isAccountant();
        $page_data['page_name']  = 'payments';
        $page_data['page_title'] = getEduAppGTLang('payments');
        $this->load->view('backend/index', $page_data); 
    }
    
    //Accountant dashboard function.
    function panel()
    {
        $this->isAccountant();
        parse_str(substr(strrchr($_SERVER['REQUEST_URI'], "?"), 1), $_GET);
        if($_GET['id'] != "")
        {
            $notify['status'] = 1;
            $this->db->where('id', $_GET['id']);
            $this->db->update('notification', $notify);
        }
        $page_data['page_name']  = 'panel';
        $page_data['page_title'] = getEduAppGTLang('accountant_dashboard');
        $this->load->view('backend/index', $page_data);
    }

    //Check session function.
    function isAccountant()
    {
        if ($this->session->userdata('accountant_login') != 1)
        {
            redirect(site_url('login'), 'refresh');
        }
    }
    //End of Accountant.php
}