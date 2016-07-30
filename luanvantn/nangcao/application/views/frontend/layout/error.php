<!DOCTYPE html>
<html lang="en">
<head>
  <?php $this->load->view('frontend/element/head/index'); ?>
</head>
<body >
	<section id="error-page">
		<?php if (isset($template) && !empty($template))
					{ $this->load->view($template,isset($data)?$data:NULL);}
					?>
	
	</section>
	<?php $this->load->view('frontend/element/foot/index'); ?>
	
</body>
</html>