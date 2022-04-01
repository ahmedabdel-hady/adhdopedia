<!DOCTYPE html>
<html>
    <style>
        body{
            font-family: 'Poppins', sans-serif;
            font-weight: 800;
            -webkit-font-smoothing: antialiased;
            text-rendering: optimizeLegibility; 
        }
    </style>
  <head>
    <title><?php echo getEduAppGTLang('terms_conditions');?> | <?php echo $this->crud->getInfo('system_title');?></title>
    <meta charset="utf-8">
    <meta content="ie=edge" http-equiv="x-ua-compatible">
    <meta content="width=device-width, initial-scale=1" name="viewport">
    <link href="https://fonts.googleapis.com/css?family=Rubik:300,400,500" rel="stylesheet" type="text/css">
    <link href="<?php echo base_url();?>public/style/cms/bower_components/perfect-scrollbar/css/perfect-scrollbar.min.css" rel="stylesheet">
    <link href="<?php echo base_url();?>public/uploads/<?php echo $this->crud->getInfo('favicon');?>" rel="icon">
    <link href="<?php echo base_url();?>public/style/cms/css/main.css" rel="stylesheet">
  </head>
    <body class="auth-wrapper login" style="background: url('<?php echo base_url();?>public/uploads/bglogin.jpg');background-size: cover;background-repeat: no-repeat;">
        <div class="auth-box-w wider">
            <div class="logo-wy">
                <a href="<?php echo base_url();?>"><img alt="" src="<?php echo base_url();?>public/uploads/<?php echo $this->crud->getInfo('logo');?>" width="30%"></a><br><br>
            </div>
            <div class="steps-w">
                <div class="step-contents">
                    <div class="step-content active" id="stepContent1">
                        <h4><?php echo getEduAppGTLang('terms_conditions');?></h4><hr>
                        <div class="row">
                            <br>
                            <p><?php echo $this->db->get_where('academic_settings' , array('type' =>'terms'))->row()->description;?></p>
                            <hr>
                            <div class="pull-right"><br><br><br>
                                <a class="btn btn-purple btn-rounded text-white" href="<?php echo base_url();?>"> <?php echo getEduAppGTLang('return');?></a>
                            <br><br>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>