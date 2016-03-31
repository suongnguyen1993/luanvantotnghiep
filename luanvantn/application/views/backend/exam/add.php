<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
<?php echo validation_errors()?>
  <form id="frm-admin" method="post" action="">
                    <div class="form-group">
                      <label for="info" class="control-label">
                      Info:
                      </label>                      
                        <input type="text" class="form-control" name="info" id="info" placeholder="Info" value="<?php $this->input->post('info') ?>">                      
                    </div>
                    <div class="form-group">
                      <label for="time" class="control-label">
                      Time:
                      </label>                      
                        <input type="text" class="form-control" name="time" id="time" placeholder="dd/mm/yyy" value="<?php $this->input->post('time') ?>">                      
                    </div>
                    <div class="form-group">
                      <label for="url" class="control-label">
                      URL:
                      </label>                      
                        <input type="text" class="form-control" name="url" id="url" placeholder="URL" value="<?php $this->input->post('url') ?>">                      
                    </div>
                    <div class="form-group text-right">
                      <button type="submit" class="btn btn-success btn-flat"><span class="glyphicon glyphicon-floppy-disk" aria-hidden="true"></span> Save</button>
                      <button type="reset" class="btn btn-success btn-flat reset"><span class="glyphicon glyphicon-refresh" aria-hidden="true"></span> Reset</button>
                      <a href="admin/exam/index" class="btn btn-success"><span class="glyphicon glyphicon-share-alt" aria-hidden="true"></span> Return</a>
                    </div> 

</form>
</div>