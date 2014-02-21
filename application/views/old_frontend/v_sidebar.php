<div class="left-sidebar-box">
<div class="sidebar-head">
        <input type="text" class="sidebar-live-search input-medium search-query" placeholder="живой поиск..." />
        <span class="sidebar-icon-search icon-search"></span>
</div>
<div class="sidebar-body">
    <?php if (isset($allSerials)): ?>
    <?php foreach ($allSerials as $serial): ?>
        <span class="sidebar-serial-item <?php if (Request::$current->param('serial_id') == $serial->id) echo "item-current"; ?>" data-eng-title="<?php echo $serial->title_orig; ?>">
            <a href="<?php echo Route::url('view_serial_with_name', array('serial_id' => $serial->id,'serial_name' => strtolower(str_replace(" ", "_", $serial->title_orig)))); ?>">
                <span class="serial-item-prev"><img src="<?php echo $serial->img; ?>" width="30" /></span>
                <span class="serial-item-anime-title"><?php echo $serial->title_rus; ?></span>
            </a>
        </span>
    <?php endforeach; ?>
    <?php endif; ?>
</div>
</div>
<div class="sidebar-serial-item">
            <a href="/"><span class="serial-item-anime-title view-all-sidebar" style="text-align: center">Показать все</span></a>
</div>