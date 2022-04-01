<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
if ( ! function_exists('getEduAppGTLang'))
{
	function getEduAppGTLang($phrase = '') 
	{
		$CI	=&	get_instance();
		$CI->load->database();
		$current_language	=	$CI->db->get_where('settings' , array('type' => 'language'))->row()->description;
		if ( $current_language	==	'') {
			$current_language	=	'english';
			$CI->session->set_userdata('current_language' , $current_language);
		}
		$check_phrase	=	$CI->db->get_where('language' , array('phrase' => $phrase))->row()->phrase;
		if (strtolower($check_phrase) != strtolower($phrase))
		$CI->db->insert('language' , array('phrase' => strtolower($phrase)));
		$query	=	$CI->db->get_where('language' , array('phrase' => $phrase));
		$row   	=	$query->row();	
		if (isset($row->$current_language) && $row->$current_language !="")
			return $row->$current_language;
		else 
			return ucwords(str_replace('_',' ',$phrase));
	}
}