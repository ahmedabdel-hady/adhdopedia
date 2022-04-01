<?php $title = $this->crud->getInfo('system_title'); ?>
<?php $system_name = $this->crud->getInfo('system_name'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link href="https://fonts.googleapis.com/css?family=Poppins" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo getEduAppGTLang('recover_your_password');?> | <?php echo $title;?></title>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>public/style/login/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>public/style/login/css/fontawesome-all.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>public/style/login/css/iofrm-style.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>public/style/login/css/iofrm-theme16.css">
    <link href="<?php echo base_url();?>public/uploads/<?php echo $this->crud->getInfo('favicon');?>" rel="icon">
</head>
<body>
    <div class="form-body without-side">
        <div class="row">
            <div class="form-holder">
                <div class="form-content" style="background-image: url(<?php echo base_url();?>public/uploads/bglogin.jpg); background-size:cover;">
                    <div class="form-items">
                        <center><img class="logo-size" src="<?php echo base_url();?>public/uploads/<?php echo $this->crud->getInfo('logo');?>" alt="" style="width:120px;"></center>
                        <br><h5><?php echo getEduAppGTLang('recover_your_password');?></h5><br>
                         <?php echo form_open(base_url() . 'login/lost_password/recovery');?>
                            <input class="form-control" type="text" name="field" placeholder="<?php echo getEduAppGTLang('your_email');?>" required>
                            <div class="form-button">
                                <button id="submit" type="submit" class="ibtn"><?php echo getEduAppGTLang('recover');?></button> <a href="<?php echo base_url();?>"><?php echo getEduAppGTLang('return');?>.</a>
                            </div>
                        </form>
                         <br><br>
                        <div class="page-links">
                            <a href="<?php echo base_url();?>terms/"><?php echo getEduAppGTLang('terms_conditions');?></a>
                            <?php if($this->crud->getInfo('register') == 1):?><a href="<?php echo base_url();?>register/"><?php echo getEduAppGTLang('create_account');?></a><?php endif;?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="<?php echo base_url();?>public/style/login/js/jquery.min.js"></script>
    <script src="<?php echo base_url();?>public/style/login/js/popper.min.js"></script>
    <script src="<?php echo base_url();?>public/style/login/js/bootstrap.min.js"></script>
    <script src="<?php echo base_url();?>public/style/login/js/main.js"></script>
</body>
</html>