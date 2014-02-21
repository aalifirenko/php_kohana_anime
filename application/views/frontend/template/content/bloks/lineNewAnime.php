<div class="newanime-block">
    <?php if (isset($model)): ?>
    <div class="newanime-content">
        <?php foreach ($model as $anime): ?>
            <div class="newanime-block-item">
                <a href="<?php echo Route::url('view_serial_with_name', array('serial_id' => $anime['serial_id'],'season_id' => $anime['season_id'],'serial_name' => strtolower(str_replace(" ", "_", $anime['title_orig'])))); ?>">
                    <img alt="<?php echo $anime['title_rus']; ?>" title="<?php echo $anime['title_rus']; ?>" src="<?php echo $anime['img']; ?>" width="130" />
                    <span class="newanime-item-animename">
                        <?php echo $anime['title_rus']; ?>. <?php echo $anime['title']; ?> Серия <?php echo $anime['num']; ?>
                    </span>
                    <span style="display: none"><?php echo $anime['title_orig']; ?></span>
                </a>
            </div>
        <?php endforeach; ?>
        <?php endif; ?>
    </div>
</div>