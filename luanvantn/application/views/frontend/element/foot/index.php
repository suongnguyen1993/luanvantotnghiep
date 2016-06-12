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
					if(confirm('Ban chua dang nhap, ban co muon qua trang dang nhap ?'))
					{
						window.location = 'login/login';
					}
				}
			});
		});
	</script>
    

    <script type="text/javascript">
    	var del = function(id){
    		if(!isNaN(id) && id < 1)
    		{
    			alert("id khong hop le");
    		}

    		if(confirm("Ban co chac muon xoa tu nay ?"))
    		{
    			

    			//fadeOut tao hieu ung tu tu bien mat
    			//Bat su kien sau khi bien mat, thi xoa luon cai the do
    			
    

    			$.get('<?php echo base_url() ?>/vocabulary/voca/delete_tudien/'+id, function(result){
    				if(result == 1)
    				{
    					$("#wpFocus"+id).fadeOut('slow', function(){
	    				$(this).remove();
	    				});
    				}
    				else
    				{
    					alert("Ko thanh cong");
    				}
    			})
    		}
    	}
    </script>

