<?php if (Session::instance()->get_once('add_pictures') == '1'): ?>
    <div class="alert alert-success">
        Обои добавлены
    </div>
<?php elseif (Session::instance()->get_once('add_pictures') == '0'): ?>
    <div class="alert alert-error">
        Ошибка добавления
    </div>
<?php endif; ?>

<div class="gallery-add">
    <form action="" method="POST" enctype="multipart/form-data">
        <input type="file" name="img" /><br/>
        SEO: <textarea name="seo"></textarea><br/>
        <button type="submit">Добавить</button>
    </form>
</div>
<div class="gallery-list">
    <?php if (isset($list)): ?>
        <ul>
        <?php foreach ($list as $picture): ?>
            <li class="gallery-item">
                <img src="<?php echo $picture->img; ?>" width="145" />
                <a href="<?php echo Route::url('admin_gallery', array('action' => 'delpicture','id' => $picture->id)); ?>" >удалить</a>
            </li>
        <?php endforeach; ?>
        </ul>
    <?php endif; ?>
</div>