<div class="add-new-serial">
    <?php if (Session::instance()->get_once('add_relizer') == '1'): ?>
        <div class="alert alert-success">
            Релизер добавлен
        </div>
    <?php elseif (Session::instance()->get_once('add_relizer') == '0'): ?>
        <div class="alert alert-error">
            Ошибка добавления
        </div>
    <?php endif; ?>
    <form action="<?php echo Route::url('admin_panel', array('action' => 'addrelizer')); ?>" method="POST" class="form-inline">
        <input type="text" name="relizer" placeholder="релизер" />
        <button type="submit" class="btn">Добавить</button>
    </form>
    <div class="all-relizers">
        <?php if (isset($list)) echo $list; ?>
    </div>
</div>