<div class="single-blog two-column">
                            <h1 align="center"><b> part 6</b></h1>
                            <?php $dem = 75;
                            
                            foreach ($part6 as $pIndex => $p2)
                            {
                               
                                 foreach($p2['question'] as $index => $p1)
                                { 
                            
                                    $dem += 1; 
                                    $userChoose = -1;
                                    if(isset($p1['user_choice']))
                                    {
                                        $userChoose=$p1['user_choice'];
                                    }
                            
                                    if($userChoose == -1) {?>

                                    <div class="post-content overflow">

                                    <?php if($index == 0) { ?>
                                    <section class="_long_content"><?php echo $p2['long_content']; ?></section>
                                    
                                    <?php } ?>
                                     <b><?php echo $dem.'.'; ?></b><br>
                                    <?php $dem1 = 0; 
                                    foreach ($p1['choice']  as $choice1)
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
                                                case '4':
                                                    $thutu = "D.";
                                                    break;

                                            }
                                            $correct_answer1 = $choice1["correct_answer"];
                                    ?>
                                     
                                    <input type="radio" name="part6[<?php echo $pIndex; ?>][<?php echo $index; ?>]"
                                            value="0" hidden checked = 'checked'>
                                        <label>
                                            <?php echo $thutu; ?>
                                            <input type="radio" name="part6[<?php echo $pIndex; ?>][<?php echo $index; ?>]" 
                                                value="<?php echo $choice1['id'] ?>">
                                                  <?php  echo $choice1['content'] ?>
                               
                                        </label>
                                    <br>
                                    
                                    <?php } /*CLOSE foreach choice*/ ?>                               
                                </div>

                                <?php } else { ?>

                                    <div class="post-content overflow">
                                    
                                    <?php if($index == 0) { ?>
                                    <section class="_long_content"><?php echo $p2['long_content']; ?></section>
                                    <?php } ?>
                                    
                                    <b><?php echo $dem.'.'  ?></b><br>
                                    <?php 
                                    
                                    $dem1 = 0; 
                                    foreach ($p1['choice'] as $choice1)
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
                                                case '4':
                                                    $thutu = "D.";
                                                    break;

                                            }
                                            $correct_answer1 = $choice1["correct_answer"];
                                    ?>
                                        <?php
                                        $class = '';
                                        if($userChoose == $choice1['id']){
                                            $checked = 'checked';
                                            if($correct_answer1 == 1)
                                            {
                                               $class = 'style="color: green"' ;
                                            }
                                            else
                                            {
                                                $class = 'style="color: red"' ;
                                            }         
                                             
                                        ?>

                                        <label <?php echo $class; ?>>
                                            <?php echo $thutu; ?>
                                            <input type="radio" disabled
                                                    <?php echo $checked; ?>
                                                    value="<?php echo $choice1['id'] ?>">
                                            <?php  echo $choice1['content'] ?>
                                        </label>

                                        <?php } else { 
                                                if($correct_answer1 == 1)
                                                {
                                                   $class = 'style="color: #00aeef"' ;
                                                }
                                        ?>
                                        <label <?php echo $class; ?>>
                                            <?php echo $thutu; ?>
                                            <input type="radio" disabled
                                                    value="<?php echo $choice1['id'] ?>">
                                                
                                            <?php  echo $choice1['content'] ?>
                                        </label>
                                        <?php } ?>
                                    <br>
                                    
                                    <?php } /*CLOSE foreach choice*/ ?>                               
                                </div>
                              <?php } ?>
                            <?php }/*end question*/ ?>
                            <hr>
                            <?php }/*end long_question*/ ?>
</div>
                            <!-- end part 3 -->