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

<script type="text/javascript"> 
    $(function(){
      
      function readURL(input, obj) {

          if (input.files && input.files[0]) {
              var reader = new FileReader();

              reader.onload = function (e) {
                  $(obj).attr('src', e.target.result);
                  $(obj).show();
              }

              reader.readAsDataURL(input.files[0]);
          }
      }

      

      $("#image").change(function(){
          readURL(this, '#prevImage');
      });

      $("#audio_file").change(function(){
          readURL(this, '#prevAudio');
      });
      
    });
</script>