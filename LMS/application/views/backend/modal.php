    <script type="text/javascript">
        function showAjaxModal(url)
        {
            jQuery('#exampleModal .modal-body').html('<div style="text-align:center;margin-top:200px;"><img src="<?php echo base_url();?>public/assets/images/preloader.gif" /></div>');
            jQuery('#exampleModal').modal('show', {backdrop: 'true'});
            $.ajax({
                url: url,
                success: function(response)
                {
                    jQuery('#exampleModal .modal-body').html(response);
                }
            });
        }
    </script>
    
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="crearadmin" aria-hidden="true">
        <div class="modal-dialog window-popup edit-my-poll-popup" role="document">
            <div class="modal-content" style="margin-top:50px;">
                <a href="#" class="close icon-close" data-dismiss="modal" aria-label="Close"></a>
                <div class="modal-body">
                    <div class="modal-header" style="background-color:#00579c">
                        <h6 class="title" style="color:white"><?php echo $this->crud->getInfo('system_name');?></h6>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        function confirm_modal(delete_url)
        {
            jQuery('#modal_delete').modal('show', {backdrop: 'static'});
            document.getElementById('delete_link').setAttribute('href' , delete_url);
        }
    </script>
    <style>
        .datepicker{z-index:1151 !important;}
    </style>