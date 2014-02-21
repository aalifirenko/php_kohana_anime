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
    <div class="serial-comment">
        <div id="mc-container"></div>
        <script type="text/javascript">
            var mcSite = '26172';
            (function() {
                var mc = document.createElement('script');
                mc.type = 'text/javascript';
                mc.async = true;
                mc.src = '//cackle.me/mc.widget-min.js';
                (document.getElementsByTagName('head')[0] || document.getElementsByTagName('body')[0]).appendChild(mc);
            })();
        </script>
        <a id="mc-link" href="http://cackle.me">Социальные комментарии <b style="color:#4FA3DA">Cackl</b><b style="color:#F65077">e</b></a>
    </div>
</div>