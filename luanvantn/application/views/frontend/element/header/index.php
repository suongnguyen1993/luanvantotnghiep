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
                            <li>
                                <a href="<?php echo ($this->session->has_userdata('username'))?'index':'login' ?>">
                                    <?php echo ($this->session->has_userdata('username'))?$this->session->userdata('username'):"Đăng Nhập"; ?>
                                </a>
                            </li>
                            <li>
                                <a href="<?php echo ($this->session->has_userdata('username'))?'login/detroy_sess':'dangky/index'  ?>">
                                    <?php echo ($this->session->has_userdata('username'))?"Đăng Xuất":"Đăng Ký"; ?>
                                </a>
                            </li>
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

                    <a class="navbar-brand" href=".">
                    	<h1><img src="<?php echo base_url(); ?>/public/user/images/logo.png" alt="logo"></h1>
                    </a>
                    
                </div>
                <div class="collapse navbar-collapse">
                    <ul class="nav navbar-nav navbar-right">
                        <li <?php echo (isset ($current)&& $current == 'home')? 'class="active"':NULL; ?>><a href="index.php">Trang Chủ</a></li>
                        <li class="dropdown"><a href="practice/abc">Luyện Tập <i class="fa fa-angle-down"></i></a>
                            <ul role="menu" class="sub-menu">
                            <?php foreach ($group as $g)
                            {                             
                            ?>
                                
                            

                                <li ><a <?php echo (isset ($current) && $current == 'about' )? 'class="active"':NULL; ?> href="practice/abc/<?php echo $g['id'] ?>"><?php echo $g['name'] ?></a></li>

                                <?php } ?> 
                                
                            </ul>
                        </li>                    
                        <li class="dropdown <?php echo (isset ($current)&& $current == 'test' ||isset ($current)&& $current == 'dau_vao' || isset ($current)&& $current == 'fulltest' || isset ($current)&& $current == 'minitest' )?'active':NULL ?> "  ><a href="test/test" >Bài Kiểm Tra <i class="fa fa-angle-down"></i></a>
                            <ul role="menu" class="sub-menu">
                                <li onclick="check_longin(<?php $a = $this->session->has_userdata('username') ?>)" >
                                <a <?php echo (isset ($current)&& $current == 'dau_vao')? 'class=" active"':NULL; ?> >
                                Kiểm tra đầu vào
                                </a>
                                </li>
                                <li >
                                <a <?php echo (isset ($current)&& $current == 'fulltest')? 'class=" active"':NULL; ?> href="test/full_test/full_test">Full Test</a>
                                </li>
                                <li>
                                <a  <?php echo (isset ($current)&& $current == 'minitest')? 'class=" active"':NULL; ?> href="test/mini_test/mini_test">Mini Test</a>
                                </li>
                                
                            </ul>
                        </li>
                         <li class="dropdown <?php echo (isset ($current)&& $current == 'review' || isset ($current)&& $current == 'ReviewQuestion' || isset ($current)&& $current == 'vocabulory' )?'active':NULL ?> "  ><a href="test/full_test" >Ôn Tập<i class="fa fa-angle-down"></i></a>
                            <ul role="menu" class="sub-menu">
                                <li >
                                <a <?php echo (isset ($current)&& $current == 'ReviewQuestion')? 'class=" active"':NULL; ?> href="test/dau_vao">Ôn Câu Hỏi</a>
                                </li>
                                <li >
                                <a <?php echo (isset ($current)&& $current == 'vocabulory')? 'class=" active"':NULL; ?> href="test/full_test/full_test">Ôn Từ Vựng</a>
                                </li>
                                                                
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