<section id="blog" class="padding-top">
    <div class="container">
        <div class="row">
            <div class="col-md-2 col-sm-4">
                <div class="sidebar blog-sidebar"> 
                </div>
            </div>
            <div class="col-md-9 col-sm-7">
                <div class="row">
                    <div class="col-md-6 col-sm-6">
                        
                        <div class="contact-form bottom">
                            <h2>Đăng Ký</h2>
                            <div class="error" style="color:red;text-align: center;font-size: large;font-weight: bold;"><?php  echo validation_errors();  ?></div>
                            <div class="error" style="color:red;text-align: center;font-size: large;font-weight: bold;"><?php  echo isset($error)?$error:"";  ?></div>
                            <form id="resign-contact-form" name="resign-form" method="post" action="">
                                <div class="form-group">
                                    Họ và Tên:<input type="text" name="fullname" value="<?php echo $this->input->post('fullname') ?>" class="form-control" placeholder="Full Name">
                                </div>
                                <div class="form-group">
                                    Email (*):<input type="email" name="email" value="<?php echo $this->input->post('email') ?>" class="form-control" required="required" placeholder="Email">
                                </div>
                                <div class="form-group">
                                    Tên đăng nhập (*):<input type="text" name="username" value="<?php echo $this->input->post('username') ?>" class="form-control" required="required" placeholder="Username">
                                </div>
                                <div class="form-group">
                                    Mật khẩu (*):<input type="password" name="password" class="form-control" required="required" placeholder="Password">
                                </div>
                                <div class="form-group">
                                    Nhập lại mật khẩu (*):<input type="password" name="repassword" class="form-control" required="required" placeholder="RePassword">
                                </div>                          
                                <div class="form-group">
                                    <input type="submit" name="submit" class="btn btn-submit" value="Submit">
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-6">
                        <div class="contact-form bottom">
                            <h2>Đăng Ký Bằng Facebook</h2>
                            <?php if(!$this->session->has_userdata('username')){?>
                                <div class="fb">
                                    <a href="<?=$facebook_login_url?>" class="waves-effect waves-light btn indigo darken-3">
                                        <i class="fa fa-facebook left"></i> Facebook login
                                    </a>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
             </div>
        </div>
    </div>
</section>