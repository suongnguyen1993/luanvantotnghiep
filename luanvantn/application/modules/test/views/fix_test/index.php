

    <section id="projects" class="padding-top">
        <div class="container">
            <div class="row">
                <div class="col-md-3 col-sm-4">
                    <div class="sidebar portfolio-sidebar">
                        <div class="sidebar-item categories">
                            <h3>Bài Kiểm Tra</h3>
                            <ul class="nav navbar-stacked">
                                <li><a href="test/dauvao">Kiểm Tra Đầu Vào</a></li>
                                <li class='active'><a  href="test/fix_test">Real Test</a></li>
                                <li><a href="test/full_test">Full Test</a></li>
                                <li><a href="test/mini_test">MiniTest</a></li>
                                
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-md-9 col-sm-8">
                <?php if(isset($error) && $error==0){ ?>
                <div align='center' class="alert alert-warning alert-dismissible fade in" role="alert"> <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button> <strong class='thong_bao'>Bạn hãy đăng nhập để được dùng nhiều chức năng hơn! </strong> 
                </div>
                <?php }?>
               <?php if(isset($error) && $error==1 && $error != 0){ ?>
                <div align='center' class="alert alert-warning alert-dismissible fade in" role="alert"> <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button> <strong class='thong_bao'>Bạn hãy làm bài kiểm tra đầu vào! Để hệ thống gợi ý câu hỏi phù hợp với bạn. </strong> 
                </div>
                <?php }?>
                    <div class="row">
                     <?php foreach ($exam as $ex): $info = $ex['info']; $nam = $ex['time'] ?>
                        <div class="col-xs-12 col-sm-12 col-md-12 portfolio-item branded folio" style = 'margin: 25px;'>
                       
                            
                       
                               <img src="<?php echo base_url(); ?>/public/user/images/tamgiac.png" style="width: 40px; height: 40px">                        
                                 <a class="fixsize" href="test/fix_test/fix/<?php echo $ex['id'] ?>"><?php echo $info.','.'năm'.$nam ?></a> 
                        
                        </div>
                        <?php endforeach ?>
                </div>
            </div>
              <div class="portfolio-pagination">
                         
            <?php echo (isset($list_pagination))?$list_pagination:"" ?> 
            </div> 
        </div>
    </section>