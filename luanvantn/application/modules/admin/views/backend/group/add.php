<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
<?php echo validation_errors();?>
  <form id="frm-admin" method="post" action="">
     
                    <div class="form-group">
                      <label for="name" class="control-label">
                      Group name:
                      </label>                      
                        <input type="text" class="form-control" required="required" name="name" id="name" placeholder="Group name" value="<?php $this->input->post('name') ?>">                      
                    </div> 

                    <div class="form-group text-right">
                      <button type="submit" class="btn btn-success btn-flat"><span class="glyphicon glyphicon-floppy-disk" aria-hidden="true"></span> Save</button>
                      <button type="reset" class="btn btn-success btn-flat reset"><span class="glyphicon glyphicon-refresh" aria-hidden="true"></span> Reset</button>
                      <a href="admin/user/index" class="btn btn-success"><span class="glyphicon glyphicon-share-alt" aria-hidden="true"></span> Return</a>
                    </div> 

</form>
</div>