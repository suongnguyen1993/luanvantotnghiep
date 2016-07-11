 <div class="container">
            <div class="row">
                <div class="main-slider">
                    <div class="slide-text">
                        <h1>Chào bạn đến với iToeic</h1>
                        <p>iToeic là hệ thống website thông minh. </p>
                        <p>Đến với hệ thống iToeic các học viên sẽ được hệ thống đưa ra câu hỏi phù hợp với trình độ của bạn.Giúp các bạn hứng thú trong việc học tiếng anh từ đó nâng cao được trình độ của mình </p>
                        <p>WELCOME TO iTOEIC - YOUR ENGLISH WORLD  </p>
                        <a href="<?php echo ($this->session->has_userdata('username'))?'index':'dangky' ?>" class="btn btn-common"> <?php echo ($this->session->has_userdata('username'))?"WELCOME":"ĐĂNG KÝ"; ?></a>
                    </div>
                    <img src="<?php echo base_url(); ?>/public/user/images/home/slider/hill.png" class="slider-hill" alt="slider image">
                    <img src="<?php echo base_url(); ?>/public/user/images/home/slider/house.png" class="slider-house" alt="slider image">
                    <img src="<?php echo base_url(); ?>/public/user/images/home/slider/sun.png" class="slider-sun" alt="slider image">
                    <img src="<?php echo base_url(); ?>/public/user/images/home/slider/birds1.png" class="slider-birds1" alt="slider image">
                    <img src="<?php echo base_url(); ?>/public/user/images/home/slider/birds2.png" class="slider-birds2" alt="slider image">
                </div>
            </div>
        </div>
        <div class="preloader"><i class="fa fa-sun-o fa-spin"></i></div>