<?php 
    $admin = $this->db->get_where('news' , array('news_code' => $param2))->result_array();
    foreach($admin as $row):
?>
    <div class="modal-body">
        <div class="modal-header" style="background-color:#00579c">
            <h6 class="title" style="color:white"><?php echo getEduAppGTLang('update_news');?></h6>
        </div>
        <div class="ui-block-content">
            <?php echo form_open(base_url() . 'admin/news/update_news/'.$row['news_code'], array('enctype' => 'multipart/form-data')); ?>
                <div class="row">
                    <div class="col col-lg-12 col-md-12 col-sm-12 col-12">
                        <div class="form-group label-floating">
                            <label class="control-label"><?php echo getEduAppGTLang('description');?></label>
                            <textarea class="form-control" name="description" rows="10"><?php echo $row['description'];?></textarea>
                        </div>
                    </div>
                    <div class="col col-lg-12 col-md-12 col-sm-12 col-12">
                         <div class="form-group label-floating">
                            <label class="control-label"><?php echo getEduAppGTLang('image');?></label>
                            <input name="userfile" accept="image/x-png,image/gif,image/jpeg" id="imgpre" type="file"/>
                        </div>
                    </div>
                    <div class="col col-lg-6 col-md-6 col-sm-12 col-12">
                        <button class="btn btn-rounded btn-success btn-lg " type="submit"><?php echo getEduAppGTLang('update');?></button>
                    </div>
                </div>
            <?php echo form_close();?>
        </div>
    </div>
<?php endforeach;?>