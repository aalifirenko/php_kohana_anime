<div class="relise-page">
    <?php if (Session::instance()->get_once('add_news') == '1'): ?>
        <div class="alert alert-success">
            Блог добавлен
        </div>
    <?php elseif (Session::instance()->get_once('add_news') == '0'): ?>
        <div class="alert alert-error">
            Ошибка добавления
        </div>
    <?php endif; ?>
    <h4>Добавить блог</h4>

    <form action="" method="POST" enctype="multipart/form-data">
        <div class="control-group">
            <div class="controls">
                <label for="serial_id">Сериал #ID:</label>
                <input type="text" name="serial_id" />
            </div>
        </div>
        <div class="control-group">
            <div class="controls">
                <label for="serial_id">Заголовок:</label>
                <input type="text" name="title" style="width: 600px;" />
            </div>
        </div>
        <div class="control-group">
            <div class="controls">
                <textarea id="news-page" name="text">
                </textarea>
            </div>
        </div>
        <div class="control-group">
            <div class="controls">
                <label for="additional_text">Ссылки для опенингов:</label>
                <textarea style="width: 700px" id="additional-text" name="additional_text"></textarea>
            </div>
        </div>
        <div class="control-group">
            <div class="controls">
                <input type="file" name="img" />
            </div>
        </div>
        <button class="btn" type="submit">Добавить</button>
    </form>

    <div class="news-list">
        <?php if (isset($blog_list)): ?>
            <?php echo $blog_list;  ?>
        <?php endif; ?>
    </div>
</div>