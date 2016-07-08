	<!-- jQuery -->
	<script type="text/javascript" src="<?php echo base_url(); ?>/public/user/js/jquery.js"></script>
	<!-- bootstrap.min -->
    <script type="text/javascript" src="<?php echo base_url(); ?>/public/user/js/bootstrap.min.js"></script>
	<!-- lightbox -->
    <script type="text/javascript" src="<?php echo base_url(); ?>/public/user/js/lightbox.min.js"></script>
	<!-- wow.min -->
    <script type="text/javascript" src="<?php echo base_url(); ?>/public/user/js/wow.min.js"></script>
	<!--main -->
    <script type="text/javascript" src="<?php echo base_url(); ?>/public/user/js/main.js"></script>
    <!-- dich nghia tu vựng -->
    
	
	<script type="text/javascript" >
		$('.check_login').click(function(){
			var href = $(this).data('href');
			var url = '<?php echo base_url() ?>' + 'login/login/check_login';
			$.get(url,function(result){
				if(result == 1)
				{
					window.location = href;
				}
				else
				{
					if(confirm('Bạn chưa đăng nhập, bạn có muốn qua trang đăng nhập?'))
					{
						window.location = 'login/login';
					}
				}
			});
		});
	</script>
    

