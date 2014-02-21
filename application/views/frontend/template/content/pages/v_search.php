<div class="anime-blog-block search-block">
        <?php if (isset($pagination)): ?>
            <div class="all-anime-pagination"><?php echo $pagination; ?></div>
        <?php endif; ?>

        <?php if (count($serials) > 0): ?>
        <h2 class="anime-blog-title">Найдено</h2></h2>
        <div class="popular-anime-block">
            <?php foreach ($serials as $serial): ?>
                <div class="popular-anime-item" data-serial="<?php echo $serial->id; ?>">
                    <a href="<?php echo Route::url('view_serial_with_name', array('serial_id' => $serial->id,'serial_name' => strtolower(str_replace(" ", "_", $serial->title_orig)))); ?>">
                        <img src="<?php echo $serial->img; ?>" width="100" />
                        <span><?php echo $serial->title_rus; ?></span>
                    </a>
                </div>
            <?php endforeach; ?>
        </div>
        <?php else: ?>
            <h2>Упс, кажется по вашему запросу ничего не найдено!</h2>
        <?php endif; ?>
</div>