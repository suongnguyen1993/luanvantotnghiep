<!DOCTYPE html>
<html lang="en">
<head>
  <?php $this->load->view('frontend/element/head/index'); ?>
</head>
<body >
	
		<header id="header">      
			<?php $this->load->view('frontend/element/header/index',isset($group)?$group:""); ?>
		</header>
		 <section id="page-breadcrumb">
				<?php $this->load->view('frontend/element/item/sidebar'); ?>
		</section>
		 <section id="company-information" class="padding wow fadeIn" data-wow-duration="1000ms" data-wow-delay="300ms">
        <div class="container">
					<?php if (isset($template) && !empty($template))
					{ $this->load->view($template,isset($data)?$data:NULL);}
					?>
		<div>
		</section>
				
		 <footer id="footer">
	        <?php $this->load->view('frontend/element/footer/index'); ?>
	    </footer>
	    <?php $this->load->view('frontend/element/foot/index'); ?>
	
</body>
</html>