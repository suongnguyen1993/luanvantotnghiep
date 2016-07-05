<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
<?php echo validation_errors();
      echo isset($error)?$error:"";
?>
  <form id="frm-admin" method="post" action="">
     
                    <div class="form-group">
                      <label for="fullname" class="control-label">
                      Full name:
                      </label>                      
                        <input type="text" class="form-control" name="fullname" id="fullname" required="required" placeholder="Full name" value="<?php echo $this->input->post('fullname') ?>">                      
                    </div> 
                    <div class="form-group">
                      <label for="username" class=" control-label">
                      User name:
                      </label>                      
                        <input type="text" class="form-control" name="username" required="required" id="username" placeholder="User name" value="<?php echo $this->input->post('username') ?>">                      
                    </div>
                    <div class="form-group">
                      <label for="email" class=" control-label">
                      Email:
                      </label>                      
                        <input type="email" class="form-control" name="email" required="required" id="email" placeholder="Email" value="<?php echo $this->input->post('email') ?>">                      
                    </div>
                    <div class="form-group">
                      <label for="password" class=" control-label">Password:
                      </label>                     
                        <input type="password" class="form-control" required="required" name="password" id="password" placeholder="Password">
                    </div>
                    
                    <div class="form-group text-right">
                      <button type="submit" class="btn btn-success btn-flat"><span class="glyphicon glyphicon-floppy-disk" aria-hidden="true"></span> Save</button>
                      <button type="reset" class="btn btn-success btn-flat reset"><span class="glyphicon glyphicon-refresh" aria-hidden="true"></span> Reset</button>
                      <a href="admin/admin/index" class="btn btn-success"><span class="glyphicon glyphicon-share-alt" aria-hidden="true"></span> Return</a>
                    </div> 

</form>
</div>