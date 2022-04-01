<?php
	session_start();
	require_once "Facebook/autoload.php";
	$FB = new \Facebook\Facebook([
		'app_id' => 'your_app_id',
		'app_secret' => 'your_app_secret',
		'default_graph_version' => 'v2.10'
	]);
	$helper = $FB->getRedirectLoginHelper();
?>