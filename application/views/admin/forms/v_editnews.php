<div class="relise-page">
    <?php if (Session::instance()->get_once('add_news') == '1'): ?>
        <div class="alert alert-success">
            Новость сохранена
        </div>
    <?php elseif (Session::instance()->get_once('add_news') == '0'): ?>
        <div class="alert alert-error">
            Ошибка добавления
        </div>
    <?php endif; ?>
    <h4>Добавить новость</h4>

    <form action="" method="POST" enctype="multipart/form-data">
        <div class="control-group">
            <div class="controls">
                <textarea id="news-page" name="news">
                    <?php echo $news->news; ?>
                </textarea>
            </div>
        </div>
        <div class="control-group">
            <div class="controls">
                <p>Текущая картинка:</p>
                <img src="<?php echo $news->img; ?>" width="200" />
            </div>
        </div>
        <div class="control-group">
            <div class="controls">
                <input type="file" name="img" />
            </div>
        </div>
        <button class="btn" type="submit">Сохранить</button>
    </form>

    <div class="news-list">
        <?php if (isset($news_list)): ?>
            <?php echo $news_list;  ?>
        <?php endif; ?>
    </div>
</div>