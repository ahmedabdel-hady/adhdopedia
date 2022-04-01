<?php if (!defined('BASEPATH')) { exit('No direct script access allowed'); }

    require_once "public/face/config.php";
    include_once 'public/src/Google_Client.php';
    include_once 'public/src/contrib/Google_Oauth2Service.php';

class Auth extends EduAppGT
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
        $this->output->set_header('Last-Modified: ' . gmdate("D, d M Y H:i:s") . ' GMT');
        $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
        $this->output->set_header('Pragma: no-cache');
        $this->output->set_header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
    }

    public function index()
    {   
        redirect(site_url('login'), 'refresh');
    }

    function facebook()
    {
        parse_str(substr(strrchr($_SERVER['REQUEST_URI'], "?"), 1), $_GET);
        $account_type = $this->session->userdata('login_type');
        $account_id = $this->session->userdata('login_user_id');
        if($account_type == "parent")
        {
            $url = "parents";
        }else
        {
            $url = $account_type;
        }        
        $redirectURL = base_url()."auth/facebook/";
        $permissions = ['email'];
        $loginURL = $helper->getLoginUrl($redirectURL, $permissions); 
        if(isset($_GET['code']))
        {
            try {
                $accessToken = $helper->getAccessToken();
            } catch (\Facebook\Exceptions\FacebookResponseException $e) {
                echo "Response Exception: " . $e->getMessage();
                exit();
            } catch (\Facebook\Exceptions\FacebookSDKException $e) {
                echo "SDK Exception: " . $e->getMessage();
                exit();
            }
            $oAuth2Client = $FB->getOAuth2Client();
            if (!$accessToken->isLongLived())
            {
                $accessToken = $oAuth2Client->getLongLivedAccessToken($accessToken);
                $response = $FB->get("/me?fields=id, first_name, last_name, email, picture.type(large)", $accessToken);
                $userData = $response->getGraphNode()->asArray();
                $_SESSION['userData'] = $userData;
                $_SESSION['access_token'] = (string) $accessToken;
            }
        }
        if($_SESSION['userData']['id'] != "")
        {
            $resp = $this->crud->checkUser2($_SESSION['userData']['id']);
            if($resp == "success")
            {
                if($url == "admin"){
                    redirect(base_url() . 'admin/my_account/3', 'refresh');
                }
                if($url == "accountant"){
                    redirect(base_url() . 'accountant/my_profile/3', 'refresh');
                }
                if($url == "librarian"){
                    redirect(base_url() . 'librarian/my_profile/3', 'refresh');
                }
                else if($url == "teacher"){
                    redirect(base_url() . 'teacher/my_account/3', 'refresh');
                }
                else if($url == "parents"){
                    redirect(base_url() . 'parents/my_profile/3', 'refresh');
                }
                else if($url == "student"){
                    redirect(base_url() . 'student/my_profile/3', 'refresh');
                }
            }
            else if($resp == "")
            {
                $this->crud->updateFbToken($accessToken);
                if($url == "admin"){
                    redirect(base_url() . 'admin/my_account/4', 'refresh');
                }
                else if($url == "teacher"){
                    redirect(base_url() . 'teacher/my_account/4', 'refresh');
                }
                else if($url == "parents"){
                    redirect(base_url() . 'parents/my_profile/4', 'refresh');
                }
                else if($url == "librarian"){
                    redirect(base_url() . 'librarian/my_profile/4', 'refresh');
                }
                else if($url == "accountant"){
                    redirect(base_url() . 'accountant/my_profile/4', 'refresh');
                }
                else if($url == "student"){
                    redirect(base_url() . 'student/my_profile/4', 'refresh');
                }
            }
        }
    }

    function login()
    {
        parse_str(substr(strrchr($_SERVER['REQUEST_URI'], "?"), 1), $_GET);
        $clientId = $this->db->get_where('settings', array('type' => 'google_sync'))->row()->description;
        $clientSecret = $this->db->get_where('settings', array('type' => 'google_login'))->row()->description;
        $redirectURL = base_url().'auth/login/';
        $gClient = new Google_Client();
        $gClient->setApplicationName('google');
        $gClient->setClientId($clientId);
        $gClient->setClientSecret($clientSecret);
        $gClient->setRedirectUri($redirectURL);
        $google_oauthV2 = new Google_Oauth2Service($gClient);

        if(isset($_GET['code']))
        {
            $gClient->authenticate($_GET['code']);
            $_SESSION['token'] = $gClient->getAccessToken();
        }
        if (isset($_SESSION['token'])) 
        {
            $gClient->setAccessToken($_SESSION['token']);
        }
        if ($gClient->getAccessToken()) 
        {
            $gpUserProfile = $google_oauthV2->userinfo->get();    
            $gpUserData = array(
                'oauth_provider'=> 'google',
                'oauth_uid'     => $gpUserProfile['id'],
                'first_name'    => $gpUserProfile['given_name'],
                'last_name'     => $gpUserProfile['family_name'],
                'email'         => $gpUserProfile['email'],
                'picture'       => $gpUserProfile['picture'],
                'link'          => $gpUserProfile['link']
            );
            $userData = $this->crud->checkUser($gpUserData);  
            if($userData == "success")
            {   
                $credential = array('g_oauth' => $gpUserProfile['id']);
                $query = $this->db->get_where('admin', $credential);
                if ($query->num_rows() > 0) 
                {
                    $row = $query->row();
                    $this->session->set_userdata('admin_login', $row->status);
                    $this->session->set_userdata('admin_id', $row->admin_id);
                    $this->session->set_userdata('login_user_id', $row->admin_id);
                    $this->session->set_userdata('name', $row->name);
                    $this->session->set_userdata('login_type', 'admin');
                    header('Location: '.base_url()."admin/panel/");
                }
                $query = $this->db->get_where('teacher', $credential);
                if ($query->num_rows() > 0) 
                {
                    $row = $query->row();
                    $this->session->set_userdata('teacher_login', '1');
                    $this->session->set_userdata('teacher_id', $row->teacher_id);
                    $this->session->set_userdata('login_user_id', $row->teacher_id);
                    $this->session->set_userdata('name', $row->name);
                    $this->session->set_userdata('login_type', 'teacher');
                    header('Location: '.base_url()."teacher/teacher_dashboard/");
                }
                $query = $this->db->get_where('student', $credential);
                if ($query->num_rows() > 0) 
                {
                    $row = $query->row();
                    $this->session->set_userdata('student_login', $row->student_session);
                    $this->session->set_userdata('student_id', $row->student_id);
                    $this->session->set_userdata('login_user_id', $row->student_id);
                    $this->session->set_userdata('name', $row->name);
                    $this->session->set_userdata('login_type', 'student');
                    header('Location: '.base_url()."student/panel/");
                }
                $query = $this->db->get_where('parent', $credential);
                if ($query->num_rows() > 0) 
                {
                    $row = $query->row();
                    $this->session->set_userdata('parent_login', '1');
                    $this->session->set_userdata('parent_id', $row->parent_id);
                    $this->session->set_userdata('login_user_id', $row->parent_id);
                    $this->session->set_userdata('name', $row->name);
                    $this->session->set_userdata('login_type', 'parent');
                    header('Location: '.base_url()."parents/panel/");
                }
                $query = $this->db->get_where('accountant', $credential);
                if ($query->num_rows() > 0) 
                {
                    $row = $query->row();
                    $this->session->set_userdata('accountant_login', '1');
                    $this->session->set_userdata('accountant_id', $row->accountant_id);
                    $this->session->set_userdata('login_user_id', $row->accountant_id);
                    $this->session->set_userdata('name', $row->name);
                    $this->session->set_userdata('login_type', 'accountant');
                    header('Location: '.base_url()."accountant/panel/");
                }
                $query = $this->db->get_where('librarian', $credential);
                if ($query->num_rows() > 0) 
                {
                    $row = $query->row();
                    $this->session->set_userdata('librarian_login', '1');
                    $this->session->set_userdata('librarian_id', $row->librarian_id);
                    $this->session->set_userdata('login_user_id', $row->librarian_id);
                    $this->session->set_userdata('name', $row->name);
                    $this->session->set_userdata('login_type', 'librarian');
                    header('Location: '.base_url()."librarian/panel/");
                }
            }
            else if($userData == "")
            {
                $gClient = new Google_Client();
                $gClient->setApplicationName('google');
                $gClient->setClientId($clientId);
                $gClient->setClientSecret($clientSecret);
                $gClient->setRedirectUri($redirectURL);
                $google_oauthV2 = new Google_Oauth2Service($gClient);
                unset($_SESSION['token']);
                unset($_SESSION['userData']);
                $gClient->revokeToken();
                $this->session->set_flashdata('failed' , "1");
                redirect(base_url(), 'refresh');
            }
        } else 
        {
            $authUrl = $gClient->createAuthUrl();
            $output = filter_var($authUrl, FILTER_SANITIZE_URL);
        }
    }

    function loginfacebook()
    {
        parse_str(substr(strrchr($_SERVER['REQUEST_URI'], "?"), 1), $_GET);
        $account_type = $this->session->userdata('login_type');
        $account_id = $this->session->userdata('login_user_id');
        if($account_type == "parent")
        {
            $url = "parents";
        }else{
            $url = $account_type;
        }        
        if(isset($_GET['code']))
        {
            try {
                $accessToken = $helper->getAccessToken();
            } catch (\Facebook\Exceptions\FacebookResponseException $e) {
                echo "Response Exception: " . $e->getMessage();
                exit();
            } catch (\Facebook\Exceptions\FacebookSDKException $e) {
                echo "SDK Exception: " . $e->getMessage();
                exit();
            }
            $oAuth2Client = $FB->getOAuth2Client();
            if (!$accessToken->isLongLived())
            {
                $accessToken = $oAuth2Client->getLongLivedAccessToken($accessToken);
                $response = $FB->get("/me?fields=id, first_name, last_name, email, picture.type(large)", $accessToken);
                $userData = $response->getGraphNode()->asArray();
                $_SESSION['userData'] = $userData;
                $_SESSION['access_token'] = (string) $accessToken;
            }
        }
        if($_SESSION['userData']['id'] != "")
        {
            $resp = $this->crud->checkUser2($_SESSION['userData']['id']);
            if($resp == "success")
            {
                $credential = array('fb_id' => $_SESSION['userData']['id']);
                $query = $this->db->get_where('admin', $credential);
                if ($query->num_rows() > 0) 
                {
                    $row = $query->row();
                    $this->session->set_userdata('admin_login', $row->status);
                    $this->session->set_userdata('admin_id', $row->admin_id);
                    $this->session->set_userdata('login_user_id', $row->admin_id);
                    $this->session->set_userdata('name', $row->name);
                    $this->session->set_userdata('login_type', 'admin');
                    header('Location: '.base_url()."admin/panel/");
                }
                $query = $this->db->get_where('teacher', $credential);
                if ($query->num_rows() > 0) 
                {
                    $row = $query->row();
                    $this->session->set_userdata('teacher_login', '1');
                    $this->session->set_userdata('teacher_id', $row->teacher_id);
                    $this->session->set_userdata('login_user_id', $row->teacher_id);
                    $this->session->set_userdata('name', $row->name);
                    $this->session->set_userdata('login_type', 'teacher');
                    header('Location: '.base_url()."teacher/teacher_dashboard/");
                }
                $query = $this->db->get_where('student', $credential);
                if ($query->num_rows() > 0) 
                {
                    $row = $query->row();
                    $this->session->set_userdata('student_login', $row->student_session);
                    $this->session->set_userdata('student_id', $row->student_id);
                    $this->session->set_userdata('login_user_id', $row->student_id);
                    $this->session->set_userdata('name', $row->name);
                    $this->session->set_userdata('login_type', 'student');
                    header('Location: '.base_url()."student/panel/");
                }
                $query = $this->db->get_where('parent', $credential);
                if ($query->num_rows() > 0) 
                {
                    $row = $query->row();
                    $this->session->set_userdata('parent_login', '1');
                    $this->session->set_userdata('parent_id', $row->parent_id);
                    $this->session->set_userdata('login_user_id', $row->parent_id);
                    $this->session->set_userdata('name', $row->name);
                    $this->session->set_userdata('login_type', 'parent');
                    header('Location: '.base_url()."parents/panel/");
                }
                $query = $this->db->get_where('accountant', $credential);
                if ($query->num_rows() > 0) 
                {
                    $row = $query->row();
                    $this->session->set_userdata('accountant_login', '1');
                    $this->session->set_userdata('accountant_id', $row->accountant_id);
                    $this->session->set_userdata('login_user_id', $row->accountant_id);
                    $this->session->set_userdata('name', $row->name);
                    $this->session->set_userdata('login_type', 'accountant');
                    header('Location: '.base_url()."accountant/panel/");
                }
                $query = $this->db->get_where('librarian', $credential);
                if ($query->num_rows() > 0) 
                {
                    $row = $query->row();
                    $this->session->set_userdata('librarian_login', '1');
                    $this->session->set_userdata('librarian_id', $row->librarian_id);
                    $this->session->set_userdata('login_user_id', $row->librarian_id);
                    $this->session->set_userdata('name', $row->name);
                    $this->session->set_userdata('login_type', 'librarian');
                    header('Location: '.base_url()."librarian/panel/");
                }
            }
            else if($resp == "")
            {
                unset($_SESSION['access_token']);
                unset($accessToken);
                unset($_SESSION['userData']);
                $this->session->set_flashdata('failedf' , "1");
                redirect(base_url(), 'refresh');
            }
        }
    }

    function sync()
    {
        parse_str(substr(strrchr($_SERVER['REQUEST_URI'], "?"), 1), $_GET);
        $clientId = $this->db->get_where('settings', array('type' => 'google_sync'))->row()->description;
        $clientSecret = $this->db->get_where('settings', array('type' => 'google_login'))->row()->description;
        $redirectURL = base_url().'auth/sync/';
        $gClient = new Google_Client();
        $gClient->setApplicationName('google');
        $gClient->setClientId($clientId);
        $gClient->setClientSecret($clientSecret);
        $gClient->setRedirectUri($redirectURL);
        $google_oauthV2 = new Google_Oauth2Service($gClient);
        $account_type = $this->session->userdata('login_type');
        $account_id = $this->session->userdata('login_user_id');
        if($account_type == "parent")
        {
            $url = "parents";
        }else{
            $url = $account_type;
        }        
        if(isset($_GET['code']))
        {
            $gClient->authenticate($_GET['code']);
            $_SESSION['token'] = $gClient->getAccessToken();
        }
        if (isset($_SESSION['token'])) 
        {
            $gClient->setAccessToken($_SESSION['token']);
        }
        if ($gClient->getAccessToken()) 
        {
            $gpUserProfile = $google_oauthV2->userinfo->get();    
            $gpUserData = array(
                'oauth_provider'=> 'google',
                'oauth_uid'     => $gpUserProfile['id'],
                'first_name'    => $gpUserProfile['given_name'],
                'last_name'     => $gpUserProfile['family_name'],
                'email'         => $gpUserProfile['email'],
                'picture'       => $gpUserProfile['picture'],
                'link'          => $gpUserProfile['link']
            );
            $userData = $this->crud->checkUser($gpUserData);  
            if($userData == "success") 
            {
                if($url == "admin"){
                    redirect(base_url() . 'admin/my_account/1', 'refresh');
                }
                else if($url == "teacher"){
                    redirect(base_url() . 'teacher/my_account/1', 'refresh');
                }
                else if($url == "parents"){
                    redirect(base_url() . 'parents/my_profile/1', 'refresh');
                }
                else if($url == "student"){
                    redirect(base_url() . 'student/my_profile/1', 'refresh');
                }
                else if($url == "librarian"){
                    redirect(base_url() . 'librarian/my_profile/1', 'refresh');
                }
                else if($url == "accountant"){
                    redirect(base_url() . 'accountant/my_profile/1', 'refresh');
                }
            }  
            else if($userData == "")
            {
                $data['g_oauth']    =  $gpUserProfile['id'];
                $data['g_fname']    =  $gpUserProfile['given_name'];
                $data['g_lname']    =  $gpUserProfile['family_name'];
                $data['g_picture']  =  $gpUserProfile['picture'];
                $data['link']       =  $gpUserProfile['link'];
                $data['g_email']    =  $gpUserProfile['email'];
                $this->db->where($this->session->userdata('login_type')."_id", $this->session->userdata('login_user_id'));
                $this->db->update($this->session->userdata('login_type'), $data);
                if($url == "admin"){
                    redirect(base_url() . 'admin/my_account/2', 'refresh');
                }
                else if($url == "teacher"){
                    redirect(base_url() . 'teacher/my_account/2', 'refresh');
                }
                else if($url == "parents"){
                    redirect(base_url() . 'parents/my_profile/2', 'refresh');
                }
                else if($url == "student"){
                    redirect(base_url() . 'student/my_profile/2', 'refresh');
                }
                else if($url == "accountant"){
                    redirect(base_url() . 'accountant/my_profile/2', 'refresh');
                }
                else if($url == "librarian"){
                    redirect(base_url() . 'librarian/my_profile/2', 'refresh');
                }
            }
        }
        else 
        {
            $authUrl = $gClient->createAuthUrl();
            $output = filter_var($authUrl, FILTER_SANITIZE_URL);
        }
    }
    //End of Auth.php
}