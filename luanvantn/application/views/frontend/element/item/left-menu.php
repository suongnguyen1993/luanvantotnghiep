<div class="sidebar-item categories">
                            <h3><?php echo isset($title)?$title:"" ?></h3>
                            <ul class="nav navbar-stacked">
                                 <?php 

                                 foreach ($group as $g)

							{
							     if(isset ($title) && $title == 'Practice')
                                 {
							?>
                            
                                <li <?php echo (isset ($current)&& $current == $g['id'])? 'class="active"':NULL; ?> ><a href="practice/chitiet/<?php echo $g['id'] ?>"><?php echo $g['name']?></a></li>
                                <?php } else {?>
                                <li <?php echo (isset ($current2)&& $current2 == $g['id'])? 'class="active"':NULL; ?> ><a href="learn/chitiet/<?php echo $g['id'] ?>"><?php echo $g['name']?></a></li>
                                 <?php }?>
                               <?php }?>
                            </ul>
                        </div>