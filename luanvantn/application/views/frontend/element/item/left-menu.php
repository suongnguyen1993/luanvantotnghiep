<div class="sidebar-item categories">
<h3><?php echo isset($title)?$title:"" ?></h3>
<ul class="nav navbar-stacked">
     <?php foreach ($group as $g){?>

    <li <?php echo (isset ($current)&& $current == "practice".$g['id'])? 'class="active"':NULL; ?> >
        <a href="practice/chitiet/<?php echo $g['id'] ?>">
        <?php echo $g['name']?>
            
        </a>
    </li>
    <?php } ?>
</ul>
</div>