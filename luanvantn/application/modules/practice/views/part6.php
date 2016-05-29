
                     <form action="" method="post" accept-charset="utf-8">
                     <div class="row">
                    
                  
<?php
		
				$dem1 = 69;
				 foreach ($part6 as $pIndex => $hoi)
                                          {
                                          	?>
                
                <div class="col-sm-12 blog-padding-right" >
                
                <label style="font-size:20px">
                                    <?php 
									if(isset($dem1))
									echo 'Questions ' .$dem1.' - ' .($dem1+2);
									
									?>

                                    </label>
                                    <h2 class="post-title bold" style="border:double;border-color:#00aeef;  margin-bottom:10px; padding:20px 20px 20px 20px; " >
                                   
				<?php 
				
				echo  $hoi['long_content'];
				?>
              
                </h2>
                 
                </div>
                <?php
				foreach($hoi['question'] as $index => $ques)
                                            { 
                                                 
                                    			 $userchoice= -1;
                                                if(isset ($ques['user_choice']))
                                                {
                                                    $userchoice = $ques['user_choice'];
                                                }
                                    ?>

                                       <?php if ($userchoice == -1)
                                        {
					?>
                     <div class="col-md-6 col-sm-12 blog-padding-right">
                     <div class="single-blog two-column">
                     <div class="post-content overflow">
                     <label style="font-size:16px">
                     <?php
					 echo $dem1++.'.';
					 ?>
                     </label>
                     
          
                    
                  <br />
                    <?php
					
					$diem1 = 0;
					
					
					
					foreach($ques['traloi'] as $tl)
				{
					
					$diem1 += 1;
					
					switch($diem1){
					case '1':
						$thutu = "(A) ";
						break;
					case '2':
						$thutu = "(B) ";
						break;
					case '3':
						$thutu = "(C) ";
						break;
					case '4':
						$thutu = "(D) ";
						break;
						
					}			
			
?>
			<input type="radio" name="part6[<?php echo $pIndex; ?>][<?php echo $index; ?>]"
                                     value="0" hidden checked = 'checked'/>
		   <label >                         
         <h3 class="post-author">
         <input style="margin-left:25px"  type="radio" value="<?php echo $tl['id'] ?>" name="part6[<?php echo $pIndex; ?>][<?php echo $index; ?>]"/> 
            <?php echo $thutu; echo $tl['content'];?></h3></label></br>
                     			 
	<?php
	}
	?>
 
 </div>
 
 </div>

 </div>

 <?php
	} else { 
	?>
		 <div class="col-md-6 col-sm-12 blog-padding-right">
                     <div class="single-blog two-column">
                     <div class="post-content overflow">
                     <label style="font-size:16px">
                     <?php
					 echo $dem1++.'.';
					 ?>
                     </label>
                     
          
                    
                  <br />
                    <?php
					
					$diem1 = 0;
					
					
					
					foreach($ques['traloi'] as $tl)
				{
					
					$diem1 += 1;
					
					switch($diem1){
					case '1':
						$thutu = "(A) ";
						break;
					case '2':
						$thutu = "(B) ";
						break;
					case '3':
						$thutu = "(C) ";
						break;
					case '4':
						$thutu = "(D) ";
						break;
						
					}			

					 $correct_answer = $tl['correct_answer'];

                                          $class="";
                                            if ($userchoice == $tl['id'])
                                            {

                                                $checked = 'checked';
                                                if($correct_answer== 1)
                                                {
                                                    $class= 'style="color:green"';
                                                }
                                                else 
                                                {
                                                    $class= 'style="color:red"';
                                                }
                                            
                                           
                                ?> 
                                  <input  type="radio" name="part6[<?php echo $pIndex; ?>][<?php echo $index; ?>]"
                                     value="0" hidden checked = 'checked'/>
                                       
                                

                                <label <?php echo $class; ?>> <h3 class="post-author"><input disabled  type="radio" name="part6[<?php echo $pIndex; ?>][<?php echo $index; ?>]" value="<?php echo $tl['id'] ?>" checked="<?php echo $checked ?>">

                                      <?php  echo $thutu ; echo $tl['content']?></h3></label></br>
                                 <?php } else{ ?>
                                <?php  
                                            if($correct_answer==1)
                                            {
                                                $class= 'style="color:#00aeef"';
                                            }
                                     ?>
                                     <label <?php echo $class; ?>> <h3 class="post-author"><input disabled  type="radio" name="part6[<?php echo $pIndex; ?>][<?php echo $index; ?>]" value="<?php echo $tl['id'] ?>" >
                                    <?php  echo $thutu ; echo $tl['content']?></h3> </label></br>
                                                   <?php } ?>
                                <?php } // end foreach traloi?>

                                    </div>
 
									 </div>

									 </div>
                                  
                                   <?php } //end else?>     
                    

 <?php
    }//end question
    ?>
 
   <hr />
     
<?php
    }//end long_question
    ?>
  
</div>
 <p align="center">
                          <input type="submit" name="submit" value="Hoàn thành" class="btn btn-sm btn-primary">
                           </p>
                      </form>
                    
  
