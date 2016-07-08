<div class="col-xs-9 col-sm-9 col-md-9 col-lg-9">
<?php echo validation_errors();
      echo isset($error)?$error:"";
?>
  <form id="frm-admin" method="post" action="" enctype="multipart/form-data">

                    <div class="form-group">  
                        <h4>Group</h4>
                        <select name="group" class="form-control">
                        <?php 
                          foreach($group as $g)
                          {
                         ?>
                        <option value="<?php echo $g['id'] ?>"><?php echo $g['name']; ?></option>
                        <?php } ?>
                        </select>
                    </div>
                     <div class="form-group">  
                        <h4>Exam</h4>
                        
                        <select name="exam" class="form-control">
                        <option value="-1">Select exam</option>}
                        option
                        <?php 
                          foreach($exam as $ex)
                          {
                         ?>
                        <option value="<?php echo $ex['id'] ?>" <?php echo (isset($id_exam) &&
                        $id_exam == $ex['id'])?'selected="selected"':""; ?> >
                        <?php echo $ex['name']; ?>
                        </option>
                        <?php } ?>
                        </select>
                      </div> 
                    <div class="box box-info">

                      <div class="box-header">
                       <h3 class="box-title">Long Question</h3>
                                    <!-- tools box -->
                        
                      </div>
                      <div class="box-body pad">
                          <textarea id="editor" id="long_content" name="long_content" rows="10" cols="80" placeholder='Add long question'><?php echo $this->input->post('long_content') ?></textarea>
                      </div>   
                      </div>

                      <h4> Level:</h4>
                      <div class="radio">

                           <label>
                          <input type="radio" name="level" id="optionsRadios1" value="100" checked="checked">
                                           Very Easy.
                          </label> <br>
                          <label>
                          <input type="radio" name="level" id="optionsRadios1" value="250">
                             Easy.
                          </label><br>
                          <label>
                          <input type="radio" name="level" id="optionsRadios1" value="400">
                             Medium.
                          </label><br>
                          <label>
                          <input type="radio" name="level" id="optionsRadios1" value="500">
                             Hard.
                          </label><br>
                          <label>
                          <input type="radio" name="level" id="optionsRadios1" value="700">
                             Very Hard.
                          </label>
                       </div>
                      <div class="form-group">
                      <h4>Number Question:</h4>
                          <div class="input-group">
                            <input name="number_question" type="number" required="required" class="form-control" value=""><?php echo $this->input->post('number_question') ?>
                          </div>
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
                      <a href="admin/longquestion/index" class="btn btn-success"><span class="glyphicon glyphicon-share-alt" aria-hidden="true"></span> Return</a>
                    </div> 

</form>
</div>

