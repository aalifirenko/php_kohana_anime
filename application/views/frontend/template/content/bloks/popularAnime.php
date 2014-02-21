<div class="popular-anime-block">
    <?php foreach ($serials as $serial): ?>
        <div class="popular-anime-item" data-serial="<?php echo $serial['id']; ?>">
            <a href="<?php echo Route::url('view_serial_with_name', array('serial_id' => $serial['id'],'serial_name' => strtolower(str_replace(" ", "_", $serial['title_orig'])))); ?>">
                <img src="<?php echo $serial['img']; ?>" alt="новые серии <?php echo $serial['title_rus']; ?>" width="100" />
                <span><?php echo $serial['title_rus']; ?></span>
            </a>
        </div>
    <?php endforeach; ?>
</div>