<div class="anime-blog-block">
    <?php if ($blogs): ?>
    <span class="anime-blog-title"><h2 style="color: #353737"><?php echo $title; ?></h2></span>
    <?php if (isset($pagination)): ?>
        <div class="all-anime-pagination"><?php echo $pagination; ?></div>
    <?php endif; ?>

    <?php foreach ($blogs as $blog): ?>
        <div class="blog-anime-block">
            <div class="blog-anime-box">
                <h3 class="blog-post-title">
                    <a href="<?php echo Route::url('blog_post', array('post_id' => $blog->id)); ?>"><?php echo $blog->title; ?></a>
                </h3>
                <div class="blog-anime-post-header">
                    <span class="blog-post-date"> Добавлено: <span style="color: #08c"><?php $blogDate = explode(" ", $blog->date); echo $blogDate[0]; ?></span></span>
                </div>
                <div class="blog-anime-post-content">
                    <span class="blog-anime-img" style="float:left; margin-right: 10px;">
                        <img width="200" alt="<?php echo $blog->title; ?>" src="<?php echo $blog->img; ?>" />
                    </span>
                    <div>
                        <?php echo UTF8::substr($blog->text, 0, 400); ?>...
                    </div>
                    <div style="clear: both;"></div>
                    <div style="float: right">
                        <span style=""><a href="<?php echo Route::url('blog_post', array('post_id' => $blog->id)); ?>" class="newbtn newbtn-primary">Читать</a></span>
                        <?php if ($is_allanime): ?>
                            <span style=""><a href="<?php echo Route::url('serial_blog', array('serial_id' => $blog->serial_id)); ?>" class="newbtn newbtn-warning">Блог сериала</a></span>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
    <?php endif; ?>
</div>