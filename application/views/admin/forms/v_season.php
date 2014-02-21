<div class="add-new-serial">
    <?php if (Session::instance()->get_once('add_season') == '1'): ?>
        <div class="alert alert-success">
            Сезон добавлен
        </div>
    <?php elseif (Session::instance()->get_once('add_season') == '0'): ?>
        <div class="alert alert-error">
            Ошибка добавления
        </div>
    <?php endif; ?>
    <form action="<?php echo Route::url('admin_panel', array('action' => 'addseason')); ?>" method="POST" class="form-horizontal">
        <div class="control-group">
            <label class="control-label" for="serial">Сериал</label>
            <div class="controls">
                <select name="serial">
                    <?php foreach ($serials as $serial): ?>
                        <option value="<?php echo $serial->id; ?>"><?php echo $serial->title_rus; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>
        <div class="control-group">
                <label class="control-label" for="author">Название сезона</label>
                <div class="controls">
                    <input type="text" name="title" id="inputEmail" value="Сезон ">
                </div>
         </div>
        <div class="control-group">
            <div class="controls">
                <button type="submit" class="btn">Добавить</button>
            </div>
        </div>
    </form>
    <div class="all-relizers">
        <p><h5 class="list_seasons_title">Показать сезоны</h5></p>
        <?php if (isset($list)) echo $list; ?>
    </div>
</div>