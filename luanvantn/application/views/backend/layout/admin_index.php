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
			<div class="content-wrapper">
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
	<?php $this->load->view('backend/element/foot/add'); ?>
</body>
</html>