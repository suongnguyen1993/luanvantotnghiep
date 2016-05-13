
    <section id="projects" class="padding-top">
        <div class="container">
            <div class="row">

                <div class="col-md-12 col-sm-8">
                    <div class="row">
                        <div class="col-xs-4 col-sm-4 col-md-4 portfolio-item branded folio">
                            <div class="portfolio-wrapper">
                                <div class="portfolio-single">
                                    <div class="portfolio-thumb">
                                        <img src="<?php echo base_url(); ?>/public/user/images/portfolio/1.jpg" class="img-responsive" alt=""></a>
                                    </div>
                                    <a href="#">
                                        <div class="portfolio-view">
                                            <ul class="nav nav-pills">
                                                <li><h1 style="color: #fff">Full Test</h1></li>
                                            </ul>
                                        </div>
                                    </a>

                                    
                                </div>
                                <div class="portfolio-info ">
                                    <h2>Full Test</h2>
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-4 col-sm-4 col-md-4 portfolio-item design logos">
                            <div class="portfolio-wrapper">
                                <div class="portfolio-single">
                                    <div class="portfolio-thumb">
                                        <img src="<?php echo base_url(); ?>/public/user/images/portfolio/1.jpg" class="img-responsive" alt="">
                                    </div>
                                    <a href="#">
                                        <div class="portfolio-view">
                                            <ul class="nav nav-pills">
                                                <li><h1 style="color: #fff">Mini Test</h1></li>
                                            </ul>
                                        </div>
                                    </a>
                                    
                                </div>
                                <div class="portfolio-info ">
                                    <h2>Mini Test</h2>
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-4 col-sm-4 col-md-4 portfolio-item branded logos">
                            <div class="portfolio-wrapper">
                                <div class="portfolio-single">
                                    <div class="portfolio-thumb">
                                        <img src="<?php echo base_url(); ?>/public/user/images/portfolio/1.jpg" class="img-responsive" alt="">
                                    </div>
                                    <a>
                                        <div onclick="check_longin(<?php $a = $this->session->has_userdata('username') ?>)" class="portfolio-view">
                                             <ul class="nav nav-pills">
                                                <li><h1 style="color: #fff">Kiểm Tra Đầu Vào</h1></li>
                                            </ul>
                                        </div>
                                    </a>
                                </div>
                                <div class="portfolio-info ">
                                 <h2> Kiểm Tra Đầu Vào</h2>
                                </div>
                            </div>
                        </div>     
                    </div>
                </div>
            </div>
        </div>

    </section>
    <!-- <script type="text/javascript">
        function check_longin(e){
            if (e)
            {
                window.location = 'test/dauvao/mini_test';
    
            }
            else
            {
                alert('Bạn phải đăng nhập trước khi làm bài');
                window.location = 'login/login';
            }
        }
    
    </script> -->
    <!--/#projects-->