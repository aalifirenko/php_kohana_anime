<table class="table table-striped">
    <thead>
    <tr>
        <th>#</th>
        <th>Relizer</th>
        <th>Delete</th>
    </tr>
    </thead>
    <tbody>
        <?php foreach ($relizers as $relizer): ?>
            <tr>
                <td><?php echo $relizer->id; ?></td>
                <td><?php echo $relizer->title; ?></td>
                <td><a href="<?php echo Route::url('admin_panel', array('action' => 'delrelizer', 'id' => $relizer->id)); ?>">Delete</a></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>