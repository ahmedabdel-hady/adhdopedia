    <script src="<?php echo base_url();?>public/style/js/picker.js"></script>
    <script src="<?php echo base_url();?>public/style/js/picker.en.js"></script>
    <script src="<?php echo base_url();?>public/style/cms/bower_components/bootstrap-clockpicker/bootstrap-clockpicker.min.js"></script>
    <script type="text/javascript">
        $('.clockpicker').clockpicker({
            placement: 'top',
            align: 'left',
            donetext: 'Done'
        });
    </script>
    <?php if ($this->session->flashdata('flash_message') != ""):?>
        <script>
            const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 8000
            }); 
            Toast.fire({
            type: 'success',
            title: '<?php echo $this->session->flashdata("flash_message");?>'
            })
        </script>
    <?php endif;?>
    
    <script>
    $(document).ready(function() {
        if ($("#mymce").length > 0) {
            tinymce.init({
                selector: "textarea#mymce",
                theme: "modern",
                height: 300,
                plugins: [
                    "advlist autolink link image lists charmap print preview hr anchor pagebreak spellchecker",
                    "searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking",
                    "save table contextmenu directionality emoticons template paste textcolor"
                ],
                toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | l      ink image | print preview media fullpage | forecolor backcolor emoticons",

            });
        }
    });
    </script>
    
    <?php if($page_name != 'homework_room'):?>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="<?php echo base_url();?>public/style/cms/bower_components/jquery/dist/jquery.min.js"></script>
        <script src='<?php echo base_url();?>public/style/fullcalendar/js/jquery.js'></script>
    <?php endif;?>    
    
    <script src="<?php echo base_url();?>public/style/cms/bower_components/moment/moment.js"></script>
    <script src="<?php echo base_url();?>public/style/cms/bower_components/tether/dist/js/tether.min.js"></script>
    <script src="<?php echo base_url();?>public/style/cms/bower_components/ckeditor/ckeditor.js"></script>
    <script src="<?php echo base_url();?>public/style/cms/bower_components/bootstrap-validator/dist/validator.min.js"></script>
    <script src="<?php echo base_url();?>public/style/cms/bower_components/dropzone/dist/dropzone.js"></script>
    <script src="<?php echo base_url();?>public/style/cms/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="<?php echo base_url();?>public/style/cms/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
    <script src="<?php echo base_url();?>public/style/cms/bower_components/perfect-scrollbar/js/perfect-scrollbar.jquery.min.js"></script>
    <script src="<?php echo base_url();?>public/style/cms/bower_components/bootstrap/js/dist/util.js"></script>
    <script src="<?php echo base_url();?>public/style/cms/bower_components/bootstrap/js/dist/tab.js"></script>
    <script src="<?php echo base_url();?>public/style/cms/js/main.js"></script>
    <script src="<?php echo base_url();?>public/style/cms/bower_components/dragula.js/dist/dragula.min.js"></script>
    <script src="<?php echo base_url();?>public/style/cms/bower_components/bootstrap/js/dist/modal.js"></script>
    <script src="<?php echo base_url();?>public/style/cms/bower_components/bootstrap/js/dist/tooltip.js"></script>
    <script src="<?php echo base_url();?>public/style/js/bootstrap.min.js"></script>
    <script src="<?php echo base_url();?>public/style/cms/js/dataTables.bootstrap4.min.js"></script>
    <script src="<?php echo base_url();?>public/style/tinymce/tinymce.min.js"></script>
    <script src="<?php echo base_url();?>public/style/cms/bower_components/popper.js/dist/umd/popper.min.js"></script>
    <script src="<?php echo base_url();?>public/style/cms/bower_components/slick-carousel/slick/slick.min.js"></script>
    <script src="<?php echo base_url();?>public/style/cms/bower_components/bootstrap/js/dist/alert.js"></script>
    <script src="<?php echo base_url();?>public/style/cms/bower_components/bootstrap/js/dist/button.js"></script>
    <script src="<?php echo base_url();?>public/style/cms/bower_components/bootstrap/js/dist/carousel.js"></script>
    <script src="<?php echo base_url();?>public/style/cms/bower_components/bootstrap/js/dist/collapse.js"></script>
    <script src="<?php echo base_url();?>public/style/cms/bower_components/bootstrap/js/dist/dropdown.js"></script>
    <script src='<?php echo base_url();?>public/style/fullcalendar/js/fullcalendar.min.js'></script>
    <script src='<?php echo base_url();?>public/style/js/locales-all.js'></script>
    <script src="<?php echo base_url();?>public/style/js/lang-all.js"></script>
    <script src="<?php echo base_url();?>public/style/olapp/js/jquery.appear.js"></script>
    <script src="<?php echo base_url();?>public/style/olapp/js/jquery.matchHeight.js"></script>
    <script src="<?php echo base_url();?>public/style/olapp/js/svgxuse.js"></script>
    <script src="<?php echo base_url();?>public/style/olapp/js/Headroom.js"></script>
    <script src="<?php echo base_url();?>public/style/olapp/js/velocity.js"></script>
    <script src="<?php echo base_url();?>public/style/olapp/js/ScrollMagic.js"></script>
    <script src="<?php echo base_url();?>public/style/olapp/js/jquery.waypoints.js"></script>
    <script src="<?php echo base_url();?>public/style/olapp/js/jquery.countTo.js"></script>
    <script src="<?php echo base_url();?>public/style/olapp/js/material.min.js"></script>
    <script src="<?php echo base_url();?>public/style/olapp/js/bootstrap-select.js"></script>
    <script src="<?php echo base_url();?>public/style/olapp/js/smooth-scroll.js"></script>
    <script src="<?php echo base_url();?>public/style/olapp/js/selectize.js"></script>
    <script src="<?php echo base_url();?>public/style/olapp/js/swiper.jquery.js"></script>
    <script src="<?php echo base_url();?>public/style/olapp/js/moment.js"></script>
    <script src="<?php echo base_url();?>public/style/olapp/js/isotope.pkgd.js"></script>
    <script src="<?php echo base_url();?>public/style/olapp/js/circle-progress.js"></script>
    <script src="<?php echo base_url();?>public/style/olapp/js/loader.js"></script>
    <script src="<?php echo base_url();?>public/style/olapp/js/jquery.magnific-popup.js"></script>
    <script src="<?php echo base_url();?>public/style/olapp/js/sticky-sidebar.js"></script>
    <script src="<?php echo base_url();?>public/style/olapp/js/base-init.js"></script>
    <script defer src="<?php echo base_url();?>public/style/olapp/fonts/fontawesome-all.js"></script>
    <script src="<?php echo base_url();?>public/style/olapp/Bootstrap/dist/js/bootstrap.bundle.js"></script>
    <script type="text/javascript">
        if (typeof CKEDITOR !== 'undefined') 
        {
            CKEDITOR.disableAutoInline = true;
            if ($('#ckeditorEmail').length) 
            {
                CKEDITOR.config.uiColor = '#ffffff';
                CKEDITOR.config.toolbar = [['Bold', 'Italic', '-', 'NumberedList', 'BulletedList', '-', 'Link', 'Unlink', '-', 'About']];
                CKEDITOR.config.height = 250;
                CKEDITOR.replace('instruction');
            }
        }
    </script>