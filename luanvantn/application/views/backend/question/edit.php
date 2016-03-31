<div class=" form-group">	
<?php echo validation_errors();
	echo isset($error)?$error:"";
?>
	<form id="frm-admin" method="post" action="" enctype="multipart/form-data">
	<div class="box box-info">
                <div class="box-header">
                  <h3 class="box-title">Long Question</h3>
                  <!-- tools box -->
                  
                </div><!-- /.box-header -->
                <div class="box-body pad">
                    <textarea id="long_question" name="long_question" rows="10" cols="80" placeholder='Add long question'><?php echo $long_question['content'] ?></textarea>
                </div>
    </div><!-- /.box -->

	<div class="form-group">	
		<h4>Question</h4>
		<textarea class="form-control" rows="5" placeholder=" Enter ..."
		 name="content" ><?php echo $question['content'] ?></textarea>
	</div>
	<div class="form-group col-xs-6 col-sm-6 col-md-6 col-lg-6">	
	<h4>Group</h4>
		<select name="group" class="form-control">
		<?php 
		
			foreach($group as $g)
			{	
		 ?>
		<option value="<?php echo $g['id'] ?>" <?php echo ($question['group_id']==$g['id'])?'selected="selected"':""; ?>><?php echo $g['name']; ?></option>
		<?php } ?>
		</select>
	</div>
	<div class="input-group col-xs-6 col-sm-6 col-md-6 col-lg-6">
		<h4>Level:</h4>
		   <input name="level" type="text" value = "<?php echo $question['level'] ?>" placeholder = "Enter number level " class="form-control" >
	</div>
	<div class="form-group">
	<h4 style="width: 200px">Number Chooses:</h4>
		<div class="input-group">
		
			    <label class="input-group-addon"> 4 chooses
			    <input name="numberchoose" type="radio" value="4" checked>    
				</label>
				<label class="input-group-addon"> 3 chooses 
			    <input name="numberchoose" type="radio" value="3">
			    </label>
		</div>   
	</div>
	<div class="form-group">
	<h4>Choose:</h4>
	    <div class="input-group">
		    <p class="input-group-addon"> Correct answer A
		    <input name="choosecorrect" value= '1' type="radio" <?php echo ($chooses[0]['correct_answer'] == 1)?'checked="checked"':""; ?>>
		    </p>
		    <input name="choosecontent1" type="text" class="form-control" value="<?php echo $chooses[0]['content']; ?>">
	    </div>
	</div>    
	<div class="form-group text-right">
	    <div class="input-group">
		    <p class="input-group-addon"> Correct answer B
		    <input name="choosecorrect" value='2' type="radio" <?php echo ($chooses[1]['correct_answer'] == 1)?'checked="checked"':""; ?>>
		    </p>
		    <input name="choosecontent2"  type="text" class="form-control" value="<?php echo $chooses[1]['content']; ?>"  >
	    </div>
	</div>
	<div class="form-group text-right">
	    <div class="input-group">
		    <p class="input-group-addon"> Correct answer C
		    <input name="choosecorrect" value='3' type="radio" <?php echo ($chooses[2]['correct_answer'] == 1)?'checked="checked"':""; ?>>
		    </p>
		    <input name="choosecontent3" type="text" class="form-control" value="<?php echo $chooses[2]['content']; ?>">
	    </div>
	</div>
	<div class="form-group text-right" id="chooseD">
	    <div class="input-group">
		    <label class="input-group-addon"> Correct answer D
		    <input id="radioD" name="choosecorrect" value="4" type="radio" <?php echo ($chooses[3]['correct_answer'] == 1)?'checked="checked"':""; ?>>
		    </label>
		    <input id="textD" name="choosecontent4" 
		    value="<?php echo (isset($chooses[3]['content']))?$chooses[3]['content']:""; ?>" placeholder = "Enter content of choose D " type="text" class="form-control">
	    </div>
	</div> 

	<div class="form-group">
	    <h4 for="audio_file">Audio:  </h4>	 
	    <input type="file" name="audio_file" id="audio_file">
	    <div >
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

