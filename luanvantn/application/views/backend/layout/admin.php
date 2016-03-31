<!DOCTYPE html>
<html>
<head>
  <?php $this->load->view('backend/element/head/admin'); ?>
</head>
<body class="hold-transition skin-blue sidebar-mini">
	<div class="wrapper">
		<header class="main-header">
			<?php $this->load->view('backend/element/header/admin'); ?>
		</header>
			<?php $this->load->view('backend/element/item/left_menu'); ?>
		<div class="content-wrapper clearfix">
			<?php $this->load->view('backend/element/item/content_wrapper'); ?>
			<section class="content">
				<?php if (isset($template) && !empty($template))
				{ $this->load->view($template,isset($data)?$data:NULL);}
				?>
			</section>
		</div>
	
		<footer class="main-footer">
	        <?php $this->load->view('backend/element/footer/admin'); ?>
	    </footer>
	    <?php $this->load->view('backend/element/item/control_sidebar'); ?>
	</div>
	<?php $this->load->view('backend/element/foot/admin'); ?>
	<!-- o day nen bo sung 1 section
    
	 -->
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
</body>
</html>