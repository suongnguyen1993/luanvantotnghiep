<script src="https://cdn.ckeditor.com/4.4.3/standard/ckeditor.js"></script>
    <!-- Bootstrap WYSIHTML5 -->
       <!--<script src="<?php //echo base_url(); ?>/public/admin/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script> -->
    <script>
      $(function () {
        // Replace the <textarea id="editor1"> with a CKEditor
        // instance, using default configuration.
        CKEDITOR.replace('long_content');
        //bootstrap WYSIHTML5 - text editor
        $(".textarea").wysihtml5();
      });
</script>