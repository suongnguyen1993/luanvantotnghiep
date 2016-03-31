<!DOCTYPE html>
<html lang="en">
<head>
  <?php $this->load->view('frontend/element/head/index'); ?>
</head>
<body >
	
		<header id="header">      
			<?php $this->load->view('frontend/element/header/index'); ?>
		</header>
		 <section id="page-breadcrumb">
				<?php $this->load->view('frontend/element/item/sidebar'); ?>
		</section>
					<?php if (isset($template) && !empty($template))
					{ $this->load->view($template,isset($data)?$data:NULL);}
					?>
				
		 <footer id="footer">
	        <?php $this->load->view('frontend/element/footer/index'); ?>
	    </footer>
	    <?php $this->load->view('frontend/element/foot/index'); ?>
	
</body>
</html>