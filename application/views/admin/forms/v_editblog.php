<div class="relise-page">
    <?php if (Session::instance()->get_once('add_news') == '1'): ?>
        <div class="alert alert-success">
            Блог сохранен
        </div>
    <?php elseif (Session::instance()->get_once('add_news') == '0'): ?>
        <div class="alert alert-error">
            Ошибка добавления
        </div>
    <?php endif; ?>
    <?php if (isset($model)): ?>
    <h4>Редактировать блог</h4>

    <form action="" method="POST" enctype="multipart/form-data">
        <div class="control-group">
            <div class="controls">
                <label for="serial_id">Сериал #ID:</label>
                <input type="text" name="serial_id" value="<?php echo $model->serial_id; ?>" />
            </div>
        </div>
        <div class="control-group">
            <div class="controls">
                <label for="serial_id">Заголовок:</label>
                <input type="text" name="title" style="width: 600px;" value="<?php echo $model->title; ?>" />
            </div>
        </div>
        <div class="control-group">
            <div class="controls">
                <textarea id="news-page" name="text"><?php echo $model->text; ?>
                </textarea>
            </div>
        </div>
        <div class="control-group">
            <div class="controls">
                <label for="additional_text">Ссылки для опенингов:</label>
                <textarea style="width: 700px; min-height: 300px;" id="additional-text" name="additional_text"><?php echo $model->additional_text; ?></textarea>
            </div>
        </div>
        <div class="control-group">
            <div class="controls">
                <p>
                    Текущая <br/>
                    <img src="<?php echo $model->img; ?>" width="200" />
                </p>
                <input type="file" name="img" />
            </div>
        </div>
        <button class="btn" type="submit">Сохранить</button>
    </form>

    <div class="news-list">
        <?php if (isset($blog_list)): ?>
            <?php echo $blog_list;  ?>
        <?php endif; ?>
    </div>
</div>
<?php endif; ?>