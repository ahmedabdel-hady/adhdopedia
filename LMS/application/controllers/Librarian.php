<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Librarian extends EduAppGT
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
        if($this->session->userdata('librarian_login') != 1)
        {
            redirect(base_url(), 'refresh');
        }else{
            redirect(base_url().'librarian/panel/', 'refresh');
        }
    }

    //Delete notification function.
    function notification($param1 ='', $param2 = '')
    {
        $this->isLibrarian();
        if($param1 == 'delete')
        {
            $this->crud->deleteNotification($param2);
            $this->session->set_flashdata('flash_message', getEduAppGTLang('successfully_deleted'));
            redirect(base_url() . 'librarian/notifications/', 'refresh');
        }
    }

    //Manage news function.
    function news($param1 = '', $param2 = '', $param3 = '') 
    {
        $this->isLibrarian();
        $page_data['page_name'] = 'news';
        $page_data['page_title'] = getEduAppGTLang('news');
        $this->load->view('backend/index', $page_data);
    }
    
    //Update book function.
    function update_book($param1 = '', $param2 = '')
    {
        $this->isLibrarian();
        $page_data['book_id'] = $param1;
        $page_data['page_name']  =   'update_book';
        $page_data['page_title'] = getEduAppGTLang('update_book');
        $this->load->view('backend/index', $page_data);
    }
    
    //Chat group function.
    function group($param1 = "group_message_home", $param2 = "")
    {
        $this->isLibrarian();
        if ($param1 == 'group_message_read') 
        {
            $page_data['current_message_thread_code'] = $param2;
        }
        else if($param1 == 'send_reply')
        {
            $this->crud->send_reply_group_message($param2);
            $this->session->set_flashdata('flash_message', getEduAppGTLang('message_sent'));
            redirect(base_url() . 'librarian/group/group_message_read/'.$param2, 'refresh');
        }
        $page_data['message_inner_page_name']   = $param1;
        $page_data['page_name']                 = 'group';
        $page_data['page_title']                = getEduAppGTLang('message_group');
        $this->load->view('backend/index', $page_data);
    }
    
    //Calendar function.
    function calendar($param1 = '', $param2 = '', $param3 = '') 
    {
        $this->isLibrarian();
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
    
    //Chat message function.
    function message($param1 = 'message_home', $param2 = '', $param3 = '') 
    {
        parse_str(substr(strrchr($_SERVER['REQUEST_URI'], "?"), 1), $_GET);
        $this->isLibrarian();
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
            redirect(base_url() . 'librarian/message/message_read/' . $message_thread_code, 'refresh');
        }
        if ($param1 == 'send_reply') 
        {
            $this->session->set_flashdata('flash_message' , getEduAppGTLang('reply_sent'));
            $this->crud->send_reply_message($param2);
            redirect(base_url() . 'librarian/message/message_read/' . $param2, 'refresh');
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
    
    //Librarian dashboard function.
    function panel()
    {
        $this->isLibrarian();
        parse_str(substr(strrchr($_SERVER['REQUEST_URI'], "?"), 1), $_GET);
        if($_GET['id'] != "")
        {
            $notify['status'] = 1;
            $this->db->where('id', $_GET['id']);
            $this->db->update('notification', $notify);
        }
        $page_data['page_name']  = 'panel';
        $page_data['page_title'] = getEduAppGTLang('librarian_dashboard');
        $this->load->view('backend/index', $page_data);
    }

    //Book request function.
    function book_request($param1 = "", $param2 = "")
    {
        $this->isLibrarian();
        if ($param1 == "accept")
        {
            $this->academic->acceptBook($param2);
            $this->session->set_flashdata('flash_message', getEduAppGTLang('request_accepted_successfully'));
            redirect(site_url('librarian/book_request/'), 'refresh');
        }
        if ($param1 == "reject")
        {
            $this->academic->rejectBook($param2);
            $this->session->set_flashdata('flash_message', getEduAppGTLang('request_rejected_successfully'));
            redirect(site_url('librarian/book_request'), 'refresh');
        }
        $data['page_name']  = 'book_request';
        $data['page_title'] = getEduAppGTLang('book_request');
        $this->load->view('backend/index', $data);
    }

    //Manage my profile function.
    function my_profile($param1 = '', $param2 = '', $param3 = '')
    {
        $this->isLibrarian();
        if($param1 == 'remove_facebook')
        {
            $this->user->removeFacebook();
            $this->session->set_flashdata('flash_message' , getEduAppGTLang('facebook_delete'));
            redirect(base_url() . 'librarian/my_profile/', 'refresh');
        }
        if($param1 == '1')
        {
            $this->session->set_flashdata('error_message' , getEduAppGTLang('google_err'));
            redirect(base_url() . 'librarian/my_profile/', 'refresh');
        }
        if($param1 == '3')
        {
            $this->session->set_flashdata('error_message' , getEduAppGTLang('facebook_err'));
            redirect(base_url() . 'librarian/my_profile/', 'refresh');
        }
        if($param1 == '2')
        {
            $this->session->set_flashdata('flash_message' , getEduAppGTLang('google_true'));
            redirect(base_url() . 'librarian/my_profile/', 'refresh');
        }
        if($param1 == '4')
        {
            $this->session->set_flashdata('flash_message' , getEduAppGTLang('facebook_true'));
            redirect(base_url() . 'librarian/my_profile/', 'refresh');
        }  
        if($param1 == 'remove_google')
        {
            $this->user->removeGoogle();
            $this->session->set_flashdata('flash_message' , getEduAppGTLang('google_delete'));
            redirect(base_url() . 'librarian/my_profile/', 'refresh');
        }
        if ($param1 == 'update_profile') 
        {
            $this->user->updateCurrentLibrarian();
            $this->session->set_flashdata('flash_message' , getEduAppGTLang('successfully_updated'));
            redirect(base_url() . 'librarian/librarian_update/', 'refresh');
        }
        $page_data['output']     = $this->crud->getGoogleURL();
        $page_data['page_name']  = 'my_profile';
        $page_data['page_title'] = getEduAppGTLang('my_profile');
        $this->load->view('backend/index', $page_data);
    }
    
    //Poll response function.
    function polls($param1 = '', $param2 = '')
    {
        $this->isLibrarian();
        if($param1 == 'response')
        {
            $this->crud->pollReponse();
        }
    }
    
    //Notifications function.
    function notifications()
    {
        $this->isLibrarian();
        $page_data['page_name']  =  'notifications';
        $page_data['page_title'] =  getEduAppGTLang('your_notifications');
        $this->load->view('backend/index', $page_data);
    }
    
    //Librarian update profile function.
    function librarian_update($librarian_id = '')
    {
        $this->isLibrarian();
        $page_data['page_name']  = 'librarian_update';
        $page_data['page_title'] =  getEduAppGTLang('update_information');
        $page_data['output']  =  $this->crud->getGoogleURL();
        $this->load->view('backend/index', $page_data);
    }
    
    //Manage library function.
    function library($param1 = '', $param2 = '', $param3 = '')
    {
        $this->isLibrarian();
        if ($param1 == 'create') 
        {
            $this->crud->createBook();
            redirect(base_url() . 'librarian/library/', 'refresh');
        }
        if($param1 == 'update') 
        {
            $this->crud->updateBook($param2);
            redirect(base_url() . 'librarian/update_book/'.$param2, 'refresh');
        }
        if ($param1 == 'delete') 
        {
            $this->crud->deleteBook($param2);
            $this->session->set_flashdata('flash_message' , getEduAppGTLang('successfully_deleted'));
            redirect(base_url() . 'librarian/library', 'refresh');
        }
        $id = $this->input->post('class_id');
        if ($id == '')
        {
            $id = $this->db->get('class')->first_row()->class_id;
        }
        $page_data['id']         = $id;
        $page_data['page_name']  = 'library';
        $page_data['page_title'] = getEduAppGTLang('library');
        $this->load->view('backend/index', $page_data);
    }
    
    //Birthdays function.
    function birthdays()
    {
        $this->isLibrarian();
        $page_data['page_name']  = 'birthdays';
        $page_data['page_title'] = getEduAppGTLang('birthdays');
        $this->load->view('backend/index', $page_data);
    }
    
    //Check librarian session.
    function isLibrarian()
    {
        if($this->session->userdata('librarian_login') != 1)
        {
            redirect(base_url(), 'refresh');
        }
    }
    
    //End of Librarian.php
}