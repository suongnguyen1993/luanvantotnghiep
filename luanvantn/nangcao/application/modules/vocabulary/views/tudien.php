

    <section id="blog" class="padding-top">
        <div class="container">
            <div class="row">

                <div class="col-md-8 col-md-offset-2 border-style">
                    <div class="row">
                    <?php foreach($vocabulary as $index => $voca) { ?>
                        <div class="wp-focus" id="wpFocus<?php echo $voca['id']; ?>">
                            <div class="col-md-5 col-sm-10 blog-padding-right ">
                                <div class="single-blog two-column">
                                    
                                    <div class="post-content overflow">
                                        <h3 class="post-title bold">
                                        <?php echo $voca['vocabulary'] ?>
                                        </h3>
                                        
                                        
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-5 col-sm-10 blog-padding-right">
                                <div class="single-blog two-column">
                                    
                                    <div class="post-content overflow">
                                        <h3 class="post-title bold">
                                        <?php echo $voca['voca_mean'] ?>
                                        </h3>
                                        
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-2 col-sm-1 blog-padding-right">
                                <div class="single-blog two-column">
                                    <div class="post-content overflow del-tool">
                                        <a href="javascript:void(0)" onclick="del(<?php echo $voca['id']; ?>)"> <i class="fa fa-trash"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php } ?>

                    </div>
                    <div class="portfolio-pagination">
                         
            <?php echo (isset($list_pagination))?$list_pagination:"" ?> 
            </div>               
            </div>
        </div>
    </section>
    <!--/#blog-->

  
