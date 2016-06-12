
                      <form action="" method="post" accept-charset="utf-8">
                  <div class="row" >
<?php
		
				$dem1 = 1;
				 foreach ($part7 as $pIndex => $hoi)
                                          {
                                          	?>
                
                <div class="col-sm-12 blog-padding-right" >
                <h2 class="post-title bold" >
                	
              
               
                <label style="font-size:20px"></br></br>  
                                    <?php 
									if(isset($dem1))
									echo 'Questions ' .$dem1;
									
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
                    
                     <div class="post-content overflow" style="height: 280px">
                    <label >
                       <h3 class="post-title bold">
                     <?php echo $dem1++.'. ';echo $ques['content'];?>
                     </h3>
                     </label>
          
                    
                  <br />
                    <?php
					
					$diem1 = 0;
					
					
					
					foreach($ques['traloi'] as $tl)
				{
					
					$diem1 += 1;
					
					switch($diem1){
					case '1':
						$thutu = "(A). ";
						break;
					case '2':
						$thutu = "(B). ";
						break;
					case '3':
						$thutu = "(C). ";
						break;
					case '4':
						$thutu = "(D). ";
						break;
						
					}			
			
?>
			<input type="radio" name="part7[<?php echo $pIndex; ?>][<?php echo $index; ?>]"
                                     value="0" hidden checked = 'checked'/>
		   <label >                         
         <h3 class="post-author">
         <input   type="radio" value="<?php echo $tl['id'] ?>" name="part7[<?php echo $pIndex; ?>][<?php echo $index; ?>]"/> 
            <?php echo $thutu; echo $tl['content'];?></h3></label></br>
                     			 
	<?php
	}
	?>
 
 </div>
 
 

 </div>

 <?php
	} else { 
	?>
		 <div class="col-md-6 col-sm-12 blog-padding-right">
                    
                     <div class="post-content overflow"  style="height:280px">
                   <label >
                       <h3 class="post-title bold">
                     <?php echo $dem1++.'. ';echo $ques['content'];?>
                     </h3>
                     </label>
                     
          
                    
                  <br />
                    <?php
					
					$diem1 = 0;
					
					
					
					foreach($ques['traloi'] as $tl)
				{
					
					$diem1 += 1;
					
					switch($diem1){
					case '1':
						$thutu = "(A). ";
						break;
					case '2':
						$thutu = "(B). ";
						break;
					case '3':
						$thutu = "(C). ";
						break;
					case '4':
						$thutu = "(D). ";
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
                                  <input  type="radio" name="part7[<?php echo $pIndex; ?>][<?php echo $index; ?>]"
                                     value="0" hidden checked = 'checked'/>
                                       
                                

                                <label <?php echo $class; ?>> <h3 class="post-author"><input disabled  type="radio" name="part7[<?php echo $pIndex; ?>][<?php echo $index; ?>]" value="<?php echo $tl['id'] ?>" checked="<?php echo $checked ?>">

                                      <?php  echo $thutu ; echo $tl['content']?></h3></label></br>
                                 <?php } else{ ?>
                                <?php  
                                            if($correct_answer==1)
                                            {
                                                $class= 'style="color:#00aeef"';
                                            }
                                     ?>
                                     <label <?php echo $class; ?>> <h3 class="post-author"><input disabled  type="radio" name="part7[<?php echo $pIndex; ?>][<?php echo $index; ?>]" value="<?php echo $tl['id'] ?>" >
                                    <?php  echo $thutu ; echo $tl['content']?></h3> </label></br>
                                                   <?php } ?>
                                <?php } // end foreach traloi?>

                                    </div>
 
									

									 </div>
                                  
                                   <?php } //end else?>     
                    

 <?php
    }//end question
    ?>
 
 
     
<?php
    }//end long_question
    ?>
  
</div>

 <p align="center">
                          <input type="submit" name="submit" value="Hoàn thành" class="btn btn-sm btn-primary">
                           </p>
                      </form>
                    
                          
                    
  
