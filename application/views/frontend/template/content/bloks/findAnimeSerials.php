<div class="find-anime-block">
    <?php foreach ($serials as $serial): ?>
        <div class="popular-anime-item" data-serial="<?php echo $serial['id']; ?>">
            <a href="<?php echo Route::url('view_serial_with_name', array('serial_id' => $serial['id'],'serial_name' => strtolower(str_replace(" ", "_", $serial['title_orig'])))); ?>">
                <img src="<?php echo $serial['img']; ?>" width="100" />
                <span><?php echo $serial['title_rus']; ?></span>
            </a>
        </div>
    <?php endforeach; ?>
</div>
<?php if (count($serials) > 8): ?>
    <button type="button" class="btn" id="find_panel_show_all">Показать все</button>
<?php endif; ?>