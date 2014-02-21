<div class="rating-left-block">
    <span class="rating-title">Рейтинг</span>
    <?php foreach ($serials as $serial): ?>
        <span class="rating-item-box">
            <span class="rating-item-animename"><a href="<?php echo Route::url('view_serial_with_name', array('serial_id' => $serial['id'],'serial_name' => strtolower(str_replace(" ", "_", $serial['title_orig'])))); ?>"><?php echo $serial['title_rus']; ?></a></span>
            <span class="rating-item-value"><?php echo number_format(round($serial['sum']/$serial['count'], 1), 1); ?></span>
        </span>
    <?php endforeach; ?>
</div>