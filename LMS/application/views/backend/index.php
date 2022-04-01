<?php 
    $system_name        =	$this->crud->getInfo('system_name');
	$system_title       =	$this->crud->getInfo('system_title');
    $account_type       = $this->session->userdata('login_type'); 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title><?php echo $page_title;?> | <?php echo $system_title;?></title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta content="ie=edge" http-equiv="x-ua-compatible">
    <meta content="School System, EduAppGT PRO, GuateApps, WSG" name="keywords">
    <meta content="GuateApps" name="author">
    <meta content="9.0" name="soft_version">
    <meta content="<?php echo $system_name ." ".$system_title;?>" name="description">
    <meta content="width=device-width, initial-scale=1" name="viewport">
    <link href="<?php echo base_url();?>public/uploads/<?php echo $this->crud->getInfo('favicon');?>" rel="icon">
    <link href="<?php echo base_url();?>public/style/cms/css/main.css" media="all" rel="stylesheet">
    <?php include 'topcss.php';?>	
</head>
<body class="menu-position-side menu-side-left full-screen with-content-panel">
    <div class="with-side-panel">
        <div class="<?php if($page_name != 'subject_dashboard' && $page_name != 'online_exams' && $page_name != 'homework' && $page_name != 'forum' && $page_name != 'study_material' && $page_name != 'upload_marks' && $page_name != 'meet' && $page_name != 'gamification'):?>layout-w<?php endif;?>">
            <?php include $account_type.'/navigation.php';?>
            <?php  include $account_type.'/'.$page_name.'.php'; ?>
        </div>
        <div class="display-type"></div>
    </div>
    <?php include 'modal.php';?>
    <?php include 'scripts.php';?>
 </body>
</html>