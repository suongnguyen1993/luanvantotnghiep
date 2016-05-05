<section id="blog" class="padding-top">
    <div class="container">
        <div class="row">
            <div class="col-md-2 col-sm-4">
                <div class="sidebar blog-sidebar"> 
                </div>
            </div>
            <div class="col-md-9 col-sm-7">
                <div class="row">
                    <div class="col-md-12 col-sm-12">
                    
                        <div class="contact-form bottom">
                            <h2>Đăng Nhập</h2>
                            <div class="error" style="color:red;text-align: center;font-size: large;font-weight: bold;"><?php  echo validation_errors();  ?></div>
                            <div class="error" style="color:red;text-align: center;font-size: large;font-weight: bold;"><?php  echo isset($error)?$error:"";  ?></div>
                            <form id="login-contact-form" name="login-form" method="post" action="">
                                <div class="form-group">
                                    Username (*):<input type="text" name="username" value="<?php echo $this->input->post('username') ?>" class="form-control" required="required" placeholder="Username">
                                </div>
                                <div class="form-group">
                                    Password (*):<input type="password" name="password" class="form-control" required="required" placeholder="Password">
                                </div>     
                                <div class="form-group">
                                    <input type="submit" name="submit" class="btn btn-submit" value="Submit">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
             </div>
        </div>
    </div>
</section>