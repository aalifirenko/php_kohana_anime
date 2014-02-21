<table class="table table-striped">
    <thead>
    <tr>
        <th>#</th>
        <th>Poster</th>
        <th>Hour</th>
        <th>Delete</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($posters as $poster): ?>
        <tr>
            <td><?php echo $poster->id; ?></td>
            <td><?php echo $poster->filename; ?></td>
            <td><?php echo $poster->hour; ?></td>
            <td><a href="<?php echo Route::url('admin_panel', array('action' => 'delposter', 'id' => $poster->id)); ?>">Delete</a></td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>