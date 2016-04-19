<div class="container">
            <div class="row">
                <div class="col-sm-12 overflow">
                   <div class="social-icons pull-right">
                        <ul class="nav nav-pills">
                            <li><a href=""><i class="fa fa-facebook"></i></a></li>
                            <li><a href=""><i class="fa fa-twitter"></i></a></li>
                            <li><a href=""><i class="fa fa-google-plus"></i></a></li>
                            <li><a href=""><i class="fa fa-dribbble"></i></a></li>
                            <li><a href=""><i class="fa fa-linkedin"></i></a></li>
                        </ul>
                    </div> 
                </div>
             </div>
        </div>
        <div class="navbar navbar-inverse" role="banner">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                    <a class="navbar-brand" href="index.html">
                    	<h1><img src="<?php echo base_url(); ?>/public/user/images/logo.png" alt="logo"></h1>
                    </a>
                    
                </div>
                <div class="collapse navbar-collapse">
                    <ul class="nav navbar-nav navbar-right">
                        <li <?php echo (isset ($current)&& $current == 'home')? 'class="active"':NULL; ?>><a href="index.php">Home</a></li>
                        <li class="dropdown"><a href="practice/abc">abc <i class="fa fa-angle-down"></i></a>
                            <ul role="menu" class="sub-menu">
                            <?php foreach ($group as $g)
                            {                             
                            ?>
                                
                            

                                <li ><a <?php echo (isset ($current)&& $current == 'about' )? 'class="active"':NULL; ?> href="practice/abc/<?php echo $g['id'] ?>"><?php echo $g['name'] ?></a></li>

                                <?php } ?>
                                
                            </ul>
                        </li>                    
                        <li class="dropdown"><a href="#">Blog <i class="fa fa-angle-down"></i></a>
                            <ul role="menu" class="sub-menu">
                                <li ><a <?php echo (isset ($current)&& $current == 'blog')? 'class=" active"':NULL; ?> href="user/blog/blog">Blog Default</a></li>
                                <li><a  <?php echo (isset ($current)&& $current == 'blog2')? 'class=" active"':NULL; ?> href="user/blog/blog2">Timeline Blog</a></li>
                                <li ><a <?php echo (isset ($current)&& $current == 'blog1')? 'class=" active"':NULL; ?> href="user/blog/blog1">2 Columns + Right Sidebar</a></li>
                                <li ><a <?php echo (isset ($current)&& $current == 'blog3')? 'class=" active"':NULL; ?> href="user/blog/blog3">1 Column + Left Sidebar</a></li>
                                <li ><a <?php echo (isset ($current)&& $current == 'blog4')? 'class=" active"':NULL; ?> href="user/blog/blog4">Blog Masonary</a></li>
                                <li><a  <?php echo (isset ($current)&& $current == 'blogdetails')? 'class=" active"':NULL; ?> href="user/blog/blogdetails">Blog Details</a></li>
                            </ul>
                        </li>
                        <li class="dropdown"><a href="#">Portfolio <i class="fa fa-angle-down"></i></a>
                            <ul role="menu" class="sub-menu">
                                <li <?php echo (isset ($current)&& $current == 'portfolio')? 'class=" active"':NULL; ?>><a href="user/portfolio/portfolio">Portfolio Default</a></li>
                                <li <?php echo (isset ($current)&& $current == 'portfolio4')? 'class=" active"':NULL; ?>><a href="user/portfolio/portfolio4">Isotope 3 Columns + Right Sidebar</a></li>
                                <li <?php echo (isset ($current)&& $current == 'portfolio1')? 'class=" active"':NULL; ?>><a href="user/portfolio/portfolio1">3 Columns + Right Sidebar</a></li>
                                <li <?php echo (isset ($current)&& $current == 'portfolio2')? 'class=" active"':NULL; ?>><a href="user/portfolio/portfolio2">3 Columns + Left Sidebar</a></li>
                                <li <?php echo (isset ($current)&& $current == 'portfolio3')? 'class=" active"':NULL; ?>><a href="user/portfolio/portfolio3">2 Columns</a></li>
                                <li <?php echo (isset ($current)&& $current == 'portfoliodetails')? 'class=" active"':NULL; ?>><a href="user/portfolio/portfoliodetails">Portfolio Details</a></li>
                            </ul>
                        </li>                         
                        <li <?php echo (isset ($current)&& $current == 'shortcodes')? 'class="active"':NULL; ?>><a href="user/shortcode/shortcodes ">Shortcodes</a></li>                    
                    </ul>
                </div>
                <div class="search">
                    <form role="form">
                        <i class="fa fa-search"></i>
                        <div class="field-toggle">
                            <input type="text" class="search-form" autocomplete="off" placeholder="Search">
                        </div>
                    </form>
                </div>
            </div>
        </div>