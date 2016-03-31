<!DOCTYPE html>
<html lang="en">
<head>
  <?php $this->load->view('frontend/element/head/index'); ?>
</head>
<body>
	
	
					<?php if (isset($template) && !empty($template))
					{ $this->load->view($template,isset($data)?$data:NULL);}
					?>
				
	<?php $this->load->view('frontend/element/foot/index'); ?>
	
	 <script type="text/javascript">
            //Countdown js
         $("#countdown").countdown({
                date: "10 march 2015 12:00:00",
                format: "on"
            },      
            function() {
                // callback function
        });
    </script>
	    
</body>
</html>