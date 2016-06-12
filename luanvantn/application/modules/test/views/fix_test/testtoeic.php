
    <section id="blog" class="padding-top">
        <div class="container">
            <div class="row">
                <div class="col-md-3 col-sm-5">
                    <div class="sidebar blog-sidebar">
                        
                        <div class="sidebar-item tag-cloud" id="fix-clock" >
                            <h3>Thời gian</h3>
                            <div id="clock"></div>
                        </div>
                        
                    </div>
                </div>    
             
                <div class="col-md-9 col-sm-7">
                    <div class="row">
                    <audio id="audio_exam">
                        <source src="uploads/test_audio/<?php echo isset($audio_exam)?$audio_exam:"" ?>">
                     </audio>
                         <div class="col-md-12 col-sm-12">
                            <form id="form-fulltest" action="" method="post" accept-charset="utf-8">
                                <!-- part 1 -->
                                <?php $this->load->view('full_test/part1', $part1); ?>

                                <!-- part 2 -->
                                <?php $this->load->view('full_test/part2', $part2); ?>

                                <!-- part 3 -->
                                <?php $this->load->view('full_test/part3', $part3); ?>

                                <!-- part 4 -->
                                <?php $this->load->view('full_test/part4', $part4); ?>

                                <!-- part 5 -->
                                <?php $this->load->view('full_test/part5', $part5); ?>
                                
                                <!-- part 6 -->
                                <?php $this->load->view('full_test/part6', $part6); ?>

                                <!-- part 7 -->
                                <?php $this->load->view('full_test/part7', $part7); ?>
                            
                                <input type="submit" name="chamdiem" value="Chấm điểm" class="btn btn-sm btn-primary">
    
                                </form>
                            </div>
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



<div class="modal fade" id="ready" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h2 class="modal-title" align="center" id="myModalLabel">Bạn đã sẵn sàng chưa?</h2>
      </div>
      <div class="modal-footer" style="text-align: center">
        <button id="turnbackBtn" type="button" class="btn btn-primary" data-dismiss="modal">Quay lại</button>
        <button id="okBtn" type="button" class="btn btn-primary" data-dismiss="modal">Sẵn sàng</button>
      </div>
    </div>
  </div>
</div>