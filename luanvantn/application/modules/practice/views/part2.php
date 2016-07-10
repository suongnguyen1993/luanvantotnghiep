<?php if(isset($error) && $error==1){ ?>
<div class="alert alert-warning alert-dismissible fade in" role="alert"> <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button><strong class='thong_bao'>Bạn hãy làm bài kiểm tra đầu vào! Để hệ thống gợi ý câu hỏi phù hợp với bạn. </strong> 
</div>
<?php }?>
                     <form action="" method="post" accept-charset="utf-8">
                   
                   
         
								<?php 
								$dem = 1;
							
								foreach($part2 as  $index => $q)
                             {
                                $userchoice= -1;
                                if(isset ($q['user_choice']))
                                {
                                    $userchoice = $q['user_choice'];
                                }
                            
                                    ?>
                        
                         <div class="col-md-6 col-sm-12 blog-padding-right" style="height:350px">
                            <div class="single-blog two-column">
                                <div >
                                   <label style="font-size:20px">
                                   
                                    <?php 
								echo 'Question ' .$dem++;
								?>
                                </label>
                                </div>
                                <div class="post-content overflow">
                                    <?php
									if( ($q['audio'])!="")
									{
										
										$b =($q['audio']);
									
										echo "
										<audio style='width:388.75px' controls> <source src='uploads/audio_files/$b '> </audio>";
										}
									?>
                                    </div>
                                    <div >
                             <?php
                               if ($userchoice == -1)
                                    {
                                        $dem1 = 0  ;
                                     foreach ($q['traloi'] as $tl)
                                        { 
                                            $dem1 += 1;
                                            switch ($dem1) {
                                                case '1':
                                                    $thutu = "A.";
                                                    break;
                                                 case '2':
                                                    $thutu = "B.";
                                                    break;
                                                case '3':
                                                    $thutu = "C.";
                                                    break;
                                           

                                            }
                                           

                                    ?>    
   							<input type="radio" name="part2[<?php echo $index ?>]"
                                     value="0" hidden checked = 'checked'/>
                                       
           <label >                         
		<input style="margin-left:75px" type="radio" name="part2[<?php echo $index ?>]" value="<?php echo $tl['id'] ?>">
		<?php echo $thutu ;?></label>
	<?php 
		}
	?>                     
            <?php } else {  // end if user = -1 ?>  
                                  <h2 class="post-author">   <?php echo $q["content"]?></h2>
                                    
              <?php                 
                                    $dem1 = 0  ;
                                    
                                     foreach ($q['traloi'] as $tl)
                                        { 

                                            $dem1 += 1;
                                            switch ($dem1) {
                                                case '1':
                                                    $thutu = "A. ";
                                                    break;
                                                 case '2':
                                                    $thutu = "B. ";
                                                    break;
                                                case '3':
                                                    $thutu = "C. ";
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
                                  <input  type="radio" name="part2[<?php echo $index ?>]"
                                     value="0" hidden checked = 'checked'/>
                                       
                                

                                <label <?php echo $class; ?>><input disabled  type="radio" name="part2[<?php echo $index?>]" value="<?php echo $tl['id'] ?>" checked="<?php echo $checked ?>">

                                      <?php  echo $thutu ; echo $tl['content']?></label></br>
                                 <?php } else{ ?>
                                <?php  
                                            if($correct_answer==1)
                                            {
                                                $class= 'style="color:#00aeef"';
                                            }
                                     ?>
                                     <label <?php echo $class; ?>><input disabled  type="radio" name="part2[<?php echo $index?>]" value="<?php echo $tl['id'] ?>" >
                                    <?php  echo $thutu ; echo $tl['content']?> </label></br>
                                        <?php } ?>
                                <?php } // end foreach traloi?>


                                   <?php }?>                 
                                </div>
                            </div>
                          
                        </div>
                        <?php }?>  
                     
                        <p class="clear-fix col-md-12 col-sm-12" align="center">
                  <input  type="submit" name="submit" value="Xem đáp án" class="btn btn-sm btn-primary" <?php echo isset($submit)?'disabled':"" ?>>

                  <a class="btn btn-sm btn-primary" href="<?php echo base_url() ?>practice/chitiet/<?php echo $id_group ?>" >Làm tiếp</a>
                </p>
                            
                          </form>
                    
  
