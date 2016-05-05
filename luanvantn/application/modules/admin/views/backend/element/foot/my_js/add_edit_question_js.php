<link rel="stylesheet" href="<?php echo base_url(); ?>public/admin/plugins/select2/select2.min.css">
<script src="<?php echo base_url(); ?>public/admin/plugins/select2/select2.full.min.js"></script>

<!-- hien thi hinh anh vaf audio o client -->
<script type="text/javascript"> 
    $(function(){
      $('input[name="numberchoose"]').change(function(){
        
        var number =$(this).val();
        if(number == 3)
        {
          $("#chooseD").hide();
          $("#radioD").attr("name", "");
          $("#textD").attr("name", "");
        }
        else
        {
          $("#chooseD").show();
          $("#radioD").attr("name", "choosecorrect");
          $("#textD").attr("name", "choosecontent4");
        }
      });

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



<script type="text/javascript">
      $(document).ready(function(){
        $(".select2").select2();
      });
</script>