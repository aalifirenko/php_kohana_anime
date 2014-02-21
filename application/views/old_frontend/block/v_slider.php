<div id="new_anime" class="carousel slide">
    <?php if (isset($slides)): ?>
    <?php $isFirst = true; ?>
    <?php $num = 0; ?>
    <ol class="carousel-indicators">
        <?php foreach ($slides as $slide): ?>
        <li data-target="#new_anime" data-slide-to="<?php echo $num; ?>" <?php if ($isFirst == true) { echo 'class="active"'; $isFirst = false; } ?>></li>
        <?php $num++; ?>
        <?php endforeach; ?>
    </ol>
    <div class="carousel-inner">
            <?php $isFirst = true; ?>
            <?php foreach ($slides as $slide): ?>
                <div class="item <?php if ($isFirst) { echo "active"; $isFirst = false; } ?>">
                    <a href="<?php echo $slide->link; ?>"><img alt="<?php echo $slide->desc; ?>" title="<?php echo $slide->desc; ?>" src="<?php echo $slide->img; ?>" width="700" alt="<?php echo $slide->desc; ?>"></a>
                    <div class="carousel-caption">
                        <h4>Смотрите у нас: <?php echo $slide->desc; ?></h4>
                    </div>
                </div>
            <?php endforeach; ?>
    </div>
        <a class="carousel-control left" href="#new_anime" data-slide="prev">&lsaquo;</a>
        <a class="carousel-control right" href="#new_anime" data-slide="next">&rsaquo;</a>
<?php endif; ?>
</div>