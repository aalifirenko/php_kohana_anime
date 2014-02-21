<div class="anime-box">
    <?php if ($serials): ?>
        <?php if (isset($filter_genre)): ?>
            <?php echo $filter_genre; ?>
        <?php endif; ?>
        <div class="anime-box-content">
            <?php if (count($serials) == 0): ?>
                <span class="anime-box-not-found">К сожалению по вашему запросу ничего не найдено</span>
                <p class="anime-box-not-found"><a href="<?php echo URL::base(true) ?>all-anime">Назад</a> </p>
            <?php endif; ?>
        <?php if (isset($title)): ?><h4 style="margin-left: 10px" class="color-black"><?php echo $title . " (" . count($serials) . ")" ; ?></h4><?php endif; ?>
        <?php if (isset($pagination)): ?>
            <div class="all-anime-pagination"><?php echo $pagination; ?></div>
        <?php endif; ?>
        <?php foreach ($serials as $serial): ?>
            <div class="anime-block">
                <span class="anime-block-title color-black"><h5 style="float: left;min-width: 500px;"><?php echo $serial['title_rus'] . " (" . $serial['title_orig'] . ")" ?></h5>
                <span style="float: right; font-family: PT Sans;margin-top: 10px;font-weight: bold"><?php if (isset($is_rating)): ?> Рейтинг: <?php echo round($serial['sum']/$serial['count'], 2); ?><?php endif;?></span>
                </span>
                <div class="anime-image">
                    <img width="200" src="<?php echo $serial['img']; ?>" />
                </div>
                <div class="anime-desc">
                    <?php echo $serial['description']; ?>
                </div>
                <div class="anime-bottom">
                    <div style="float: left">
                        <span class="relizer-option">Озвучил: <?php echo $serial['relizer']; ?></span>
                    </div>
                    <div style="float: right">
                    <span><a href="<?php echo Route::url('view_serial_with_name', array('serial_id' => $serial['id'],'serial_name' => strtolower(str_replace(" ", "_", $serial['title_orig'])))); ?>" class="newbtn newbtn-primary">Смотреть</a></span>
                    <span style=""><a href="<?php echo Route::url('serial_blog', array('serial_id' => $serial['id'])); ?>" class="newbtn newbtn-warning">Блог сериала</a></span>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
        <?php if (isset($pagination)): ?>
            <div class="all-anime-pagination"><?php echo $pagination; ?></div>
        <?php endif; ?>
        </div>
    <?php endif; ?>
</div>