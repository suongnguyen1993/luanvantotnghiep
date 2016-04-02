<style>
	.input-group-addon{
		cursor: pointer;
		vertical-align: middle;
	}
</style>

<div class=" form-group col-xs-6 col-sm-6 col-md-6 col-lg-6">

<?php 
	//echo validation_errors();
	echo isset($error)?$error:"";
?>
<form id="frm-admin" method="post" action="" enctype="multipart/form-data">
	<div class="form-group">
                    <h4>Long question</h4>

                  <div class="form-group">
                    <select class="form-control select2" style="width: 100%;">
                      <option selected="selected"></option>

                      <option>Alaska</option>
                      <option>California</option>
                      <option>Delaware</option>
                      <option>Tennessee</option>
                      <option>Texas</option>
                      <option>Washington</option>
                    </select>
                  </div><!-- /.form-group -->               
    </div>
      
	<div class="form-group">	
		<h4>Question</h4>
		<textarea class="form-control" rows="5" placeholder=" Enter ..."
		 name="content" value = ""><?php echo $this->input->post('content') ?></textarea>
	</div>
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
    <h4> Level:</h4>
	    <div class="radio">

	        <label>
	        <input type="radio" name="level" id="optionsRadios1" value="1" checked="checked">
	                          Easy
	        </label> <br>
	        <label>
	        <input type="radio" name="level" id="optionsRadios1" value="2">
	        	Medium
	        </label><br>
	        <label>
	        <input type="radio" name="level" id="optionsRadios1" value="3">
	           Difficult
	        </label>
	     </div>


	<h4 style="width: 200px">Number Chooses:</h4>
	<div class="input-group">
	
		    <label class="input-group-addon"> 4 chooses
		    <input name="numberchoose" type="radio" value="4" checked>    
			</label>
			<label class="input-group-addon"> 3 chooses 
		    <input name="numberchoose" type="radio" value="3">
		    </label>
	</div>
	<div class="form-group">
	<h4>Choose:</h4>
	    <div class="input-group">
		    <label class="input-group-addon"> Correct answer A
		    <input name="choosecorrect" value="1" type="radio" checked>
		    </label>
		    <input name="choosecontent1" type="text" value = "<?php echo $this->input->post('choosecontent1') ?>" placeholder = "Enter content of choose A " class="form-control" >
	    </div>
	</div>    
	<div class="form-group text-right">
	    <div class="input-group">
		    <label class="input-group-addon"> Correct answer B
		    <input name="choosecorrect" value="2" type="radio" >
		    </label>
		    <input name="choosecontent2" value = "<?php echo $this->input->post('choosecontent2') ?>" type="text" placeholder = "Enter content of choose B " class="form-control">
	    </div>
	</div>
	<div class="form-group text-right">
	    <div class="input-group">
		    <label class="input-group-addon"> Correct answer C
		    <input name="choosecorrect" value="3"  type="radio">
		    </label>
		    <input name="choosecontent3" value = "<?php echo $this->input->post('choosecontent3') ?>" type="text" placeholder = "Enter content of choose C " class="form-control">
	    </div>
	</div>
	<div class="form-group text-right" id="chooseD">
	    <div class="input-group">
		    <label class="input-group-addon"> Correct answer D
		    <input id="radioD" name="choosecorrect" value="4" type="radio">
		    </label>
		    <input id="textD" name="choosecontent4" value = "<?php echo $this->input->post('choosecontent4') ?>" placeholder = "Enter content of choose D " type="text" class="form-control">
	    </div>
	</div> 

	<div class="form-group">
	    <h4 for="audio_file">Audio:  </h4>	 
	    <input type="file" name="audio_file" id="audio_file">
	    <div style="margin-top: 10px;">
	    <audio controls id="prevAudio" src=""></audio>
	    </div>
	</div>
	
	<div class="form-group">
	    <h4 for="image">Image:  </h4>	 
	    <input type="file" name="image" id="image">
	  	<span>
	  		<img style="display: none;" src="" alt="" id="prevImage" height="200px" width="200px">
	  	</span>
	</div>
	
    <div class="form-group text-right">
            <button type="submit" class="btn btn-success btn-flat"><span class="glyphicon glyphicon-floppy-disk" aria-hidden="true"></span> Save</button>
            <button type="reset" class="btn btn-success btn-flat reset"><span class="glyphicon glyphicon-refresh" aria-hidden="true"></span> Reset</button>
            <a href="admin/question/index" class="btn btn-success"><span class="glyphicon glyphicon-share-alt" aria-hidden="true"></span> Return</a>
    </div>
</form>
</div>

