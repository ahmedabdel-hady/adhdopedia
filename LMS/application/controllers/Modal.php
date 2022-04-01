<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Modal extends EduAppGT {
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
	
	//Index function.
	public function index()
	{
	    redirect(base_url(), 'refresh');
	}
	
	//Load popup modal function.
	function popup($page_name = '' , $param2 = '' , $param3 = '', $param4 = '')
	{
		$account_type		=	$this->session->userdata('login_type');
		$page_data['param2']		=	$param2;
		$page_data['param3']		=	$param3;
		$page_data['param4']		=	$param4;
		$this->load->view( 'backend/'.$account_type.'/'.$page_name.'.php' ,$page_data);
		
	}
	
	//End of Modal.php
}