
    <section id="blog" class="padding-top">
        <div class="container">
            <div class="row">
                <div class="col-md-3 col-sm-5">
                    <div class="sidebar blog-sidebar">
                        
                        <div class="sidebar-item tag-cloud" id="fix-clock" >
                            
                        </div>
                        
                    </div>
                </div>    
                <div class="col-md-9 col-sm-7">
                    <div class="row">

                    <?php foreach ($exam  as $ex ): ?>
                    
                      <a href="test/fix_test/fix/<?php echo $ex["id"]?>">
                        <h2>
                          <?php
                          $name = $ex['name'];
                          $info = $ex['info'];
                          $time = $ex['time'];
                          echo "$name , $info, năm $time"; 
                           ?>
                          
                        </h2>
                      <a>

                    <?php endforeach ?>    
                    </div>
                    
                 </div>
                
                    
                 </div>
            </div>
        </div>
    </section>
    <!--/#blog-->



<script type="text/javascript">
    var __submit = <?php echo isset($submit)?1:0; ?>
</script>




<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h3 class="modal-title" align="center" id="myModalLabel">Hoàn Thành Bài Kiểm Tra</h3>
      </div>
      <div class="modal-body">
        <div class="diem">
            <?php echo isset($tongdiem)?'<span class = "mau">Bạn đạt được số điểm:</span>'.$tongdiem:"0"; ?>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-dismiss="modal">Hoàn tất</button>
      </div>
    </div>
  </div>
</div>