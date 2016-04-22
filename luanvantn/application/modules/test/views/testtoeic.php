
    <section id="blog" class="padding-top">
        <div class="container">
            <div class="row">
                <div class="col-md-3 col-sm-5">
                    <div class="sidebar blog-sidebar">
                        
                        <div class="sidebar-item tag-cloud">
                            <h3>Tag Cloud</h3>
                            <ul class="nav nav-pills">
                                <li><a href="#">Corporate</a></li>
                                <li><a href="#">Joomla</a></li>
                                <li><a href="#">Abstract</a></li>
                                <li><a href="#">Creative</a></li>
                                <li><a href="#">Business</a></li>
                                <li><a href="#">Product</a></li>
                            </ul>
                        </div>
                        
                    </div>
                </div>
                <div class="col-md-9 col-sm-7">
                    <div class="row">
                         <div class="col-md-12 col-sm-12">
                         <!-- part 1 -->
                            <div class="single-blog two-column">
                            <h1 align="center"><b> part 1</b></h1>
                            <?php
                                $dem = 0;

                             foreach($part1 as $p1)
                                { $dem += 1;
                                    echo"<b>$dem.</b>";
                            ?>
                                <div class="post-thumb">
                                    <img src="uploads/listen_photo/<?php echo $p1['image'] ?>" class="img-responsive" alt="" style = " height: 500px; width: 500px">
                                    
                                </div>
                                <div class="post-content overflow">
                                    <form action="" method="post" accept-charset="utf-8">
                                    <?php
                                        $dem1 = 0  ;
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
                                        
                                    <input type="radio" name="<?php echo $p1['id'] ?>"
                                     value="0" hidden checked = 'checked'>
                                    <label
                                     <?php
                                      if($correct_answer1 == 1 )
                                        {

                                        
                                        } ?>>
                                    
                                    <?php echo $thutu; ?>
                                    <input type="radio" name="<?php echo $p1['id'] ?>"
                                     value="<?php echo $correct_answer1 ?>">
                                     <?php  echo $choice1['content'] ?>
                                    </label>
                                    <br>
                                    
                                    <?php } ?>                               
                                </div>
                            <?php } ?>
                            <!-- end part 1 -->

                            <!-- part 2 -->
    
                            <div class="single-blog two-column">
                            <h1 align="center"><b> part 2</b></h1>
                            <?php

                             foreach($part2 as $p2)
                                { $dem += 1;
                                    echo"<b>$dem.</b>";
                            ?>                               
                                <h4><b>Mark your answer on your answer sheet</b></h4>
                                    <form action="" method="post" accept-charset="utf-8">
                                    <?php
                                        $dem2 = 0  ;
                                     foreach ($p2['choice'] as $choice2)
                                        { 
                                            $dem2 += 1;
                                            switch ($dem2) {
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
                                            $correct_answer2 = $choice2["correct_answer"];

                                    ?>
                                        
                                    <input type="radio" name="<?php echo $p2['id'] ?>"
                                     value="0" hidden checked = 'checked'>
                                    <label
                                     <?php
                                      if($correct_answer2 == 1 )
                                        {

                                        
                                        } ?>>
                                    
                                    <?php echo $thutu; ?>
                                    <input type="radio" name="<?php echo $p2['id'] ?>"
                                     value="<?php echo $correct_answer2 ?>">
                                     <?php  echo $choice2['content'] ?>
                                    </label>
                                    <br>
                                    
                                    <?php } ?> 
                                
                            <?php } ?>
                            <!-- end part 2 -->

                            <!-- part 3 -->
                            <div class="single-blog two-column">
                            <h1 align="center"><b> part 3</b></h1>
                            <?php
                               
                            foreach ($part3 as $long_question3)
                             {
                               
                             foreach($long_question3["question"] as $p3)
                                { $dem += 1;
                                    echo"<b>$dem.</b>";
                            ?>
                                <h4><b><?php echo $p3['content']."<br>" ?></b></h4>

                                
                                    <form action="" method="post" accept-charset="utf-8">
                                    <?php
                                        $dem3 = 0  ;
                                     foreach ($p3['choice'] as $choice3)
                                        { 
                                            $dem3 += 1;
                                            switch ($dem3) {
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
                                            $correct_answer3 = $choice3["correct_answer"];

                                    ?>
                                        
                                    <input type="radio" name="<?php echo $p3['id'] ?>"
                                     value="0" hidden checked = 'checked'>
                                    <label
                                     <?php
                                      if($correct_answer3 == 1 )
                                        {

                                        
                                        } ?>>
                                    
                                    <?php echo $thutu; ?>
                                    <input type="radio" name="<?php echo $p3['id'] ?>"
                                     value="<?php echo $correct_answer3 ?>">
                                     <?php  echo $choice3['content'] ?>
                                    </label>
                                    <br>
                                    
                                    <?php } ?> 
                            <?php } ?>
                            <?php } ?>
                            <!-- end part 3 -->
                            <!-- part 4 -->
                            <div class="single-blog two-column">
                            <h1 align="center"><b> part 4</b></h1>
                            <?php
                     
                            foreach ($part4 as $long_question4)
                             {
                               
                             foreach($long_question4["question"] as $p4)
                                { $dem += 1;
                                    echo"<b>$dem.</b>";
                            ?>
                                <h4><b><?php echo $p4['content']."<br>" ?></b></h4>

                                
                                    <form action="" method="post" accept-charset="utf-8">
                                    <?php
                                        $dem4 = 0  ;
                                     foreach ($p4['choice'] as $choice4)
                                        { 
                                            $dem4 += 1;
                                            switch ($dem4) {
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
                                            $correct_answer4 = $choice4["correct_answer"];

                                    ?>
                                        
                                    <input type="radio" name="<?php echo $p4['id'] ?>"
                                     value="0" hidden checked = 'checked'>
                                    <label
                                     <?php
                                      if($correct_answer4 == 1 )
                                        {

                                        
                                        } ?>>
                                    
                                    <?php echo $thutu; ?>
                                    <input type="radio" name="<?php echo $p4['id'] ?>"
                                     value="<?php echo $correct_answer4 ?>">
                                     <?php  echo $choice4['content'] ?>
                                    </label>
                                    <br>
                                    
                                    <?php } ?> 
                            <?php } ?>
                            <?php } ?>
                            <!-- end part 4 -->
                            <!-- part 5 -->
    
                            <div class="single-blog two-column">
                            <h1 align="center"><b> part 5</b></h1>
                            <?php

                             foreach($part5 as $p5)
                                { $dem += 1;
                                    echo"<b>$dem.</b>";
                            ?>
                                <h4><b><?php echo $p5['content'] ?></b></h4>
                                    <form action="" method="post" accept-charset="utf-8">
                                    <?php
                                        $dem5 = 0  ;
                                     foreach ($p5['choice'] as $choice5)
                                        { 
                                            $dem5 += 1;
                                            switch ($dem5) {
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
                                            $correct_answer5 = $choice5["correct_answer"];

                                    ?>
                                        
                                    <input type="radio" name="<?php echo $p5['id'] ?>"
                                     value="0" hidden checked = 'checked'>
                                    <label
                                     <?php
                                      if($correct_answer5 == 1 )
                                        {

                                        
                                        } ?>>
                                    
                                    <?php echo $thutu; ?>
                                    <input type="radio" name="<?php echo $p5['id'] ?>"
                                     value="<?php echo $correct_answer5 ?>">
                                     <?php  echo $choice5['content'] ?>
                                    </label>
                                    <br>
                                    
                                    <?php } ?> 

                            <?php } ?>
                            <!-- end part 5 -->
                            <!-- part 6 -->
                            <div class="single-blog two-column">
                            <h1 align="center"><b> part 6</b></h1>
                            <?php
                     
                            foreach ($part6 as $long_question6)
                             {
                                                          
                            ?>
                               <h4 style = 'border:double; padding:10px'><b><?php echo $long_question6['long_content']."<br>" ?></b></h4>

                                <?php 
                                foreach($long_question6["question"] as $p6)
                                { 
                                    $dem += 1;
                                    echo"<b>$dem.</b><br>"; 
                                ?>             
                                    <form action="" method="post" accept-charset="utf-8">
                                    <?php
                                        $dem6 = 0  ;
                                     foreach ($p6['choice'] as $choice6)
                                        { 
                                            $dem6 += 1;
                                            switch ($dem6) {
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
                                            $correct_answer6 = $choice6["correct_answer"];

                                    ?>
                                        
                                    <input type="radio" name="<?php echo $p6['id'] ?>"
                                     value="0" hidden checked = 'checked'>
                                    <label
                                     <?php
                                      if($correct_answer6 == 1 )
                                        {

                                        
                                        } ?>
                                    >
                                    
                                    <?php echo $thutu; ?>
                                    <input type="radio" name="<?php echo $p6['id'] ?>"
                                     value="<?php echo $correct_answer6 ?>">
                                     <?php  echo $choice6['content'] ?>
                                    </label>
                                    <br>
                                    
                                    <?php } ?> 

                            <?php } ?>
                            <?php } ?>
                            <!-- end part 6 -->
                            <input type="submit" name="submit" value="Chấm điểm" class="btn btn-sm btn-primary">
                            <button type="button" class="btn btn-sm btn-primary">answer sheet</button>
    
                            </form>
                            </div>
                        </div>
                        
                    </div>
                    
                 </div>
            </div>
        </div>
    </section>
    <!--/#blog-->
