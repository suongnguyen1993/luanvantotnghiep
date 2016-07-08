<?php if(isset($error) && $error==1){ ?>
<div class="alert alert-warning alert-dismissible fade in" role="alert"> <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button> <strong>Bạn hãy làm bài thi thử!</strong> Để hệ thống gợi ý câu hỏi phù hợp với bạn. 
</div>
<?php }?>
<form action="" method="post" accept-charset="utf-8">
    <div class="col-sm-12 blog-padding-right" >
        <?php
        
        $dem1 = 0; 
        
        foreach ($part3 as $pIndex => $hoi)
        {
         ?>
         <div class="post-content overflow">
            <label style="font-size:20px">
             <?php 
             if(isset($dem1))
                echo 'Questions ' .($dem1+1).' - ' .($dem1+3);
            
            ?>

        </label>
    </div>
    <?php
    if( ($hoi['long_audio'])!="")
    {
        
        $b =($hoi['long_audio']);
        
        echo "
        <audio style='width:388.75px' controls> <source src='uploads/audio_files/$b '> </audio>";
    }
    
    
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

           $dem1 += 1;

           ?>
           
           
           <div class="post-content overflow">
            
               <h2 class="post-title bold">
                   
                   <?php echo ($dem1).'.';echo $ques['content'];?></h2>
                   
                   
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
                    <input type="radio" name="part3[<?php echo $pIndex; ?>][<?php echo $index; ?>]"
                    value="0" hidden checked = 'checked'/>

                    
                    <label >                         
                        
                       <input style="margin-left:25px"  type="radio" value="<?php echo $tl['id'] ?>" name="part3[<?php echo $pIndex; ?>][<?php echo $index; ?>]"/> 
                       <?php echo $thutu; echo $tl['content'];?></label></br>
                       
                       <?php } /*CLOSE foreach choice*/ ?> 
                   </div>
                   <!-- </div> -->
                   <?php  }   else {   $dem1 += 1;
                       
                       ?>
                       <!--   <div class="col-md-6  col-sm-12   blog-padding-right" style="height:1200px"> -->
                       
                       <div class="post-content overflow">
                        
                        
                           <?php if($index == 0) 
                           { 
                              ?>
                              <label>
                               <h2 style="border:double;border-color:#00aeef;  margin-bottom:10px; padding:20px 20px 20px 20px; " >
                                  <?php
                                  echo ($hoi['long_content']); ?>
                              </h2>
                          </label>
                          <?php } ?>
                          
                          
                          <h2 class="post-title bold">
                           <?php echo ($dem1).'.';echo $ques['content'];?></h2>
                           
                           
                           <?php        
                           
                           $diem1 = 0  ;
                           
                           foreach($ques['traloi'] as $tl)
                           { 

                            $diem1 += 1;
                            switch ($diem1) {
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
                                <input  type="radio" name="part3[<?php echo $pIndex; ?>][<?php echo $index; ?>]"
                                value="0" hidden checked = 'checked'/>
                                
                                

                                <label <?php echo $class; ?>><input disabled  type="radio" name="part3[<?php echo $pIndex; ?>][<?php echo $index; ?>]" value="<?php echo $tl['id'] ?>" checked="<?php echo $checked ?>">

                                  <?php  echo $thutu ; echo $tl['content']?></label></br>
                                  <?php } else{ ?>
                                    <?php  
                                    if($correct_answer==1)
                                    {
                                        $class= 'style="color:#00aeef"';
                                    }
                                    ?>
                                    <label <?php echo $class; ?>><input disabled  type="radio" name="part3[<?php echo $pIndex; ?>][<?php echo $index; ?>]" value="<?php echo $tl['id'] ?>" >
                                        <?php  echo $thutu ; echo $tl['content']?> </label></br>
                                        <?php } ?>
                                        <?php } // end foreach traloi?>

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
                        <p class="clear-fix col-md-12 col-sm-12" align="center">
                          <input  type="submit" name="submit" value="Hoàn thành" class="btn btn-sm btn-primary" <?php echo isset($submit)?'disabled':"" ?>>

                          <a href="/practice/chitiet/<?php echo $current ?>" ><button class="btn btn-sm btn-primary" >Làm tiếp</button></a>
                      </p>
                  </form>