<div class="newanimepage-block">
    <?php if (isset($model)): ?>
       <div class="newanimepage-head">
            <h4 class="newanimepage-title" style="float: left">Новые серии на Anime Nice</h4>
        </div>
           <?php $isFirst = true; ?>
        <?php foreach ($model as $anime): ?>
            <div class="newanimepage-block-item">
                <a href="<?php echo Route::url('view_serial_with_name', array('serial_id' => $anime['serial_id'],'season_id' => $anime['season_id'],'serial_name' => strtolower(str_replace(" ", "_", $anime['title_orig'])))); ?>">
                    <img alt="<?php echo $anime['title_rus']; ?>" title="<?php echo $anime['title_rus']; ?>" src="<?php echo $anime['img']; ?>" width="205" />
                    <span class="newanimepage-item-animename">
                        <?php echo $anime['title_rus']; ?>. <?php echo $anime['title']; ?> Серия <?php echo $anime['num']; ?>
                    </span>
                    <span style="display: none"><?php echo $anime['title_orig']; ?></span>
                </a>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>
</div>