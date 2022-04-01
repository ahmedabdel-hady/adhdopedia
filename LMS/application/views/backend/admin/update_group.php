<?php
    $group_info = $this->db->get_where('group_message_thread', array('group_message_thread_code' => $current_message_thread_code))->row_array();
    $group_members = json_decode($group_info['members']);
?>
    <div class="full-chat-middle b-b">
        <div class="chat-head">
                <div class="user-actions">
                    <h4><?php echo getEduAppGTLang('update_group');?></h4>
                </div>
            </div>
            <form class="" action="<?php echo base_url();?>admin/group/edit_group/<?php echo $current_message_thread_code;?>" method="post">
                <div class="chat-content-w">
                    <div class="chat-content text-center">
                        <div class="col-sm-12">
                            <div class="form-group label-floating">
                                <label class="control-label"><?php echo getEduAppGTLang('name');?></label>
                                <input class="form-control" type="text" name="group_name" value="<?php echo $group_info['group_name']; ?>" required="">
                                <span class="material-input"></span>
                                <span class="material-input"></span>
                            </div>
                        </div>
                        <?php
                            $user_array = ['student', 'teacher', 'parent','admin','librarian', 'accountant'];
                            for ($i=0; $i < sizeof($user_array); $i++):
                            $user_list = $this->db->get($user_array[$i])->result_array();
                        ?>
                        <div class="col-md-12" style="margin-top: 10px;">
                            <table  class="table table-bordered table-striped">
                                <h4 class="col-md-6" style="color: #000; text-align: left; padding: 0; margin: 0;"><b><?php echo getEduAppGTLang(ucfirst($user_array[$i])); ?></b></h4>
                                <thead>
                                    <tr>
                                        <th><input type="checkbox" id="<?php echo $user_array[$i]; ?>" onchange="checkAllBoxes(this)">&nbsp;<?php echo getEduAppGTLang('select_all');?></th>
                                        <th></th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <thead>
                                    <tr>
                                        <th style="background-color:#99bf2d; color: #fff;"><?php echo getEduAppGTLang('select');?></th>
                                        <th style="background-color:#99bf2d; color: #fff;"><?php echo getEduAppGTLang('user');?></th>
                                        <th style="background-color:#99bf2d; color: #fff;"><?php echo getEduAppGTLang('name');?></th>
                                    </tr>
                                </thead>
                                    <?php foreach ($user_list as $user):?>
                                <tr>
                                    <td width = "20%"><input type="checkbox" name="user[]" class="<?php echo $user_array[$i]; ?>" value="<?php echo $user_array[$i].'_'.$user[$user_array[$i].'_id']; ?>"
                                    <?php
                                        for ($j = 0; $j < sizeof($group_members); $j++) 
                                        {
                                            if ($group_members[$j] == $user_array[$i].'_'.$user[$user_array[$i].'_id']) 
                                            {
                                                echo 'checked';
                                                break;
                                            }
                                        }
                                    ?>>
                                    </td>
                                    <td width = "25%"><?php echo $user['username'] ?></td>
                                    <td width = "55%"><?php echo $user['first_name']." ".$user['last_name'] ?></td>
                                </tr>
                            <?php endforeach ?>
                        </table>
                    </div>
                    <?php endfor; ?>
                    <div class="pull-right">
                        <button type="submit" name="submit" class="btn btn-purple btn-rounded"><?php echo getEduAppGTLang('update');?></button>
                    </div>
                    <br><br>
                </form>
            </div>
        </div>
    </div> 
        
    <script type="text/javascript">
        function checkAllBoxes(check){
            var checkboxes = document.getElementsByTagName('input');
            if (check.checked) {
                $('.'+check.id).prop("checked", true);
            } else {
                $('.'+check.id).prop("checked", false);
            }
        }
    </script>
