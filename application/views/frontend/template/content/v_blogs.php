<div class="homepage-content">

    <div class="home-block">
        <div class="home-block-left span8">
            <div class="popular-anime span8">
                <?php if ($blogs) echo $blogs; ?>
            </div>
        </div>

        <div class="home-block-right span3">
            <?php if (isset($rating)) echo $rating; ?>

            <div class="banner">
                <img src="/media/image/banner.gif" />
            </div>
        </div>
    </div>

</div>