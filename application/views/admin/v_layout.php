<div class="left">
    <ul class="left-menu nav nav-tabs nav-stacked">
        <li><a href="<?php echo Route::url('admin_panel', array('action' => 'serials')); ?>">Сериалы</a></li>
        <li><a href="<?php echo Route::url('admin_other', array('action' => 'categoryserials')); ?>">Категории сериалов</a></li>
        <li><a href="<?php echo Route::url('admin_panel', array('action' => 'seasons')); ?>">Сезоны</a></li>
        <li><a href="<?php echo Route::url('admin_panel', array('action' => 'seriya')); ?>">Серии</a></li>
        <li><a href="<?php echo Route::url('admin_panel', array('action' => 'addnews')); ?>">Новости</a></li>
        <li><a href="<?php echo Route::url('admin_panel', array('action' => 'blog')); ?>">Блог</a></li>
        <li><a href="<?php echo Route::url('admin_panel', array('action' => 'relizer')); ?>">Релизеры</a></li>
        <li><a href="<?php echo Route::url('admin_panel', array('action' => 'poster')); ?>">Постер</a></li>
        <li><a href="<?php echo Route::url('admin_panel', array('action' => 'slider')); ?>">Слайдер</a></li>
        <li><a href="<?php echo Route::url('admin_panel', array('action' => 'relise')); ?>">Релизы</a></li>
        <li><a href="<?php echo Route::url('admin_panel', array('action' => 'comments')); ?>">Комментарии</a></li>
    </ul>
</div>
<div class="content">
    <?php if (isset($content)) echo $content; ?>
</div>