<table class="table table-striped">
    <thead>
    <tr>
        <th>Заголовок</th>
        <th>Edit</th>
        <th>Delete</th>
    </tr>
    </thead>
    <tbody>
    <?php if ($blogModel): ?>
        <?php foreach ($blogModel as $blog): ?>
        <tr>
            <td><?php echo $blog->title; ?></td>
            <td><a href="<?php echo Route::url('admin_panel', array('action' => 'editblog', 'id' => $blog->id)); ?>">Edit</a></td>
            <td><a class="delete-news" data-id="<?php echo $blog->id; ?>" href="#">Delete</a></td>
        </tr>
        <?php endforeach; ?>
    <?php endif; ?>
    </tbody>
</table>