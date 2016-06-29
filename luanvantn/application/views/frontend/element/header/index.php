<div class="container">
            <div class="row">
                <div class="col-sm-12 overflow">
                   <div class="social-icons pull-right">
                        <ul class="nav nav-pills">
                            <!-- <li><a href=""><i class="fa fa-facebook"></i></a></li>
                            <li><a href=""><i class="fa fa-twitter"></i></a></li>
                            <li><a href=""><i class="fa fa-google-plus"></i></a></li>
                            <li><a href=""><i class="fa fa-dribbble"></i></a></li>
                            <li><a href=""><i class="fa fa-linkedin"></i></a></li> -->
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
                        <li <?php echo (isset ($current) && $current == 'home')? 'class="active"':NULL; ?>><a  href="index.php">Trang Chủ</a></li>
                        <li class="dropdown" ><a>Luyện Tập <i class="fa fa-angle-down"></i></a>
                            <ul role="menu" class="sub-menu">
                            <?php foreach ($group as $g){?>
                                <li >
                                    <a <?php echo (isset ($current)&& $current == "practice".$g['id'])? 'class="active"':NULL; ?>  data-href="practice/chitiet/<?php echo $g['id']?>" class='check_login'><?php echo $g['name'] ?></a>
                                </li>
                            <?php } ?> 
                                
                            </ul>
                        </li>                    
                        <li class="dropdown <?php echo (isset ($current)&& $current == 'test' ||isset ($current)&& $current == 'dau_vao' || isset ($current)&& $current == 'fulltest' || isset ($current)&& $current == 'minitest' )?'active':NULL ?> "  ><a href="test/test" >Bài Kiểm Tra <i class="fa fa-angle-down"></i></a>
                            <ul role="menu" class="sub-menu">
                                <li >
                                <a  <?php echo (isset ($current)&& $current == 'dau_vao')? 'class=" active"':NULL; ?> class='check_login' data-href="test/dauvao" >
                                Kiểm tra đầu vào
                                </a>
                                </li>
                                <li >
                                <a <?php echo (isset ($current)&& $current == 'fulltest')? 'class=" active"':NULL; ?> class='check_login' data-href="test/full_test">Full Test</a>
                                </li>
                                <li>
                                <a  <?php echo (isset ($current)&& $current == 'minitest')? 'class=" active"':NULL; ?> class='check_login' data-href="test/mini_test">Mini Test</a>
                                </li>
                                <li>
                                <a  <?php echo (isset ($current)&& $current == 'fixtest')? 'class=" active"':NULL; ?> class='check_login' data-href="test/fix_test/index/<?php ?>">Fix Test</a>
                                </li>
                                
                            </ul>
                        </li>
                         <li class="dropdown <?php echo (isset ($current1)&& $current1 == 'review' || isset ($current)&& $current == 'ReviewQuestion' || isset ($current)&& $current == 'vocabulory' )?'active':NULL ?> "  ><a class='check_login' data-href="review/review/index/1" >Ôn Câu Hỏi</i></a>
                        </li>
                        <li class="dropdown <?php echo (isset ($current)&& $current == 'tudien')?'active':NULL ?> "  ><a class='check_login' data-href="vocabulary/voca/tudien" >Từ Điển Cá Nhân</i></a>
                        </li>
                  
                    </ul>
                </div>
                
            </div>
        </div>