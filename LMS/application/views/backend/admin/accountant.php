    <div class="content-w">
        <?php include 'fancy.php';?>
        <div class="header-spacer"></div>
      	<div class="conty">
        	<div class="all-wrapper no-padding-content solid-bg-all">
	            <div class="layout-w">
              		<div class="content-w">
                  		<div class="content-i">
                    		<div class="content-box">
                      			<div class="app-email-w">
                    				<div class="app-email-i">
                      					<div class="ae-content-w" style="background-color: #f2f4f8;">
											<div class="top-header top-header-favorit">
												<div class="top-header-thumb">
													<img src="<?php echo base_url();?>public/uploads/bglogin.jpg" alt="nature" style="height:180px; object-fit:cover;">
													<div class="top-header-author">
														<div class="author-thumb">
															<img src="<?php echo base_url();?>public/uploads/<?php echo $this->crud->getInfo('logo');?>" alt="author" style="background-color: #fff;padding:10px;">
														</div>
														<div class="author-content">
															<a href="javascript:void(0);" class="h3 author-name"><?php echo getEduAppGTLang('accountants');?></a>
															<div class="country"><?php echo $this->crud->getInfo('system_name');?>  |  <?php echo $this->crud->getInfo('system_title');?></div>
														</div>
													</div>
												</div>
												<div class="profile-section" style="background-color: #fff;">
													<div class="control-block-button">
                            							<a href="javascript:void(0);" class="btn btn-control bg-purple" style="background:#0084ff; color: #fff;" data-toggle="modal" data-target="#new_accountant">
                                                            <i class="icon-feather-plus" title="<?php echo getEduAppGTLang('new_account');?>"></i>
                                                        </a>
													</div>
												</div>
											</div>
            								<div class="aec-full-message-w">
                								<div class="aec-full-message">
                    								<div class="container-fluid" style="background-color: #f2f4f8;"><br>
                    									<div class="col-sm-12">   
                        									<div class="row">
                                                                <div class="col col-lg-6 col-md-6 col-sm-12 col-12">
                                                                    <div class="form-group label-floating" style="background-color: #fff;">
                                                                        <label class="control-label"><?php echo getEduAppGTLang('search');?></label>
                                                                        <input class="form-control"  id="filter" type="text" required="">
                                                                    </div>
                                                                </div>
                                                            </div>
													        <div class="row" id="results">
    														<?php 
    														    $this->db->order_by('accountant_id', 'desc');
    														    $accountant = $this->db->get('accountant')->result_array();
                                                                foreach($accountant as $row):
                                                            ?>
                                                                <div class="col-xl-4 col-md-6 results">
                                                                    <div class="card-box widget-user ui-block list">
                                                                        <div class="more" style="float:right;">
                                                                            <i class="icon-options"></i>                                
                                                                            <ul class="more-dropdown">
                                                                                <li><a href="javascript:void(0);" onclick="showAjaxModal('<?php echo base_url();?>modal/popup/modal_accountant/<?php echo $row['accountant_id'];?>');"><?php echo getEduAppGTLang('edit');?></a></li>
                                                                                <li><a onClick="return confirm('<?php echo getEduAppGTLang('confirm_delete');?>')" href="<?php echo base_url();?>admin/accountant/delete/<?php echo $row['accountant_id'];?>"><?php echo getEduAppGTLang('delete');?></a></li>
                                                                            </ul>
                                                                        </div>
                                                                        <div>
                                                                            <img src="<?php echo $this->crud->get_image_url('accountant', $row['accountant_id']);?>" class="img-responsive rounded-circle" alt="user">
                                                                            <div class="wid-u-info">
                                                                                <a href="<?php echo base_url();?>admin/accountant_profile/<?php echo $row['accountant_id'];?>/" class="h6 author-name"><h5 class="mt-0 m-b-5"> <?php echo $this->crud->get_name('accountant', $row['accountant_id']);?></h5></a>
                                                                                <p class="text-muted m-b-5 font-13">
                                                                                    <b><i class="picons-thin-icon-thin-0291_phone_mobile_contact"></i></b> <?php  echo $row['phone'];?><br>
                                                                                    <b><i class="picons-thin-icon-thin-0321_email_mail_post_at"></i></b> <?php  echo $row['email'];?><br>
                                                                                    <b><i class="picons-thin-icon-thin-0701_user_profile_avatar_man_male"></i></b> <?php  echo $row['username'];?><br>
                                                                                </p>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            <?php endforeach;?>
    														</div>
          											    </div>
                  								    </div>
            							        </div>
            							    </div>      
    							        </div>	
      							    </div>
						        </div>  
    					    </div>
                        </div>
                    </div>
                </div>
                <div class="display-type"></div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="new_accountant" tabindex="-1" role="dialog" aria-labelledby="new_accountant" aria-hidden="true">
        <div class="modal-dialog window-popup edit-my-poll-popup" role="document">
            <div class="modal-content">
                <a href="#" class="close icon-close" data-dismiss="modal" aria-label="Close"></a>
                <div class="modal-body">
                    <div class="modal-header" style="background-color:#00579c">
                        <h6 class="title" style="color:white"><?php echo getEduAppGTLang('new_account');?></h6>
                    </div>
                    <div class="ui-block-content">
                        <?php echo form_open(base_url() . 'admin/accountant/create/', array('enctype' => 'multipart/form-data'));?>
                            <div class="row">
              		            <div class="col col-lg-12 col-md-12 col-sm-12 col-12">
                		            <div class="form-group">
                  			            <label class="control-label"><?php echo getEduAppGTLang('photo');?></label>
                  			            <input class="form-control" name="userfile" type="file">
	                	            </div>
              		            </div>
              		            <div class="col col-lg-6 col-md-6 col-sm-12 col-12">
	                	            <div class="form-group label-floating">
                  			            <label class="control-label"><?php echo getEduAppGTLang('first_name');?></label>
                  			            <input class="form-control" name="first_name" type="text" required="">
	                	            </div>
            		            </div>
                	            <div class="col col-lg-6 col-md-6 col-sm-12 col-12">
                		            <div class="form-group label-floating">
                  			            <label class="control-label"><?php echo getEduAppGTLang('last_name');?></label>
                  			            <input class="form-control" name="last_name" type="text" required="">
                		            </div>
              		            </div>
              		            <div class="col col-lg-6 col-md-6 col-sm-12 col-12">
                		            <div class="form-group label-floating">
                  			            <label class="control-label"><?php echo getEduAppGTLang('username');?></label>
                  			            <input class="form-control" placeholder="" type="text" name="username" id="user_accountant">
                  			            <small><span id="result_accountant"></span></small>
                  			            <span class="input-group-addon">
	                    		            <i class="icon-feather-mail"></i>
                  			            </span>
                		            </div>
              		            </div> 
              		            <div class="col col-lg-6 col-md-6 col-sm-12 col-12">
                		            <div class="form-group label-floating">
                  			            <label class="control-label"><?php echo getEduAppGTLang('password');?></label>
                  			            <input class="form-control" placeholder="" type="password" name="password">
                  			            <span class="input-group-addon">
	                    		            <i class="icon-feather-mail"></i>
                  			            </span>
                		            </div>
              		            </div> 
                          		<div class="col col-lg-6 col-md-6 col-sm-12 col-12">
                          			<div class="form-group label-floating is-select">
                                        <label class="control-label"><?php echo getEduAppGTLang('gender');?></label>
                                        <div class="select">
                                            <select name="gender" id="slct" required="">
                                                <option value=""><?php echo getEduAppGTLang('select');?></option>
                                                <option value="M"><?php echo getEduAppGTLang('male');?></option>
                                                <option value="F"><?php echo getEduAppGTLang('female');?></option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                          		<div class="col col-lg-6 col-md-6 col-sm-12 col-12">
                            		<div class="form-group label-floating">
                              			<label class="control-label"><?php echo getEduAppGTLang('email');?></label>
                              			<input class="form-control" placeholder="" type="email" id="emailx" name="email">
                              			<small><span id="result_emailx"></span></small>
                              			<span class="input-group-addon">
            	                    		<i class="icon-feather-mail"></i>
                              			</span>
                            		</div>
                          		</div>              
                          		<div class="col col-lg-6 col-md-6 col-sm-12 col-12">              
                            		<div class="form-group label-floating is-empty">
                              			<label class="control-label"><?php echo getEduAppGTLang('phone');?></label>
                              			<input class="form-control" name="phone" type="text">
                              			<span class="input-group-addon">
                                			<i class="icon-feather-phone"></i>
                              			</span>
                            		</div>
                          		</div>
                      		    <div class="col col-lg-6 col-md-6 col-sm-12 col-12">              
                            		<div class="form-group label-floating is-empty">
                          			    <label class="control-label"><?php echo getEduAppGTLang('identification');?></label>
                          			    <input class="form-control" name="idcard" type="text">
                          			    <span class="input-group-addon">
                                			<i class="icon-feather-phone"></i>
                          			    </span>
                        		    </div>
                      		    </div>
                      		    <div class="col col-lg-12 col-md-12 col-sm-12 col-12">  
                                    <div class="form-group date-time-picker label-floating">
                                        <label class="control-label"><?php echo getEduAppGTLang('birthday');?></label>
                                        <input type='text' class="datepicker-here" data-position="top left" data-language='en' name="datetimepicker" data-multiple-dates-separator="/"/>
                                        <span class="input-group-addon">
                                            <i class="icon-feather-calendar"></i>
                                        </span>
                                    </div>
                                </div>
              		            <div class="col col-lg-12 col-md-12 col-sm-12 col-12">          
                		            <div class="form-group label-floating is-empty">
                  			            <label class="control-label"><?php echo getEduAppGTLang('address');?></label>
                  			            <input class="form-control" name="address" type="text">
                  			            <span class="input-group-addon">
                    			            <i class="icon-feather-map-pin"></i>
                  			            </span>
                		            </div>        
              		            </div>                
                                <div class="col col-lg-6 col-md-6 col-sm-12 col-12">
                                    <button class="btn btn-rounded btn-primary btn-lg full-width" id="sub_accountant" type="submit"><?php echo getEduAppGTLang('save');?></button>
                                </div>
                            </div>
                        <?php echo form_close();?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript">
        $(document).ready(function(){         
              var query;          
              $("#emailx").keyup(function(e){
                    query = $("#emailx").val();
                    $("#result_emailx").queue(function(n) {                     
                        $.ajax({
                            type: "POST",
                            url: '<?php echo base_url();?>register/search_email',
                            data: "c="+query,
                            dataType: "html",
                            error: function(){
                                alert("¡Error!");
                            },
                            success: function(data)
                            { 
                                if (data == "success") 
                                {            
                                    texto = "<b style='color:#ff214f'><?php echo getEduAppGTLang('email_already_exist');?></b>"; 
                                    $("#result_emailx").html(texto);
                                    $('#sub_accountant').attr('disabled','disabled');
                                }
                                else { 
                                    texto = ""; 
                                    $("#result_emailx").html(texto);
                                    $('#sub_accountant').removeAttr('disabled');
                                }
                                n();
                            }
                      });                           
                 });                       
            });                       
        });
    </script>
    <script type="text/javascript">
        window.onload=function(){      
            $("#filter").keyup(function() {
                var filter = $(this).val(),
                count = 0;
                $('#results div').each(function() {
                    if ($(this).text().search(new RegExp(filter, "i")) < 0) {
                        $(this).hide();
                    } else {
                        $(this).show();
                        count++;
                    }
                });
            });
        }
    </script>
    <script type="text/javascript">
        $(document).ready(function(){         
            var query;          
            $("#user_accountant").keyup(function(e){
                query = $("#user_accountant").val();
                $("#result_accountant").queue(function(n) {                     
                    $.ajax({
                        type: "POST",
                        url: '<?php echo base_url();?>register/search_user',
                        data: "c="+query,
                        dataType: "html",
                        error: function(){
                            alert("Error!");
                        },
                        success: function(data)
                        { 
                            if (data == "success") 
                            {            
                                texto = "<b style='color:#ff214f'><?php echo getEduAppGTLang('already_exist');?></b>"; 
                                $("#result_accountant").html(texto);
                                $('#sub_accountant').attr('disabled','disabled');
                            }
                            else { 
                                texto = ""; 
                                $("#result_accountant").html(texto);
                                $('#sub_accountant').removeAttr('disabled');
                            }
                            n();
                        }
                    });                           
                });                       
            });                       
        });
    </script>