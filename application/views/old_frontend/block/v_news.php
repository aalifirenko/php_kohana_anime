<?php if (count($news) > 0): ?>
<div class="news-block">
<div id="slide-change-background" style="display: none"><img src="<?php echo URL::base(true); ?>media/image/news.png" /></div>
<div class="news-head">
    <h4 class="news-title">Аниме Новости</h4>
</div>
<div id="news" class="carousel slide">
        <div class="carousel-inner">
        <?php $isFirst = true; ?>
        <?php foreach ($news as $new): ?>
            <div class="item <?php if ($isFirst) { echo "active"; $isFirst = false; } ?>">
                <div class="news-content">
                    <?php echo $new->news; ?>
                </div>
                <div class="news-image">
                    <img alt="аниме новости" title="аниме новости" src="<?php echo $new->img; ?>" />
                </div>
            </div>
        <?php endforeach; ?>
        </div>

</div>
</div>
<?php endif; ?>