<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
<?php echo validation_errors();
  echo isset($error)?$error:"";
?>
  <form id="frm-admin" method="post" action="">
                    <div class="form-group">
                      <label for="info" class="control-label">
                      Name:
                      </label>                      
                        <input type="text" class="form-control" name="name" id="name" placeholder="Name" value="<?php echo $exam['name'] ?>">                      
                    </div>

                    <div class="form-group">  
                      <h4>Infor:</h4>
                      <textarea class="form-control" rows="5" placeholder=" Enter ..."
                       name="info" id="info" value = ""><?php echo $exam['info'] ?></textarea>
                    </div>
                    <div class="form-group">
                      <label for="time" class="control-label">
                      Time:
                      </label>                      
                        <input type="year" class="form-control" name="time" id="time" placeholder="yyyy" value="<?php echo $exam['time'] ?>">                      
                    </div>
                    <div class="form-group">
                      <h4 for="audio_file">Audio:  </h4>   
                      <input type="file" name="audio_file" id="audio_file">
                      <div style="margin-top: 10px;">
                      <audio controls id="prevAudio" src=""></audio>
                      </div>
                  </div>
                    <div class="form-group text-right">
                      <button type="submit" class="btn btn-success btn-flat"><span class="glyphicon glyphicon-floppy-disk" aria-hidden="true"></span> Save</button>
                      <button type="reset" class="btn btn-success btn-flat reset"><span class="glyphicon glyphicon-refresh" aria-hidden="true"></span> Reset</button>
                      <a href="admin/exam/index" class="btn btn-success"><span class="glyphicon glyphicon-share-alt" aria-hidden="true"></span> Return</a>
                    </div> 

</form>
</div>