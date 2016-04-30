<script src="<?php echo base_url(); ?>/public/admin/plugins/ckeditor/ckeditor.js"></script>
    <!-- Bootstrap WYSIHTML5 -->
       <!--<script src="<?php //echo base_url(); ?>/public/admin/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script> -->
<script>

  if ( CKEDITOR.env.ie && CKEDITOR.env.version < 9 )
  CKEDITOR.tools.enableHtml5Elements( document );

  // The trick to keep the editor in the sample quite small
  // unless user specified own height.
  CKEDITOR.config.height = 150;
  CKEDITOR.config.width = 'auto';

  var initSample = ( function() {
    var wysiwygareaAvailable = isWysiwygareaAvailable(),
      isBBCodeBuiltIn = !!CKEDITOR.plugins.get( 'bbcode' );

    return function() {
      var editorElement = CKEDITOR.document.getById( 'editor' );

      // :(((
      if ( isBBCodeBuiltIn ) {
        editorElement.setHtml(
          'Hello world!\n\n' +
          'I\'m an instance of [url=http://ckeditor.com]CKEditor[/url].'
        );
      }

      // Depending on the wysiwygare plugin availability initialize classic or inline editor.
      if ( wysiwygareaAvailable ) {
        CKEDITOR.replace( 'editor' );
      } else {
        editorElement.setAttribute( 'contenteditable', 'true' );
        CKEDITOR.inline( 'editor' );

        // TODO we can consider displaying some info box that
        // without wysiwygarea the classic editor may not work.
      }
    };

    function isWysiwygareaAvailable() {
      // If in development mode, then the wysiwygarea must be available.
      // Split REV into two strings so builder does not replace it :D.
      if ( CKEDITOR.revision == ( '%RE' + 'V%' ) ) {
        return true;
      }

      return !!CKEDITOR.plugins.get( 'wysiwygarea' );
    }
  } )();
  initSample();
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