<div class="serial-box">
    <span class="serial-box-title"><h4><?php echo $model->title; ?></h4></span>
    <span class="serial-box-seaon-title"><h4>AniNice :)</h4></span>

    <div style="margin-top: 20px">
        <div class="serial-preview">
            <img src="<?php echo $model->img ?>" width="220" />
        </div>
        <div class="serial-desc">
            <span class="serial-desc-text"><?php echo $model->text; ?></span>
            <?php if (isset($model->additional_text)): ?>
                <div><?php echo $model->additional_text; ?></div>
            <?php endif; ?>
        </div>
    </div>
</div>