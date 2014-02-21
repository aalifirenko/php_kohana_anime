<table class="table table-striped">
    <thead>
    <tr>
        <th>#</th>
        <th>Serial</th>
        <th>Delete</th>
        <th>Edit</th>
    </tr>
    </thead>
    <tbody>
        <?php foreach ($serials as $serial): ?>
            <tr>
                <td><?php echo $serial->id; ?></td>
                <td><?php echo $serial->title_rus; ?></td>
                <td><a href="<?php echo Route::url('admin_panel', array('action' => 'editserial', 'id' => $serial->id)); ?>">Edit</a></td>
                <td><a href="<?php echo Route::url('admin_panel', array('action' => 'delserial', 'id' => $serial->id)); ?>">Delete</a></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>