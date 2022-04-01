<?php  
    $edit_data = $this->db->get_where('exam' , array('exam_id' => $param2) )->result_array();
    foreach($edit_data as $row): 
?>    
    <?php echo form_open(base_url() . 'admin/semesters/update/'.$row['exam_id'], array('enctype' => 'multipart/form-data')); ?>
        <div class="modal-content">
            <a href="javascript:void(0);" class="close icon-close" data-dismiss="modal" aria-label="Close"></a>
            <div class="modal-body">
                <div class="modal-header" style="background-color:#00579c">
                    <h6 class="title" style="color:white"><?php echo getEduAppGTLang('update_semester');?></h6>
                </div>
                <div class="ui-block-content">
                    <div class="row">
                        <div class="col col-lg-12 col-md-12 col-sm-12 col-12">
                            <div class="form-group label-floating">
                                <label class="control-label"><?php echo getEduAppGTLang('name');?></label>
                                <input class="form-control" type="text" name="name" required="" value="<?php echo $row['name'];?>">
                            </div>
                        </div>
                        <div class="col col-lg-6 col-md-6 col-sm-12 col-12">
                            <button class="btn btn-rounded btn-success" type="submit"><?php echo getEduAppGTLang('update');?></button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php echo form_close();?>
<?php endforeach; ?>
