<?php
    function checker() {
    	if(!is_file(APPPATH.'controllers/Install.php'))
		{	
        	require_once( BASEPATH .'database/DB.php');
        	$CI =& get_instance();
        	$db =& DB();
        	$env                  = $db->get_where('settings' , array('type' => 'purchase_code'))->row()->description;
        	$envYr                = $db->get_where('settings' , array('type' => 'buyer'))->row()->description;
        	$stat                 = $db->get_where('settings' , array('type' => 'stat'))->row()->description;
        	$data_array['domain'] = $CI->config->config['base_url'];
        	$data_array['ip']     = $_SERVER['REMOTE_ADDR'];
        	$data_array['buyer']  = $envYr;
        	$data_array['code']   = $env;
        	if($stat == 0){
	            $curl = curl_init();
            	curl_setopt_array($curl, array(
	                CURLOPT_URL            => "https://guateapps.app/support/checker/register",
                	CURLOPT_RETURNTRANSFER => true,
                	CURLOPT_TIMEOUT        => 0,
                	CURLOPT_POST           => 1,
                	CURLOPT_HTTP_VERSION   => CURL_HTTP_VERSION_1_1,
                	CURLOPT_POSTFIELDS     => $data_array,
            	));
            	$response = curl_exec($curl);
            	$arr = json_decode($response,true);
            	curl_close($curl);
            	$dbinfo['description'] = 1;
            	$db->where('type','stat');
            	$db->update('settings',$dbinfo);
        	}
        }
    }