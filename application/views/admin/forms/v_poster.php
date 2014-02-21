<div class="add-poster">
    <?php if (Session::instance()->get_once('add_poster') == '1'): ?>
        <div class="alert alert-success">
            Постер обновлен
        </div>
    <?php elseif (Session::instance()->get_once('add_poster') == '0'): ?>
        <div class="alert alert-error">
            Ошибка добавления
        </div>
    <?php endif; ?>
    <form action="<?php echo Route::url('admin_panel', array('action' => 'addposter')); ?>" method="POST" class="form-inline" enctype="multipart/form-data">
        <input type="file" name="poster" /><br/>
        hour: <input type="text" name="hour" /><br/>
        <button name="send" class="btn">Добавить</button>
    </form>
</div>
<div class="list-posters">
    <?php if (isset($list_posters)): ?>
        <?php echo $list_posters ?>
    <?php endif; ?>
</div>