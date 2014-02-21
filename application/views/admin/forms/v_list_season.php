<form action="" method="POST" class="form-inline">
    <select name="serial_id">
        <?php foreach ($serials as $serial): ?>
            <option value="<?php echo $serial->id; ?>"><?php echo $serial->title_rus; ?></option>
        <?php endforeach; ?>
    </select>
    <button class="btn" type="submit">Показать</button>
</form>

<?php if (Request::$initial->method() == 'POST'): ?>
 <?php $model_seasons = ORM::factory('season')->where('serial_id', "=", Request::$initial->post('serial_id'))->find_all(); ?>
<table class="table table-striped">
    <thead>
    <tr>
        <th>#</th>
        <th>Season</th>
        <th>Edit</th>
        <th>Delete</th>
    </tr>
    </thead>
    <tbody>
        <?php foreach ($model_seasons as $season): ?>
            <tr>
                <td><?php echo $season->id; ?></td>
                <td><?php echo $season->title; ?></td>
                <td><a href="<?php echo Route::url('admin_panel', array('action' => 'editseason', 'id' => $season->id)); ?>">Edit</a></td>
                <td><a href="<?php echo Route::url('admin_panel', array('action' => 'delseason', 'id' => $season->id)); ?>">Delete</a></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<?php endif; ?>