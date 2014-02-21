<?php if (Session::instance()->get_once('add_series') == '1'): ?>
    <div class="alert alert-success">
        Серия добавлена
    </div>
<?php elseif (Session::instance()->get_once('add_series') == '0'): ?>
    <div class="alert alert-error">
        Ошибка добавления
    </div>
<?php endif; ?>
<form action="<?php echo Route::url('admin_panel', array('action' => 'addseries')); ?>" enctype="multipart/form-data" method="POST" id="series-form">
<div class="series-box">
    <select id="serial-select" name="serial_id">
        <?php foreach ($serials as $serial): ?>
            <option value="<?php echo $serial->id; ?>"><?php echo $serial->title_rus; ?></option>
        <?php endforeach; ?>
    </select>
    <button class="btn" id="select-serial">Выбрать</button>
</div>
<div class="seasons-list">

</div>
<div class="add-series-box">

</div>
    <div class="is-mkv">
        <label>MKV Формат</label>
        <input type="checkbox" name="mkv" />
    </div>
</form>
<div class="show-all-series">

</div>