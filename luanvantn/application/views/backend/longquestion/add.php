<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
<?php echo validation_errors();
      echo isset($error)?$error:"";
?>
  <form id="frm-admin" method="post" action="">
 
                    <div class="box box-info">

                      <div class="box-header">
                       <h3 class="box-title">Long Question</h3>
                                    <!-- tools box -->
                        
                      </div>
                      <div class="box-body pad">
                          <textarea id="long_content" name="long_content" rows="10" cols="80" placeholder='Add long question'><?php echo $this->input->post('long_content') ?></textarea>
                      </div>   
                      </div>  

                    <div class="form-group text-right">
                      <button type="submit" class="btn btn-success btn-flat"><span class="glyphicon glyphicon-floppy-disk" aria-hidden="true"></span> Save</button>
                      <button type="reset" class="btn btn-success btn-flat reset"><span class="glyphicon glyphicon-refresh" aria-hidden="true"></span> Reset</button>
                      <a href="admin/longquestion/index" class="btn btn-success"><span class="glyphicon glyphicon-share-alt" aria-hidden="true"></span> Return</a>
                    </div> 

</form>
</div>