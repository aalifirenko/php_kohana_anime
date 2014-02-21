<div class="add-new-serial">
    <?php if (Session::instance()->get_once('add_serial') == '1'): ?>
        <div class="alert alert-success">
            Сериал сохранен
        </div>
    <?php elseif (Session::instance()->get_once('add_serial') == '0'): ?>
        <div class="alert alert-error">
            Ошибка добавления
        </div>
    <?php endif; ?>
    <?php if (isset($serial)): ?>
    <h4 class="add-new-serial-title">Редактировать сериал</h4>
    <p><div class="alert alert-block" style="margin-bottom: 20px;">Внимательнее с релизером, это поле нужно всегда указывать!</div></p>
    <form class="form-horizontal" method="POST" action="" enctype="multipart/form-data">
        <div class="control-group">
            <label class="control-label" for="title_rus">Название(рус)</label>
            <div class="controls">
                <input type="text" value="<?php echo $serial->title_rus; ?>" name="title_rus" id="inputEmail" placeholder="название">
            </div>
        </div>
        <div class="control-group">
            <label class="control-label" for="title_orig">Название(ориг)</label>
            <div class="controls">
                <input type="text" value="<?php echo $serial->title_orig; ?>" name="title_orig" id="inputEmail" placeholder="название">
            </div>
        </div>
        <div class="control-group">
            <label class="control-label" for="genre">Жанр</label>
            <div class="controls">
                <input type="text" value="<?php echo $serial->genre; ?>" name="genre" id="inputEmail" placeholder="жанр">
            </div>
        </div>
        <div class="control-group">
            <label class="control-label" for="producer">Режиссер</label>
            <div class="controls">
                <input type="text" name="producer" value="<?php echo $serial->producer; ?>" id="inputEmail" placeholder="режиссер">
            </div>
        </div>
        <div class="control-group">
            <label class="control-label" for="author">Автор оригинала</label>
            <div class="controls">
                <input type="text" value="<?php echo $serial->author; ?>" name="author" id="inputEmail" placeholder="автор">
            </div>
        </div>
        <div class="control-group">
            <label class="control-label" for="author">Озвучил</label>
            <select name="relizer">
                <?php foreach ($relizers as $relizer): ?>
                    <option value="<?php echo $relizer->title; ?>"><?php echo $relizer->title; ?></option>
                <?php endforeach; ?>
            </select>
            <div class="controls">

            </div>
        </div>
        <div class="control-group">
            <label class="control-label" for="author">Описание</label>
            <div class="controls">
                <textarea style="width: 500px; min-height: 300px;" name="description"><?php echo $serial->description; ?></textarea>
            </div>
        </div>
        <div class="control-group">
            <label class="control-label" for="author">Картинка</label>
            <div class="controls">
                <input type="file" name="img" />
            </div>
            <p>Текущая:</p><img src="<?php echo $serial->img; ?>" />
        </div>
        <div class="control-group">
            <div class="controls">
                <button type="submit" class="btn">Сохранить</button>
            </div>
        </div>
    </form>
    <?php endif; ?>
</div>