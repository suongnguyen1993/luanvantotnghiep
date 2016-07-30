<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
<?php echo validation_errors()?>
  <form id="frm-admin" method="post" action="">
                    <div class="form-group">
                      <label for="fullname" class="control-label">
                      Full name:
                      </label>                      
                        <input type="text" class="form-control" name="fullname" id="fullname" placeholder="Full name" value="<?php echo $user['fullname']; ?>">                      
                    </div> 
                    <div class="form-group">
                      <label for="username" class=" control-label">
                      User name:
                      </label>                      
                        <input type="text" class="form-control" name="username" id="username" placeholder="User name" value="<?php echo $user['username']; ?>">                      
                    </div>
                    <div class="form-group">
                      <label for="email" class=" control-label">
                      Email:
                      </label>                      
                        <input type="email" class="form-control" name="email" id="email" placeholder="Email" value="<?php echo $user['email']; ?>">                      
                    </div>
                    <div class="form-group">
                      <label for="password" class=" control-label">Password:
                      </label>                     
                        <input type="password" class="form-control" name="password" id="password" placeholder="Password" >
                    </div>
                    <div class="radio-inline">
                        <label>
                            <input type="radio" class="minimal-red" name="publish" id="publish" value="0" />
                            Show
                        </label>
                    </div> 
                    <div class="radio-inline">
                        <label>
                            <input type="radio" class="minimal-red" name="publish" id="publish" value="1" />
                            Hide
                        </label>
                    </div>
                    <div class="form-group text-right">
                      <button type="submit" class="btn btn-success btn-flat"><span class="glyphicon glyphicon-floppy-disk" aria-hidden="true"></span> Save</button>
                      <button type="reset" class="btn btn-success btn-flat reset"><span class="glyphicon glyphicon-refresh" aria-hidden="true"></span> Reset</button>
                      <a href="admin/user/index" class="btn btn-success"><span class="glyphicon glyphicon-share-alt" aria-hidden="true"></span> Return</a>
                    </div> 

</form>
</div>