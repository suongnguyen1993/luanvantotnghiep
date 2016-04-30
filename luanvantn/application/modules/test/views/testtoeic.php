
    <section id="blog" class="padding-top">
        <div class="container">
            <div class="row">
                <div class="col-md-3 col-sm-5">
                    <div class="sidebar blog-sidebar">
                        
                        <div class="sidebar-item tag-cloud" >
                            <h3>Thời gian</h3>
                            <div id="clock"></div>
                        </div>
                        
                    </div>
                </div>    
             
                <div class="col-md-9 col-sm-7">
                    <div class="row">
                    <audio controls="">
                        <source src="uploads/test_audio/03.mp3">
                     </audio>
                         <div class="col-md-12 col-sm-12">
                            <form action="" method="post" accept-charset="utf-8">
                                <!-- part 1 -->
                                <?php $this->load->view('part1', $part1); ?>

                                <!-- part 2 -->
                                <?php $this->load->view('part2', $part2); ?>

                                <!-- part 3 -->
                                <?php $this->load->view('part3', $part3); ?>

                                <!-- part 4 -->
                                <?php $this->load->view('part4', $part4); ?>

                                <!-- part 5 -->
                                <?php $this->load->view('part5', $part5); ?>
                                
                                <!-- part 6 -->
                                <?php $this->load->view('part6', $part6); ?>

                                <!-- part 7 -->
                                <?php $this->load->view('part7', $part7); ?>
                            
                                <input type="submit" name="chamdiem" value="Chấm điểm" class="btn btn-sm btn-primary">
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
