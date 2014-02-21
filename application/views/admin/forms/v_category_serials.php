<div class="category serials">
    <?php if (Session::instance()->get_once('add_category') == '1'): ?>
        <div class="alert alert-success">
            Категория сериала обновлена
        </div>
    <?php elseif (Session::instance()->get_once('add_category') == '0'): ?>
        <div class="alert alert-error">
            Ошибка добавления
        </div>
    <?php endif; ?>
    <p><h4>Выберите сериал</h4></p>
    <form action="" method="POST">
    <select id="serial-select" name="serial_id">
        <?php foreach ($serials as $serial): ?>
            <option value="<?php echo $serial->id; ?>"><?php echo $serial->title_rus; ?></option>
        <?php endforeach; ?>
    </select>
    <button type="button" id="select_category_serial">Выбрать</button>

    <div class="category-serial-options">

    </div>

        <input type="submit" name="send" value="Сохранить">
    </form>
</div>