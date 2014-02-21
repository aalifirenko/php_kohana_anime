<div class="top-left-block">
    <span class="rating-title">Горячая 10-ка</span>
    <?php foreach ($serials as $serial): ?>
        <span class="rating-item-box">
            <span class="hot-ten-item-animename"><a href="<?php echo Route::url('view_serial_with_name', array('serial_id' => $serial['id'],'serial_name' => strtolower(str_replace(" ", "_", $serial['title_orig'])))); ?>"><?php echo $serial['title_rus']; ?></a></span>
        </span>
    <?php endforeach; ?>
</div>