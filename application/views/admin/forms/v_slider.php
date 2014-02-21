<div class="add-new-serial">
    <?php if (Session::instance()->get_once('add_slide') == '1'): ?>
        <div class="alert alert-success">
            Слайд добавлен
        </div>
    <?php elseif (Session::instance()->get_once('add_slide') == '0'): ?>
        <div class="alert alert-error">
            Ошибка добавления
        </div>
    <?php endif; ?>
    <h4>Менеджер слайдера</h4>
    <form action="<?php echo Route::url('admin_panel', array('action' => 'addslide')); ?>" method="POST" class="form-horizontal" enctype="multipart/form-data">
        <div class="control-group">
            <label class="control-label" for="title_orig">Картинка (700x420px)</label>
            <div class="controls">
                <input type="file" name="img" />
            </div>
        </div>
        <div class="control-group">
            <label class="control-label" for="title_orig">Ссылка</label>
            <div class="controls">
                <textarea name="link"></textarea>
            </div>
        </div>
        <div class="control-group">
            <label class="control-label" for="title_orig">Описание слайда</label>
            <div class="controls">
                <textarea name="desc"></textarea>
            </div>
        </div>
        <div class="control-group">
            <label class="control-label" for="title_orig">День недели:</label>
            <div class="controls">
                <select name="day">
                    <option value="Mon">Понедельник</option>
                    <option value="Tue">Вторник</option>
                    <option value="Wed">Среда</option>
                    <option value="Thu">Четверг</option>
                    <option value="Fri">Пятница</option>
                    <option value="Sat">Суббота</option>
                    <option value="Sun">Воскресенье</option>
                </select>
            </div>
        </div>
        <button class="btn" type="submit">Добавить</button>
    </form>
    <div class="all-relizers">
        <?php if (count($slides) > 0): ?>
            <table class="table table-striped">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Ссылка</th>
                    <th>Картинка</th>
                    <th>День</th>
                    <th>Удалить?</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($slides as $slide): ?>
                    <tr>
                        <td><?php echo $slide->id; ?></td>
                        <td><span><?php echo $slide->link; ?></span></td>
                        <td><img src="<?php echo $slide->img; ?>" width="150" /></td>
                        <td><span><?php echo $slide->day; ?></span></td>
                        <td><a href="<?php echo Route::url('admin_panel', array('action' => 'delslide', 'id' => $slide->id)); ?>">Удалить</a></td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        <?php endif; ?>
    </div>
</div>