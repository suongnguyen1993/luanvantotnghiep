<!DOCTYPE html>
<html lang="en">
<head>
  <?php $this->load->view('frontend/element/head/index'); ?>
</head>
<body >
	
		<header id="header">      
			<?php $this->load->view('frontend/element/header/index', isset($group)?$group:""); ?>
		</header>
		 <section id="page-breadcrumb">
				<?php $this->load->view('frontend/element/item/sidebar'); ?>
		</section>
        <section id="blog" class="padding-top">
        <div class="container">
            <div class="row">
              <div class="col-md-3 col-sm-5">
                    <div class="sidebar blog-sidebar">
                      
                        <?php $this->load->view('frontend/element/item/left-menu'); ?>
                       
                    </div>
                </div>
                 <div class="col-md-9 col-sm-7">
                    <div class="row">
					<?php if (isset($template) && !empty($template))
					{ $this->load->view($template,isset($data)?$data:NULL);}
					?>
				</div>
                   
                    <!--end row-->
                    
                 </div>
                
            </div>
        </div>
    </section>
    


    <!--/#blog-->

		 <footer id="footer">
	        <?php $this->load->view('frontend/element/footer/index'); ?>
	    </footer>
	    <?php $this->load->view('frontend/element/foot/index'); ?>
	
</body>
</html>