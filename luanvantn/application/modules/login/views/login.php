<section id="blog" class="padding-top">
    <div class="container">
        <div class="row">
            <div class="col-md-4 col-sm-7 col-md-offset-4">
                <div class="row">
                    <div class="col-md-12 col-sm-12">
                    
                        <div class="contact-form bottom">
                            <h2>Đăng Nhập</h2>
                            <div class="error" style="color:red;text-align: center;font-size: large;font-weight: bold;"><?php  echo validation_errors();  ?></div>
                            <div class="error" style="color:red;text-align: center;font-size: large;font-weight: bold;"><?php  echo isset($error)?$error:"";  ?></div>
                            <form id="login-contact-form" name="login-form" method="post" action="">
                                
                                
                                <div class="form-group">
                                    Tên đăng nhập (*):<input type="text" name="username" autocomplete = 'off' value="<?php echo $this->input->post('username') ?>" class="form-control" required="required" placeholder="Username">

                                </div>
                                <div class="form-group">
                                    Mật Khẩu (*):<input type="password" name="password" class="form-control" required="required" placeholder="Password">
                                </div>
                                
                              
                                <div class="form-group">
                                    <input type="submit" name="submit" class="btn btn-submit" value="Đăng Nhập">
                                </div>
                                <div class="hoac">
                                    Đăng nhập bằng Facebook:
                                </div>
                                <hr>
                                <?php 
                            if(!$this->session->has_userdata('username')){?>
                                <div class="fb">
                                <a href="<?=$facebook_login_url?>"class="waves-effect waves-light btn indigo darken-3"><i class="fa fa-facebook left"></i> Facebook login</a>
                                </div>
                               

                                <?php } ?>
                            </form>

                            
                        </div>
                    </div>
                </div>
             </div>
        </div>
    </div>
</section>