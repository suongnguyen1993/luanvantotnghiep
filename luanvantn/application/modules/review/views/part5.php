<?php if(isset($error) && $error==1){ ?>
  <div class="alert alert-warning alert-dismissible fade in" role="alert"> <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button> <strong class='thong_bao'>Bạn hãy làm bài kiểm tra đầu vào! Để hệ thống gợi ý câu hỏi phù hợp với bạn. </strong> 
  </div>
  <?php }?>
<form action="" method="post" accept-charset="utf-8">
	
	<?php
	$dem1 = 1;
	
	foreach($part5 as  $index => $hoi)
	{
		$userchoice= -1;
		if(isset ($hoi['user_choice']))
		{
			$userchoice = $hoi['user_choice'];
		}
		
		?>
		<div class="col-md-6  col-sm-12   blog-padding-right" style="height:370px">
			<div class="single-blog two-column">
				<div class="post-content overflow">
					<h2 class="post-title bold">
						<label style="font-size:20px">
							<?php 
							echo $dem1++.'.';
							?>
						</label>
						
						<?php echo $hoi['content'];?></h2>
					</br>
					
					<?php
					if ($userchoice == -1)
					{
						$diem1 = 0;
						
						foreach($hoi['traloi'] as $tl)
						{
							$diem1 += 1;
							
							switch($diem1){
								case '1':
								$thutu = "A. ";
								break;
								case '2':
								$thutu = "B. ";
								break;
								case '3':
								$thutu = "C. ";
								break;
								case '4':
								$thutu = "D. ";
								break;
								
							}
							
							
							
							
							?>
							<input type="radio" name="part5[<?php echo $index ?>]"
							value="0" hidden checked = 'checked'/>
							<label> <h3 class="post-author"><input type="radio" name="part5[<?php echo $index ?>]" value="<?php echo $tl['id'] ?>"/> 
								<?php echo $thutu; echo $tl['content'];?></h3></label></br>
								
								<?php
							}
							?>
							<?php } else {  // end if user = -1 ?>  
								<?php 
								$diem1 = 0;
								
								foreach($hoi['traloi'] as $tl)
								{
									$diem1 += 1;
									
									switch($diem1){
										case '1':
										$thutu = "A. ";
										break;
										case '2':
										$thutu = "B. ";
										break;
										case '3':
										$thutu = "C. ";
										break;
										case '4':
										$thutu = "D. ";
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
										<input  type="radio" name="part5[<?php echo $index ?>]"
										value="0" hidden checked = 'checked'/>
										
										

										<label> <h3 class="post-author" <?php echo $class; ?>><input disabled  type="radio" name="part5[<?php echo $index?>]" value="<?php echo $tl['id'] ?>" checked="<?php echo $checked ?>">

											<?php  echo $thutu ; echo $tl['content']?></h3></label></br>
											<?php } else{ ?>
												<?php  
												if($correct_answer==1)
												{
													$class= 'style="color:#00aeef"';
												}
												?>
												<label> <h3 class="post-author" <?php echo $class; ?>><input disabled  type="radio" name="part5[<?php echo $index?>]" value="<?php echo $tl['id'] ?>" >
													<?php  echo $thutu ; echo $tl['content']?></h3> </label></br>
													<?php } ?>
													<?php } // end foreach traloi?>


													<?php }?>
													
													<hr />

												</div>
											</div>

										</div>
										<?php
									}
									?>
								</br>
								<<p class="clear-fix col-md-12 col-sm-12" align="center">
                  <input  type="submit" name="submit" value="Xem đáp án" class="btn btn-sm btn-primary" <?php echo isset($submit)?'disabled':"" ?>>

                  <a class="btn btn-sm btn-primary" href="<?php echo base_url() ?>practice/chitiet/<?php echo $current ?>" >Làm tiếp</a>
                </p>                      
                </form>
								
								
