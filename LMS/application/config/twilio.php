<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
    require_once( BASEPATH .'database/DB.php');
	/**
	* Name:  Twilio
	*
	* Author: Ben Edmunds
	*		  ben.edmunds@gmail.com
	*         @benedmunds
	*
	* Location:
	*
	* Created:  03.29.2011
	*
	* Description:  Twilio configuration settings.
	*
	*
	*/
	/**
	 * Mode ("sandbox" or "prod")
	 **/
	$config['mode']   = 'prod';
    $db =& DB();
	/**
	 * Account SID
	 **/
	$config['account_sid']   = $db->get_where('settings' , array('type' => 'twilio_account'))->row()->description;
	/**
	 * Auth Token
	 **/
	$config['auth_token']    = $db->get_where('settings' , array('type' => 'authentication_token'))->row()->description;
	/**
	 * API Version
	 **/
	$config['api_version']   = '2010-04-01';
	/**
	 * Twilio Phone Number
	 **/
	$config['number']        = $db->get_where('settings' , array('type' => 'registered_phone'))->row()->description;
/* End of file twilio.php */